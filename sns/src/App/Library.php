<?php

namespace Gondr\App;

class Library 
{
    public static function msgError($msg, $target)
    {
        echo "<script>";
        // echo "Swal.fire({icon:'error', title:'$title', text:'$msg'})";
        // echo "Swal.fire('$msg')";
        echo "alert('$msg');";
        echo "location.href='$target';";
        echo "</script>";
    }
    public static function msgSucces($msg, $target)
    {
        echo "<script>";
        echo "alert('$msg');";
        echo "location.href='$target';";
        echo "</script>";
    }

    public static function msgAndGo($msg, $target, $css="danger")
    {
        $_SESSION['err'] = ['css' => $css, 'msg' => $msg];
        header("Location: ". $target);
    }
}