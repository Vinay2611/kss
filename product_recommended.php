<?php include_once "head.php";?>
<style>
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }

    .icon-addon {
        position: relative;
        color: #555;
        display: block;
    }

    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }

    .icon-addon:after {
        clear: both;
    }

    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon,
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        right: 10px;
        font-size: 16px;
        width: 20px;
        margin-right: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 0px
    }
    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-right: 30px;
        float: right;
        font-weight: normal;
    }

    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: #2580db;
    }



</style>
<div class="kss-container">
    <div class="kss-store">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded">
            </div>
            <div class="kss-header">
                <?php include_once "store_header.php"; ?>
            </div>
            <div class="col-sm-6 col-md-offset-3 text-center">
                <div class="col-sm-12" style="    background: rgba(1, 1, 1, 0.41);    color: white;    padding: 8px;">
                    <b style="text-decoration: underline;">Recommended Products</b>

                </div>
            </div>
            <div class="clearfix"></div><br><br>
            <div class="kss-store-main">

                <div class="product-list2 col-md-10 col-md-offset-1" style="margin-bottom: 10px;position: relative;z-index: 100;min-height: 235px;">
                    <?php
                    $stm = $con->prepare("select * from product");
                    $stm->execute();
                    //$prd_res = $stm->fetch(PDO::FETCH_ASSOC);
                    while($prd = $stm->fetch(PDO::FETCH_ASSOC))
                    {
                        $prd_id=$prd['id'];
                        $store_stm = $con->prepare("select * from store_categories where id=$prd_id");
                        $store_stm->execute();
                        $store_category = $store_stm->fetch(PDO::FETCH_ASSOC);
                        $cat_name=$store_category['name'];
                        $cat_id=$store_category['id'];

                        $product_image = $con->prepare("select * from product_img where product_id=$prd_id");
                        $product_image->execute();
                        $product_img = $product_image->fetch(PDO::FETCH_ASSOC);
                        $images=$product_img['img_name'];



                        ?>
                        <div class="prd-bx col-md-2 col-sm-3 col-xs-6 ">
                            <div class="img_bx">
                                <a href="product_detail.php?id=<?php echo $prd['id'] ?>"> <img
                                            src="uploads/products/<?php echo $images ?>"></a>
                            </div>
                            <a href="product_detail.php?id=<?php echo $prd['id'] ?>">
                                <div class="shop-now">Shop Now</div>
                            </a>
                            <span><?php echo count(json_decode($prd['color'])) ?>Colors</span>
                            <hr>
                            <span class="prd-name"><?php echo $prd['title']; ?></span><br>
                            <span class="prd-cat"><?php echo $cat_name; ?></span><br>
                            <span class="prd-price">$<?php echo $prd['sale_price']; ?></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>

            </div>
            <div class="col-md-offset-9 col-md-3">
                <a href="checkout.php" class="skipandcheckout" onclick="addon();">Skip And CheckOut</a>

            </div>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <?php include_once "store_footer.php";?>
            </div>
        </div>
        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">
            <?php include_once "adv_section.php";?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    activePage='store';
    currentCat=<?php echo isset($_GET['cid'])?$_GET['cid']:0?>;
    currentSubCat=<?php echo isset($_GET['sid'])?$_GET['sid']:0?>;
    searchTxt='<?php echo isset($_GET['search'])?$_GET['search']:''?>';
    backPage="index.php"
</script>

<?php include_once "include_bottom.php"?>

<script>
$(document).ready(function()
{
    alert("Yours selected add-on-package will appear in next page...!!");
});

</script>