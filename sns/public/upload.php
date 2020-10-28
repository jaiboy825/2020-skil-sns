<?php
    header("Content-Type: application/json");
    $upfile = $_FILES["file"];

    $upfile["tmp_name"];
    $src = "/upload" . "/".$upfile['name'];
    move_uploaded_file(
        $upfile["tmp_name"], "." . $src);

    //업로드한 내용이 이미지 파일인지 일반 파일인지 체크

    echo json_encode(
        ['success' => true, 'type'=>'image', 'src' => $src ], 
        JSON_UNESCAPED_UNICODE);