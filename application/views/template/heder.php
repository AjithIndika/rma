<?php $this->Systemuser->permition_ckeck() ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $page_title ?></title>

        <link rel="shortcut icon" href="<?php echo base_url('images/' . $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo) ?>"  /> 

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/ready.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/demo.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/css/all.min.css'); ?>">
        

        <!---- !--->


        <script src="<?php echo base_url('boost_assets/js/jquery.min.js') ?>"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link href="<?php echo base_url('boost_assets/select2/select2.min.css') ?>" rel="stylesheet" />
        <script src="<?php echo base_url('boost_assets/select2/select2.min.js') ?>"></script>
        <!-----!----->


        <script>
            function showResult(str) {
                if (str.length == 0) {
                    document.getElementById("livesearch").innerHTML = "";
                    document.getElementById("livesearch").style.border = "0px";
                    return;
                }
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("livesearch").innerHTML = this.responseText;
                        document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
                    }
                }
                xmlhttp.open("GET", "<?php echo base_url('repair/liveserch'); ?>?q=" + str, true);
                xmlhttp.send();
            }
        </script>
        <style>
            .sticky-offset {
                top: 56px;
            }
            a{
                text-decoration: non;
            }
            a:hover{
                text-decoration: non;
            }
        </style>



    </head>
    <body>
        <div class="wrapper">
            <div class="main-header">
                <div class="logo-header">
                    <a href="<?php echo base_url('sys/dash') ?>" class="logo">
                        RMA Dashboard
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
                </div>
                <nav class="navbar navbar-header navbar-expand-lg">
                    <div class="container-fluid">



                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                            <!---- qutation requst -----!--->
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-bell"></i>
                                    <span class="notification"><?php echo $this->db->where(['required_estimate' => 1, 'send_estimate_date' => ''])->from("jobs")->count_all_results(); ?></span>
                                </a>
                                <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                    <li>
                                        <div class="dropdown-title">You have <?php echo $this->db->where(['required_estimate' => 1, 'send_estimate_date' => ''])->from("jobs")->count_all_results(); ?> quotation request </div>
                                    </li>
                                    <li>
                                        <div class="notif-center">

                                            <?php $this->Report_model->qutation_requst() ?>



                                        </div>
                                    </li>
                                    <li>

                                    </li>
                                </ul>
                            </li>
                            <!-- qutation requst end !--------->


                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    
                                     <?php
                                 // echo   $this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image;
                                     
                                     if(!empty($this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image)){
                                                    echo '<img src="'.base_url('images/'.$this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image.'').'" alt="user-img" width="36" class="img-circle"><span >'.$this->session->uname.'</span></span> </a>';
                                                }else{ ?>
                                                
                                                 <img src="<?php echo base_url('boost_assets/img/profile.jpg') ?>" alt="user-img" width="36" class="img-circle"><span ><?php echo $this->session->uname ?></span></span> </a>
                                                <?php } ?>
                    
                                  
                                <ul class="dropdown-menu dropdown-user">
                                    <li>
                                        <div class="user-box">
                                            <div class="u-img">
                                                <?php if(!empty($this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image)){
                                                    echo '<img src="'. base_url('images/'.$this->db->get_where('sys_users', array('userid' =>$this->session->userid))->row()->image.'').'" alt="user"></div>';
                                                }else{ ?>
                                                
                                                <img src="<?php echo base_url('boost_assets/img/profile.jpg') ?>" alt="user"></div>
                                                <?php } ?>
                                            <div class="u-text">
                                                <h4><?php echo $this->session->uname ?></h4>
                                            </div>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#pass<?php echo $this->session->userid ?>"><i class="ti-user"></i>Password</a>
                                    <a class="dropdown-item" href="<?php echo base_url('report/myprograss')?>"></i> My Work Progress</a>
                                     <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#profile"><i class="ti-user"></i>Profile Image</a>
                                     <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url('report/myreport') ?>"><i class="fa fa-power-off"></i>Today My Report</a>
                                      <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- The Modal -->
            <div class="modal" id="pass<?php echo $this->session->userid ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Password Reset</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="<?php echo base_url('sys/mypassword'); ?>" method="post">

                                <div class="form-group" >
                                    <label for="pwd">New Password:</label>
                                    <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="upassword">
                                    <input type="hidden" class="form-control" value="<?php echo $this->session->userid ?>" id="pwd" name="userid">
                                    <input type="hidden" value="<?php echo current_url(); ?>" name="url_name">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Reset Password" name="reset">
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            
            
            
          <!-- The Modal -->
            <div class="modal" id="profile">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Profile Image</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                      <!--      <form action="<?php echo base_url('sys/myimage'); ?>" method="post"> !---->

                                <div class="form-group" >                                   
                                   <?php echo form_open_multipart('sys/myimage');?> 
                                    <input type="file"  class="form-control rounded" name="userfile"  onchange="ValidateSingleInput(this);">
                                    <input type="hidden" class="form-control" value="<?php echo $this->session->userid ?>" id="pwd" name="userid">
                                    <input type="hidden" value="<?php echo current_url(); ?>" name="url_name">
                                </div>
           <div class="text-danger font-weight-bold" id="image"></div>
                                <input type="submit" class="btn btn-primary" value="Save" name="upload_image">
                            </form>
                            
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
              <script>
              var _validFileExtensions = [".jpg", ".jpeg"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
              //  alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
             //image
             document.getElementById("image").innerHTML = "only acsept .jpg and .jpeg";
                    oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
              </script>