<?php

require_once './checkAdmin.php';
require_once '../db.inc.php';
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
    <?php require_once './templates/title.php'; ?>
    <h3>編輯商品種類</h3>
    <form name="myForm" method="POST" action="./updateCategory.php">
        <table class="border">
            <thead>
                <tr>
                    <th class="border">種類名稱</th>
                    <th class="border">新增時間</th>
                    <th class="border">更新時間</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `categoryId`, `categoryName`, `created_at`, `updated_at`
                FROM `categories`
                WHERE `categoryId` = ?";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([(int)$_GET['editCategoryId']]);

                if ($stmt->rowCount() > 0) {
                    $arr = $stmt->fetchAll()[0];
                ?>
                    <tr>
                        <td class="border">
                            <input type="text" name="categoryNmae" value="<?php echo $arr['categoryName']; ?>" maxlength="100">
                        </td>
                        <td class="border"><?php echo $arr['created_at']; ?></td>
                        <td class="border"><?php echo $arr['updated_at']; ?></td>

                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td class="border" colspan="3">沒有資料</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
             <input type="submit" name="smb" value="送出">
             <input type="hidden" name="editCategoryId" value="<?php echo (int)$_GET['editCategoryId']; ?>">
             <!-- hidden input的用意? -->
        
        
    </form>

</body>

</html>