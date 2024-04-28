<div  class="container col-sm-12 " style="margin-top:80px"> 


    
            <div class="col-md-12 mt-3">
                <div class="card">   
                    <h5 class="mt-4 text-center"><?php //echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?> <?php echo $this->db->get_where('supplier', array('supplier_id' => $supplier_id))->row()->supplier_name ?></h5>
                    <table class="table table-head-bg-success table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Job Number</th>
                                <th scope="col">Item</th>
                                <th scope="col">Due date</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $cout = 1;
                            
                            foreach ($pending as $pending) {
                                ?>

                                <tr  >
                                    <td><?php echo $cout++ ?></td>
                                    <td><a href="<?php echo base_url('repair/detailsrma?rma='.$pending->job_number .'') ?>"><?php echo $pending->job_number ?></a></td>
                                    <td><?php echo $pending->item_name ?></td>
                            <td>
                                <?php 
                            if(date('Y-m-d')==$pending->supplier_send_date_in_note){}
                            else { echo (strtotime(date('Y-m-d')) - strtotime(date("Y-m-d", strtotime($pending->supplier_send_date_in_note)))) / 60 / 60 / 24;  }?>
                            </td>
                            </tr>
                                    <?php } ?>
                        </tbody>
                    </table>                  
                </div>

            </div>
    
    
    

</div>