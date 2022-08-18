<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Circular_controller extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
       //check_permission('gallery');
      $this->load->model('circular_model');
    }

    /**
     * Images
     */
     public function circular_category()
    {
        $data['title'] = trans("albums");
        $data['albums'] = $this->circular_model->get_albums();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/circular/circular-category', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function add_circular_category_post()
    {
       // $data = $this->input->post();
        //echo '<pre>';print_r($data);
        //die;
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->circular_model->add_circular_category()) {
                $this->session->set_flashdata('success_form', trans("circular") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_circular_category($id)
    {
        $data['title'] = trans("update_circular-category");
        //get album
        $data['circular_category'] = $this->circular_model->get_circular_categroy($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['circular_category'])) {
            redirect(admin_url() . 'circular-category');
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/circular/update_circular_category', $data);
        $this->load->view('admin/includes/_footer');
    }

      public function update_circular_category_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);
            $created_at = $this->input->post('created_at', true);
            if ($this->circular_model->update_circular_category($id,$created_at)) {
                $this->session->set_flashdata('success', trans("circular-category") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'circular-category');
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


     public function delete_gallery_album_post()
    {
        $id = $this->input->post('id', true);
        if ($this->gallery_category_model->get_album_category_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_album"));
            exit();
        }
        if ($this->circular_model->delete_circular_category($id)) {
            $this->session->set_flashdata('success', trans("circular-category") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }


    public function circular_manage()
    {
        //gallery_categories
        check_permission('circular_form');
        $data['title'] = trans("circular_form");
        $data['categories'] = $this->circular_model->get_all_categories();
        //$data['circular'] = $this->gallery_category_model->get_all_circular();
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->circular_model->get_circular_category_by_lang($this->selected_lang->id);
        //$data['circular_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/circular/circular_manage', $data);
        $this->load->view('admin/includes/_footer');
    }

      public function view_circular()
    {
        //gallery_categories
        check_permission('circular_form');
        $data['title'] = trans("circular_form");
        $data['categories'] = $this->circular_model->get_all_categories();
        //$data['circular'] = $this->gallery_category_model->get_all_circular();
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->circular_model->get_circular_category_by_lang();
        //$data['circular_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/circular/view_circular', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function circular_category_by_lang()
    {

        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->circular_model->get_circular_category_by_lang_filter($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


     public function add_circular_manage_post()
    {

          //$data = $this->input->post($_FILES);
        //echo '<pre>';print_r($data);die;
        check_permission('circular');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->circular_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->circular_model->add()) {
                $this->session->set_flashdata('success_form', trans("circular") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->circular_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_circular_manage($id)
    {
        check_permission('circular');
        $data['title'] = trans("update_circular");
        //get category
        $data['category'] = $this->circular_model->get_category($id);
        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->circular_model->get_circular_manage_by_lang($data['category']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/update_category', $data);
        $this->load->view('admin/circular/update_circular', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function update_circular_post()
    {


        check_permission('circular');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->circular_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('id', true);
            if ($this->circular_model->update($id)) {
                $this->session->set_flashdata('success', trans("circular") . " " . trans("msg_updated"));
                redirect(admin_url() . 'view-circular');
            } else {
                $this->session->set_flashdata('form_data', $this->circular_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


     public function delete_circular_category_post()
    {

        $id = $this->input->post('id', true);

        if ($this->circular_model->delete($id)) {
            $this->session->set_flashdata('success', trans("circular") . " " . trans("msg_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }


}