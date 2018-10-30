<?php session_start(); ?>

<?php require_once("../db/db_conn.php")?>

<!doctype html>
<html lang="en">
<head>
    <?php
        require_once("../setting/setting_head.php");
    ?>
    <title>메인페이지</title>
</head>
<body>

    <?php
        require_once("../nav/nav_header.php");
    ?>

    <div class="container mt-4" style="max-width: 1900px">
        <div class="row" style="padding: 0px 70px;">
            <div class="card-deck">
                <!--card-->
                <?php
                    $sql = "SELECT board.BoardID, board.MemberID, board.MemberEMAIL, board.BoardTITLE, board.BoardCONTENT, board.BoardDATE, board.BoardVIEW, info.MemberPROFILE FROM account_info AS info JOIN account_board AS board ON info.MemberID = board.MemberID";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    if ($stmt->rowCount() == 0) {
                        echo "게시판에 글이 존재하지 않습니다";
                    } else {
                        while ($row = $stmt->fetchObject()) {
                            echo "<a href='./boardView.php?bid=$row->BoardID' style='text-decoration: none;color: inherit;'>";
                            echo "<div class='card bg-light mb-3' style='min-width: 12rem;'>";
                            echo "<div class='card-header'>";
                            echo "<div class='float-left' style='display: inline-block;margin-top: 10px;'>";
                            echo "<span style='font-size: 12px;font-style: italic'>NO. </span>";
                            echo "<span style='font-size: 13px;font-weight: lighter'>$row->BoardID</span>";
                            echo "</div>";
                            echo "<div class='float-right' style='display: inline-block;'>";
                            echo "<img class='rounded' src='../profile_photo/$row->MemberPROFILE' alt='none' style='display: block;width: 30px;height: 30px;margin-left: 50%;transform: translateX(-50%)'>";
                            echo "<span style='font-size: 12px;font-weight: bold;'>$row->MemberID</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>$row->BoardTITLE</h5>";
                            echo "<p class='card-text' style='font-size: 14px;font-weight: lighter;'>";
                            echo mb_substr($row->BoardCONTENT, 0, 20, "utf-8");
                            echo '...';
                            echo "</p>";
                            echo "</div>";
                            echo "<div class='card-footer text-center'>";
                            echo "<span style='font-size: 11px;'>조회 수 : </span>";
                            echo "<span style='font-size: 12px;font-weight: lighter;'>$row->BoardVIEW</span>";
                            echo "<span style='font-size: 11px;font-weight: lighter;display: block;'>$row->BoardDATE</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

</body>

    <?php
        require_once("../nav/nav_footer.php")
    ?>

</html>
