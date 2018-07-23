<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
    public function index()
    {
        $c_orders="0";
        $p_orders="0";
        $camp_orders="0";
        $t_orders="0";
        $prd_orders="0";

        $c_orders2="0";
        $p_orders2="0";
        $camp_orders2="0";
        $t_orders2="0";
        $prd_orders2="0";

        $sql = "SELECT item_type, count(id) as order_total FROM `orders` GROUP BY item_type";
        $query = $this->db->query($sql);
        $orders=$query->result_array();
        foreach ($orders as $o){
            if($o['item_type']=="classes"){
                $c_orders=$o['order_total'];
            }elseif ($o['item_type']=="parties"){
                $p_orders=$o['order_total'];
            }
            elseif ($o['item_type']=="camps"){
                $camp_orders=$o['order_total'];
            }
            elseif ($o['item_type']=="tutoring"){
                $t_orders=$o['order_total'];
            }
            elseif ($o['item_type']=="product"){
                $prd_orders=$o['order_total'];
            }
        }

        $sql = "SELECT o.item_type, count(o.id) as order_total
                FROM `orders` as o inner join transactions as t on t.id=o.transaction_id 
                where CAST(entry_date as date) = CAST(now() as date)
                GROUP BY o.item_type";

        $query = $this->db->query($sql);
        $today_orders=$query->result_array();
        foreach ($today_orders as $o){
            if($o['item_type']=="classes"){
                $c_orders2=$o['order_total'];
            }elseif ($o['item_type']=="parties"){
                $p_orders2=$o['order_total'];
            }
            elseif ($o['item_type']=="camps"){
                $camp_orders2=$o['order_total'];
            }
            elseif ($o['item_type']=="tutoring"){
                $t_orders2=$o['order_total'];
            }
            elseif ($o['item_type']=="product"){
                $prd_orders2=$o['order_total'];
            }
        }


        $sql = "SELECT * from orders where item_type='product' order by id desc limit 10";
        $query = $this->db->query($sql);
        $recent_product=$query->result_array();

        $sql = "SELECT * from orders where item_type<>'product' order by id desc limit 10";
        $query = $this->db->query($sql);
        $recent_packages=$query->result_array();

        $sql = "SELECT * from product where current_stock<'10' order by current_stock limit 10";
        $query = $this->db->query($sql);
        $low_stock=$query->result_array();

        $data=array(
            'product_orders'=>$prd_orders,
            'classes_orders'=>$c_orders,
            'parties_orders'=>$p_orders,
            'camps_orders'=>$camp_orders,
            'tutoring_orders'=>$t_orders,
            'product_orders2'=>$prd_orders2,
            'classes_orders2'=>$c_orders2,
            'parties_orders2'=>$p_orders2,
            'camps_orders2'=>$camp_orders2,
            'tutoring_orders2'=>$t_orders2,
            'recent_products'=>$recent_product,
            'recent_packages'=>$recent_packages,
            'low_stock'=>$low_stock
        );

        $this->load->view('header');
        $this->load->view('index',$data);
        $this->load->view('footer');
    }


    public function change_password(){
        $data=array();
        $msg="";
        $success=false;
        $error_msg="";
        if($_POST && count($_POST)>0){
            $this->form_validation->set_rules('old_password', 'Email', 'trim|required');
            $this->form_validation->set_rules("password", "Password", 'trim|required|matches[conf_password]');
            $this->form_validation->set_rules("conf_password", "Confirm Password", 'required');

            if ($this->form_validation->run() == FALSE) {
                $msg="Validation Error!";
                $error_msg=validation_errors();
                $success=false;
            } else {
                /*'email' => $this->session->userdata('logged_email'),*/
                $update_password = array(
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT, array('cost' => 10))
                );
                $old_password=$this->input->post('old_password');

                $array = array('email' => $this->session->userdata('logged_email'));
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where($array);
                $query=$this->db->get();
                //  echo $this->db->last_query();
                if ($query->num_rows() > 0) {
                    $result=$query->result();
                    if(password_verify($old_password, $result[0]->password))
                    {
                        $this->db->where('email',$this->session->userdata('logged_email'));
                        $this->db->update('users', $update_password);
                        $msg="Password Changed Successfully";
                        $success=true;
                    }else{
                        $msg="Incorrect Old Password";
                        $success=false;
                    }
                }
            }
            echo json_encode(array('success'=>$success,'msg'=>$msg,'error_msg'=>$error_msg));die;
            unset ($_POST);
        }else{
            $this->load->view('header');
            $this->load->view('common/change_password',$data);
            $this->load->view('footer');
        }

    }



}
