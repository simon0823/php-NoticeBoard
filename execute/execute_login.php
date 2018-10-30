<?php session_start();

    require_once ("../db/db_conn.php");

    $loginID = trim($_POST['LoginID']);
    $loginPW = trim($_POST['LoginPW']);

    $msg = "";

    $options = [
            'cost' => 11
    ];

    $hashPW = password_hash($loginPW, PASSWORD_BCRYPT);

    $sqlPW = "SELECT MemberPW FROM account_info
                    WHERE MemberID = :MemberID";
    $stmtPW = $conn->prepare($sqlPW);
    $stmtPW->bindParam('MemberID', $loginID);
    $stmtPW->execute();
    $objectPW = $stmtPW->fetchObject();
    $dbPW = $objectPW->MemberPW;

    $sql = "SELECT MemberID, MemberPW, MemberNAME, MemberEMAIL FROM account_info
              WHERE MemberID = :MemberID AND MemberPW = :MemberPW";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MemberID',$loginID);
    $stmt->bindParam(':MemberPW', $dbPW);
    $stmt->execute();
    $object = $stmt->fetchObject();

    if ($stmt->rowCount() == 0 AND !password_verify($loginPW, $dbPW)) {
        $msg .= "<script language='JavaScript'>";
        $msg .= "alert('ID 또는 PW가 존재하지 않습니다.');\n";
        $msg .= "history.go(-1);\n";
        $msg .= "</script>";

        error_log($loginPW);
        error_log($dbPW);
    } else {
        $msg .= "<script language='JavaScript'>";
        $msg .= "alert('로그인이 성공적으로 처리되었습니다.');\n";
        $msg .= "history.go(-1);\n";
        $msg .= "</script>";

        $_SESSION['userID'] = $loginID;
        $_SESSION['userNAME'] = $object->MemberNAME;
        $_SESSION['userEMAIL'] = $object->MemberEMAIL;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인 체크</title>
</head>
<body>
    <?php
        echo $msg;
    ?>
</body>
</html>
