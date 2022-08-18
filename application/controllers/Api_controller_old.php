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
              $json = stripslashes($json);
              $input_data = json_decode(trim(file_get_contents('php://input')), true);
             // echo $input_data['limit'];
             // die;
           
           $lang_id = $input_data['lang_id'];
           $id = $input_data['id'];           
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

    public function latest_sainik_samachar_post()
    {
           $lang_id = $this->input->get('lang_id');
           $data = $this->api_model->get_latest_sainik_samachar($lang_id);     
           //echo '<pre>';print_r($data);die;         
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

    public function latest_sainik_samachar_list()
    {
           $lang_id = $this->input->get('lang_id');
           $year = $this->input->get('year');
           $month = $this->input->get('month');
           $edition = $this->input->get('edition');
           $data = $this->api_model->get_latest_sainik_samachar_list($lang_id,$year,$month,$edition);     
           //echo '<pre>';print_r($data);die;         
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
              $json = stripslashes($json);
              $input_data = json_decode(trim(file_get_contents('php://input')), true);
             // echo $input_data['limit'];
             // die;
           
  
           $lang_id = $input_data['lang_id'];
           $limit = $input_data['limit'];
           $start = $input_data['start'];
           $video_category_id = $input_data['video_category_id'];
           $video_from_date = $input_data['video_from_date'];
           $video_to_date = $input_data['video_to_date'];
           $title = $input_data['title'];
           $data = $this->api_model->get_video($lang_id,$video_category_id,$video_from_date,$video_to_date,$title,$limit,$start);
           $data['no_of_record'] = count($data);
           $data['no_of_page'] = $start;
          
           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }


   public function audio_post()
    {
           $lang_id = $this->input->post('lang_id');
           $limit = $this->input->post('limit');
           $start = $this->input->post('start');
           $audio_category = $this->input->post('audio_category');
           $audio_date = $this->input->post('audio_date');
           $audio_date_to = $this->input->post('audio_date_to');
           $title = $this->input->post('title');
           $data = $this->api_model->get_audio($lang_id,$audio_category,$audio_date,$audio_date_to,$title,$limit,$start);
           $data['no_of_record'] = count($data);
           $data['no_of_page'] = $start;

           if(!empty($data))
           {
           $this->response($data, REST_Controller::HTTP_OK);
           }else{
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
           }
       
    }

    public function gallery_post()
    {
           $lang_id = $this->input->post('lang_id');
           $limit = $this->input->post('limit');
           $start = $this->input->post('start');
           $gallery_category = $this->input->post('gallery_category');
           $gallery_date = $this->input->post('gallery_date');
           $gallery_date_to = $this->input->post('gallery_date_to');
           $title = $this->input->post('title');
           $data = $this->api_model->get_gallery($lang_id,$gallery_category,$gallery_date,$gallery_date_to,$title,$limit,$start);
           $data['no_of_record'] = count($data);
           $data['no_of_page'] = $start;

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
