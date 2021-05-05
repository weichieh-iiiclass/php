<?php
require_once './checkSession.php';
require_once './db.inc.php';
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
            width: 800px;
        }
    </style>
  </head>
  <body>
    <div class="tb_width m-4">
        <?php require_once './templates/title.php'; ?>
        <form name="editMember" method="POST" action="./updateEdit.php" enctype="multipart/form-data">
            <table class="table table-bordered table-sm table-info">
                <tbody>
                <?php
                    $sql = "SELECT `mId`, `mName`, `mGender`, `mBirth`, `mLocation`, `mWishGender`, `mWishDescription`, `mImg` FROM `members` WHERE `mId` = ?";

                    $arrParam = [
                        (int)$_GET['mId']
                    ];

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    if ($stmt->rowCount() > 0){
                        $arr = $stmt->fetchAll()[0];
                        ?>
                        <thead>
                            <tr>
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
                            <tr>
                                <td>
                                    <input type="text" name="mName" id="mName" value="<?php echo $arr['mName']; ?>" maxlength="10">
                                </td>
                                <td>
                                    <select name="mGender" id="mGender">
                                        <option value="<?php echo $arr['mGender']; ?>" selected><?php echo $arr['mGender']; ?></option>
                                        <option value="男">男</option>
                                        <option value="女">女</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="mBirth" id="mBirth" value="<?php echo $arr['mBirth']; ?>" maxlength="10" />
                                </td>
                                <td>
                                    <select name="mLocation" id="mLocation">
                                        <option value="<?php echo $arr['mLocation']; ?>" selected><?php echo $arr['mLocation']; ?></option>
                                        <option value="北部">北部</option>
                                        <option value="中部">中部</option>
                                        <option value="南部">南部</option>
                                        <option value="東部">東部</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mWishGender" id="mWishGender">
                                    <option value="<?php echo $arr['mWishGender']; ?>" selected><?php echo $arr['mWishGender']; ?></option>
                                        <option value="男">男</option>
                                        <option value="女">女</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="mWishDescription"><?php echo $arr['mWishDescription']; ?></textarea>
                                </td>
                                <td>
                                <?php 
                                    if($arr['mImg'] !== NULL){
                                    ?>
                                        <img class="w200px" src="./files/<?php echo $arr['mImg']; ?>">

                                    <?php
                                    }
                                ?>
                                    <input type="file" name="mImg" />
                                </td>
                                <td>
                                    <a href="./delete.php?mId=<?php echo $arr['mId'] ?>">刪除</a>
                                </td>
                            </tr>
                </tbody>
                        <?php
                    } else {
                    ?>
                        <tr>
                            <td class="border" colspan="8">沒有資料</td>
                        </tr>
                    <?php
                    }
                ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <input type="submit" name="smb" value="修改">
                        </td>
                    </tr>
                </tfoot>


            </table>
            <input type="hidden" name="mId" value="<?php echo (int)$_GET['mId'] ?>">

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
