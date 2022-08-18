<?php defined('BASEPATH') or exit('No direct script access allowed');

class SainikPratika_model extends CI_Model
{
    
   public function update_setofcover($id){
        $this->db->where('set_of_cover',$id);
        $this->db->update('sainik_pratika_master');

   }

    public function input_values()
    {
    
        $data = array(
            'lang_id' => !empty($this->input->post('lang_id_update', true))?$this->input->post('lang_id_update', true):$this->input->post('lang_id', true),
            'category_id' => $this->input->post('category_id', true),
            'translated_id' => !empty($this->input->post('translated_id', true))?$this->input->post('translated_id', true):0,
            'title' => $this->input->post('title', true),
            'year' => !empty($this->input->post('year_update', true))?$this->input->post('year_update', true):$this->input->post('year', true),
            'month' => !empty($this->input->post('month_update', true))?$this->input->post('month_update', true):$this->input->post('month', true),
            'biweek_no' => !empty($this->input->post('end-date_update', true))?$this->input->post('end-date_update', true):$this->input->post('end-date', true),
            'volume' => $this->input->post('volume', true),
            'document_type' => !empty($this->input->post('document_type_update', true))?$this->input->post('document_type_update', true):$this->input->post('document_type', true),
            'keywords' => $this->input->post('keywords', true),
            'description' => $this->input->post('description', true)
        );
        
     // print_r($data);die;
        return $data;
    }

    //add page
    public function add()
    {
        $data = $this->input_values();
        $filename = clean($_FILES['file']['name']);      
        $clean_pdf = "sainik_patrika_".$data['year']."_".$data['month']."_".$data['biweek_no'].".".pathinfo($filename, PATHINFO_EXTENSION);
   


        if (isset($clean_pdf)){
            $this->load->model('upload_model');
            $rftype2 = count(explode('.',$_FILES['file']['name']));
            if($_FILES['file']['type'] == 'application/pdf' && $rftype2 < 3)
            {
            $data["document_path"] = $this->upload_model->pratika_upload($clean_pdf);
            }else{
                $this->session->set_flashdata('errors', 'Please upload correct file');
                redirect($this->agent->referrer());
            }
        }
        
        $clean_image = clean($_FILES['sainik_patrika_image']['name']); 

        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['sainik_patrika_image']['tmp_name']);
        $error = !in_array($detectedType, $allowedTypes);
        $rftype = count(explode('.',$_FILES['sainik_patrika_image']['name']));

        if(($detectedType != 1 && $error == 1) ||  $rftype > 2){
        $this->session->set_flashdata('errors', 'Please upload correct file');
        redirect($this->agent->referrer());
        }

