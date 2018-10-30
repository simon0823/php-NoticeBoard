<?php session_start() ?>

<?php require_once("../db/db_conn.php");

    if(!isset($_SESSION['userID'])){
        echo "로그인 후 사용하세요";
        echo "<br><a href='../index.php' class='btn btn-default'>메인 페이지로 돌아가기</a>";
    }

    $MemberID = trim($_SESSION['userID']);
    $MemberEMAIL = trim($_SESSION['userEMAIL']);
    $boardTitle = trim($_POST['boardTitle']);
    $boardContent = trim($_POST['boardContent']);
    $date = date('Y-m-d H:i:s');

    $uid = $_SESSION['memberID'];

    $sql = "INSERT INTO account_board(MemberID, MemberEMAIL, BoardTITLE, BoardCONTENT, BoardDATE)
                                  VALUES (:MemberID, :MemberEMAIL, :BoardTITLE, :BoardCONTENT, :BoardDATE)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MemberID',$MemberID);
    $stmt->bindParam(':MemberEMAIL',$MemberEMAIL);
    $stmt->bindParam(':BoardTITLE', $boardTitle);
    $stmt->bindParam(':BoardCONTENT',$boardContent);
    $stmt->bindParam(':BoardDATE', $date);
    $stmt->execute();

    $msg = "";

    if($stmt->rowCount() == 1){
        echo "<script language='JavaScript'>\n";
        echo "alert('글 작성이 성공적으로 처리되었습니다.');\n";
        echo "location.href='../board/boardList.php'";
        echo "</script>";
    }else {
        $msg = "DB에 오류가 발생했습니다<br>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("../db/db_conn.php");?>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        echo $msg;
    ?>
</body>
</html>