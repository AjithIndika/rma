
<?php
if (empty($this->session->userid)) {
    redirect(base_url('sys/dash'));
}
?>

<style>
.modal-full {
    min-width: 96%;
    margin-left: 80;
}

.modal-full .modal-content {
 
}
</style>
<div  class="container col-sm-12 " style="margin-top:80px"> 

    <div class="container">
        <h2></h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-sm-4 ">
                    <div class="form-group">
                        <label for="email">Select Month:</label>
                        <input type="month" class="form-control col-sm-12" placeholder="Enter email" id="email" name="month">

                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="email">&MediumSpace;</label></br>
                        <button type="submit" class="btn btn-primary">Get Report</button>

                    </div>

                </div>

            </div>




        </form>            
        <table class="table table-bordered">
            <thead>


                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Received Job</th>
                    <th class="text-center">Done Jobs</th>
                    <th class="text-center">Dispatch Jobs</th>
                </tr>


            </thead>
            <tbody>

                <?php
                $dates = $this->input->post('month');
                 $uname = $this->session->uname;
                    ?>
                    <tr>
                        <td class="text-center"> <?php echo $this->session->uname; ?></td>
                        <td class="text-center"> <button type="button" class="btn btn-danger bg-danger" data-toggle="modal" data-target="#rejobs<?php echo $this->session->uname; ?>"><?php $this->Report_model->myrecive($uname, $dates) ?> </button> </td>
                        <td class="text-center"><button type="button" class="btn btn-warning bg-danger" data-toggle="modal" data-target="#donejobs<?php echo $this->session->uname; ?>"><?php $this->Report_model->myrepair($uname, $dates) ?> </button> </td>
                        <td class="text-center"><button type="button" class="btn btn-success bg-danger" data-toggle="modal" data-target="#finishjobs<?php echo$this->session->uname; ?>"><?php $this->Report_model->dispachrepair($uname, $dates) ?> </button> </td>
                    </tr>  

                    <!-- recive jobs -->
                <div class="modal fade" id="rejobs<?php echo $this->session->uname; ?>">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $this->session->uname; ?> Received Job</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php $this->Report_model->name_vise_recive_jobs($uname, $dates); ?>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                



                <!-- Done Jobs -->
                <div class="modal fade" id="donejobs<?php echo $this->session->uname; ?>">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $this->session->uname; ?> Done Job</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">         
                                <?php $this->Report_model->name_vise_recive_donejobs($uname, $dates); ?>
                           </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Dispach  Jobs -->
                <div class="modal fade" id="finishjobs<?php echo $this->session->uname; ?>">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $this->session->uname; ?> Dispatch Jobs</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body ">
                                <?php $this->Report_model->name_vise_recive_dispachjob($uname, $dates); ?>
                            </div>
                           <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

          




            </tbody>
        </table>
    </div>

</div>



    