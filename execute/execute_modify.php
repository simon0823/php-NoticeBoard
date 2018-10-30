<?php session_start() ?>

    <?php require_once("../db/db_conn.php");

        if(!isset($_SESSION['userID'])){
            echo "<div class='jumbotron jumbotron-fluid'>";
            echo "<div class='container'>";
            echo "<h1 class='display-4'>권한이 없습니다!</h1>";
            echo "<p class='lead'>";
            echo "로그인을 해주세용!";
            echo "</p>";
            echo "<button class='btn btn-danger' onclick=location.href='../login.php'>";
            echo "로그인 페이지로 이동";
            echo "</button>";
            echo "</div>";
            echo "</div>";
            exit(0);
        }

        $bid = $_GET['bid'];

        $boardID = $bid;
        $boardTitle = trim($_POST['boardTitle']);
        $boardContent = trim($_POST['boardContent']);

        $sql = "UPDATE account_board SET BoardTITLE = :BoardTITLE, BoardCONTENT = :BoardCONTENT WHERE BoardID = :BoardID";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BoardTITLE', $boardTitle);
        $stmt->bindParam(':BoardCONTENT',$boardContent);
        $stmt->bindParam(':BoardID',$boardID);
        $stmt->execute();

        $msg = "";

        if($stmt->rowCount() == 1){
            echo "<script language='JavaScript'>\n";
            echo "alert('글 수정이 성공적으로 처리되었습니다.');\n";
            echo "location.href='../board/boardList.php'";
            echo "</script>";
        } else if($stmt->rowCount() == 0) {
            echo "<script language='JavaScript'>\n";
            echo "alert('수정한 내용이 없습니다.');\n";
            echo "location.href='../board/boardList.php'";
            echo "</script>";
        } else {
            $msg = "DB에러입니다. 관리자에게 문의해주세요.";
        }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("../setting/setting_head.php") ?>
    <title>글 수정중...</title>
</head>
<body>
    <?php
        echo $msg;
    ?>
</body>
</html>