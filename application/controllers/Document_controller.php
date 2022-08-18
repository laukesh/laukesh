<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document_controller extends Admin_Core_Controller
{
   public function __construct()
    {
        parent::__construct();
        //check_permission('circular_management');
       $this->load->model('document_model');

   }

    /**
     * Images
     */
     public function document_category()
    {
   
        $data['title'] = trans("albums");
        $data['albums'] = $this->document_model->get_albums();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/document/document-category', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function add_document_category_post()
    {
       // $data = $this->input->post();
        //echo '<pre>';print_r($data);
        //die;
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->document_model->add_document_category()) {
                $this->session->set_flashdata('success_form', trans("document") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_document_category($id)
    {
        $data['title'] = trans("update_document-category");
        //get album
        $data['document_category'] = $this->document_model->get_document_categroy($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['document_category'])) {
            redirect(admin_url() . 'document-category');
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/document/update_document_category', $data);
        $this->load->view('admin/includes/_footer');
    }

      public function update_document_category_post()
    {
        //validate inputs
        $data = $this->input->post();
        //echo '<pre>';print_r($data);
        //die();

        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);
            $created_at = $this->input->post('created_at', true);
            if ($this->document_model->update_document_category($id,$created_at)) {
                $this->session->set_flashdata('success', trans("document-category") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'document-category');
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
        if ($this->document_model->delete_document_category($id)) {
            $this->session->set_flashdata('success', trans("document-category") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }


    public function add_document()
    {
        //gallery_categories
        check_permission('document_form');
        $data['title'] = trans("document_form");
        $data['categories'] = $this->document_model->get_all_categories();
        //$data['document'] = $this->gallery_category_model->get_all_document();
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->document_model->get_document_category_by_lang();
        //$data['document_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/document/add_document', $data);
        $this->load->view('admin/includes/_footer');
    }

      public function view_document()
    {
     
        check_permission('document_form');
        $data['title'] = trans("document_form");
        $data['categories'] = $this->document_model->get_all_categories();
        //$data['document'] = $this->gallery_category_model->get_all_document();
        //echo '<pre>';print_r($data['categories']);
        //die;
        $data['panel_settings'] = panel_settings();
        $data['albums'] = $this->document_model->get_document_category_by_lang();
        //$data['document_form'] = $this->gallery_category_model->get_albums_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/categories', $data);
        $this->load->view('admin/document/view_document', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function document_category_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->document_model->get_document_category_by_lang_filter($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


     public function add_document_manage_post()
    {

          //$data = $this->input->post($_FILES);
        //echo '<pre>';print_r($data);die;
        check_permission('document');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->document_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->document_model->add()) {
                $this->session->set_flashdata('success_form', trans("document") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->document_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


       public function update_document_manage($id)
    {
        check_permission('document');
        $data['title'] = trans("update_document");
        //get category
        $data['category'] = $this->document_model->get_category($id);
        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }
      $data['albums'] = $this->document_model->get_document_manage_by_lang();
      //echo print_r($data['albums']);
      //die;

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/gallery/update_category', $data);
        $this->load->view('admin/document/update_document', $data);
        $this->load->view('admin/includes/_footer');
    }


     public function update_document_post()
    {


        check_permission('document');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->document_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('id', true);
            if ($this->document_model->update($id)) {
                $this->session->set_flashdata('success', trans("document") . " " . trans("msg_updated"));
                redirect(admin_url() . 'add-document');
            } else {
                $this->session->set_flashdata('form_data', $this->document_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


     public function delete_document_category_post()
    {

        $id = $this->input->post('id', true);

        if ($this->document_model->delete($id)) {
            $this->session->set_flashdata('success', trans("document") . " " . trans("msg_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }


}