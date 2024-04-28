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

        </div>





        <div class="row mt-2">
            <div class="col-sm-2"><h6>Item</h6></div>
            <div class="col-sm-3">
                <select class="form-control select2 " name="item_id" required autocomplete="off">
                    <?php
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

      




  

      

       

        <div class="row mt-2">
            <div class="col-sm-2"><h6>Chargers</h6></div>
            <div class="col-sm-7 ">  <input type="number" class="form-control col-sm-3" value="350" id="inspection_chargers" name="inspection_chargers" required> 
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
            document.getElementById("customer_name").value = "Super Unique";
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
