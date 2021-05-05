<?php

require_once './checkSession.php';
require_once './db.inc.php';

$sqlTotal = "SELECT COUNT(1) AS `count` FROM `members`";
$stmtTotal = $pdo->query($sqlTotal); 
$arrTotal = $stmtTotal->fetchAll()[0]; 
$total = $arrTotal['count']; 

$numPerPage = 5;
$totalPages = ceil($total/$numPerPage); // 總頁數，ceil()為無條件進位
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page < 1 ? 1 : $page;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>我的php作業</title>
    <style>
        .tb_width {
            width: 1200px;
        }
    </style>
  </head>
  <body>
    <div class="tb_width m-4">
        <?php require_once './templates/title.php';?>
        <form name="memberForm" method="POST" action="./deleteIds.php">
            <h3 class="mt-5">會員資料</h3>
            <table class="table table-bordered table-info">
                <thead>
                    <tr>
                        <th>勾選</th>
                        <th>姓名</th>
                        <th>性別</th>
                        <th>生日</th>
                        <th>所在地</th>
                        <th>期望性別</th>
                        <th>期望特質與描述</th>
                        <th>照片</th>
                        <th>功能</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT `mId`, `mName`, `mGender`, `mBirth`, `mLocation`, `mWishGender`, `mWishDescription`, `mImg` FROM `members` ORDER BY `mId` ASC
                LIMIT ?,? ";

                $arrParam = [
                    ($page - 1) * $numPerPage,
                    $numPerPage
                ];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrParam);

                if($stmt->rowCount() > 0) {
                    $arr = $stmt->fetchAll();
                    for($i=0; $i<count($arr); $i++){
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['mId'] ?>">
                        </td>
                        <td><?php echo $arr[$i]['mName'] ?></td>
                        <td><?php echo $arr[$i]['mGender'] ?></td>
                        <td><?php echo $arr[$i]['mBirth'] ?></td>
                        <td><?php echo $arr[$i]['mLocation'] ?></td>
                        <td><?php echo $arr[$i]['mWishGender'] ?></td>
                        <td><?php echo nl2br($arr[$i]['mWishDescription']) ?></td>
                        <td>
                            <img style="width: 200px;" src="./files/<?php echo $arr[$i]['mImg'] ?>" alt="">
                        </td>
                        <td>
                            <a href="./edit.php?mId=<?php echo $arr[$i]['mId'] ?>">編輯</a><br>
                            <a href="./delete.php?mId=<?php echo $arr[$i]['mId'] ?>">刪除</a>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                        <?php 
                            for($i=1; $i<=$totalPages; $i++){
                            ?>
                            <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                            <?php
                            }
                        ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <input type="submit" name="smb" value="刪除">

        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>