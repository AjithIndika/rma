<?php
if (empty($this->session->admin)) {
    redirect(base_url('sys/dash'));
}
?>
<div  class="container col-sm-12 " style="margin-top:80px">
      <h4><?php echo $page_title?></h4>
    
    <?php if(!empty($error)){echo $error;}?>

    <form action="" method="post">

        <div class="form-group">
            <label for="pwd">Api Key</label>
            <input type="text" class="form-control col-sm-5" placeholder="API KEY" id="pwd" name="apikey" value="<?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->apikey ?>" >
        </div>

        <div class="form-group">
            <label for="email">Sender ID:</label>
            <input type="text" class="form-control col-sm-3" placeholder="senderid" id="email" name="senderid" value="<?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->senderid ?>" >
        </div>
        <div class="form-group">
            <label for="pwd">User ID:</label>
            <input type="text" class="form-control col-sm-3" placeholder="User ID" id="pwd" name="user_id" value="<?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->user_id ?>" >
        </div>

        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="status" value="1" id="sta" <?php if(!empty($this->db->get_where('sms_setting', array('id' =>1))->row()->status)){ echo 'checked';} ?>>
                <span class="form-check-sign" id="reseting">ON / OFF</span>
            </label>
        </div>
        
        
         <div class="form-group">
            <label for="pwd">New Job SMS</label>
            <label for="pwd" ><em class="text-danger"> "Job" for job number "complaint" for complaint "chargers" For Inspection Chargers</em></label>
            <textarea placeholder="New Job SMS Text" class="form-control col-sm-8"   name="newjob"><?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->newjob ?></textarea>
           
        </div>
        
        
         <div class="form-group">
            <label for="pwd">Do Ready Job SMS</label>
            <label for="pwd" ><em class="text-danger"> "Job" for job number  "chargers" For Inspection Chargers</em></label>
            <textarea placeholder="Do Ready Job SM" class="form-control col-sm-8"   name="doredy_job"><?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->doredy_job ?></textarea>
           
        </div>
        
          <div class="form-group">
            <label for="pwd">Dispatch Job SMS</label>
            <label for="pwd" ><em class="text-danger"> "Job" for job number  "chargers" For Inspection Chargers "received_name" for received name "received_nic" received NIC</em></label>
            <textarea placeholder="Dispatch Job SMS" class="form-control col-sm-8"   name="dispach_Job"><?php echo $this->db->get_where('sms_setting', array('id' =>1))->row()->dispach_Job ?></textarea>
           
        </div>

        
        

        <input type="submit" class="btn btn-primary" value="SMS Settings" name="sms_seting">
    </form>

</div>




<script>
    function ckChange() {
        var checkBox = document.getElementById("sta");
      
        
        if (checkBox.checked == true) {
             $("#reseting").html(" Exercises Solution");
          // $("#reseting").text("text to show");
          //  document.getElementById("reseting").innerHTML='ON';
        } else {
          $("#reseting").text("text to showdddddddd");
            // document.getElementById("reseting") .innerHTML='OFF';
        }
    }
</script>