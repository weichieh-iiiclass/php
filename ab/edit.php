<?php

require_once("./checkSession.php"); //引入判斷是否登入機制
require_once("./db.inc.php"); //引用資料庫連線

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        .tb_width {
            width: 800px;
        }
    </style>

    <title>Document</title>
</head>
<body>
<div class="tb_width m-4">
    <?php require_once("./templates/title.php"); ?>
    <form name="myForm" method="POST" action="./updateEdit.php" enctype="multipart/form-data">
    <table class="table table-bordered table-sm table-info">
        <tbody>
            <?php
            $sql = "SELECT `id`,`studentId`,`studentName`,`studentGender`, `studentBirthday`, `studentPhoneNumber`, `studentDescription`, `studentImg`
            FROM `students` WHERE `id` = ?";
    
            $arrParam = [
                (int)$_GET['id']
            ];
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
            if ($stmt->rowCount() > 0){
                $arr = $stmt->fetchAll()[0];
            ?>
            <tr>
                    <td class="border">學號</td>
                    <td class="border">
                        <input type="text" name="studentId" value="<?php echo $arr['studentId']; ?>" maxlength="9" />
                    </td>
                </tr>
                <tr>
                    <td class="border">姓名</td>
                    <td class="border">
                        <input type="text" name="studentName" value="<?php echo $arr['studentName'] ?>" maxlength="10" />
                    </td>
                </tr>
                <tr>
                    <td class="border">性別</td>
                    <td class="border">
                        <select name="studentGender">
                            <option value="<?php echo $arr['studentGender'] ?>" selected><?php echo $arr['studentGender'] ?></option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="border">生日</td>
                    <td class="border">
                        <input type="text" name="studentBirthday" value="<?php echo $arr['studentBirthday'] ?>" maxlength="10" />
                    </td>
                </tr>
                <tr>
                    <td class="border">手機號碼</td>
                    <td class="border">
                        <input type="text" name="studentPhoneNumber" value="<?php echo $arr['studentPhoneNumber'] ?>" maxlength="10" />
                    </td>
                </tr>
                <tr>
                    <td class="border">個人描述</td>
                    <td class="border">
                        <textarea name="studentDescription"><?php echo $arr['studentDescription'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="border">大頭貼</td>
                    <td class="border">
                    <?php if($arr['studentImg'] !== NULL) { ?>
                        <img class="w200px" src="./files/<?php echo $arr['studentImg'] ?>" />
                    <?php } ?>
                    <input type="file" name="studentImg" />
                    </td>
                </tr>
                <tr>
                    <td class="border">功能</td>
                    <td class="border">
                        <a href="./delete.php?id=<?php echo $arr['id'] ?>">刪除</a>
                    </td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td class="border" colspan="6">沒有資料</td>
                </tr>
            <?php
            }
    
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" name="smb" value="修改">
                </td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="id" value="<?php echo (int)$_GET['id'] ?>">
    </form>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>