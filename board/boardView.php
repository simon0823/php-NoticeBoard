<?php session_start(); ?>

<?php require_once("../db/db_conn.php")?>

<?php
    require_once("../nav/nav_header.php")
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once("../setting/setting_head.php")?>
    <title>Document</title>
</head>
<body>
    <?php
        $bid = $_GET['bid'];

        $sql = "UPDATE account_board SET BoardVIEW = BoardVIEW + 1 WHERE BoardID = :BoardID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BoardID',$bid);
        $stmt->execute();

        $sql = "SELECT BoardID, MemberID, MemberEMAIL, BoardTITLE, BoardCONTENT, BoardDATE, BoardVIEW FROM account_board 
                  WHERE BoardID = :BoardID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BoardID',$bid);
        $stmt->execute();
        $result = $stmt->fetchObject();

        $BoardID = $bid;
        $MemberID = $result->MemberID;
        $MemberEMAIL = $result->MemberEMAIL;
        $BoardTITLE = $result->BoardTITLE;
        $BoardCONTENT = $result->BoardCONTENT;
        $BoardDATE = $result->BoardDATE;
        $BoardVIEW = $result->BoardVIEW;

        $hostname = $_SERVER['HTTP_HOST']; //도메인명 구하기
        $uri = $_SERVER['REQUEST_URI']; //uri 구하기
        $address = $hostname.$uri;

        $sql = "SELECT MemberPROFILE FROM account_info WHERE MemberID = :MemberID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':MemberID',$MemberID);
        $stmt->execute();
        $result = $stmt->fetchObject();

        $Profile = $result->MemberPROFILE;
    ?>

    <div class="container-fluid">
        <div class="page-header text-left mt-3 p-4">
            <h1 style="font-weight: 200;display: inline-block;"><?php echo $BoardTITLE?></h1>
            <div style="float: right;padding-top: 10px;width: 230px;">
                <img src="../profile_photo/<?php echo $Profile ?>" alt="none" style="float: left;width: 40px;height: 40px;border-radius: 8px;"/>
                <div>
                    <div style="text-align: right;float: right;">
                        <span style="display: inline-block;color: rgba(0,0,0,0.4);font-size: 10px;">
                            작성자 : <?php echo $MemberID?>
                        </span>
                        &nbsp;
                        <span style="display: inline-block;color: rgba(0,0,0,0.4);font-size: 10px;">
                            조회수 : <?php echo $BoardVIEW?>
                        </span>
                    </div>
                    <span style="display: inline-block;color: rgba(0,0,0,0.4);font-size: 10px;float: right;">
                        작성자 이메일 : <?php echo $MemberEMAIL?>
                    </span>
                </div>
            </div>
            <hr style="margin: 0;">
            <span style="color: rgba(0,0,0,0.4);font-size: 10px;float: left;margin-top: 5px;">
				<span style="text-decoration: none;color: inherit;">
					<?php echo $address?>
				</span>
			</span>
            <span style="color: #fff;font-size: 10px;float: right;margin-top: 5px;background-color: #00d1b2;padding: 2px 5px;border-radius: 3px;">
				<?php echo $BoardDATE?>
			</span>
        </div>

        <div class="form-group p-4">
            <?php echo $BoardCONTENT?>
        </div>

        <?php
            if(!isset($_SESSION['userID']) || $_SESSION['userID'] != $MemberID) {
        ?>
            <!-- 로그인하지 않거나 접속하고 있는 사용자의 ID가 글쓴이의 아이디가 다른 사용자에게는 글 수정, 삭제 버튼이 보이지 않음-->
            <div class="form-group p-4 float-right">
                <button type="button" class="btn btn-primary" onclick="location.href='./boardList.php'">목록으로</button>
            </div>
        <?php
            }else {
        ?>
            <div class="form-group p-4 float-right">
                <button type="button" class="btn btn-primary" onclick="location.href='./boardList.php'">목록으로</button>
                <button type="button" class="btn btn-success" onclick="location.href='../modify.php?bid=<?php echo $BoardID ?>'">글 수정</button>
                <button type="button" class="btn btn-danger" onclick="location.href='../execute/execute_delete.php?bid=<?php echo $BoardID ?>'">글 삭제</button>
            </div>
        <?php
            }
        ?>
    </div>
</body>

    <?php
        require_once("../nav/nav_footer.php")
    ?>

</html>
