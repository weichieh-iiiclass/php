<?php
session_start();
require_once './db.inc.php';
require_once './templates/tpl-header.php';
?>

<!-- tpl-cart.php -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php
            $sql = "SELECT `categoryId`, `categoryName` FROM `categories` ";
            $stmt = $pdo->query($sql);
            if ($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll();
            ?>
                <ul>
                    <?php
                    for ($i = 0; $i < count($arr); $i++) {
                    ?>
                        <li>
                            <a href="./itemList.php?categoryId=<?php echo $arr[$i]['categoryId'] ?>"><?php echo $arr[$i]['categoryName'] ?></a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            <?php
            }
            ?>
        </div>
    
        <div class="col-md-9 col-sm-8">
            <form name="myForm" method="POST" action="./addOrder.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">商品名稱</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">價格</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">數量</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">小計</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">功能</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        //放置結合當前資料庫資料的購物車資訊
                        $arr = [];

                        $total = 0;

                        if( isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0 ){
                            //SQL 敘述
                            $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemPrice`,
                                            `categories`.`categoryId`, `categories`.`categoryName`
                                    FROM `items` INNER JOIN `categories`
                                    ON `items`.`itemCategoryId` = `categories`.`categoryId`
                                    WHERE `itemId` = ? ";

                            //比對購物車裡面所有項目的 itemId，然後透過 SQL 查詢來取得完整的資料
                            for($i = 0; $i < count($_SESSION["cart"]); $i++){
                                $arrParam = [
                                    (int)$_SESSION["cart"][$i]["itemId"]
                                ];
                                
                                //查詢
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute($arrParam);
                                
                                //若商品項目個數大於 0，則把買家購買的數量加到查詢結果當中
                                if($stmt->rowCount() > 0) {
                                    $arrItem = $stmt->fetchAll()[0];
                                    $arrItem['cartQty'] = $_SESSION["cart"][$i]["cartQty"]; //$arrItem會多一欄['cartQty]
                                    $arr[] = $arrItem; //同時，把$arrItem資料push進去$arr裡
                                } 
                            } 

                            for($i = 0; $i < count($arr); $i++) { 
                                //計算總額
                                $total += $arr[$i]["itemPrice"] * $arr[$i]["cartQty"];
                        ?>
                            <tr>
                                <th scope="row" class="border-0">
                                    <div class="p-2">
                                        <img src="./images/items/<?php echo $arr[$i]["itemImg"] ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0"><a href="#"class="text-dark d-inline-block align-middle"><?php echo $arr[$i]["itemName"] ?></a></h5>
                                            <span class="text-muted font-weight-normal font-italic d-block">Category: <?php echo $arr[$i]["categoryName"] ?></span>
                                        </div>
                                    </div>
                                </th>
                                <td class="border-0 align-middle"><strong>$<?php echo $arr[$i]["itemPrice"] ?></strong></td>
                                <td class="border-0 align-middle">
                                    <input type="text" class="form-control" name="cartQty[]" value="<?php echo $arr[$i]["cartQty"] ?>" maxlength="3">
                                </td>
                                <td class="border-0 align-middle">
                                    <input type="text" class="form-control" name="subtotal[]" value="<?php echo ($arr[$i]["itemPrice"] * $arr[$i]["cartQty"]) ?>" maxlength="10">
                                </td>
                                <td class="border-0 align-middle"><a href="./deleteCart.php?idx=<?php echo $i ?>" class="text-dark">刪除</a></td>
                            </tr>
                            <input type="hidden" name="itemId[]" value="<?php echo $arr[$i]["itemId"] ?>">
                            <input type="hidden" name="itemPrice[]" value="<?php echo $arr[$i]["itemPrice"] ?>">
                        <?php 
                            }
                        }
                        ?>
                    </tbody>
                
                </table>
                <?php if( isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0 ){ ?>
                    <div class="row d-flex justify-content-end pl-3 pr-3 pb-3">
                        <h3>目前總額: <mark id="total"><?php echo $total ?></mark></h3>
                    </div>
                    <div class="row d-flex justify-content-end pl-3 pr-3 pb-3">
                        <input class="btn btn-primary btn-lg" type="submit" name="smb" value="送出">
                    </div>
                <?php } ?>
            
            
            </form>
        
        </div>
    </div>
    


</div>

<?php
require_once './templates/tpl-footer.php';
?>