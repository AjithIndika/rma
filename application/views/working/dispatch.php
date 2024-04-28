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
                    <th>Customer Name</th>
                    <th>Parts</th>
                    <th>Sn</th>
                    <th>Dispatch</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $print = $this->Repair_model->dispach_list();
                foreach ($print as $print) {
                    ?>

                    <tr>
                        <td><?php echo $print->job_number ?></td>
                        <td><?php echo $print->customer_name ?></td>
                        <td><?php echo $print->item_name ?> / <?php echo $print->item_description ?></td>
                        <td><?php echo $print->serial_no ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#send<?php echo $print->job_number ?>">Dispatch</button>
                        </td>
                    </tr>


                    <!----  supplier update !------>
                    <!-- The Modal -->
                <div class="modal" id="send<?php echo $print->job_number ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Dispatch Items</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action=""  method="post" > 
                                    <div class="row">
                                        <div class="col-sm-3"><h6>RMA</h6></div>
                                        <div class="col"> 
                                            <h6> <input type="text" class="form-control"  value="<?php echo $print->job_number ?>" disabled></h6>
                                            <input type="hidden" class="form-control"  name="job_number" value="<?php echo $print->job_number ?>" >
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"><h6>Customer</h6></div>                                        
                                        <div class="col"> <h6>  <input type="text" class="form-control"  value="<?php echo $print->customer_name ?>" disabled></h6></div>
                                    </div>
                                    
                                     <div class="row">
                                        <div class="col-sm-3"><h6>Customer T/P</h6></div>                                        
                                        <div class="col"> <h6>  <input type="text" class="form-control"  value="<?php echo $print->mobile_number ?>" disabled></h6></div>
                                         <div class="col"> <h6>  <input type="text" class="form-control"  value="<?php echo $print->lane_number ?>" disabled></h6></div>
                                    </div>
                                    


                                    <div class="row ">
                                        <div class="col-sm-3"><h6>Item Category</h6></div>
                                        <div class="col"><input type="text" class="form-control "   value="<?php echo $print->item_name ?>" disabled></div>                                                       
                                        <div class="col"><input type="text" class="form-control "   value="<?php echo $print->item_description ?>" disabled></div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Serial No.</h6></div>
                                        <div class="col"><input type="text" class="form-control "   value="<?php echo $print->serial_no ?>" disabled></div>                                                       
                                        <div class="col"><input type="text" class="form-control "   value="<?php echo $print->tag_no ?>" disabled></div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Date of Issued</h6></div>
                                        <div class="col"><input type="text" class="form-control "   name="date_of_issued"  value="<?php echo date('Y-m-d h:i:s a') ?>" readonly></div>                                                       
                                        <div class="col">   

                                            <select class="form-control select2 col-sm-12" name="issued_item_id" required style="width: 280px;" autocomplete="off">
                                                <?php
                                                if(!empty($print->item_name)){
                                                    echo '<option value="' . $print->item_id . '">' . $print->item_name . '</option>';
                                                }
                                                
                                                $item_list = $this->Setting_model->item_list();
                                                foreach ($item_list as $value) {
                                                    echo '<option value="' . $value->item_id . '">' . $value->item_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_error('item_id', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Issued Sn Tag</h6></div>
                                        <div class="col"><input type="text" class="form-control " name="new_serial" value="<?php if (!empty($this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->sup_new_serial)) {
                                            echo $this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->sup_new_serial;
                                        } ?>" required autocomplete="off">
                                            <?php echo form_error('new_serial', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>                                                       
                                        <div class="col"><input type="text" class="form-control " name="new_tag" value="<?php if (!empty($this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->sup_new_tag)) {
                                            echo $this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->sup_new_tag;
                                        } ?>" required autocomplete="off">
                                            <?php echo form_error('new_tag', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>
                                    </div>
                                    
                                    
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Inspection Chargers</h6></div>
                                        <div class="col"> <input type="text" class="form-control col-sm-4 " value="<?php echo $print->inspection_chargers?>" required  name="inspection_chargers"> </div>
                                      </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Repair Chargers</h6></div>
                                        <div class="col"> <input type="text" class="form-control col-sm-4 " value="<?php echo $print->repair_chargers?>" required  name="repair_chargers"> </div>
                                      </div>
                                    
                                      <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Total</h6></div>
                                        <div class="col"> <input type="text" class="form-control col-sm-4 " value="<?php echo ($print->inspection_chargers + $print->repair_chargers)?>" required  disabled> </div>
                                      </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Receiver's Name</h6></div>
                                        <div class="col"><input type="text" class="form-control " name="riceived_name"  required autocomplete="off">
    <?php echo form_error('riceived_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>                                                     
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Receiver's NIC #</h6></div>
                                        <div class="col-sm-5"><input type="text" class="form-control " name="riceived_nic"  required autocomplete="off">
    <?php echo form_error('riceived_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                        </div>                                                       
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-5 form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="1" name="rmanote_missing">
                                                <span class="form-check-sign">RMA Note Missing</span>
                                            </label>

                                        </div>                                                       
                                    </div>


                                    <input type="submit" class="btn btn-primary" value="Save" name="redy" >
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

<script>
    $('.select2').select2();
</script>