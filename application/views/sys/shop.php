<?php 

if(empty($this->session->admin)){
   redirect(base_url('sys/dash'));
}
?>

<div class="container" style="margin-top: 80px">
      <h4><?php echo $page_title?></h4>
    
    <?php 
    if(!empty($error)){
        echo $error;
    }?>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="row col-sm-12">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Shop Name</label>
                    <input type="text" class="form-control" placeholder="Shop Name" id="email" name="shop_name" value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->shop_name ?>" required>
                 <?php echo form_error('shop_name', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div> 
            </div>
        </div>


        <div class="row col-sm-12">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">Address Line 1</label>
                    <input type="text" class="form-control " placeholder="Address Line 1" id="pwd" name="address_line_1" value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_1 ?>" required>
                 <?php echo form_error('address_line_1', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div>   
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">Address Line 2</label>
                    <input type="text" class="form-control " placeholder="Address Line 2" id="pwd" name="address_line_2" value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->address_line_2 ?>" required>
                 <?php echo form_error('address_line_2', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div>  
            </div>

        </div>

        <div class="row col-sm-12">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">T/P No.</label>
                    <input type="text" class="form-control " placeholder="Tp No" id="pwd" name="tp_no" value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->tp_no ?>" required>
                <?php echo form_error('tp_no', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div> 
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">Web</label>
                    <input type="text" class="form-control" placeholder="Web link" id="pwd" name="web_link"  value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->web_link ?>" required>
                  <?php echo form_error('web_link', '<div class="alert alert-danger mt-1" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div> 
            </div>

        </div>
        
        <?php if(!empty($this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo)){
            echo '<img src="'.base_url('images/'.$this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo).'" class="col-sm-3">';
            echo '</br>';
             echo '<a href="'.base_url('sys/image_remove').'"><input type="button" class="btn btn-primary" value="Remove Photo" name="photo_remove"></a>';
               echo '</br>';
               echo '</br>';
        }else{?>
             <div class="row col-sm-12">
            <div class="col-sm-6">
            <div class="form-group">
            <label for="pwd">logo</label>
            <input type="file" class="form-control col-sm-6" placeholder="Logo" id="pwd" name="userfile" value="<?php echo $this->db->get_where('shop_seting', array('shop_id' => '1'))->row()->logo?>"  accept="image/*" >
           </div>
            </div>
        </div>
        <?php }?>
        <input type="submit" class="btn btn-primary" value="Setup My Shop" name="myshop">
    </form>
</div>
