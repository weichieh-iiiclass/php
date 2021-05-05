<?php
require_once './checkSession.php';
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
        <form name="newMember" method="POST" action="./insert.php" enctype="multipart/form-data">
            <table class="table table-bordered table-sm table-info">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>性別</th>
                        <th>生日</th>
                        <th>所在地</th>
                        <th>期望性別</th>
                        <th>期望特質與描述</th>
                        <th>上傳照片</th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <input type="text" name="mName" id="mName" value="" maxlength="10">
                    </td>
                    <td>
                        <select name="mGender" id="mGender">
                            <option value="男" selected>男</option>
                            <option value="女">女</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="mBirth" id="mBirth" value="" maxlength="10" />
                    </td>
                    <td>
                        <select name="mLocation" id="mLocation">
                            <option value="北部" selected>北部</option>
                            <option value="中部">中部</option>
                            <option value="南部">南部</option>
                            <option value="東部">東部</option>
                        </select>
                    </td>
                    <td>
                        <select name="mWishGender" id="mWishGender">
                            <option value="男" selected>男</option>
                            <option value="女">女</option>
                        </select>
                    </td>
                    <td>
                        <textarea name="mWishDescription"></textarea>
                    </td>
                    <td>
                        <input type="file" name="mImg" />
                    </td>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border" colspan="7"><input type="submit" name="smb" value="新增"></td>
                    </tr>
                </tfoot>
            </table>
    
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