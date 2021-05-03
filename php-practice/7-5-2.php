<?php
if ($_FILES["fileUpload"]["error"]===0){

    $fileName = $_FILES["fileUpload"]["name"];
    $arr = explode(".", $fileName);
    $extension = $arr[count($arr)-1]; //副檔名

    $fileName = date("YmdHis"); //檔名=時間
    $fileName = $fileName . "." . $extension; //串接檔名:時間.副檔名

    $isSuccess = move_uploaded_file(
        $_FILES["fileUpload"]["tmp_name"],
        "./tmp/{$fileName}"
    );

    if( $isSuccess ) {
        echo "上傳成功!!<br>";
        echo "檔案名稱: ".$_FILES["fileUpload"]["name"]."<br>";
        echo "檔案類型: ".$_FILES["fileUpload"]["type"]."<br>";
        echo "檔案大小: ".$_FILES["fileUpload"]["size"]."<br>";
        } else { //檔案移動失敗，則顯示錯誤訊息
        echo "上傳失敗…<br>";
        echo "<a href='javascript:window.history.back();'>回上一頁
        </a>";
        }
        
}