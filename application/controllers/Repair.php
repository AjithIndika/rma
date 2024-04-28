<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Repair extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->model('Systemuser');
        $this->load->model('Setting_model');
        $this->load->model('Repair_model');
        $this->load->model('Report_model');        
        $this->load->model('Sms_model');
    }

    /// index and login
    public function new() {
        $data = array(
            "page_title" => "New Repair",
            "page_content" => "working/new_repair",
            "item_list" => $this->Setting_model->item_list());


        if ($this->input->post('new_job')) {
            $this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('lane_number', 'Lane Number', 'trim|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('item_id', 'Item', 'trim|required|xss_clean');
            $this->form_validation->set_rules('item_description', 'Item Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('customer_complaint', 'Customer Complaint', 'trim|required|xss_clean');
            $this->form_validation->set_rules('inspection_chargers', 'Inspection Cchargers', 'trim|required|xss_clean|numeric');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "New Repair",
                    "page_content" => "working/new_repair",
                    "item_list" => $this->Setting_model->item_list());
            } else {

                if (empty($this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number)) {
                    $job_number = str_pad('00001', 5, "0", STR_PAD_LEFT);
                } else {
                    $job = $this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number + 1;

                    $job_number = str_pad($job, 5, "0", STR_PAD_LEFT);
                }

                if (!empty($this->input->post('warranty'))) {
                    $warranty = 1;
                } else {
                    $warranty = '';
                }

                $newjob = array(
                    "job_number" => $job_number,
                    "customer_name" => $this->input->post('customer_name'),
                    "mobile_number" => $this->input->post('mobile_number'),
                    "lane_number" => $this->input->post('lane_number'),
                    "address" => $this->input->post('address'),
                    "invoice_no" => $this->input->post('invoice_no'),
                    "invoice_date" => $this->input->post('invoice_date'),
                    "item_id" => $this->input->post('item_id'),
                    "item_description" => $this->input->post('item_description'),
                    "serial_no" => $this->input->post('serial_no'),
                    "tag_no" => $this->input->post('tag_no'),
                    "warranty" => $warranty,
                    "mark" => $this->input->post('mark'),
                    "accessories_receiving" => $this->input->post('accessories_receiving'),
                    "customer_complaint" => $this->input->post('customer_complaint'),
                    "others" => $this->input->post('others'),
                    "required_estimate" => $this->input->post('required_estimate'),
                    "inspection_chargers" => $this->input->post('inspection_chargers'),
                    "job_by" => $this->session->uname,
                    "job_date" => date('Y-m-d h:i:s a'),
                    "job_status" => 0,
                    "now_job" => 'New Job',);
                $this->Repair_model->new_job($newjob);

                // sms send
                if (!empty($this->db->get_where('sms_setting', array('id' => 1))->row()->status)) {
                    $tpno = $this->input->post('mobile_number');

                    $exp = explode('"Job"', $this->db->get_where('sms_setting', array('id' => 1))->row()->newjob);
                    $setpone = $exp[0] . ' ' . $job_number . ' ' . $exp[1];
                    $co = explode('"complaint"', $setpone);
                    $step2 = $co[0] . ' ' . $this->input->post('customer_complaint') . ' ' . $co[1];
                    $ins = explode('"chargers"', $step2);
                    $step3 = $ins[0] . ' ' . $this->input->post('inspection_chargers') . ' ' . $ins[1];
                    $masage = $step3;
                    $this->Sms_model->sms_send($tpno, $masage);
                }

                $_SESSION['job_number'] = $job_number;
                redirect(base_url('rma'));
            }
        }



        $this->load->view('template/template', $data);
    }

    // rma invoice

    public function rma() {
       // $data = array(
       //     "page_title" => "Sned Supplier",
        //    "page_content" => "working/supplier",);
       //  $this->load->view('template/template', $data);
        $this->load->view('working/rma');
    }

    // supplier send

    public function supplier() {
        $data = array(
            "page_title" => "Sned Supplier",
            "page_content" => "working/supplier",);

        if ($this->input->post('sup_send')) {

            $this->form_validation->set_rules('redy_by_us', 'Customer Complaint', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Sned Supplier",
                    "page_content" => "working/supplier",
                    "error" => '<div class="alert alert-danger"> <strong>Success!</strong> Plese Check You must Select one</div>',);
            } else {

                $job_number = $this->input->post('job_number');

                if ($this->input->post('redy_by_us') == "1") {
                    $send = array(
                        "job_number" => $this->input->post('job_number'),
                        "send_item_description" => $this->input->post('send_item_description'),
                        "status" => 4,
                        "done_by" => $this->session->uname,
                        "done_date" => date('Y-m-d h:i:s a'));
                    $this->Repair_model->repair_center($send);

                    $jobup = array(
                        "job_by" => $this->session->uname,
                        "job_date" => date('Y-m-d h:i:s a'),
                        "job_status" => 4,
                        "now_job" => 'Done By Repair Center',
                    );

                    $this->Repair_model->job_update($jobup, $job_number);

                    $data = array(
                        "page_title" => "Sned Supplier",
                        "page_content" => "working/supplier",
                        "error" => '<div class="alert alert-success"> <strong>Success!</strong>' . $this->input->post('job_number') . ' Is Update </div>',);
                }

                if ($this->input->post('redy_by_us') == "2") {

                    $this->form_validation->set_rules('supplier_id', 'Supplier', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('send_item_description', 'Description', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        $data = array(
                            "page_title" => "Sned Supplier",
                            "page_content" => "working/supplier",
                            "error" => '<div class="alert alert-danger"> <strong>Success!</strong>Its Not Done Plese Check You </div>',);
                    } else {
                        $jobup = array(
                            "job_by" => $this->session->uname,
                            "job_date" => date('Y-m-d h:i:s a'),
                            "job_status" => 1,
                            "now_job" => 'Redy to Send Supplier',);
                        $this->Repair_model->job_update($jobup, $job_number);


                        $send = array(
                            "job_number" => $this->input->post('job_number'),
                            "supplier_id" => $this->input->post('supplier_id'),
                            "send_item_description" => $this->input->post('send_item_description'),
                            "chek_by" => $this->session->uname,
                            "chek_date" => date('Y-m-d h:i:s a'),
                            "sup_status" => 1);
                        $this->Repair_model->suppler_send($send);

                        $data = array(
                            "page_title" => "Sned Supplier",
                            "page_content" => "working/supplier",
                            "error" => '<div class="alert alert-success"> <strong>Success!</strong>' . $this->input->post('job_number') . ' Is Update </div>',);
                    }
                }
            }
        }
        $this->load->view('template/template', $data);
    }

    // redy to send

    public function ready() {
        $data = array(
            "page_title" => "Courier List",
            "page_content" => "working/ready");
        $this->load->view('template/template', $data);
    }

    public function readyone() {
        $job_number = $this->input->get('job_number');

        $sup_send = array(
            "supplier_send_date" => date('Y-m-d h:i:s a'),
            "supplier_send_update_by" => $this->session->uname,
            "update_date" => date('Y-m-d h:i:s a'),
            "sup_status" => 2);
        $this->Repair_model->update_suppler_send($sup_send, $job_number);

        $jobup = array(
            "last_update_by" => $this->session->uname,
            "last_update" => date('Y-m-d h:i:s a'),
            "job_status" => 2,
            "now_job" => 'Courier',);

        $this->Repair_model->job_update($jobup, $job_number);

        redirect(base_url('repair/ready'));
    }

    public function print() {
        $data = array(
            "page_title" => "Prtint",
            "page_content" => "working/print");
             $this->load->view('template/template', $data);
      //  $this->load->view('working/print');
    }
    
    
    public function print_list() {       
     $this->load->view('working/print_list');
    }
    
    
    

    ////supplier_repair
    public function supplier_repair() {
        $data = array(
            "page_title" => "Supplier Repair List",
            "page_content" => "working/supplier_repair");
        if ($this->input->post('sup_send')) {
            $this->form_validation->set_rules('send_item_description', 'Send Item Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('supplier_send_date_in_note', 'Supplier Note Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('supplier_note_no', 'Supplier Note No', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Supplier Repair List",
                    "page_content" => "working/supplier_repair");
            } else {
                $job_number = $this->input->post('job_number');

                $sup_send = array(
                    "supplier_note_no" => $this->input->post('supplier_note_no'),
                    "send_item_description" => $this->input->post('send_item_description'),
                    "supplier_send_date_in_note" => $this->input->post('supplier_send_date_in_note'),
                    "note_update_by" => $this->session->uname,
                    "note_update_date" => date('Y-m-d h:i:s a'),
                    "sup_status" => 3);
                $this->Repair_model->update_suppler_send($sup_send, $job_number);

                $jobup = array(
                    "last_update_by" => $this->session->uname,
                    "last_update" => date('Y-m-d h:i:s a'),
                    "job_status" => 3,
                    "now_job" => 'Supplier Repairing',);

                $this->Repair_model->job_update($jobup, $job_number);
            }
        }

        $this->load->view('template/template', $data);
    }

    /// in supplier lit not recive 

    public function not_riceve() {
        $data = array(
            "page_title" => "Supplier Pending List",
            "page_content" => "working/not_riceve");

        if ($this->input->post('sup_send')) {
            $this->form_validation->set_rules('received_date', 'Received Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('received_description', 'Received Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_serial', '*', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_tag', '*', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Supplier Repair Not Recive",
                    "page_content" => "working/not_riceve",
                    "error" => '<div class="alert alert-danger">  <strong> Infor !</strong> Plese check again.</div>');
            } else {
                $job_number = $this->input->post('job_number');

                $sup_send = array(
                    "sup_new_serial" => $this->input->post('new_serial'),
                    "sup_new_tag" => $this->input->post('new_tag'),
                    "sup_received_by" => $this->session->uname,
                    "sup_received_update_date" => date('Y-m-d h:i:s a'),
                    "received_date" => $this->input->post('received_date'),
                    "received_description" => $this->input->post('received_description'),
                    "sup_status" => 4);
                $this->Repair_model->update_suppler_send($sup_send, $job_number);

                $jobup = array(
                    "new_serial" => $this->input->post('new_serial'),
                    "new_tag" => $this->input->post('new_tag'),
                    "received_by" => $this->session->uname,
                    "received_update_date" => date('Y-m-d h:i:s a'),
                    "last_update_by" => $this->session->uname,
                    "last_update" => date('Y-m-d h:i:s a'),
                    "job_status" => 4,
                    "now_job" => 'Suppier Form Supplier',);

                $this->Repair_model->job_update($jobup, $job_number);
                $data = array(
                    "page_title" => "Supplier Repair Not Recive",
                    "page_content" => "working/not_riceve",
                    "error" => '<div class="alert alert-success">  <strong> Success !</strong> Job ' . $job_number . ' Recive success Full</div>');
            }
        }
        $this->load->view('template/template', $data);
    }

    public function doredy() {

        $data = array(
            "page_title" => "Ready To Dispatch",
            "page_content" => "working/doredy");

        if ($this->input->post('redy')) {
            $this->form_validation->set_rules('inspection_chargers', 'Inspection Chargers', 'trim|required|xss_clean|numeric');
            //$this->form_validation->set_rules('repair_chargers', 'Repair Chargers', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('inform_date', 'Inform Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('remark', 'Remark', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Do Redy",
                    "page_content" => "working/doredy",
                    "error" => '<div class="alert alert-danger">  <strong> Infor !</strong> Plese check again.</div>');
            } else {
                $job_number = $this->input->post('job_number');

                if (!empty($this->input->post('repair_chargers'))) {
                    $repair_chargers = $this->input->post('repair_chargers');
                } else {
                    $repair_chargers = 0;
                }

                $sup_send = array(
                    "update_by" => $this->session->uname,
                    "update_date" => date('Y-m-d h:i:s a'),
                    "sup_status" => 5);
                $this->Repair_model->update_suppler_send($sup_send, $job_number);

                $jobup = array(
                    "inspection_chargers" => $this->input->post('inspection_chargers'),
                    "repair_chargers" => $repair_chargers,
                    "inform_date" => $this->input->post('inform_date'),
                    "remark" => $this->input->post('remark'),
                    "ready_by" => $this->session->uname,
                    "ready_date" => date('Y-m-d h:i:s a'),
                    "job_status" => 5,
                    "now_job" => 'Redy to Dispach',);

                $this->Repair_model->job_update($jobup, $job_number);


                // sms send
                if (!empty($this->db->get_where('sms_setting', array('id' => 1))->row()->status)) {
                    $tpno = $this->db->get_where('jobs', array('job_number' => $job_number))->row()->mobile_number;
                    $totals = $this->db->get_where('jobs', array('job_number' => $job_number))->row()->inspection_chargers + $repair_chargers;

                    $exp = explode('"Job"', $this->db->get_where('sms_setting', array('id' => 1))->row()->doredy_job);
                    $setpone = $exp[0] . ' ' . $job_number . ' ' . $exp[1];
                    $co = explode('"chargers"', $setpone);
                    $step2 = $co[0] . ' ' . $totals . ' ' . $co[1];
                    $masage = $step2;
                    $this->Sms_model->sms_send($tpno, $masage);
                }




                $data = array(
                    "page_title" => "Do Redy",
                    "page_content" => "working/doredy",
                    "error" => '<div class="alert alert-success">  <strong> Success !</strong> Job ' . $job_number . ' Ready To Dispacth Success Full</div>');
            }
        }

        $this->load->view('template/template', $data);
    }

    public function dispatch() {
        $job_number = $this->input->post('job_number');
        $data = array(
            "page_title" => "Dispatch",
            "page_content" => "working/dispatch",);

        if ($this->input->post('redy')) {
            $this->form_validation->set_rules('date_of_issued', 'Date Of Issued', 'trim|required|xss_clean');
            $this->form_validation->set_rules('issued_item_id', 'Issued Part', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_serial', 'New Serial', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_tag', 'New Tag', 'trim|required|xss_clean');
            $this->form_validation->set_rules('riceived_name', 'Riceived Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('riceived_nic', 'Riceived Nic', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Dispatch",
                    "page_content" => "working/dispatch",
                    "error" => '<div class="alert alert-danger">  <strong> Infor !</strong> Plese check again.</div>');
            } else {
                
               
                
                // sms send
                if (!empty($this->db->get_where('sms_setting', array('id' => 1))->row()->status)) {
                    $tpno = $this->db->get_where('jobs', array('job_number' => $job_number))->row()->mobile_number;
                    $totals = $this->db->get_where('jobs', array('job_number' => $job_number))->row()->inspection_chargers + $this->db->get_where('jobs', array('job_number' => $job_number))->row()->repair_chargers;

                    $exp = explode('"Job"', $this->db->get_where('sms_setting', array('id' => 1))->row()->dispach_Job);
                    $setpone = $exp[0] . ' ' . $job_number . ' ' . $exp[1];
                    $co = explode('"chargers"', $setpone);
                    $step2 = $co[0] . ' ' . $totals . ' ' . $co[1];
                    $recn = explode('"received_name"', $step2);
                    $step3 = $recn[0] . ' ' . $this->input->post('riceived_name') . ' ' . $recn[1];
                    $recinic = explode('"received_nic"', $step3);
                    $masage = $recinic[0] . ' ' . $this->input->post('riceived_nic') . ' ' . $recinic[1];
                 // $masage = $step3 ;

                    $this->Sms_model->sms_send($tpno, $masage);
                }




                $sup_send = array(
                    "sup_dispatch_by" => $this->session->uname,
                    "sup_dispatch_date" => date('Y-m-d h:i:s a'),
                    "sup_status" => 6);
                $this->Repair_model->update_suppler_send($sup_send, $job_number);

                $jobup = array(
                    "rmanote_missing" => $this->input->post('rmanote_missing'),
                    "date_of_issued" => $this->input->post('date_of_issued'),
                    "issued_item_id" => $this->input->post('issued_item_id'),
                    "new_serial" => $this->input->post('new_serial'),
                    "new_tag" => $this->input->post('new_tag'),
                    "riceived_name" => $this->input->post('riceived_name'),
                    "riceived_nic" => $this->input->post('riceived_nic'),
                    "dispatch_by" => $this->session->uname,
                    "dispatch_date" => date('Y-m-d h:i:s a'),
                    "repair_chargers"=> $this->input->post('repair_chargers'),
                    "inspection_chargers"=> $this->input->post('inspection_chargers'),
                    "job_status" => 6,
                    "now_job" => 'Job Done',);

                $this->Repair_model->job_update($jobup, $job_number);

                $jobs_dispach = array(
                    "job_number" => $job_number,
                    "dispach_date" => date('Y-m-d h:i:s a'),
                    "dispach_by" => $this->session->uname,
                    "total" => $this->db->get_where('jobs', array('job_number' => $job_number))->row()->repair_chargers + $this->db->get_where('jobs', array('job_number' => $job_number))->row()->inspection_chargers,
                );

                $this->Repair_model->jobs_dispach($jobs_dispach);
                $this->Repair_model->jobs_dispach_income($job_number);


             //   if (!empty($this->db->get_where('jobs', array('job_number' => $job_number))->row()->repair_chargers OR $this->input->post('rmanote_missing'))) {
                    redirect(base_url('repair/handover?no=' . $job_number . ''));
               // }
                
                
               // $data = array(
               //     "page_title" => "Despatch",
                //    "page_content" => "working/dispatch",
                //    "error" => '<div class="alert alert-success">  <strong> Success !</strong> Job ' . $job_number . ' Ready To Dispacth Success Full</div>');
            }
        }

        $this->load->view('template/template', $data);
    }

    //live serch 
    public function liveserch() {

        $this->db->from('jobs as jo');
        $this->db->like('jo.job_number', $_GET["q"]);
        $this->db->or_like('jo.customer_name', $_GET["q"]);
        $this->db->or_like('jo.mobile_number', $_GET["q"]);
        $this->db->or_like('jo.riceived_nic', $_GET["q"]);
        $this->db->or_like('jo.riceived_name', $_GET["q"]);
        $this->db->join('item_list as it', 'it.item_id = jo.item_id', 'LEFT');
        $this->db->limit(10);
        //$this->db->where('jo.job_status',5);       
        $query = $this->db->get();
        $dam = $query->result();

        foreach ($dam as $dam) {
            echo'<a href="' . base_url('repair/detailsrma?rma=' . $dam->job_number) . '" >' . $dam->job_number . ' - ' . $dam->item_name . ' - ' . $dam->customer_name . '</a></br>';
        }
    }

    //dtails of rma
    public function detailsrma() {
        $data = array(
            "page_title" => "Details of " . $this->input->get('rma') . "",
            "page_content" => "working/detailsrma",);
        $this->load->view('template/template', $data);
    }

    //estimate
    public function estimate() {
        $job_number = $this->input->get('rma');
        $jobup = array(
            "estimate_by" => $this->session->uname,
            "send_estimate_date" => date('Y-m-d h:i:s a'),
        );
        $this->Repair_model->job_update($jobup, $job_number);

        redirect(base_url('repair/detailsrma?rma=' . $job_number . ''));
    }

    public function live() {

        $data = array(
            "page_title" => "Live Search",
            "page_content" => "working/live",);
        $this->load->view('template/template', $data);
    }

    public function handover() {
          $data = array(
            "page_title" => "Hand Over",
            "page_content" => "working/handover",);
        $this->load->view('template/template', $data);
        
      //  $this->load->view('working/handover');
    }

    //re editt 
    public function reedit() {

        $data = array(
            "page_title" => "Re Edit",
            "page_content" => "working/reedit",
            "item_list" => $this->Setting_model->item_list());


        if ($this->input->post('update')) {
            $this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('lane_number', 'Lane Number', 'trim|xss_clean|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('item_id', 'Item', 'trim|required|xss_clean');
            $this->form_validation->set_rules('item_description', 'Item Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('customer_complaint', 'Customer Complaint', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Re Edit",
                    "page_content" => "working/reedit",
                    "item_list" => $this->Setting_model->item_list());
            } else {

                $job_number = $this->input->post('job_number');

                if (!empty($this->input->post('warranty'))) {
                    $warranty = 1;
                } else {
                    $warranty = '';
                }

                $updateJob = array(
                    "job_number" => $job_number,
                    "customer_name" => $this->input->post('customer_name'),
                    "mobile_number" => $this->input->post('mobile_number'),
                    "lane_number" => $this->input->post('lane_number'),
                    "address" => $this->input->post('address'),
                    "invoice_no" => $this->input->post('invoice_no'),
                    "invoice_date" => $this->input->post('invoice_date'),
                    "item_id" => $this->input->post('item_id'),
                    "item_description" => $this->input->post('item_description'),
                    "serial_no" => $this->input->post('serial_no'),
                    "tag_no" => $this->input->post('tag_no'),
                    "warranty" => $warranty,
                    "mark" => $this->input->post('mark'),
                    "accessories_receiving" => $this->input->post('accessories_receiving'),
                    "customer_complaint" => $this->input->post('customer_complaint'),
                    "others" => $this->input->post('others'),
                    "required_estimate" => $this->input->post('required_estimate'),
                    "inspection_chargers" => $this->input->post('inspection_chargers'),
                    "job_by_update" => $this->session->uname,
                    "job_date_update" => date('Y-m-d h:i:s a'),
                    "job_status" => 0,
                    "now_job" => 'New Job',);


                $this->Repair_model->befor_update($job_number);
                $this->Repair_model->update_jobs($updateJob, $job_number);
              
                $_SESSION['job_number'] = $job_number;
                redirect(base_url('rma'));
            }
        }



        $this->load->view('template/template', $data);
    }

    
    public function supplierupdate() {
        
        $data = array(
                    "page_title" => "Re Edit",
                    "page_content" => "working/supplierupdate",);
          $this->load->view('template/template', $data);
        
    }
    
    public function immediate_job() {    
        
        
            $data = array(
             "page_title" => "Immediate Job",
             "page_content" => "working/immediate_job",);


        if ($this->input->post('new_job')) {
            $this->form_validation->set_rules('customer_name', 'Customer Name', 'trim|required|xss_clean');
           $this->form_validation->set_rules('item_id', 'Item', 'trim|required|xss_clean');
            $this->form_validation->set_rules('item_description', 'Item Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('inspection_chargers', 'Inspection Cchargers', 'trim|required|xss_clean|numeric');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                     "page_title" => "Immediate Job",
                    "page_content" => "working/immediate_job",);
            } else {

                if (empty($this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number)) {
                    $job_number = str_pad('00001', 5, "0", STR_PAD_LEFT);
                } else {
                    $job = $this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number + 1;

                    $job_number = str_pad($job, 5, "0", STR_PAD_LEFT);
                }

            

                $newjob = array(
                    "job_number" => $job_number,
                    "customer_name" => $this->input->post('customer_name'),                    
                    "item_id" => $this->input->post('item_id'),
                    "item_description" => $this->input->post('item_description'),
                    "serial_no" => $this->input->post('serial_no'),
                    "tag_no" => $this->input->post('tag_no'),                   
                    "inspection_chargers" => $this->input->post('inspection_chargers'),
                    "repair_chargers"=>0,
                    "job_by" => $this->session->uname,
                    "job_date" => date('Y-m-d h:i:s a'),
                    "ready_by" => $this->session->uname,
                    "ready_date" => date('Y-m-d h:i:s a'),
                    "dispatch_by" => $this->session->uname,
                    "dispatch_date" => date('Y-m-d h:i:s a'),
                    
                    "job_status" => 6,
                    "now_job" => 'Immediate Job',);
                $this->Repair_model->new_job($newjob);
                   
                   $jobs_dispach = array(
                    "job_number" => $job_number,
                    "dispach_date" => date('Y-m-d h:i:s a'),
                    "dispach_by" => $this->session->uname,
                    "total" => $this->db->get_where('jobs', array('job_number' => $job_number))->row()->repair_chargers + $this->db->get_where('jobs', array('job_number' => $job_number))->row()->inspection_chargers,
                );

                $this->Repair_model->jobs_dispach($jobs_dispach);
                $this->Repair_model->jobs_dispach_income($job_number);
                
                
                
               

                $_SESSION['job_number'] = $job_number;
                redirect(base_url('repair/immediate_job_invoice'));
            }
        }

        $this->load->view('template/template', $data);
     
    }
    
    public function immediate_job_invoice() {
         $data = array(
                     "page_title" => "Immediate Job",
                    "page_content" => "working/immediate_job_invoice",);
         $this->load->view('template/template', $data);
        
    }
}
