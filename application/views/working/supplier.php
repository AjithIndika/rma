<?php
if (empty($this->session->userid)) {
    redirect(base_url('page/logout'));
}
?>

<?php
$suppler_send = $this->Repair_model->suppler_send_need_list();
?>
<?php if (!empty($suppler_send)) { ?>
    <div class="container" style="margin-top: 80px">
        <?php
        if (!empty($error)) {
            echo $error;
        }
        ?>

        <div class="container bg-white">

            <h4 class="mt-4">Update Job</h4>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Job No</th>
                        <th></th>
                        <th>Item</th>
                        <th>SN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($suppler_send as $suppler_send) {
                        ?>
                        <tr>
                            <td><?php echo $suppler_send->job_number ?> </td>
                            <td><?php
                                if (!empty($suppler_send->warranty)) {
                                    echo '<i class="la la-certificate la-2x text-danger"></i>';
                                }
                                ?></td>
                            <td><?php echo $suppler_send->item_name ?> / <?php echo $suppler_send->item_description ?></td>
                            <td><?php echo $suppler_send->serial_no ?></td>
                            <td><a href="<?php echo base_url('repair/supplierupdate?jobs='.base64_encode(base64_encode($suppler_send->jobs_id)).'')?>"><button type="button" class="btn btn-success" >Update Jobs </button></a>
                            <!--- data-toggle="modal" data-target="#send<?php echo $suppler_send->jobs_id ?>" !------>
                            </td>
                        </tr>



    <?php } ?>
                </tbody>
            </table>

        </div>



    </div>
    <?php
}
?>



<script>
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