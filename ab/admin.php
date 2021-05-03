<?php
    require_once("./checkSession.php"); //引入判斷是否登入機制
    require_once("./db.inc.php"); //引用資料庫連線

    // COUNT不一定要放欄位，可以直接寫COUNT(1)
    $sqlTotal = "SELECT COUNT(1) AS `count` FROM `students`";

    $stmtTotal = $pdo->query($sqlTotal); //執行 SQL 語法，並回傳、建立 PDOstatment 物件
    $arrTotal = $stmtTotal->fetchAll()[0]; //查詢結果，取得第一筆資料(索引為 0)?????
    $total = $arrTotal['count']; //資料表總筆數

    // 上面的作法，可以直接寫成：
    // $total = $pdo->query($sqlTotal)->fetchAll()[0]['count'];

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>none</title>
    <style>
        .tb_width {
            width: 1300px;
        }
    </style>

</head>

<body>
    <div class="tb_width m-4">
        <?php require_once("./templates/title.php"); ?>
        <form name="myForm" method="POST" action="./deleteIds.php">
        <table class="table table-bordered table-sm table-info">

            <thead>
                <tr>
                    <th>選擇</th>
                    <th>學號</th>
                    <th>姓名</th>
                    <th>性別</th>
                    <th>生日</th>
                    <th>手機號碼</th>
                    <th>個人描述</th>
                    <th>照片</th>
                    <th>功能</th>

                </tr>
            </thead>
            <tbody>
            <?php

            $sql = 
            "SELECT `id`, `studentId`, `studentName`, `studentGender`,   `studentBirthday`, `studentPhoneNumber`, `studentDescription`, `studentImg`
            FROM `students` 
            ORDER BY `id` ASC 
            LIMIT ?,? ";

            $arrParam = [
                ($page - 1) * $numPerPage,
                $numPerPage
            ];

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //資料數量大於 0，則列出所有資料
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll();
                for($i=0; $i<count($arr); $i++){
            ?>
                <tr>
                    <td>
                        <input type="checkbox" name="chk[]"  value="<?php echo $arr[$i]['id'] ?>">
                    </td>
                    <td><?php echo $arr[$i]['studentId'] ?></td>
                    <td><?php echo $arr[$i]['studentName'] ?></td>
                    <td><?php echo $arr[$i]['studentGender'] ?></td>
                    <td><?php echo $arr[$i]['studentBirthday'] ?></td>
                    <td><?php echo $arr[$i]['studentPhoneNumber'] ?></td>
                    <td><?php echo nl2br($arr[$i]['studentDescription']) ?></td>
                    <td>
                    <img style="width: 200px;" src="./files/<?php echo $arr[$i]['studentImg'] ?>" alt="">    
                    </td>
                    <td>
                        <a href="./edit.php?id=<?php echo $arr[$i]['id'] ?>">編輯</a>
                        <a href="./delete.php?id=<?php echo $arr[$i]['id'] ?>">刪除</a>
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
                    <?php for($i=1; $i<=$totalPages; $i++){
                    ?><a href="?page=<?php echo $i ?>"> <?php echo $i ?> </a><?php 
                    }
                    ?>
                    </td>
                </tr>
            </tfoot>

        </table>
        <input type="submit" name="smb" value="刪除">
        </form>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>

</html>