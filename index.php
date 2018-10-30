<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
    <?php
    require_once("./db/db_conn.php")
    ?>

    <?php
    require_once("./setting/setting_head.php");
    ?>
    <title>메인페이지</title>
</head>
<body>

<?php
require_once("./nav/nav_header.php");
?>

<div class="jumbotron">
    <h1 class="display-2">Hello, world!</h1>
    <p class="lead">이곳은 PHP 예제 게시판입니다.</p>
    <hr class="my-4">
    <p>게시판에 문제가 있다면 simon0823@naver.com로 문의하세요.</p>
    <a href="/board/boardList.php" class="btn btn-primary btn-lg" role="button">게시판으로 이동</a>
</div>

</body>

<?php
require_once("nav/nav_footer.php")
?>

</html>
