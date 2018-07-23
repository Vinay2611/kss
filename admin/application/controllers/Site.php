<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        include_once('../lib/config.php');
        if(!$this->session->userdata('is_logged_in'))
        {
            redirect('login');
        }
    }

    public function users()
    {
        $this->db->select('*');
        $this->db->from('users');
        $query=$this->db->get();
        $result=$query->result();

        $this->load->view('header');
        $this->load->view('site/users',array('users'=>$result));
        $this->load->view('footer');
    }

    public function Deleteusers(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('users');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function slider()
    {

        $this->db->select('*');
        $this->db->from('slider');
        $query=$this->db->get();
        $result=$query->result_array();
        $FormData=array();
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('slider');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
        }

        $this->load->view('header');
        $this->load->view('site/slider',array('all_slider'=>$result,'FormData'=>$FormData));
        $this->load->view('footer');
    }

    public function AddSlider()
    {
        $data=array();
        $success=false;
        $desc="";
        $redirect_url="";
        $error_msg="";
        $filename='';
        if($_POST && count($_POST)>0){
            if(!empty($_FILES["file"]["name"])){
                $target_dir = "../uploads/slider/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 1000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if($uploadOk!==0){
                    $uid=uniqid();
                    $fileupload=$target_dir.$uid.'.'.$imageFileType;
                    $filename=$uid.'.'.$imageFileType;
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload)){
                        $uploadOk = 1;
                    }else{
                        $uploadOk = 0;
                    }
                }
            }
            if(isset($_POST['RecordID']) && !empty($_POST['RecordID'])){
                if(!empty($filename)){
                    $data=array(
                        'title'=> $this->input->post('title'),  'image' => $filename, 'link'=>$this->input->post('name')
                    );
                }else{
                    $data=array(
                        'title'=> $this->input->post('title'),   'link'=>$this->input->post('link')
                    );
                }

                $this->db->where('id', $_POST['RecordID']);
                $this->db->update('slider', $data);
                $success=true;
                $desc="data updated successfully";
            }else{
                $data=array(
                    'title'=> $this->input->post('title'),
                    'image' => $filename,
                    'link'=> $this->input->post('link'),
                    'created_date' => date("Y-m-d H:i:s"),
                    'status'=>'1',
                    'featured'=>1
                );
                $this->db->insert('slider', $data);
                $success=true;
                $desc="data inserted successfully";
            }



            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;
        }

    }

    public function advertisement()
   {
        $this->db->select('*');
        $this->db->from('advertisement');
        $query=$this->db->get();
        $result=$query->result_array();
        $FormData=array();

        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('advertisement');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
        }

        $this->load->view('header');
        $this->load->view('site/advertisement',
            array('FormData'=>$FormData,'adv'=>$result)
        );
        $this->load->view('footer');
    }

    public function AddAdvertisement()
    {
        $data=array();
        $success=false;
        $desc="";
        $error_msg="";
        $filename='';
        if($_POST && count($_POST)>0){
            if(!empty($_FILES["file"]["name"])){
                $target_dir = "../uploads/col2-img/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 1000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if($uploadOk!==0){
                    $uid=uniqid();
                    $fileupload=$target_dir.$uid.'.'.$imageFileType;
                    $filename=$uid.'.'.$imageFileType;
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload)){
                        $uploadOk = 1;
                    }else{
                        $uploadOk = 0;
                    }
                }
            }
            if(isset($_POST['RecordID']) && !empty($_POST['RecordID'])){
                if(!empty($filename)){
                    $data=array(
                        'title'=> $this->input->post('title'),  'image' => $filename, 'link'=> $this->input->post('link'), 'description'=> $this->input->post('description')
                    );
                }else{
                    $data=array(
                        'title'=> $this->input->post('title'),  'link'=> $this->input->post('link'), 'description'=> $this->input->post('description')
                    );
                }

                $this->db->where('id', $_POST['RecordID']);
                $this->db->update('advertisement', $data);
                $success=true;
                $desc="data updated successfully";
            }else{
                $data=array(
                    'title'=> $this->input->post('title'),
                    'image' => $filename,
                    'link'=> $this->input->post('link'),
                    'description'=> $this->input->post('description'),
                    'created_date' => date("Y-m-d H:i:s")
                    /*'status'=>'1',
                    'featured'=>1*/
                );
                $this->db->insert('advertisement', $data);
                $success=true;
                $desc="data inserted successfully";
            }

            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;
        }

    }

    public function category(){
        $this->db->select('*');
        $this->db->from('categories');
        $array = array('parent_id' => '0');
        $this->db->where($array);
        $query=$this->db->get();
        $result=$query->result_array();

        $this->db->select('c.*,cc.name as parent_name');
        $this->db->from('categories as c');
        $this->db->join('categories as cc', 'cc.id = c.parent_id', 'left');
        $query2=$this->db->get();
        $result2=$query2->result_array();
        $FormData=array();

        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('categories');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
        }

        $this->load->view('header');
        $this->load->view('site/category',
            array(
                'parent_cat'=>$result,
                'all_cat'=>$result2,
                'FormData'=>$FormData)
        );
        $this->load->view('footer');
    }

    public function AddCategory()
    {
        $data=array();
        $success=false;
        $desc="";
        $error_msg="";
        $filename='';
        if($_POST && count($_POST)>0){
            if(!empty($_FILES["file"]["name"])){
                $target_dir = "../uploads/cat/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 1000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if($uploadOk!==0){
                    $uid=uniqid();
                    $fileupload=$target_dir.$uid.'.'.$imageFileType;
                    $filename=$uid.'.'.$imageFileType;
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileupload)){
                        $uploadOk = 1;
                    }else{
                        $uploadOk = 0;
                    }
                }
            }
            if(isset($_POST['RecordID']) && !empty($_POST['RecordID'])){
                if(!empty($filename)){
                    $data=array(
                        'name'=> $this->input->post('name'),  'image' => $filename, 'parent_id'=> $this->input->post('parent_id')
                    );
                }else{
                    $data=array(
                        'name'=> $this->input->post('name'),  'parent_id'=> $this->input->post('parent_id')
                    );
                }

                $this->db->where('id', $_POST['RecordID']);
                $this->db->update('categories', $data);
                $success=true;
                $desc="data updated successfully";
            }else{
                $data=array(
                    'name'=> $this->input->post('name'),
                    'image' => $filename,
                    'parent_id'=> $this->input->post('parent_id'),
                    'created_date' => date("Y-m-d H:i:s"),
                    'status'=>'1',
                    'featured'=>1
                );
                $this->db->insert('categories', $data);
                $success=true;
                $desc="data inserted successfully";
            }



            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;
        }
    }

    public function DeleteSlider(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('slider');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function DeleteCategory(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('categories');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function DeleteAdvertising(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('advertisement');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function UpdateAdvertisement()
    {
        $data=array();
        $status=1;
        $featured=1;
        $success=false;
        $desc="";
        $error_msg="";
        $record_id=$_POST['record_id'];

        $this->db->select('*');
        $this->db->from('advertisement');
        $array = array('id' => $_POST['record_id']);
        $this->db->where($array);
        $query3=$this->db->get();
        $res=$query3->row();
        $email=$res->email;

        $data=array(
            'status'=>  $status,'featured'=> $featured
        );
                /*$this->db->where('id', $_POST['RecordID']);*/
                $this->db->set($data);
                $this->db->where('id',$record_id);
                $this->db->update('advertisement', $data);
                $success=true;
                $desc="data updated successfully";
                //send mail
        if(!empty($email)){
            $to=$email;
            $sub="Advertisement Approvement..!!";
            $Contactus="<br>for more Information please contact us:<a href='info@kssprograms.com'>info@kssprograms.com</a>";
            $msg="Dear User,<br>Congratulation,<br>Your advertisement request successfully approved by the admin..!!<br> $Contactus";

            if(send_mail(array($to),$sub,$msg))
            {
            }
        }


            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;

    }

    public function classes(){
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where_in('parent_id', array('1','2'));
        $query=$this->db->get();
        $cat_result=$query->result_array();

        $this->db->select('*');
        $this->db->from('states');
        $query=$this->db->get();
        $state_result=$query->result_array();

        $this->db->select('*');
        $this->db->from('classes');
        $query=$this->db->get();
        $records=$query->result_array();


        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('status', 'ok');
        $p_query=$this->db->get();
        $p_records=$p_query->result_array();


        $FormData=array();
        if(isset($_GET['id'])){
            $this->db->select('*');
            $this->db->from('classes');
            $this->db->where('id', $_GET['id']);
            $query=$this->db->get();
            $FormData=$query->row_array();
        }


        $this->load->view('header');
        $this->load->view('site/classes',
            array(
                'FormData'=>$FormData,
                'CatData'=>$cat_result,
                'StateData'=>$state_result,
                'records'=>$records,
                'products'=>$p_records
                )
        );
        $this->load->view('footer');
    }

    public function AddClasses(){
        $p_recom=$this->input->post('p_recommand');
        if(!empty($p_recom)){
            $p_recom=$this->input->post('p_recommand');
        }else{
            $p_recom=array();
        }

        $data=array(
            'type'=> 'Classes',
            'category' => $this->input->post('category'),
            'classes_type'=>$this->input->post('classes_type'),
            'date_from'=> $this->input->post('date_from'),
            'date_to' => $this->input->post('date_to'),
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'state'=>$this->input->post('state'),
            'city'=>$this->input->post('city'),
            'zip_code'=>$this->input->post('zip_code'),
            'what_bring'=>$this->input->post('what_bring'),
            'what_wear'=>$this->input->post('what_wear'),
            'Health_form'=>$this->input->post('Health_form'),
            'wheather_policy'=>$this->input->post('wheather_policy'),
            'form_data'=>json_encode($this->input->post('data')),
            'status'=>'1',
            'date_added'=>date("Y-m-d H:i:s"),
            'recommand_product'=>json_encode($p_recom)
        );
      //  print_r($data);

        if(isset($_POST['RecordId']) && !empty($_POST['RecordId'])){
            $this->db->where('id', $_POST['RecordId']);
            $this->db->update('classes', $data);
            $success=true;
            $desc="data updated successfully";
        }else{
            $this->db->insert('classes', $data);
            $success=true;
            $desc="data inserted successfully";
        }

        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc);
        echo json_encode($data);die;
    }

    public function DeleteClasses(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('classes');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function parties_package(){

        $this->db->select('*');
        $this->db->from('packages');
        $this->db->where('type', 'Parties');
        $query=$this->db->get();
        $records=$query->result_array();

        $FormData=array();
        if(isset($_GET['id'])){
            $this->db->select('*');
            $this->db->from('packages');
            $this->db->where('id', $_GET['id']);
            $query=$this->db->get();
            $FormData=$query->row_array();
        }
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('status', 'ok');
        $p_query=$this->db->get();
        $p_records=$p_query->result_array();


        $this->load->view('header');
        $this->load->view('site/parties_package',
            array(
                'FormData'=>$FormData,
                'records'=>$records,
                'products'=>$p_records
            )
        );
        $this->load->view('footer');
    }

    public function AddPartiesPackage(){
        $p_recom=$this->input->post('p_recommand');
        if(!empty($p_recom)){
            $p_recom=$this->input->post('p_recommand');
        }else{
            $p_recom=array();
        }

        $data=array(
            'type'=>'Parties',
            'category' => $this->input->post('category'),
            'package_title'=>$this->input->post('package_title'),
            'date_from'=> $this->input->post('date_from'),
            'date_to' => $this->input->post('date_to'),
            'age'=>$this->input->post('age'),
            'time'=>$this->input->post('time'),
            'num_of_children'=>$this->input->post('num_of_children'),
            'location'=>$this->input->post('location'),
            'terms_conditions'=>$this->input->post('terms_conditions'),
            'fee_detail'=>json_encode($this->input->post('fee_detail')),
            'status'=>'1',
            'date_added'=>date("Y-m-d H:i:s"),
            'recommand_product'=>json_encode($p_recom)
        );

        if(isset($_POST['RecordId']) && !empty($_POST['RecordId'])){
            $this->db->where('id', $_POST['RecordId']);
            $this->db->update('packages', $data);
            $success=true;
            $desc="data updated successfully";
        }else{
            $this->db->insert('packages', $data);
            $success=true;
            $desc="data inserted successfully";
        }

        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc);
        echo json_encode($data);die;
    }

    public function camps_package(){

        $this->db->select('*');
        $this->db->from('packages');
        $this->db->where('type', 'Camps');
        $query=$this->db->get();
        $records=$query->result_array();

        $FormData=array();
        if(isset($_GET['id'])){
            $this->db->select('*');
            $this->db->from('packages');

            $this->db->where('id', $_GET['id']);
            $query=$this->db->get();
            $FormData=$query->row_array();
        }
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('status', 'ok');
        $p_query=$this->db->get();
        $p_records=$p_query->result_array();



        $this->load->view('header');
        $this->load->view('site/camp_package',
            array(
                'FormData'=>$FormData,
                'records'=>$records,
                'products'=>$p_records
            )
        );
        $this->load->view('footer');
    }

    public function AddCampsPackage(){
        $p_recom=$this->input->post('p_recommand');
        if(!empty($p_recom)){
            $p_recom=$this->input->post('p_recommand');
        }else{
            $p_recom=array();
        }

        $time = $this->input->post('time');
        $location=$this->input->post('location');
        $what_bring=$this->input->post('what_bring');
        $what_wear=$this->input->post('what_wear');
        $description=$this->input->post('description');

        $data=array(
            'type'=>'Camps',
            'category' => $this->input->post('category'),
            'package_title'=>$this->input->post('package_title'),
            'date_from'=> $this->input->post('date_from'),
            'date_to' => $this->input->post('date_to'),
            'age'=>$this->input->post('age'),
            'time'=>$time,
            'what_bring'=>$what_bring,
            'what_wear'=>$what_wear,
            'description'=>$description,
            'num_of_children'=>$this->input->post('num_of_children'),
            'location'=>$location,
            'fee_detail'=>json_encode($this->input->post('fee_detail')),
            'status'=>'1',
            'date_added'=>date("Y-m-d H:i:s"),
            'recommand_product'=>json_encode($p_recom)
        );


        if(isset($_POST['RecordId']) && !empty($_POST['RecordId'])){
            $this->db->where('id', $_POST['RecordId']);
            $this->db->update('packages', $data);
            $success=true;
            $desc="data updated successfully";
        }else{
            $this->db->insert('packages', $data);
            $success=true;
            $desc="data inserted successfully";
        }

        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc);
        echo json_encode($data);die;
    }

    public function tutoring_package(){

        $this->db->select('*');
        $this->db->from('packages');
        $this->db->where('type', 'Tutoring');
        $query=$this->db->get();
        $records=$query->result_array();

        $FormData=array();
        if(isset($_GET['id'])){
            $this->db->select('*');
            $this->db->from('packages');

            $this->db->where('id', $_GET['id']);
            $query=$this->db->get();
            $FormData=$query->row_array();
        }
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('status', 'ok');
        $p_query=$this->db->get();
        $p_records=$p_query->result_array();


        $this->load->view('header');
        $this->load->view('site/tutoring_package',
            array(
                'FormData'=>$FormData,
                'records'=>$records,
                'products'=>$p_records
            )
        );
        $this->load->view('footer');
    }

    public function AddTutoringPackage(){
        $p_recom=$this->input->post('p_recommand');
        if(!empty($p_recom)){
            $p_recom=$this->input->post('p_recommand');
        }else{
            $p_recom=array();
        }

        $data=array(
            'type'=>'Tutoring',
            'category' => $this->input->post('category'),
            'package_title'=>$this->input->post('package_title'),
            'date_from'=> $this->input->post('date_from'),
            'date_to' => $this->input->post('date_to'),
            'grade'=>$this->input->post('grade'),
            'subject'=>$this->input->post('subject'),
            'school'=>$this->input->post('school'),
            'description'=>$this->input->post('description'),
            'time'=>$this->input->post('time'),
            'location'=>$this->input->post('location'),
            'fee_detail'=>json_encode($this->input->post('fee_detail')),
            'status'=>'1',
            'date_added'=>date("Y-m-d H:i:s"),
            'recommand_product'=>json_encode($p_recom)
        );

        if(isset($_POST['RecordId']) && !empty($_POST['RecordId'])){
            $this->db->where('id', $_POST['RecordId']);
            $this->db->update('packages', $data);
            $success=true;
            $desc="data updated successfully";
        }else{
            $this->db->insert('packages', $data);
            $success=true;
            $desc="data inserted successfully";
        }

        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc);
        echo json_encode($data);die;
    }

    public function DeletePackage(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('packages');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function experience()
    {

        $this->db->select('*');
        $this->db->from('experience');
        $query=$this->db->get();
        $result=$query->result_array();
        $FormData=array();
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('experience');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
        }

        $this->load->view('header');
        $this->load->view('site/experience',array('experience'=>$result,'FormData'=>$FormData));
        $this->load->view('footer');
    }

    public function Deleteexperience(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('experience');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function UpdateExperience()
    {
        $data=array();
        $status=1;
        $featured=1;
        $success=false;
        $desc="";
        $error_msg="";
        $record_id=$_POST['record_id'];
        $data=array(
            'Status'=>  $status,'featured'=> $featured
        );
        /*$this->db->where('id', $_POST['RecordID']);*/
        $this->db->set($data);
        $this->db->where('id',$record_id);
        $this->db->update('experience', $data);
        $success=true;
        $desc="data updated successfully";

        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
        echo json_encode($data);die;

    }

    public function all_transactions(){

        $this->db->select('*');
        $this->db->from('transactions');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();

        $this->load->view('header');
        $this->load->view('site/all_transactions',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function classes_orders(){
        $this->db->select('o.*,c.category,c.classes_type,t.shipping_address,t.phone_no,t.entry_date,u.first_name,u.last_name,c.date_from,c.date_to,u.age,u.sex,u.medical_condition');
        $this->db->from('orders as o');
        $this->db->where('o.item_type','classes');
        $this->db->join('classes as c','c.id=o.item_id','inner');
        $this->db->join('transactions as t','o.transaction_id=t.id','inner');
        $this->db->join('users as u','u.id=t.user_id','left');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();
        $this->load->view('header');
        $this->load->view('site/classes_orders',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function parties_orders(){
        $this->db->select('o.*,pk.package_title,pk.date_from,pk.date_to,pk.category,t.phone_no,t.entry_date,u.first_name,u.last_name,u.age,u.sex,u.medical_condition');
        $this->db->from('orders as o');
        $this->db->where('o.item_type','parties');
        $this->db->join('packages as pk','pk.id=o.item_id','inner');
        $this->db->join('transactions as t','o.transaction_id=t.id','inner');
        $this->db->join('users as u','u.id=t.user_id','left');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();

        $this->load->view('header');
        $this->load->view('site/parties_orders',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function camps_orders(){
        $this->db->select('o.*,pk.package_title,pk.category,pk.date_from,pk.date_to,t.phone_no,t.entry_date,u.first_name,u.last_name,u.age,u.sex,u.medical_condition');
        $this->db->from('orders as o');
        $this->db->where('o.item_type','camps');
        $this->db->join('packages as pk','pk.id=o.item_id','inner');
        $this->db->join('transactions as t','o.transaction_id=t.id','inner');
        $this->db->join('users as u','u.id=t.user_id','left');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();

        $this->load->view('header');
        $this->load->view('site/camps_orders',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function tutoring_orders(){

        $this->db->select('o.*,pk.package_title,pk.date_from,pk.date_to,pk.category,t.entry_date,u.first_name,u.last_name,t.phone_no,u.age,u.sex,u.medical_condition');
        $this->db->from('orders as o');
        $this->db->where('o.item_type','tutoring');
        $this->db->join('packages as pk','pk.id=o.item_id','inner');
        $this->db->join('transactions as t','o.transaction_id=t.id','inner');
        $this->db->join('users as u','u.id=t.user_id','left');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();

        $this->load->view('header');
        $this->load->view('site/tutoring_orders',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function terms_conditions()
    {
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->where('title','terms_conditions');
        $query=$this->db->get();
        $FormData=$query->row();
        $this->load->view('header');
        $this->load->view('site/terms_conditions',array('FormData'=>(array)$FormData));
        $this->load->view('footer');
    }

    public function add_terms_conditions()
    {
        $data=array(
            'description'=>$this->input->post('description'),
        );
        $this->db->where('title','terms_conditions');
        $this->db->update('pages', $data);
        $success=true;
        $desc="data updated successfully";
        unset ($_POST);
        $data=array('success'=>$success,'msg'=>$desc);
        echo json_encode($data);die;
    }

}
