<?php

class Report_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    /// qutation_requst
    public function qutation_requst() {
        $this->db->from('jobs as jo');
        $this->db->where('jo.required_estimate', 1);
        $query = $this->db->get();
        $requ = $query->result();
        foreach ($requ as $requ) {
            if (!empty($requ->required_estimate) AND empty($requ->send_estimate_date))
                echo '
               <a href="' . base_url('repair/detailsrma?rma=' . $requ->job_number . '') . '">
               <div class="notif-content ml-4">
	         <span class="block">
	       ' . $requ->job_number . '
	         </span>
	         <span class="time">' . $requ->job_date . '</span> 
	         </div>
                 </a></br>';
        }
    }

    public function rmadetails($rma) {
        $this->db->select('*');
        $this->db->from('jobs as jo');
        $this->db->join('item_list as it', 'it.item_id = jo.item_id', 'LEFT');
        $this->db->where('jo.job_number', $rma);
        $query = $this->db->get();
        return $query->result();
    }

    public function supplier_send($rma) {
        $this->db->select('*');
        $this->db->from('jobs as jo');
        $this->db->join('sup_send as sup', 'sup.job_number = jo.job_number', 'LEFT');
        $this->db->join('supplier as sp', 'sp.supplier_id = sup.supplier_id', 'LEFT');
        $this->db->where('sup.job_number', $rma);
        $query = $this->db->get();
        return $query->result();
    }

    public function today_jobs() {
        $this->db->from('jobs as jo');
        $this->db->like('jo.job_date', date('Y-m-d'));
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function today_dispach() {
        $this->db->from('jobs as jo');
        $this->db->like('jo.dispatch_date', date('Y-m-d'));
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function pending_supplier() {
        $this->db->from('sup_send as sup');
        $this->db->where('sup_status>=', 1);
        $this->db->where('sup_status <=', 3);
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function donejobs() {
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status', 6);
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function today_income() {
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status', 6);
        $this->db->like('jo.dispatch_date', date('Y-m-d'));
        $query = $this->db->get();
        $records = $query->result();
        $total_sum = 0;

        foreach ($records as $row) {
            $total_sum += $row->repair_chargers + $row->inspection_chargers;
        }
        if (!empty($this->db->get_where('jobs_dispach_income', array('dispach_date' => date('Y-m-d')))->row()->total)) {
            echo $this->db->get_where('jobs_dispach_income', array('dispach_date' => date('Y-m-d')))->row()->total;
        } else {
            echo '00';
        }//- $total_sum;    
    }

    public function pending_supplier_joblist() {
        $this->db->select('*');
        $this->db->from('jobs as job');
             
       // $this->db->join('sup_send as sup', 'sup.job_number= job.job_number', 'LEFT');
       // $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id', 'LEFT');
        $this->db->join('item_list as itl', 'job.item_id = itl.item_id', 'LEFT');
       
        $this->db->where('job.job_status>=',0);
        $this->db->where('job.job_status<=', 5);       
        $query = $this->db->get();
        return $query->result();
    }

    public function repair_center_details($rma) {
        $this->db->select('*');
        $this->db->from('jobs as jo');
        $this->db->join('repair_center re', 're.job_number = jo.job_number', 'LEFT');
        $this->db->where('re.job_number', $rma);
        $query = $this->db->get();
        return $query->result();
    }

    public function pending_alljobs() {
        $this->db->from('jobs as job');
        $this->db->join('item_list as itl', 'job.item_id = itl.item_id', 'LEFT');
        $this->db->where('job_status>=', 1);
        $this->db->where('job_status<=', 3);
        $query = $this->db->get();
        return $query->result();
    }

////report cash

    public function cash_report($date) {
        $this->db->select('*');
        $this->db->from('jobs_dispach_income jod');
        $this->db->like('jod.dispach_date',$date);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    // cash
    
    // pending chash
    
        public function pending_cash_report() {
        $this->db->select('*');
        $this->db->from('jobs_dispach_income jod');
        $this->db->where('jod.total >', 0);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function cash_report_twodate($start_date, $end_date) {
        $this->db->select('*');
        $this->db->from('jobs_dispach_income jod');
        $this->db->where('jod.dispach_date >=', $start_date);
        $this->db->where('jod.dispach_date <=', $end_date);
        $query = $this->db->get();
        return $query->result();
    }

    public function myrecive($uname,$dates) {
        $this->db->from('jobs as jo');
        $this->db->where('job_by', $uname);
        $this->db->like('job_date', $dates);
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function myrepair($uname,$dates) {
        $this->db->from('jobs as jo');
        $this->db->where('ready_by', $uname);
        $this->db->like('ready_date',$dates);        
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function dispachrepair($uname,$dates) {
        $this->db->from('jobs as jo');
        $this->db->where('dispatch_by', $uname);
        $this->db->like('dispatch_date', $dates);
        $query = $this->db->get();
        echo $query->num_rows();
    }

    public function getJobsUsers() {
        $this->db->from('jobs as jo');
        $this->db->group_by('job_by');
        $this->db->like('job_date', date('Y-m'));
        $query = $this->db->get();
        return $query->result();
    }

    public function userrecive() {
        $jobs = $this->Report_model->getJobsUsers();
        foreach ($jobs as $jobs) {
            $this->db->from('jobs as jo');
            $this->db->where('job_by', $jobs->job_by);
            $this->db->like('job_date', date('Y-m'));
            $query = $this->db->get();
            echo $query->num_rows() . ',';
        }
    }

    public function redy_jobs_grap() {

           $jobs = $this->Report_model->getJobsUsers();
            foreach ($jobs as $jobs) {
            $this->db->from('jobs as jo');
            $this->db->where('ready_by', $jobs->job_by);
            $this->db->like('ready_date', date('Y-m'));
            $query = $this->db->get();
            echo $query->num_rows() . ',';
        }
    }

    public function despach_jobs_grap() {

        $jobs = $this->Report_model->getJobsUsers();
        foreach ($jobs as $jobs) {
            $this->db->from('jobs as jo');
            $this->db->where('dispatch_by', $jobs->job_by);
            $this->db->like('dispatch_date', date('Y-m'));
            $query = $this->db->get();
            echo $query->num_rows() . ',';
        }
    }
    
    
    ///name_vise_recive_jobs
   public function name_vise_recive_jobs($uname,$dates) {
        $this->db->from('jobs as jo');
        $this->db->where('job_by', $uname);
        $this->db->like('job_date', $dates);
         $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
         $query = $this->db->get();         
         $job= $query->result();
      //   echo '<div class="container-fluid">';
         echo'
              <div class="row">
              <div class="col-sm-2">Job No</div>
              <div class="col ">Item</div>
              <div class="col">Date</div>
              <div class="col">Due Date</div>
               <div class="col">Cost</div>
              </div>';
         foreach ($job as $jobs) {
           
             if(!empty($jobs->dispatch_date)){ $coler='bg-success';}
             else{
                 $coler='';
             }
        
             
         echo '<div class="row border-bottom border-dark '.$coler.'">
              <div class="col-sm-2"><a href="'. base_url('repair/detailsrma?rma='.$jobs->job_number.'').' " target="_blank">'.$jobs->job_number.'</a></div>
              <div class="col text-left">'.$jobs->item_name.' / '.$jobs->item_description.'</div>
              <div class="col">'.$jobs->job_date.' </div>
              <div class="col">'.floor((strtotime(date('Y-m-d')) - strtotime($jobs->job_date)) / 60 / 60 / 24).'</div>
              <div class="col">'.$jobs->inspection_chargers.'</div>'
                 .'</div>';
     }
    // echo '<div>';
  }
    
    //redy jobs
       public function name_vise_recive_donejobs($uname,$dates) {
        $this->db->from('jobs as jo');        
        $this->db->where('ready_by', $uname);
        $this->db->like('ready_date',$dates);   
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        
        $query = $this->db->get();
       $job= $query->result();
       
       echo'
             <div class="row">
              <div class="col-sm-2">Job No</div>
              <div class="col ">Item</div>
              <div class="col">Date</div>
              <div class="col-sm-2 text-center">Due Date</div>
              <div class="col text-center">Cost</div>
          </div>';
         $total='';
         foreach ($job as $jobs) { 
           
             if(!empty($jobs->dispatch_date)){ $coler='bg-success';}
             else{
                 $coler='';
             }
        
         echo '<div class="row border-bottom border-dark '.$coler.'">
              <div class="col-sm-2"><a href="'. base_url('repair/detailsrma?rma='.$jobs->job_number.'').' " target="_blank">'.$jobs->job_number.'</a></div>
              <div class="col">'.$jobs->item_name.' / '.$jobs->item_description.'</div>
              <div class="col">'.$jobs->ready_date.' </div>
              <div class="col-sm-2 text-center">'.floor((strtotime($jobs->ready_date) - strtotime($jobs->job_date)) / 60 / 60 / 24).'</div>
              <div class="col text-center">'.number_format($jobs->inspection_chargers+$jobs->repair_chargers,2).'</div>'
                 .'</div>';
         }
         
$this->db->select_sum('total');
$this->db->select_sum('repair_chargers');
$this->db->where('ready_by', $uname);
$this->db->like('ready_date',$dates); 
$this->db->join('jobs_dispach as dis', 'jobs.job_number = dis.job_number', 'LEFT');
$this->db->select_sum('dis.total');
$result = $this->db->get('jobs')->row();  
 
         
         echo'
             <div class="row">
              <div class="col-sm-2"></div>
              <div class="col "></div>
              <div class="col"></div>
              <div class="col-sm-2 text-center">Total</div>
              <div class="col text-center">'.number_format($result->total,2).'</div>
          </div>';
    }
    
    
    
    public function name_vise_recive_dispachjob($uname,$dates) {
        $this->db->from('jobs as jo');
        $this->db->where('dispatch_by', $uname);
        $this->db->like('dispatch_date', $dates);
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $query = $this->db->get();
        $job= $query->result();
      //  echo '<div class="container-fluid">';
        echo' <div class="row">
              <div class="col-sm-2">Job No</div>
              <div class="col">Item</div>
              <div class="col">Date</div>
              <div class="col">Due Date</div>
              <div class="col">Cost</div>
             </div>';
         foreach ($job as $jobs) {     
         echo '<div class="row border-bottom border-dark ">
              <div class="col-sm-2"><a href="'. base_url('repair/detailsrma?rma='.$jobs->job_number.'').' " target="_blank">'.$jobs->job_number.'</a></div>
              <div class="col">'.$jobs->item_name.' / '.$jobs->item_description.'</div>
              <div class="col">'.$jobs->dispatch_date.' </div>
              <div class="col">'.floor((strtotime($jobs->dispatch_date) - strtotime($jobs->ready_date)) / 60 / 60 / 24).'</div>'
              . '<div class="col">'.number_format($jobs->inspection_chargers+$jobs->repair_chargers,2).'</div></div>';
         }

 
      
    }
    
    
    
public function jobs_supplier() {
        $this->db->from('sup_send as sup');
        $this->db->where('sup.sup_status>=', 1);
        $this->db->where('sup.sup_status <=', 3);
        $this->db->group_by('sup.supplier_id'); 
        $this->db->join('supplier as supp', 'supp.supplier_id = sup.supplier_id', 'LEFT');
        $this->db->join('jobs as jo', 'sup.job_number= jo.job_number', 'LEFT');
        $query = $this->db->get();
        return $query->result();
}


public function count_pending($supplier_id) {
        $this->db->from('sup_send as sup');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('sup_status>=', 1);
        $this->db->where('sup_status <=', 3);       
        $query = $this->db->get();
        echo $query->num_rows();
    
}


    
public function shop_supplier_pending() {
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status>=', 1);
        $this->db->where('jo.job_status <=', 3);
        $this->db->join('sup_send as su', 'jo.job_number = su.job_number', 'LEFT');
        $this->db->join('supplier as supp', 'supp.supplier_id = su.supplier_id', 'LEFT');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $this->db->group_by('supp.supplier_id');
      //  $this->db->join('jobs as jo', 'sup.job_number= jo.job_number', 'LEFT');       
       // $this->db->where('jo.customer_name',$this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name, 'LEFT'); 
        $query = $this->db->get();
        return $query->result();
  
}


public function shop_pending() {
 $shop_name=   $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name;
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status>=', 1);
        $this->db->where('jo.job_status <=', 3);
        $this->db->join('sup_send as su', 'jo.job_number = su.job_number', 'LEFT');
        $this->db->join('supplier as supp', 'supp.supplier_id = su.supplier_id', 'LEFT');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
       // $this->db->group_by('jo.customer_name');
        $this->db->where('jo.customer_name',$shop_name);
        $query = $this->db->get();
        return $query->result();
  
}


    
public function shop_items_pending($supplier_id) {
 $shop_name=   $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name;
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status>=', 1);
        $this->db->where('jo.job_status <=', 3);
        $this->db->join('sup_send as su', 'jo.job_number = su.job_number', 'LEFT');
        $this->db->join('supplier as supp', 'supp.supplier_id = su.supplier_id', 'LEFT');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $this->db->where('jo.customer_name',$shop_name);
        $this->db->where('su.supplier_id',$supplier_id);
        $query = $this->db->get();
        return $query->result();
       
  
}


public function one_supplier_pending($supplier_id) {
        $this->db->from('jobs as jo');
        $this->db->where('jo.job_status>=', 1);
        $this->db->where('jo.job_status <=', 3);
        $this->db->join('sup_send as su', 'jo.job_number = su.job_number', 'LEFT');
        $this->db->join('supplier as supp', 'supp.supplier_id = su.supplier_id', 'LEFT');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $this->db->where('su.supplier_id',$supplier_id);
        $query = $this->db->get();
        return $query->result();
  
}




public function daly_despatch($dispach_date){    
        $this->db->from('jobs as jo');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $this->db->where('jo.job_status',6);
        $this->db->like('jo.dispatch_date',$dispach_date);
        $query = $this->db->get();
        return $query->result();
        
  
}


public function user_dispach_daly() {
    $this->db->from('jobs as jo');
        $this->db->join('item_list as itl', 'jo.item_id = itl.item_id', 'LEFT');
        $this->db->where('jo.job_status',6);
        $this->db->like('jo.dispatch_date',date('Y-m-d'));
        $this->db->where('jo.dispatch_by',$this->session->uname);
        $query = $this->db->get();
        return $query->result();
    
}




}
?>

