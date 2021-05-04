<?php
require_once './checkAdmin.php';
require_once '../db.inc.php';

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

    <h3>新增商品</h3>
    <?php
    if ($totalCategories > 0) {
    ?>
        <form name="myForm" enctype="multipart/form-data" method="POST" action="./add.php">
            <table>
                <thead>
                    <tr>
                        <th class="border">商品名稱</th>
                        <th class="border">商品照片路徑</th>
                        <th class="border">商品價格</th>
                        <th class="border">商品數量</th>
                        <th class="border">商品種類</th>


                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">
                            <input type="text" name="itemName" value="" maxlength="100">
                        </td>
                        <td class="border">
                            <input type="file" name="itemImg" value="">
                        </td>
                        <td class="border">
                            <input type="text" name="itemPrice" value="" maxlength="11">
                        </td>
                        <td class="border">
                            <input type="text" name="itemQty" value="" maxlength="3">
                        </td>
                        <td class="border">
                            <select name="itemCategoryId">
                                <?php
                                $sql = "SELECT `categoryId`, `categoryName` FROM `categories`";
                                $stmt = $pdo->query($sql);
                                if ($stmt->rowCount() > 0) {
                                    $arr = $stmt->fetchAll();
                                    for ($i = 0; $i < count($arr); $i++) {
                                ?>
                                        <option value="<?php echo $arr[$i]['categoryId'] ?>"><?php echo $arr[$i]['categoryName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border" colspan="5"><input type="submit" name="smb" value="新增"></td>
                    </tr>
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