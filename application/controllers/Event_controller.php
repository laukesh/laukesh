<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_controller extends Admin_Core_Controller
{
  
    public function __construct()
    {
        parent::__construct();
        check_permission('event');
    }
 
    /**
     * Images
     */
    public function event()
    {
        $data['title'] = trans("event");
        //paginate
        $pagination = $this->paginate(admin_url() . 'event', $this->gallery_model->get_paginated_event_count());
        $data['event'] = $this->gallery_model->get_paginated_event($pagination['per_page'], $pagination['offset']);
        //echo '<pre>';print_r($data['images']);die();
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/event/event', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add event
     */
    public function add_event()
    {

        $data['title'] = trans("add_media");
        $data['infographic'] = $this->gallery_category_model->get_infographic_by_lang($this->selected_lang->id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/event/add_event', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image Post
     */
   public function add_event_post()
    {

        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        //$this->form_validation->set_rules('infographic_category', 'infographic_category', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_event());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_model->add_event()) {
                $this->session->set_flashdata('success_form', trans("add-event") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_event());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Image
     */
    public function update_event($id)
    {

      
        $data['title'] = trans("update_event");
        //get post
        $data['event'] = $this->gallery_model->get_event($id);
        if (empty($data['event'])) {
            redirect($this->agent->referrer());
        }
        $data['event_cate'] = $this->gallery_category_model->get_event_by_lang($data['event']->lang_id);
        $data['panel_settings'] = panel_settings();
        //$data['categories'] = $this->gallery_category_model->get_categories_by_audio_album($data['image']->audio_album_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/event/update_event', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Image Post
     */
    public function update_event_post()
    {
        //validate inputs
       // $value = $this->input->post();
        //echo '<pre>';print_r($value);die();
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_event());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);
           // die();

            if ($this->gallery_model->update_event($id)) {
                $this->session->set_flashdata('success', trans("event") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'event');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_event());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

     public function event_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->gallery_category_model->get_event_by_lang($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

    /**
     * Delete Image Post
     */
    public function delete_event_post()
    {

        $id = $this->input->post('id', true);
        if ($this->gallery_model->delete_event($id)) {
            $this->session->set_flashdata('success', trans("event") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Albums
     */
    public function infographic_category()
    {
    //echo '===';die();

        $data['title'] = trans("audio");
        $data['infographic'] = $this->gallery_category_model->get_infographic_category();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/infographic/infographic_category', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Album Post
     */
    public function add_infographic_category_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', 'name', 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_category_model->add_infographic_category()) {
                $this->session->set_flashdata('success_form', trans("infographic-category") . " " . trans("msg_suc_added"));
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
    public function update_infographic_category($id)
    {
        ///echo '===';die();
        $data['title'] = trans("infographic_category");
        //get album
        $data['infographic_category'] = $this->gallery_category_model->get_infographic_category_edit($id);
       $data['panel_settings'] = panel_settings();
        if (empty($data['infographic_category'])) {
           redirect(admin_url() . 'update-infographic-category/');
       }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/infographic/update_infographic_category', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Gallery Album Post
     */
    public function update_infographic_category_post()
    {

       // echo '===';die();
        //validate inputs
        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);
            if ($this->gallery_category_model->update_infographic_category($id)) {
                $this->session->set_flashdata('success', trans("infographic-category") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'infographic-category');
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Gallery Album Post
     */
    public function delete_infographic_category_post()
    {
        $id = $this->input->post('id', true);

        if ($this->gallery_category_model->delete_infographic_category($id)) {
            $this->session->set_flashdata('success', trans("infographic-category") . " " . trans("msg_suc_deleted"));
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
