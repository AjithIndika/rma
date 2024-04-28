<?php
if (empty($this->session->userid)) {
    redirect(base_url('page/logout'));
}
?>
<html>
    <head>
        <title>Print <?php echo $_SESSION['job_number']; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url('images/logo.jpg') ?>"  /> 
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/ready.css');  ?>">
        <link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/demo.css');  ?>">
        <script src="<?php //echo base_url('boost_assets/js/jquery.min.js')  ?>"></script>

   
        
        
<script>
function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
var enteredtext = $('#GFG').val();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
$('#GFG').html(enteredtext);
}
</script>



        <style>
            td{font-size: 20px;
               width: 33%;}
            table{width:100%;}
            .jk{text-align:right;}
            .js{text-align:left;  }

            body{
                margin: 0px;
                padding: 0px;
                font-size: 16px;
            }

        </style>   

    </head>


    <body onkeypress="printContent('GFG');">
        <form id="form1">
            <div id="GFG" class="container col-sm-12 "  style="margin-top:110px;">


                <div class="row col-sm-12">                
                   
                    <div class="col-sm-6"><h5 class="mt-5">
                            <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?></br>
                            <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_1 ?>,
                            <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_2 ?>.</br>
                            Tel:<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->tp_no ?> 
                    </div>
                    
                     <div class="col"><img src="<?php echo base_url('images/' . $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo . '') ?>" style="width: 150px"></br><em class="ml-2"> <?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->web_link ?> </em></div>

                     <div class="col mt-5"><h5>No: <?php echo $_SESSION['job_number'];  ?> <br> Date : <?php echo date('Y-m-d') ?></h5></br>
                      </div>
                     </div>


                            <hr class="bg-dark"></hr>
                            <div class="row col-sm-12">                
                                <div class="col-sm-3">Customer Name</div>
                                <div class="col-sm-4 " > : <?php echo $this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->customer_name ?></div>
                                 </div>


                            <div class="col-sm-12 border-top border-dark"></div>
                            

                            <div class="row col-sm-12">                 
                                <div class="col-sm-3">Item Category </div>
                                <div class="col ">: <?php $item_id = $this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->item_id;
                            echo $this->db->get_where(' item_list', array('item_id' => $item_id))->row()->item_name ?></div>
                            </div>

                            <div class="row col-sm-12">                 
                                <div class="col-sm-3 border-bottom border-dark">Item Description </div>
                                <div class="col js border-bottom border-dark"> : <?php echo $this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->item_description ?></div>
                            </div>

                            <div class="row col-sm-12">                 
                                <div class="col-sm-3">Serial No </div>
                                <div class="col-sm-4">: <?php echo $this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->serial_no ?></div>
                                <div class="col jk">Tag No  </div>
                                <div class="col  "> : <?php echo $this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->tag_no ?></div>
                            </div>
                           <div class="row col-sm-12 mt-3">                 
                                <div class="col-sm-3"> </div>
                                <div class="col-sm-3 "></div>
                                <div class="col jk "style="margin-left:60px" >Inspection Charges </div>
                                <div class="col " jk style="margin-left:40px"> : Rs. <?php echo number_format($this->db->get_where('jobs', array('job_number' => $_SESSION['job_number']))->row()->inspection_chargers, 2) ?></div>
                            </div>

<!-----
                            <div>
                                <hr class="bg-dark"  ></hr>              
                                <ul class="list-group list-group-flush ml-3">
                                                    <?php
                                                    $res = $this->Setting_model->roledlist();
                                                    foreach ($res as $res) {
                                                        ?>
                                        <li class=""><?php echo $res->roles_details ?></li>
                                          <?php } ?> 
                                </ul>
                            </div>
!------>
                            <div class="mt-5 mb-3">

                                <div class="row">
                                    <div class="col ">.............................................</br>Customer Confirmation</div>
                                    <div class="col text-center"><?php echo $this->session->uname;?></br>Accepting Officer In charge</div>

                                </div>
                            </div>
                    </div>







                    </form>
                    </body>   
                    </html>


