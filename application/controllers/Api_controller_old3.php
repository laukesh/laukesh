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
