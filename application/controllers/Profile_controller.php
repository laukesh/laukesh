<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Auth_model');
    }

    /**
     * Profile Page
     */
    public function profile($slug)
    {

       if(empty($this->session->userdata('login'))){
          redirect(admin_url());
       }
     
        get_method();
        $slug = clean_slug($slug);
        $data['user'] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data['title'] = $data['user']->username;
        $data['description'] = $data['user']->username . " - " . $this->settings->site_title;
        $data['keywords'] = $data['user']->username . ', ' . $this->settings->application_name;
        $data["active_tab"] = "products";
        $data['user_session'] = get_user_session();
        $count_key = 'posts_count_profile' . $data['user']->id;
        $posts_key = 'posts_profile' . $data['user']->id;

        //profile posts count
        $total_rows = get_cached_data($count_key);
        if (empty($total_rows)) {
            $total_rows = $this->post_model->get_post_count_by_user($data['user']->id);
            set_cache_data($count_key, $total_rows);
        }
        //set paginated
        $pagination = $this->paginate(generate_profile_url($data["user"]->slug), $total_rows);
        $data['posts'] = get_cached_data($posts_key . '_page' . $pagination['current_page']);
        if (empty($data['posts'])) {
            $data['posts'] = $this->post_model->get_paginated_user_posts($data["user"]->id, $pagination['offset'], $pagination['per_page']);
            set_cache_data($posts_key . '_page' . $pagination['current_page'], $data['posts']);
        }

        $data["user_posts_count"] = $total_rows;
        $data["following"] = $this->profile_model->get_following_users($data['user']->id);
        $data["followers"] = $this->profile_model->get_followers($data['user']->id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('profile/profile', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Profile
     */
    public function update_profile()
    {
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("update_profile");
        $data['description'] = trans("update_profile") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("update_profile") . "," . $this->settings->application_name;
        $data["user"] = $this->auth_user;
        $data['user_session'] = get_user_session();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "update_profile";

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('settings/update_profile', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Profile Post
     */
    public function update_profile_post()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $user_id = $this->auth_user->id;
        $action = clean_str($this->input->post('submit', true));
        /*if ($action == "resend_activation_email") {
            //send activation email
            $this->load->model("email_model");
            $this->email_model->send_email_activation($user_id);
            $this->session->set_flashdata('success', trans("msg_send_confirmation_email"));
            redirect($this->agent->referrer());
        }*/
        //validate inputs
        $this->form_validation->set_rules('username', trans("username"), 'required|xss_clean|max_length[255]');
       /* $this->form_validation->set_rules('email', trans("email"), 'required|xss_clean');*/
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            $data = array(
                'username' => clean_str($this->input->post('username', true)),
                'slug' => remove_special_characters($this->input->post('slug', true), true),
                //'email' => clean_str($this->input->post('email', true)),
                'about_me' => $this->input->post('about_me', true)
            );
            //is email unique
           /* if (!$this->auth_model->is_unique_email($data["email"], $user_id)) {
                $this->session->set_flashdata('error', trans("message_email_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }*/
            //is username unique
            if (!$this->auth_model->is_unique_username($data["username"], $user_id)) {
                $this->session->set_flashdata('error', trans("msg_username_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }
            //is slug unique
            if ($this->auth_model->check_is_slug_unique($data["slug"], $user_id)) {
                $this->session->set_flashdata('error', trans("msg_slug_used"));
                redirect($this->agent->referrer());
                exit();
            }
            if ($this->profile_model->update_profile($data, $user_id)) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                //check email changed
                if ($this->profile_model->check_email_updated($user_id)) {
                    $this->session->set_flashdata('success', trans("msg_send_confirmation_email"));
                }
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Social Accounts
     */
    public function social_accounts()
    {
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("social_accounts");
        $data['description'] = trans("social_accounts") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("social_accounts") . "," . $this->settings->application_name;
        $data['user_session'] = get_user_session();
        $data["user"] = $this->auth_user;
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "social_accounts";

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/social_accounts', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Social Accounts Post
     */
    public function social_accounts_post()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if ($this->profile_model->update_social_accounts()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Preferences
     */
    public function preferences()
    {
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("preferences");
        $data['description'] = trans("preferences") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("preferences") . "," . $this->settings->application_name;
        $data["user"] = $this->auth_user;
        $data['user_session'] = get_user_session();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "preferences";

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/preferences', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Preferences Post
     */
    public function preferences_post()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if ($this->profile_model->update_preferences()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Visual Settings
     */
    public function visual_settings()
    {
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("visual_settings");
        $data['description'] = trans("visual_settings") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("visual_settings") . "," . $this->settings->application_name;
        $data["user"] = $this->auth_user;
        $data['user_session'] = get_user_session();
        $data["active_tab"] = "visual_settings";

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/visual_settings', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Visual Settings Post
     */
    public function visual_settings_post()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if ($this->profile_model->visual_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Change Password
     */
    public function change_password()
    {   
       
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("change_password");
        $data['description'] = trans("change_password") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("change_password") . "," . $this->settings->application_name;
        $data['user_session'] = get_user_session();
        $data["user"] = $this->auth_user;
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "change_password";

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('settings/change_password', $data);
        $this->load->view('admin/includes/_footer');
    }
     
    function myDecrypt($value, $key, $iv){
    $value = base64_decode($value);
    $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    if(empty($data)){
    $data = rand();
    }
    return $data;
    }


    /**
     * Change Password Post
     * 
     * 
     */
    public function change_password_post()
    {

        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        
            $password = $this->input->post('password');
            $old_password = $this->input->post('old_password');
            
            if($old_password != ''){
                $old_password_exists =  1;
            }
            else{
                $old_password_exists =  0;
            }
      


            $password_confirm = $this->input->post('password_confirm');
          
            $key="01234567890123456789012345678901"; 
            $vector="1234567890123412";
            $decrypted_old_password = $this->myDecrypt($old_password, $key, $vector);
            $pass_old=explode('.',$decrypted_old_password);
            $old_password_decrpt=$pass_old[0];

            $decrypted_password = $this->myDecrypt($password, $key, $vector);
            $password=explode('.',$decrypted_password);
            $password_decrpt=$password[0];

            $password_confirm = $this->myDecrypt($password_confirm, $key, $vector);
            $password_confirm=explode('.',$password_confirm);
            $password_confirm_decrpt=$password_confirm[0];

            

            $uppercase = preg_match('@[A-Z]@', $password_decrpt);
            $lowercase = preg_match('@[a-z]@', $password_decrpt);
            $number    = preg_match('@[0-9]@', $password_decrpt);
            $specialChars = preg_match('@[^\w]@', $password_decrpt);

            if(empty(trim($old_password_decrpt))){
                 $this->session->set_flashdata('errors', 'Please fill the old password field');     
                redirect($this->agent->referrer());
            }


            if(strlen($password_decrpt) < 8) {
                $this->session->set_flashdata('errors', 'Password should be of minimum 8 chars and max 16 chars. It must have atleast 1 uppercase, 1 lowercase 1 number in letters.', 'required|trim');     
                redirect($this->agent->referrer());
            }
            if(!$uppercase || !$lowercase || !$number || !$specialChars ) {       
                 $this->session->set_flashdata('errors', 'Password should be of minimum 8 chars and max 16 chars. It must have atleast 1 uppercase, 1 lowercase 1 number in letters.', 'required|trim');
                 redirect($this->agent->referrer());
            }
            if(trim($password_confirm_decrpt) != trim($password_decrpt)){
                $this->session->set_flashdata('errors', 'Password and confirm password could not match.', 'required|trim');
                 redirect($this->agent->referrer());
            }

            if ($this->profile_model->change_password($old_password_exists)) {
                $this->session->set_flashdata('success', trans("message_change_password_success"));
                $baseurl= base_url('admin');
                redirect($baseurl);
                //redirect(admin_url());
            }else{
                $this->session->set_flashdata('error', trans("message_change_password_error"));
                redirect($this->agent->referrer());
            }
      
    }

    /**
     * Delete Account
     */
    public function delete_account()
    {
        get_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("delete_account");
        $data['description'] = trans("delete_account") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("delete_account") . "," . $this->settings->application_name;
        $data['user_session'] = get_user_session();
        $data["user"] = $this->auth_user;
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "delete_account";

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/delete_account', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Delete Account Post
     */
    public function delete_account_post()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $this->load->library('bcrypt');
        $user = $this->auth_user;
        if (!empty($user)) {
            $confirm = $this->input->post('confirm', true);
            $password = $this->input->post('password', true);
            if (empty($confirm)) {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
                exit();
            }
            if (!$this->bcrypt->check_password($password, $user->password)) {
                $this->session->set_flashdata('error', trans("msg_wrong_password"));
                redirect($this->agent->referrer());
                exit();
            }
            //delete account
            $this->auth_model->delete_user($this->auth_user->id);
            redirect(base_url());
        }
    }

    /**
     * Follow Unfollow User
     */
    public function follow_unfollow_user()
    {
        post_method();
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $this->profile_model->follow_unfollow_user();
        redirect($this->agent->referrer());
    }

}
