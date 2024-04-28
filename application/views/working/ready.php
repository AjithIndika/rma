<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<style >
    a{
        text-decoration: none;
    }
      a:hover{
        text-decoration: none;
    }
</style>
<?php
$suppler_send = $this->Repair_model->ready_courier_list();
?>
<?php if (!empty($suppler_send)) { ?>
    <div class="container" style="margin-top: 80px">
        <?php if (!empty($error)) {
            echo $error;
        } ?>

        <div class="container bg-white">
            <h4 class="mt-4">Courier  List</h4>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Job No</th>
                        <th>Item</th>
                        <th>SN</th>
                        <th>Supplier Name</th>
                        <th>Today Send</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($suppler_send as $suppler_send) {
                        ?>
                    <form action="" method="post">
                        <tr>
                            <td><?php echo $suppler_send->job_number ?></td>
                            <td><?php echo $suppler_send->item_name ?> / <?php echo $suppler_send->item_description ?></td>
                            <td><?php echo $suppler_send->serial_no ?></td>
                            <td><?php echo $suppler_send->supplier_name ?></td>
                            <td>
                                <input type="hidden" value="<?php echo $suppler_send->job_number ?>" name="job_number[]">
                                <a href="<?php echo base_url('repair/readyone?job_number='.$suppler_send->job_number.'')?>" class="text-decoration-none">  <i class="la la-toggle-off la-3x text-decoration-none"></i>   </a>                            
                            </td>
                        </tr>


    <?php } ?>
                
                </form>
                </tbody>
            </table>

        </div>



    </div>
<?php
} else {
    echo '<div class="alert alert-success col-sm-8" style="margin-top: 120px">  <strong></strong> No Jobs to View</div>';
}
?>