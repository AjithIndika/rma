<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<style>
    .text-decoration-none:hover{
        text-decoration: none;
        
    }
</style>

<div class="container" style="margin-top: -500px">
    <h1 class="text-success"><?php echo $error; ?></h1>
    </br>    
    <a  class="text-decoration-none" href="<?php echo base_url('repair/new')?>"><button type="button" class="btn btn-primary btn-lg"><h1>New Item</h1></button></a>
</div>