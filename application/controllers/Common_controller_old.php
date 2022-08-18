<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Admin Login
     */
    public function admin_login()
    {
        get_method();
        //check if logged in
        if (auth_check()) {
            redirect(admin_url());
        }

        $data['title'] = trans("login");
        $data['description'] = trans("login") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("login") . ', ' . $this->settings->application_name;
        $this->load->view('admin/login', $data);

    }

    /**
     * Admin Login Post
     */
    public function admin_login_post()
    {
        post_method();
        //validate inputs
        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|max_length[128]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $user = $this->auth_model->get_user_by_email($this->input->post('email', true));
            if (!empty($user) && $user->role != 'admin' && $this->general_settings->maintenance_mode_status == 1) {
                $this->session->set_flashdata('error', "Site under construction! Please try again later.");
                redirect($this->agent->referrer());
            }
            if ($this->auth_model->login()) {
                $user = $this->auth_model->get_user_logs($this->input->post('email', true));
                redirect(admin_url());
            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', trans("login_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    public function logout()
    {
        get_method();
        $user = $this->auth_model->get_user_logs_logout($this->auth_user->id);
        $this->auth_model->logout();
        redirect($this->agent->referrer());
    }


    public function forgot_password(){
       //  $this->load->helper('captcha');
       //    $config = array(
       //      'img_path'      => base_url().'assets-front/images/captcha.jpg',
       //      'img_url'       => base_url().'assets-front/images/captcha.jpg/',
       //      'font_path'     => 'system/fonts/texb.ttf',
       //      'img_width'     => '160',
       //      'img_height'    => 50,
       //      'word_length'   => 8,
       //      'font_size'     => 18
       //  );
       // //echo '<pre>';print($config['img_path']);
       // //die;
       //  $captcha = create_captcha($config);
       //  $this->session->unset_userdata('captchaCode');
       //  $this->session->set_userdata('captchaCode', $captcha['word']);
       //  $data['captchaImg'] = $captcha['image'];
        $data['title'] = trans("forgot_password");
        $this->load->view('admin/forget_password',$data);
    }

    public function admin_forget_password_post(){
        $this->load->library('Phpmailer_lip');        
        $mail = $this->phpmailer_lip->load();
        //$mail->SMTPDebug = 2;  
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        $mail->IsSMTP();
        $mail->Host = "ssl://smtp.gmail.com"; 
        $mail->SMTPAuth = true;  
        $mail->SMTPKeepAlive = true;   
        // $mail->Mailer = “smtp”; // don't change the quotes!

        $mail->Username = "teampsq1@gmail.com"; // 
        $mail->Password = "Pa55sword@3"; // SMTP password
        //$mail->SMTPSecure = 'ssl'; 
        $mail->Port = 465;
        
        $mail->setFrom('teampsq1@gmail.com');
        $mail->addReplyTo('teampsq1@gmail.com');
        $mail->addAddress('ankurchawla.1989@gmail.com');
        $mail->IsHTML(true); 
        $mail->Subject = "Sainik Samachar Password Reset Instruction";
        $mail->Body = "This is test email for password reset"; //HTML Body
        //$mail->AltBody = "This is the body when user views in plain text format"; //Text Body 
        if(!$mail->Send())
        {
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
        echo "Mail has been to sent";
        }

    }


}
