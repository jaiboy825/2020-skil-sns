<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Library;

class UserController extends MasterController
{
    public function register()
    {
        //회원가입 페이지 보여주기
        $this->render("user/register");
    }

    public function registerProcess()
    {
        //실제 회원가입 처리
        $userid = $_POST["email"];
        $pass = $_POST['pwd'];
        $fname = $_POST['fname'];
        $username = $_POST['lname'];

        $sql = "INSERT INTO mysns (`id`,  `name`, `password`, `fname`)
                VALUES (?,  ?,PASSWORD(?), ?)";
        $result = DB::execute($sql, [$userid, $username, $pass, $fname]);
        if ($result <= 0) {
            // Library::msgError("DB에 값이 올바르게 들어가지 않았습니다.", "/");
            exit;
        }

        // Library::msgAndGo("회원가입 완료. 로그인해주세요", "/user/login", "success");
        echo json_encode(['success' => true, 'msg' => "회원가입 완료 로그인 해주세요"], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function login()
    {
        $this->render("/");
    }

    public function loginProcess()
    {
        $userid = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM `mysns` WHERE `id` = ? AND `password` = PASSWORD(?)";
        $user = DB::fetch($sql, [$userid, $pass]);
        if ($user == null) {
            exit;
        }

        $_SESSION['user'] = $user;
        Library::msgSucces("로그인 완료", "/", "success");
    }

    public function logout()
    {   
        unset($_SESSION['user']);
        Library::msgError("로그아웃 완료", "/", "success");
    }
    public function profile()
    {
        $list = [];
        $user = [];
        $listc = [];
        $listi = [];
        $sqli = "SELECT * FROM mysnsimg ORDER BY id DESC";
        $listi = DB::fetchAll($sqli);
        $sqlc = "SELECT * FROM mysnscomment ORDER BY id DESC";
        $listc = DB::fetchAll($sqlc);
        $users = "SELECT * FROM mysns ORDER BY id DESC";
        $user = DB::fetchAll($users);
        $name = $_SESSION['user']->name;
        $sql = "SELECT * FROM mysnspost WHERE `name` = ? ORDER BY board_id DESC";
        $list = DB::fetchAll($sql, [$name]);
        $this->render('/user/profile', ['list' => $list,'listi' =>$listi, 'listc' => $listc, 'user' => $user]);
    }
}
