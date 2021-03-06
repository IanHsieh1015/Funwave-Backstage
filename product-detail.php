<?php
if(isset($_GET["id"])){
    $product_id=$_GET["id"];
}else{
    $product_id=0;
}

require_once ("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$sql="SELECT * FROM(
    (products INNER JOIN big_cats 
    ON products.big_cat_id = big_cats.big_cat_id
    )
INNER JOIN small_cats
ON products.small_cat_id = small_cats.small_cat_id
)
INNER JOIN colors 
ON products.color_id = colors.color_id  WHERE product_id='$product_id'";

$stmt = $db_host->prepare($sql);
$num_rows = $stmt->fetchColumn();

try {
    $stmt->execute();
    $row = $stmt->fetch();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Product Content</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

    <style>
        .des{
            height: 300px;
            word-break:break-word; word-wrap:break-word;
            overflow: auto;
        }
        .pic{
            max-width: 390px;
            max-height: 390px;
           
        }
        .picout{
            border: 1px solid #cccc;
            width: 82%;
            max-height: 400px;
            min-height: 400px;
            margin: 0px;
        }

        .desc{
            height: 300px;
            word-break:break-word; word-wrap:break-word;
            overflow: auto;
        }
        /* .mybutton{
            width: 320px;
            height: 48px;
            font-size: 13pt;
            font-weight: bold;
            text-align: center, center;
        } */

        .color_grey{
            color: grey;
        }
    </style>

</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php require_once("./public/admin-header-logined.php") ?>

            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <!--/menu-->

        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="product-list.php" class="btn btn-primary">??????????????????</a>
            </div>
        </div>

        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <?php if($num_rows===0): ?>
                    ???????????????
                <?php else:
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/addCoach.php" method="post">
                        
                        <div class="col-md-5 mb-3">
                            <label for="name" class="form-label">????????????</label>
                            <input type="text" class="form-control" id="name" name="product_name" placeholder="<?=$row["product_name"]?>" readonly>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="item" class="form-label">??????</label>
                            <input type="text" class="form-control" id="item" name="product_item" placeholder="<?=$row["product_item"]?>" readonly>

                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="bigcat" class="form-label">?????????</label>
                            <select id="bigcat" name="big_cat_id" class="form-select color_grey" required aria-label="select example" disabled>
                                <option selected><?=$row["big_cat"]?></option>
                                <option value="1">?????????</option>
                                <option value="2">???????????????</option>
                                <option value="3">????????????</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="smallcat" class="form-label">?????????</label>
                            <select id="smallcat" name="small_cat_id" class="form-select color_grey" required aria-label="select example" disabled>
                                <option selected><?=$row["small_cat"]?></option>
                                <option value="1">??????</option>
                                <option value="2">??????</option>
                                <option value="3">?????????</option>
                                <option value="4">????????????</option>
                                <option value="5">????????????</option>
                                <option value="6">?????????</option>
                                <option value="7">????????????</option>
                                <option value="8">??????T</option>
                                <option value="9">??????</option>
                            </select>
                        </div>

                        
                        <div class="col-md-10">
                            <label for="photo" class="form-label">????????????</label>
                        </div>
                        <div class="picout col-md-10 d-flex justify-content-center align-items-center rounded mb-3">
                            <div>
                                <img src="./images/product/<?=$row["product_image"]?>" alt="?????????????????????" class="rounded pic">
                            </div>
                        </div> 

                        <div class="col-md-5 mb-3">
                            <label for="colorchoose" class="form-label">??????</label>
                            <select id="colorchoose" name="color_id" class="form-select color_grey" required aria-label="select example" disabled>
                                <option selected><?=$row["color"]?></option>
                                <option value="1">??????</option>
                                <option value="2">??????</option>
                                <option value="3">??????</option>
                                <option value="4">??????</option>
                                <option value="5">??????</option>
                                <option value="6">??????</option>
                                <option value="7">??????</option>
                                <option value="8">??????</option>
                                <option value="9">??????</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="size" class="form-label">??????</label>
                            <input type="text" class="form-control" id="size" name="product_size" placeholder="<?=$row["product_size"]?>" readonly>
                        </div>

                        <div class="col-md-10 mb-3">
                            <label for="describe" class="form-label">????????????</label>
                            <div class=""> 
                                <textarea class="form-control color_grey" id="describe" rows="10" name="product_describe" readonly><?=$row["product_describe"]?></textarea>  
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="price" class="form-label">??????</label>
                            <input type="text" class="form-control color_grey" id="price" name="product_price" value="<?=$row["product_price"]?>" placeholder="???????????????" readonly>
                        </div>
                        
                        <div class="col-md-5 mb-3">
                            <label for="stock" class="form-label">?????????</label>
                            <input type="text" class="form-control color_grey" id="stock" name="product_stock" value="<?=$row["product_stock"]?>" placeholder="??????????????????" readonly>
                        </div>
                        
                        <!-- <div class="col-10 mb-2">
                            <hr size="3px" width="100%">
                        </div> -->
                        
                        <div class="col-10 d-flex justify-content-end ">

                            <a role="button" href="./product-edit.php?id=<?=$product_id?>" class="mybutton btn btn-primary">??????????????????</a>

                        </div>

                    
                    </form>
                <?php endif; ?>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>

