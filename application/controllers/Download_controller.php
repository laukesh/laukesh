<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download_controller extends Admin_Core_Controller 
{

    public function __construct()
    {
        parent::__construct();
       //check_permission('gallery');
      $this->load->model('download_model');
    }

    /**
     * Images
     */
     public function download_category()
    {
        $data['title'] = trans("albums");
        $data['albums'] = $this->download_model->get_albums();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/download/download-category', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function add_download_category_post()
    {
       // $data = $this->input->post();
        //echo '<pre>';print_r($data);
        //die;
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->download_model->add_download_category()) {
                $this->session->set_flashdata('success_form', trans("download") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_download_category($id)
    {
        $data['title'] = trans("update_download-category");
        //get album
        $data['download_category'] = $this->download_model->get_download_categroy($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['download_category'])) {
            redirect(admin_url() . 'download-category');
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/download/update_download_category', $data);
        $this->load->view('admin/includes/_footer');
    }

      public function update_download_category_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);
            $created_at = $this->input->post('created_at', true);
            if ($this->download_model->update_download_category($id,$created_at)) {
                $this->session->set_flashdata('success', trans("download_category") . " " . trans("update_success"));
                redirect(admin_url() . 'download-category');
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
        if ($this->download_model->delete_download_category($id)) {
            $this->session->set_flashdata('success', trans("download-category") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }
 public function add_download()
    {
        //gallery_categories
        check_permission('download_form');
        $data['title'] = trans("download_form");
        $data['categories'] = $this->download_model->get_all_categories();
        $lang_id = 1;
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->download_model->get_download_category_by_lang($lang_id);
        //$data['download_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/download/add_download', $data);
        $this->load->view('admin/includes/_footer');
    }



    public function view_download()
    {
        //gallery_categories
        check_permission('download_form');
        $data['title'] = trans("download_form");
        $data['categories'] = $this->download_model->get_all_categories();
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->download_model->get_download_category_by_filter();
        //$data['download_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/download/view_download', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function download_category_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->download_model->get_download_category_by_lang_filter($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


     public function add_download_manage_post()
    {

          //$data = $this->input->post($_FILES);
        //echo '<pre>';print_r($data);die;
        check_permission('download');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->download_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->download_model->add()) {
                $this->session->set_flashdata('success_form', trans("category") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->download_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_download_manage($id)
    {
        check_permission('download');
        $data['title'] = trans("update_download");
        //get category
        $data['category'] = $this->download_model->get_category($id);
        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->download_model->get_download_manage_by_lang($data['category']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/update_category', $data);
        $this->load->view('admin/download/update_download', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function update_download_post()
    {


        check_permission('download');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->download_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('id', true);
            if ($this->download_model->update($id)) {
                $this->session->set_flashdata('success', trans("download") . " " . trans("msg_updated"));
                redirect(admin_url() . 'download-manage');
            } else {
                $this->session->set_flashdata('form_data', $this->download_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


     public function delete_download_category_post()
    {

        $id = $this->input->post('id', true);

        if ($this->download_model->delete($id)) {
            $this->session->set_flashdata('success', trans("download") . " " . trans("msg_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }


}