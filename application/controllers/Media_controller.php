<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media_controller extends Admin_Core_Controller
{
  

    public function __construct()
    {
        parent::__construct();
        check_permission('audio');
    }
 
    /**
     * Images
     */
    public function media()
    {
        $data['title'] = trans("media");
        //paginate
        $pagination = $this->paginate(admin_url() . 'media-invite', $this->gallery_model->get_paginated_media_count());
        $data['images'] = $this->gallery_model->get_paginated_media($pagination['per_page'], $pagination['offset']);
        //echo '<pre>';print_r($data['images']);die();
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/media/media', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image
     */
    public function add_media_invite()
    {
       ///echo '====================';die;
        $data['title'] = trans("add_media");
        $data['album'] = $this->gallery_category_model->get_audio_albums_by_lang($this->selected_lang->id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['invitees'] = $this->category_model->get_invitees();
        //echo '<pre>';print_r($data['invitees']);die();
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/media/add_media', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function fetch_pro()
    {

        if($this->input->post('pro_category'))
        {
        echo $this->category_model->fetch_pro($this->input->post('pro_category'));
        }
    }

    public function fetch_pro_id()
    {

        if($this->input->post('regional_pro_id'))
        {
        echo $this->category_model->fetch_pro_id($this->input->post('regional_pro_id'));
        }
    }




    /**
     * Add Image Post
     */
    public function add_media_post()
    {   date_default_timezone_set('Asia/Kolkata');
        $data = $this->input->post();
        //echo '<pre>';print_r($data);
        //echo $new_date = date('Y-m-d h:i:s', strtotime($data));
       // die();
        $this->form_validation->set_rules('title', "title", 'xss_clean');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
              $this->session->set_flashdata('form_data', $this->gallery_model->input_values_media());
              $this->session->set_flashdata('success_form', 'add-media-invite' . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
                
            }
        
    }

    /**
     * Update Image
     */
    public function update_media($id)
    {


        $data['title'] = trans("update_media");
        //get post
        $data['image'] = $this->gallery_model->get_media_id($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['invitees'] = $this->category_model->get_invitees();
        if (empty($data['image'])) {
            redirect($this->agent->referrer());
        }
       //$data['albums'] = $this->gallery_category_model->get_media_by_lang($data['image']->lang_id);
        $data['panel_settings'] = panel_settings();
        //$data['categories'] = $this->gallery_category_model->get_categories_by_audio_album($data['image']->audio_album_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/media/update_media', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Image Post
     */
    public function update_media_post()
    {
        //validate inputs
       // $value = $this->input->post();
        //echo '<pre>';print_r($value);die();
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_media());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);
           // die();

            if ($this->gallery_model->update_media($id)) {
                $this->session->set_flashdata('success', trans("media-invite") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'media-invite');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_media());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Image Post
     */
    public function delete_media_post()
    {

        $id = $this->input->post('id', true);
        if ($this->gallery_model->delete_media($id)) {
            $this->session->set_flashdata('success', trans("media-invite") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Albums
     */
    public function audio_albums()
    {

        $data['title'] = trans("audio");
        $data['albums'] = $this->gallery_category_model->get_audio_albums();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/audio_album', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function add_audio_album_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("album_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_category_model->add_audio_album()) {
                $this->session->set_flashdata('success_form', trans("album") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Update Gallery Album
     */
    public function update_audio_album($id)
    {
        //echo '===';die();
        $data['title'] = trans("update_audio_album");
        //get album
        $data['album'] = $this->gallery_category_model->get_audio_album($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['album'])) {
            redirect(admin_url() . 'audio-albums');
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/update_audio_album', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Gallery Album Post
     */
    public function update_audio_album_post()
    {

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);
            if ($this->gallery_category_model->update_audio_album($id)) {
                $this->session->set_flashdata('success', trans("album") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'audio-categories');
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Gallery Album Post
     */
    public function delete_audio_album_post()
    {
        $id = $this->input->post('id', true);
        //echo $id;die();
        //check if album has categories
        if ($this->gallery_category_model->get_audio_album_category_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_album"));
            exit();
        }
        if ($this->gallery_category_model->delete_audio_album($id)) {
            $this->session->set_flashdata('success', trans("category") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }

    //get albums by lang
    public function gallery_albums_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->gallery_category_model->get_albums_by_lang($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

    //set as album cover
    public function set_as_album_cover()
    {
        $image_id = $this->input->post('image_id', true);
        $this->gallery_model->set_as_album_cover($image_id);
    }

}
