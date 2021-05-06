<?php
session_start();
require_once './db.inc.php';
require_once './templates/tpl-header.php';
?>

<!-- tpl-item-detail.php -->
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
        <?php
        //確定為哪個商品 從url GET ['itemId']
        //將此itemId的商品列表data與類別列表data做innerjoin
        if( isset($_GET['itemId']) ){
            $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemPrice`, 
            `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,
            `categories`.`categoryId`, `categories`.`categoryName`
            FROM `items` INNER JOIN `categories`
            ON `items`.`itemCategoryId` = `categories`.`categoryId`
            WHERE `itemId` = ? ";

            $arrParam = [
                (int)$_GET['itemId']
            ];

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            if($stmt->rowCount() > 0){
                $arrItem = $stmt->fetchAll()[0];
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row mb-3 d-flex justify-content-center">
                                <img class="item-view border" src="./images/items/<?php echo $arrItem["itemImg"]; ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p>商品名稱：<?php echo $arrItem["itemName"] ?></p>
                            <p>商品價格：<?php echo $arrItem["itemPrice"] ?></p>
                            <p>商品數量：<?php echo $arrItem["itemQty"] ?></p>
                            <!-- 在form裡面使用3個input傳值到下個頁面 -->
                            <form name="cartForm" id="cartForm" method="POST" action="./addCart.php">
                                <label>數量：</label>
                                <!-- 設定要購買的數量 將值以名為cartQty的input做輸入 -->
                                <!-- cartQty -->
                                <input type="number" name="cartQty" value="1" maxlength="5" min="1" max="<?php echo $arrItem["itemQty"] ?>">
                                <!-- (int)$_GET['itemId'] -->
                                <input type="hidden" name="itemId" value="<?php echo (int)$_GET['itemId'] ?>">

                                <input type="submit" class="btn btn-primary btn-lg" name="smb" value="加入購物車">
                            </form>

                        </div>
                    </div>
                </div>
                <?php
            }


        }
        ?>

        </div>

    </div>

</div>


<?php
require_once './templates/tpl-footer.php';
?>