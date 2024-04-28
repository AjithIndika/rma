<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->model('Systemuser');
        $this->load->model('Report_model');
         
        $this->load->model('Sms_model');
        
    }

    /// index and login
    public function index() {
        $this->load->view('login/login');

        if ($this->input->post('login')) {
            $uname = $this->input->post('uname');
            $upassword = $this->input->post('upassword');

            $this->form_validation->set_rules('uname', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('upassword', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login/login');
            } else {
                $this->Systemuser->log($uname, $upassword);
            }
        }
    }
    
    
      
    //// bar cord

    public function barcord() { 
        
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

        $barcodeOptions = array('text' => 'ZEND-FRAMEWORK');
        $rendererOptions = array('imageType'          =>'png', 
                                 'horizontalPosition' => 'center', 
                                 'verticalPosition'   => 'middle');
      Zend_Barcode::factory('code39', 'image', $barcodeOptions, $rendererOptions)->render();
       
         
        
  //   $this->zend->load('Zend/Barcode');
      //  Zend_Barcode::render('code128','image',array('text'=>$code,'drawText' => false));
     }
    
    
public function logout() {       
        $this->session->sess_destroy($this->session->uname);         
        redirect(base_url());
    }
    
    
	

}





