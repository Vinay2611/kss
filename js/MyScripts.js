$(function () {
    $(".fa-bars").click(function () {
        $(".kss-mobile-show").toggle();
    });
    $('.PrdColorBox').click(function () {
        $("#PrdColor").val($(this).attr('data-val'));
        $('.PrdColorBox').removeClass('color-selected');
        $(this).addClass('color-selected');
    });

    $(".ShowCartList").click(function () {
       $(".CartList").toggle();
    });

    $("input[name=cardnumber]").keypress(function(e){
        if($(this).val().length>=16){
            e.preventDefault();
            return false;
        }
    });

    $("input[name=cvc]").keypress(function(e){
        if($(this).val().length>=3){
            e.preventDefault();
            return false;
        }
    });

    $("input[name=card_name]").keypress(function(e){
        if($(this).val().length>=40){
            e.preventDefault();
            return false;
        }
    });

    $('.carousel').carousel({
        hAlign: 'center',
        vAlign: 'center',
        hMargin: 0.9,
        vMargin: 0.2,
        frontWidth: 250,
        frontHeight: 200,
        carouselWidth: 1000,
        carouselHeight: 220,
        left: 0,
        right: 0,
        top: 0,
        bottom: 0,
        back: 0.8,
        slidesPer: 1,
        speed: 300,
        buttonNav: 'none',
        directionNav: false,
        autoplay: true,
        autoplayInterval: 3000,
        pauseOnHover: true,
        mouse: true,
        shadow: false,
        reflection: false,
        reflectionHeight: 0.2,
        reflectionOpacity: 0.5,
        reflectionColor: '255,255,255',
        description: false,
        descriptionContainer: '.description',
        backOpacity: 1,
        before: function(carousel) {},
        after: function(carousel) {}
    });

    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        lazyLoad: true,
        merge: true,
        autoplay:true,
        nav:true,
        navText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>"
        ],
        video: true,
        responsive:{
            480:{
                items:1
            },

            678:{
                items:2
            },

            960:{
                items:3
            }
        }
    });

    $("#search").keyup(function (e) {
        $txt=$(this).val();
        if(activePage=='store') {
            if (e.which == 13) {
                searchResult($txt)
            }
        }else{
            if (e.which == 13) {
                currentCat=0;
                currentSubCat=0;
                location.href="store.php?search="+$txt;
            }
        }
    });


if(RunStoreAjax==true) {
    if (searchTxt !== "") {
        $("#search").val(searchTxt);
        searchResult(searchTxt);
        $cat_id = $(".main-cat a:first-child").attr('data-val');
            getSubCat($cat_id);
        searchTxt = "";
    } else {
        if (currentCat !== 0) {
            $('.main-cat a').removeClass('active');
            $('.main-cat a').each(function () {
                if ($(this).attr('data-val') == currentCat) {
                    $(this).addClass('active');
                }
            });
            getSubCat(currentCat);
        } else {
            $cat_id = $(".main-cat a:first-child").attr('data-val');
            getSubCat($cat_id);
        }
    }
}
    $(".BackClick").click(function () {
        if(backPage==""){
            location.href="store.php";
        }else{
            location.href=backPage;
        }

    });

});

function searchResult($txt) {
    $('.main-cat a').removeClass('active');
    $('.sub-cat a').removeClass('active');
    $.ajax({
        type: "POST",
        url: "lib/ServerResponse.php",
        dataType: 'json',
        data: {
            txt: $txt,
            reqtype: 'SearchProduct'
        },
        success: function (resp) {
            if (resp.success) {
                $(".product-list").html('');
                if (resp.data.length > 0) {
                    for (var i = 0; i < resp.data.length; i++) {
                        $data = resp.data[i];
                        $('.product-list').append('<div class="prd-bx col-md-2 col-sm-3 col-xs-6 ">' +
                            '<div class="img_bx">' +
                            '<a href="product_detail.php?id=' + $data['id'] + '"> <img src="uploads/products/' + $data['img_name'] + '"></a>' +
                            '</div>' +
                            '<a href="product_detail.php?id=' + $data['id'] + '"><div class="shop-now">Shop Now</div></a>' +
                            '<span>' + JSON.parse($data['color']).length + ' Colors</span>' +
                            '<hr>' +
                            '<span class="prd-name">' + $data['title'] + '</span><br>' +
                            '<span class="prd-cat">' + $data['cat_name'] + '</span><br>' +
                            '<span class="prd-price">$' + $data['sale_price'] + '</span>' +
                            '</div>');
                    }
                } else {
                    $(".product-list").html('<div class="col-md-12">No Result found for your search!</div>');
                }

                console.log(resp.data);
            } else {
               // _toastr(resp.msg, "bottom-right", "warning", false);

            }
            //  $(".submit-loading").remove();
            // $elm.show();
        },
        error: function (data) {
        }
    });
}

function CatClicked(id){
    currentCat=id;
    $('.main-cat a').removeClass('active');
    $('.main-cat a').each(function () {
        if($(this).attr('data-val')==id){
            $(this).addClass('active');
        }
    });
    if(activePage=='store'){
        getSubCat(id);
    }else{
        getSubCat(id);
       // location.href="store.php?cid="+id;
    }
    currentSubCat=0;
}

