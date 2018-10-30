<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <?php
        require_once ("./setting/setting_head.php")
    ?>
    <title>로그인 페이지</title>
</head>
<body>
    <?php
        require_once ("./nav/nav_header.php")
    ?>

    <form method="post" action="execute/execute_login.php">
        <div class="container mt-4">
            <div class="form-group">
                <label for="LoginID">ID</label>
                <input type="text" class="form-control" id="LoginID" name="LoginID" placeholder="아이디를 입력해주세요.">
                <small id="idHelp" class="form-text text-muted">We'll never share your account information with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="LoginPW">Password</label>
                <input type="password" class="form-control" id="LoginPW" name="LoginPW" placeholder="패스워드를 입력해주세요.">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="SaveID">
                <label class="form-check-label" for="SaveID">회원정보 저장</label>
            </div>
            <button type="submit" class="btn btn-primary">로그인</button>
        </div>
    </form>

    <?php
        require_once ("./nav/nav_footer.php")
    ?>
</body>
</html>