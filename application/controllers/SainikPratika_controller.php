<?php defined('BASEPATH') or exit('No direct script access allowed');

class SainikPratika_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
      //  check_permission('sainik_pratika');
        $this->load->model('SainikPratika_model');
    }

    /**
     * Add Page
     */
    public function SainikPratika_add_page()
    {
        
        $data['title'] = trans("add_sainik_samachar");
        $data['menu_links'] = $this->navigation_model->get_menu_links($this->selected_lang->id);
        $data['categories'] = $this->SainikPratika_model->get_sainik_patrika_categories();
        $data['parent_nav'] = "pages";
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);;
        $this->load->view('admin/sainik_patrika/add_pratika', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Page Post
     */
    public function SainikPratika_add_page_post()
    {
      
    $this->form_validation->set_rules('year', trans("year"), 'required|xss_clean');
    $this->form_validation->set_rules('month', trans("month"), 'required|xss_clean');
    $this->form_validation->set_rules('title', trans('title'), 'required|xss_clean');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->SainikPratika_model->add()) {
                $this->session->set_flashdata('success', trans("sainik_samachar") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }
  public function SainikPratika_add_page_post_update()
    {
     // print_r($_POST);die;
    $this->form_validation->set_rules('year', trans("year"), 'required|xss_clean');
    $this->form_validation->set_rules('month', trans("month"), 'required|xss_clean');
    $this->form_validation->set_rules('title', trans('title'), 'required|xss_clean');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->SainikPratika_model->add()) {
                $this->session->set_flashdata('success', trans("sainik_samachar") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }
 

    public function SainikPratika_pages()
    {
        //echo '====';die();
        $data['title'] = trans("pages");
        $pagination = $this->paginate(admin_url() . 'view-sainik-samachar', $this->SainikPratika_model->sainik_patrika_get_pages());
        //echo '==<br>'.print_r($pagination);
        $data['pages'] = $this->SainikPratika_model->get_sainik_patrika($pagination['per_page'], $pagination['offset']);
        $data['lang_search_column'] = 2;
        $data['parent_nav'] = "pages";
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/sainik_patrika/sainik_pratika', $data);
        $this->load->view('admin/includes/_footer');
    }



    /**
     * Update Page
     */
    public function SainikPratika_update_page($id)
    {
        $data['title'] = trans("update_page");
        //find page
        $data['page'] = $this->SainikPratika_model->get_page_by_id($id);
        $data['categories'] = $this->SainikPratika_model->get_sainik_patrika_categories();
        //page not found
        if (empty($data['page'])) {
            redirect($this->agent->referrer());
        }
        $data['menu_links'] = $this->navigation_model->get_menu_links($data['page']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/sainik_patrika/update_pratika', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function SainikPratika_view_page($id)
    {
        $data['title'] = trans("view_page");
        //find page
        $data['page'] = $this->SainikPratika_model->get_page_by_id($id);
        $data['categories'] = $this->SainikPratika_model->get_sainik_patrika_categories();
        //page not found
        if (empty($data['page'])) {
            redirect($this->agent->referrer());
        }
        $data['menu_links'] = $this->navigation_model->get_menu_links($data['page']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/sainik_patrika/view_sainik_samachar', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Page Post
     */
    public function update_page_post()
    {
        //echo '=============';die();
        //validate inputs
        //$this->form_validation->set_rules('title', trans("title"), 'required');

        // if ($this->form_validation->run() === false) {
        //     $this->session->set_flashdata('errors', validation_errors());
        //     $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
        //     redirect($this->agent->referrer());
        // } else {
          
            $id = $this->input->post('id', true);
            if ($this->SainikPratika_model->update_sainik_patrika($id)) {
                $this->session->set_flashdata('success', trans("sainik samachar") . " " . trans("msg_sainik_samachar_update"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'view-sainik-samachar');
                }
            } else {
                $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        //}

    }

    // /**
    //  * Delete Page Post
    //  */
    public function SainikPratika_delete_page_post()
    {
        $id = $this->input->post('id', true);
        $page = $this->page_model->get_page_by_id($id);
        if (empty($page)) {
            redirect($this->agent->referrer());
        }
        //check if page custom or not
        if ($page->is_custom == 0) {
            $lang = $this->language_model->get_language($page->lang_id);
            if (!empty($lang)) {
                $this->session->set_flashdata('error', trans("msg_page_delete"));
            }
        } else {
            if (count($this->page_model->get_subpages($id)) > 0) {
                $this->session->set_flashdata('error', trans("msg_delete_subpages"));
                exit();
            }
            if ($this->page_model->delete($id)) {
                $this->session->set_flashdata('success', trans("page") . " " . trans("msg_suc_deleted"));
                reset_cache_data_on_change();
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
    }

     public function SainikPratika_category()
    {

        check_permission('sainik patrika categories');
        $data['title'] = trans("categories");
        $data['categories'] = $this->SainikPratika_model->get_sainik_patrika_categories();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/sainik_patrika/category', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function add_category_post()
    {
        check_permission('categories');
        $this->form_validation->set_rules('name', trans("category_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values_cate());
            redirect($this->agent->referrer());
        }else{
            if ($this->SainikPratika_model->add_category()) {

                $this->session->set_flashdata('success_form', trans("add-sainik-patrika-category") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values_cate());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    public function update_category($id)
    {
        check_permission('categories');
        $data['title'] = trans("update_category");
        //get category
        $data['category'] = $this->SainikPratika_model->get_category($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/sainik_patrika/update_category', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function update_category_post()
    {
        check_permission('sainik_patrika_categories');
        //validate inputs
        $this->form_validation->set_rules('name', trans("category_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values_cate());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->SainikPratika_model->update_sainik_patrika_category($id)) {

                $this->session->set_flashdata('success', trans("add-sainik-patrika-category") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'add-sainik-patrika-category');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->SainikPratika_model->input_values_cate());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    public function delete_category_post()
    {
        if (!check_user_permission('categories')) {
            exit();
        }
        $id = $this->input->post('id', true);

        if ($this->SainikPratika_model->delete_category($id)) {
            $this->session->set_flashdata('success', trans("add-sainik-patrika-category") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    public function delete_sainik_patrika()
    {
        if (!check_user_permission('sainik_patrika')) {
            exit();
        }
        $id = $this->input->post('id', true);

        if ($this->SainikPratika_model->delete_sainik_patrika($id)) {
            $this->session->set_flashdata('success', trans("view-sainik-patrika") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }
    ///Add language content with parent if
  }

