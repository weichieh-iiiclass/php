<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
    <style>
    table {
        border: 1px solid ;
    }
    thead th{
        border: 1px dashed ;
    }
    tbody td{
        border: 1px dashed ;
    }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>姓名
                </td>
            </tr>
        </thead>
        <tbody>
        <?php 
        $arrStudent = ["Alex","Bill","Carl","Darren"];
        //count() 函式幫助我們計算陣列的長度
        for($i=0; $i<count($arrStudent); $i++){
            echo "<tr><td>".$arrStudent[$i]."</td></tr>";
        }
        ?>
            
        </tbody>
    </table>
</body>

</html>