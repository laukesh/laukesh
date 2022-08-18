<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prcategory_model extends CI_Model
{
    //input values
    public function input_values()
    {
         $data = array(
            'lang_id'        => $this->input->post('lang_id', true),
            'name'           => $this->input->post('name', true),
            'slug'           => $this->input->post('slug', true),
            'title'          => $this->input->post('title', true),
            'description'    => $this->input->post('description', true),
            'is_active'      => $this->input->post('is_active', true),
            'is_headquarter' => $this->input->post('is_headquarter', true)
        );
        return $data;
    }

    //add category
    public function add_category()
    {
        $data = $this->input_values();
        // if (empty($data["name_slug"])) {
        //     //slug for title
        //     $data["name_slug"] = str_slug($data["name"]);
        // } else {
        //     $data["name_slug"] = remove_special_characters($data["name_slug"], true);
        // }
        // $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('tbl_pru_category', $data);
    }

  
}