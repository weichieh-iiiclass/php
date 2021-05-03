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
    </style>
</head>

<body>
    <?php require_once './templates/title.php'; ?>

    <h3>編輯類別</h3>
    <form name="myForm" method="POST" action="./insertCategory.php">
        <ul>
            <?php
            $sql = "SELECT `categoryId`, `categoryName`
                FROM `categories`";
            $stmt = $pdo->query($sql);
            if ($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll();
            }

            for ($i = 0; $i < count($arr); $i++) {
            ?>
                <li>
                    <?php echo $arr[$i]['categoryName'] ?>
                    | <a href="./editCategory.php?editCategoryId=<?php echo $arr[$i]['categoryId'] ?>">編輯</a>
                    | <a href="./deleteCategory.php?deleteCategoryId=<?php echo $arr[$i]['categoryId'] ?>">刪除</a>
                </li>
            <?php

            }

            ?>
        </ul>

        <table class="border">
            <thead>
                <tr>
                    <th class="border">類別名稱</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="categoryName" value="" maxlength="100">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="border"><input type="submit" name="smb" value="新增"></td>
                </tr>
            </tfoot>
        </table>
    </form>

</body>

</html>