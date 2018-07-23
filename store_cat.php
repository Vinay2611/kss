<div class="kss-r2 col-md-9 pull-right">
    <div class="cat-list main-cat">
        <?php
        $stm = $con->prepare("select * from store_categories where featured = '1' and status= '1' and parent_id='0'");
        $stm->execute();
        $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
        $first_cat=$cat_res[0]['id'];
        foreach ($cat_res as $cr){

            if($cr['id']==1)
            {
                $class="active";
            } else {
                $class="";
            }
            ?>

            <a href="javascript:void(0);" class="<?php echo $class;?>"class="active" data-val="<?php echo $cr['id'];?>" onclick="CatClicked(<?php echo $cr['id'];?>)"><span><?php echo $cr['name']?></span></a>
            <?php
        }
        ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="kss-r3 col-md-12">
    <div class="cat-list sub-cat">
       <!-- <?php
/*        $stm = $con->prepare("select * from store_categories where featured = '1' and status= '1' and parent_id='$first_cat'");
        $stm->execute();
        $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cat_res as $cr){
            */?>
            <a href="javascript:void(0);" onclick="SubCatClicked(<?php /*echo $cr['id'];*/?>)"><span><?php /*echo $cr['name']*/?></span></a>
            --><?php
/*        }
        */?>
    </div>
</div>
<div class="clearfix"></div>