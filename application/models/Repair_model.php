<?php

class Repair_model extends CI_Model {

    

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    

    
 /// new job 
 public function new_job($newjob) {
       $this->db->insert('jobs',$newjob);
 }
 
 public function job_update($jobup,$job_number) {
     $this->db->where('job_number',$job_number);
     $this->db->update('jobs',$jobup);
     
 }
 
  /// suppler send
 public function suppler_send($send) {
       $this->db->insert('sup_send',$send);
 }
 
  public function suppler_send_need_list() {      
       $this->db->from('jobs jo');       
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');  
       $this->db->where('jo.job_status',0);
       $query = $this->db->get();
        return $query->result();   
 }
 
 
 public function suppler_send_need_list_update($jobs_id) {      
       $this->db->from('jobs jo');              
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');  
       $this->db->where('jo.job_status',0);
       $this->db->where('jo.jobs_id',$jobs_id);
       $query = $this->db->get();
        return $query->result();   
 }
 
 
 
 
   public function ready_courier_list() {      
       $this->db->from('sup_send su');        
       $this->db->join('jobs as jo', 'jo.job_number = su.job_number','LEFT');
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
       $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number','LEFT');
       $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id','LEFT'); 
       $this->db->where('su.sup_status',1);
       $query = $this->db->get();
        return $query->result();   
 }
 
 
 public function update_suppler_send($sup_send,$job_number) {
        $this->db->where('job_number',$job_number);
        $this->db->update('sup_send',$sup_send);
 }
 
 
 
  
   public function print_courier_list() {      
       $this->db->from('sup_send su');        
       $this->db->join('jobs as jo', 'jo.job_number = su.job_number','LEFT');
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
       $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number','LEFT');
       $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id','LEFT'); 
       $this->db->where('su.sup_status',2);
       $query = $this->db->get();
       return $query->result();   
 }
 
 
   
   public function pending_supplier_list() {      
       $this->db->from('sup_send su');        
       $this->db->join('jobs as jo', 'jo.job_number = su.job_number','LEFT');
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
       $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number','LEFT');
       $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id','LEFT'); 
       $this->db->where('su.sup_status',3);
       $query = $this->db->get();
       return $query->result();   
 }
 
  public function doredy_list() {      
       $this->db->from('jobs as jo');        
      
      $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
     // $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number','LEFT');
     // $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id','LEFT'); 
   
       $this->db->where('jo.job_status',4);
       $query = $this->db->get();
       return $query->result();   
 }
 
  public function dispach_list() { 
       
       $this->db->from('jobs as jo');       
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
       // $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number','LEFT');      
       //$this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id','LEFT');
       //$this->db->join('repair_center as rc', 'rc.job_number = jo.job_number','LEFT');
       $this->db->where('jo.job_status',5);       
       $query = $this->db->get();
       return $query->result(); 
       
 }
 
 
 
 // repair center
 public function repair_center($send) {
       $this->db->insert('repair_center',$send);
       
 }
 

 /// ffffff ///
public function repair_center_update($rece_send,$job_number) {
        $this->db->where('job_number',$job_number);
        $this->db->update('repair_center',$rece_send);
 }
 
