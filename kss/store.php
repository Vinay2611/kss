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
            <div class="clearfix"></div>
            <div class="kss-store-main">
                <?php include_once "store_cat.php"; ?>
                <div class="kss-r4 col-md-6 col-xs-12">
                   Free Shipping on purchase of $50 or more
                </div>
                <div class="clearfix"></div>
                <div class="kss-r5 col-md-6 col-xs-12 pull-right ">
                    <a href="">Shipping and delivery policy</a>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="product-list " style="margin-bottom: 10px;position: relative;z-index: 100;min-height: 235px;">
                    <?php
/*                    $stm = $con->prepare("select p.*,i.img_name,c.name as cat_name from product as p INNER join store_categories as c on c.id=p.category inner join (select * from product_img group by product_id) as i on p.id= i.product_id");
                    $stm->execute();
                    $prd_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($prd_res as $prd){
                        */?><!--
                        <div class="prd-bx col-md-2 col-sm-3 col-xs-6 ">
                            <div class="img_bx">
                                <a href="product_detail.php?id=<?php /*echo $prd['id']*/?>"> <img src="uploads/products/<?php /*echo $prd['img_name']*/?>"></a>
                            </div>
                            <a href="product_detail.php?id=<?php /*echo $prd['id']*/?>"><div class="shop-now">Shop Now</div></a>
                            <span><?php /*echo count(json_decode($prd['color']))*/?>Colors</span>
                            <hr>
                            <span class="prd-name"><?php /*echo $prd['title'];*/?></span><br>
                            <span class="prd-cat"><?php /*echo $prd['cat_name'];*/?></span><br>
                            <span class="prd-price">$<?php /*echo $prd['sale_price'];*/?></span>
                        </div>
                        --><?php
/*                    }
                    */?>
                <div class="clearfix"></div>
            </div>
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
    backPage="index.php";
    RunStoreAjax=true;
</script>
<?php include_once "include_bottom.php"?>

