<?php
if (empty($this->session->userid)) {
    redirect(base_url('page/logout'));
}
?>
<html>
    <head>
        <title>Print Courier List</title>
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/ready.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/demo.css'); ?>">
        <script src="<?php echo base_url('boost_assets/js/jquery.min.js') ?>"></script>
         <link rel="shortcut icon" href="<?php echo base_url('images/'.$this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo)?>"  /> 
        <script>

            function myFunction(event) {
                var x = event.which || event.keyCode;
                if (x = 112) {
                    window.print()
                }
                if (x = 13) {
                    window.location.replace('<?php echo base_url('sys/dash'); ?>');
                }

            }
        </script>

        <style>
            td{font-size: 25px;
               width: 33%;}
            table{width:100%;}
            .jk{text-align:right;}


        </style>   

    </head>


    <body onkeypress="myFunction(event)"">

        <div id="GFG" class="container col-sm-12 " style="margin-top:80px">

            <div class="container">
                <h2>Courier List <?php echo date('Y-m-d') ?></h2>
                <p>This List is today supplier send List</p>            
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job No</th>
                            <th>Supplier</th>
                            <th>Parts</th>
                            <th>SN</th>

                        </tr>
                    </thead>
                    <tbody>
                    <form action="" method="post">
                        <?php
                        if(!empty($this->input->post('checkboxName'))){
                        $print = $this->Repair_model->print_courier_list();
                        foreach ($print as $print) {
                            foreach ($this->input->post('checkboxName') as $value) {
                                if ($value == $print->sup_id) {
                                    ?>

                                    <tr>
                                        <td><?php echo $print->job_number ?></td>
                                        <td><?php echo $print->supplier_name ?></td>
                                        <td><?php echo $print->item_name ?> ( <?php echo $print->accessories_receiving ?> )</td>
                                        <td><?php echo $print->serial_no ?></td>
                                        <td>

                                        </td>
                                    </tr>
                                <?php }
                            }
                        } }?>
                    </form>
               
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-sm-7"></div>
                    <div class="col-sm-3">.............................<br>Signature</div>
                </div>
            </div>

        </div>


    </body>   
</html>


