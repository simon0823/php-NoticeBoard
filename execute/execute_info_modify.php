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

        $errmsg = "";

        $inputNAME = trim($_POST['inputNAME']);
        $inputEMAIL = trim($_POST['inputEMAIL']);
        $inputPW = trim($_POST['inputPW']);
        $inputProfile = $_FILES['modiProfile']['name'];

        if(empty($inputNAME)) {
            $errmsg = $errmsg."이름이 입력되지 않았습니다!\\n";
        }

        if(empty($inputEMAIL)) {
            $errmsg = $errmsg."이메일이 입력되지 않았습니다!\\n";
        }

        $extAllow = array( 'jpg', 'jpeg', 'png');
        $ext = strtolower( substr( strrchr($inputProfile, '.') ,1) );

        if (in_array($ext, $extAllow)) {
            $path = "../profile_photo/$inputProfile";
            move_uploaded_file($_FILES['modiProfile']['tmp_name'], $path);
        } else {
            $inputProfile = "user.png";
        }

        if(empty($inputPW)) {
            $errmsg = $errmsg."비밀번호가 입력되지 않았습니다!\\n";
        }

        if(!empty($errmsg)) {
            echo "<script language='JavaScript'>\n";
            echo "alert('";
            echo $errmsg;
            echo "');\n location.href='../info_modify.php'\n</script>";
            exit(0);
        }else {
            $sql = "SELECT MemberPW FROM account_info WHERE MemberID = :MemberID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':MemberID', $_SESSION['userID']);
            $stmt->execute();
            $result = $stmt->fetchObject();
            $dbpw = $result->MemberPW;

            if(password_verify($inputPW, $dbpw)) {
                $sql = "UPDATE account_info SET MemberNAME = :MemberNAME, MemberEMAIL = :MemberEMAIL, MemberPROFILE = :MemberPROFILE WHERE MemberID = :SessionID";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':MemberNAME',$inputNAME);
                $stmt->bindParam(':MemberEMAIL',$inputEMAIL);
                $stmt->bindParam(':MemberPROFILE', $inputProfile);
                $stmt->bindParam(':SessionID',$_SESSION['userID']);
                $stmt->execute();

                if($stmt->rowCount() == 1) {
                    $_SESSION['userNAME'] = $inputNAME;
                    $_SESSION['userEMAIL'] = $inputEMAIL;

                    echo "<script language='JavaScript'>\n";
                    echo "alert('회원정보수정이 성공적으로 처리되었습니다.');\n";
                    echo "location.href='../index.php'";
                    echo "</script>";
                    exit(0);
                }else if($stmt->rowCount() == 0) {
                    echo "<script language='JavaScript'>\n";
                    echo "alert('수정한 회원정보가 없습니다.');\n";
                    echo "location.href='../index.php'";
                    echo "</script>";
                    exit(0);
                }else {
                    echo "DB에러입니다. 관리자에게 문의해주세요.";
                    exit(0);
                }
            }else {
                echo "<script language='JavaScript'>\n";
                echo "alert('비밀번호가 틀렸습니다.');\n";
                echo "location.href='../info_modify.php'";
                echo "</script>";
                exit(0);
            }
        }
    ?>