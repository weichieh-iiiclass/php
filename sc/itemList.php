<?php
session_start();
require_once './db.inc.php';
require_once './templates/tpl-header.php';
?>

<!-- tpl-item-list.php -->
<div class="container-fluid">
    <div class="row">
        <!-- 樹狀商品種類連結 -->
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

        <!-- 商品項目清單 -->
        <div class="col-md-9 col-sm-8">
            <div class="row">
                <?php
                //SQL 敘述
                $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemPrice`, 
                                `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,
                                `categories`.`categoryName`
                        FROM `items` INNER JOIN `categories`
                        ON `items`.`itemCategoryId` = `categories`.`categoryId`";

                //若網址有商品種類編號，則整合字串來操作 SQL 語法
                if (isset($_GET['categoryId'])) {
                    $sql .= "WHERE FIND_IN_SET(`items`.`itemCategoryId`, ?)
                            ORDER BY `items`.`itemId` ASC ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([(int)$_GET['categoryId']]);
                } else {
                    //沒有指定商品種類編號，則單純顯示全部商品
                    $sql .= "ORDER BY `items`.`itemId` ASC ";
                    $stmt = $pdo->query($sql);
                }


                //若商品項目個數大於 0，則列出商品
                if ($stmt->rowCount() > 0) {
                    $arr = $stmt->fetchAll();
                    for ($i = 0; $i < count($arr); $i++) {
                ?>
                        <div class="col-md-4 col-sm-6 filter-items" data-price="<?php echo $arr[$i]['itemPrice'] ?>">
                            <div class="card mb-3 shadow-sm">
                                <a href="./itemDetail.php?itemId=<?php echo $arr[$i]['itemId'] ?>">
                                    <img class="list-item" src="./images/items/<?php echo $arr[$i]['itemImg'] ?>">
                                </a>
                                <div class="card-body">
                                    <p class="card-text list-item-card"><?php echo $arr[$i]['itemName'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">價格：<?php echo $arr[$i]['itemPrice'] ?></small>
                                        <small class="text-muted">上架日期：<?php echo $arr[$i]['created_at'] ?></small>
                                    </div>
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
</div>

<?php
require_once './templates/tpl-footer.php';
?>