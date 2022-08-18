<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
/* ankur added comment to test*/

    /**
     * Index Page
     */
    public function index()
    {
       
        check_permission('admin_panel');
        $data['title'] = trans("index");
        $data['last_comments'] = $this->comment_model->get_last_comments(5);
        $data['last_pending_comments'] = $this->comment_model->get_last_pending_comments(5);
        $data['last_contacts'] = $this->contact_model->get_last_contact_messages();
        $data['last_users'] = $this->auth_model->get_last_users();
        $data['panel_settings'] = panel_settings();
        $data['post_count'] = $this->post_admin_model->get_posts_count();
        $data['pending_post_count'] = $this->post_admin_model->get_pending_posts_count();
        $data['drafts_count'] = $this->post_admin_model->get_drafts_count();
        //$data['scheduled_post_count'] = $this->post_admin_model->get_scheduled_posts_count();
        $data['scheduled_post_count'] = $this->post_admin_model->get_scheduled_posts_count();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Navigation
     */
    public function navigation()
    {
        check_permission('navigation');

        $data["selected_lang"] = $this->input->get("lang", true);
        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect(admin_url() . "navigation?lang=" . $data["selected_lang"]);
        }

        $data['title'] = trans("navigation");
        $data['menu_links'] = $this->navigation_model->get_menu_links($data["selected_lang"]);
        //echo '<pre>';print_r($data['menu_links']);die;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/navigation/navigation', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Menu Link Post
     */
    public function add_menu_link_post()
    {
        check_permission('navigation');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
        } else {
            if ($this->navigation_model->add_link()) {
                $this->session->set_flashdata('success_form', trans("link") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
            } else {
                $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
            }
        }
        redirect($this->agent->referrer());
    }


    /**
     * Update Menu Link
     */
    public function update_menu_link($id)
    {
        check_permission('navigation');
        $data['title'] = trans("navigation");
        $data['page'] = $this->page_model->get_page_by_id($id);
        $data['menu_links'] = $this->navigation_model->get_menu_links($data['page']->lang_id);
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/navigation/update_navigation', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Menü Link Post
     */
    public function update_menu_link_post()
    {
        check_permission('navigation');
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $id = $this->input->post('id', true);

            if ($this->navigation_model->update_link($id)) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                reset_cache_data_on_change();
                redirect(admin_url() . "navigation");
            } else {
                $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Sort Menu Items
     */
    public function sort_menu_items()
    {
        $this->navigation_model->sort_menu_items();
    }

    /**
     * Hide Show Home Link
     */
    public function hide_show_home_link()
    {
        $this->navigation_model->hide_show_home_link();
    }

    /**
     * Delete Navigation Post
     */
    public function delete_navigation_post()
    {
        if (!check_user_permission('navigation')) {
            exit();
        }
        $id = $this->input->post('id', true);
        $data["page"] = $this->page_model->get_page_by_id($id);

        //check if exists
        if (empty($data['page'])) {
            redirect($this->agent->referrer());
        }
        if (count($this->page_model->get_subpages($id)) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_subpages"));
            exit();
        }
        if ($this->page_model->delete($id)) {
            $this->session->set_flashdata('success', trans("link") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * Menu Limit Post
     */
    public function menu_limit_post()
    {
        check_permission('navigation');
        if ($this->navigation_model->update_menu_limit()) {
            $this->session->set_flashdata('success_form', trans("menu_limit") . " " . trans("msg_suc_updated"));
            $this->session->set_flashdata("mes_menu_limit", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('form_data', $this->navigation_model->input_values());
            $this->session->set_flashdata("mes_menu_limit", 1);
            $this->session->set_flashdata('error_form', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }


    //get menu links by language
    public function get_menu_links_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $menu_links = $this->navigation_model->get_menu_links_by_lang($lang_id);
            foreach ($menu_links as $item):
                if ($item["type"] != "category" && $item["location"] == "main" && $item['parent_id'] == "0"):
                    echo ' <option value="' . $item["id"] . '">' . $item["title"] . '</option>';
                endif;
            endforeach;
        endif;
    }

    /**
     * Themes
     */
    public function themes()
    {
        check_admin();
        $data['title'] = trans("themes");
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/themes', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Set Theme Post
     */
    public function set_theme_post()
    {
        check_admin();
        $this->settings_model->set_theme();
        redirect($this->agent->referrer());
    }


    /**
     * Comments
     */
    public function comments()
    {
        check_permission('comments_contact');
        $data['title'] = trans("approved_comments");
        $data['comments'] = $this->comment_model->get_all_approved_comments();
        $data['panel_settings'] = panel_settings();
        $data['top_button_text'] = trans("pending_comments");
        $data['top_button_url'] = admin_url() . "pending-comments";
        $data['show_approve_button'] = false;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/comments', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Pending Comments
     */
    public function pending_comments()
    {
        check_permission('comments_contact');
        $data['title'] = trans("pending_comments");
        $data['comments'] = $this->comment_model->get_all_pending_comments();
        $data['top_button_text'] = trans("approved_comments");
        $data['top_button_url'] = admin_url() . "comments";
        $data['show_approve_button'] = true;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/comments', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Aprrove Comment Post
     */
    public function approve_comment_post()
    {
        if (!check_user_permission('comments_contact')) {
            exit();
        }
        $id = $this->input->post('id', true);
        if ($this->comment_model->approve_comment($id)) {
            $this->session->set_flashdata('success', trans("msg_comment_approved"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }


    /**
     * Delete Comment Post
     */
    public function delete_comment_post()
    {
        if (!check_user_permission('comments_contact')) {
            exit();
        }
        $id = $this->input->post('id', true);
        if ($this->comment_model->delete_comment($id)) {
            $this->session->set_flashdata('success', trans("comment") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Approve Selected Comments
     */
    public function approve_selected_comments()
    {
        if (check_user_permission('comments_contact')) {
            $comment_ids = $this->input->post('comment_ids', true);
            $this->comment_model->approve_multi_comments($comment_ids);
        }
    }

    /**
     * Delete Selected Comments
     */
    public function delete_selected_comments()
    {
        if (check_user_permission('comments_contact')) {
            $comment_ids = $this->input->post('comment_ids', true);
            $this->comment_model->delete_multi_comments($comment_ids);
        }
    }


    /**
     * Contact Messages
     */
    public function contact_messages()
    {
        check_permission('comments_contact');
        $data['title'] = trans("contact_messages");
        $data['messages'] = $this->contact_model->get_contact_messages();
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/contact_messages', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Delete Contact Message Post
     */
    public function delete_contact_message_post()
    {
        if (!check_user_permission('comments_contact')) {
            exit();
        }
        $id = $this->input->post('id', true);

        if ($this->contact_model->delete_contact_message($id)) {
            $this->session->set_flashdata('success', trans("message") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Delete Selected Contact Messages
     */
    public function delete_selected_contact_messages()
    {
        if (check_user_permission('comments_contact')) {
            $messages_ids = $this->input->post('messages_ids', true);
            $this->contact_model->delete_multi_messages($messages_ids);
        }
    }


    /**
     * Ads
     */
    public function ad_spaces()
    {
        check_permission('ad_spaces');
        $data['title'] = trans("ad_spaces");
        $data['ad_space'] = $this->input->get('ad_space', true);
        if (empty($data['ad_space'])) {
            redirect(admin_url() . "ad-spaces?ad_space=header");
        }

        $data['ad_codes'] = $this->ad_model->get_ad_codes($data['ad_space']);
        $data['panel_settings'] = panel_settings();
        if (empty($data['ad_codes'])) {
            redirect(admin_url() . "ad-spaces");
        }
        $data["array_ad_spaces"] = array(
            "header" => trans("header_top_ad_space"),
            "index_top" => trans("index_top_ad_space"),
            "index_bottom" => trans("index_bottom_ad_space"),
            "post_top" => trans("post_top_ad_space"),
            "post_bottom" => trans("post_bottom_ad_space"),
            "posts_top" => trans("posts_top_ad_space"),
            "posts_bottom" => trans("posts_bottom_ad_space"),
            "category_top" => trans("category_top_ad_space"),
            "category_bottom" => trans("category_bottom_ad_space"),
            "tag_top" => trans("tag_top_ad_space"),
            "tag_bottom" => trans("tag_bottom_ad_space"),
            "search_top" => trans("search_top_ad_space"),
            "search_bottom" => trans("search_bottom_ad_space"),
            "profile_top" => trans("profile_top_ad_space"),
            "profile_bottom" => trans("profile_bottom_ad_space"),
            "reading_list_top" => trans("reading_list_top_ad_space"),
            "reading_list_bottom" => trans("reading_list_bottom_ad_space"),
            "sidebar_top" => trans("sidebar_top_ad_space"),
            "sidebar_bottom" => trans("sidebar_bottom_ad_space"),
        );

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/ad_spaces', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Ads Post
     */
    public function ad_spaces_post()
    {
        check_permission('ad_spaces');
        $ad_space = $this->input->post('ad_space', true);
        if ($this->ad_model->update_ad_spaces($ad_space)) {
            $this->session->set_flashdata('success', trans("ad_spaces") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }

        redirect(admin_url() . "ad-spaces?ad_space=" . $ad_space);
    }

    /**
     * Google Adsense Code Post
     */
    public function google_adsense_code_post()
    {
        if ($this->ad_model->update_google_adsense_code()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('mes_adsense', 1);
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('mes_adsense', 1);
        }
        redirect($this->agent->referrer());
    }


    /**
     * Settings
     */
    public function settings()
    {
        check_permission('settings');
        $data["selected_lang"] = $this->input->get("lang", true);
        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect(admin_url() . "settings?lang=" . $data["selected_lang"]);
        }
        $data['title'] = trans("settings");
        $data['panel_settings'] = panel_settings();
        $data['settings'] = $this->settings_model->get_settings($data["selected_lang"]);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/settings', $data);
        $this->load->view('admin/includes/_footer');
    }

     public function social_media_setting()
    {
        //echo '====';die;
        //check_permission('settings');
         check_permission('social_media_setting');
        // $data["selected_lang"] = $this->input->get("lang", true);
        // if (empty($data["selected_lang"])) {
        //     $data["selected_lang"] = $this->general_settings->site_lang;
        //     redirect(admin_url() . "settings?lang=" . $data["selected_lang"]);
        // }
        $data['title'] = trans("settings");
        $data['panel_settings'] = panel_settings();
        //$data['settings'] = $this->settings_model->get_settings($data["selected_lang"]);
        $data['facebook_setting'] = $this->settings_model->get_social_media_fb_settings();
        $data['linkedin_setting'] = $this->settings_model->get_social_media_link_settings();
        $data['instagram_setting'] = $this->settings_model->get_social_media_insta_settings();
        $data['settings'] = $this->settings_model->get_settings_two();
        $data['twitter_settings'] = $this->settings_model->get_settings_twitter();
        $data['youtube_settings'] = $this->settings_model->get_settings_youtube();

       // echo '<pre>';print_r($data['twitter_settings']);
       //die;
    
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/social_media_settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Settings Post
     */
    public function settings_post()
    {
        check_permission('settings');
        if ($this->settings_model->update_settings()) {
            $this->session->set_flashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        }
    }


    /**
     * Recaptcha Settings Post
     */
    public function recaptcha_settings_post()
    {
        check_permission('settings');
        if ($this->settings_model->update_recaptcha_settings()) {
            $this->session->set_flashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
            $this->session->set_flashdata("mes_recaptcha", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_recaptcha", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Maintenance Mode Post
     */
    public function maintenance_mode_post()
    {
        if ($this->settings_model->update_maintenance_mode_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_maintenance", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_maintenance", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Cache System
     */
    public function cache_system()
    {
        check_admin();
        $data['title'] = trans("cache_system");
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/cache_system', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Cache System Post
     */
    public function cache_system_post()
    {
        check_admin();
        if ($this->input->post('action', true) == "reset") {
            reset_cache_data();
            $this->session->set_flashdata('success', trans("msg_reset_cache"));
        } else {
            if ($this->settings_model->update_cache_system()) {
                $this->session->set_flashdata('success', trans("msg_updated"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
        redirect($this->agent->referrer());
    }

    /**
     * Route Settings
     */
    public function route_settings()
    {
        check_admin();
        $data['title'] = trans("route_settings");
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/route_settings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Route Settings Post
     */
    public function route_settings_post()
    {
        check_admin();
        if ($this->settings_model->update_route_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(base_url() . $this->input->post('admin', true) . "/route-settings");
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
        check_permission('settings');
        $data['title'] = trans("preferences");
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/preferences', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Preferences Post
     */
    public function preferences_post()
    {
        $form = $this->input->post('submit', true);
        $this->session->set_flashdata('mes_' . $form, 1);
        if ($this->settings_model->update_preferences($form)) {
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
        check_permission('settings');
        $data['title'] = trans("visual_settings");
        $data['visual_settings'] = $this->visual_settings_model->get_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/visual_settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Settings Post
     */
    public function visual_settings_post()
    {
        check_permission('settings');
        if ($this->visual_settings_model->update_settings()) {
            $this->session->set_flashdata('success', trans("visual_settings") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    public function facebook_settings_post()
    {

        // $data = $this->input->post();
        // echo '<pre>';print_r( $data);
        // die;
        
        
        check_permission('settings');
        //$url = $this->input->post('api');
        
        
        
        if ($this->visual_settings_model->update_settings_fb()) {
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
          
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    public function youtube_settings_post()
    {

        // $data = $this->input->post();
        // echo '<pre>';print_r( $data);
        // die;
        check_permission('settings');
        if ($this->visual_settings_model->update_settings_ytb()) {
            $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
          
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

     public function twitter_settings_post()
    {
        $data = $this->input->post();      
        $hdd=   implode("-",$data);
        $hddl=explode("-",$hdd);       
        for($i=0; $i<count($hddl); $i++){
            if($hddl[$i]!='')
            {
               $datas['hdl'] = $hddl[$i];
                $this->db->insert('twitter',$datas);
            }
        }    
        $this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_insert"));
         $this->session->set_flashdata("mes_settings", 1);
             redirect($this->agent->referrer());
   }

      public function social_media_post()
    {

        // $data = $this->input->post();
        // echo '<pre>';print_r( $data);
        // die;
        check_permission('settings');
        if ($this->visual_settings_model->update_social_media()) {
            //$this->session->set_flashdata('success', trans("social-media-setting") . " " . trans("msg_success_update"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }


    public function linkedin_settings_post()
    {

        // $data = $this->input->post();
        // echo '<pre>';print_r( $data);
        // die;
        check_permission('settings');
        if ($this->visual_settings_model->update_settings_linkedin()) {
            //$this->session->set_flashdata('success', trans("social-media") . " " . trans("msg_success_update"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
            
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    public function instagram_settings_post()
    {

        // $data = $this->input->post();
        // echo '<pre>';print_r( $data);
        // die;
        check_permission('settings');
        if ($this->visual_settings_model->update_settings_insta()) {
            //$this->session->set_flashdata('success', trans("social-media") . " " . trans("msg_success_update"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    /**
     * Email Settings
     */
    public function email_settings()
    {
        check_permission('settings');
        $data['title'] = trans("email_settings");
        $data["library"] = $this->input->get('library');
        $data['panel_settings'] = panel_settings();
        if (empty($data["library"])) {
            $data['library'] = $this->general_settings->mail_library;
            redirect(admin_url() . "email-settings?library=" . $data["library"]);
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/email_settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Email Settings Post
     */
    public function email_settings_post()
    {
        check_permission('settings');
        if ($this->settings_model->update_email_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('message_type', "email");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('message_type', "email");
            redirect($this->agent->referrer());
        }

    }


    /**
     * Update Contact Email Settings Post
     */
    public function contact_email_settings_post()
    {
        check_permission('settings');
        if ($this->settings_model->update_contact_email_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('message_type', "contact");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('message_type', "contact");
            redirect($this->agent->referrer());
        }
    }


    /**
     * Update Email Verification Settings Post
     */
    public function email_verification_settings_post()
    {
        check_permission('settings');
        if ($this->settings_model->email_verification_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('message_type', "verification");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('message_type', "verification");
            redirect($this->agent->referrer());
        }
    }

    /**
     * Send Test Email Post
     */
    public function send_test_email_post()
    {
        check_permission('settings');
        $email = $this->input->post('email', true);
        $subject = "Varient Test Email";
        $message = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                    but also the leap into electronic typesetting, remaining essentially unchanged.</p>";
        $this->load->model("email_model");
        $this->session->set_flashdata('message_type', "send_email");
        if (!empty($email)) {
            if (!$this->email_model->send_test_email($email, $subject, $message)) {
                redirect($this->agent->referrer());
                exit();
            }
            $this->session->set_flashdata('success', trans("msg_email_sent"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * NEWSLETTER
    *-------------------------------------------------------------------------------------------------
    */


    /**
     * Subscribers
     */
    public function subscribers()
    {
        check_permission('newsletter');
        $data['title'] = trans("subscribers");
        $data['subscribers'] = $this->newsletter_model->get_subscribers();
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter/subscribers', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Send Email to Subscribers
     */
    public function send_email_subscribers()
    {
        check_permission('newsletter');
        $data['title'] = trans("send_email_subscribers");

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter/send_email_subscribers', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Send Email to Subscribers Post
     */
    public function send_email_subscribers_post()
    {
        check_permission('newsletter');
        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', false);
        $this->load->model("email_model");
        $data['subscribers'] = $this->newsletter_model->get_subscribers();
        foreach ($data['subscribers'] as $item) {
            //send email
            if (!$this->email_model->send_email_newsletter($item, $subject, $message)) {
                redirect($this->agent->referrer());
                exit();
            }
        }

        $this->session->set_flashdata('success', trans("msg_email_sent"));
        redirect($this->agent->referrer());
    }

    /**
     * Send Email to Subscriber
     */
    public function send_email_subscriber($id)
    {
        check_permission('newsletter');
        $data['title'] = trans("send_email_subscriber");
        $data['subscriber'] = $this->newsletter_model->get_subscriber_by_id($id);

        if (empty($data['subscriber'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter/send_email_subscriber', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Send Email to Subscriber Post
     */
    public function send_email_subscriber_post()
    {
        check_permission('newsletter');
        $receiver = $this->input->post('receiver', true);
        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', false);
        $this->load->model("email_model");

        $subscriber = $this->newsletter_model->get_subscriber($receiver);
        if (!empty($subscriber)) {
            if (!$this->email_model->send_email_newsletter($subscriber, $subject, $message)) {
                redirect($this->agent->referrer());
                exit();
            }
            $this->session->set_flashdata('success', trans("msg_email_sent"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Delete Newsletter Post
     */
    public function delete_newsletter_post()
    {
        if (!check_user_permission('newsletter')) {
            exit();
        }
        $id = $this->input->post('id', true);
        $data['newsletter'] = $this->newsletter_model->get_subscriber_by_id($id);

        if (empty($data['newsletter'])) {
            $this->session->set_flashdata('error', trans("msg_error"));
        } else {
            if ($this->newsletter_model->delete_from_subscribers($id)) {
                $this->session->set_flashdata('success', trans("email") . " " . trans("msg_suc_deleted"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
    }

    /**
     * Seo Tools
     */
    public function seo_tools()
    {
        check_permission('seo_tools');
        $data['title'] = trans("seo_tools");
        $data["selected_lang"] = $this->input->get("lang", true);
        $data['panel_settings'] = panel_settings();
        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect(admin_url() . "seo-tools?lang=" . $data["selected_lang"]);
        }
        $data['settings'] = $this->settings_model->get_settings($data["selected_lang"]);


        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/seo_tools', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Seo Tools Post
     */
    public function seo_tools_post()
    {
        check_permission('seo_tools');
        if ($this->settings_model->update_seo_settings()) {
            $this->session->set_flashdata('success', trans("seo_options") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Social Login Configuration
     */
    public function social_login_configuration()
    {
        check_admin();
        $data['title'] = trans("social_login_configuration");
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/social_login', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Social Login Facebook Post
     */
    public function social_login_facebook_post()
    {
        check_admin();
        if ($this->settings_model->update_social_facebook_settings()) {
            $this->session->set_flashdata('msg_social_facebook', '1');
            $this->session->set_flashdata('success', trans("configurations") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    /**
     * Social Login Google Post
     */
    public function social_login_google_post()
    {
        check_admin();
        if ($this->settings_model->update_social_google_settings()) {
            $this->session->set_flashdata('msg_social_google', '1');
            $this->session->set_flashdata('success', trans("configurations") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }


    /**
     * Social Login VK Post
     */
    public function social_login_vk_post()
    {
        check_admin();
        if ($this->settings_model->update_social_vk_settings()) {
            $this->session->set_flashdata('msg_social_vk', '1');
            $this->session->set_flashdata('success', trans("configurations") . " " . trans("msg_suc_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }

    }

    /**
     * Font Settings
     */
    public function font_settings()
    {
        check_admin();

        $data["selected_lang"] = $this->input->get("lang", true);
        $data['panel_settings'] = panel_settings();
        if (empty($data["selected_lang"])) {
            $data["selected_lang"] = $this->general_settings->site_lang;
            redirect(admin_url() . "font-settings?lang=" . $data["selected_lang"]);
        }

        $data['title'] = trans("font_settings");
        $data['fonts'] = $this->settings_model->get_fonts();
        $data['settings'] = $this->settings_model->get_settings($data["selected_lang"]);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/font/fonts', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Font Post
     */
    public function add_font_post()
    {
        check_admin();
        if ($this->settings_model->add_font()) {
            $this->session->set_flashdata('success', trans("msg_added"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('mes_add_font', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Set Site Font Post
     */
    public function set_site_font_post()
    {
        check_admin();
        if ($this->settings_model->set_site_font()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('mes_set_font', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Font
     */
    public function update_font($id)
    {
        check_admin();
        $data['title'] = trans("update_font");
        $data['font'] = $this->settings_model->get_font($id);
        $data['panel_settings'] = panel_settings();
        if (empty($data['font'])) {
            redirect(admin_url() . "font-settings");
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/font/update', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Font Post
     */
    public function update_font_post()
    {
        check_admin();
        $id = $this->input->post('id', true);
        if ($this->settings_model->update_font($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('mes_table', 1);
        redirect(admin_url() . "font-settings?lang=" . $this->general_settings->site_lang);
    }

    /**
     * Delete Font Post
     */
    public function delete_font_post()
    {
        check_admin();
        $id = $this->input->post('id', true);
        if ($this->settings_model->delete_font($id)) {
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('mes_table', 1);
    }

    /**
     * Users
     */
    public function users()
    {
        check_permission('users');
        $data['title'] = trans("users");

        //paginate
        $pagination = $this->paginate(admin_url() . 'users', $this->auth_model->get_paginated_users_count());
        $data['users'] = $this->auth_model->get_paginated_users($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/users');
        $this->load->view('admin/includes/_footer');

    }


    public function user_logs()
    {

        check_permission('user_logs');
        $data['title'] = trans("user_logs");

        //paginate
        $pagination = $this->paginate(admin_url() . 'user-logs', $this->auth_model->get_paginated_user_logs_count());

        $data['users_logs'] = $this->auth_model->get_paginated_user_logs($pagination['per_page'], $pagination['offset']);
         //echo '===';die();
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/user_logs',$data);
        $this->load->view('admin/includes/_footer');

    }



    /**
     * Administrators
     */
    public function administrators()
    {
        check_admin();
        $data['title'] = trans("administrators");
        $data['users'] = $this->auth_model->get_administrators();
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/administrators');
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add User
     */
    public function add_user()
    {
        check_admin();
        $data['title'] = trans("add_user");
        $data['roles'] = $this->auth_model->get_roles_permissions();
        $data['pru_categories'] = $this->category_model->get_categories();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/add_user');
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add User Post
     */
    public function add_user_post()
    {
        check_admin();
        //validate inputs
        $this->form_validation->set_rules('username', trans("username"), 'required|xss_clean|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('email', trans("email_address"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone Number ', 'required|regex_match[/^[0-9]{10}$/]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $email = $this->input->post('email', true);
            $username = $this->input->post('username', true);

            //is username unique
            if (!$this->auth_model->is_unique_username($username)) {
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("msg_username_unique_error"));
                redirect($this->agent->referrer());
            }
            //is email unique
            if (!$this->auth_model->is_unique_email($email)) {
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("message_email_unique_error"));
                redirect($this->agent->referrer());
            }

            //add user
            if ($this->auth_model->add_user()) {
                $this->session->set_flashdata('success', trans("msg_user_added"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }

            redirect($this->agent->referrer());
        }
    }


    /**
     * Change User Role
     */
    public function change_user_role_post()
    {
        check_permission('users');
        $id = $this->input->post('user_id', true);
        $role = $this->input->post('role', true);
        $user = $this->auth_model->get_user($id);
        //check if exists
        if (empty($user)) {
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->change_user_role($id, $role)) {
                $this->session->set_flashdata('success', trans("msg_role_changed"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Confirm User Email
     */
    public function confirm_user_email()
    {
        $id = $this->input->post('id', true);
        $user = $this->auth_model->get_user($id);
        if ($this->auth_model->verify_email($user)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Ban User Post
     */
    public function ban_user_post()
    {
        if (!check_user_permission('users')) {
            exit();
        }
        $option = $this->input->post('option', true);
        $id = $this->input->post('id', true);

        //if option ban
        if ($option == 'ban') {
            if ($this->auth_model->ban_user($id)) {
                $this->session->set_flashdata('success', trans("msg_user_banned"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }

        //if option remove ban
        if ($option == 'remove_ban') {
            if ($this->auth_model->remove_user_ban($id)) {
                $this->session->set_flashdata('success', trans("msg_ban_removed"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
    }

    /**
     * Edit User
     */
    public function edit_user($id)
    {
        check_permission('users');
        $data['title'] = trans("update_profile");
        $data['user'] = $this->auth_model->get_user($id);
        $data['roles'] = $this->auth_model->get_roles_permissions();
        $data['pru_categories'] = $this->category_model->get_categories();

        //echo '<pre>';print_r($data['user']);
        // die();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/edit_user');
        $this->load->view('admin/includes/_footer');
    }

    public function change_password($id)
    {
        check_permission('users');
        $data['user'] = $this->auth_model->get_user($id);
        $data['title'] = trans("update_profile");
        $this->load->view('admin/includes/_header',$data);
        $this->load->view('admin/users/change_password',$data);
        $this->load->view('admin/includes/_footer');
    }

     public function change_password_post()
    {    $this->load->library('bcrypt');
        check_permission('users');

        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|max_length[255]');
        $this->form_validation->set_rules('confirm_password', trans("confirm_password"), 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {

            if($this->input->post('password') == $this->input->post('confirm_password')){

             $id =$this->input->post('id');
            
           
                $this->auth_model->change_password($id);
                $this->session->set_flashdata('success', trans("msg_updated_pass"));
                redirect($this->agent->referrer());
            

          }else{
            $this->session->set_flashdata('error', trans("msg_error_password"));
            redirect($this->agent->referrer());
          }

        }
    }




    public function edit_user_post()
    {
        $this->load->library('bcrypt');
        check_permission('users');
        //validate inputs
        $this->form_validation->set_rules('username', trans("username"), 'required|xss_clean|max_length[255]');
        $this->form_validation->set_rules('email', trans("email"), 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {

             $data = array(
            'id' => $this->input->post('id', true),
            'username' => remove_special_characters($this->input->post('username', true)),
            'email' => $this->input->post('email', true),
            'firstname' => $this->input->post('firstname', true),
            'lastname' => $this->input->post('lastname', true),
            'designation' => $this->input->post('designation', true),
            'phone' => $this->input->post('phone', true),
            'email' => $this->input->post('email', true),
            //'password' => $this->bcrypt->hash_password($this->input->post('password')),
            'pro_category_id' => $this->input->post('pro_category_id', true),
            'role' => $this->input->post('role', true),
            'permission' => $this->input->post('permission', true),
            'created_by' => $this->auth_user->id,
            'updated_by' => $this->auth_user->id,
            'created_at' =>  date('Y-m-d h:i:s'),
            'updated_at' =>  date('Y-m-d h:i:s')
            );

            //is email unique
            if (!$this->auth_model->is_unique_email($data["email"], $data["id"])) {
                $this->session->set_flashdata('error', trans("message_email_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }
            //is username unique
            if (!$this->auth_model->is_unique_username($data["username"], $data["id"])) {
                $this->session->set_flashdata('error', trans("msg_username_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }

            if ($this->auth_model->edit_user($data["id"])) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete User Post
     */
    public function delete_user_post()
    {
        if (!check_user_permission('users')) {
            exit();
        }
        $id = $this->input->post('id', true);
        if ($this->auth_model->delete_user($id)) {
            $this->session->set_flashdata('success', trans("user") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * Roles Permissions
     */
    public function roles_permissions()
    {
        check_admin();
        $data['title'] = trans("roles_permissions");
        $data['roles'] = $this->auth_model->get_roles_permissions();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/roles_permissions');
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Edit Role
     */
    public function edit_role($id)
    {
        check_admin();
        if ($id == 1) {
            redirect(admin_url() . 'roles-permissions');
        }
        $data['title'] = trans("edit_role");
        $data['role'] = $this->auth_model->get_role($id);

        if (empty($data['role'])) {
            redirect(admin_url() . 'roles-permissions');
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/users/edit_role', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Edit Role Post
     */
    public function edit_role_post()
    {
        check_admin();
        $id = $this->input->post('id', true);
        if ($this->auth_model->update_role($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Control Panel Language Post
     */
    public function control_panel_language_post()
    {
        $lang_id = $this->input->post('lang_id', true);
        $lang = $this->language_model->get_language($lang_id);
        if (!empty($lang)) {
            $this->session->set_userdata('vr_control_panel_lang', $lang);
        }
        redirect($this->agent->referrer());
    }

}