 //dispach
public function jobs_dispach($jobs_dispach) {
 $this->db->insert('jobs_dispach',$jobs_dispach);
}


public function  jobs_dispach_income($job_number) {
                $this->db->where('dispach_date', date('Y-m-d'));
                $query = $this->db->get('jobs_dispach_income');
                $count_row = $query->num_rows();
                if ($count_row > 0) {                   
                     $rece_send=array(
                      "invoice_income"=>$this->db->get_where('jobs_dispach_income', array('dispach_date' =>date('Y-m-d')))->row()->invoice_income+$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->repair_chargers+$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->inspection_chargers,
                       "total"=>$this->db->get_where('jobs_dispach_income', array('dispach_date' =>date('Y-m-d')))->row()->total+($this->db->get_where('jobs', array('job_number' =>$job_number))->row()->repair_chargers+$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->inspection_chargers),  
                    );
                    $this->db->where('dispach_date', date('Y-m-d'));
                    $this->db->update('jobs_dispach_income',$rece_send);
                    
                }
                else{
                    
                    $jobs_dispach=array(
                        "dispach_date"=> date('Y-m-d'),
                        "invoice_income"=>$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->repair_chargers+$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->inspection_chargers,
                        "total"=>$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->repair_chargers+$this->db->get_where('jobs', array('job_number' =>$job_number))->row()->inspection_chargers,
                    ); 
                    
                    $this->db->insert('jobs_dispach_income',$jobs_dispach);
                  
                    
                }
 }


 

 
public function  jobs_dispach_income_cash($repair_recive,$dat) {
                $this->db->where('dispach_date', $dat);
                $query = $this->db->get('jobs_dispach_income');
                $count_row = $query->num_rows();
                if ($count_row > 0) {                   
                     $rece_send=array(
                       "repair_recive"=>$repair_recive+$this->db->get_where('jobs_dispach_income', array('dispach_date' =>$dat))->row()->repair_recive,
                       "total"=>$this->db->get_where('jobs_dispach_income', array('dispach_date' =>$dat))->row()->total-$repair_recive,  
                    );
                    $this->db->where('dispach_date', $dat);
                    $this->db->update('jobs_dispach_income',$rece_send);
                    
                }
                else{
                    $jobs_dispach=array(
                        "dispach_date"=> $dat,
                        "repair_recive"=>$repair_recive,
                        "total"=>$this->db->get_where('jobs_dispach_income', array('dispach_date' =>$dat))->row()->total-$repair_recive, 
                    );                    
                    $this->db->insert('jobs_dispach_income',$jobs_dispach);
                  
                    
                }
 }
 

 
   
   public function jobs($job) {      
       $this->db->from('jobs as jo');
       $this->db->join('item_list as it', 'it.item_id = jo.item_id','LEFT');
       $this->db->where('jo.job_number',$job);
       $query = $this->db->get();
       return $query->result();   
 }
 
 
    public function update_jobs($updateJob,$job_number) {  
        $this->db->where('job_number',$job_number);
        $this->db->update('jobs',$updateJob);
       
 }
 
 public function befor_update($job_number) {
     $job=$job_number;
    $jo= $this->Repair_model->jobs($job);
    foreach ( $jo as  $jo) {
        $updateJob = array(
                    "job_number" => $jo->job_number,
                    "customer_name" => $jo->customer_name,
                    "mobile_number" => $jo->mobile_number,
                    "lane_number" => $jo->lane_number,
                    "address" => $jo->address,
                    "invoice_no" => $jo->invoice_no,
                    "invoice_date" => $jo->invoice_date,
                    "item_id" => $jo->item_id,
                    "item_description" => $jo->item_description,
                    "serial_no" => $jo->serial_no,
                    "tag_no" => $jo->tag_no,
                    "warranty" => $jo->warranty,
                    "mark" => $jo->mark,
                    "accessories_receiving" => $jo->accessories_receiving,
                    "customer_complaint" => $jo->customer_complaint,
                    "others" => $jo->others,
                    "required_estimate" => $jo->required_estimate,
                    "inspection_chargers" => $jo->inspection_chargers,
                    "job_by" =>  $jo->job_by,
                    "job_date" =>  $jo->job_date,
                    "job_by_update" => $this->session->uname,
                    "job_date_update" => date('Y-m-d h:i:s a'),
                    "job_status" =>$jo->inspection_chargers,
                    "now_job" => 'update',);
         $this->db->insert('befor_update', $updateJob);
        
    }
     
     
     /*
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
     */
 }
 
 
 
 
 public function barcords($code) {
        $this->load->library('infiQr');
        $tempDir = 'bar/';
        $codeContents = $code;
        QRcode::png($codeContents, $tempDir . '025.png', QR_ECLEVEL_L, 3);
        echo base_url('bar/025.png');
         }

}