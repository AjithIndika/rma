<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->model('Setting_model');
        $this->load->model('Systemuser');
        $this->load->model('Report_model');
        $this->load->model('Sms_model');
        $this->load->model('Repair_model');
         $this->load->library('infiQr');
       
        
    }

    /// index and login
    public function dash() {
        $data = array(
            "page_title" => "DashBord",
            "page_content" => "sys/dash",);
        $this->load->view('template/template', $data);
    }

    public function setting() {
        $data = array(
            "page_title" => "Setting",
            "page_content" => "sys/setting",);
        $this->load->view('template/template', $data);
    }

    public function supplier() {
        $data = array(
            "page_title" => "Supplier",
            "page_content" => "sys/supplier",);

        if ($this->input->post('newsupplier')) {
            $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required|xss_clean|is_unique[supplier.supplier_name]');
            $this->form_validation->set_rules('supplier_address', 'Supplier Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('lane_number', 'Lane Number', 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Supplier",
                    "page_content" => "sys/supplier",
                    "error" => '<div class="alert alert-danger mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Infor ! </strong>  Plese check Some Error.</div>');
            } else {
                $suply = array(
                    "supplier_name" => $this->input->post('supplier_name'),
                    "supplier_address" => $this->input->post('supplier_address'),
                    "mobile_number" => $this->input->post('mobile_number'),
                    "lane_number" => $this->input->post('lane_number'),);
                $this->Setting_model->new_supplier($suply);
                $data = array(
                    "page_title" => "Supplier",
                    "page_content" => "sys/supplier",
                    "error" => '<div class="alert alert-success mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success!</strong> ' . $this->input->post('supplier_name') . ' Supplier Crate Success Full.</div>');
            }
        }
        // update supliar 
        if ($this->input->post('update_supplier')) {
            $supplier_id = $this->input->post('supplier_id');
            $suply = array(
                "supplier_name" => $this->input->post('supplier_name'),
                "supplier_address" => $this->input->post('supplier_address'),
                "mobile_number" => $this->input->post('mobile_number'),
                "lane_number" => $this->input->post('lane_number'),);
            $this->Setting_model->update_supp($suply, $supplier_id);

            $data = array(
                "page_title" => "Supplier",
                "page_content" => "sys/supplier",
                "error" => '<div class="alert alert-success mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert"></button>  <strong>Success!</strong> ' . $this->input->post('supplier_name') . ' Supplier Update Success Full.</div>');
        }

        if ($this->input->post('deletsup')) {
            $supplier_id = $this->input->post('supplier_id');
            $this->Setting_model->delet_sup($supplier_id);


            $data = array(
                "page_title" => "Supplier",
                "page_content" => "sys/supplier",
                "error" => '<div class="alert alert-success mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert"></button>  <strong>Success!</strong>  Supplier Delete Success Full.</div>');
        }

        $this->load->view('template/template', $data);
    }

    public function items() {

        $data = array(
            "page_title" => "Items",
            "page_content" => "sys/items",);
        if ($this->input->post('newitem')) {

            $this->form_validation->set_rules('item_name', 'New Item', 'trim|required|xss_clean|is_unique[item_list.item_name]');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Items",
                    "page_content" => "sys/items",
                    "error" => '<div class="alert alert-warning mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert"></button>  <strong>Infor ! </strong>  Please Check again.</div>'
                );
            } else {
                $item = array(
                    "item_name" => $this->input->post('item_name'));
                $this->Setting_model->new_item($item);
            }
        }

        //update item
        if ($this->input->post('update_item')) {
            $item_id = $this->input->post('item_id');
            $item = array("item_name" => $this->input->post('item_name'),);
            $this->Setting_model->update_item($item, $item_id);

            $data = array(
                "page_title" => "Items",
                "page_content" => "sys/items",
                "error" => '<div class="alert alert-success mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert"></button>  <strong>Success ! </strong>  Item update success full.</div>'
            );
        }

        //delet item
        if ($this->input->post('deletitem')) {
            $item_id = $this->input->post('item_id');
            $this->Setting_model->delet_item($item_id);
            $data = array(
                "page_title" => "Items",
                "page_content" => "sys/items",
                "error" => '<div class="alert alert-success mt-2 alert-dismissible col-sm-6">  <button type="button" class="close" data-dismiss="alert"></button>  <strong>Success ! </strong>  Item Delete success full.</div>'
            );
        }

        $this->load->view('template/template', $data);
    }

    public function usersr() {
        $data = array(
            "page_title" => "DashBord",
            "page_content" => "sys/users",);
        $this->load->view('template/template', $data);
    }

    public function shop() {

        $data = array(
            "page_title" => "Shop Settings",
            "page_content" => "sys/shop",);


        if ($this->input->post('myshop')) {

            $this->form_validation->set_rules('shop_name', 'Shop Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address_line_1', 'Address Line ', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address_line_2', 'Telephone Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tp_no', 'TP No', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Shop Seting",
                    "page_content" => "sys/shop",
                    "error" => '<div class="alert alert-danger"> <strong>Infor  ! </strong> Plese check Some details Missing </div>',);
            } else {

                if (!empty($this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo)) {
                    $newimage = $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo;
                } else {

                    $newimage = strtolower(str_replace('-', '_', str_replace(' ', '_', date('Ymd')))) . '.' . pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION);
                    $cons['upload_path'] = './images/';
                    $cons['allowed_types'] = 'jpg|png|jpeg';
                    $cons['remove_spaces'] = true;
                    $cons['overwrite'] = TRUE;
                    $cons['max_size'] = '2048000';
                    $cons['max_height'] = '768000';
                    $cons['max_width'] = '10240000';
                    $cons['file_name'] = $newimage;

                    $this->load->library('upload', $cons);
                    if ($this->upload->do_upload()) {
                        $data = array('upload_data' => $this->upload->data());
                    }

                    $cons['image_library'] = 'gd2';
                    $cons['source_image'] = './images/' . $newimage;
                    $cons['maintain_ratio'] = TRUE;
                    $cons['overwrite'] = TRUE;
                    $cons['width'] = 500;
                    $cons['height'] = 500;


                    $this->load->library('image_lib', $cons);
                    $this->image_lib->resize();
                }


                $myde = array(
                    "shop_name" => $this->input->post('shop_name'),
                    "address_line_1" => $this->input->post('address_line_1'),
                    "address_line_2" => $this->input->post('address_line_2'),
                    "tp_no" => $this->input->post('tp_no'),
                    "web_link" => $this->input->post('web_link'),
                    "logo" => $newimage,
                );
                $this->Setting_model->shopseting($myde);

                $data = array(
                    "page_title" => "Shop Seting",
                    "page_content" => "sys/shop",
                    "error" => '<div class="alert alert-success"> <strong>Success ! </strong> Shop Update successful </div>',);
            }
        }



        $this->load->view('template/template', $data);
    }

    public function image_remove() {
        unlink('images/' . $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo . '');
        $myde = array("logo" => '',);
        $this->Setting_model->shopseting($myde);
        redirect(base_url('sys/shop'));
    }

    public function roles() {
        $data = array(
            "page_title" => "Rules",
            "page_content" => "sys/roles",
            "error" => "",);

        if ($this->input->post('delete')) {
            $roles_id = $this->input->post('roles_id');
            $this->Setting_model->delet_roule($roles_id);

            $data = array(
                "page_title" => "Rules",
                "page_content" => "sys/roles",
                "error" => '<div class="alert alert-success"><strong>Success! </strong> Delete Sucess Full</div>');
        }



        if ($this->input->post('roles')) {

            $this->form_validation->set_rules('roles_details', 'Roles Retails', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Rules",
                    "page_content" => "sys/roles",
                    "error" => '<div class="alert alert-danger"><strong>Infor ! </strong> Plese Check</div>',);
            }
            $rols = array("roles_details" => $this->input->post('roles_details'),);
            $this->Setting_model->roleadd($rols);

            $data = array(
                "page_title" => "Rules",
                "page_content" => "sys/roles",
                "error" => '<div class="alert alert-success">  <strong>Success!</strong> Rules Ad Success Full</div>',);
        }

        $this->load->view('template/template', $data);
    }

    public function smssetting() {
        $data = array(
            "page_title" => "SMS Settings",
            "page_content" => "sys/smssetting",);

        if ($this->input->post('sms_seting')) {
            $sms = array(
                'apikey' => $this->input->post('apikey'),
                'user_id' => $this->input->post('user_id'),
                'senderid' => $this->input->post('senderid'),
                'status' => $this->input->post('status'),
                'newjob'=>$this->input->post('newjob'),
                'doredy_job'=>$this->input->post('doredy_job'),
                'dispach_Job'=>$this->input->post('dispach_Job'));
            $this->Sms_model->update_sms_setting($sms);

            $data = array(
                "page_title" => "SMS Settings",
                "page_content" => "sys/smssetting",
                "error" => '<div class="alert alert-success">  <strong>Success!</strong> Update Sucess.</div>');
        }

        $this->load->view('template/template', $data);
    }

    public function mypassword() {
        if ($this->input->post('reset')) {
            $userid = $this->input->post('userid');
            $userpass = array(
                "upassword" => md5($this->input->post('upassword')),
            );
            $this->Systemuser->sys_user_password_update($userpass, $userid);
        }
        redirect($this->input->post('url_name'));
    }
    
    
    
       public function myimage() {
        if ($this->input->post('upload_image')) {
            
            if(!empty($this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image)){
         //  $this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image
         unlink('images/'.$this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image.'');
            }
            
             $newimage = strtolower(str_replace('-', '_', str_replace(' ', '_', date('Ymd')))) . '.' . pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION);
                    $cons['upload_path'] = './images/';
                    $cons['allowed_types'] = 'jpg|png|jpeg';
                    $cons['remove_spaces'] = true;
                    $cons['overwrite'] = TRUE;
                    $cons['max_size'] = '2048000';
                    $cons['max_height'] = '768000';
                    $cons['max_width'] = '10240000';
                    $cons['file_name'] = $newimage;

                    $this->load->library('upload', $cons);
                    if ($this->upload->do_upload()) {
                        $data = array('upload_data' => $this->upload->data());
                    }

                    $cons['image_library'] = 'gd2';
                    $cons['source_image'] = './images/' . $newimage;
                    $cons['maintain_ratio'] = TRUE;
                    $cons['overwrite'] = TRUE;
                    $cons['width'] = 500;
                    $cons['height'] = 500;


                    $this->load->library('image_lib', $cons);
                    $this->image_lib->resize();
           
            
         $imagede=array("image"=> $newimage);
          
        $this->db->where('userid',$this->session->userid);
        $this->db->update('sys_users',$imagede);
    
            
        }
        redirect($this->input->post('url_name'));
    }

    public function cash() {
        if ($this->input->post('cash_recive')) {          
          $repair_recive=$this->input->post('cash');
          $dat=date("Y-m-d");
         $this->Repair_model->jobs_dispach_income_cash($repair_recive,$dat);
        }
        redirect($this->input->post('url_name'));
    }
    
    
  
    public function oldcash() {
        if ($this->input->post('cash_recive')) {          
          $repair_recive=$this->input->post('cash');
          $dat= $this->input->post('old_date');
         $this->Repair_model->jobs_dispach_income_cash($repair_recive,$dat);
        }
        redirect($this->input->post('url_name'));
    }
    
    
    

}
