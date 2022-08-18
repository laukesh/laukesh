<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model
{   
   
    //input values
    public function input_values()
    {   
        date_default_timezone_set("Asia/Kolkata");
         $t=time();
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'category_id' => $this->input->post('category_id', true),
            'title' => $this->input->post('title', true),
            'slug' => $this->input->post('slug', true),
            'description' => $this->input->post('description', true),
            //'download_number' => $this->input->post('download_number', true),
            'created_at' => date('Y-m-d H:i:s',$t)
        );

        //echo '<pre>';print_r($data);
        //die;
        return $data;
    }

    
   public function add()
    {
        $data = $this->input_values();

        if (!empty($_FILES['file']['name'])){
            $this->load->model('upload_model');
            if($_FILES['file']['type'] == 'application/pdf')
            {
            $data["document_type"] = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $data["file_size"] = $_FILES['file']['size'];
            $data["path"] = $this->upload_model->download_upload($_FILES['file']['name']);
            }
        }
        return $this->db->insert('download_management', $data);
    }

    //get all gallery categories
    public function get_all_categories()
    {
       $this->filter_document();
       $this->db->order_by('id');
       $query = $this->db->get('download_management');
       return $query->result();
    }


     public function get_download_category_by_lang($lang_id)
    {
        $sql = "SELECT * FROM download_category WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

      public function get_download_category_by_filter()
    {
        $sql = "SELECT * FROM download_category";
        $query = $this->db->query($sql);
        return $query->result();
    }

     public function get_download_category_by_lang_filter($lang_id)
    {
        $sql = "SELECT * FROM download_category WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }
     
   


    public function add_download_category()
    {
        date_default_timezone_set("Asia/Kolkata");
         $t=time();
        $data = array(
            'lang_id'      => $this->input->post('lang_id', true),
            'name'         => $this->input->post('name', true),
            'slug'         => $this->input->post('slug', true),
            'description'  => $this->input->post('description', true),
            'created_at'   => date('Y-m-d H:i:s',$t)
        );
        return $this->db->insert('download_category', $data);
    }

 

    public function update_download_category($id,$created_at)
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true),
            'slug' => $this->input->post('slug', true),
            'description' => $this->input->post('description', true),
            'created_at' => $created_at
        );
       // echo '<pre>';print_r($data);
        //die;
        $this->db->where('id', $id);
        return $this->db->update('download_category', $data);
    }


    //get albums
    public function get_albums()
    {
        $query = $this->db->query("SELECT * FROM download_category ORDER BY id DESC");
        return $query->result();
    }



    public function get_download_categroy($id)
    {
        $sql = "SELECT * FROM download_category WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

 

    public function delete_download_category($id)
    {
        //echo '============'.$id;
        //die;
        $download_category = $this->get_download_categroy($id);
        if (!empty($download_category)) {
            $this->db->where('id', $download_category->id);
            return $this->db->delete('download_category');
        }
        return false;
    }


      public function get_category($id)
    {
        $sql = "SELECT * FROM download_management WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

     public function get_download_manage_by_lang($lang_id)
    {
        $sql = "SELECT * FROM download_category WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

     public function update($id)
    {
        $id = clean_number($id);
        $data = $this->input_values();
        if (!empty($_FILES['file']['name'])){
            $this->load->model('upload_model');
            if($_FILES['file']['type'] == 'application/pdf')
            {
            $data["document_type"] = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $data["file_size"] = $_FILES['file']['size'];
            $data["path"] = $this->upload_model->download_upload($_FILES['file']['name']);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('download_management', $data);
    }


    public function delete($id)
    {
       // $category = $this->get_category($id);
        //if (!empty($category)) {
            //$this->db->where('id', $category->id);
            $this->db->where('id', $id);
            return $this->db->delete('download_management');
        //} else {
        //    return false;
        //}
    }

    public function filter_document()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }
        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)){
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $category = trim($this->input->get('category_id', true));
        if (!empty($category)){
            $this->db->where('category_id', clean_number($category));
        } 

    }


}