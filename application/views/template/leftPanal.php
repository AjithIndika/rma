

<div class="sidebar ">
    <div class=" sidebar-wrapper overflow-auto">

        <ul class="nav">
            <li class="nav-item active">
                <a href="<?php echo base_url('sys/dash') ?>">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>

                </a>
            </li>

            <!--- setting !----------->
            <div class="user">            
                <div class="info">
                    <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>

                            <span class="user-level"> <i class="la la-cogs la-2x text-danger"></i>Settings </span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                        <ul class="nav">  
                            <?php if (!empty($this->session->admin)) { ?> 

                                <li class="nav-item">
                                    <a href="<?php echo base_url('account/usersr') ?>">
                                        <i class="la la-user-plus"></i>
                                        <p>New User</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('sys/items') ?>">
                                        <i class="la la-thumb-tack"></i>
                                        <p>Items</p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="<?php echo base_url('sys/roles') ?>">
                                        <i class="la la-info-circle"></i>
                                        <p>Rule For RMA</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('sys/shop') ?>">
                                        <i class="la la-institution"></i>
                                        <p>Shop Settings</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('sys/smssetting') ?>">
                                        <i class="la la-envelope-o"></i>
                                        <p>SMS Settings</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!empty($this->session->admin) OR $this->session->add) { ?> 
                                <li class="nav-item">
                                    <a href="<?php echo base_url('sys/supplier') ?>">
                                        <i class="la la-male"></i>
                                        <p>Supplier's</p>
                                    </a>
                                </li>
                            <?php } ?>
<!---
                            <?php if (!empty($this->session->admin) OR $this->session->add) { ?> 
                                <li class="nav-item">
                                    <a href="#" data-toggle="modal" data-target="#money2">
                                        <i class="la la-money text-danger"></i>
                                        <p>Cash Old Date</p>
                                    </a>
                                </li>
                            <?php } ?>


                            <?php if (!empty($this->session->admin) OR $this->session->add) { ?> 
                                <li class="nav-item">
                                    <a href="#" data-toggle="modal" data-target="#money">
                                        <i class="la la-money text-danger"></i>
                                        <p>Cash From Technical</p>
                                    </a>
                                </li>
                            <?php } ?>

!------>
                        </ul>
                    </div>
                </div>
            </div>


            <!---- end setting !------------>


            <!--- report setting !----------->
            <?php if (!empty($this->session->admin)) { ?>
                <div class="user">            
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#report" aria-expanded="true">
                            <span>

                                <span class="user-level"> <i class="la la-sitemap la-2x text-success"></i>Reports </span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse in" id="report" aria-expanded="true" style="">
                            <ul class="nav">  


                                <li class="nav-item">
                                    <a href="<?php echo base_url('report/moneyReport') ?>">
                                        <i class="la la-money text-danger"></i>
                                        <p>Cash Report</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('report/moneyReportTowdate') ?>">
                                        <i class="la la-money text-danger"></i>
                                        <p>Cash Report Dates</p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="<?php echo base_url('report/monthlyreport') ?>">
                                        <i class="la la-info-circle"></i>
                                        <p>Monthly Reports</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo base_url('report/warranty_send') ?>">
                                        <i class="la la-certificate"></i>
                                        <p>Warranty Send</p>
                                    </a>
                                </li>





                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!---- report setting !------------>

            <li class="nav-item">
                <a href="<?php echo base_url('repair/live') ?>">
                    <i class="la la-search"></i>
                    <p>Live Search</p>

                </a>
            </li>


            <li class="nav-item">
                <a href="<?php echo base_url('repair/new') ?>">
                    <i class="la la-gavel"></i>
                    <p>Create New Job</p>

                </a>
            </li>


            <li class="nav-item">
                <a href="<?php echo base_url('repair/immediate_job') ?>">
                    <i class="la la-sliders text-success"></i>
                    <p>Immediate Job</p>

                </a>
            </li>



            <li class="nav-item">
                <a href="<?php echo base_url('repair/supplier') ?>">
                    <i class="la la-cab"></i>
                    <p>Update Jobs</p>
                    <span class="badge badge-count"><?php echo $this->db->where(['job_status' => 0])->from("jobs")->count_all_results(); ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('repair/ready') ?>">
                    <i class="la la-cab"></i>
                    <p>Send Supplier</p>
                    <span class="badge badge-success"><?php echo $this->db->where(['job_status' => 1])->from("jobs")->count_all_results(); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('repair/print') ?>">
                    <i class="la la-print"></i>
                    <p>Print List</p>
                    <span class="badge badge-danger"><?php echo $this->db->where(['job_status' => 2])->from("jobs")->count_all_results(); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('repair/supplier_repair') ?>">
                    <i class="la la-ship"></i>
                    <p>Supplier Note</p>
                    <span class="badge badge-info"><?php echo $this->db->where(['job_status' => 2])->from("jobs")->count_all_results(); ?></span>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('repair/not_riceve') ?>">
                    <i class="la la-hourglass-start"></i>
                    <p>Supplier Pending List</p>
                    <span class="badge badge-info"><?php echo $this->db->where(['job_status' => 3])->from("jobs")->count_all_results(); ?></span>

                </a>
            </li>



            <li class="nav-item">
                <a href="<?php echo base_url('repair/doredy') ?>">
                    <i class="la la-thumbs-o-up"></i>
                    <p>Ready To Dispatch</p>
                    <span class="badge badge-info"><?php echo $this->db->where(['job_status' => 4])->from("jobs")->count_all_results(); ?></span>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('repair/dispatch') ?>">
                    <i class="la la-smile-o"></i>
                    <p>Dispatch Items</p>
                    <span class="badge badge-info"><?php echo $this->db->where(['job_status' => 5])->from("jobs")->count_all_results(); ?></span>

                </a>
            </li>



        </ul>
    </div>
</div>


<!-- money -->
<div class="modal" id="money">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Today's Technical Cash Rs. / <?php $this->Report_model->today_income(); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('sys/cash') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Cash</label>
                      
                        <input type="number" class="form-control" placeholder="Enter Cash" step="00.00" id="email" name="cash">
                         
                        <input type="hidden" value="<?php echo current_url(); ?>" name="url_name">
                    </div>
                   
                    <input type="submit" class="btn btn-primary" value="Cash Received"  name="cash_recive">
                    
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- money -->
<div class="modal" id="money2">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> Technical Cash Rs. </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('sys/oldcash') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Date</label>
                        <input type="date" class="form-control"  id="email" name="old_date">

                    </div>


                    <div class="form-group">
                        <label for="email">Cash</label>
                        <input type="number" class="form-control" placeholder="Enter Cash" step="00.00" id="email" name="cash">
                        <input type="hidden" value="<?php echo current_url(); ?>" name="url_name">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit"  name="cash_recive">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="main-panel bg-white">