        if (!empty($clean_image))
        {
        $this->load->model('upload_model');
        $data["path_small"] = $this->upload_model->sainik_samachar_upload($clean_image);
        }
        $this->db->insert('sainik_pratika_master', $data);
        return true;

            

    }

       // return false;
   // }

    //update page
    public function update_sainik_patrika($id)
    {
        $data = $this->input_values();
            $filename = clean($_FILES['file']['name']);
            $clean_pdf = "sainik_patrika_".$data['year']."_".$data['month']."_".$data['biweek_no'].".".pathinfo($filename, PATHINFO_EXTENSION);
            if (isset($clean_pdf)){
            $this->load->model('upload_model');
             $rftype2 = count(explode('.',$_FILES['file']['name']));
            if($_FILES['file']['type'] == 'application/pdf' && $rftype2 < 3)
            {
            $data["document_path"] = $this->upload_model->pratika_upload($clean_pdf);
            }else{
                $this->session->set_flashdata('errors', 'Please upload correct file');
                redirect($this->agent->referrer());
            }
            }
            
            $fullimagename = clean($_FILES['sainik_patrika_image']['name']);

               $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detectedType = exif_imagetype($_FILES['sainik_patrika_image']['tmp_name']);
                $error = !in_array($detectedType, $allowedTypes);
                $rftype = count(explode('.',$_FILES['sainik_patrika_image']['name']));

                if(($detectedType != 1 && $error == 1) ||  $rftype > 2){
                $this->session->set_flashdata('errors', 'Please upload correct file');
                redirect($this->agent->referrer());
                }


            $renameimg = "sainik_patrika_".$data['year']."_".$data['month']."_".$data['biweek_no'].".".pathinfo($fullimagename, PATHINFO_EXTENSION);

            if (!empty($renameimg)){        
            $this->load->model('upload_model');
            $data["path_small"] = $this->upload_model->sainik_samachar_upload($renameimg);
            }
            $this->db->where('id', $id);
            
            return $this->db->update('sainik_pratika_master', $data);
    }

    //get pages
    public function get_sainik_patrika($per_page, $offset)
    {
            $query = $this->db->select("*");
            $this->db->from('sainik_pratika_master');
            $this->db->order_by('year','DESC');
            $this->db->order_by('month','DESC');
            $this->db->limit($per_page, $offset);
            $query = $this->db->get('press_release');
            return $query->result(); 
    }

    public function sainik_patrika_get_pages()
    {
     $sql = "SELECT COUNT(id) AS count FROM sainik_pratika_master";
        $query = $this->db->query($sql);
        return $query->row()->count;
    }
    //get pages
    public function get_pages_by_lang($lang_id)
    {
        $sql = "SELECT * FROM pages WHERE lang_id =  ? ORDER BY page_order";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

    //get page
    public function get_page($slug)
    {
        $sql = "SELECT * FROM pages WHERE slug =  ?";
        $query = $this->db->query($sql, array(clean_str($slug)));
        return $query->row();
    }

    //get page by lang
    public function get_page_by_lang($slug, $lang_id)
    {
        $sql = "SELECT * FROM pages WHERE lang_id = ? AND slug =  ?";
        $query = $this->db->query($sql, array(clean_number($lang_id), clean_str($slug)));
        return $query->row();
    }

    //get page by default name
    public function get_page_by_default_name($default_name, $lang_id)
    {
        $sql = "SELECT * FROM pages WHERE page_default_name =  ? AND lang_id = ?";
        $query = $this->db->query($sql, array(clean_str($default_name), clean_number($lang_id)));
        return $query->row();
    }

    //get page by id
    public function get_page_by_id($id)
    {
        $sql = "SELECT * FROM  sainik_pratika_master WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //get subpages
    public function get_subpages($parent_id)
    {
        $sql = "SELECT * FROM pages WHERE parent_id = ?";
        $query = $this->db->query($sql, array(clean_number($parent_id)));
        return $query->result();
    }

    //delete page
    public function delete($id)
    {
        $page = $this->get_page_by_id($id);
        if (!empty($page)) {
            $this->db->where('id', $page->id);
            return $this->db->delete('pages');
        }
        return false;
    }

    public function input_values_cate()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true),
            'name_slug' => $this->input->post('name_slug', true),
            'description' => $this->input->post('description', true),
            'keywords' => $this->input->post('keywords', true),
            'document_type' => $this->input->post('document_type', true),
            'visibility' => $this->input->post('show_at_homepage', true),
            
        );
        return $data;
    }

      public function add_category()
    {
        $data = $this->input_values_cate();
        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug($data["name"]);
        } else {
            $data["name_slug"] = remove_special_characters($data["name_slug"], true);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('sainik_pratika_category', $data);
    }

    public function get_sainik_patrika_categories()
    {
        $query = $this->db->query("SELECT * FROM sainik_pratika_category");
        return $query->result();
    }

    public function get_category($id)
    {
        $sql = "SELECT * FROM sainik_pratika_category WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }
    
      public function update_sainik_patrika_category($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_cate();
        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug($data["name"]);
        } else {
            $data["name_slug"] = remove_special_characters($data["name_slug"], true);
        }

        $this->db->where('id', $id);
        return $this->db->update('sainik_pratika_category', $data);
    }


    public function delete_category($id)
    {
        //$category = $this->get_category($id);
        //if (!empty($category)) {
            //$this->db->where('id', $category->id);
            $this->db->where('id', $id);
            return $this->db->delete('sainik_pratika_category');
        //} else {
            //return false;
        //}
    }

    public function delete_sainik_patrika($id)
    {
        //$category = $this->get_category($id);
        //if (!empty($category)) {
            //$this->db->where('id', $category->id);
            $this->db->where('id', $id);
            return $this->db->delete('sainik_pratika_master');
        //} else {
            //return false;
        //}
    }

    public function get_sainikpatrika_category($id)
    {
        $sql   = "SELECT * FROM sainik_pratika_category WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }



}