function SubCatClicked(id){
    $('.sub-cat a').removeClass('active');
    $('.sub-cat a').each(function () {
        if($(this).attr('data-val')==id){
            $(this).addClass('active');
        }
    });
    if(activePage=='store'){
        console.log('called');
        getProducts(id);
    }else{
        if(currentCat!==0){
        }else{
            currentCat=$(".main-cat a:first-child").attr('data-val');
        }
        location.href="store.php?cid="+currentCat+"&sid="+id;
    }
}

function getSubCat(id) {
    // $elm=elm;
    // $elm.hide();
    // $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
    $.ajax({
        type: "POST",
        url: "lib/ServerResponse.php",
        dataType: 'json',
        data: {
            cat_id:id,
            reqtype:'GetSubCat'
        },
        success: function (resp) {
            if (resp.success) {
                $(".sub-cat").html('');
                if(resp.data.length>0){
                    for(var i=0;i<resp.data.length;i++){
                        $data=resp.data[i];
                        $(".sub-cat").append('<a href="javascript:void(0);" data-val="'+$data['id']+'" onclick="SubCatClicked('+$data['id']+')"><span>'+$data['name']+'</span></a>&nbsp;');
                    }
                }else{
                    $(".sub-cat").html('Sub Category Not Avaailable!');
                }

                if(currentSubCat!==0){
                    console.log('sub clicked');
                    SubCatClicked(currentSubCat);
                }else{
                    /* $cat_id=$(".sub-cat a:first-child").attr('data-val');
                     SubCatClicked($cat_id)*/
                }
            } else {
            //    _toastr(resp.msg,"bottom-right","warning",false);

            }
            //  $(".submit-loading").remove();
            // $elm.show();
        },
        error: function (data) {
        }
    });
    if(searchTxt==""){
        getProducts(id);
    }
}

function getProducts(cat_id) {
    $.ajax({
        type: "POST",
        url: "lib/ServerResponse.php",
        dataType: 'json',
        data: {
            cat_id:cat_id,
            reqtype:'GetProductsList'
        },
        success: function (resp) {
            if (resp.success) {
                $(".product-list").html('');
                if(resp.data.length>0){
                    var l = 1;
                    for(var i=0;i<resp.data.length;i++){
                        $data=resp.data[i];
                        if(l%6==1)
                        {
                            $('.product-list').append('<div class="col-md-12">');
                        }

                       $('.product-list').append('<div class="prd-bx col-md-2 col-sm-3 col-xs-6 ">'+
                           '<div class="img_bx">'+
                            '<a href="product_detail.php?id='+$data['id']+'"> <img src="uploads/products/'+$data['img_name']+'"></a>'+
                            '</div>'+
                            '<a href="product_detail.php?id='+$data['id']+'"><div class="shop-now">Shop Now</div></a>'+
                        '<span>'+JSON.parse($data['color']).length+' Colors</span>'+
                        '<hr>'+
                        '<span class="prd-name">'+$data['title']+'</span><br>'+
                        '<span class="prd-cat">'+$data['cat_name']+'</span><br>'+
                        '<span class="prd-price">$'+$data['sale_price']+'</span>'+
                        '<div class="clearfix"></div></div>');
                        if(l%6==0)
                        {
                            $('.product-list').append('</div><div class="clearfix"></div>');
                        }
                        l++;
                    }
                }else{
                    $(".product-list").html('<div class="col-md-12">No Product available in selected category!</div>');
                }

                console.log(resp.data);
            } else {
              //  _toastr(resp.msg,"bottom-right","warning",false);

            }
            //  $(".submit-loading").remove();
            // $elm.show();
        },
        error: function (data) {
        }
    });
}


function validateCard(){
    $number=$("input[name=cardnumber]");
    $cvc=$("input[name=cvc]");
    $exp_month=$("select[name=exp_month]");
    $exp_year=$("select[name=exp_year]");
    if($number.val().length>16 || $number.val().length<16){
        $number.focus();
        $.toaster({ priority : 'warning', title : 'Error', message : "Card Number Not Valid"});

        return false;
    }
    if($cvc.val().length>3 || $cvc.val().length<3){
        $cvc.focus();
        $.toaster({ priority : 'warning', title : 'Error', message : "Invalid CVC"});

        return false;
    }

    if($exp_month.val()=="" || $exp_year.val()==""){
        $exp_month.focus();
        $.toaster({ priority : 'warning', title : 'Error', message : "Please fill Expiry Month and Year!"});
        return false;
    }

    return true;
}

//Store Validation
var hcol1;
$(function () {
    $("input[name=quantity]").keypress(function(e){
        if($(this).val()==0){
            e.preventDefault();
            return false;
        }
        if (e.which < 48 || 57 < e.which)
            e.preventDefault();
    });
    $("input[name=quantity]").keyup(function(e){
        if($(this).val()==0){
            $(this).val(1);
            e.preventDefault();
            return false;
        }
    });

});


