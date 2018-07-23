<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        if(!$this->session->userdata('is_logged_in'))
        {
            redirect('login');
        }
    }

    public function category(){
        $this->db->select('*');
        $this->db->from('store_categories');
        $array = array('parent_id' => '0');
        $this->db->where($array);
        $query=$this->db->get();
        $result=$query->result_array();

        $this->db->select('c.*,cc.name as parent_name');
        $this->db->from('store_categories as c');
        $this->db->join('store_categories as cc', 'cc.id = c.parent_id', 'left');
        $query2=$this->db->get();
        $result2=$query2->result_array();
        $FormData=array();

        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('store_categories');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
        }

        $this->load->view('header');
        $this->load->view('store/category',
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
            if(isset($_POST['RecordID']) && !empty($_POST['RecordID'])){
                $data=array(
                    'name'=> $this->input->post('name'),  'parent_id'=> $this->input->post('parent_id')
                );

                $this->db->where('id', $_POST['RecordID']);
                $this->db->update('store_categories', $data);
                $success=true;
                $desc="data updated successfully";
            }else{
                $data=array(
                    'name'=> $this->input->post('name'),
                    'parent_id'=> $this->input->post('parent_id'),
                    'status'=>'1',
                    'featured'=>1
                );
                $this->db->insert('store_categories', $data);
                $success=true;
                $desc="data inserted successfully";
            }



            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;
        }
    }

    public function DeleteCategory(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('store_categories');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function DeleteProduct(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->where('id', $record_id);
        $this->db->delete('product');
        $this->db->where('product_id', $record_id);
        $this->db->delete('product_img');
        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function DeleteProductImg(){
        $data=array();
        $success=false;
        $msg="";
        $record_id=$_POST['record_id'];
        $this->db->select('*');
        $this->db->from('product_img');
        $array = array('id' =>$record_id);
        $this->db->where($array);
        $query3=$this->db->get();
        $imgData=$query3->row_array();
        unlink('../uploads/products/'.$imgData['img_name']);
        $this->db->where('id', $record_id);
        $this->db->delete('product_img');

        $success=true;
        $data=array('success'=>$success,'msg'=>'Deleted Successfully');
        echo json_encode($data);die;
    }

    public function products(){
        $this->db->select('c.*,cc.name as parent_name');
        $this->db->from('store_categories as c');
        $this->db->join('store_categories as cc', 'cc.id = c.parent_id', 'left');
        $query2=$this->db->get();
        $prd_cat=$query2->result_array();

        $this->db->select('*');
        $this->db->from('product');
        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->db->select('*');
            $this->db->from('product');
            $array = array('id' => $_GET['id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();

            $this->db->select('*');
            $this->db->from('product_img');
            $array = array('product_id' => $FormData['id']);
            $this->db->where($array);
            $query4=$this->db->get();
            $imgData=$query4->result_array();
            $FormData['product_imgs']=$imgData;
        }


        $this->load->view('header');
        $this->load->view('store/products',
            array(
                'prd_cat'=>$prd_cat,
                'all_prd'=>$all_prd,
                'FormData'=>$FormData
                )
        );
        $this->load->view('footer');
    }

    public function GetStock(){
        $this->db->select('*');
        $this->db->from('product');
        $array = array('id' => $_POST['id']);
        $this->db->where($array);
        $query3=$this->db->get();
        $FormData=$query3->row_array();
        $data=array('success'=>true,'msg'=>"",'data'=>$FormData);
        echo json_encode($data);die;
    }

    public function store_orders(){
        $this->db->select('o.*,p.title,t.entry_date');
        $this->db->from('orders as o');
        $this->db->where('o.item_type','product');
        $this->db->join('product as p','p.id=o.item_id','inner');
        $this->db->join('transactions as t','o.transaction_id=t.id','inner');

        $query2=$this->db->get();
        $all_prd=$query2->result_array();
        $FormData=array();

        $this->load->view('header');
        $this->load->view('store/store_orders',
            array(
                'FormData'=>$all_prd
            )
        );
        $this->load->view('footer');
    }

    public function MaintainStock(){
        if(isset($_POST['product_id'])){
            $this->db->select('*');
            $this->db->from('product');
            $array = array('id' => $_POST['product_id']);
            $this->db->where($array);
            $query3=$this->db->get();
            $FormData=$query3->row_array();
            $current_quantity=$FormData['current_stock'];
            if($_POST['action_type']=="add"){
                $new_quantity=$current_quantity+(int)$_POST['quantity'];
            }else{
                $new_quantity=$current_quantity-(int)$_POST['quantity'];
            }
            $data=array(
                'current_stock'=>$new_quantity
            );

            $stock=array(
                'stock'=>(int)$_POST['quantity'],
                'type'=>$_POST['action_type'],
                'date_added'=>date('Y-m-d H:i:s'),
                'product_id'=>$_POST['product_id'],
                'description'=>$_POST['description'],
                'status'=>1
            );

            $this->db->where('id', $_POST['product_id']);
            $this->db->update('product', $data);

            $this->db->insert('stock', $stock);

        }
        $data=array('success'=>true,'msg'=>"");
        echo json_encode($data);die;
    }

    public function AddProduct()
    {
        $data=array();
        $success=false;
        $desc="";
        $error_msg="";
        $filename='';
        if($_POST && count($_POST)>0){
            $data=array(
                'title'=> $this->input->post('title'),
                'category' => $this->input->post('category'),
                'description'=> $this->input->post('description'),
                'num_of_imgs' => '',
                'sale_price'=>$this->input->post('sale_price'),
                'purchase_price'=>$this->input->post('business_price'),
                'shipping_cost'=>$this->input->post('shipping_cost'),
                'featured'=>'1',
                'tag'=>'',
                'status'=>'ok',
                'brand'=>'',
                'current_stock'=>$this->input->post('current_stock'),
                'unit'=>$this->input->post('unit'),
                'discount'=>$this->input->post('discount'),
                'discount_type'=>$this->input->post('discount_type'),
                'tax'=>$this->input->post('tax'),
                'tax_type'=>$this->input->post('tax_type'),
                'color'=>json_encode($this->input->post('color')),
                'size'=>$this->input->post('size'),
                'added_by'=>'Admin'
            );
            $nu=0;
            if(isset($_POST['RecordID']) && !empty($_POST['RecordID'])){
                $this->db->where('id', $_POST['RecordID']);
                $this->db->update('product', $data);
                $success=true;
                $desc="data updated successfully";
                $insertid= $_POST['RecordID'];
            }else{
                $this->db->insert('product', $data);
                $insertid=$this->db->insert_id();
            }
            if(count($_FILES["file"]["name"])>0 && !empty($_FILES["file"]["name"][0])){
                $target_dir = "../uploads/products/";
                $i=0;
                $img=1;
                foreach ($_FILES["file"]["name"] as $ff){
                    $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    if ($_FILES["file"]["size"][$i] > 1000000) {
                        $error_msg="File Size is too large";
                        $uploadOk = 0;
                    }
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        $error_msg="Only image file is allowed";
                        $uploadOk = 0;
                    }
                    if($uploadOk!==0){
                        $uid=uniqid();
                        $fileupload=$target_dir.$uid.$img.'.'.$imageFileType;
                        $filename=$uid.$img.'.'.$imageFileType;
                        if(move_uploaded_file($_FILES["file"]["tmp_name"][$i], $fileupload)){
                            $uploadOk = 1;
                            $img_data=array(
                                'product_id'=>$insertid,
                                'img_name'=>$filename
                            );
                            $this->db->insert('product_img', $img_data);
                            $img++;
                        }else{
                            $nu++;
                        }
                    }else{
                        $nu++;
                    }
                    $i++;
                }
            }

            if($insertid){
                $success=true;
                if($nu>0){
                    if(isset($_POST['RecordID']))
                    {
                        $desc="Product Updated successfully!";
                    }else{
                        $desc="Product added successfully, but ".$nu." image not uploaded update later!";
                    }
                }else{
                }
                $desc="Product added successfully";
            }else{
                $success=false;
                $desc="Please Try Again!";
            }
            unset ($_POST);
            $data=array('success'=>$success,'msg'=>$desc,'error_msg'=>$error_msg);
            echo json_encode($data);die;
        }

    }



}
