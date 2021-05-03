<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-2</title>
</head>
<body>
<!-- echo 是輸出資料的語法，不用加括號，類似print -->
<?php echo "每天都被自己帥醒，壓力好大!" ?>

<?php
//單行註解
/**
 * 1.
 * 2.
 * 3.
 */

?>

<?php for($i=0;$i<10;$i++){ ?>
<div><?php echo $i ?></div>
<?php } ?>



<?php
echo "<hr>";
echo "Hello World! <br>";
echo "Hello PHP!";
?>
</body>
</html>