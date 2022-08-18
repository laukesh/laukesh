<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Audio_controller extends Admin_Core_Controller
{
  

    public function __construct()
    {
        parent::__construct();
        check_permission('audio');
    }
 
    /**
     * Images
     */
    public function audio()
    {
        $data['title'] = trans("audio");
        //paginate
        $pagination = $this->paginate(admin_url() . 'audio', $this->gallery_model->get_paginated_audio_count());
        $data['images'] = $this->gallery_model->get_paginated_audio($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/audio', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image
     */
    public function add_audio()
    {

        $data['title'] = trans("add_image");
        $data['album'] = $this->gallery_category_model->get_audio_albums_by_lang($this->selected_lang->id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/add_audio', $data);
        $this->load->view('admin/includes/_footer');
    }



    /**
     * Add Image Post
     */
    public function add_audio_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
       // $this->form_validation->set_rules('audio_id', trans("audio"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_audio());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_model->add_audio()) {
                $this->session->set_flashdata('success_form', 'audio' . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_audio());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Update Image
     */
    public function update_audio_img($id)
    {
        $data['title'] = trans("update_audio");
        $data['image'] = $this->gallery_model->get_audio($id);
        if (empty($data['image'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->gallery_category_model->get_audio_albums_by_lang($data['image']->lang_id);
        $data['panel_settings'] = panel_settings();
        // $data['categories'] = $this->gallery_category_model->get_categories_by_audio_album($data['image']->audio_album_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/update_audio', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Image Post
     */
    public function update_gallery_image_post()
    {
        $value = $this->input->post();
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('cate_id', trans("category"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_audio());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);

            if ($this->gallery_model->update_audio($id)) {
                $this->session->set_flashdata('success', trans("audio") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'audio');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_audio());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Image Post
     */
    public function delete_audio_image_post()
    {

        $id = $this->input->post('id', true);
        if ($this->gallery_model->delete_audio($id)) {
            $this->session->set_flashdata('success', trans("audio") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Albums
     */
    public function audio_albums()
    {
        $lang_id=null;
        $data['title'] = trans("audio");
        $data['albums'] = $this->gallery_category_model->get_audio_albums($lang_id);
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/audio/audio_album', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Album Post
     */
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

       // echo '===';die();
        //validate inputs
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
