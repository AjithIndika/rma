
<?php
$this->Systemuser->permition_ckeck();
if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
else{
$this->load->view('template/heder');
$this->load->view('template/leftPanal');
$this->load->view($page_content);
$this->load->view('template/foter');
} 


?>
