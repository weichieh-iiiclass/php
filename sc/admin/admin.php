<?php

require_once './checkAdmin.php';
require_once '../db.inc.php';

$total = $pdo->query("SELECT COUNT(1) AS `count` FROM `items`")->fetchAll()[0]['count']; //count??

$numPerPage = 5;
$totalPages = ceil($total / $numPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page < 1 ? 1 : $page;

$totalCategories = $pdo->query("SELECT COUNT(1) AS `count` FROM `categories`")->fetchAll()[0]['count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .border {
            border: 1px solid;
        }

        img.itemImg {
            width: 250px;
        }
    </style>
</head>

<body>
    <?php require_once './templates/title.php' ?>

    <h3>商品列表</h3>

    <?php
    if ($totalCategories > 0) {
    ?>
        <form name="myForm" enctype="multipart/form-data" method="POST" action="./deleteIds.php">
            <table class="border">
                <thead>
                    <tr>
                        <th class="border">勾選</th>
                        <th class="border">商品名稱</th>
                        <th class="border">商品照片路徑</th>
                        <th class="border">商品價格</th>
                        <th class="border">商品數量</th>
                        <th class="border">商品種類</th>
                        <th class="border">新增時間</th>
                        <th class="border">更新時間</th>
                        <th class="border">功能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemPrice`, 
                `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,
                `categories`.`categoryName`
                FROM `items` INNER JOIN `categories`
                ON `items`.`itemCategoryId` = `categories`.`categoryId`
                ORDER BY `items`.`itemId` ASC 
                LIMIT ?, ? ";

                    $arrParam = [
                        ($page - 1) * $numPerPage,
                        $numPerPage
                    ];

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    if ($stmt->rowCount() > 0) {
                        $arr = $stmt->fetchAll();
                        for ($i = 0; $i < count($arr); $i++) {
                    ?>
                            <tr>
                                <td class="border">
                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['itemId']; ?>">
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['itemName']; ?>
                                </td>
                                <td class="border">
                                    <img class="itemImg" src="../images/items/<?php echo $arr[$i]['itemImg'] ?>">
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['itemPrice']; ?>
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['itemQty']; ?>
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['categoryName']; ?>
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['created_at']; ?>
                                </td>
                                <td class="border">
                                    <?php echo $arr[$i]['updated_at']; ?>
                                </td>
                                <td>
                                    <a href="./edit.php?itemId=<?php echo $arr[$i]['itemId'] ?>">編輯</a>
                                </td>

                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="border" colspan="9">沒有資料</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td class="border" colspan="9">
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                            <?php } ?>
                        </td>
                    </tr>

                    <?php if ($total > 0) { ?>
                        <tr>
                            <td class="border" colspan="9"><input type="submit" name="smb" value="刪除"></td>
                        </tr>
                    <?php } ?>

                </tfoot>
            </table>

        </form>
    <?php
    } else {
        echo "請先建立商品類別";
    }
    ?>

</body>

</html>