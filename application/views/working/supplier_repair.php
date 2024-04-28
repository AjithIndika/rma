<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<div  class="container col-sm-12 " style="margin-top:80px"> 
      <h5><?php echo $page_title?></h5>
    <?php if(!empty($error)){echo $error;}?>
<div class="container bg-white">
          
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job No</th>
                            <th>Supplier</th>
                            <th>Parts</th>
                            <th>SN</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $print = $this->Repair_model->print_courier_list();
                        foreach ($print as $print) {
                            ?>

                            <tr>
                                <td><?php echo $print->job_number ?></td>
                                <td><?php if (!empty($print->warranty)) {  echo '  <i class="la la-certificate la-2x text-danger"></i>';  } ?> <?php echo $print->supplier_name ?></td>
                                <td><?php echo $print->item_name ?> / <?php echo $print->item_description ?></td>
                                <td><?php echo $print->serial_no ?></td>
                                <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#send<?php echo $print->job_number ?>">Update Supplier Note</button>
                                </td>
                            </tr>
                            
                            
                            <!----  supplier update !------>
                                <!-- The Modal -->
                    <div class="modal" id="send<?php echo $print->job_number ?>">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Ad Send Supplier Details</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form action=""  method="post" > 
                                        <div class="form-group">
                                            <label for="email">Job No</label>
                                            <input type="text" class="form-control"  name="job_number" value="<?php echo $print->job_number ?>" readonly>
                                        </div>
                                        <div class="form-group " style="margin-top:-15px;">
                                            <label for="pwd">Item </label>
                                            <input type="text" class="form-control"  value="<?php echo $print->item_name . '-' . $print->item_description ?>" disabled>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="pwd">Serial </label>
                                            <input type="text" class="form-control"  value="<?php echo $print->serial_no . '-' . $print->tag_no ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="smallSelect">Supplier Name</label>
                                             <input type="text" class="form-control"  value="<?php echo $print->supplier_name ?>" disabled>
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="pwd">Supplier Note No </label>
                                            <input type="text" class="form-control"  name="supplier_note_no" value="<?php echo $print->supplier_note_no ?>" required autocomplete="off">                                        
                                        <?php echo form_error('supplier_note_no', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                         </div>
                                        
                                   
                                         <div class="form-group">
                                            <label for="pwd">Send Item Description </label>
                                            <input type="text" class="form-control"  name="send_item_description" value="<?php echo $print->send_item_description ?>" required autocomplete="off">                                        
                                        <?php echo form_error('ssend_item_description', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                         </div>
                                      
                                        <div class="form-group">
                                            <label for="pwd">Supplier Note Date </label>
                                            <input type="date" class="form-control"  name="supplier_send_date_in_note"  required autocomplete="off">                                        
                                        <?php echo form_error('supplier_send_date_in_note', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                        </div>
                                      
                                       
                                        <input type="submit" class="btn btn-primary" value="Save" name="sup_send" >
                                    </form>



                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
<?php } ?>
                            
                    </tbody>
                </table>
            </div>
</div>