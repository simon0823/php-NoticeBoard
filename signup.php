<!doctype html>
<html lang="en">
<head>
    <?php
        require_once ("./setting/setting_head.php")
    ?>
    <title>회원가입 페이지</title>
</head>
<body>
    <?php
        require_once ("./nav/nav_header.php")
    ?>

    <form action="execute/execute_signup.php" method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <div class="form-group">
                <label for="InputID">ID</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="InputID" id="InputID" placeholder="아이디를 입력해주세요.">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="location.href='/execute/execute_overlap.php'">중복 확인</button>
                    </div>
                </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your account information with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="InputPW">Password</label>
                <input type="password" class="form-control" name="InputPW" id="InputPW" placeholder="패스워드를 입력해주세요.">
            </div>
            <div class="form-group">
                <label for="InputPW_R">Password 확인</label>
                <input type="password" class="form-control" name="InputPW_R" id="InputPW_R" placeholder="패스워드를 다시 입력해주세요.">
            </div>
            <div class="form-group">
                <label for="InputNAME">닉네임</label>
                <input type="text" class="form-control" name="InputNAME" id="InputNAME" placeholder="닉네임을 입력해주세요.">
            </div>
            <label for="InputEMAIL">이메일</label>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="이메일을 입력해주세요." name="InputEMAIL" id="InputEMAIL">
            </div>
            <label for="Profile">프로필 이미지</label>
            <div class="mb-3">
                <input type="file" name="Profile" id="Profile">
            </div>

            <button type="submit" class="btn btn-primary">회원가입</button>
            <button type="reset" class="btn btn-secondary">취소</button>
        </div>
    </form>

    <?php
        require_once ("./nav/nav_footer.php")
    ?>
</body>
</html>