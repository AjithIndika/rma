<div  class="container col-sm-12 " style="margin-top:80px"> 


    
            <div class="col-md-12 mt-3">
                <div class="card">   
                    <h5 class="mt-4 text-center">All Pending Job Counts</h5>
                    <table class="table table-head-bg-success table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Supplier Name</th>                               
                                <th scope="col">Pending Jobs</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cout = 1;
                            $pending = $this->Report_model->jobs_supplier();
                            foreach ($pending as $pending) {
                                ?>

                                <tr  >
                                    <td><?php echo $cout++ ?></td>
                                    <td><a href="<?php echo base_url('report/allpending_supplier_wise/' . $pending->supplier_id . '') ?>"><?php echo $pending->supplier_name ?></a></td>
                                    
                                     <td><?php $supplier_id=$pending->supplier_id; $this->Report_model->count_pending($supplier_id); ?></td>
                                 
                                </tr>
                                    <?php } ?>
                        </tbody>
                    </table>                  
                </div>

            </div>
    
    
     <div class="col-md-12 mt-3">
                <div class="card">   
                    <h5 class="mt-4 text-center"> <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?> Pending Job Counts</h5>
                    <table class="table table-head-bg-success table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Pending Jobs</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cout = 1;
                            $pending = $this->Report_model->shop_pending();
                            foreach ($pending as $pending) {
                                ?>

                                <tr  >
                                    <td><?php echo $cout++ ?></td>
                                    <td><a href="<?php echo base_url('report/shop/'.$pending->supplier_id . '') ?>" target="blank"><?php echo $pending->supplier_name ?></a></td>
                                    
                                     <td><?php $supplier_id=$pending->supplier_id; $this->Report_model->count_pending($supplier_id); ?></td>
                                 
                                </tr>
                                    <?php } ?>
                        </tbody>
                    </table>                  
                </div>

            </div>

</div>