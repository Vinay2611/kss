<?php
include_once "config.php";
if(isset($_POST['reqtype']) && !empty($_POST['reqtype'])){
    $request=$_POST['reqtype'];
    if(!empty($request)) {
        switch($request) {
            case "get":
                $cartItems=array();
                $TotalTax=0;
                $TotalDiscount=0;
                $TotalShipping=0;
                $TotalPrice=0;
               // session_destroy();
                if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){
                    foreach ($_SESSION["cart_item"] as $item){
                        $itm= array(
                            'id'=>$item["id"],
                            'name'=>$item["name"],
                            'quantity'=>$item["quantity"],
                            'price'=>$item["price"],
                            'size'=>$item["size"],
                            'color'=>$item["color"],
                            //'shipping_cost'=>$item["shipping_cost"],
                            'slug'=>$item["slug"],
                            'item_type'=>$item["item_type"],
                            'item_description'=>$item["item_description"]
                        );
                        $qty=(int)$item["quantity"];
                        $price=((float)$item["price"])*(int)$item["quantity"];
                        $disc=0;
                        $disc2=0;
                        if((float)$item['discount']>0){
                            if('discount_type'=='percent'){
                                $disc=($price*(float)$item['discount'])/100;
                                $disc2=$disc;
                            }else{
                                $disc=(float)$item['discount'];
                                $disc2=$disc;
                            }
                            $disc=$disc*$qty;
                            $TotalDiscount=$TotalDiscount+$disc;
                            $itm['discount']=$disc;
                        }else{
                            $itm['discount']='0';
                        }

                        if((float)$item['tax']>0){
                            if('tax_type'=='percent'){
                                $tax=($price*(float)$item['tax'])/100;
                            }else{
                                $tax=(float)$item['tax'];
                            }
                            $tax=$tax*$qty;
                            $TotalTax=$TotalTax+$tax;
                            $itm['tax']=$tax;
                        }else{
                            $itm['tax']='0';
                        }

                        $itm['sub_total']=$price;
                        $itm['common_price']=(float)$item["price"]-$disc2;
                        $itm['total']=$price-$disc;
                        $TotalPrice=$TotalPrice+$price;

                       /* if((float)$item['shipping_cost']>0){
                            $TotalShipping=$TotalShipping+(float)$item['shipping_cost']+
                                $itm['shipping_cost']=(float)$item['shipping_cost'];
                        }*/

                        array_push($cartItems,$itm);
                    }
                }
                $_SESSION["TransactionData"]=array('cart_items'=>$cartItems,
                    'total_item'=>count($cartItems),
                    'total_discount'=>$TotalDiscount,
                    'total_tax'=>$TotalTax,
                    'total_shipping'=>$TotalShipping,
                    'SubTotal'=>($TotalPrice-$TotalDiscount),
                    'CartTotal'=>($TotalPrice-$TotalDiscount)+$TotalTax+$TotalShipping,
                    'success'=>true
                );
                echo json_encode($_SESSION["TransactionData"]);
                break;
            case "add":
                if(!empty($_POST["quantity"]) && !empty($_POST["id"] && !empty($_POST["item_type"]))) {
                    $prd_id=$_POST['id'];
                    $item_type=$_POST["item_type"];
                    $item_description="";
                    if(isset($_POST['item_description'])){
                        $item_description=$_POST["item_description"];
                    }
                    $package_total="0";
                    if(isset($_POST['package_total'])){
                        $package_total=$_POST["package_total"];
                    }
                    if($item_type=="product"){
                        // session_destroy();
                        $stm = $con->prepare("select * from product where featured = '1' and status= 'ok' and id='$prd_id'");
                        $stm->execute();
                        if($stm->rowCount()>0){
                            $productById = $stm->fetch(PDO::FETCH_ASSOC);
                            if($productById['current_stock'] >= $_POST["quantity"]){
                                $slug = str_replace(' ', '-', $productById["title"]);
                                $slug=$slug.'-'.$productById["id"];
                                $productById['slug']=$slug;
                                $itemArray = array(
                                    $slug=>
                                        array(
                                            'id'=>$productById["id"],
                                            'name'=>$productById["title"],
                                            'quantity'=>$_POST["quantity"],
                                            'price'=>$productById["sale_price"],
                                            'size'=>$_POST["size"],
                                            'color'=>$_POST["color"],
                                            'discount'=>$productById["discount"],
                                            'discount_type'=>$productById["discount_type"],
                                            'tax'=>$productById["tax"],
                                            'tax_type'=>$productById["tax_type"],
                                            // 'shipping_cost'=>$productById["shipping_cost"],
                                            'item_type'=>'product',
                                            'item_description'=>'',
                                            'slug'=>$slug
                                        )
                                );

                            }else{
                                echo json_encode(array('success'=>false,'msg'=>'Quantity does not exists!'));
                                break;
                            }
                        }else{
                            echo json_encode(array('success'=>false,'msg'=>'Invalid Request'));
                            break;
                        }
                    }elseif($item_type=="parties" || $item_type=="camps" || $item_type=="tutoring"){
                        // session_destroy();
                        $stm = $con->prepare("select * from packages where id='$prd_id'");
                        $stm->execute();
                        if($stm->rowCount()>0){
                            $productById = $stm->fetch(PDO::FETCH_ASSOC);
                            $slug = str_replace(' ', '-', $productById["type"]);
                            $slug=$slug.'-'.$productById["id"];
                            $productById['slug']=$slug;
                            $itemArray = array(
                                $slug=>
                                    array(
                                        'id'=>$productById["id"],
                                        'name'=>$productById["package_title"],
                                        'quantity'=>'1',
                                        'price'=>$package_total,
                                        'size'=>'',
                                        'color'=>'',
                                        'discount'=>'0',
                                        'discount_type'=>'',
                                        'tax'=>'',
                                        'tax_type'=>'',
                                        // 'shipping_cost'=>$productById["shipping_cost"],
                                        'item_type'=>$item_type,
                                        'item_description'=>$item_description,
                                        'slug'=>$slug
                                    )
                            );
                        }else{
                            echo json_encode(array('success'=>false,'msg'=>'Invalid Request'));
                            break;
                        }

                    }elseif($item_type=="classes"){
                        // session_destroy();
                        $stm = $con->prepare("select * from classes where id='$prd_id'");
                        $stm->execute();
                        if($stm->rowCount()>0){
                            $productById = $stm->fetch(PDO::FETCH_ASSOC);
                            $slug = str_replace(' ', '-', $productById["type"]);
                            $slug='test5';
                            $productById['slug']=$slug;

                            $itemArray = array(
                                $slug=>
                                    array(
                                        'id'=>$productById["id"],
                                        'name'=>$productById["classes_type"],
                                        'quantity'=>'1',
                                        'price'=>$package_total,
                                        'size'=>'',
                                        'color'=>'',
                                        'discount'=>'0',
                                        'discount_type'=>'',
                                        'tax'=>'',
                                        'tax_type'=>'',
                                        // 'shipping_cost'=>$productById["shipping_cost"],
                                        'item_type'=>$item_type,
                                        'item_description'=>$item_description,
                                        'slug'=>$slug
                                    )
                            );
                        }else{
                            echo json_encode(array('success'=>false,'msg'=>'Invalid Request'));
                            break;
                        }

                    }else{
                        echo json_encode(array('success'=>false,'msg'=>'Invalid Request'));
                        break;
                    }
                    if(!empty($_SESSION["cart_item"])) {
                        if(array_key_exists($productById["slug"],$_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productById["slug"] == $k)
                                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
                echo json_encode(array('success'=>true,'msg'=>'Successfully Added'));
                break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_POST["slug"] == $k)
                            unset($_SESSION["cart_item"][$k]);
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                    }
                }
                echo json_encode(array('success'=>true,'msg'=>'Product Removed'));
                break;
            case "empty":
                unset($_SESSION["cart_item"]);
                echo json_encode(array('success'=>true,'msg'=>'Cart Deleted'));
                break;
        }
    }

}