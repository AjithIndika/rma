<?php 

if(empty($this->session->admin)){
   redirect(base_url('sys/dash'));
}
?>
<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>
    <div>
        <button type="button" class="btn btn-success btn-lg" class="btn btn-primary" data-toggle="modal" data-target="#newuser"> <i class="la la-user-plus fa-3x"></i> New User</button>
    </div>

    <?php if (!empty($error)) {
        echo $error;
    } ?>

    <div class="container mt-5">
        <h3>User List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>User Name</th>
                    <th>Ad</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Admin</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $usr_list = $this->Systemuser->system_users();
                foreach ($usr_list as $user) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $user->uname ?></td>
                        <td><?php if (!empty($user->add)) {
                        echo '<i class="la la-check text-success font-weight-bold"></i>';
                    } else {
                        echo '<i class="la la-close text-danger font-weight-bold"></i>';
                    } ?></td>
                        <td><?php if (!empty($user->edit)) {
                        echo '<i class="la la-check text-success font-weight-bold"></i>';
                    } else {
                        echo '<i class="la la-close text-danger font-weight-bold"></i>';
                    } ?></td>
                        <td><?php if (!empty($user->delet)) {
                        echo '<i class="la la-check text-success font-weight-bold"></i>';
                    } else {
                        echo '<i class="la la-close text-danger font-weight-bold"></i>';
                    } ?></td>
                        <td><?php if (!empty($user->admin)) {
                        echo '<i class="la la-check text-success font-weight-bold"></i>';
                    } else {
                        echo '<i class="la la-close text-danger font-weight-bold"></i>';
                    } ?></td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#password<?php echo $user->userid ?>"><i class="la la-key"></i></button>
                            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#edit<?php echo $user->userid ?>"><i class="la la-edit font-weight-bold"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $user->user_no ?>"><i class="la la-bitbucket font-weight-bold"></i></button>
                        </td>
                    </tr>


                    <!----- update password !------->

                    <!-- The Modal -->
                <div class="modal" id="password<?php echo $user->userid ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update User <?php echo $user->uname ?> Password </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post">
                                      <input  type="hidden" value="<?php echo $user->userid  ?>" name="userid">
                                      
                                    <div class="form-group">
                                        <label for="email">New Password:</label>
                                        <input type="text" class="form-control" placeholder="Enter New Password" id="email" name="upassword" required autocomplete="off">
                                     </div>
                                      
                                      <div class="form-group">                                                                            
                                        <input type="submit" class="btn btn-success" value="Password Update" name="updatepass">
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>





                <!-- edit users -->
                <div class="modal" id="edit<?php echo $user->userid ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update <?php echo $user->uname ?> permission's</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input  type="hidden" value="<?php echo $user->permission_id ?>" name="permission_id">

                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1" name="add" <?php if (!empty($user->add)) {
                        echo "checked";
                    } ?>>
                                            <span class="form-check-sign">Ad Permission</span>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1" name="edit" <?php if (!empty($user->edit)) {
                        echo "checked";
                    } ?>>
                                            <span class="form-check-sign">Edit Permission</span>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1" name="delet" <?php if (!empty($user->delet)) {
                        echo "checked";
                    } ?>>
                                            <span class="form-check-sign">Delete Permission</span>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1" name="admin" <?php if (!empty($user->admin)) {
                        echo "checked";
                    } ?>>
                                            <span class="form-check-sign">Admin</span>
                                        </label>
                                    </div>

                                    <input type="submit" class="btn btn-success" value="Update" name="perupdate">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!---  delet !---->

                <!-- The Modal -->
                <div class="modal" id="delet<?php echo $user->user_no ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delet User <?php echo $user->uname ?> </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input  type="hidden" value="<?php echo $user->user_no ?>" name="user_no">
                                    <input type="submit" class="btn btn-success col-sm-4" value="Yes" name="delet">
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

                <!---- delet end !-------->

<?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- new User -->
<div class="modal" id="newuser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ad New User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Enter User Name" name="uname"  required autocomplete="off">
<?php echo form_error('uname', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" name="upassword" required autocomplete="off">
<?php echo form_error('upassword', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
                    </div>
                    
           
                    
                    

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" name="add">
                            <span class="form-check-sign">Ad Permission</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" name="edit">
                            <span class="form-check-sign">Edit Permission</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" name="delet">
                            <span class="form-check-sign">Delete Permission</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" name="admin">
                            <span class="form-check-sign">Admin</span>
                        </label>
                    </div>




                    <input type="submit" class="btn btn-primary" name="crate" value="Submit">
                </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>