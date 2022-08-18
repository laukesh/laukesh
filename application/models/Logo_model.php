<?php defined('BASEPATH') or exit('No direct script access allowed');
class Logo_model extends CI_Model
{
     public function input_values_logo_gallery()
    {
        $data = array(
            'lang_id'         => $this->input->post('lang_id', true),
            'title'           => $this->input->post('title', true),
            'url'             => $this->input->post('url', true)

        );
        return $data;
    }



    public function add_logo_gallery()
    {
         //echo $_FILES['files']['name'];
           
        $data = $this->input_values_logo_gallery();
        if (!empty($_FILES['logo'])){

            $this->load->model('upload_model');
            $file_count = count($_FILES['logo']['name']);
            //die;
            //for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['logo']['name'])){
                    
                    $_FILES['file']['name'] = $_FILES['logo']['name'];
                    $_FILES['file']['type'] = $_FILES['logo']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['logo']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['logo']['error'];
                    $_FILES['file']['size'] = $_FILES['logo']['size'];

                    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    $detectedType = exif_imagetype($_FILES['file']['tmp_name']);
                    $error = !in_array($detectedType, $allowedTypes);
                               
                  if(($detectedType != 1 && $error == 1) ||  $rftype > 2){
                        $this->session->set_flashdata('errors', 'Please upload correct file');
                        redirect($this->agent->referrer());
                    }

                    $temp_data = $this->upload_model->upload_temp_image('file', 'array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'png|jpg|jpeg|gif') {
                            //$gif_path = $this->upload_model->logo_gallery_gif_image_upload($temp_data['file_name'],$temp_data['image_type']);
                           // $data["path_small"] = $gif_path;
                           // $data["path_small"] = $gif_path;
                        } else {
                            $data["path_small"] = $this->upload_model->logo_gallery_small_image_upload($temp_path,$temp_data['image_type']);
                            //$data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                    $this->upload_model->delete_temp_image($temp_path);
                    $this->db->insert('logo_gallery', $data);
                }
           // }
            return true;
        }

        return false;
    }

      public function get_paginated_logo_gallery($per_page, $offset)
    {
        $this->filter_logo_gallery();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('logo_gallery');
        return $query->result();
    }

      public function get_logo_gallery($id)
    {
        $sql = "SELECT * FROM logo_gallery WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }


       public function get_paginated_logo_gallery_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_logo_gallery();
        $query = $this->db->get('logo_gallery');
        return $query->row()->count;
    }


     public function filter_logo_gallery()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }

        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }

    }


    public function update_logo_gallery($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_logo_gallery();
        if (!empty($_FILES['file'])){

                    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    $detectedType = exif_imagetype($_FILES['file']['tmp_name']);
                    $error = !in_array($detectedType, $allowedTypes);    
                    $rftype = count(explode('.',$_FILES['file']['name']));          
                    
            if(($detectedType != 1 && $error == 1) ||  $rftype > 2){

                $this->session->set_flashdata('errors', 'Please upload correct file');
                redirect($this->agent->referrer());
            }

            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('file', 'array');
            if (!empty($temp_data)) {
                $temp_path = $temp_data['full_path'];
                if ($temp_data['image_type'] == 'gif') {
                    $gif_path = $this->upload_model->logo_gallery_gif_image_upload($temp_data['file_name']);
                    $data["path_small"] = $gif_path;
                    //$data["path_small"] = $gif_path;
                } else {
                    $data["path_small"] = $this->upload_model->logo_gallery_small_image_upload($temp_path,$temp_data['image_type']);
                    //$data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path);
                }
                $this->upload_model->delete_temp_image($temp_path);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('logo_gallery', $data);
    }

      public function get_images()
    {
        $sql = "SELECT * FROM logo_gallery WHERE lang_id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id)));
        return $query->result();
    }


     public function delete_logo_gallery($id)
    {

            $this->db->where('id', $id);
            return $this->db->delete('logo_gallery');
        //}
        //return false;
    }


    
}