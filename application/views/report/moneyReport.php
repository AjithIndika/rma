
<div class="container" style="margin-top: 80px">

<div class="container">
  <h4><?php echo $page_title?></h4>
  
  <form action="" method="post" class="form-inline">
  <input type="month"   class="form-control" value="<?php if(!empty($this->input->post('month'))){echo $this->input->post('month');}else{echo date('Y-m');}?>" name="month">      
  &MediumSpace; <button type="submit" class="btn btn-primary">Submit</button>
  </form>
 
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Invoice Income</th>
        <th>Handover</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
        
    <?php  
    
    if(!empty($this->input->post('month'))){
        $date = $this->input->post('month');}
        else{
           $date = date('Y-m');}
            
    
    $coun=1;
    $cash_report=$this->Report_model->cash_report($date);
    foreach ($cash_report as $cash_report) { ?>
    
      <tr>
        <td><?php echo  $coun++?></td>
        <td data-toggle="modal" data-target="#dispach<?php echo $cash_report->jobs_dispach_id?>"><?php echo 	$cash_report->dispach_date?></td>
        <td><?php echo 	$cash_report->invoice_income?></td>
        <td><?php echo 	$cash_report->repair_recive?></td>
        <td><?php echo 	$cash_report->total?></td>
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
            
            
     
    <?php   }?>
    </tbody>
  </table>
</div>
    
</div>