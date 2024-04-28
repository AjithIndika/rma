<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<div  class="container col-sm-12 " style="margin-top:80px"> 
     <h5><?php echo $page_title?></h5>
    <?php
    if (!empty($error)) {
        echo $error;
    }
    ?>
    <div class="container bg-white">

        <table class="table">
            <thead>
                <tr>
                    <th>Job No</th>
                    <th>Supplier</th>
                    <th>Parts</th>
                    <th>Sn</th>
                    <th>Received Supplier </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $print = $this->Repair_model->pending_supplier_list();
                foreach ($print as $print) {
                    ?>

                    <tr>
                        <td><?php echo $print->job_number ?></td>
                        <td><?php
                            if (!empty($print->warranty)) {
                                echo '  <i class="la la-certificate la-2x text-danger"></i>';
                            }
                            ?> <?php echo $print->supplier_name ?></td>
                        <td><?php echo $print->item_name ?> / <?php echo $print->item_description ?></td>
                        <td><?php echo $print->serial_no ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#send<?php echo $print->job_number ?>"> Received Update</button>
                        </td>
                    </tr>


                    <!----  supplier update !------>
                    <!-- The Modal -->
                <div class="modal" id="send<?php echo $print->job_number ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Ad Received Supplier Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action=""  method="post" > 
                                    <div class="row">
                                        <div class="col-sm-3"><h6>RMA</h6></div>
                                        <div class="col"> 
                                            <h6> <input type="text" class="form-control"  value="<?php echo $print->job_number ?>" disabled></h6>
                                            <input type="hidden" class="form-control"  name="job_number" value="<?php echo $print->job_number ?>" readonly>
                                        </div>
                                        <div class="col"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"><h6>Supplier Name</h6></div>
                                        <div class="col"><h6><input type="text" class="form-control"  value="<?php echo $print->supplier_name ?>" disabled></h6></div>
                                        <div class="col"> <h6> <input type="text" class="form-control"  value="Not No:  <?php echo $print->supplier_note_no ?>" disabled> <h6></div>
                                                    </div>

                                                    <div class="row ">
                                                        <div class="col-sm-3"><h6>Description</h6></div>
                                                        <div class="col"><input type="text" class="form-control"  value="<?php echo $print->item_name ?>" disabled></div>
                                                        <div class="col"><input type="text" class="form-control"  value=" Tag No<?php echo $print->send_item_description ?>" disabled></div>   
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3"><h6>Serial</h6></div>
                                                        <div class="col"><input type="text" class="form-control"  value="<?php echo $print->serial_no ?>" disabled></div>
                                                        <div class="col"><input type="text" class="form-control"  value=" Tag No<?php echo $print->tag_no ?>" disabled></div>   
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3"><h6>Customer Complaint</h6></div>
                                                        <div class="col"><h6><input type="text" class="form-control"  value="<?php echo $print->customer_complaint ?>" disabled></h6></div>                                       
                                                    </div>
                                                     <div class="row mt-2">
                                                         
                                                         
                                                         <div class="col"> 
                                                             <hr></hr>
                                                             <h5>Received Details</h5></div>
                                                        </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3"><h6>Received Date</h6></div>
                                                        <div class="col-sm-3"><h6><input type="date" class="form-control"  name="received_date" required autocomplete="off"></h6>                                      
                                                        <?php echo form_error('received_date', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                                    </div> 
                                                    </div>
                                    
                                                      <div class="row mt-2">
                                                        <div class="col-sm-3"><h6>Description</h6></div>
                                                        <div class="col"><h6><input type="text" class="form-control"  name="received_description" placeholder="Received Description" required autocomplete="off"> </h6>                                       
                                                        <?php echo form_error('received_description', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                                  </div>
                                                        </div>
                                                      <div class="row mt-2">
                                                        <div class="col-sm-3"><h6>New Serial Tag</h6></div>
                                                        <div class="col-sm-4"><h6><input type="text" class="form-control"  placeholder="Serial" name="new_serial" required autocomplete="off"><?php echo form_error('new_serial', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></h6></div> 
                                                        <div class="col-sm-4"><h6><input type="text" class="form-control"  placeholder="Tag" name="new_tag" required autocomplete="off"><?php echo form_error('new_tag', '<div class="alert alert-danger mt-1" style="width:300px"><strong>* </strong>', '</div> '); ?></h6></div>                   
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