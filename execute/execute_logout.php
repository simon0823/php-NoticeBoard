<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그아웃</title>
</head>
<body>
    <?php
        $msg = "";

        if(!isset($_SESSION['userID'])) {
            $msg .= "<script language='JavaScript'>\n";
            $msg .= "alert('로그인 되어 있지 않습니다!');\n";
            $msg .= "location.href='../index.php'";
            $msg .= "</script>";
        }else {
            session_destroy();
            $msg .= "<script language='JavaScript'>\n";
            $msg .= "alert('로그아웃되었습니다.');\n";
            $msg .= "window.history.back()";
            $msg .= "</script>";
        }

        echo $msg;
    ?>
</body>
</html>
