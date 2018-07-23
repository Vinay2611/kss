<div class="kss-col2-inner">
   <!-- <?php
/*    $stm = $con->prepare("select * from advertisement where featured = '1' and status= '1' order by order_no");
    $stm->execute();
    $adv_res = $stm->fetchAll(PDO::FETCH_ASSOC);
    $total_ad=count($adv_res);

    foreach ($adv_res as $sr){
        */?>
        <a href="<?php /*echo $sr['link']*/?>">
            <img src="uploads/col2-img/<?php /*echo $sr['image']*/?>">
        </a>
        --><?php
/*    }
    */?>
</div>

<script>
    var page=1;
    $(function () {
        GetAdv();
        setInterval(function(){
            GetAdv();
        },8000);
    });
    function GetAdv(){
        $.ajax({
            type	: "POST",
            url	: "lib/ServerResponse.php",
            dataType : 'json',
            data	:{
                reqtype:'GetAdvertisement',
                page:page

            },
            success	: function (resp) {
                if(resp.success){
                    if(resp.count>0){
                        $(".kss-col2-inner").html('');
                        console.log(resp.data);
                        for($i=0;$i<resp.data.length;$i++){
                            $dtt=resp.data;
                            $(".kss-col2-inner").append('<a href="'+$dtt[$i]['link']+'">'+
                                '<img src="uploads/col2-img/'+$dtt[$i]['image']+'">'+
                                '</a>');
                        }
                    }
                    if(resp.count<4){
                        page=1;
                    }else{
                        page++;
                    }

                }else{

                }
            }
        });
    }
</script>