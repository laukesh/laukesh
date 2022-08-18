<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Logo_controller extends Admin_Core_Controller
{
  
    public function __construct()
    {
        parent::__construct();
        check_permission('logo');
        $this->load->model('logo_model');
    }
 
    /**
     * Images
     */
    public function logo()
    {
       $this->load->model('logo_model'); //echo '====';die();
        $data['title'] = trans("logo");
        //paginate
        $pagination = $this->paginate(admin_url() . 'logo', $this->logo_model->get_paginated_logo_gallery_count());
        $data['logo_gallery'] = $this->logo_model->get_paginated_logo_gallery($pagination['per_page'], $pagination['offset']);
        //echo '<pre>';print_r($data['images']);die();
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/logo/logo', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add event
     */
    public function add_logo()
    {
       /// echo '==========';die();
        $data['title'] = trans("add_logo");
        $data['logo'] = $this->gallery_category_model->get_logo_gallery_by_lang($this->selected_lang->id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/logo/add_logo', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image Post
     */
   public function add_logo_post()
    {    
        //$data =  $this->input->post();
         //echo '<pre>';print_r($data);die();
        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');
        //$this->form_validation->set_rules('infographic_category', 'infographic_category', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->logo_model->input_values_logo_gallery());
            redirect($this->agent->referrer());
        } else {
            if ($this->logo_model->add_logo_gallery()) {
                $this->session->set_flashdata('success_form', trans("add-logo") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->logo_model->input_values_logo_gallery());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Image
     */
    public function update_logo_gallery($id)
    {
       
      
        $data['title'] = trans("update_logo_gallery");
        //get post
        $data['logo_gallery'] = $this->logo_model->get_logo_gallery($id);
        if (empty($data['logo_gallery'])) {
            redirect($this->agent->referrer());
        }
        $data['event_cate'] = $this->gallery_category_model->get_event_by_lang($data['logo_gallery']->lang_id);
        $data['panel_settings'] = panel_settings();
        //$data['categories'] = $this->gallery_category_model->get_categories_by_audio_album($data['image']->audio_album_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/logo/update_logo_gallery', $data);
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
    public function delete_logo_gallery()
    {
        $id = $this->input->post('id', true);
        if ($this->logo_model->delete_logo_gallery($id)) {
            $this->session->set_flashdata('success', trans("logo") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    public function update_logo_gallery_post()
    {

        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->logo_model->input_values_logo_gallery());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);
           // die();

            if ($this->logo_model->update_logo_gallery($id)) {
                $this->session->set_flashdata('success', trans("logo") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'logo');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_logo_gallery());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


}
