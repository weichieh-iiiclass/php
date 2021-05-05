<?php
session_start();
require_once './db.inc.php';
require_once './templates/tpl-header.php';
?>

<!-- tpl-order.php -->
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="border-0 bg-light">
                            <div class="p-2 px-3 text-uppercase">訂單編號</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                            <div class="p-2 px-3 text-uppercase">成立時間</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase">詳細資訊</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $sqlOrder = "SELECT `orderId`,`created_at`
                            FROM `orders` 
                            WHERE `username` = ? 
                            ORDER BY `orderId` DESC";
                $stmtOrder = $pdo->prepare($sqlOrder);
                $stmtOrder->execute([$_SESSION['username']]);
                if($stmtOrder->rowCount() > 0){
                    $arrOrders = $stmtOrder->fetchAll();
                    for($i=0; $i<count($arrOrders); $i++){
                    ?>
                        <tr>
                            <td class="border-0">
                                <h1><span class="badge badge-secondary"><?php echo $arrOrders[$i]["orderId"] ?></span></h1>
                            </td>
                            <td class="border-0">
                                <?php echo $arrOrders[$i]['created_at']; ?>
                            </td>
                            <td class="border-0 align-middle">
                            <?php
                                $sqlItemList = "SELECT `item_lists`.`checkPrice`,`item_lists`.`checkQty`,`item_lists`.`checkSubtotal`,
                                `items`.`itemName`,`categories`.`categoryName`
                                FROM `item_lists` 
                                INNER JOIN `items`
                                ON `item_lists`.`itemId` = `items`.`itemId`
                                INNER JOIN `categories` 
                                ON `items`.`itemCategoryId` = `categories`.`categoryId`
                                WHERE `item_lists`.`orderId` = ? 
                                ORDER BY `item_lists`.`itemListId` ASC";
                                $stmtItemList = $pdo->prepare($sqlItemList);
                                $arrParamItemList = [
                                    $arrOrders[$i]['orderId']
                                ];
                                $stmtItemList->execute($arrParamItemList);
                                if($stmtItemList->rowCount() > 0){
                                    $arrItemList = $stmtItemList->fetchAll(); //??????? //PDO::FETCH_ASSOC
                                    for($j=0; $j<count($arrItemList); $j++){
                                    ?>
                                    <div class="jumbotron">
                                        <p>商品名稱: <?php echo $arrItemList[$j]["itemName"] ?></p>
                                        <p>商品種類: <?php echo $arrItemList[$j]["categoryName"] ?></p>
                                        <p>單價: <?php echo $arrItemList[$j]["checkPrice"] ?></p>
                                        <p>數量: <?php echo $arrItemList[$j]["checkQty"] ?></p>
                                        <p>小計: <?php echo $arrItemList[$j]["checkSubtotal"] ?></p>
                                    </div>
                                    <?php
                                    }
                                }
                            ?>
                            
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>
                
                </tbody>

            </table>
        </div>

    </div>
</div>



<?php
require_once './templates/tpl-footer.php';
?>