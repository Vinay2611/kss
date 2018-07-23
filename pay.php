<?php include_once "head.php";
if(isset($_GET['token']) && count($_GET)>0 && isset($_GET['token']))
{
    if(isset($_SESSION["TransactionData"])){
        $statement = $con->prepare("select * from transactions where token = :token");
        $statement->execute(array(':token' => $_GET['token']));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($statement->rowCount()>0){
            $statement = $con->prepare("update transactions set payment_status=:pay_status,payment_id=:payment_id,payer_id=:payer_id where token = :token");
            $statement->execute(array(':pay_status' => 'Complete',
                ':payment_id' => $_GET['paymentId'],
                ':payer_id' => $_GET['PayerID'],
                ':token' => $_GET['token']));
            $t_data="";
            $payment_id=$_GET['paymentId'];
            foreach ($_SESSION['TransactionData']["cart_items"] as $item) {
                $qty=$item['quantity'];
                $pid=$item['id'];
                $iname=$item['name'];
                $size=$item['size'];
                $price=$item['price'];
                $color=$item['color'];
                $itotal=$item['total'];
                $item_type=$item['item_type'];
                $item_description=$item['item_description'];
                $discount=$item['discount'];

                $stmt = $con->prepare("INSERT INTO orders (transaction_id,item_id,item_type,item_description,`name`,`size`,color,quantity,price,discount,total) 
                                            VALUES (:transaction_id,:item_id,:item_type,:item_description,:name,:size,:color,:quantity,:price,:discount,:total)");
                $stmt->bindParam(':transaction_id', $row["id"]);
                $stmt->bindParam(':item_id', $pid);
                $stmt->bindParam(':item_type', $item_type);
                $stmt->bindParam(':item_description', $item_description);
                $stmt->bindParam(':name', $iname);
                $stmt->bindParam(':size', $size);
                $stmt->bindParam(':color', $color);
                $stmt->bindParam(':quantity', $qty);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':discount', $discount);
                $stmt->bindParam(':total', $itotal);
                $stmt->execute();

                if($item['item_type']=="product"){
                    $statement = $con->prepare("update product set current_stock=current_stock-$qty where id = $pid");
                    $statement->execute();
                    $t_data.="<tr><td><b>Product Name:</b>$iname<br><b>Product Size:</b>$size<br><b>Product Color:</b>$color</td>
                                <td>$qty</td>
                                <td>$price</td>
                                <td>$itotal</td>
                                </tr>";
                }else{
                    $t_data.="<tr><td><b>Name:</b>$iname<br><b>Type:</b>$item_type<br><b>Description:</b>$item_description</td>
                                <td>$qty</td>
                                <td>$price</td>
                                <td>$itotal</td>
                                </tr>";
                }
            }
            $shipping_total=$row["shipping"];
            $tax_total=$row["tax"];
            $total=$row["total"];
            $tble_data="<tr><td colspan='3'>Shipping</td><td>$shipping_total</td></tr>";
            $tble_data.="<tr><td colspan='3'>Tax</td><td>$tax_total</td></tr>";
            $tble_data.="<tr><td colspan='3'>Order Total</td><td>$total</td></tr>";


            $subject = 'KSS Product Order Notification';
            $msg1    = "Your Order has been Placed Successfully<br>Thanks for your order!<br>
                                    Your Order No. is - $payment_id <br><br>
                                    <table>
                                    <tr><th>Description</th><th>Quantity</th><th>Price</th><th>Total</th></tr>
                                    $t_data.$tble_data
                                    </table>";

            if (send_mail(array($_SESSION["useremail"]), $subject, $msg1)) {

            } else {

            }


            unset($_SESSION["TransactionData"]);
            unset($_SESSION["cart_item"]);
        }else{
            echo "Invalid Request";
            die;
        }
    }else{
        echo "Invalid Request";
        die;
    }
}else{
    echo "Invalid Request";
    die;
}
?>
    <div class="kss-container">
        <div class="kss-home kss-cm-bx">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded">
                </div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <img src="images/logo.png" alt="Kss" title="Logo">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-8 hidden-xs kss-menu">
                        <div class="">
                            <a class="kss-btn" href="aboutus.php">About</a>
                            <a class="kss-btn" href="contactus.php">Contact</a>
                            <a class="kss-home-btn" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 hidden-xs kss-user">
                        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                            ?>
                            <div style="    font-size: 18px; margin-top: 40px;   font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                            <div><?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></div>
                            <?php
                        } else{
                            ?>
                            <form class="LoginForm"><input type="text" placeholder="USERNAME" required name="username">
                                <input type="password" placeholder="PASSWORD" required name="password">
                                <input type="hidden" name="reqtype" value="Login">
                                <input type="submit" class="SubmitBtn" value="Login"><br></form>
                            WITHOUT AN ACCOUNT ?<br>
                            <a href="register.php" class="join-us-btn">JOIN US</a><br>
                            <a href="forget-password.php">FORGET PASSWORD</a>
                            <?php
                        }?>

                    </div>
                    <div class="visible-xs col-xs-2 pull-right" style="cursor:pointer;margin-top: 3%;"><i class="fa fa-bars" style="font-size: 35px;" aria-hidden="true"></i></div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 kss-mobile-show kss-user" >
                        <div class="kss-menu">
                            <a class="kss-btn" href="aboutus.php">About</a>
                            <a class="kss-btn" href="contactus.php">Contact</a>
                            <a class="kss-home-btn" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>

                        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                            ?>
                            <div style="    font-size: 18px; font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                            <div><?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></div>
                            <?php
                        } else{
                            ?>
                            <form class="LoginForm"><input type="text" placeholder="USERNAME" required name="username">
                                <input type="password" placeholder="PASSWORD" required name="password">
                                <input type="hidden" name="reqtype" value="Login">
                                <input type="submit" class="SubmitBtn" value="Login"><br></form>
                            WITHOUT AN ACCOUNT ?<br>
                            <a href="register.php" class="join-us-btn">JOIN US</a><br>
                            <a href="forget-password.php">FORGET PASSWORD</a>
                            <?php
                        }?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-r2">
                    <div class="kss-content">
                        <div class="col-md-12" style="font-weight: 700; background: gainsboro;"> <h3>Your order has been placed successfully!<br>
                                Your Order No. is - <b><?php echo $payment_id?></b><br>
                            </h3>
                            <br>
                            <h4>
                                Please check your email for order detail!<br>
                                Thanks for your order !
                            </h4>
                    </div>
                  </div>
                    <div class="clearfix"></div>
                </div>
                <div class="kss-footer">
                    <?php include_once "footer.php";?>
                </div>
            </div>
            <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">
                <?php include_once "adv_section.php";?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include_once "include_bottom.php"?>

<script>
    $(function () {
        setTimeout(function () {
           // location.href="index.php";
        },7000)
    })
</script>
