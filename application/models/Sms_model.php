<?php

class Sms_model extends CI_Model {

    

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    

  //
  public function update_sms_setting($sms) {      
     $this->db->where('id',1);
     $this->db->update('sms_setting',$sms);
   }
   
   
 public function sms_send($tpno,$masage) {

$MSISDN ='94'.substr($tpno,1);
$MESSAGE = $masage;
$apikey = $this->db->get_where('sms_setting', array('id' =>1))->row()->apikey;
$user_id = $this->db->get_where('sms_setting', array('id' =>1))->row()->user_id;
$senderid = $this->db->get_where('sms_setting', array('id' =>1))->row()->senderid;



$url='http://send.ozonedesk.com/api/v2/send.php';

$msg=[
'user_id'=>$user_id,
'api_key'=>$apikey,
'sender_id'=>$senderid,
'to'=>$MSISDN,
'message'=>$MESSAGE,
];


$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $msg);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $ch );



/*
$url = 'http://220.247.201.241:5000/sms/send_sms.php';
$myvars = 'username=' . $USERNAME . '&password=' . $PWD . '&src=' . $SRC . '&dst=' . $MSISDN . '&msg=' . $MESSAGE.'&&dr=1';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $ch );
*/
        
    }
    
  
 //roles items
 public function roleadd ($rols) {
   $this->db->insert('roles',$rols);
 }
 


 
  
 
 
}