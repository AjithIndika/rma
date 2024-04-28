<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>

<script>
  
function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
   
</script>


<div class="content">
    <div class="container-fluid">
        <h4 class="page-title">Dashboard</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-stats card-warning rounded">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="la la-wrench"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Today Jobs</p>
                                    <h4 class="card-title"><?php $this->Report_model->today_jobs() ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded">
                <div class="card card-stats card-success">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="la la-thumbs-o-up"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Today Dispatch</p>
                                    <h4 class="card-title"><?php $this->Report_model->today_dispach() ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded">
                <div class="card card-stats card-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="la la-hourglass-half"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Pending Supplier</p>
                                    <h4 class="card-title"><?php $this->Report_model->pending_supplier() ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-stats card-primary">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="la la-check-circle"></i>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="numbers">
                                    <p class="card-category">Done Jobs</p>
                                    <h4 class="card-title"><?php $this->Report_model->donejobs() ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row row-card-no-pd">
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mt-1">Today</p>
                        <h4><b>Rs/ <?php $this->Report_model->today_income(); ?></b></h4>                      
                    </div>
                </div>
            </div>
            
            <!----allpending cash !------->
            <div class="col-md-12 mt-3" id="printPending">
                <h4 class="text-capitalize"><em>Pending Cash</em></h4>
                <div class="card">                    
                  <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
		     <th>Invoice </th>
                    <th>Received From Technical</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $coun = 1;
               $cash_reports = $this->Report_model-> pending_cash_report();
                if(!empty($cash_reports)){
                foreach ($cash_reports  as $cash_report) {
                    ?>

                    <tr>
                        <td><?php echo $coun++ ?></td>
                        <td  data-toggle="modal" data-target="#dispach<?php echo $cash_report->jobs_dispach_id?>"><?php echo $cash_report->dispach_date ?></td>
                        <td><?php echo $cash_report->invoice_income ?></td>
                        <td><?php echo $cash_report->repair_recive ?></td>
                        <td><?php if(!empty($this->session->admin) or empty($this->session->edit)){
                            echo '<a href="" data-toggle="modal" data-target="#cash'.$cash_report->jobs_dispach_id .'">'.$cash_report->total.'</a>';
                            
                        }else{ echo $cash_report->total;}?></td>
                    </tr>
                    
                    
                    
                    
                    
            <!-- dispach list !------------>
            <!-- The Modal -->
<div class="modal fade" id="dispach<?php echo $cash_report->jobs_dispach_id?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Dispatch List of <?php echo $cash_report->dispach_date ?> </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
          <div class="row">
              <div class="col">Job No:</div>
              <div class="col">Item</div>
              <div class="col">Dispatch By</div>
              <div class="col">inspection</div>
              <div class="col">Repair</div>
               <div class="col">Total</div>
          </div>
          <?php
          $tota[]=array();
        $dispach_date=  $cash_report->dispach_date;
        $daly=   $this->Report_model->daly_despatch($dispach_date);
        foreach ($daly as $daly) { 
             $tota[]=$daly->repair_chargers + $daly->inspection_chargers;
             ?>
          
           <div class="row border">
              <div class="col "><?php echo $daly->job_number?></div>
              <div class="col"><?php echo $daly->item_name?></div>
              <div class="col"><?php echo $daly->dispatch_by?></div>
              <div class="col"><?php echo number_format($daly->inspection_chargers,2)?></div>
              <div class="col"><?php echo number_format($daly->repair_chargers,2)?></div>
               <div class="col"><?php echo number_format($daly->repair_chargers + $daly->inspection_chargers,2)?></div>
          </div>
            
        <?php }?>
          
           <div class="row mt-3">
              <div class="col"></div>
              <div class="col"></div>
              <div class="col"></div>
              <div class="col"></div>
              <div class="col">Total Of Day</div>
              <div class="col"><?php print_r(number_format(array_sum($tota),2))?></div>
          </div>
          
          
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
            
            
            
            
                    
                    <!-- money -->
<div class="modal" id="cash<?php echo $cash_report->jobs_dispach_id ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> Technical Cash Rs. </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('sys/oldcash') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Date</label>
                        <input type="text" class="form-control"  value="<?php echo $cash_report->dispach_date?>" id="email" name="old_date" readonly>
                 </div>
 <div class="form-group">
                        <label for="email">Cash</label>
                        <input type="number" class="form-control" placeholder="Enter Cash" value="<?php echo $cash_report->total?>" step="00.00" id="email" name="cash">
                        <input type="hidden" value="<?php echo current_url(); ?>" name="url_name">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit"  name="cash_recive">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


                <?php }} ?>
            </tbody>
        </table>              
                </div>

            </div>
           
            <!----allpending jobs !------->
       
            <div class="col-md-12 mt-3" id="printPending">
                <h4 class="text-capitalize"><em>All Pending Jobs</em></h4>
                <div class="card">                    
                    <table class="table table-head-bg-success table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Job Number</th>
                                <th scope="col">Item</th>
                                <th scope="col">Job BY</th>
                                 <th scope="col">Job Date</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Send Date</th>
                                <th scope="col">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cout = 1;
                            $pending = $this->Report_model->pending_supplier_joblist();
                            foreach ($pending as $pending) {
                                ?>

                                <tr
                                     <?php
                                        if (!empty($pending->job_date)) {
                                            if ((strtotime(date('Y-m-d')) - strtotime(date_format(date_create($pending->job_date),"Y-m-d"))) / 60 / 60 / 24 > 12) {
                                                echo 'class="bg-danger"';
                                            }
                                        }
                                        ?>
                                    >
                                    <td><?php echo $cout++ ?></td>
                                    <td><a href="<?php echo base_url('repair/detailsrma?rma=' . $pending->job_number . '') ?>" target="blank"><?php echo $pending->job_number ?></a></td>
                                    <td><?php echo $pending->item_name ?> / <?php echo $pending->item_description ?> </td>
                                     <td><?php echo $pending->job_by ?></td>
                                     <td><?php echo date("Y-m-d", strtotime($pending->job_date)) ?></td>  
                                    <td><?php  if(!empty($this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_id)){$supplier_id= $this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_id;echo $this->db->get_where('supplier', array('supplier_id' => $supplier_id))->row()->supplier_name;} ?></td>
                                    <td><?php  if(!empty($this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_send_date_in_note)){echo $this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_send_date_in_note;} ?></td>
                                    <td><?php
                                        if (!empty($pending->job_date)) {
                                          //  echo date_format(date_create($pending->job_date),"Y-m-d");
                                            
                                        echo (strtotime(date('Y-m-d')) - strtotime(date_format(date_create($pending->job_date),"Y-m-d"))) / 60 / 60 / 24;
                                        }
                                        ?>
                                        <?php
                                        if (!empty($pending->job_date)) {
                                            if ((strtotime(date('Y-m-d')) - strtotime(date_format(date_create($pending->job_date),"Y-m-d"))) / 60 / 60 / 24 > 12) {
                                                echo '<i class="la la-long-arrow-up text-danger"></i>';
                                            }
                                        }
                                        ?></td>
                                </tr>
                                    <?php } ?>
                        </tbody>
                    </table>                  
                </div>

            </div>
            <div class="mb-5"> <button id="print" class="btn btn-success rounded" onclick="printContent('printPending');" > <i class="la la-print la-2x"></i></button></div>

        </div>

    </div>
    <div class="container-fluid">
        
        <div class="row row-card-no-pd" style="margin-top: -80px">  
            
            <div class="col-md-12">
                <h4 class="text-capitalize"><em>Supplier Pending Jobs</em></h4>
                <div class="card">                    
                    <table class="table table-head-bg-success table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Item</th>
                                <th scope="col">Job By</th>
                                <th scope="col">Job Date</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Send Date</th>                                
                                <th scope="col">Due Date</th>
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cout = 1;
                            $pe = $this->Report_model->pending_alljobs();
                            foreach ($pe as $pe) {
                                ?>

                                <tr 
                                      <?php if (!empty($pe->job_date)) {if($pe->job_date==date('Y-m-d')){echo '';} else{  if((strtotime(date('Y-m-d')) - strtotime(date_format(date_create($pe->job_date),"Y-m-d") )) / 60 / 60 / 24>7){ echo 'class="bg-danger"';} }}?>
                                    >
                                    <td><?php echo $cout++ ?></td>
                                    <td><a href="<?php echo base_url('repair/detailsrma?rma=' . $pe->job_number . '') ?>" target="blank"><?php echo $pe->job_number ?></a></td>
                                    <td><?php echo $pe->item_name ?> / <?php echo $pe->item_description ?> </td>
                                    <td><?php echo $pe->job_by ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($pe->job_date)) ?></td>                                   
                                    <td><?php  if(!empty($this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_id)){$supplier_id= $this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_id;echo $this->db->get_where('supplier', array('supplier_id' => $supplier_id))->row()->supplier_name;} ?></td>
                                    <td><?php  if(!empty($this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_send_date_in_note)){echo $this->db->get_where('sup_send', array('job_number' => $pending->job_number))->row()->supplier_send_date_in_note;} ?></td>
                                    
                                    <td><?php
                                       // if (!empty($pe->supplier_send_date_in_note)) {
                                        //    echo (strtotime(date('Y-m-d')) - strtotime($pe->supplier_send_date_in_note)) / 60 / 60 / 24;
                                       // }
                                        ?>
                                <?php if (!empty($pe->job_date)) {if($pe->job_date==date('Y-m-d')){echo '0';} else{  echo (strtotime(date('Y-m-d')) - strtotime(date_format(date_create($pe->job_date),"Y-m-d"))) / 60 / 60 / 24; }}?></td>
                                    
                                </tr>
<?php } ?>
                        </tbody>
                    </table>                  
                </div>

            </div>

        </div>
        
    </div>
</div>
