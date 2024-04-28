<?php

class Systemuser extends CI_Model {

    

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    /// login
    function log($uname,$upassword) {
      
    $user = $this->db->select("user_no,userid,uname,image")->where(['uname' => $uname, 'upassword' => md5($upassword),])->get('sys_users')->row();
  if ($user) {
            $logindata = ['userid'=>$user->userid,'uname' => $user->uname,'user_no' => $user->user_no,"image"=>$user->image];
            $this->session->set_userdata($logindata);
            redirect(base_url('sys/dash'));
        } else {
            redirect(base_url());
        }
    }
    
    
    public function permition_ckeck() {
         $user = $this->db->select("add,edit,delet,admin")->where(['user_no' =>$this->session->user_no])->get('permission')->row();
         if ($user) {
            $logindata = ['add'=>$user->add,'edit' => $user->edit,'delet' => $user->delet,'admin' => $user->admin];
            $this->session->set_userdata($logindata);
         }
        
    }
    
 /// new system user    
 public function new_sys_user($new) {
       $this->db->insert('sys_users',$new);
 }
 
 public function permittion($perm) {
      $this->db->insert('permission',$perm);
 }
    
 
 public function system_users() {      
        $this->db->from('sys_users as syu');      
        $this->db->join('permission as per', 'per.user_no = syu.user_no','LEFT');
        $query = $this->db->get();
        return $query->result();        
    }
    
    public function permission($emp_no) {
        $user = $this->db->select("emp_no,admin,add,red,edit,delet,alreport")->where(['emp_no' => $emp_no])->get('permission')->row();
  if ($user) {
            $logindata = ['admin'=>$user->admin,'add' => $user->add,'red' => $user->red,'edit'=>$user->edit,'delet'=>$user->delet,'alreport'=>$user->alreport];
            $this->session->set_userdata($logindata);    
    }
    }
    
    //updae system user permission
    public function sys_user_updateper($permission_id,$perm) {
        $this->db->where('permission_id',$permission_id);
        $this->db->update('permission', $perm);
    }
    
    //updae system user permission
    public function sys_user_password_update($userpass,$userid) {
        $this->db->where('userid',$userid);
        $this->db->update('sys_users',$userpass);
    }
    
     //updae system user permission
    public function sys_user_delet($user_no) {
        $this->db->where('user_no', $user_no);
        $this->db->delete('sys_users');
        
         $this->db->where('user_no', $user_no);
       // $this->db->delete('sys_users');
        $this->db->delete('permission'); 
    }
    
    
    public function one_sys_user() {
        $this->db->from('sys_users as syu');      
        $this->db->join('permission as per', 'per.emp_no = syu.emp_no','LEFT');
        $this->db->where('syu.sys_user_id',$this->session->userid);
        $query = $this->db->get();
        return $query->result(); 
        
    }
}