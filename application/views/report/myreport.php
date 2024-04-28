
<?php
if (empty($this->session->userid)) {
    redirect(base_url('sys/dash'));
}
?>

<html>
    <head>

        <link rel="shortcut icon" href="<?php echo base_url('images/logo.jpg') ?>"  /> 
        <link rel="stylesheet" href="<?php echo base_url('boost_assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/ready.css');   ?>">
        <link rel="stylesheet" href="<?php //echo base_url('boost_assets/css/demo.css');   ?>">
        <script src="<?php //echo base_url('boost_assets/js/jquery.min.js')   ?>"></script>




        <script>
            function printContent(el) {
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

        <style>
            .modal-full {
                min-width: 96%;
                margin-left: 80;
            }

            .modal-full .modal-content {

            }
        </style>

    </head>



    <body onkeypress="printContent('GFG');">
        <div  class="container col-sm-12 " style="margin-top:80px" id="GFG"> 

            <div class="container">
                <h4><?php echo $this->session->uname; ?> ( <?php echo date('Y-m-d') ?>)</h4>

                <table class="table table-bordered">
                    <thead>


                        <tr>
                            <th class="text-center">Job No</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Inspection</th>
                            <th class="text-center">Repair</th>
                            <th class="text-center">Total</th>
                        </tr>


                    </thead>
                    <tbody>

                        <?php
                        $today[] = array();
                        $myre = $this->Report_model->user_dispach_daly();
                        foreach ($myre as $myre) {
                            $today[] = $myre->repair_chargers + $myre->inspection_chargers;
                            ?>

                            <tr>
                                <td class="text-center"> <?php echo $myre->job_number; ?></td>
                                <td class="text-center"> <?php echo $myre->item_name . ' / ' . $myre->item_description; ?> </td>
                                <td class="text-center"><?php echo $myre->inspection_chargers; ?></td>
                                <td class="text-center"><?php echo $myre->repair_chargers; ?></td>
                                <td class="text-center"><?php echo $myre->repair_chargers + $myre->inspection_chargers; ?></td>
                            </tr>  
                        <?php } ?>

                        <tr>
                            <td class="text-center" colspan="4">Handover Cash</td>

                            <td class="text-center"><?php print_r(number_format(array_sum($today), 2)) ?></td>
                        </tr>  


                    </tbody>
                </table>
            </div>

        </div>


    </body>
</html>

