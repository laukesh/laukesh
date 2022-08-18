<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->helper('custom_helper');
        $this->load->helper('captcha');
        $this->load->library('session');
        $this->load->library('encryption');


       
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
  
        echo $random_number = $this->generateRandomString();
        // setting up captcha config
        $this->session->set_userdata('random_number', $random_number);
        $vals = array(
        'word' => $random_number,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'font_path' => './path/to/fonts/texb.ttf',
        'img_width' => '100',
        'img_height' => '32',
        'expiration' => 7200
        );

        $cap = create_captcha($vals);
        $data['captcha'] = $cap['image'];  
        $data['random_number'] = $random_number;        
        $data['title'] = trans("login");
        $data['description'] = trans("login") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("login") . ', ' . $this->settings->application_name;
        $this->load->view('admin/login', $data);

    }




      public function captcha()
      {    
        $random_number = $this->generateRandomString();
        $this->session->set_userdata('random_number', $random_number);
        $vals = array(
        'word' => $random_number,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'font_path' => './path/to/fonts/texb.ttf',
        'img_width' => '100',
        'img_height' => '32',
        'expiration' => 7200
        );
       
        $cap = create_captcha($vals);
        $captcha = $cap['image']; 
        echo json_encode($captcha);      
      }

        function generateRandomString($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
       }

    /**
     * Admin Login Post
     */
    public function admin_login_post()
    {

         post_method();

        $this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('password', trans("form_password"), 'required');

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

            if($this->auth_model->get_fail_count() >= 4){

            $this->session->set_flashdata('error', "You have succeeded maximum attempts of invalid logins. Please try after 24 hours.");
            redirect($this->agent->referrer());
              }

            if($this->session->userdata('random_number') != $this->input->post('captcha_chk')){
            $this->session->set_flashdata('error', "Invalid captcha!");
            redirect($this->agent->referrer());
             }
          
            if($this->auth_model->login()){
                 $user = $this->auth_model->get_user_logs($this->input->post('email', true));
                 redirect(admin_url());

            }else{
            $user = $this->auth_model->get_user_fail_logs($this->input->post('email', true));
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
       

        if($this->input->post('submit'))
        {
           
          $this->form_validation->set_rules('email', 'Email', 'required');
          if($this->form_validation->run()==true)
          {
            $email =$this->input->post('email');
            $validatedEmail = $this->Auth_model->validateEmailWithType($email);
            // print_r($validatedEmail); die;
        if($validatedEmail==1)
        {
           
            $row = $validatedEmail;
            $user_id = 8;
            $string = time().$user_id.$email;
            $hash_String = hash('sha256', $string);
            $currentDate = date('Y-m-d H:i');
            $hash_expiry = date('Y-m-d H:i', strtotime($currentDate. '1 days'));
            $tokens = array(
                'reset_password_token'=> $hash_String,
                'expired_token'=> $hash_expiry,
                'reset_password_token_status'=>1,
            );

            $restLink = "<a class='btn btn-primary' href='".base_url('admin/reset_password?token='.$hash_String)."' ><button> Reset Password </button></a>";
            $token['text'] = '<p>An email has been sent on your registered email id</p>'.$restLink;
            $token['subject']= 'Password Reset link';
            $token['email']= $email;

             $send_mail = send_email($token, [$email]);
            if($send_mail ==true)
            {
                $this->Auth_model->updateTocken($tokens, $email);
                $this->session->set_flashdata('success', 'Reset Password link successfully sent');
                redirect(base_url('admin/forgot-password'));

            }else{
               $this->session->set_flashdata('error', 'You’re 
               either confused or you don’t belong here or If your email exists in our database, you will 
               receive a password reset link.');

            }


        }else{
           
            $this->session->set_flashdata('error', 'You’re either confused or you don’t belong here or If your email exists in our database, you will receive a password reset link');
            redirect(base_url().'admin/forgot-password');
            }
          }
        }
        $data['title'] = trans("reset_password");
        $this->load->view('admin/forget_password', $data);
    }

     public function reset_password()
     {

        if($this->input->get('token'))
        { 
            $tocken = $this->input->get('token');
            $getTockenDetail= $this->auth_model->resetPassword($tocken);
            $data['token'] =   $tocken;
            if($getTockenDetail!=false)
            {
                $hasDetails = $getTockenDetail->expired_token;
                $currentDate = date('Y-m-d H:i');
                if($currentDate < $hasDetails)
                {
                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        $this->form_validation->set_rules('newPassword', 'New password', 'required|alpha_numeric');
                        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|alpha_numeric|matches[newPassword]');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                        if($this->form_validation->run()==true)
                        {
                            $newPassword = $this->input->post('newPassword');
                            $this->load->library('bcrypt');
                             $tockenPassword = array(
                            'password' => $this->bcrypt->hash_password($newPassword), 
                            'expired_token'=> null,
                            'reset_password_token_status'=> null,
                            'reset_password_token'=>null,
                        );
                            $this->auth_model->updateNewPassword($tockenPassword, $tocken);
                            $this->session->set_flashdata('success', 'Successfully change Password');
                            redirect(base_url().'admin/login');


                        }else{
                        $this->session->set_flashdata('error', 'Confirm Password  does not match with New password');
                        $this->load->view('admin/resetPassword', $data);
                        }
                    }

                }else{
                    $this->session->set_flashdata('error', 'link is expired');
                    redirect(base_url().'admin/forgot-password');

                }
            }else
            {
                echo 'inalid details'; exit;
            }
            
        }
        $data['token'] =   $tocken;
        $data['title'] = trans("forgot_password");
        $this->load->view('admin/resetPassword', $data);
    }

    public function admin_forget_password_post()
    {
        
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
