<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visual_settings_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
        'post_list_style' => $this->input->post('post_list_style', true),
        'site_color' => $this->input->post('site_color', true),
        'site_block_color' => $this->input->post('site_block_color', true),
        'uploaded_date' => $this->input->post('uploaded_date', true),
        'description'   => $this->input->post('description', true),
        'status'         => $this->input->post('status', true),
        'imgstatus'         => $this->input->post('imgstatus', true)
        );
       // echo '<pre>';print_r($data);
       // die();
        return $data;
    }

    //get settings
    public function get_settings()
    {
        $query = $this->db->query("SELECT * FROM visual_settings WHERE id = 1");
        return $query->row();
    }

    //update settings
    public function update_settings()
    {
        $data = $this->visual_settings_model->input_values();
        $data_user = array(
            'site_color' => $data['site_color']
        );
        $this->db->where('id', clean_number($this->auth_user->id));
        $this->db->update('users', $data_user);

        $this->load->model('upload_model');
        $logo_path = $this->upload_model->logo_upload('logo');
        $logo_path2 = $this->upload_model->logo_upload('logo2');
        $logo_footer_path = $this->upload_model->logo_upload('logo_footer');
        $logo_email_path = $this->upload_model->logo_upload('logo_email');
        $favicon_path = $this->upload_model->favicon_upload('favicon');
        $home_popup_image_path = $this->upload_model->favicon_upload('home_popup_image');

      

        if (!empty($logo_path)) {
            $data["logo"] = $logo_path;
        }
        if (!empty($logo_path2)) {
            $data["logo2"] = $logo_path2;
        }
        if (!empty($logo_footer_path)) {
            $data["logo_footer"] = $logo_footer_path;
        }
        if (!empty($logo_email_path)) {
            $data["logo_email"] = $logo_email_path;
        }
        if (!empty($favicon_path)) {
            $data["favicon"] = $favicon_path;
        }

        if (!empty($home_popup_image_path)) {
            $data["home_popup_image"] = $home_popup_image_path;
        }

        $this->db->where('id', 1);
        return $this->db->update('visual_settings', $data);
    }

    public function update_settings_fb()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
                      'user'        => $this->input->post('user'),
                      'api'         => $this->input->post('api'),
                      'secret_key'  => $this->input->post('secret_key'),
                      'created_at'  => date('Y-m-d H:i:s',$t),
                      'created_by'  => $this->auth_user->id,
                      'updated_by'  => $this->auth_user->id
                      );

        $sql = "SELECT * FROM tbl_facebook";
        $query = $this->db->query($sql);
        $value = $query->result();

        if(!empty($value)){
             $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->db->where('id', 1);
          return $this->db->update('tbl_facebook', $data);
       
        }else{
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
        return $this->db->insert('tbl_facebook', $data);
        }
        
    }

     public function update_settings_ytb()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
                      'user'        => $this->input->post('user'),
                      'api'         => $this->input->post('api'),
                      'secret_key'  => $this->input->post('secret_key'),
                      'created_at'  => date('Y-m-d H:i:s',$t),
                      'created_by'  => $this->auth_user->id,
                      'updated_by'  => $this->auth_user->id
                      );

        $sql = "SELECT * FROM tbl_youtube";
        $query = $this->db->query($sql);
        $value = $query->result();

        if(!empty($value)){
             $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->db->where('id', 1);
          return $this->db->update('tbl_youtube', $data);
       
        }else{
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
        return $this->db->insert('tbl_youtube', $data);
        }
        
    }




    public function update_social_media()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
                      'facebook_url'     => $this->input->post('facebook_url'),
                      'twitter_url'      => $this->input->post('twitter_url'),
                      'linkedin_url'     => $this->input->post('linkedin_url'),
                      'instagram_url'    => $this->input->post('instagram_url'),
                      'youtube_url'      => $this->input->post('youtube_url')
                      //'created_at'       => date('Y-m-d H:i:s',$t),
                      //'created_by'       => $this->auth_user->id,
                      //'updated_by'       => $this->auth_user->id
                      );

        $sql = "SELECT * FROM social_media_url";
        $query = $this->db->query($sql);
        $value = $query->result();

        if(!empty($value)){
             $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->db->where('id', 1);
          return $this->db->update('social_media_url', $data);
       
        }else{
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
        return $this->db->insert('social_media_url', $data);
        }
        
    }

    public function update_settings_linkedin()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
                      'user'        => $this->input->post('user'),
                      'api'         => $this->input->post('api'),
                      'secret_key'  => $this->input->post('secret_key'),
                      'created_at'  => date('Y-m-d H:i:s',$t),
                      'created_by'  => $this->auth_user->id,
                      'updated_by'  => $this->auth_user->id
                      );
        

        $sql = "SELECT * FROM tbl_linkedin";
        $query = $this->db->query($sql);
        $value = $query->result();

        if(!empty($value)){
             $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->db->where('id', 1);
          return $this->db->update('tbl_linkedin', $data);
       
        }else{
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
        return $this->db->insert('tbl_linkedin', $data);
        }
    }

    public function update_settings_insta()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
                      'user'        => $this->input->post('user'),
                      'api'         => $this->input->post('api'),
                      'secret_key'  => $this->input->post('secret_key'),
                      'created_at'  => date('Y-m-d H:i:s',$t),
                      'created_by'  => $this->auth_user->id,
                      'updated_by'  => $this->auth_user->id
                      );
        

        $sql = "SELECT * FROM tbl_instagram";
        $query = $this->db->query($sql);
        $value = $query->result();

        if(!empty($value)){
             $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->db->where('id', 1);
          return $this->db->update('tbl_instagram', $data);
       
        }else{
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
        return $this->db->insert('tbl_instagram', $data);
        }
    }


}