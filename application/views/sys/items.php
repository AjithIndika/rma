<?php 
if(empty($this->session->admin)){
    redirect(base_url('sys/dash'));
}
?>

<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>

    <div>
        <button type="button" class="btn btn-success btn-lg" class="btn btn-primary" data-toggle="modal" data-target="#newsuppler"> <i class="la la la-paperclip la-1x"></i> New Item</button>
    </div>
    <?php if (!empty($error)) {
        echo $error;
    }
    ?>


    <div class="container">
        <h4>Items</h4><table class="table bg-white">
            <thead>
                <tr>
                    <th>Item Name</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $item_list = $this->Setting_model->item_list();
                foreach ($item_list as $su) {
                    ?>

                    <tr>
                        <td><?php echo $su->item_name ?></td>                        
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $su->item_id ?>"><i class="la la-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $su->item_id ?>"><i class="la la-bitbucket"></i></button>

                        </td>
                    </tr>


                    <!------ edit !----------> 


                <div class="modal" id="edit<?php echo $su->item_id ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Item <?php echo $su->item_name ?> </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <form action="" method="post">

                                    <div class="form-group">           
                                        <input type="hidden" class="form-control"  id="email" name="item_id" value="<?php echo $su->item_id ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Item Name:</label>
                                        <input type="text" class="form-control" placeholder="Item Name" id="email" name="item_name" value="<?php echo $su->item_name ?>">
    <?php echo form_error('item_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                                    </div>
                  

                                    <input type="submit" class="btn btn-primary" value="Update" name="update_item">
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

                <div class="modal" id="delet<?php echo $su->item_id ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Supplier <?php echo $su->item_name ?> ?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $su->item_id?>" name="item_id">
                                    <input type="submit" class="btn btn-success col-sm-4" value="Yes" name="deletitem">
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
                <h4 class="modal-title">New Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Item Name:</label>
                        <input type="text" class="form-control" placeholder="Item Name" id="email" name="item_name" value="<?php if (!empty($this->input->post('item_name'))) {  echo $this->input->post('item_name');
} ?>">
                        <?php echo form_error('item_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>
            

                    <input type="submit" class="btn btn-primary" value="Crate New" name="newitem">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
