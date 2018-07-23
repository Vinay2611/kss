<?php
include_once "config.php";
if(isset($_POST['reqtype']) && !empty($_POST['reqtype'])){
    $request=$_POST['reqtype'];
    $success=false;
    $msg="";
    $data="";
    if($request=='Login'){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $statement = $con->prepare("select * from users where email = :email");
            $statement->execute(array(':email' => $_POST['username']));
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $row_count = $statement->rowCount();
            if($row_count>0){
                if (password_verify($_POST['password'], $row['password']))
                {
                    $_SESSION['username']=$row['first_name']." ".$row['last_name'];
                    $_SESSION['useremail']=$row['email'];
                    $_SESSION['role']=$row['user_role'];
                    $_SESSION['loggedId']=$row['id'];
                    $_SESSION['isLoggedIn']=true;

                    $success=true;
                    $msg="Login Success!";
                }else{
                    $msg="Invalid username or password!";
                }
            }else{
                $msg="Invalid username or password!";
            }

        }else{
            $msg="Please fill username and password!";
        }
        $redirect="";
        if(isset($_POST['referrer']) && $_POST['referrer']=='Store'){
            $redirect='store.php';
        }

        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data,
                'redirect'=>$redirect
                )
        );
    }
    if($request=='ForgetPassword'){
        if(!empty($_POST['email'])){
            $statement = $con->prepare("select * from users where email = :email");
            $statement->execute(array(':email' => $_POST['email']));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $row_count = $statement->rowCount();
            if($row_count>0){
                $statement = $con->prepare("select * from users where email = :email and question=:question");
                $statement->execute(array(
                    ':email' => $_POST['email'],
                    ':question' => $_POST['question'])
                );
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $row_count = $statement->rowCount();
                if($row_count>0){

                    if (password_verify(strtolower($_POST['answer']), $row['answer']))
                    {
                        $to=$_POST['email'];
                        $sub='New password for KSS Login';
                        $pass=uniqueString(8);

                        $token=uniqueString(20);
                        $msg1="We have send you temporary password , please use this to login to kss site : ".$pass."<br> or you can reset your password by using this link:<a href='".BASE_URL."reset_link.php?token=".$token."'>Reset password</a>"."<br><br>for more Information please contact us:<a href='info@kssprograms.com'>info@kssprograms.com</a>";

						if(send_mail(array($to),$sub,$msg1))
                        {
                            $pass= password_hash($pass, PASSWORD_DEFAULT, array('cost' => 10));


                            $statement = $con->prepare("update users set password=:password,reset_password=:reset where email = :email");
                            $statement->execute(
                                array(':email' => $_POST['email'],
                                ':password' => $pass,
                                ':reset' => $token))
                            ;
                            $success=true;
                        }else{

                        }
                    }else{
                        $msg="Invalid security answer !";
                    }

                }else{
                    $msg="Invalid security question !";
                }


            }else{
                $msg="Invalid email !";
            }
        }else{
            $msg="Please fill all fields!";
        }

        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }

    if($request=='resetLink') {
        $token = $_POST['token'];

        $msg = '';
        if ($_POST['kss-password'] == $_POST['kss-retypepassword'])
            {
                $statement = $con->prepare("select * from users where reset_password = :token");
                $statement->execute(array(':token' => $token));
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $email=$row['email'];

                $password = $_POST['kss-retypepassword'];
                $reset_pass = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));

                $statement = $con->prepare("update users set password=:reset where reset_password=:token ");
                $statement->execute(
                    array(':reset' => $reset_pass,
                        ':token' => $token));

                  $msg="1";
                $to=$email;
                $sub='New password for KSS Login';
                $pass=uniqueString(8);

                $token=uniqueString(20);
                $msg1="Dear User,the password has been successfully reseted to newly entered one.:<br>"."Password:".$password.Conact_us;

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'dsvinfosolutions@gmail.com';                 // SMTP username
                $mail->Password = 'latest@123';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom(ADMIN_EMAIL, 'KSS');
                $mail->addAddress($email, 'Dear User');     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $sub;
                $mail->Body    = $msg1;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



                if($mail->send())
                {

                }else{

                }


            }
         else
        {
            $msg="0";
        }
            echo json_encode(array('msg'=>$msg));
    }
    if($request=='Register'){
        if($_POST['password']==$_POST['conf_password']){
            $statement = $con->prepare("select * from users where email = :email");
            $statement->execute(array(':email' => $_POST['email']));
            $row = $statement->fetch();
            $row_count = $statement->rowCount();
            $fname="";
            $lname="";
            $dob='';
            $fullname="";
            if(isset($_POST['firstname'])){
                $fname=$_POST['firstname'];
            }
            if(isset($_POST['lastname'])){
                $lname=$_POST['lastname'];
            }
            if(isset($_POST['dob'])){
                $dob=$_POST['dob'];
            }
            $uname="";
            if(isset($_POST['username'])){
                $uname=$_POST['firstname'];
            }
            $qtn="";
            $ans="";
            if(isset($_POST['question'])){
                $qtn=$_POST['question'];
            }

            if(isset($_POST['answer'])){
                $ans=password_hash(strtolower($_POST['answer']), PASSWORD_DEFAULT, array('cost' => 10));
            }
            $role="user";
            if(isset($_POST['role'])){
                $role=$_POST['role'];
            }
            $r_referrer="";
            if(isset($_SESSION['register_referrer'])){
               $r_referrer=$_SESSION['register_referrer'];
            }

            $medical_condition="";
            if(isset($_POST['medical_condition'])){
                $medical_condition=$_POST['medical_condition'];
            }
            $sex="";
            if(isset($_POST['sex'])){
                $sex=$_POST['sex'];
            }

            $age="";
            if(isset($_POST['age'])){
                $age=$_POST['age'];
            }


            if(!$row_count>0){
                $to=$_POST['email'];
                $sub="User Registration";
                //$pass=uniqueString(8);
                $msg1="You have successfully registered on kss site, please use below details to login this site:<br>"."User Name: ".$_POST['email']."<br>"."Password:".$_POST['password'].Conact_us;


                if(send_mail(array($to),$sub,$msg1))
                {

                    $stmt = $con->prepare("INSERT INTO users (user_role,first_name,last_name,date_of_birth,username,email,password,question,answer,record_date,referrer_site,medical_condition,sex,age) 
    VALUES (:user_role,:firstname,:lastname,:dob,:username,:email,:password,:question,:answer,:record_date,:referrer_site,:medical_condition,:sex,:age)");
                    $stmt->bindParam(':user_role', $role);
                    $stmt->bindParam(':firstname', $fname);
                    $stmt->bindParam(':lastname', $lname);
                    $stmt->bindParam(':dob', $dob);
                    $stmt->bindParam(':username', $uname);
                    $stmt->bindParam(':email', $_POST['email']);
                    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => 10)));
                    $stmt->bindParam(':question',$qtn);
                    $stmt->bindParam(':answer', $ans);
                    $stmt->bindParam(':record_date', date('Y-m-d H:i:s'));
                    $stmt->bindParam(':referrer_site', $r_referrer);
                    $stmt->bindParam(':medical_condition', $medical_condition);
                    $stmt->bindParam(':sex', $sex);
                    $stmt->bindParam(':age', $age);
                    $stmt->execute();
                    $success=true;
                    $msg="User Registered Successfully";
                }else{

                }

            }else{
                $msg="This email is already registered!";
            }


        }else{
            $msg="Password and confirm password do not match!";
        }

        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }
    if($request=='Advertisement'){
        $filename='';
        $status=0;
        $featured=0;
        if($_POST && count($_POST)>0) {
            if (!empty($_FILES["file"]["name"])) {
                $target_dir = "../uploads/col2-img/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 1000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk !== 0) {
                    $uid = uniqid();
                    $fileupload = $target_dir . $uid . '.' . $imageFileType;
                    $filename = $uid . '.' . $imageFileType;
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload)) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }
            }
            $sub="Advertisement subscription";
            //$pass=uniqueString(8);
            $to=$_POST["company_email"];
            $msg1="Your advertisement has been successfully submitted for admin approval..!!".Conact_us;

            $subAdmin="Advertisement Rquest";
            $toadmin=ADMIN_EMAIL;
            $msgAdmin="You have new advertisment request..!!!!".Conact_us;


            if(send_mail(array($to),$sub,$msg1))
            {
                $stmt = $con->prepare("INSERT INTO advertisement (name,email,phone,link,image,description,created_date,status,featured) 
                                       VALUES (:company_name,:company_email,:company_phone,:website,:filename,:description,:record_date,:status,:featured)");
                $stmt->bindParam(':company_name', $_POST['company_name']);
                $stmt->bindParam(':company_email', $_POST['company_email']);
                $stmt->bindParam(':company_phone', $_POST['company_phone']);
                $stmt->bindParam(':website', $_POST['website']);
                $stmt->bindParam(':filename', $filename);
                $stmt->bindParam(':description', $_POST['description']);
                $stmt->bindParam(':record_date', date('Y-m-s H:i:s'));
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':featured', $featured);
                $stmt->execute();
                $success = true;
                $msg = "Advertise Added Successfully";
            }
            else
            {

            }
            if(send_mail(array($toadmin),$subAdmin,$msgAdmin))
            {

            }
            else
            {

            }


        }



        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }

    if($request=='GetSubCat'){
        $cat_id=$_POST['cat_id'];
        $stm = $con->prepare("select * from store_categories where featured = '1' and status= '1' and parent_id='$cat_id'");
        $stm->execute();
        $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array('success'=>true,'data'=>$cat_res));
    }

    if($request=='GetProductsList'){
        $cat_id=$_POST['cat_id'];
        $stm = $con->prepare("select p.*,i.img_name,c.name as cat_name from product as p INNER join store_categories as c on c.id=p.category inner join (select * from product_img group by product_id) as i on p.id= i.product_id where c.id='$cat_id' or c.parent_id='$cat_id'");
        $stm->execute();

        $prd_res = $stm->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(array('success'=>true,'data'=>$prd_res));
    }
    if($request=='SearchProduct'){
        $txt=$_POST['txt'];
        $stm = $con->prepare("select p.*,i.img_name,c.name as cat_name from product as p INNER join store_categories as c on c.id=p.category inner join (select * from product_img group by product_id) as i on p.id= i.product_id 
                  where c.name like '%$txt%' or c.parent_id IN (select id from store_categories  
                  where `name` like '%$txt%') or p.title like '%$txt%' or p.description like '%$txt%'");
        $stm->execute();
        $prd_res = $stm->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array('success'=>true,'data'=>$prd_res));
    }

    if($request=='addToWish'){
        $success=false;
        $msg="";
        if($_SESSION['isLoggedIn']){
            $user_id=$_SESSION['loggedId'];
            if(!empty($_POST['id'])){
                $statement = $con->prepare("select * from wishlist where user_id='$user_id' and product_id = :id");
                $statement->execute(array(':id' => $_POST['id']));
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $row_count = $statement->rowCount();
                if($row_count>0){
                    $msg="Already In Wish List";
                }else{
                    $stmt = $con->prepare("INSERT INTO wishlist (user_id,product_id,date_added) 
    VALUES (:user_id,:product_id,:date_added)");
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':product_id', $_POST['id']);
                    $stmt->bindParam(':date_added', date('Y-m-d H:i:s'));
                    $stmt->execute();
                    $success=true;
                    $msg="Successfully Added to Wish List!";
                }
            }else{
                $msg="Please fill all fields!";
            }

        }else{
            $msg="Please Login!";
        }

        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );

    }

    if($request=='FilterClasses'){
        $cat=$_POST['reqcat'];
        $sub_cat=$_POST['reqsubcat'];
      //  $state=$_POST['state'];
        $city=$_POST['city'];
        $zip=$_POST['zip'];
        $classes_type=$_POST['reqclassestype'];
        //echo "select * from movements where type = '$cat' and category= '$sub_cat' and status='1' and state = '$state' and city '$city' and zip_code '$zip'";
        $stm = $con->prepare("select * from classes where type = '$cat' and category= '$sub_cat' and status='1' and classes_type='$classes_type' and city ='$city' and zip_code = '$zip'");
        $stm->execute();
        $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array('success'=>true,'data'=>$cat_res));
    }

    if($request=='ValidatePackage'){
        if(isset($_POST)){
            $_SESSION["PackageData"]=$_POST;
        }
        echo json_encode(array('success'=>true,'data'=>""));
    }

    if($request=='UpdateProfile'){
        $UserID = $_SESSION['loggedId'];
        if($_POST && count($_POST)>0) {
            $stmt = $con->prepare("UPDATE `users` SET `first_name` = :first_name,`last_name` = :last_name,`age` = :age,sex=:sex,medical_condition=:medical_condition,`email` = :email,`user_role` = :userrole,`record_date` = :record_date WHERE id = $UserID;");
            $stmt->bindParam(':first_name', $_POST['first_name']);
            $stmt->bindParam(':last_name', $_POST['last_name']);
            $stmt->bindParam(':age', $_POST['age']);
            $stmt->bindParam(':sex', $_POST['sex']);
            $stmt->bindParam(':medical_condition', $_POST['medical_condition']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':userrole', $_POST['urole']);
            $stmt->bindParam(':record_date', date('Y-m-s H:i:s'));
            $stmt->execute();
            $success = true;
            $msg = "Profile Updated Successfully";
        }
        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }

    if($request=='RemoveWish'){
        if($_POST && count($_POST)>0) {
            $UserID = $_SESSION['loggedId'];
            $id=$_POST['id'];
            $stmt = $con->prepare("delete from wishlist where product_id='$id' and user_id='$UserID'");
            $stmt->execute();
            $success = true;
            $msg = "Item Removed From Wishlist";
        }
        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }



    if($request=='GetPackage'){
        $p_id=$_POST['package'];
        $stm = $con->prepare("select * from packages where status= '1' and id='$p_id'");
        $stm->execute();
        $cat_res = $stm->fetch(PDO::FETCH_ASSOC);
        echo json_encode(array('success'=>true,'data'=>$cat_res),JSON_UNESCAPED_UNICODE);
    }


    if($request=='GetTutoring'){
        if(isset($_POST['grade'])){
            $grade=$_POST['grade'];
            $qry="grade='$grade'";
        }elseif($_POST['subject']){
            $subject=$_POST['subject'];
            $qry="subject='$subject'";
        }elseif($_POST['school']){
            $school=$_POST['school'];
            $qry="school='$school'";
        }

        $stm = $con->prepare("select * from packages where status= '1' and $qry");
        $stm->execute();
        $cat_res = $stm->fetchall(PDO::FETCH_ASSOC);
        echo json_encode(array('success'=>true,'data'=>$cat_res));
    }


    if($request=='Experience'){
        $filename='';
        $status=0;
        $featured=0;
        $success=true;

        if($_POST && count($_POST)>0) {
            if (!empty($_FILES["file"]["name"])) {
                $target_dir = "../uploads/exper/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 100000) {
                    $msg= "Sorry, your file is too large.";
                    $uploadOk = 0;
                    $success=false;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    $msg=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $success=false;
                }
                if ($uploadOk !== 0) {
                    $uid = uniqid();
                    $fileupload = $target_dir . $uid . '.' . $imageFileType;
                    $filename = $uid . '.' . $imageFileType;
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload)) {
                        $status=true;
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }
            }
            $sub="Share Experience";
            //$pass=uniqueString(8);
            $to=$_POST["email"];
            $msg1="Dear User,Thank you for sharing your experience..!!".Conact_us;

            if($success){
                if(send_mail($to,$sub,$msg1)){
                    $stmt = $con->prepare("INSERT INTO experience (name,email,subject,message,attachment,created_date,status,featured) 
                                       VALUES (:name,:email,:subject,:message,:filename,:created_date,:status,:featured)");
                    $stmt->bindParam(':name', $_POST['name']);
                    $stmt->bindParam(':email', $_POST['email']);
                    $stmt->bindParam(':subject', $_POST['subject']);
                    $stmt->bindParam(':message', $_POST['message']);
                    $stmt->bindParam(':filename', $filename);

                    $stmt->bindParam(':created_date', date('Y-m-d H:i:s'));
                    $stmt->bindParam(':status', $status);
                    $stmt->bindParam(':featured', $featured);
                    $stmt->execute();
                    $success = true;
                    $msg = "Experience Shared Successfully";
                }else{
                    $success=false;
                    $msg="Failed to send mail!";
                }

            }

        }

        echo json_encode(array(
                'success'=>$success,
                'msg'=>$msg,
                'data'=>$data)
        );
    }

    if($request=='GetAdvertisement'){
        $page=$_POST['page'];
        $offset=((int)($page)-1)*4;
        $stm = $con->prepare("select * from advertisement where status='1' and featured='1' order by order_no LIMIT 4 OFFSET $offset");
        $stm->execute();
        $cat_res = $stm->fetchall(PDO::FETCH_ASSOC);
        $countt=count($cat_res);
        echo json_encode(array('success'=>true,'count'=>$countt,'data'=>$cat_res));
    }


  if($request=='AddOnBook'){

        if(isset($_POST)){
            $i=0;$j=0;
            $adddata=array();
            foreach ($_POST['SelAddonDesc'] as $ff){
                if(!empty($ff)){
                    $adddata[$j]['id']=$_POST['SelAddonId'][$i];
                    $adddata[$j]['fees']=$_POST['SelAddonFees'][$i];
                    $adddata[$j]['desc']=$_POST['SelAddonDesc'][$i];
					$j++;
                }
				$i++;
                
            }
        }
        echo json_encode(array('success'=>true,'data'=>$adddata));
    }

}