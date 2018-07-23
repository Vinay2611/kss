$(function () {
   $("#RegisterForm").submit(function (e) {
      e.preventDefault();

      if(!isValidEmailAddress($("#RegisterForm input[name=email]").val())){
         $.toaster({ priority : 'warning', title : 'Error', message : "Invalid Email Address"});
         return false;
      }

      if($("#RegisterForm input[name=password]").val()!==$("#RegisterForm input[name=conf_password]").val()){
         $.toaster({ priority : 'warning', title : 'Error', message : "Password do not match!"});
         return false;
      }

      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	:$(this).serialize(),
         success	: function (resp) {
            if(resp.success){
               console.log(resp);
               $("#RegisterForm")[0].reset();
               $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
               setTimeout(function () {
                  if($("input[name=referrer]").length>0 && $("input[name=referrer]").val()=="Store"){
                     location.href = "store.php";
                  }else {
                     location.href="index.php";
                  }
               },2000);
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });
   /*advertise*/
   $("#submit_advv").submit(function (e) {
      e.preventDefault();
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      var formData = new FormData(this);
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data: formData,
         contentType: false,
         processData: false,
         success	: function (resp) {
            if(resp.success){
               console.log(resp);
               $("#submit_advv")[0].reset();
               $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });

   $("#reset_link").submit(function (e) {
      e.preventDefault();
      console.log('aaa');
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	:$(this).serialize(),
         success	: function (resp) {
            if(resp.msg==1){
               console.log(resp);

               $.toaster({ priority : 'success', title : 'Success', message : "Your Password has been Successfully reseted,Please check your Email!!"});
               // location.reload();
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message :"Password do not match..!!"});

            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });

   $("#experience").submit(function (e) {
      e.preventDefault();
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      var formData = new FormData(this);
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data: formData,
         contentType: false,
         processData: false,
         success	: function (resp) {
            if(resp.success){
               console.log(resp);
               $("#experience")[0].reset();
               $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });

   /*advertise end*/
   $(".LoginForm").submit(function (e) {
      e.preventDefault();
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	:$(this).serialize(),
         success	: function (resp) {
            if(resp.success){
               console.log(resp);
               $(".LoginForm")[0].reset();
               $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
               if($("input[name=back_url]").length>0){
                  location.href = $("input[name=back_url]").val();
               }
               else if($("input[name=referrer]").length>0){
                  $(".kss-user").hide();
                  $(".CardHtml").show();
               }else {
                  location.href = resp.redirect;
               }
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });


   $(".ForgetPassword").submit(function (e) {
      e.preventDefault();
      console.log('testtt ttt');
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	:$(this).serialize(),
         success	: function (resp) {
            if(resp.success){
               console.log(resp);
               $(".ForgetPassword")[0].reset();
               $.toaster({ priority : 'success', title : 'Success', message : "Forget Password Mail sent Successfully!"});
               // location.reload();
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });

   $(document).on('click','#AddToCart',function () {
      if(isProcessing){return false;}
      isProcessing=true;
      $elm=$(this);
      $elm.html("Processing");
     // $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/my_cart.php",
         dataType : 'json',
         data	:$("#ProductDetailForm").serialize(),
         success	: function (resp) {
            if(resp.success){
               $elm.html('Added to Bag');
               $.toaster({ priority : 'success', title : 'Success', message : "Added to Cart"});
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
                            '<tr>'+
                           /* '<td colspan="3">Total Tax</td>'+
                            '<td>'+resp.total_tax+'</td>'+
                            '</tr>'+*/
                            '<td colspan="3">Total Shipping Charge</td>'+
                            '<td>'+resp.total_shipping+'</td>'+
                            '<tr>'+
                            '<td colspan="3">Cart Total</td>'+
                            '<td>'+resp.SubTotal+'</td>'+
                            '</tr>' +
                            '<tr><td colspan="4"><a class="add-to-bag" href="checkout.php">Checkout</a></td></tr>'+
                            '</table>');
                     }else{
                     }
                  }
               });
            }else{
               $elm.html('Add To Bag');
               isProcessing=false;
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
            }
            /*$(".loading").remove();
            $elm.show();*/
         }
      });
   });

   $(document).on('click','.add-to-wish',function () {
      $elm=$(this);
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	: {
            id:$elm.attr('data-val'),
            reqtype:'addToWish'
         },
         success	: function (resp) {
            if(resp.success){
               $.toaster({ priority : 'success', title : 'Success', message : "Added to Wish List"});
            }else{
               $elm.show();
               $(".loading").remove();
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });

   $(".updateProfile").submit(function (e) {
      e.preventDefault();
      $elm=$(".SubmitBtn");
      $elm.hide();
      $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
      $.ajax({
         type	: "POST",
         url	: "lib/ServerResponse.php",
         dataType : 'json',
         data	:$(this).serialize(),
         success	: function (resp) {
            if(resp.success){

               $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
               if($("input[name=referrer]").length>0){

                  location.reload();
               }else {
                  //location.href = resp.redirect;
               }
            }else{
               $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
               console.log(resp.msg);
            }
            $(".loading").remove();
            $elm.show();
         }
      });
   });


});



function isValidEmailAddress(emailAddress) {
   var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
   return pattern.test(emailAddress);
}
