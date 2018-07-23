<?php include_once "head.php";
?>
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
                <br>
            </div>
            <div class="kss-prd-view" style="position: relative;">
                <div class="kss-s-bag col-md-6 col-sm-6 col-xs-12 pull-right" style="    z-index: 1000;">
                    <a class="ShowCartList" href="javascript:void(0);"><i class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 30px;"></i> &nbsp;<span class="hidden-xs">Shopping</span> Bag (<span class="TotalCartItems"></span>)</a>
                 &nbsp;&nbsp;
                    <a href="checkout.php" class="add-to-bag" style="color:white;">Checkout&nbsp;</a>


                </div>
               <div class="CartList">

               </div>
                <div class="clearfix"></div>
                <div class="prd-view" style="margin-top: 15px;">
                    <?php
                    if(isset($_GET['id']) && !empty($_GET['id'])) {
                        $p_id=$_GET['id'];
                        $stm = $con->prepare("select p.*,i.img_name,c.name as cat_name from product as p INNER join store_categories as c on c.id=p.category inner join (select * from product_img group by product_id) as i on p.id= i.product_id where p.id='$p_id'");
                        $stm->execute();
                        $prd_res = $stm->fetch(PDO::FETCH_ASSOC);
                        if ($stm->rowCount()>0) {
                            ?>
                            <div class="col-md-6 col-sm-6 text-center">
                                <img src="uploads/products/<?php echo $prd_res['img_name']?>">
                            </div>
                            <div class="col-md-6 col-sm-6 prd-choice">
                                <form action="" id="ProductDetailForm">
                                    <span
                                        style="font-weight: 700;color: #504a4a;font-size: 16px;"> <?php echo $prd_res['title']?> - FOR <?php echo $prd_res['cat_name']?> <br> $<?php echo $prd_res['sale_price']?></span>
                                    <br>
                                    <div class="custom-form">
                                        <input type="hidden" name="id" value="<?php echo $prd_res['id']?>">
                                        <input type="hidden" name="reqtype" value="add">
                                        <input type="hidden" name="item_type" value="product">
                                       <!--<select name="color">
                                                <option value="purple">PURPLE</option>
                                                <option value="purple">GREEN</option>
                                                <option value="purple">BLACK</option>
                                           </select>
                                        -->
                                        <div class="clearfix"></div>
                                        Color &nbsp;
                                        <?php
                                        $j=0;
                                        foreach (json_decode($prd_res['color']) as $co){
                                        ?>
                                        <div class="pull-right PrdColorBox <?php echo $j==0?'color-selected':''; ?>" data-val="<?php echo $co;?>" style="height: 30px;width: 30px; margin-left: 2px; background-color: <?php echo $co;?>"></div>
                                            <?php if($j==0){
                                                ?>
                                                <input type="hidden" name="color" id="PrdColor" value="<?php echo $co;?>">
                                                <?php
                                            }
                                            $j++;
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        <br>
                                        Size &nbsp;
                                         <select style="width: 60%;" name="size">
                                           <?php
                                           foreach (explode(",",$prd_res['size']) as $s){
                                               ?>
                                               <option value="<?php echo $s;?>"><?php echo $s;?></option>
                                            <?php
                                           }
                                           ?>
                                        </select><br>
                                        QTY &nbsp;<input type="number" name="quantity" min="1" max="100" value="1">
                                    </div>
                                    <a href="javascript:void(0);" class="add-to-bag" id="AddToCart">Add to Bag</a>&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:void(0);" data-val="<?php echo $prd_res['id']?>" class="add-to-wish"><i class="fa fa-gift" aria-hidden="true"></i>&nbsp;Add to
                                        wish list</a>
                                    <br> <br>
                                    <span style="font-weight: 700;">DESCRIPTION</span>
                                    <span><?php echo $prd_res['description']?></span>
                                    <br>
                                    <!--<span style="font-weight: 700;">PRODUCT CODE</span> <span>982134825</span>-->
                                </form>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                        <?php }
                    }
                    ?>
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
    activePage='product_view';
    searchTxt="";
    $(function () {
        $.ajax({
            type	: "POST",
            url	: "lib/my_cart.php",
            dataType : 'json',
            data	:{
                reqtype:'get'
            },
            success	: function (resp) {
                if(resp.success){
                    $(".TotalCartItems").html(resp.total_item);
                    $items="";
                    if(resp.cart_items.length>0){
                        for(var i=0; i<resp.cart_items.length;i++){
                            $items+='<tr><td>'+resp.cart_items[i]['name']+'</td>' +
                                '<td>'+resp.cart_items[i]['price']+'</td>' +
                                '<td>'+resp.cart_items[i]['quantity']+'</td>' +
                                '<td>'+resp.cart_items[i]['sub_total']+'</td>' +
                                '</tr>'
                        }
                    }else{
                        $items='<tr><td colspan="4">No Item Available</td></tr>';
                    }
                    $('.CartList').html('<table width="100%"  class="table">'+
                        '<tr>'+
                        '<th> Name </th>'+
                        '<th>Price</th>'+
                        '<th>Quantity</th>'+
                        '<th>Total</th>'+
                        '</tr>'+
                        $items+
                        '<tr>'+
                        '<td colspan="3">Total Discount</td>'+
                    '<td>'+resp.total_discount+'</td>'+
                    '</tr>'+
                    '<td colspan="3">Cart Total</td>'+
                    '<td>'+resp.SubTotal+'</td>'+
                    '</tr>' +
                        '<tr><td colspan="4"><a class="add-to-bag" href="checkout.php">Checkout</a></td></tr>'+
                    '</table>')
                }else{
                }
            }
        });
    });
</script>

<script>
    RunStoreAjax=true;
</script>
<?php include_once "include_bottom.php"?>

