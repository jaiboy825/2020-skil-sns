<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Library;
// use Gondr\App\View;

class MainController extends MasterController
{
    public function index()
    {
        $list = [];
        $listc = [];
        $listi = [];
        $user = [];
        if (isset($_SESSION['user'])) {
            $sql = "SELECT DISTINCT * FROM mysnspost AS post LEFT JOIN mysnsfollow AS follow ON(follow.ask_user = post.name) WHERE (post.type = '전체 공개') OR (post.type ='친구만' AND follow.from_user = ?) OR (post.name = ?) ORDER BY post.board_id DESC";
            $param = [$_SESSION['user']->name, $_SESSION['user']->name];
            $list = DB::fetchAll($sql, $param);
            $sqlc = "SELECT * FROM mysnscomment ORDER BY id DESC";
            $listc = DB::fetchAll($sqlc);
            $sqli = "SELECT * FROM mysnsimg ORDER BY id DESC";
            $listi = DB::fetchAll($sqli);
            $users = "SELECT * FROM mysns ORDER BY id DESC";
            $user = DB::fetchAll($users);
            // echo "<pre>";
            // var_dump($list);
            // echo "</pre>";
        }
        $this->render("main", ['list' => $list, 'listc' => $listc, 'listi' => $listi, 'user' => $user]);
    }
    public function indexProfileImg()
    {
        $img = $_FILES['solo_file'];
        $email = $_SESSION['user']->id;
        $type = explode("/", $img['type'])[1];
        $newFilePath = "profile_img/".date("him").".".$type;
        move_uploaded_file($img['tmp_name'], $newFilePath);
        $sqls = "UPDATE mysns set img = ? WHERE  id = ?";
        $newFilePath = "/".$newFilePath;
        $images = DB::execute($sqls, [$newFilePath, $email]);
        echo $newFilePath;
    }

    public function indexProcess()
    {
        $userid = $_POST['userid'];
        $username = $_POST['userName'];
        $pass = $_POST['password'];
        $passc = $_POST['passwordc'];
        $userfname = $_POST['fname'];

        if ($userid ==  "" || $pass == "" || $passc == "" || $username == "" || $userfname == "") {
            Library::msgError("필수값은 공백이 될 수 없습니다.", "/");
            return;
        }

        if ($pass != $passc) {
            Library::msgAndGo("비밀번호와 비밀번호 확인이 다릅니다.", "/");
            return;
        }

        $sql = "INSERT INTO mysns (`id`,  `name`, `password`, `fname`)
                VALUES (?, ?, PASSWORD(?), ?)";
        $result = DB::execute($sql, [$userid, $username, $pass, $userfname]);
        if ($result != 0) {
            Library::msgAndGo("회원 가입 성공!", "/");
            return;
        } else {
            Library::msgSucces("이미 가입이 된 이메일 입니다.", "/");
            return;
        }

        Library::msgAndGo("회원가입 완료. 로그인해주세요", "success");
    }

    public function indexPost()
    {
        $name = $_SESSION['user']->name;
        $email = $_SESSION['user']->id;
        $text = $_POST['postText'];
        $img = count($_FILES['postImg']['name']);
        $time = date("Y-m-d H:i:s");
        $a = 0;
        $type = $_POST['postType'];
        $sql = "INSERT INTO mysnspost (`name`, `text`, `time`, `type`,`email`)
                VALUES (?, ?, ?, ?, ?)";
        $result = DB::execute($sql, [$name, $text, $time, $type, $email]);
        if (!empty($img)) {
            $sqles = "SELECT * FROM mysnspost";
            $list = DB::fetchAll($sqles);
            foreach ($list as $item) {
                $a = $item->board_id;
            }
            for ($i = 0; $i < $img; $i++) {
                $tmpFilePath = $_FILES['postImg']['tmp_name'][$i];
                if ($tmpFilePath != "") {
                    $newFilePath = "upload/" . $_FILES['postImg']['name'][$i];
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $sqls = "INSERT INTO mysnsimg (`board_id`,`img`)
                            VALUES (?, ?)";
                        $results = DB::execute($sqls, [$a, $newFilePath]);
                    }
                }
            }
        }
        echo "<script>location.href='/';</script>";
    }
    public function deletePost()
    {
        $board_id = $_POST['board_id'];
        $sql = "DELETE FROM mysnspost WHERE board_id = $board_id";
        $result = DB::execute($sql);
    }
    public function deleteComment()
    {
        $bi = $_POST['bi'];
        $sql = "DELETE FROM mysnscomment WHERE id = $bi";
        $result = DB::execute($sql);
    }

    public function indexComment()
    {
        $name = $_SESSION['user']->name;
        $postid = $_POST['board_id'];
        $text = $_POST['postComment'];
        $time = date("Y-m-d H-i-s");
        $user_id = $_SESSION['user']->id;
        $sql = "INSERT INTO mysnscomment (`name`,`postid`,`ctext`,`time`,`user_id`)
                VALUES (?,?,?,?,?)";
        $result = DB::execute($sql, [$name, $postid, $text, $time, $user_id]);
    }
    public function indexComments()
    {
        $name = $_SESSION['user']->name;
        var_dump($name);
        $postid = $_POST['board_id'];
        $text = $_POST['postComment'];
        $time = date("Y-m-d H-i-s");
        $user_id = $_SESSION['user']->id;
        $sql = "INSERT INTO mysnscomment (`name`,`postid`,`text`,`time`,`user_id`)
                VALUES (?,?,?,?,?)";
        $result = DB::execute($sql, [$name, $postid, $text, $time, $user_id]);
    }
    // public function indexLike(){
    //     $userid = $_SESSION['user']->id;
    //     $board_id = $_POST['board_id'];
    //     $like_status = 1;
    // }
}
