<?php

class Setting_model extends CI_Model {

    

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    

    
 /// new system user    
 public function new_supplier($suply) {
       $this->db->insert('supplier',$suply);
 }
 
 public function permittion($perm) {
      $this->db->insert('permission',$perm);
 }
    
 
 public function supplier() {      
        $this->db->from('supplier');     
        $query = $this->db->get();
        return $query->result();        
    }
    
  
    
    //updae
    public function update_supp($suply,$supplier_id) {
        $this->db->where('supplier_id',$supplier_id);
        $this->db->update('supplier', $suply);
    }
    
  // delet
    
  public function delet_sup($supplier_id) {
     $this->db->where('supplier_id', $supplier_id);
     $this->db->delete('supplier');      
  }
  
  
  //item 
   public function new_item($item) {
       $this->db->insert('item_list',$item);
 }
 
 // all items
 
  public function item_list() {      
        $this->db->from('item_list');     
        $query = $this->db->get();
        return $query->result();        
    }
    
  // update item
      public function update_item($item,$item_id) {
        $this->db->where('item_id',$item_id);
        $this->db->update('item_list', $item);
    }
    
 // delet item 
    public function delet_item($item_id) {
     $this->db->where('item_id', $item_id);
     $this->db->delete('item_list');      
  }
  
  
   public function shopseting($myde) {   
       $this->db->where('shop_id',1);
       $this->db->update('shop_seting',$myde);
 }
   
 //roles items
 public function roleadd ($rols) {
   $this->db->insert('roles',$rols);
 }
 
 
 public function roledlist() {
       $this->db->from('roles');      
       $query = $this->db->get();
        return $query->result(); 
     
 }
 
 
    public function delet_roule($roles_id) {
     $this->db->where('roles_id',$roles_id);
     $this->db->delete('roles');      
  }
 
  
  
  
  
 
}