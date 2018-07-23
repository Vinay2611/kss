<?php include_once "head.php";

if(isset($_SESSION['isLoggedIn'])){
    $UserID = $_SESSION['loggedId'];
}else{
    ?>
    <script>
        location.href="index.php";
    </script>
    <?php
}

?>

    <style>
        input,select{
            padding: 6px 8px;
            border: 0;
            background: rgba(246,246,246,0.78);
            border-radius: 7px;
            width: 100%;
        }
        #sample_5{
            background: rgba(246,246,246,0.78);
            border-radius: 7px;
        }
        .boxshadows{
            background: rgba(184,184,184,0.79);
            border-radius: 8px;
        }
    </style>

    <div class="kss-container">
        <div class="kss-home">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded"></div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                    </div>
                    <div class="pull-right">
                        <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-horizontal profile-page ">
                <div class="clearfix"></div>
                <!--edit box-->
                    <form class="form-horizontal updateProfile" id="updateProfile">
                        <?php
                        $UserID = $_SESSION['loggedId'];
                        $que="SELECT * FROM users  WHERE  id ='$UserID'";
                        $connect = $con->query($que);
                        $final = $connect->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="boxshadows col-md-4">
                            <div class="col-sm-6" style="font-size: 20px;margin-left: 30%;width: 100%">Users Profile</div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" >First Name</label>
                                <div class="col-sm-8">
                                    <input type='text' value="<?php echo $final['first_name']; ?>" name='first_name' id='first_name' required maxlength="50" placeholder="<?php echo $final['first_name']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" >Last Name</label>
                                <div class="col-sm-8">
                                    <input type='text' value="<?php echo $final['last_name']; ?>" name='last_name' id='last_name' required maxlength="50" placeholder="<?php echo $final['last_name']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" >Age</label>
                                <div class="col-sm-8">
                                    <input type='number'  value="<?php echo $final['age']; ?>" name='age' id='age' required placeholder="<?php echo $final['age']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" >Gender/Sex</label>
                                <div class="col-sm-8">
                                    <select name="sex" required>
                                        <option value="">select</option>
                                        <option <?php echo $final['sex']=="male"?'selected':''; ?> value="male">Male</option>
                                        <option <?php echo $final['sex']=="female"?'selected':''; ?> value="female">Female</option>
                                        <option <?php echo $final['sex']=="other"?'selected':''; ?> value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" >Medical Condition</label>
                                <div class="col-sm-8">
                                    <input type='text'  value="<?php echo $final['medical_condition']; ?>" name='medical_condition' id='medical_condition'  placeholder="<?php $final['medical_condition']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" >E-mail</label>
                                <div class="col-sm-8">
                                    <input type='email'  value="<?php echo $final['email']; ?>" readonly name='email' id='email' required  placeholder="<?php $final['email']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" >User Role</label>
                                <div class="col-sm-8">
                                    <input type='text' readonly value="<?php echo $final['user_role']; ?>" name='urole' id='urole' required  placeholder="<?php $final['user_role']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="reqtype" value="UpdateProfile">
                                    <input type="submit" class="save-btn SubmitBtn" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>

                <form name="bulk_action_form">
                    <div class="panel-body col-md-8 boxshadows" style="padding: 10px;">
                        <div style="font-size: 20px;width: 100%">Wish List</div>
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                            <tr>
                                <th  class="">Product Title</th>
                                <th  class="">Sale Price</th>
                                <th  class=""></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT p.* FROM users as u inner join wishlist as w on w.user_id=u.id inner join product as p on p.id=w.product_id WHERE u.id ='$UserID'";
                            $users = $con->query($sql);
                            $result = $users->fetchall(PDO::FETCH_ASSOC);

                            foreach ($result as $a){
                                ?>
                                <tr>
                                   <td><a href="product_detail.php?id=<?php echo $a['id'];?>"><?php echo $a['title'];?></td>
                                   <td><?php echo $a['sale_price'];?></td>
                                    <td><a href="javascript:void(0);" class="RemoveWished" data-val="<?php echo $a['id'];?>">Remove</td>
                                <tr>
                                <?php
                            }?>
                            </tbody>
                        </table>
                        <div style="font-size: 20px;width: 100%">My Order History</div>
                       <div style="max-height: 400px;overflow: auto"> <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                            <tr>
                                <th  class="">Item Type</th>
                                <th  class="">Item Detail</th>
                                <th  class="">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT o.* from orders as o inner join transactions as t on t.id=o.transaction_id WHERE t.user_id ='$UserID'";
                            $users = $con->query($sql);
                            $result = $users->fetchall(PDO::FETCH_ASSOC);
                            foreach ($result as $a){
                            ?>
                            <tr>
                                <td><?php echo $a['item_type'];?></td>
                                <td><?php echo $a['name']."<br>Description: ".$a['item_description']."<br>Size: ".$a['size']."<br>Color: <div style='height:20px;width:20px;background-color:".$a['color']."'></div>"."Quantity: ".$a['quantity']."<br>Price: ".$a['price'];?></td>
                                <td><?php echo $a['total'];?></td>
                            <tr>
                                <?php
                                }?>
                            </tbody>
                        </table></div>
                    </div>
                </form>
                <!--edit box end-->
            </div>
                <div class="kss-home-r3" style="margin-top: 50px;">
                    <div class="col-sm-12">Kss programs © <span style="text-transform: lowercase">all right reserved</span></div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-footer">
                    <?php include_once "footer.php";?>
                </div>
            </div>

            <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">

                    <?php include_once "adv_section.php"?>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include_once "include_bottom.php"?>


<script>
    $(function () {
        $(".RemoveWished").click(function () {
            $id=$(this).attr('data-val');
            $elm=$(this);
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            $.ajax({
                type	: "POST",
                url	: "lib/ServerResponse.php",
                dataType : 'json',
                data	:{
                    id:$id,
                    reqtype:'RemoveWish'
                },
                success	: function (resp) {
                    if(resp.success){
                        $.toaster({ priority : 'success', title : 'Success', message : "Item Removed From wishlist"});
                        $elm.parents('tr').remove();
                    }else{
                        $.toaster({ priority : 'warning', title : 'Error', message : "Please Try Again!"});
                    }
                    $(".loading").remove();
                     $elm.show();
                }
            });
        });
    });
</script>
