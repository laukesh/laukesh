<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Video_controller extends Admin_Core_Controller
{
  

    public function __construct()
    {
        parent::__construct();
        check_permission('audio');
    }
    /**
     * Images
     */
    public function video()
    {
        $data['title'] = trans("video");
        //paginate
        $pagination = $this->paginate(admin_url() . 'video', $this->gallery_model->get_paginated_video_count());
        $data['images'] = $this->gallery_model->get_paginated_video($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/video/video', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image
     */
    public function add_video()
    {

        $data['title'] = trans("add_image");
        $data['album'] = $this->gallery_category_model->get_video_albums_by_lang($this->selected_lang->id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/video/add_video', $data);
        $this->load->view('admin/includes/_footer');
    }



    /**
     * Add Image Post
     */
    public function add_video_post()
    {
        $val = $this->input->post();
       // echo '<pre>';print_r($val);
       // die();
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
       // $this->form_validation->set_rules('audio_id', trans("audio"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_video());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_model->add_video()) {
                        
                $this->session->set_flashdata('success_form', trans("video") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {

                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_video());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Update Image
     */
    public function update_video($id)
    {

        //echo '===========';die();
        $data['title'] = trans("update_video");
        //get post
            $data['video'] = $this->gallery_model->get_video($id);
            if (empty($data['video'])) {
                redirect($this->agent->referrer());
            }
        $data['albums'] = $this->gallery_category_model->get_video_albums_by_lang($data['video']->lang_id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/video/update_video', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Image Post
     */
    public function update_gallery_image_post()
    {
        //validate inputs
        $value = $this->input->post();
        //echo '<pre>';print_r($value);die();
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('album_id', trans("album"), 'required');

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

    public function update_video_post()
    {
        //validate inputs
        $value = $this->input->post();
        //echo '<pre>';print_r($value);die();

       // echo $_FILES['cover_img']['name'];
       // die();
        //$this->form_validation->set_rules('title', trans("title"), 'required');
        $this->form_validation->set_rules('cate_id', trans("category"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_video());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);

            if ($this->gallery_model->update_video($id)) {
                $this->session->set_flashdata('success', trans("video") . " " . trans("msg_success_update"));
                redirect(admin_url() . 'video');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_video());
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

     public function delete_video_image_post()
    {

        $id = $this->input->post('id', true);
        if ($this->gallery_model->delete_video($id)) {
            $this->session->set_flashdata('success', trans("video") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Albums
     */
    public function video_albums()
    {
        

        $data['title'] = trans("video");
        $data['video_albums'] = $this->gallery_category_model->get_video_albums();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/video/video_album', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Album Post
     */
    public function add_video_album_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', 'name', 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_category_model->add_video_album()) {
                $this->session->set_flashdata('success_form', trans("category") . " " . trans("msg_suc_added"));
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
    public function update_video_album($id)
    {
        //echo '==========';die();
        $data['title'] = trans("update_audio_album");
        //get album
        $data['video_albums'] = $this->gallery_category_model->get_video_album($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['video_albums'])) {
            redirect(admin_url() . 'video-albums');
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/video/update_video_album', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Gallery Album Post
     */
    public function update_video_album_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', "name", 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            //echo '====';die;
            $id = $this->input->post('id', true);
            if ($this->gallery_category_model->update_video_album($id)) {
                //echo '===';die;
                $this->session->set_flashdata('success', trans("video") . " " . trans("msg_video_suc_updated"));
                redirect(admin_url() . 'video-category');
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
        if ($this->gallery_category_model->get_audio_album_category_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_album"));
            exit();
        }
        if ($this->gallery_category_model->delete_audio_album($id)) {
            $this->session->set_flashdata('success', trans("album") . " " . trans("msg_suc_deleted"));
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
