<?php 
if(empty($this->session->admin)){
    redirect(base_url('sys/dash'));
}
?>
<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>

    <div>
        <button type="button" class="btn btn-success btn-lg" class="btn btn-primary" data-toggle="modal" data-target="#newsuppler"> <i class="la la-taxi la-1x"></i> New Supplier</button>
    </div>
    <?php if (!empty($error)) {
        echo $error;
    }
    ?>


    <div class="container">
        <h4>Supplier</h4><table class="table bg-white">
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Mobile Number</th>
                    <th>Lane Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $supplier = $this->Setting_model->supplier();
                foreach ($supplier as $su) {
                    ?>

                    <tr>
                        <td><?php echo $su->supplier_name ?></td>
                        <td><?php echo $su->mobile_number ?></td>
                        <td><?php echo $su->lane_number ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $su->supplier_id ?>"><i class="la la-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $su->supplier_id ?>"><i class="la la-bitbucket"></i></button>

                        </td>
                    </tr>


                    <!------ edit !----------> 


                <div class="modal" id="edit<?php echo $su->supplier_id ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Supplier <?php echo $su->supplier_name ?> </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <form action="" method="post">

                                    <div class="form-group">           
                                        <input type="hidden" class="form-control"  id="email" name="supplier_id" value="<?php echo $su->supplier_id ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Supplier Name:</label>
                                        <input type="text" class="form-control" placeholder="Supplier Name" id="email" name="supplier_name" value="<?php echo $su->supplier_name ?>">
    <?php echo form_error('supplier_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Supplier Address:</label>
                                        <input type="text" class="form-control" placeholder="Supplier Address" id="pwd" name="supplier_address" value="<?php echo $su->supplier_address ?>"> 
    <?php echo form_error('supplier_address', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="pwd">Mobile Number</label>
                                        <input type="tel" class="form-control col-sm-4" placeholder="Mobile Number " id="pwd" name="mobile_number" value="<?php echo $su->mobile_number ?>" maxlength="10"> 
    <?php echo form_error('mobile_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="pwd">Land-Line Number</label>
                                        <input type="tel" class="form-control col-sm-4" placeholder="Lane Number " id="pwd" name="lane_number" value="<?php echo $su->lane_number ?>" maxlength="10"> 
    <?php echo form_error('lane_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Update" name="update_supplier">
                                </form>


                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>


                <!------ delet !---------->     

                <div class="modal" id="delet<?php echo $su->supplier_id ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Supplier <?php echo $su->supplier_name ?> ?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $su->supplier_id?>" name="supplier_id">
                                    <input type="submit" class="btn btn-success col-sm-4" value="Yes" name="deletsup">
                                </form>
                                 <button type="button" class="btn btn-danger col-sm-4" data-dismiss="modal">No</button>
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



<!-- new supper's -->
<div class="modal" id="newsuppler">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Supplier</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Supplier Name:</label>
                        <input type="text" class="form-control" placeholder="Supplier Name" id="email" name="supplier_name" value="<?php if (!empty($this->input->post('supplier_name'))) {
    echo $this->input->post('supplier_name');
} ?>">
                        <?php echo form_error('supplier_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Supplier Address:</label>
                        <input type="text" class="form-control" placeholder="Supplier Address" id="pwd" name="supplier_address" value="<?php if (!empty($this->input->post('supplier_address'))) {
                            echo $this->input->post('supplier_address');
                        } ?>"> 
<?php echo form_error('supplier_address', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Mobile Number</label>
                        <input type="tel" class="form-control col-sm-4" placeholder="Mobile Number " id="pwd" name="mobile_number" value="<?php if (!empty($this->input->post('mobile_number'))) {
    echo $this->input->post('mobile_number');
} ?>" maxlength="10"> 
<?php echo form_error('mobile_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Land-Line Number</label>
                        <input type="tel" class="form-control col-sm-4" placeholder="Lane Number " id="pwd" name="lane_number" value="<?php if (!empty($this->input->post('lane_number'))) {
    echo $this->input->post('lane_number');
} ?>" maxlength="10"> 
<?php echo form_error('lane_number', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Create New" name="newsupplier">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
