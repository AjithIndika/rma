
<div class="container" style="margin-top: 80px">
    <?php
    $jobs_id = base64_decode(base64_decode($this->input->get('jobs')));
    $suppler_send = $this->Repair_model->suppler_send_need_list_update($jobs_id);

    foreach ($suppler_send as $suppler_send) {
        ?>


        <h4 class="modal-title">Update Details</h4>
        <div class="col-sm-6">
        <form action="<?php echo base_url('repair/supplier') ?>"  method="post" > 
            <div class="form-group">
                <label for="email">Job No</label>
                <input type="text" class="form-control col-sm-5"  name="job_number" value="<?php echo $suppler_send->job_number ?>" readonly >
            </div>
            <div class="form-group " style="margin-top:-15px;">
                <label for="pwd">Item </label>
                <input type="text" class="form-control col-sm-10"  value="<?php echo $suppler_send->item_name . '-' . $suppler_send->item_description ?>" disabled>
            </div>

            <div class="form-group">
                <label for="pwd">Serial </label>
                <input type="text" class="form-control"  value="<?php echo $suppler_send->serial_no . '-' . $suppler_send->tag_no ?>" disabled>
            </div>


            <div class="row col-sm-12" >
                <div class="col-sm-1 "></div>
                <div class="col form-check" id="redy_chekbox" style="display:block">
                    <label class="form-check-label">
                        <input class="form-check-input required_group" type="checkbox" value="1"  id="myCheck" onclick="myFunction()" name="redy_by_us"  >
                        <span class="form-check-sign"><?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?></span>
                    </label>
                </div>
                <div class="col form-check" id="supp_chekbox" style="display:block">
                    <label class="form-check-label">
                        <input class="form-check-input required_group" type="checkbox" id="sendok" value="2" onclick="Sends()" name="redy_by_us"  >
                        <span class="form-check-sign">Send to Supplier</span>
                    </label>
                </div>
            </div>
            <div id="showSup" style="display:none">
                <div class="form-group">
                    <label for="smallSelect">Supplier Name</label>
                    <select class="form-control select2 "  required name="supplier_id" style="width:100%;">                                                

                        <?php
                        $supplier = $this->Setting_model->supplier();
                        foreach ($supplier as $supplier) {
                            echo '<option value="' . $supplier->supplier_id . '">' . $supplier->supplier_name . '</option>';
                        }
                        ?>
                    </select>

                </div>

                <div class="form-group" id="send_item_description" >
                    <label for="pwd">Send Item Description </label>
                    <input type="text" class="form-control"  name="send_item_description"  autocomplete="off" >                                        
                </div>
            </div>
        <?php } ?>
        <input type="submit" class="btn btn-primary" value="Save" name="sup_send" id="submit_buton" style="display:none">
    </form>

</div>

</div>






</div><script>
    function myFunction() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("supp_chekbox");
        var submit_buton = document.getElementById("submit_buton");

        if (checkBox.checked == true) {
            text.style.display = "none";
            submit_buton.style.display = "block";
        } else {
            text.style.display = "block";
            submit_buton.style.display = "none";
        }
    }
</script>

<script>
    function Sends() {
        var checkBox = document.getElementById("sendok");
        var redy_chekbox = document.getElementById("redy_chekbox");
        var showSup = document.getElementById("showSup");
        var submit_buton = document.getElementById("submit_buton");
        if (checkBox.checked == true) {
            redy_chekbox.style.display = "none";
            showSup.style.display = "block";
            submit_buton.style.display = "block";
        } else {
            redy_chekbox.style.display = "block";
            showSup.style.display = "none";
            submit_buton.style.display = "none";
        }
    }
</script>





<script type="text/javascript">
    $('.select2').select2();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>