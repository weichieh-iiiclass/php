<?php
// session_start(); //改寫到checkSession.php裡面
require_once './checkSession.php';
require_once './db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "訂單新增失敗";

$count = 0;

try{
    //開啟交易功能,可用於報名人數
    $pdo->beginTransaction();

        $sqlOrder = "INSERT INTO `orders` (`username`) VALUES (?)";
        $stmtOrder = $pdo->prepare($sqlOrder);
        $arrParamOrder = [
            $_SESSION['username']
        ];
        $stmtOrder->execute($arrParamOrder);

        //取得訂單最後一次新增時的流水號
        $orderId = $pdo->lastInsertId();

        //將購物車中的項目新增置資料庫中，變成訂單明細
        $sqlItemList = "INSERT INTO `item_lists` (`orderId`,`itemId`,`checkPrice`,`checkQty`,`checkSubtotal`) VALUES (?,?,?,?,?)";
        $stmtItemList = $pdo->prepare($sqlItemList);
        for( $i=0; $i<count($_POST['itemId']); $i++ ){
            $arrParamItemList = [
                $orderId,
                $_POST['itemId'][$i],
                $_POST["itemPrice"][$i],
                $_POST["cartQty"][$i],
                $_POST["subtotal"][$i]
            ];
            $stmtItemList->execute($arrParamItemList);
            $count += $stmtItemList->rowCount();
        }

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
}

header("Refresh: 3; url=./order.php");

//商品明細數量大於0，則釋放存置購物車的 session 變數
if( $count > 0 ){
    //訂單完成後，注銷購物車資訊
    unset($_SESSION['cart']);

    $objResponse['success'] = true;
    $objResponse['info'] = "訂單新增成功";
}
echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);