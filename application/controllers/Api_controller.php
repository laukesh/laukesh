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
           $release_from_date = DateTime::createFromFormat('d/m/Y', $release_from_date)->format('Y-m-d');
           $release_to_date = DateTime::createFromFormat('d/m/Y', $release_to_date)->format('Y-m-d');
            //echo $date->format('Y-m-d');
           
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
           $gallery_from_date = DateTime::createFromFormat('d/m/Y', $gallery_from_date)->format('Y-m-d');
           $gallery_to_date = DateTime::createFromFormat('d/m/Y', $gallery_to_date)->format('Y-m-d');

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
           $gallery_from_date = DateTime::createFromFormat('d/m/Y', $gallery_from_date)->format('Y-m-d');
           $gallery_to_date = DateTime::createFromFormat('d/m/Y', $gallery_to_date)->format('Y-m-d');
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
           $gallery_from_date = DateTime::createFromFormat('d/m/Y', $gallery_from_date)->format('Y-m-d');
           $gallery_to_date = DateTime::createFromFormat('d/m/Y', $gallery_to_date)->format('Y-m-d');
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
           $gallery_from_date = DateTime::createFromFormat('d/m/Y', $gallery_from_date)->format('Y-m-d');
           $gallery_to_date = DateTime::createFromFormat('d/m/Y', $gallery_to_date)->format('Y-m-d');
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

             $invite_from_date = DateTime::createFromFormat('d/m/Y', $invite_from_date)->format('Y-m-d');
           $invite_to_date = DateTime::createFromFormat('d/m/Y', $invite_to_date)->format('Y-m-d');


             $limit   = isset($input_data['limit'])?$input_data['limit']:'';
             $start   = isset($input_data['start'])?$input_data['start']:'';
             $resultarray = $this->api_model->get_latest_media_invites_list($lang_id,$pro_id,$title,$invite_from_date,$invite_to_date,$limit,$start); 
             //echo $resultarray; die;
             //$count_rows = count($resultarray);
             if($resultarray==0){
                //$resultarray[0]->name='';
                 $data['no_of_record'] = 0;
                 $data['no_of_page'] = 0;  
                 $data['data']  = [];
             }
             else{
                $fullname = $resultarray[0]->firstname.' '.$resultarray[0]->lastname;
                $resultarray[0]->name = isset($fullname)?$fullname:'';
                $data['no_of_record'] = count($resultarray);            
                $data['no_of_page'] = $start; 
                $data['data']  = $resultarray; 
            }

          
          // $data['data']  = $resultarray;
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
         $email =  isset($input_data['email'])?$input_data['email']:''; 
         $notification_token =  isset($input_data['notification_token'])?$input_data['notification_token']:'';   
         $platform =  isset($input_data['user_code'])?$input_data['platform']:'';     
         $created_at =  date("Y-m-d H:i:s");
         $notification_pros =  isset($input_data['notification_pros'])?$input_data['notification_pros']:''; 
         $notification_pros = json_encode($notification_pros);
         //print_r(json_encode($notification_pros));
         $preferred_language =  isset($input_data['preferred_language'])?$input_data['preferred_language']:'';  

         $resultarray = $this->api_model->post_app_user_details($user_code,$email,$platform,$created_at,$notification_pros,$preferred_language,$notification_token);         
        $resultarray2 = $this->api_model->get_app_version();
        $data['app_details']  = $resultarray2;
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
         $email =  isset($input_data['email'])?$input_data['email']:'0';
         $notification_pros =  isset($input_data['notification_pros'])?$input_data['notification_pros']:'';  
         $notification_token =  isset($input_data['notification_token'])?$input_data['notification_token']:''; 
         $notification_pros = json_encode($notification_pros);
         //print_r(json_encode($notification_pros));
         $preferred_language =  isset($input_data['preferred_language'])?$input_data['preferred_language']:'';  

               
        if($id=='' && $email==''){
             $resultarray=false;
             }
             else{
                $resultarray = $this->api_model->update_app_user_details($id,$email,$notification_pros,$preferred_language,$notification_token);   
             }  
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
              $publish_from_date = DateTime::createFromFormat('d/m/Y', $publish_from_date)->format('Y-m-d');
               $publish_to_date = DateTime::createFromFormat('d/m/Y', $publish_to_date)->format('Y-m-d');
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
                    $pro_name = $this->api_model->get_pro_category_name($user->pro_category_id);
                    $pro_name2 = isset($pro_name[0]->name)?$pro_name[0]->name:'';


                                       //echo "user is validated";
                   $data['status'] = 'success';
                   $data['code'] = '200';
                   $data['user_id'] = $user->id;
                   $data['pro_id'] = $user->pro_category_id;
                   $data['pro_name'] = $pro_name2;
                   $data['role'] = $user->role;
                   $data['firstname'] = $user->firstname;
                   $data['lastname'] = $user->lastname;
                   $data['email'] = $user->email;
                   $data['mobile'] = $user->phone;

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
             $from_date =  isset($input_data['from_date'])?$input_data['from_date']:date('d/m/Y');     
             $to_date =  isset($input_data['to_date'])?$input_data['to_date']:date('d/m/Y');
             if($from_date == '' || $to_date == ''){
             $from_date = DateTime::createFromFormat('d/m/Y', date('d/m/Y'))->format('Y-m-d');
               $to_date = DateTime::createFromFormat('d/m/Y', date('d/m/Y'))->format('Y-m-d');
           }
    
             $lang_id =  isset($input_data['lang_id'])?$input_data['lang_id']:1;            
             $resultarray = $this->api_model->get_dashboard_first_data($id,$lang_id,$from_date,$to_date);
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

    public function change_password_by_email_post()
    {   
         $this->load->library('bcrypt');
        $json = $this->input->post();
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $email =  isset($input_data['email'])?$input_data['email']:'';
        $oldpassword =  isset($input_data['oldpassword'])?$input_data['oldpassword']:'';
        $newpassword =  isset($input_data['newpassword'])?$input_data['newpassword']:'';
        if(empty($email) || empty($oldpassword) || empty($newpassword)){
           $data['status'] = 'failed';
           $data['code'] = '100';
           $data['message'] = 'Please enter email, old password and new password';
        }
        else{
            $user = $this->auth_model->get_user_by_email($email, true);
            if($user){
                if($user->role == 'hq admin' || $user->role == 'pro_admin'){
                 $user = $this->auth_model->get_user_by_email($email);
                    if (!empty($user)){
                        if (!$this->bcrypt->check_password($oldpassword, $user->password)) {
                        //echo $this->admin_forget_password_post($email);
                           $data['status'] = 'failed';
                           $data['code'] = '100';
                           $data['message'] = 'Old password does not match with our database.';
                         }
                         else{
                        $resultarray =  $this->api_model->change_password_app($email,$newpassword);
                         $data['data']  = $resultarray;
                       // $this->db->where('id', $user->id);
                       // return $this->db->update('users', $data);
                           $data['status'] = 'success';
                           $data['code'] = '200';
                           $data['message'] = 'Password is changed successfully.';  
                           }                      
                        }
            }
            else{
                $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'You can not change your password since you are super admin, Ask your web administrator to reset';
            }

        }
        else{
                   $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'No user found with this email id';
        }
        }        

        if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function edit_profile_by_email_post()
    {   
         $this->load->library('bcrypt');
        $json = $this->input->post();
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $email =  isset($input_data['email'])?$input_data['email']:'';
        $firstname =  isset($input_data['firstname'])?$input_data['firstname']:'';
        $lastname =  isset($input_data['lastname'])?$input_data['lastname']:'';
        if(empty($email) || empty($firstname) || empty($lastname)){
           $data['status'] = 'failed';
           $data['code'] = '100';
           $data['message'] = 'Please enter email, firstname and lastname to update profile';
        }
        else{
            $user = $this->auth_model->get_user_by_email($email, true);
            if($user){
                if($user->role == 'hq admin' || $user->role == 'pro_admin'){
                 
                        $resultarray =  $this->api_model->update_profile($email,$firstname,$lastname);
                         $data['data']  = $resultarray;
                       // $this->db->where('id', $user->id);
                       // return $this->db->update('users', $data);
                           $data['status'] = 'success';
                           $data['code'] = '200';
                           $data['message'] = 'Profile has been updated successfully.';
                 }
            else{
                $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'You can not update profile  since you are super admin, Ask your web administrator to do it';
                }

        }
        else{
                   $data['status'] = 'failed';
                   $data['code'] = '100';
                   $data['message'] = 'No user found with this email id';
        }
        }        

        if(!empty($data))
               {
               $this->response($data, REST_Controller::HTTP_OK);
               }else{
                 $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
       
    }

    public function get_app_version_get()
    {
             
             $resultarray = $this->api_model->get_app_version();
             $data['data']  = $resultarray;
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

       public function submit_feedback_api_post()
    {
         $json = $this->input->post();
         date_default_timezone_set("Asia/Kolkata");
         $input_data = json_decode(trim(file_get_contents('php://input')), true);
         $name =  isset($input_data['name'])?$input_data['name']:''; 
         $email =  isset($input_data['email'])?$input_data['email']:'';
         $phone =  isset($input_data['phone'])?$input_data['phone']:'';  
         $subject =  isset($input_data['subject'])?$input_data['subject']:''; 

         if(empty($name) || empty($email) || empty($phone) || empty($subject)){
           $data['status'] = 'failed';
           $data['code'] = '100';
           $data['message'] = 'Please enter fullname, email, phone and description of feedback';
        }

        else{
                $resultarray = $this->api_model->submit_feedback_api($name,$email,$phone,$subject);
        }
        
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

   

}
