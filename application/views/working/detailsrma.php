<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<div class="container" style="margin-top: 80px">
    <?php 
  $rma = $this->input->get('rma');  
  $rmadetails= $this->Report_model->rmadetails($rma);
  foreach ($rmadetails as $re) {
 
    ?>
    
    <div class="row mt-2">
           <div class="col-sm-2"></div>
           <div class="col-sm-6  rounded"><h4 class="text-success font-weight-bold"><?php echo  $re->now_job?></h4></div>
            
        </div>
    
    
      <div class="row mt-5">
            <div class="col-sm-2"><h6>Job No</h6></div>
            <div class="col"><input type="text" class="form-control col-sm-7" value="<?php echo $re->job_number?>" disabled>
  </div>
        </div>
    
    
   <div class="row mt-5">
            <div class="col-sm-2"><h6>Customer Name</h6></div>
            <div class="col"><input type="text" class="form-control col-sm-7" value="<?php echo $re->customer_name?>" disabled>
  </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Mobile Number:</h6></div>
            <div class="col-sm-4"><input type="tel" class="form-control "  value="<?php echo $re->mobile_number?>" disabled></div>
            <div class="col-sm-4"><input type="tel" class="form-control " name="lane_number" value="<?php echo $re->lane_number?>" disabled>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Address:</h6></div>
            <div class="col-sm-8"> <textarea class="form-control " name="address" disabled><?php echo $re->address?></textarea>            
 </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Invoice No</h6></div>
            <div class="col-sm-3"> <input type="text" class="form-control "  value="<?php echo $re->invoice_no?>" disabled> </div>
            <div class="col-sm-3"><input type="text" class="form-control "  name="invoice_date" value="<?php echo date("Y-m-d",strtotime($re->invoice_date))?>" disabled></div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item</h6></div>
            <div class="col-sm-3"><?php echo $re->item_name?></div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item Description:</h6></div>
            <div class="col"> 
                <textarea class="form-control col-sm-8" name="item_description" disabled><?php echo $re->item_description?></textarea>           
         </div>

        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Serial No:</h6></div>
            <div class="col-sm-3">  <input type="text" class="form-control "  value="<?php echo $re->serial_no?>" disabled> </div>
            <div class="col-sm-3">  <input type="text" class="form-control "   value="<?php echo $re->tag_no?>" disabled> </div>
        </div>

        <div class="row mt-2"  >
            <div class="col-sm-2"></div>
            <div class="col-sm-3 form-check " id="warrantys" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"   <?php if (!empty($re->warranty)) {  echo 'checked';} ?>  disabled>
                    <span class="form-check-sign">Warranty</span>
                </label>      
            </div>

            <div class="col-sm-3 form-check " id="damage" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"    <?php if (!empty($re->mark)) {echo 'checked';} ?>   disabled >
                    <span class="form-check-sign">Physical Damage/ Burn Mark </span>
                </label>      
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Acc: Receiving:</h6></div>
            <div class="col-sm-7">  <textarea class="form-control " disabled><?php  echo $re->accessories_receiving; ?></textarea>   </div>
        </div>

           <div class="row mt-2">
            <div class="col-sm-2"><h6>Complaint:</h6></div>
            <div class="col-sm-7"><textarea class="form-control "  disabled><?php echo $re->customer_complaint;?></textarea>  
          
          </div>
           </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Others:</h6></div>
            <div class="col-sm-7">    <textarea class="form-control "  disabled><?php echo $re->others ?></textarea> </div>
           </div>
        
        <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-3 form-check"> <label class="form-check-label">
                <input class="form-check-input" type="checkbox" disabled <?php if (!empty($re->required_estimate)) {  echo 'checked';} ?>>
                <span class="form-check-sign">Required Estimate</span>
            </label> </div>
            <div class="col">
             <?php if(!empty($re->required_estimate) AND empty($re->send_estimate_date)){?>             
                <a href="<?php echo base_url('repair/estimate?rma='.$re->job_number.'');?>"><button type="button" class="btn btn-success">Send Estimate</button></a>
             <?php }else{ echo $re->send_estimate_date; echo '  By ' .$re->estimate_by;}?>
            </div>
        </div>
        
         <div class="row mt-2">
             <div class="col-sm-2"><h6>Ins. Chargers</h6></div>
            <div class="col-sm-7 ">  <input type="text" class="form-control col-sm-3" value="<?php echo  $re->inspection_chargers?>" disabled> </div>
        </div>
    
      <div class="row mt-2">
           <div class="col-sm-2"><h6>Job Ad</h6></div>
           <div class="col"> <?php echo  $re->job_by?> &MediumSpace;( <?php echo  $re->job_date?>)</div>
     </div>
  
    <?php  }?> 
    <div><hr></hr></div>
    
    <?php $rm= $this->Report_model->supplier_send($rma);
    if(!empty($rm)){
     foreach ($rm as $rm) { ?>
    
      <div class="row mt-2">     
         <div class="col-sm-12 text-center bg-success rounded"><h4 class="text-light mt-1 font-weight-bold"> Supplier Data</h4></div>
     </div>
    
    
     <div class="row mt-2">     
         <div class="col-sm-5 text-center bg-success rounded"><h6 class="text-light mt-1"> Sent Data</h6></div>
     </div>
    
    
            <div class="row mt-2">
             <div class="col-sm-2"><h6>Supplier Name</h6></div>
            <div class="col-sm-7 ">  <input type="text" class="form-control" value="<?php echo  $rm->supplier_name?>" disabled> </div>
            
            </div>
    
    <div class="row mt-2">
             <div class="col-sm-2"><h6>Supplier Note No</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->supplier_note_no?>" disabled> </div>
          
    </div>
    
     
    <div class="row mt-2">
             <div class="col-sm-2"><h6>Description</h6></div>
            <div class="col-sm-8 ">  <input type="text" class="form-control" value="<?php echo  $rm->send_item_description?>" disabled> </div>
            
    </div>
    
    
      <div class="row mt-2">
             <div class="col-sm-2"><h6>Sent Date</h6></div>
             <div class="col-sm-3 ">  <input type="text" class="form-control" value="<?php if(!empty($rm->supplier_send_date)){ echo  date("Y-m-d", strtotime($rm->supplier_send_date));}?>" disabled> </div>
              </div>
 
     <div class="row mt-2">
             <div class="col-sm-2"><h6>Sent by</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->supplier_send_update_by?> (<?php echo  $rm->supplier_send_date?>)" disabled> </div>
       </div>
    
      <div class="row mt-2">
             <div class="col-sm-2"><h6>Check by</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->chek_by?> (<?php echo  $rm->chek_date?>)" disabled> </div>
       </div>
    
    <div><hr></hr></div>
    
     <div class="row mt-2">     
          <div class="col-sm-5 text-center bg-success rounded"><h6 class="text-light mt-1"> Received</h6></div>
     </div>
    
    
     <div class="row mt-2">
             <div class="col-sm-2"><h6>New Part SN</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->sup_new_serial?>" disabled> </div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->sup_new_tag?>" disabled> </div>
     </div>    
    
    <div class="row mt-2">     
          <div class="col-sm-2"><h6> Description</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->chek_by?> (<?php echo  $rm->chek_date?>)" disabled> </div>
       </div>
    
     <div class="row mt-2">
             <div class="col-sm-2"><h6> Date</h6></div>
             <div class="col-sm-3 ">  <input type="text" class="form-control" value="<?php echo  date("Y-m-d", strtotime($rm->received_date))?>" disabled> </div>
             <div class="col-sm-3 "> <input type="text" class="form-control" value="<?php echo (strtotime(date("Y-m-d", strtotime($rm->supplier_send_date))) -  strtotime($rm->received_date))/60/60/24 ?>" disabled> </div>      
     </div>
    
    <div class="row mt-2">
             <div class="col-sm-2"><h6>Received by</h6></div>
            <div class="col-sm-4 ">  <input type="text" class="form-control" value="<?php echo  $rm->sup_received_by?> (<?php echo  $rm->received_date?>)" disabled> </div>
       </div>
    
     
    <?php  } }?>
    
     <?php $rc= $this->Report_model->repair_center_details($rma);
    if(!empty($rc)){
     foreach ($rc as $rc) { ?>
    
     <div class="row mt-2">     
         <div class="col-sm-12 text-center bg-success rounded"><h4 class="text-light mt-1 font-weight-bold"> Repair Center Details</h4></div>
     </div> 
    
     
     <div class="row mt-2">
             <div class="col-sm-2"><h6>Rep Charges</h6></div>
             <div class="col-sm-3 ">  <input type="text" class="form-control col-sm-5" value="<?php echo  $rc->repair_chargers ?>" disabled> </div>
             <div class="col-sm-3 "> <input type="text" class="form-control" value="<?php //echo (strtotime(date("Y-m-d", strtotime($rm->supplier_send_date))) -  strtotime($rm->received_date))/60/60/24 ?>" disabled> </div>      
     </div>
    
      <div class="row mt-2">
             <div class="col-sm-2"><h6>Cus. Inform Date</h6></div>
             <div class="col-sm-3 ">  <input type="text" class="form-control col-sm-8" value="<?php echo  $rc->ready_by ?> (<?php echo  $rc->inform_date ?>)" disabled> </div>
             <div class="col-sm-3 "> <input type="text" class="form-control" value="<?php //echo (strtotime(date("Y-m-d", strtotime($rm->supplier_send_date))) -  strtotime($rm->received_date))/60/60/24 ?>" disabled> </div>      
     </div>
    
    
    
    <?php }}?>
    
    <?php if(!empty($re->riceived_nic)){?>
    <div><hr></hr></div>
    
     <div class="row mt-2">     
         <div class="col-sm-12 text-center bg-success rounded"><h4 class="text-light mt-1 font-weight-bold"> Recive Details</h4></div>
     </div> 
    
     <div class="row mt-2">
             <div class="col-sm-2"><h6>Recive Name</h6></div>
             <div class="col ">  <input type="text" class="form-control col-sm-8" value="<?php echo  $rc->riceived_name ?> " disabled> </div>
     </div>
    
       <div class="row mt-2">
             <div class="col-sm-2"><h6>NIC</h6></div>
             <div class="col-sm-6 ">  <input type="text" class="form-control col-sm-8" value="<?php echo  $rc->riceived_nic ?> " disabled> </div>
     </div>
    
     <div class="row mt-2">
             <div class="col-sm-2"><h6>Dispatch By</h6></div>
             <div class="col-sm-6 ">  <input type="text" class="form-control col-sm-8" value="<?php echo  $rc->dispatch_by ?> ( <?php echo  $rc->dispatch_date ?>) " disabled> </div>
     </div>
    
    <?php } ?>
</div>