<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Press_realease_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Categories
     */
    public function pro_categories()
    {

        check_permission('Press_realease_categories');
        $data['title'] = trans("categories");
         //echo '===';die();
        $data['categories'] = $this->category_model->get_categories();
        //echo '<pre>';print_r($data['categories']);die();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/categories', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function post_action_pru_lang_ajax(){

          $lang_id = $this->input->post('lang_id');
          $pru_id  = $this->input->post('pru_id');
       //  die();
           
         $data_val = $this->category_model->get_categories_ajax($lang_id,$pru_id); 

        if(!empty($data_val)){
        $val = array(
            'id'       => $data_val[0]->id,
            'name'     => $data_val[0]->name,
            'slug'     => $data_val[0]->slug,
            'description'     => $data_val[0]->description,
            'is_active'=> $data_val[0]->is_active,
            'is_headquarter'=> $data_val[0]->is_headquarter
         );
        echo json_encode($val);
        }else{
            echo json_encode('0');
        }
        
    }

    /**1
     * Add Category posix_t
     */
    public function add_press_realease_post()
    {
        check_permission('Press_realease_categories');
     
        $this->form_validation->set_rules('name', trans("category_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values());
            redirect($this->agent->referrer());
        } else {

            if ($this->category_model->add_category()) {

                $this->session->set_flashdata('success_form', trans("press-release-category") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Update Category
     */
    public function update_category($id)
    {
        check_permission('Press_realease_categories');
        $data['title'] = trans("update_category");
        //get category
        $data['category'] = $this->category_model->get_categories_val($id);
       //echo '<pre>'; print_r($data['category']);
       //die();
        $data['panel_settings'] = panel_settings();
        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/update_category', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Category Post
     */
    public function update_category_post()
    {
        check_permission('Press_realease_categories');

        $this->form_validation->set_rules('name', trans("category_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->category_model->update_category($id)) {

                $this->session->set_flashdata('success', trans("pro-category") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'pro-category');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Category Post
     */
    public function delete_category_post()
    {
        if (!check_user_permission('Press_realease_categories')) {
            exit();
        }
        $id = $this->input->post('id', true);

        if ($this->category_model->delete_category($id)) {
            $this->session->set_flashdata('success', trans("category") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }





     public function press_realease_type()
    {
       
        check_permission('Press_realease_type');
        $data['title'] = trans("Press_realease_type");
         //echo '===';die();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        //echo '<pre>';print_r($data['categories']);die();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/add_press_realease_type', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function add_press_realease_type_post()
    {
        check_permission('Press_realease_type');
        //$data = $this->input->post();
       
        $this->form_validation->set_rules('name', trans("Name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values_type());
            redirect($this->agent->referrer());
        } else {
            //echo '<pre>';print_r($data);die();
            if ($this->category_model->add_press_release_type()) {

                $this->session->set_flashdata('success_form', trans("press-release-type") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values_type());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    public function update_press_release_type($id)
    {  
   
        check_permission('press_release_type');
        $data['title'] = trans("update_press_release_type");
        $data['press_release_type'] = $this->category_model->get_press_release_type($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['press_release_type'])){
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/update_press_realease_type', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function update_press_release_post()
    {
      
        check_permission('press_realease_type');
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false){
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values_type());
            redirect($this->agent->referrer());
        }else{

            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->category_model->update_press_realease_type($id)) {

                $this->session->set_flashdata('success', trans("press-release-type") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'press-release-type');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values_type());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    public function delete_press_release_type_post()
    {
        if (!check_user_permission('press_realease_type')) {
            exit();
        }
        $id = $this->input->post('id', true);

        if ($this->category_model->delete_press_release_type($id)) {
            $this->session->set_flashdata('success', trans("press-release-type") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    public function press_realease()
    {
        //check_permission('press_release');
        $data['title'] = trans("press_release");
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();
        $data['press_realease_by_user'] = $this->category_model->get_press_realease_by_user();
        //echo '<pre>';print_r($data['press_realease_by_user']);die();
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/add-press-realease', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function press_realease_translation($id)
    {
        $lang_id = '';
        $data['title'] = trans("press_release");
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $data['language_list'] = $this->language_model->get_languages_press_relase_other($id,$lang_id);
       // echo '<pre>';print_r($data['language_list']);
       //die();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();
        $data['press_realease_by_user'] = $this->category_model->get_press_realease_by_user();
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_show($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_show($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_show($id);
        $data['view_press_list'] = $this->category_model->get_view_press_release_list_userby($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['panel_settings'] = panel_settings();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/add-press-realease-translation', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function add_press_release_post()
    {

        $data = $this->input->post();

    //   echo '<pre>';print_r($data);
    //    die();
     
        $this->form_validation->set_rules('press_release_type', trans("press_release_type"), 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values_press());
            redirect($this->agent->referrer());
        
        }else{
         
         if(!empty($this->input->post('press_release_ids')) || $this->input->post('press_release_type') > 1)
         {
             
          if($this->input->post('press_release_type') == 3){

            // if ($this->category_model->update_press_realease($this->input->post('press_release_ids'))){
            //       $id = $this->input->post('press_release_ids');
            //       $last_id = $id;


            //         $press_history_id = $this->category_model->update_press_release_history_log($last_id);

            //         $this->category_model->update_press_release_media($last_id,$press_history_id); 

            //         $this->session->set_flashdata('success_form', trans("withdrawl_request"));
            //          redirect($this->agent->referrer());


            //     }
                     $id = $this->input->post('press_release_ids');
                    $pre_image = $this->input->post('pre_image');    

                    $this->category_model->press_release_history_log($id,$pre_image);
                    $last_id = $this->db->insert_id();
 
                    if(!empty($last_id) && $this->category_model->press_release_media($id,$last_id)){
  
                    }

                    $this->session->set_flashdata('success_form', trans("update_request_Press_Release"));
                     redirect($this->agent->referrer());
           }else{
          
                    $id = $this->input->post('press_release_ids');
                    $pre_image = $this->input->post('pre_image');    

                    $this->category_model->press_release_history_log($id,$pre_image);
                    $last_id = $this->db->insert_id();
 
                    if(!empty($last_id) && $this->category_model->press_release_media($id,$last_id)){
  
                    }

                    $this->session->set_flashdata('success_form', trans("update_request_Press_Release"));
                     redirect($this->agent->referrer());

            }


         }else{

                 
               $last_id = $this->category_model->add_press_realease();

              // echo '===='.$last_id;
                  //die;
                         
              if($last_id)
              { 
                   $last_insert_id =  $this->category_model->press_release_history_log($last_id);
                   $last_id2 = $this->category_model->press_release_media($last_id,$last_insert_id);
             

                    if($this->input->post('status') == '1')
                    {
                      $this->session->set_flashdata('success_form', trans("mess_sucess_add_press"));
                      redirect($this->agent->referrer());
                    }else if($this->input->post('status') == '2')
                    {
                        //echo '=====';die;
                       $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_submit"));
                       redirect($this->agent->referrer());
                    }else if($this->input->post('status') == '3')
                    {
                       $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_submit"));
                       redirect($this->agent->referrer());
                    }
                    else if($this->input->post('status') == '4')
                    {
                       $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_schedule _on_publish"));
                       redirect($this->agent->referrer());
                    }
                    

                }else{

                $this->session->set_flashdata('form_data', $this->category_model->input_values_press());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }

          }
        }
    }


    public function view_press_release_list(){

         //check_permission('press_release');

        $data['title'] = trans("press_release");
        if($this->uri->segment(2) == 'view-schedule-publish-list'){
        $pagination = $this->paginate(admin_url() . 'view-schedule-publish-list', $this->category_model->get_paginated_press_release_count());
         $data['view_press_release'] = $this->category_model->get_view_press_release_list($pagination['per_page'], $pagination['offset']);
        }else{
            $pagination = $this->paginate(admin_url() . 'view-press-release-list', $this->category_model->get_paginated_press_release_count());
             $data['view_press_release'] = $this->category_model->get_view_press_release_list($pagination['per_page'], $pagination['offset']);
        }
       
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-list', $data);
        $this->load->view('admin/includes/_footer');

    }

    public function view_press_release_list_translate($id){
    //echo '===';die;
        $data['title'] = trans("press_release");
        if($this->uri->segment(2) == 'view-schedule-publish-list-translate'){
        $pagination = $this->paginate(admin_url() . 'view-schedule-publish-list-translate', $this->category_model->get_paginated_press_release_count_translate($id));
         $data['view_press_release'] = $this->category_model->get_view_press_release_list($pagination['per_page'], $pagination['offset'],$id);
        }else{
            $pagination = $this->paginate(admin_url() . 'view-schedule-publish-list-translate', $this->category_model->get_paginated_press_release_count_translate($id));
             $data['view_press_release'] = $this->category_model->get_view_press_release_list_translate($pagination['per_page'], $pagination['offset'],$id);
        }
       
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-list-translate', $data);
        $this->load->view('admin/includes/_footer');

    }

      public function view_schedule_publish_list(){

         //check_permission('press_release');

        $data['title'] = trans("press_release");
        $pagination = $this->paginate(admin_url() . 'view-schedule-publish-list', $this->category_model->get_paginated_press_release_count());
        $data['view_press_release'] = $this->category_model->get_view_press_release_list($pagination['per_page'], $pagination['offset']);
        //echo '==='.count($data['view_press_release']);
        //die;
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view_press_release_schedule_request', $data);
        $this->load->view('admin/includes/_footer');

    }

    // new function for rejected release

    public function view_rejected_publish_list(){

        //check_permission('press_release');

       $data['title'] = trans("press_release");
       $pagination = $this->paginate(admin_url() . 'view-rejected-publish-list', $this->category_model->get_paginated_press_release_count());
       $data['view_press_release'] = $this->category_model->get_view_press_release_list($pagination['per_page'], $pagination['offset']);
       //echo '==='.count($data['view_press_release']);
       //die;
      // echo $this->pagination->create_links();
      // die();
       $data['panel_settings'] = panel_settings();

       $this->load->view('admin/includes/_header', $data);
       $this->load->view('admin/press-realease/view_press_release_reject_request', $data);
       $this->load->view('admin/includes/_footer');

   }

    //  public function view_schedule_publish_listing($id){

    //     $data['title'] = trans("view-schedule-publish-list");
    //     $data['view_press_release'] = $this->category_model->get_view_press_release_show($id);
    //     $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_show($id);
    //     $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_show($id);
    //     $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_show($id);
    //     $data['pru_categories'] = $this->category_model->get_categories();
    //     $data['press_realease_type'] = $this->category_model->get_press_realease_type();
    //     $data['press_realease_service'] = $this->category_model->get_press_realease_service();

    //     $this->load->view('admin/includes/_header', $data);
    //     $this->load->view('admin/press-realease/view-press-release', $data);
    //     $this->load->view('admin/includes/_footer');

    // }



    



     public function view_press_release_status(){

        //check_permission('press_release');
        $data['title'] = trans("press_release");

        $pagination = $this->paginate(admin_url() . 'view-press-release-list', $this->category_model->get_paginated_press_release_status_count());
        $data['view_press_release'] = $this->category_model->get_view_press_release_status_list($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();
        //$data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-list', $data);
        $this->load->view('admin/includes/_footer');

    }

    public function view_press_release($id)
    {  
        $data['title'] = trans("view-press-release");
        $data['view_press_release'] = $this->category_model->get_view_press_release_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_show($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_show($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_show($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release', $data);
        $this->load->view('admin/includes/_footer');
    }

 



    public function update_press_release_request_display($id)
    { 

        $data['title'] = trans("view-press-release-update-display");
        $data['view_press_release'] = $this->category_model->get_view_press_release_update_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_update_show($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_update_show($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_update_show($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-update-display', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function update_press_release($id)
    {  
       //echo '=======';die;
        $data['title'] = trans("view-press-release");
        $data['view_press_release'] = $this->category_model->get_view_press_release_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_show($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_show($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_show($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/update-press-release', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function update_press_release_value_post()
    {

               $id = $this->input->post('id');
              if ($this->category_model->update_press_realease($id))
              {

               
                   $last_id = $id;
                    if(!empty($last_id) && $this->category_model->update_press_release_history_log($last_id))
                    {
                     $press_history_id = $this->db->insert_id();
                   

                        if(!empty($press_history_id) && $this->category_model->update_press_release_media($last_id,$press_history_id))
                        {
                             if($this->input->post('status') == '3')
                             {                  
                                $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_publish"));
                                redirect($this->agent->referrer());

                              }else if($this->input->post('status') == '4')
                              {
                                $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_schedule _on_publish"));
                                redirect($this->agent->referrer());
                              }elseif($this->input->post('status') == '9'){
                                $this->session->set_flashdata('success_form', trans("msg_unpublished"));
                                    redirect($this->agent->referrer());
                              }
                              elseif($this->input->post('status') == '2'){
                                $this->session->set_flashdata('success_form', trans("msg_submitted"));
                                    redirect($this->agent->referrer());
                              }
                              elseif($this->input->post('status') == '6'){
                                  
                                $this->session->set_flashdata('success_form', trans("mess_sucess_add_press_rejected"));
                                    redirect($this->agent->referrer());
                              }elseif($this->input->post('status') == '10'){
                                  
                                $this->session->set_flashdata('success_form', trans("mess_sucess_resubmitted"));
                                    redirect($this->agent->referrer());
                              }
                              elseif($this->input->post('status') == '1'){
                                $this->session->set_flashdata('success_form', trans("msg_draft"));
                                    redirect($this->agent->referrer());
                              }
                          
                        }

                    }
                                  
                }else{
                    $this->session->set_flashdata('form_data', $this->category_model->input_values_press());
                    $this->session->set_flashdata('error_form', trans("msg_error"));
                    redirect($this->agent->referrer());
                }
          // }
      }


     public function press_release_cate_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $albums = $this->category_model->get_pro_category_by_lang($lang_id);
            foreach ($albums as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


/********************************WITHDRAWL REQUEST CODE START********************************/


    public function view_press_realease_withdraw_request()
    {
        $data['title'] = trans("press_release");
        $pagination = $this->paginate(admin_url() . 'view-press-realease-withdraw-request', $this->category_model->get_paginated_press_release_withdraw_request_count());
        $data['view_press_release'] = $this->category_model->get_press_release_withdraw_request($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view_press_release_withdraw_request', $data);
        $this->load->view('admin/includes/_footer');

    }


    public function update_press_realease_withdraw_request($id)
    { 

        $data['title'] = trans("view-press-release");
        $data['view_press_release'] = $this->category_model->get_edit_press_release_withdraw_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_edit_press_release_infographic_withdraw_show($id);
        $data['view_press_release_image'] = $this->category_model->get_edit_press_release_image_withdraw_show($id);
        $data['view_press_release_video'] = $this->category_model->get_edit_press_release_video_withdraw_show($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();

        $this->load->view('admin/includes/_header', $data);
        //$this->load->view('admin/press-realease/update_press_release_withdraw_request', $data);
        $this->load->view('admin/press-realease/update-press-release-request', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function view_press_release_withdraw_request_display($id)
    { 
        $data['title'] = trans("view-press-release-update-display");
        $data['view_press_release'] = $this->category_model->get_view_press_release_withdraw_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_withdraw_show($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_withdraw_show($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_withdraw_show($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-update-display', $data);
        $this->load->view('admin/includes/_footer');
    }



/********************************WITHDRAWL REQUEST CODE END********************************/





/********************************UPDATE REQUEST CODE START********************************/


     public function view_press_realease_update_request(){

        $data['title'] = trans("press_release");
        $pagination = $this->paginate(admin_url() . 'view_update_request_press_release', $this->category_model->get_paginated_update_press_release_count());
        $data['view_press_release'] = $this->category_model->get_press_release_update_request($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();
        //$data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/view-press-release-update-request', $data);
        $this->load->view('admin/includes/_footer');

    }


    public function update_press_release_request($id)
    {  

        $data['title'] = trans("view-press-release");
        $data['view_press_release'] = $this->category_model->get_view_press_release_update_show($id);
        $data['view_press_release_infographic'] = $this->category_model->get_view_press_release_infographic_update_show_two($id);
        $data['view_press_release_image'] = $this->category_model->get_view_press_release_image_update_show_two($id);
        $data['view_press_release_video'] = $this->category_model->get_view_press_release_video_update_show_two($id);
        $data['pru_categories'] = $this->category_model->get_categories();
        $data['press_realease_service'] = $this->category_model->get_press_realease_service();
        $data['press_realease_type'] = $this->category_model->get_press_realease_type();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/press-realease/update-press-release-request', $data);
        $this->load->view('admin/includes/_footer');
    }


    public function update_request_press_release_value_post()
    {

        $this->form_validation->set_rules('press_release_type', trans("press_release_type"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values_press());
            redirect($this->agent->referrer());
        } else {
              $id = $this->input->post('id');

            if ($this->category_model->update_request_press_realease($id)){

               $last_id = $id;
               $press_history_id = $this->category_model->update_request_press_release_history_log($last_id);
                
                $last_id3  = $this->category_model->update_request_press_release_media($last_id,$press_history_id);
       
            $this->session->set_flashdata('success_form', trans("view-press-release-list") . " " . trans("msg_suc_updated"));
                redirect($this->agent->referrer());

            }else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values_press());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /******************************UPDATE REQUEST CODE END*************************************/


}
