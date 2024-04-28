<?php 

if(empty($this->session->userid)){
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

     

        <style>
            td{font-size: 25px;
               width: 33%;}
            table{width:100%;}
            .jk{text-align:right;}


        </style>   

    </head>


    <body >

        <div id="GFG" class="container col-sm-12 " style="margin-top:80px">
            <div class="container">
                <h2>Courier List <?php echo date('Y-m-d')?></h2>
                       
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job No</th>
                            <th>Supplier</th>
                            <th>Parts</th>
                            <th>SN</th>
                            <th>GET</th>
                        </tr>
                    </thead>
                    <tbody>
                   <form action="<?php echo base_url('repair/print_list')?>" method="post" name='template'>
                        <?php
                        $print = $this->Repair_model->print_courier_list();
                        foreach ($print as $print) {
                            ?>
                    
                            <tr>
                                <td><?php echo $print->job_number ?></td>
                                <td><?php echo $print->supplier_name ?><?php if (!empty($print->warranty)) {
                            echo '<i class="la la-certificate la-2x text-danger"></i>';
                        } ?> ( <?php echo $print->accessories_receiving ?> )</td>
                                <td><?php echo $print->item_name ?></td>
                                <td><?php echo $print->serial_no ?></td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $print->sup_id ?>" name="checkboxName[]">
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div> 
                                </td>
                            </tr>
<?php } ?>
                            
                            <tr >
                                <td></td>
                                <td></td>
                                <td> </td>
                                <td ><button type="submit" class="btn btn-success">Conform Chosen Items</button></td>
                                
                            </tr>
                   </form>
                          
                    </tbody>
                </table>
            </div>

        </div>


    </body>   
</html>
