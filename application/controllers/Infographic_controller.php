<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Infographic_controller extends Admin_Core_Controller
{
  

    public function __construct()
    {
        parent::__construct();
        //check_permission('infographic');
    }
 
    /**
     * Images
     */
    public function infographic()
    {
        //echo '===';die();
        $data['title'] = trans("infographic");
        //paginate
        $pagination = $this->paginate(admin_url() . 'infographic', $this->gallery_model->get_paginated_infographic_count());
        $data['infographic'] = $this->gallery_model->get_paginated_infographic($pagination['per_page'], $pagination['offset']);
        //echo '<pre>';print_r($data['images']);die();
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/infographic/infographic', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Image
     */
    public function add_infographic()
    {

        $data['title'] = trans("add_media");
        $data['infographic'] = $this->gallery_category_model->get_infographic_by_lang($this->selected_lang->id);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/infographic/add_infographic', $data);
        $this->load->view('admin/includes/_footer');
    }



    /**
     * Add Image Post
     */
   public function add_infographic_post()
    {

        $this->form_validation->set_rules('infographic_category', trans("infographic_category"), 'required');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_infographic());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_model->add_infographic()) {
                $this->session->set_flashdata('success_form', trans("infographic") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_infographic());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Image
     */
    public function update_infographic($id)
    {

      
        $data['title'] = trans("update_infographic");
        //get post
        $data['infographic'] = $this->gallery_model->get_infographic($id);
        if (empty($data['infographic'])) {
            redirect($this->agent->referrer());
        }
        $data['infographic_cate'] = $this->gallery_category_model->get_infographic_by_lang($data['infographic']->lang_id);
        $data['panel_settings'] = panel_settings();
        //$data['categories'] = $this->gallery_category_model->get_categories_by_audio_album($data['image']->audio_album_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/infographic/update_infographic', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Image Post
     */
    public function update_infographic_post()
    {

        $this->form_validation->set_rules('title', trans("title"), 'xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_model->input_values_infographic());
            redirect($this->agent->referrer());
        } else {

            $id = $this->input->post('id', true);
           // die();

            if ($this->gallery_model->update_infographic($id)) {
                $this->session->set_flashdata('success', trans("infographic") . " " . trans("msg_suc_update"));
                redirect(admin_url() . 'infographic');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_model->input_values_infographic());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

     public function infographic_by_lang()
    {
        $lang_id = $this->input->post('lang_id');
        if (!empty($lang_id)):
            $albums = $this->gallery_category_model->get_infographic_by_lang($lang_id);
            foreach ($albums as $item){
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
         endif;
    }

    /**
     * Delete Image Post
     */
    public function delete_infographic_post()
    {

        $id = $this->input->post('id', true);
        if ($this->gallery_model->delete_infographic($id)) {
            $this->session->set_flashdata('success', trans("infographic") . " " . trans("msg_suc_deleted"));
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
