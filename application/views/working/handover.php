<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<html>
    <head>
        <title>Print <?php echo $this->input->get('no'); ?></title>
         <link rel="shortcut icon" href="<?php echo base_url('images/logo.jpg')?>"  /> 
<link rel="stylesheet" href="<?php echo base_url('boost_assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/ready.css'); ?>">
<link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/demo.css'); ?>">
<script src="<?php //echo base_url('boost_assets/js/jquery.min.js') ?>"></script>



<style>
     td{font-size: 20px;
       width: 33%;}
    table{width:100%;}
    .jk{text-align:right;}
     .js{text-align:left;  }
 

</style>   

    </head>
    
 <div class="content col-sm-11">
    <form id="form1">
        <div id="GFG" class="container col-sm-12 " >
            <div class="container col-sm-12">
                <div class="row">
                    <div></div>

                </div>
            </div>


       
            
             <div class="row col-sm-12">                
                <div class="col bg-primary rounded">
                    <h3 class="text-light mt-3 ml-5">  SERVICE RECIPT</h3>
                </div>
                <div class="col-sm-6"><h5 class="mt-1">
                    <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?></br>
                    <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_1 ?>,
                    <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_2 ?>.</br>
                    Tel: <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->tp_no?> 
                    </div>
                   </div>
            
            
             <hr class="bg-dark"></hr>
            <div class="row col-sm-12 mb-2">              
             <div class="col-sm-8 border-gray rounded border"> Receipt To: <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->customer_name ?></div>
             <div class="col-sm-4 ">
                 <div class="row col-sm-12">
                     <div class="col-sm-6 " >Date</div>
                      <div class="col">: <?php echo date('Y-m-d') ?></div>
                 </div>
                 
                  <div class="row col-sm-12">
                     <div class="col-sm-6 " >RMA No</div>
                      <div class="col">: <?php echo $this->input->get('no'); ?></div>
                 </div>
                 
                  <div class="row col-sm-12">
                     <div class="col-sm-6 " >Created By</div>
                      <div class="col">: <?php echo  $this->session->uname; ?></div>
                 </div>
                 
                 
             </div>
            
            </div>
             
         
             
             <div class="row col-sm-12 mt-1">                 
             <div class="col-sm-3">Item Category </div>
             <div class="col "> : <?php $item_id = $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->item_id;echo $this->db->get_where(' item_list', array('item_id' => $item_id))->row()->item_name?> ( <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->item_description;?> )</div>
             </div>
             
            
             
             <div class="row col-sm-12 mt-1">               
             <div class="col-sm-3">Complain   </div>
             <div class="col-sm-3"> : <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->customer_complaint;?> </div>             
             </div>
             
              <div class="row col-sm-12 mt-1">               
             <div class="col-sm-3">Chang Item   </div>
             <div class="col"> : 
                 <?php $issued_item_id = $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->issued_item_id;echo $this->db->get_where('item_list', array('item_id' => $issued_item_id ))->row()->item_name?>  
                 New Sn :<?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->issued_item_id?>
                  New Tag :<?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->new_tag?>
             </div>             
             </div>
             
             
             
           
          
             <div class="col-sm-12 border-top border-dark mt-3"></div>
             
         
             
              <div class="row col-sm-12">                 
             <div class="col-sm-3"></div>
             <div class="col-sm-4 "></div>
             <div class="col-sm-3">Inspection Charges </div>
             <div class="col" style="margin-left:-50px"> : Rs. <?php echo number_format($this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->inspection_chargers, 2) ?></div>
              </div>
             
               <div class="row col-sm-12">                 
             <div class="col-sm-3"> </div>
             <div class="col-sm-4 "></div>
             <div class="col-sm-3">Repair/Service Charges </div>
             <div class="col" style="margin-left:-50px"> : Rs. <?php echo number_format($this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->repair_chargers, 2) ?></div>
              </div>
             
              <div class="row col-sm-12">                 
             <div class="col-sm-3"> </div>
             <div class="col-sm-4 "></div>
             <div class="col-sm-3">Total Amount</div>
             <div class="col" style="margin-left:-50px"> : Rs. <?php echo number_format($this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->inspection_chargers+$this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->repair_chargers, 2) ?></div>
              </div>
             
             
             <?php if(!empty($this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->rmanote_missing)){?>
              <div class="row col-sm-12">                 
             <div class="col-sm-3"></div>
             
              </div>
             <?php }?>
       
           
       
                
               <div class="row mt-3">
                   <hr class="bg-dark"></hr> 
                    <div class="col text-center">Thank you for business with us !</div>
                  
               </div>
                
                
             <div class="mt-3"> <hr class=" style3"></hr> </div>
             
             <div class="row">
                 <div class="border border-dark col">
                     Dispatch to </br>
                  <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->riceived_name?> </br>
                  Nic : <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->riceived_nic?>
                 </div>
                  <div class=" col"></div>
             </div>
             
               <div class="row border border-dark mt-1">
                 <div class="col border border-dark">Date</div>
                  <div class=" col border border-dark"><?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->dispatch_date?></div>
                   <div class=" col border border-dark">RMA No</div>
                  <div class=" col border border-dark"><?php echo $this->input->get('no')?></div>
             </div>
             
              <div class="row border border-dark mt-1">
                 <div class="col border border-dark">Dispatch By</div>
                  <div class=" col border border-dark"><?php echo  $this->session->uname; ?></div>
                   <div class=" col border border-dark">Dispatch Item</div>
                  <div class=" col border border-dark"> <?php $item_id = $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->item_id;echo $this->db->get_where(' item_list', array('item_id' => $item_id))->row()->item_name?> ( <?php echo $this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->item_description;?> )</div>
             </div>
             
              <?php if(!empty($this->db->get_where('jobs', array('job_number' => $this->input->get('no')))->row()->rmanote_missing)){?>
             
             <div class="row  mt-2">
                 <div class="col ">I have collected this item without RMA Note, and I accept all terms and conditions of <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?>.</div>
              </div>
             
             
              <?php }?>
             
             
               <div class="row  mt-2">
                 <div class="col ">Received in good condition</div>
              </div>
             
               <div class="row mt-5">
                    <div class="col">.............................................</br>Customer Confirmation</div>
                    <div class="col jk"><?php echo  $this->session->uname; ?></br>Accepting Officer In charge</div>
                    
                </div>
             
             
            
        
           
             </div>
            
            
          
            <button id="print" onclick="printContent('GFG');" class="btn btn-success">Print</button>
            
        </div>

    </form>
 </div>
<script>
function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>

<style>
    hr.style3 {
	border-top: 1px dashed #8c8b8b;
}

</style>


