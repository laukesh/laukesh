       <?php defined('BASEPATH') or exit('No direct script access allowed');


 require APPPATH . './libraries/REST_Controller.php';

class Api_controller extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        
    }

    public function index_post()
    {
              $json = $this->input->post();
              //$json = stripslashes($json);
              $input_data = json_decode(trim(file_get_contents('php://input')), true);
             // echo $input_data['limit'];
             // die;
           $limit   = isset($input_data['limit'])?$input_data['limit']:'';
           $start   = isset($input_data['start'])?$input_data['start']:'';
           $lang_id = isset($input_data['lang_id'])?$input_data['lang_id']:'';
           $pro_category = isset($input_data['pro_category'])?$input_data['pro_category']:'';
           $release_from_date = isset($input_data['release_from_date'])?$input_data['release_from_date']:'';
           $release_to_date = isset($input_data['release_to_date'])?$input_data['release_to_date']:'';
           $title = isset($input_data['title'])?$input_data['title']:'';
          
          // $title = stripslashes($title);
           $publish_status = isset($input_data['publish_status'])?$input_data['publish_status']:3;

            $resultarray= $this->api_model->get_latest_press_release($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$publish_status);

           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
          // $data=array_values($data);           
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

    public function latest_press_release_detail_post()
    {
             $json = $this->input->post();
             // $json = stripslashes($json);
              $input_data = json_decode(trim(file_get_contents('php://input')), true);
             // echo $input_data['limit'];
             // die;
           
           $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
           $id = isset($input_data['id'])?$input_data['id']:''; 
            $data['press_release'] = $this->api_model->get_latest_press_release_detail($id,$lang_id); 
            $data['photos'] = $this->api_model->get_latest_press_release_photo($id,$lang_id); 
            $data['infographics'] = $this->api_model->get_latest_press_release_infogrphic($id,$lang_id); 
            $data['videos'] = $this->api_model->get_latest_press_release_video($id,$lang_id);
            
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

     public function latest_pro_categories_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_latest_pro_categories($lang_id); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function latest_photo_galleries_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_latest_photo_galleries($lang_id); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function gallery_post()
    {
           $json = $this->input->post();
           $input_data = json_decode(trim(file_get_contents('php://input')), true);
           $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
           $limit   = isset($input_data['limit'])?$input_data['limit']:'';
           $start   = isset($input_data['start'])?$input_data['start']:'';
           $gallery_category_id = isset($input_data['gallery_category_id'])?$input_data['gallery_category_id']:'';
           $gallery_from_date = isset($input_data['gallery_from_date'])?$input_data['gallery_from_date']:'';
           $gallery_to_date = isset($input_data['gallery_to_date'])?$input_data['gallery_to_date']:'';
           $title = isset($input_data['title'])?$input_data['title']:'';              
         
           $resultarray = $this->api_model->get_gallery($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title);
           
           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

     public function latest_video_galleries_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_latest_video_galleries($lang_id); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function video_post()
    {
           $json = $this->input->post();
           $input_data = json_decode(trim(file_get_contents('php://input')), true);
           $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
           $limit   = isset($input_data['limit'])?$input_data['limit']:'';
           $start   = isset($input_data['start'])?$input_data['start']:'';
           $gallery_category_id = isset($input_data['gallery_category_id'])?$input_data['gallery_category_id']:'';
           $gallery_from_date = isset($input_data['gallery_from_date'])?$input_data['gallery_from_date']:'';
           $gallery_to_date = isset($input_data['gallery_to_date'])?$input_data['gallery_to_date']:'';
           $title = isset($input_data['title'])?$input_data['title']:'';              
         
           $resultarray = $this->api_model->get_videos($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title);
           
           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

     public function latest_audio_categories_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_audio_galleries($lang_id); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function audio_post()
    {
           $json = $this->input->post();
           $input_data = json_decode(trim(file_get_contents('php://input')), true);
           $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
           $limit   = isset($input_data['limit'])?$input_data['limit']:'';
           $start   = isset($input_data['start'])?$input_data['start']:'';
           $gallery_category_id = isset($input_data['gallery_category_id'])?$input_data['gallery_category_id']:'';
           $gallery_from_date = isset($input_data['gallery_from_date'])?$input_data['gallery_from_date']:'';
           $gallery_to_date = isset($input_data['gallery_to_date'])?$input_data['gallery_to_date']:'';
           $title = isset($input_data['title'])?$input_data['title']:'';              
         
           $resultarray = $this->api_model->get_audio($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title);
           
           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

    public function latest_infographics_categories_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_infographics_galleries($lang_id); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function infographics_post()
    {
           $json = $this->input->post();
           $input_data = json_decode(trim(file_get_contents('php://input')), true);
           $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
           $limit   = isset($input_data['limit'])?$input_data['limit']:'';
           $start   = isset($input_data['start'])?$input_data['start']:'';
           $gallery_category_id = isset($input_data['gallery_category_id'])?$input_data['gallery_category_id']:'';
           $gallery_from_date = isset($input_data['gallery_from_date'])?$input_data['gallery_from_date']:'';
           $gallery_to_date = isset($input_data['gallery_to_date'])?$input_data['gallery_to_date']:'';
           $title = isset($input_data['title'])?$input_data['title']:'';              
         
           $resultarray = $this->api_model->get_infographics($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title);
           
           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

     public function latest_sainik_samachar_list_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $year =  isset($input_data['year'])?$input_data['year']:'';
             $month =  isset($input_data['month'])?$input_data['month']:'';
             $edition =  isset($input_data['edition'])?$input_data['edition']:'';
             $limit   = isset($input_data['limit'])?$input_data['limit']:'';
             $start   = isset($input_data['start'])?$input_data['start']:'';
             $resultarray = $this->api_model->get_latest_sainik_samachar_list($lang_id,$year,$month,$edition,$limit,$start); 

           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function latest_sainik_samachar_details_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $id =  isset($input_data['id'])?$input_data['id']:'';            
             $resultarray = $this->api_model->get_latest_sainik_samachar_details($id);
             $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }
    
    public function latest_media_invites_list_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $pro_id =  isset($input_data['pro_id'])?$input_data['pro_id']:'';
             $title =  isset($input_data['title'])?$input_data['title']:'';
             $invite_from_date =  isset($input_data['invite_from_date'])?$input_data['invite_from_date']:'';
             $invite_to_date =  isset($input_data['invite_to_date'])?$input_data['invite_to_date']:'';
             $limit   = isset($input_data['limit'])?$input_data['limit']:'';
             $start   = isset($input_data['start'])?$input_data['start']:'';
             $resultarray = $this->api_model->get_latest_media_invites_list($lang_id,$pro_id,$title,$invite_from_date,$invite_to_date,$limit,$start); 
             if(empty($resultarray[0]->name)){
                $resultarray[0]->name = $resultarray[0]->firstname.' '.$resultarray[0]->lastname;
            }

           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

     public function latest_media_invites_details_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $id =  isset($input_data['id'])?$input_data['id']:'';            
             $resultarray = $this->api_model->get_latest_media_invite_details($id);
             
             if(empty($resultarray[0]->name)){
                $resultarray[0]->name = $resultarray[0]->firstname.' '.$resultarray[0]->lastname;
            }
            $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function language_master_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             //$lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $data = $this->api_model->get_language_master(); 
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function app_user_details_post()
    {
         $json = $this->input->post();
         $notification_pros =array();
         date_default_timezone_set("Asia/Kolkata");
         $input_data = json_decode(trim(file_get_contents('php://input')), true);
         $user_code =  isset($input_data['user_code'])?$input_data['user_code']:'';   
         $notification_token =  isset($input_data['notification_token'])?$input_data['notification_token']:'';   
         $platform =  isset($input_data['user_code'])?$input_data['platform']:'';     
         $created_at =  date("Y-m-d H:i:s");
         $notification_pros =  isset($input_data['notification_pros'])?$input_data['notification_pros']:''; 
         $notification_pros = json_encode($notification_pros);
         //print_r(json_encode($notification_pros));
         $preferred_language =  isset($input_data['preferred_language'])?$input_data['preferred_language']:'';  

         $resultarray = $this->api_model->post_app_user_details($user_code,$platform,$created_at,$notification_pros,$preferred_language,$notification_token);         
        
        $data['db_id']  = $resultarray;

        if(!empty($data))
           {
            $data['code']  = 200;
            $data['status']  = 'success';
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $data['code']  = 100;
            $data['status']  = 'failed';
             $this->response($data, REST_Controller::HTTP_NOT_FOUND);
        }
       
    }

    public function update_app_user_details_post()
    {
         $json = $this->input->post();
         $notification_pros =array();
         date_default_timezone_set("Asia/Kolkata");
         $input_data = json_decode(trim(file_get_contents('php://input')), true);
         $id =  isset($input_data['id'])?$input_data['id']:''; 
         $notification_pros =  isset($input_data['notification_pros'])?$input_data['notification_pros']:'';  
         $notification_token =  isset($input_data['notification_token'])?$input_data['notification_token']:''; 
         $notification_pros = json_encode($notification_pros);
         //print_r(json_encode($notification_pros));
         $preferred_language =  isset($input_data['preferred_language'])?$input_data['preferred_language']:'';  

         $resultarray = $this->api_model->update_app_user_details($id,$notification_pros,$preferred_language,$notification_token);         
        
        $data['data']  = $resultarray;
        
        if($data['data']==true)
           {
            $data['code']  = 200;
            $data['status']  = 'success';
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $data['code']  = 100;
            $data['status']  = 'failed';
             $this->response($data, REST_Controller::HTTP_NOT_FOUND);
        }
       
    }

    public function get_content_page_list_post()
    {
         $json = $this->input->post();
         $notification_pros =array();
         date_default_timezone_set("Asia/Kolkata");
         $input_data = json_decode(trim(file_get_contents('php://input')), true);    
         $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1; 
         
         $resultarray = $this->api_model->get_pages_list($lang_id);         
        
        $data['data']  = $resultarray;
        if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function latest_circular_notifications_list_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;
             $title =  isset($input_data['title'])?$input_data['title']:'';
             $publish_from_date =  isset($input_data['publish_from_date'])?$input_data['publish_from_date']:'';
             $publish_to_date =  isset($input_data['publish_to_date'])?$input_data['publish_to_date']:'';
             $limit   = isset($input_data['limit'])?$input_data['limit']:15;
             $start   = isset($input_data['start'])?$input_data['start']:0;

             $resultarray = $this->api_model->get_latest_circular_notifications_list($lang_id,$title,$publish_from_date,$publish_to_date,$limit,$start); 

           $data['no_of_record'] = count($resultarray);             
           $data['no_of_page'] = $start;  
           $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

     public function app_login_by_email_post()
    {
        $json = $this->input->post();
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $email =  isset($input_data['email'])?$input_data['email']:'';
        $password =  isset($input_data['password'])?$input_data['password']:'';
        //$this->form_validation->set_rules('email', trans("form_email"), 'required|xss_clean|max_length[200]');
       // $this->form_validation->set_rules('password', trans("form_password"), 'required|xss_clean|max_length[128]');
        

        $user = $this->auth_model->get_user_by_email($email, true);
        if($user){
            if($user->role == 'hq admin' || $user->role == 'pro_admin'){

                $user = $this->auth_model->get_user_by_email($email);
                if (!empty($user)){
                    if ($this->auth_model->login_app($email,$password)) {                
                   //echo "user is validated";
                   $data['status'] = 'success';
                   $data['code'] = '200';
                   $data['user_id'] = $user->id;
                   $data['pro_id'] = $user->pro_category_id;
                   $data['role'] = $user->role;
                   $data['firstname'] = $user->firstname;
                   $data['lastname'] = $user->lastname;
                   $data['email'] = $user->email;

                     }
                     else{
                        $data['status'] = 'failed';
                       $data['code'] = '100';
                       $data['message'] = 'Incorrect username or password';
                     //   echo "incorrect username or password";
                     }
                }
            }
            else{
                     $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'This user is allowed to login in to mobile app';
            }
        }
        else{
                    $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'No user found with this email id';
        }

        if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

     public function dashboard_first_post()
    {
             $json = $this->input->post();
             $input_data = json_decode(trim(file_get_contents('php://input')), true);
             $id =  isset($input_data['id'])?$input_data['id']:'';            
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;            
             $resultarray = $this->api_model->get_dashboard_first_data($id,$lang_id);
             //print_r($resultarray);die;
             $data['data']  = $resultarray;
            if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

     public function admin_forget_password_post($email){
                    $this->load->library('Phpmailer_lip');        
                    $mail = $this->phpmailer_lip->load();
                    $mail->SMTPDebug = 2;  
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


    public function reset_password_by_email_post()
    {
        $json = $this->input->post();
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $email =  isset($input_data['email'])?$input_data['email']:'';
               

        $user = $this->auth_model->get_user_by_email($email, true);
        if($user){
            if($user->role == 'hq admin' || $user->role == 'pro_admin'){

                $user = $this->auth_model->get_user_by_email($email);
                if (!empty($user)){
                    echo $this->admin_forget_password_post($email);

                        $data['status'] = 'success';
                       $data['code'] = '200';
                       $data['message'] = 'We have sent an email for resetting the password on your registered email id.';
                    
                    }
            }
            else{
                   $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'You can not reset your password since you are super admin, Ask your web administrator to reset';
            }
        }
        else{
                   $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'No user found with this email id';
        }

        if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

     public function logo_gallery_get()
     {      
           $limit   = $this->input->post('limit');
           $start   = $this->input->post('start');
           $lang_id = $this->input->post('lang_id');
           $data = $this->api_model->get_logo_gallery($lang_id,$limit,$start);  
           $data['no_of_record'] = count($data);
           $data['no_of_page'] = $start;            
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
      }

   

}
