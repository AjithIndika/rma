<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
         
        
    }

      /// index and login
    public function usersr() {
        $data = array(
            "page_title" => "DashBord",
            "page_content" => "sys/users",);
        ///updatte user permition
        if ($this->input->post('perupdate')) {
            $permission_id = $this->input->post('permission_id');
            $perm = array(
                "add" => $this->input->post('add'),
                "edit" => $this->input->post('edit'),
                "delet" => $this->input->post('delet'),
                "admin" => $this->input->post('admin'));
            $this->Systemuser->sys_user_updateper($permission_id, $perm);
            $data = array(
                "page_title" => "DashBord",
                "page_content" => "sys/users",
                "error" => '<div class="alert alert-success alert-dismissible mt-3">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success! </strong> Permission Update </div>',);
        }
 
        //// update password
        
        if($this->input->post('updatepass')){
             $userid  = $this->input->post('userid');
             $userpass=array(
                 "upassword"=>md5($this->input->post('upassword')));
             $this->Systemuser->sys_user_password_update($userpass,$userid);
        }
        
        
        //delet user

        if ($this->input->post('delet')) {
            $user_no = $this->input->post('user_no');
            $this->Systemuser->sys_user_delet($user_no);
            $data = array(
                "page_title" => "DashBord",
                "page_content" => "sys/users",
                "error" => '<div class="alert alert-success alert-dismissible mt-3">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success! </strong>Delet Sucess Full</div>',);
        }


        if ($this->input->post('crate')) {

            if (empty($this->db->select('userid,user_no')->order_by('userid', "desc")->limit(1)->get('sys_users')->row()->user_no)) {
                $user_no = '1';
            } else {
                $last_no = $this->db->select('userid,user_no')->order_by('userid', "desc")->limit(1)->get('sys_users')->row()->user_no;
                $user_no = $last_no + 1;
            }



            $this->form_validation->set_rules('uname', 'User Name', 'trim|required|xss_clean|is_unique[sys_users.uname]');
            $this->form_validation->set_rules('upassword', 'Password', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "DashBord",
                    "page_content" => "sys/users",);
            } else {

                $new = array(
                    "user_no" => $user_no,
                    "uname" => $this->input->post('uname'),
                    "upassword" => md5($this->input->post('upassword')),);

                $perm = array(
                    "user_no" => $user_no,
                    "add" => $this->input->post('add'),
                    "edit" => $this->input->post('edit'),
                    "delet" => $this->input->post('delet'),
                    "admin" => $this->input->post('admin'),
                );

                $this->Systemuser->new_sys_user($new, $perm);
                $this->Systemuser->permittion($perm);

                $data = array(
                    "page_title" => "DashBord",
                    "page_content" => "sys/users",
                    "error" => '<div class="alert alert-success alert-dismissible mt-3">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success! </strong> ' . $this->input->post('uname') . ' ad successful .</div>',);
            }
        }

        $this->load->view('template/template', $data);
    }

}