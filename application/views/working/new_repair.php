<?php
if (empty($this->session->userid)) {
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
    <h5><?php echo $page_title ?></h5>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <?php
            if (empty($this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number)) {
                
            } else {
                ?>

                <a href="<?php echo base_url('repair/reedit?no=' . str_pad($this->db->select('job_number')->order_by('job_number', "desc")->limit(1)->get('jobs')->row()->job_number, 5, "0", STR_PAD_LEFT) . ''); ?>">
                    <button class="btn btn-success"><i class="la la-angle-double-right"></i> </button></a>

            <?php } ?>
        </div>
    </div>
    <form action="" method="post">

        <div class="row mt-5">
            <div class="col-sm-2"><h6>Customer Name</h6></div>
            <div class="col-sm-5"><input type="text" class="form-control col-sm-12" placeholder="Customer Name" id="customer_name" name="customer_name" value="<?php
                if (!empty($this->input->post('customer_name'))) {
                    echo $this->input->post('customer_name');
                }
                ?>" required autocomplete="off">
                                    <?php echo form_error('customer_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>

            </div>
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="1"  id="stock_item"  onchange="stockCkhanges(this)"  <?php if (!empty($this->input->post('mark'))) { echo 'checked'; }?>  >
                <span class="form-check-sign">Stock item</span>
            </label>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Mobile Number:</h6></div>
            <div class="col-sm-4"><input type="tel" class="form-control " placeholder="Mobile Number" id="pwd" name="mobile_number" value="<?php
                if (!empty($this->input->post('mobile_number'))) {
                    echo $this->input->post('mobile_number');
                }
                ?>" required autocomplete="off" maxlength="10" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                <?php echo form_error('mobile_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
            <div class="col-sm-4"><input type="tel" class="form-control " placeholder="Land-Line Number" id="pwd" name="lane_number" value="<?php
                if (!empty($this->input->post('lane_number'))) {
                    echo $this->input->post('lane_number');
                }
                ?>" autocomplete="off" maxlength="10" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
<?php echo form_error('lane_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Address:</h6></div>
            <div class="col-sm-8">
                <input type="text" value="<?php
                       if (!empty($this->input->post('address'))) {
                           echo $this->input->post('address');
                       }
                       ?>" class="form-control " name="address" placeholder="Address" autocomplete="off">                         
<?php echo form_error('address', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Invoice No</h6></div>
            <div class="col-sm-3"> <input type="text" class="form-control " placeholder="Invoice No" id="pwd" name="invoice_no" value="<?php
if (!empty($this->input->post('invoice_no'))) {
    echo $this->input->post('invoice_no');
}
?>" autocomplete="off"> </div>
            <div class="col-sm-3"><input type="date" class="form-control " placeholder="Invoice Date" id="pwd" name="invoice_date" value="<?php
                if (!empty($this->input->post('invoice_date'))) {
                    echo $this->input->post('invoice_date');
                }
?>" autocomplete="off"></div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item</h6></div>
            <div class="col-sm-3">
                <select class="form-control select2 " name="item_id" required autocomplete="off">
                    <?php
                    foreach ($item_list as $value) {
                        echo '<option value="' . $value->item_id . '">' . $value->item_name . '</option>';
                    }
                    ?>
                </select>
<?php echo form_error('item_id', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item Description:</h6></div>
            <div class="col"> 
                <input type="text" class="form-control col-sm-8" name="item_description" placeholder="Item Description" required autocomplete="off" value="<?php
if (!empty($this->input->post('item_description'))) {
    echo $this->input->post('item_description');
}
?>">

<?php echo form_error('item_description', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>

        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Serial No:</h6></div>
            <div class="col-sm-3">  <input type="text" class="form-control " placeholder="Serial No" id="pwd" name="serial_no" value="<?php
                if (!empty($this->input->post('serial_no'))) {
                    echo $this->input->post('serial_no');
                }
                ?>" autocomplete="off"> </div>
            <div class="col-sm-3">  <input type="text" class="form-control "  id="pwd" placeholder="Tag No" value="<?php
                if (!empty($this->input->post('tag_no'))) {
                    echo $this->input->post('tag_no');
                }
                ?>" name="tag_no" autocomplete="off"> </div>
        </div>

        <div class="row mt-2"  >
            <div class="col-sm-2"></div>
            <div class="col-sm-3 form-check " id="warrantys" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"  onchange="ckChange(this)" id="warranty" name="warranty" <?php
                if (!empty($this->input->post('warranty'))) {
                    echo 'checked';
                }
                ?> style="display:block">
                    <span class="form-check-sign">Warranty</span>
                </label>      
            </div>

            <div class="col-sm-3 form-check " id="damage" style="display:block">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"  id="mark"  onchange="ckCkhanges(this)" name="mark" <?php
                if (!empty($this->input->post('mark'))) {
                    echo 'checked';
                }
                ?>  style="display:block">
                    <span class="form-check-sign">Physical Damage/ Burn Mark </span>
                </label>      
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-sm-2"><h6>Acc: Receiving:</h6></div>
            <div class="col-sm-7"> 
                <input type="text" class="form-control " name="accessories_receiving" placeholder="Accessories Receiving" required autocomplete="off" value="<?php
                if (!empty($this->input->post('accessories_receiving'))) {
                    echo $this->input->post('accessories_receiving');
                }
                ?>">  </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Complaint:</h6></div>
            <div class="col-sm-7">
                <input type="text" value="<?php
                if (!empty($this->input->post('customer_complaint'))) {
                    echo $this->input->post('customer_complaint');
                }
                ?>" class="form-control " placeholder="Customer Complaint" name="customer_complaint" required autocomplete="off">               
<?php echo form_error('customer_complaint', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Others:</h6></div>
            <div class="col-sm-7"> 
                <input type="text" value="<?php
if (!empty($this->input->post('others'))) {
    echo $this->input->post('others');
}
?>" class="form-control "  placeholder="Others" name="others" autocomplete="off">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-7 form-check" id="required_estimate" style="display:block"> <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1" name="required_estimate" <?php
if (!empty($this->input->post('required_estimate'))) {
    echo 'checked';
}
?>>
                    <span class="form-check-sign">Required Estimate</span>
                </label> </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Chargers</h6></div>
            <div class="col-sm-7 ">  <input type="number" class="form-control col-sm-3" value="400" id="inspection_chargers" name="inspection_chargers" required> 
<?php echo form_error('inspection_chargers', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?></div>
        </div>

        <!--- --!--->
        <div class="row mt-2 mb-5"> 
            <div class="col-sm-4"></div>
            <div class="col"> <input type="submit" class="btn btn-primary" name="new_job" value="Submit"> </div>
            <div class="col-sm-7 "> </div>     
        </div>


    </form>


</div>

<script>
    $('.select2').select2();
</script>

<script>
    
        function stockCkhanges() {
        var checkBox = document.getElementById("stock_item");
        var damage = document.getElementById("damage");
        var required_estimate = document.getElementById("required_estimate");

        if (checkBox.checked == true) {
            damage.style.display = "none";
            required_estimate.style.display = "none";
            document.getElementById("inspection_chargers").value = 0;
            document.getElementById("customer_name").value = " <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?>";
             document.getElementById("warranty").checked = true;
        } else {
            damage.style.display = "block";
            required_estimate.style.display = "block";
            document.getElementById("inspection_chargers").value = 350;
            document.getElementById("customer_name").value = "";
             document.getElementById("warranty").checked = false;
        }
    }
    
    
    
    function ckChange() {
        var checkBox = document.getElementById("warranty");
        var damage = document.getElementById("damage");
        var required_estimate = document.getElementById("required_estimate");

        if (checkBox.checked == true) {
            damage.style.display = "none";
            required_estimate.style.display = "none";
            document.getElementById("inspection_chargers").value = 0;
        } else {
            damage.style.display = "block";
            required_estimate.style.display = "block";
            document.getElementById("inspection_chargers").value = 350;
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
