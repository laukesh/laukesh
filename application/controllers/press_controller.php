<?php defined('BASEPATH') or exit('No direct script access allowed');

class Press_controller extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status == 0 && $this->auth_user->role != "admin") {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(generate_url('settings'));
        }
    }

    /**
     * Post Format
     */
    public function post_format()
    {
        check_permission('add_post');
        $data['title'] = trans("choose_post_format");
        $data['panel_settings'] = panel_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/post_format', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Post
     */
    public function add_press()
    {
       //echo '===';die();
        check_permission('add_press');
        $type = $this->input->get('type', true);
        if ($type != 'article' && $type != 'gallery' && $type != 'sorted_list' && $type != 'video' && $type != 'audio' && $type != 'trivia_quiz' && $type != 'personality_quiz') {
            redirect(admin_url() . 'post-format');
            exit();
        }
        $post_format = "post_format_" . $type;
        if ($this->general_settings->$post_format != 1) {
            redirect(admin_url() . 'post-format');
            exit();
        }
        $title = "add_" . $type;
        $data['title'] = trans($title);
        $data['post_type'] = $type;
        $data['panel_settings'] = panel_settings();
        $data['parent_categories'] = $this->category_model->get_parent_categories_by_lang($this->selected_lang->id);

        $view = $title;
        //if ($type == 'trivia_quiz' || $type == 'personality_quiz') {
           // $view = 'quiz/' . $title;
       // }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/post/' . $view, $data);
        $this->load->view('admin/includes/_footer');
    }

}