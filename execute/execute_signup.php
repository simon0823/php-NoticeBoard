<?php
    require_once ("../db/db_conn.php");

    $errmsg = "";

    $inputID = trim($_POST["InputID"]);
    $inputPW = trim($_POST["InputPW"]);
    $inputPW_R = trim($_POST["InputPW_R"]);
    $inputNAME = trim($_POST["InputNAME"]);
    $inputEMAIL = trim($_POST["InputEMAIL"]);

    if(strlen($inputID) < 4) {
        $errmsg = $errmsg."아이디는 최소 4자리 이상이어야 합니다.\\n";
    }

    if(strlen($inputPW) < 6) {
        $errmsg = $errmsg."비밀번호는 최소 6자리 이상이어야 합니다.\\n";
    }

    if($inputPW != $inputPW_R) {
        $errmsg = $errmsg."비밀번호 재입력이 올바르지 않습니다.\\n";
    }

    $inputProfile = $_FILES['Profile']['name']; // 업로드한 파일을 $inputProfile 변수에 담음
    $extAllow = array( 'jpg', 'jpeg', 'png'); // 프로필 사진의 허용되는 확장자 배열
    $ext = strtolower(substr( strrchr($inputProfile, '.') ,1) ); // 파일 확장자 추출

    if (in_array($ext, $extAllow)) { // 추출한 확장자가 $extAllow 배열 안에 들어있다면
        $path = "../profile_photo/$inputProfile";
        move_uploaded_file($_FILES['Profile']['tmp_name'], $path); // 임시 폴더에 있는 파일을 $path 위치로 이동
    } else {
        $inputProfile = "user.png"; // 추출한 확장자가 $extAllow 배열안에 들어있지 않다면 user.png 파일로 고정
    }

    if(strlen($errmsg) > 0) {
        echo "<script language='JavaScript'>\n";
        echo "alert('";
        echo $errmsg;
        echo "');\n location.href='../signup.php'\n</script>";
        exit(0);
    }else {
        $inputPW = password_hash($inputPW, PASSWORD_DEFAULT);

        $sql = "INSERT INTO account_info(MemberID, MemberPW, MemberNAME, MemberEMAIL, MemberPROFILE)
                              VALUES (:MemberID, :MemberPW, :MemberNAME, :MemberEMAIL, :MemberPROFILE)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':MemberID',$inputID);
        $stmt->bindParam(':MemberPW',$inputPW);
        $stmt->bindParam(':MemberNAME',$inputNAME);
        $stmt->bindParam(':MemberEMAIL', $inputEMAIL);
        $stmt->bindParam(':MemberPROFILE', $inputProfile);
        $stmt->execute();

        echo "<script language='JavaScript'>\n";
        echo "alert('회원가입이 성공적으로 처리되었습니다.');\n";
        echo "location.href='../index.php'";
        echo "</script>";
    }
?>