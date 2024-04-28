<?php 
if(empty($this->session->admin)){
    redirect(base_url('sys/dash'));
}
?>
<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>
    <div class="row" >
       
        <div class="col-sm-4">
            <a href="<?php echo base_url('account/usersr')?>">
            <button type="button" class="btn btn-primary col-sm-12 "><h4 class="font-weight-bold">New User</h4></button>
             </a> 
        </div>
         

        <div class="col-sm-4">
             <a href="<?php echo base_url('sys/supplier')?>">
            <button type="button" class="btn btn-primary col-sm-12"><h4 class="font-weight-bold">Supplier's </h4></button>
             </a>
        </div>


        <div class="col-sm-4">
           <a href="<?php echo base_url('items')?>">
            <button type="button" class="btn btn-primary col-sm-12"><h4 class="font-weight-bold">Items</h4></button>
             </a>
        </div>
    </div>


</div>

