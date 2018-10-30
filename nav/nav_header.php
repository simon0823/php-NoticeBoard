<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">PHP 게시판</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
            if(isset($_SESSION['userID'])) {
                $sql = "SELECT MemberPROFILE FROM account_info WHERE MemberID = :MemberID";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':MemberID',$_SESSION['userID']);
                $stmt->execute();
                $result  = $stmt->fetchObject();

                $Profile = $result->MemberPROFILE;
        ?>
            <img src="../profile_photo/<?php echo $Profile ?>" alt="none" class="ml-2 mr-1" style="position:relative;color: black;dispaly:inline;width: 40px;height: 40px;border-radius: 8px;"/>
        <?php
            }
        ?>

        <ul class="navbar-nav mr-auto">
            <?php
                if(isset($_SESSION['userID'])) { ?>

            <li class="nav-item dropdown mr-1">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo "안녕하세요 ".$_SESSION['userID']."님"; ?>
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu ml-3" aria-labelledby="navbarDropdown" style="margin: 0px;padding: 10px;">
                    <button id="memberInfo" class="btn btn-link" style="width: 100%;display: block;text-decoration: none;">회원정보</button>
                    <a href="../execute/execute_logout.php" class="text-center btn btn-danger" style="display: block;">로그아웃</a>
                </div>
            </li>

            <a class="form-inline my-2 my-lg-0" href="../write.php" style="text-decoration: none;">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">글 쓰기</button>
            </a>

            <?php } else { ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form method="post" action="../execute/execute_login.php" accept-charset="UTF-8"
                          style="margin:0px; padding: 5px;">
                        <input class="form-control" type="text" placeholder="아이디" id="LoginID" name="LoginID"
                               style="margin-bottom:5px;">
                        <input class="form-control" type="password" placeholder="비밀번호" id="LoginPW"
                               name="LoginPW" style="margin-bottom:5px;">
                        <input class="btn btn-block" type="submit" id="sign-in" value="로그인">
                        <a href="../signup.php" class="text-center btn btn-primary"
                           style="display: block;">회원가입</a>
                    </form>
                </div>
            </li>

            <?php } ?>
        </ul>

        <form action="../execute/execute_search.php" method="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="제목으로 검색해주세요" aria-label="Search" name="searchKeyword" id="searchKeyword">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div id="modal">
    <div class="body">
        <div class="container">
            <div class="row">
                <label for="userID">ID :</label>
                <span class="ml-1" name="userID" id="userID" style="font-weight: lighter;font-size: 17px;"><?php echo $_SESSION['userID']; ?></span>
            </div>
            <div class="row">
                <label for="userID">NAME :</label>
                <span class="ml-1" name="userID" id="userID" style="font-weight: lighter;font-size: 17px;"><?php echo $_SESSION['userNAME']; ?></span>
            </div>
            <div class="row">
                <label for="userID">EMAIL :</label>
                <span class="ml-1" name="userID" id="userID" style="font-weight: lighter;font-size: 17px;"><?php echo $_SESSION['userEMAIL']; ?></span>
            </div>
        </div>
        <div class="button mt-4">
            <button type="button" class="btn btn-outline-primary" onclick="javascript:location.href='/execute/execute_myboard.php'">내가 쓴 글</button>
            <button type="button" class="btn btn-outline-info" onclick="javascript:location.href = '../info_modify.php'">회원 정보 수정</button>
            <button type="button" class="btn btn-danger" id="btn-close">닫기</button>
        </div>
    </div>
</div>