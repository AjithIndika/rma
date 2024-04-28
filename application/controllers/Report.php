<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
        
    }

    
    public function moneyReport() {
        
        $data = array(
            "page_title" => "Cash Report",
            "page_content" => "report/moneyReport",);
         $this->load->view('template/template', $data);
        
    }
    
     public function moneyReportTowdate() {
         $data = array(
            "page_title" => "Cash Report (Time Period)",
            "page_content" => "report/moneyReportTowdate",
             "reports"=>'');
         if($this->input->post('viewdate')){
             $start_date= $this->input->post('start_date');
             $end_date= $this->input->post('end_date');
        
         $data = array(
            "page_title" => "Cash Report Two Date",
            "page_content" => "report/moneyReportTowdate",
             "reports"=>$this->Report_model->cash_report_twodate($start_date,$end_date));
         }
        
        
         $this->load->view('template/template', $data);
        
    }
    
    
    
    public function myprograss() {
        
        $data = array(
            "page_title" => "My Prograss",
            "page_content" => "report/myprograss",);
         $this->load->view('template/template', $data);
        
    }
    
    
    public function monthlyreport() {
         $data = array(
            "page_title" => "Last Month Report",
            "page_content" => "report/monthlyreport",);
         $this->load->view('template/template', $data);
        
    }
    
    
    public function warranty_send() {
        $data = array(
            "page_title" => "Warranty Send",
            "page_content" => "report/warranty_send",);
         $this->load->view('template/template', $data);
        
    }
    
    
    public function allpending_supplier_wise() {
      $supplier_id=  $this->uri->segment(count($this->uri->segment_array()));
        
         $data = array(
            "page_title" => "Supplier Wise",
            "page_content" => "report/allpending_supplier_wise",
            "supplier_id"=>$supplier_id,
             "pending" => $this->Report_model->one_supplier_pending($supplier_id));
         $this->load->view('template/template', $data);
        
    }
    
    public function shop() {
        $supplier_id=  $this->uri->segment(count($this->uri->segment_array()));
        
         $data = array(
            "page_title" => "Shop Items",
            "page_content" => "report/shopitems",
            "supplier_id"=>$supplier_id,
            "pending" => $this->Report_model->shop_items_pending($supplier_id));
         $this->load->view('template/template', $data);
        
    }
    
    
    
    public function myreport() {
        
         $data = array(
            "page_title" => "My Report",
            "page_content" => "report/myreport",
            );
         $this->load->view('template/template', $data);
        
    }
}
