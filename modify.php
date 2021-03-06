<?php session_start() ?>

<?php require_once("./db/db_conn.php")?>

<!doctype html>
<html lang="en">
<head>
    <?php
        require_once("./setting/setting_head.php")
    ?>
    <title>글쓰기 페이지</title>
</head>
<body>
    <?php
        require_once("./nav/nav_header.php")
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

        $bid = $_GET['bid'];

        $sql = "SELECT BoardTITLE, BoardCONTENT FROM account_board WHERE BoardID = :BoardID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BoardID',$bid);
        $stmt->execute();

        $result = $stmt->fetchObject();

        $BoardID = $bid;
        $BoardTITLE = $result->BoardTITLE;
        $BoardCONTENT = $result->BoardCONTENT;

        $BoardTITLE = trim($BoardTITLE);
        $BoardCONTENT = trim($BoardCONTENT);
    ?>

<form action="execute/execute_modify.php?bid=<?php echo $BoardID ?>" method="post" id="boardForm">
    <div class="container mt-4">
        <div class="form-group row">
            <label for="userID" class="col-sm-1 col-form-label">아이디</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="userID" value="<?php echo $_SESSION['userID'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="boardTitle" class="col-sm-1 col-form-label">글 제목</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="boardTitle" name="boardTitle" value="<?php echo $BoardTITLE ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="boardContent">글 내용</label>
            <textarea class="form-control" id="boardContent" name="boardContent" form="boardForm" rows="20" style="resize: none;"><?php echo $BoardCONTENT ?></textarea>
        </div>

        <div class="float-right mt-2 mb-2">
            <button type="submit" class="btn btn-success">수정하기</button>
            <button type="reset" class="btn btn-secondary">취소</button>
        </div>
    </div>
</form>

    <?php
        require_once("./nav/nav_footer.php")
    ?>
</body>
</html>