<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<script>
function tab(e) {
    if (e.which == 13) {
        e.target.nextSibling.nextSibling.focus();
        e.preventDefault();
    }
}
var inputs = document.getElementsByTagName('input');
for (var x = 0; x < inputs.length; x++)
{
    var input = inputs[x];
    input.onkeypress = tab;
}</script>

<div class="container bg-white" style="margin-top: 80px">
     <h5>RMA <?php  echo str_pad($this->input->get('no'), 5, "0", STR_PAD_LEFT);;?></h5>
     <div class="row">
         <div class="col  text-center">
              <a href="<?php echo base_url('repair/reedit?no='.str_pad($this->db->select('job_number')->order_by('job_number', "ASC")->limit(1)->get('jobs')->row()->job_number, 5, "0", STR_PAD_LEFT).'');?>"> <button class="btn btn-success">  <i class="la la-step-backward"></i></button></a>
                <?php 
             if (empty($this->input->get('no'))) {
               } else{
                  if(!empty($this->db->get_where('jobs', array('job_number' =>$this->input->get('no')-1))->row()->job_number)) {
                   ?>
            
             <a href="<?php echo base_url('repair/reedit?no='.str_pad($this->input->get('no')-1, 5, "0", STR_PAD_LEFT).'');?>"> <button class="btn btn-success">  <i class="la la-angle-double-left"></i></button></a>
            
               <?php }}?>
       
             <?php 
             if (empty($this->input->get('no'))) {
               } else{
                    if(!empty($this->db->get_where('jobs', array('job_number' =>$this->input->get('no')+1))->row()->job_number)) {
                   ?>
            
                 <a href="<?php echo base_url('repair/reedit?no='.str_pad($this->input->get('no')+1, 5, "0", STR_PAD_LEFT).'');?>"> 
                     <button class="btn btn-success"><i class="la la-angle-double-right"></i></button></a>             
               <?php }}?>
             
              <a href="<?php echo base_url('repair/reedit?no='.str_pad($this->db->select('job_number')->order_by('job_number', "DESC")->limit(1)->get('jobs')->row()->job_number, 5, "0", STR_PAD_LEFT).'');?>"> <button class="btn btn-success">  <i class="la la-step-forward"></i></button></a>
         
         </div>
         <div class="col">
             <form action="" method="get">
             <input type="text" class="form-control col-sm-7" id="email" name="no"  required autocomplete="off">
             <input  type="submit" class="btn btn-success" value="Success" style="display: none">
             </form>
         </div>
     </div>
    <form action="" method="post">
        
        <?php 
        
        $job=$this->input->get('no');
        
   $jobdata=   $this->Repair_model->jobs($job);
   if(!empty($jobdata)){
   foreach ($jobdata as  $jobdata) { ?>
     
       
        <input type="hidden"  name="job_number" value="<?php echo $jobdata->job_number?>" >

        <div class="row mt-5">
            <div class="col-sm-2"><h6>Customer Name</h6></div>
            <div class="col">
                <input type="text" class="form-control col-sm-7" id="email" name="customer_name" value="<?php echo $jobdata->customer_name?>" required autocomplete="off">
                
<?php echo form_error('customer_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Mobile Number:</h6></div>
            <div class="col-sm-4"><input type="tel" class="form-control " placeholder="Mobile Number" id="pwd" name="mobile_number" value="<?php echo $jobdata->mobile_number?>" required autocomplete="off" maxlength="10">
<?php echo form_error('mobile_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
            <div class="col-sm-4"><input type="tel" class="form-control " placeholder="Lane Number" id="pwd" name="lane_number" value="<?php echo $jobdata->lane_number?>" autocomplete="off" maxlength="10">
                <?php echo form_error('lane_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Address:</h6></div>
            <div class="col-sm-8">
                <input type="text" value="<?php echo $jobdata->address?>" class="form-control " name="address"  autocomplete="off">                         
               <?php echo form_error('address', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Invoice No</h6></div>
            <div class="col-sm-3"> <input type="text" class="form-control " id="pwd" name="invoice_no" value="<?php echo $jobdata->invoice_no?>" autocomplete="off"> </div>
            <div class="col-sm-3"><input type="date" class="form-control "  id="pwd" name="invoice_date" value="<?php echo $jobdata->invoice_date?>" autocomplete="off"></div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item</h6></div>
            <div class="col-sm-3">
                <select class="form-control select2 " name="item_id" required autocomplete="off">
                    <option value="<?php echo $jobdata->item_id?>"><?php echo $jobdata->item_name?></option>
                <?php foreach ($item_list as $value) {
                    echo '<option value="' . $value->item_id . '">' .$value->item_name . '</option>';
                }
                ?>
                </select>
<?php echo form_error('item_id', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item Description:</h6></div>
            <div class="col"> 
                <input type="text" class="form-control col-sm-8" name="item_description"  required autocomplete="off" value="<?php echo $jobdata->item_description?>">
                         
<?php echo form_error('item_description', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Serial No:</h6></div>
            <div class="col-sm-3">  <input type="text" class="form-control " placeholder="Serial No" id="pwd" name="serial_no" value="<?php if (!empty($this->input->post('serial_no'))) {
    echo $this->input->post('serial_no');
} ?>" autocomplete="off"> </div>
            <div class="col-sm-3">  <input type="text" class="form-control "  id="pwd" placeholder="Tag No" value="<?php echo $jobdata->tag_no?>" name="tag_no" autocomplete="off"> </div>
        </div>

        <div class="row mt-2"  >
            <div class="col-sm-2"></div>
            <div class="col-sm-3 form-check " id="warrantys" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"  onchange="ckChange(this)" id="warranty" name="warranty" <?php if (!empty($jobdata->warranty)) {
    echo 'checked';
} ?> style="display:block">
                    <span class="form-check-sign">Warranty</span>
                </label>      
            </div>

            <div class="col-sm-3 form-check " id="damage" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"  id="mark"  onchange="ckCkhanges(this)" name="mark" <?php if (!empty($jobdata->mark)) { echo 'checked';} ?>  style="display:block">
                    <span class="form-check-sign">Physical Damage/ Burn Mark </span>
                </label>      
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Acc: Receiving:</h6></div>
            <div class="col-sm-7"> 
                <input type="text" class="form-control " name="accessories_receiving" placeholder="Accessories Receiving" required autocomplete="off" value="<?php echo $jobdata->accessories_receiving?>">  </div>
       </div>

           <div class="row mt-2">
            <div class="col-sm-2"><h6>Complaint:</h6></div>
            <div class="col-sm-7">
                <input type="text" value="<?php echo $jobdata->customer_complaint?>" class="form-control " placeholder="Customer Complaint" name="customer_complaint" required autocomplete="off">               
            <?php echo form_error('customer_complaint', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
          </div>
           </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Others:</h6></div>
            <div class="col-sm-7"> 
                <input type="text" value="<?php echo $jobdata->others?>" class="form-control "  placeholder="Others" name="others" autocomplete="off">
                </div>
           </div>
        
        <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-7 form-check" id="required_estimate" style="display:block"> <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="1" name="required_estimate" <?php if (!empty($jobdata->required_estimate)) {  echo 'checked';} ?>>
                <span class="form-check-sign">Required Estimate</span>
            </label> </div>
        </div>
        
         <div class="row mt-2">
             <div class="col-sm-2"><h6>Chargers</h6></div>
            <div class="col-sm-7 ">  <input type="text" class="form-control col-sm-3" value="<?php echo $jobdata->inspection_chargers?>" id="inspection_chargers" name="inspection_chargers"> </div>
        </div>

        <?php if(!empty($this->session->edit) OR !empty($this->session->admin) ){?>
        <!--- --!--->
  <div class="row mt-2 mb-5"> 
      <div class="col-sm-4"></div>
  <div class="col"> <input type="submit" class="btn btn-primary" name="update" value="Update"> </div>
  <div class="col-sm-7 "> </div>     
  </div>

        <?php }?>  
    </form>


</div>
<?php } } ?>
<script>
    $('.select2').select2();
</script>

<script>
    function ckChange() {
        var checkBox = document.getElementById("warranty");
        var damage = document.getElementById("damage");
        var required_estimate= document.getElementById("required_estimate");
        
        if (checkBox.checked == true) {
            damage.style.display = "none";
             required_estimate.style.display = "none";
            document.getElementById("inspection_chargers") .value=0;
        } else {
            damage.style.display = "block";
             required_estimate.style.display = "block";
             document.getElementById("inspection_chargers") .value=350;
        }
    }
    
    function ckCkhanges() {
        var checkBox = document.getElementById("mark");
        var damage = document.getElementById("warrantys");
       
        
        if (checkBox.checked == true) {
            damage.style.display = "none";
             required_estimate.style.display = "block";
        } else {
            damage.style.display = "block";
             required_estimate.style.display = "block";
        }
    }
    

/*

    function ckCkhange() {
        var checkBox = document.getElementById("mark");
        var send_item_description = document.getElementById("send_item_description");
        if (checkBox.checked == true) {
            send_item_description.style.display = "none";
        } else {
            send_item_description.style.display = "block";
        }
    }
*/
</script>
