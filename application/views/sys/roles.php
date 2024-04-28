<?php 

if(empty($this->session->admin)){
   redirect(base_url('sys/dash'));
}
?>
<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>

    <?php
    if (!empty($error)) {
        echo $error;
    }
    ?>

    <div>  <input type="button"  value="Ad Rules" class="btn btn-success" data-toggle="modal" data-target="#myModal">  </div>
    <div class="container">
        <h3>Rules</h3>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Rules</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cou = 1;
                $res = $this->Setting_model->roledlist();
                foreach ($res as $res) {
                    ?>

                    <tr>
                        <td><?php echo $cou++ ?></td>
                        <td><?php echo $res->roles_details ?></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $res->roles_id ?>"><i class="la la-bitbucket-square"></i></button></td>
                    </tr>
                    
                    <!-- The Modal -->
<div class="modal" id="delet<?php echo $res->roles_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Rule</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="" method="post">
              <input type="hidden" value="<?php echo $res->roles_id ?>" name="roles_id">
              <input type="submit" class="btn btn-danger"  name="delete" value="Yes Delete">
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Rule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="" method="post">
                    <div class="form-group">
                        <label for="comment">Rule</label>
                        <textarea class="form-control" id="comment" rows="5" name="roles_details" required></textarea>
<?php echo form_error('roles_details', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>    
                    <input type="submit"  value="Ad Rule" class="btn btn-success" name="roles"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>