<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
   
   public function __construct() 
   {
    parent::__construct();
    //$this->load->database();
   }


    public function fetch_data_view($read_status)
    {
      //$this->db->where('read_status', $read_status);
      //$this->db->order_by('id', 'DESC');
     // $query = $this->db->get('tbl_notification');
     // $output  = $query->result();
      //$output = $row->id; 
      $query = $this->db->query("SELECT * FROM tbl_notification");
      return $query->result();
      //return $output;
    }

     public function get_notification()
    {
        $query = $this->db->query("SELECT * FROM tbl_notification");
        return $query->result();
    }
}
