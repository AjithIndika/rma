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
                    <th>Ready To Dispatch</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $print = $this->Repair_model->doredy_list();
                foreach ($print as $print) {
                    ?>

                    <tr>
                        <td><?php echo $print->job_number ?></td>
                        <td><?php
                            if (!empty($print->warranty)) {
                                echo '  <i class="la la-certificate la-2x text-danger"></i>';
                            }
                            ?> <?php if(!empty($this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->supplier_id)){$supplier_id= $this->db->get_where('sup_send', array('job_number' => $print->job_number))->row()->supplier_id ; echo  $this->db->get_where('supplier', array('supplier_id ' => $supplier_id ))->row()->supplier_name;} ?></td>
                        <td><?php echo $print->item_name ?> / <?php echo $print->item_description ?></td>
                        <td><?php echo $print->serial_no ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#send<?php echo $print->job_number ?>">Add Ready Details</button>
                        </td>
                    </tr>


                    <!----  supplier update !------>
                    <!-- The Modal -->
                <div class="modal" id="send<?php echo $print->job_number ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Ready Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action=""  method="post" > 
                                    <div class="row">
                                        <div class="col-sm-3"><h6>RMA</h6></div>
                                        <div class="col"> 
                                            <h6> <input type="text" class="form-control"  value="<?php echo $print->job_number ?>" disabled></h6>
                                            <input type="hidden" class="form-control"  name="job_number" value="<?php echo $print->job_number ?>" readonly autocomplete="off">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"><h6>Customer</h6></div>                                        
                                        <div class="col"> <h6>  <input type="text" class="form-control"  value="<?php echo $print->customer_name ?>" disabled></h6></div>
                                    </div>


                                    <div class="row ">
                                        <div class="col-sm-3"><h6>Item Category</h6></div>
                                        <div class="col"><input type="text" class="form-control"    value="<?php echo $print->item_name ?>"  disabled>  </div>                                                   
                                      <div class="col"><input type="text" class="form-control"    value="<?php echo $print->item_description ?>"  disabled>   </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Inspection Chargers </h6></div>
                                        <div class="col"><input type="text" class="form-control col-sm-3" id="inchargers" name="inspection_chargers"  value="<?php echo $print->inspection_chargers ?>"  required autocomplete="off" >
                                       <?php echo form_error('inspection_chargers', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>                                                        
                                    </div>
                                      <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Repair Chargers</h6></div>
                                        <div class="col"><input type="number" class="form-control col-sm-3" id="rechargers" name="repair_chargers"  value="<?php if(!empty($print->repair_chargers)){echo $print->repair_chargers;} else{ echo '0';} ?>"   autocomplete="off" onchange="sumtotal()">
                                        </div>                                                   
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Inform Date</h6></div>
                                        <div class="col"><input type="text" class="form-control col-sm-6"  value="<?php echo date('Y-m-d h:i:s a')?>" name="inform_date" required readonly>
                                            <?php echo form_error('inform_date', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>                                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Remark</h6></div>
                                        <div class="col"><input type="text" class="form-control " name="remark" required autocomplete="off">
                                            <?php echo form_error('remark', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>                                                        
                                    </div>
                                     <div class="row mt-2">
                                        <div class="col-sm-3"><h6>Total</h6></div>
                                        <div class="col"><input type="text" class="form-control col-sm-3"  disabled id="totals">
                                      </div>                                                        
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Save" name="redy"  >
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
    function sumtotal() {
        var inspection_chargers = Number(document.getElementById("inchargers").value);
        var repair_chargers = Number(document.getElementById("rechargers").value);
        var sums=inspection_chargers + repair_chargers;
        document.getElementById("totals").value=sums;
        
       
    }

</script>
