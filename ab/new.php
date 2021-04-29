<?php
    require_once("./checkSession.php"); //引入判斷是否登入機制
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Document</title>
    <style>
        .tb_width {
            width: 1300px;
        }
    </style>
</head>

<body>
    <div class="tb_width m-4">
        <?php require_once("./templates/title.php"); ?>

        <form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">
            <table class="table table-bordered table-sm table-info">
                <thead>
                    <tr>
                        <th>學號</th>
                        <th>姓名</th>
                        <th>性別</th>
                        <th>生日</th>
                        <th>手機號碼</th>
                        <th>個人描述</th>
                        <th>上傳照片</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="studentId" id="studentId" value="" maxlength="9" />
                        </td>
                        <td>
                            <input type="text" name="studentName" id="studentName" value="" maxlength="10" />
                        </td>
                        <td>
                            <select name="studentGender" id="studentGender">
                                <option value="男" selected>男</option>
                                <option value="女">女</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="studentBirthday" id="studentBirthday" value="" maxlength="10" />
                        </td>
                        <td>
                            <input type="text" name="studentPhoneNumber" id="studentPhoneNumber" value="" maxlength="10" />
                        </td>
                        <td>
                            <textarea name="studentDescription"></textarea>
                        </td>
                        <td>
                            <input type="file" name="studentImg" />
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border" colspan="7"><input type="submit" name="smb" value="新增"></td>
                    </tr>
                </tfoot>
            </table>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>