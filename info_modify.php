<?php session_start(); ?>

<?php require_once("./db/db_conn.php")?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once("setting/setting_head.php"); ?>
    <title>회원정보수정페이지</title>
</head>
<body>
    <?php
        require_once("nav/nav_header.php");
    ?>

    <?php
        if(!isset($_SESSION['userID'])) {
            echo "<div class='jumbotron jumbotron-fluid'>";
            echo "<div class='container'>";
            echo "<h1 class='display-4'>권한이 없습니다!</h1>";
            echo "<p class='lead'>";
            echo "로그인을 해주세용!";
            echo "</p>";
            echo "<button class='btn btn-danger' onclick=location.href='login.php'>";
            echo "로그인 페이지로 이동";
            echo "</button>";
            echo "</div>";
            echo "</div>";
            exit(0);
        }
    ?>

    <form action="execute/execute_info_modify.php" method="post" class="container mt-5" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="inputID" class="col-sm-2 col-form-label text-center">아이디</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="inputID" name="inputID" value="<?php echo $_SESSION['userID'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNAME" class="col-sm-2 col-form-label text-center">이름</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNAME" name="inputNAME" value="<?php echo $_SESSION['userNAME'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEMAIL" class="col-sm-2 col-form-label text-center">이메일</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEMAIL" name="inputEMAIL" value="<?php echo $_SESSION['userEMAIL'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Profile" class="col-sm-2 col-form-label text-center">프로필 이미지</label>
            <div class="col-sm-10">
                <input type="file" name="modiProfile" id="modiProfile">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPW" class="col-sm-2 col-form-label text-center">비밀번호</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPW" name="inputPW" placeholder="수정하시려면 비밀번호를 입력해주세요.">
            </div>
        </div>
        <div class="float-right mt-2">
            <button class="btn btn-primary" type="submit">수정하기</button>
            <button class="btn btn-secondary" type="reset">취소</button>
        </div>
    </form>

    <?php
        require_once("nav/nav_footer.php")
    ?>
</body>
</html>
