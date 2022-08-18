<?php 
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Home_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->post_load_more_count = 6;
        $this->comment_limit = 5;
        $this->load->helper('url','form','text');
        $this->load->model("home_model");
        $this->load->model("language_model");
        //$this->load->model("api_model");
         $this->load->helper('captcha');
        $this->load->model("navigation_model");
        $this->load->library("pagination");
        $this->load->library("ajax_pagination");
        $page_id= !empty($this->uri->uri_string())?$this->uri->uri_string():1;
        $ip_address =  $this->get_client_ip();
        $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
        $getloc->ip;
         $user_agent = $this->agent->agent_string();
        if($ip_address!=='::1'){
          $ip_address1 =$ip_address;
        }else{
          $ip_address1 =  $getloc->ip;
        }
         // stores IP address of visitor in variable
          add_view($ip_address1, $page_id, $user_agent);
    }

    public function index()
    {
        /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

       $data['photo'] = $this->home_model->photo(1);
      // $data['latest_image'] = $this->home_model->latest_image($lang_id);
      // echo '<pre>';print_r($data['latest_image']);
       $data['youtube_video'] = $this->home_model->youtube_video(1);
       
       $data['latest_sainik_samachar'] = $this->home_model->latest_sainik_samachar(1);
       $data['press_release'] = $this->home_model->press_release(3,0,1);
       $data['press_release2'] = $this->home_model->press_release(3,1,1);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery(1);
       $data['audio'] = $this->home_model->audio_gallery(1);
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
       $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

    $data['visual_settings_home_popup'] = $this->home_model->get_settings_home_popup();

       $data['twitter_settings'] = $this->home_model->get_settings_twitter();
       $data['facebook_settings'] = $this->home_model->get_settings_facebook();
       $data['youtube_settings'] = $this->home_model->get_settings_youtube();
       $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
     
       $this->load->view('partials/_header', $data);
       $this->load->view('index', $data);
       $this->load->view('partials/_footer', $data);
    }


    public function captcha_cron()
    {         
        $files = glob('./captcha/*'); 
        foreach($files as $file)
        { 
        if(is_file($file))
        unlink($file); 
         echo  "All Captcha deleted!";
           
        }

    }


   public function switchLang()
   {
        $lang = $this->input->get('lang_id');
        $domain = $this->input->get('domain');
        $this->load->library('session');
   
      $this->home_model->get_site_languages($lang);
    
     $this->session->userdata("language_short_form");  
    redirect($redirect_urls);
    } 
    public function latest_samachar(){
      if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;


       $id = $this->uri->segment(2);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
       $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
       
       $data['twitter_settings'] = $this->home_model->get_settings_twitter();
       $data['facebook_settings'] = $this->home_model->get_settings_facebook();
       $data['youtube_settings'] = $this->home_model->get_settings_youtube();
       $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

       $this->load->view('partials/_header', $data);
       $this->load->view('latest_samachar', $data);
       $this->load->view('partials/_footer', $data);
    }

    public function set_language($lang_id)
    {


      $lang_id = $this->session->set_userdata('lang_id', $lang_id);
      $currentURL = current_url(); 
      redirect($_SERVER['HTTP_REFERER']);
    }



    public function pdf(){
     $id = $this->uri->segment(2);
     $data = $this->home_model->sainik_samachar_list_id($id);
     $pdf = $data[0]->document_path;

     if($data[0]->month == 1){
       $month = 'Jan';
     }else if($data[0]->month == 2){
      $month = 'Feb';
     }else if($data[0]->month == 3){
      $month = 'Mar';
     }else if($data[0]->month == 4){
      $month = 'April';
     }else if($data[0]->month == 5){
      $month = 'May';
     }else if($data[0]->month == 6){
      $month = 'June';
     }else if($data[0]->month == 7){
      $month = 'July';
     }else if($data[0]->month == 8){
      $month = 'August';
     }else if($data[0]->month == 9){
      $month = 'Sept';
     }else if($data[0]->month == 10){
      $month = 'Oct';
     }else if($data[0]->month == 11){
      $month = 'Nov';
     }else if($data[0]->month == 12){
      $month = 'Dec';
     }
    if($data[0]->biweek_no == 1){
       $biweek_no = '01-15';
     }else if($data[0]->biweek_no == 2 && $data[0]->month = 1 || 3 || 5 || 7 || 9 || 12){
      $biweek_no = '16-31';
     }else{
      $biweek_no = '16-30';
     }


     //echo '==='.$biweek_no;
     //die;

     $var_replace = str_replace("/","_",$pdf);
     $ex = explode('uploads_',$var_replace);
     $pvar = substr($ex[1],0,21);
     $new_var = explode('sainik_samachar_',$pvar);
     $year = $new_var[1];
     $custom_year = substr($new_var[1],0,4);

     $combine_pdf_path = 'sainik_samachar_'.'edition_'.$biweek_no.'_'.$month.'_'.$custom_year.'.pdf';

     header("Content-type: application/pdf");
     header("Content-disposition: attachment; filename=$combine_pdf_path");
    
     readfile("$pdf");
    }

     public function circular_pdf(){
     $id = $this->uri->segment(2);
     $data = $this->home_model->circular_list_id($id);
     $pdf = $data[0]->path;

     header("Content-type: application/pdf");
      header("Content-disposition: attachment; filename=\"" . 
      basename($pdf) . "\""); 
     readfile("$pdf");
    }

    public function audio_file_download(){
     $id = $this->uri->segment(2);

     $data = $this->home_model->audio_list_id($id);
     $music = $data[0]->path_audio;


    header("Content-type: audio/mpeg3");
    header("Content-Transfer-Encoding: binary");
    header("Content-disposition: attachment; filename=$music");
    header("Content-disposition: attachment; filename=\"" . 
    basename($music) . "\"");    
    readfile("$music");
    }


    public function video_file_download(){
    $id = $this->uri->segment(2);
    $this->load->helper('download');
    $data = $this->home_model->video_list_id($id);
    $db_path = $data[0]->path_video;

    $video_path = base_url().$db_path;
    $pathparts  = pathinfo($video_path);
    $ext        = $pathparts['extension'];  
    $filename   = $pathparts['filename']; 
    $name_ext = $filename.'.'.$ext; 
    
    $data = file_get_contents($video_path); // Read the file's contents
    $name = $name_ext;

    force_download($name, $data);
    //readfile("$db_path");

    }



    public function image(){
     $id = $this->uri->segment(2);
     $this->load->library('image_lib');
     $this->load->helper('download');
    // $this->image_lib->watermark();
     $data = $this->home_model->image_list_id($id);
     $img_withoutbase = $data[0]->path_small;
    // echo $img_withoutbase;
    // die;
     $watermark2 = base_url().'assets-front/images/watermark.png';
     $photo_path = base_url().$img_withoutbase;
   //  echo $photo_path;
     $pathparts = pathinfo($photo_path);
     $ext=$pathparts['extension'];  
     $filename=$pathparts['filename'];  
     //echo $ext; die;
     $imgmain = 'logo.'.$ext;    


      $watermark = imagecreatefrompng($watermark2);
      //die;
      $wmsize = getimagesize($watermark2);
      // Get your source image
      if($ext=='png'){
         $image = imagecreatefrompng($img_withoutbase);
      }
      else{
      $image = imagecreatefromjpeg($img_withoutbase);
      }
      $size = getimagesize($img_withoutbase);
      // Set the watermark to be centered within the size of the destination image
      $dest_x = ($size[0] - $wmsize[0]) / 2;
      $dest_y = ($size[1] - $wmsize[1]) / 2;
      // Copy the watermark over the original image
      imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $wmsize[0], $wmsize[1]);
      // Use output buffering to capture the output to send to force_download
      ob_start(); //Stdout --> buffer
      imagejpeg($image); 
      $img2 = ob_get_contents(); //store stdout in $img2
      ob_end_clean(); //clear buffer
      imagedestroy($image);
      $image_name = $filename.".".$ext;

      force_download($image_name, $img2);

    }

     public function infographic_image(){
      //echo '=======';die();
      $id = $this->uri->segment(2);
     $this->load->helper('download');
    // $this->image_lib->watermark();
     $data = $this->home_model->infographic_image_list_id($id);
     $img = $data[0]->path_small;
     $watermark2 = base_url().'assets/img/watermark.png';
     //die;
     $photo_path = $img;

      // Get the watermark from a file
      $watermark = imagecreatefrompng($watermark2);
      //die;
      $wmsize = getimagesize($watermark2);
      // Get your source image
      $image = imagecreatefromjpeg($photo_path);
      $size = getimagesize($photo_path);
      // Set the watermark to be centered within the size of the destination image
      $dest_x = ($size[0] - $wmsize[0]) / 2;
      $dest_y = ($size[1] - $wmsize[1]) / 2;
      // Copy the watermark over the original image
      imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $wmsize[0], $wmsize[1]);
      // Use output buffering to capture the output to send to force_download
      ob_start(); //Stdout --> buffer
      imagejpeg($image); 
      $img2 = ob_get_contents(); //store stdout in $img2
      ob_end_clean(); //clear buffer
      imagedestroy($image);


      force_download($photo_path, $img2);

    }

     public function media_invite_detail(){

        /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

       $id = $this->uri->segment(2);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
       $data['invite'] = $this->home_model->invite($id,$lang_id); 

       $data['twitter_settings'] = $this->home_model->get_settings_twitter();
       $data['facebook_settings'] = $this->home_model->get_settings_facebook();
       $data['youtube_settings'] = $this->home_model->get_settings_youtube();
       $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

       $this->load->view('partials/_header', $data);;
       $this->load->view('invite', $data);
       $this->load->view('partials/_footer', $data);
    }




    public function press_release_details($id)
    {
         if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

       $data['press_release_details'] = $this->home_model->press_release_details($id,$lang_id);
       $data['press_release_photos'] = $this->home_model->press_release_photos($id,$lang_id);
       $data['press_release_infographic'] = $this->home_model->press_release_infographic($id,$lang_id);
       $data['press_release_video'] = $this->home_model->press_release_video($id,$lang_id);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);

       $data['twitter_settings'] = $this->home_model->get_settings_twitter();
       $data['facebook_settings'] = $this->home_model->get_settings_facebook();
       $data['youtube_settings'] = $this->home_model->get_settings_youtube();
       $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
 
       $this->load->view('partials/_header', $data);
       $this->load->view('press_release_details', $data);
       $this->load->view('partials/_footer', $data);
    }

    public function video_list()
    {   
             /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $video_category_id         = '';                  
        $video_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));

        $video_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'video_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_video_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'video_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->video_num_rows(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['video'] = $this->home_model->get_video_web(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['videos_categories'] = $this->home_model->video_albums(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('video', $data);
        $this->load->view('partials/_footer', $data);
    }

    public function video_list_ajax()
    { 

    if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        //$data['tran_lang'] = $array;
        /*tranlation*/  
    $offset = $this->input->post('page');
    $video_category_id = $this->input->post('video_category_id');
    $daterange = $this->input->post('daterange');
    $title = $this->input->post('title');
    $start = isset($offset) ? $offset:'1';

    date_default_timezone_set("Asia/Calcutta");
    $lang_id = $lang_id;
    $lang_id = isset($lang_id) ? $lang_id:'1';
    $daterange       = $this->input->post('daterange');
    if(!empty($daterange)){
    $daterange       = $this->input->post('daterange');

    }else{

    $daterange       = date('d/m/Y')."-".date('d/m/Y');
    }

    $var             = explode("-", $daterange);
    $date            = str_replace('/', '-', $var[0]);
    $date_1          = str_replace('/', '-', $var[1]);            
    $video_from_date           = date('Y-m-d', strtotime($date));
    $video_to_date             = date('Y-m-d', strtotime($date_1));

    $config['target']      = '#dataList'; 
    $config['base_url']    = base_url() . 'video_list';
    $config['per_page']    = 15;
    $config['page_no']    = (int)($start/15)+1;
    $limit = 15; 

    $config['total_rows']  = $this->home_model->video_num_rows(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title);

    $this->ajax_pagination->initialize($config);   
    $links = $this->ajax_pagination->create_links();

    $video = $this->home_model->get_video_web(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title
    );
  if($video){
    $i=1;
    foreach($video as $item)
    {
    $s = strtotime($item->created_at);
    $date_var = date('d/m/Y', $s);

    if(strlen($item->title)>46){
        $titleshort=truncate($item->title,70);
       }
       else{
        $titleshort=$item->title;
       }
                     
              

    echo '<div class="col-md-4 mt-3">
    <div class="card mb-2">
    <div class="column">
    <img src="'.base_url() . $item->path_image.'" style="width:100%" onclick="openModal();currentSlide('.$i.')" class="hover-shadow cursor margin_none card-img-top" alt="'.$item->title.'" title="'.$item->title.'">
      </div>
       <div class="row ml">
         <div class="col-md-12"><p class="line_text_2 card-text max_height42p min_height42p">'.$titleshort. /*''.$date_var.*/'</p></div> 
         </div> 

         <div class="share">
            <div class="row">
             
             <div class="col-md-2"></div>
             <div class="col-md-6">';
                if($item->link==1){            
            // echo '<a class="btn btn-success readmore float-right" href="'.base_url('video-list/').$item->id.'"><i class="fas fa-download"></i> Download</a>';             
              } else{ 
                //echo '<span class="btn btn-warning float-right" title="Youtube Videos can not be downloaded">Youtube Video</span>';
                }
              
        echo '</div>
          </div>
          </div>     

         </div>
         </div>
        
    </div>';

    $i++;
    }
    echo '<div class="col-md-12 pagination">'.$links.'</div>';
     echo '<div id="myModalgallery" class="modal modal_pic">   
      <div class="modal-content">';

$count2 = count($video);
  $k = 1;
     foreach($video as $item){   
      if($item->link == 2){

        echo '<div class="mySlides"><button type="button" class="close cursor" onclick="closeModal(); stopVideo(this.id,2);" id="'.$item->id.'" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="popup_close" id="audioModal'. $item->id.'">&times;</span></button><div class="numbertext">'.$k.'/ '.$count2.'</div><div class="min_height500p"><iframe width="100%" height="430" id="youtube'.$item->id.'" src="'.$item->youtube_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><p class="photo-title">'.$item->title.''.$date_var.'</p></p></div></div>';
      }else{
        echo '<div class="mySlides">
        <button type="button" class="close cursor" onclick="closeModal(); stopVideo(this.id,1);" id="'.$item->id.'" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="popup_close" id="audioModal'.$item->id.'">&times;
                    </span>

        </button>
      <div class="numbertext">'.$k.' /'.$count2.'</div>
      <div class="min_height500p">
      <video id ="videofile'.$item->id.'" width="100%" height="430" controls>
          <source id ="videoid'.$item->id.'" src="'.base_url().$item->path_video.'" type="video/mp4">   

        </video>
      <p class="photo-title">'.$item->title.''.$date_var.'</p>
      </div>
      </div>';
      }
      $k++;
    }
    
   }
   
}



    public function infographics_details($id)
    {  
          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       
         $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['infographics'] = $this->home_model->infographics_views($id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        $this->load->view('partials/_header', $data);
        $this->load->view('infographics-views', $data);
        $this->load->view('partials/_footer', $data);
    }

    public function previous_editions_list()
    {  

         /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       
       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'previous-editions'; 
        $config['total_rows']  = $this->home_model->get_paginated_sainik_samachar_count($lang_id);
        $offset = $this->input->post('page');
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'previous-editions';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 
       
        //$config['per_page']    = 15;
         $this->ajax_pagination->initialize($config); 
        $data["links"] = $this->ajax_pagination->create_links();
        $publish_status = 3;
        $pro_category         = '';                  
        $release_from_date           = date('Y');
        $release_to_date             = date('Y');
        $title     = '';
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['sainik_samachar'] = $this->home_model->sainik_samachar_list($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$publish_status); 

        $data['twitter_settings']      = $this->home_model->get_settings_twitter();
        $data['facebook_settings']     = $this->home_model->get_settings_facebook();
        $data['youtube_settings']      = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
         
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $this->load->view('partials/_header', $data);
        $this->load->view('previous_editions', $data);
        $this->load->view('partials/_footer', $data);
    }

    public function last_24_editions_list($lang_id2)
    {  
         /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation){
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       
       date_default_timezone_set("Asia/Calcutta");
        // $lang_id = $lang_id;
        // $lang_id = isset($lang_id) ? $lang_id:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'latest-sainik-samachars'.$lang_id2; 
        $config['total_rows']  = $this->home_model->get_paginated_last12months_sainik_samachar_count($lang_id2);
        $offset = $this->input->post('page');
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'latest-sainik-samachars'.$lang_id2;
        $config['per_page']    = 24;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 24; 
       
        //$config['per_page']    = 15;
         $this->ajax_pagination->initialize($config); 
        $data["links"] = $this->ajax_pagination->create_links();
        $publish_status = 3;
        $pro_category         = '';                  
        $release_from_date           = date('Y-m');
        $release_to_date             = date('Y');
        $title     = '';
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_last12_months($limit,$start,$lang_id2,$title,$publish_status); 
        $data['lang_breadcrumb'] = $this->home_model->get_lang_bradcrumb($lang_id2);

        //echo '<pre>';print_r($data['lang_breadcrumb']);
        //die;

        $data['twitter_settings']      = $this->home_model->get_settings_twitter();
        $data['facebook_settings']     = $this->home_model->get_settings_facebook();
        $data['youtube_settings']      = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
        
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
         
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $this->load->view('partials/_header', $data);
        $this->load->view('sainik_samachar_editions', $data);
        $this->load->view('partials/_footer', $data);
    }

    public function sainik_samachar_ajax()
    {


          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        //$data['tran_lang'] = $array;
        /*tranlation*/


         date_default_timezone_set("Asia/Calcutta");

         $t=time(); 
         $lang_id = $lang_id;
         $lang_id = isset($lang_id) ? $lang_id:'1';
         $offset  = $this->input->post('page');
         $start   = isset($offset) ? $offset:'1';
         $month   = $this->input->post('month');
         $edition  = $this->input->post('edition');
         $year       = $this->input->post('year');

         if(!empty($year)){
         $year       = $this->input->post('year');
         }else{
         $year       = date('Y',$t);
         }
      
         $config['target']      = '#dataList'; 
         $config['base_url']    = base_url() . 'previous-editions';
         $config['per_page']    = 15;
         $config['page_no']    = (int)($start/15)+1;
         $limit = 15; 
 
         $config['total_rows']  = $this->home_model->sainik_samachar_num_rows($lang_id,$limit,$start,$year,$month,$edition);
         
        
         $this->ajax_pagination->initialize($config);   
         $data['links'] = $this->ajax_pagination->create_links();
         $data['page_number']=$config['page_no'];
         $data['sainik_samachar'] = $this->home_model->get_sainik_samachar_ajax($lang_id,$limit,$start,$year,$month,$edition);
        
         $data['base_url'] = base_url().'latest-sainik-samachar/'.$data['sainik_samachar'][0]->id;
         $data['base_url_pdf'] = base_url().'latest-sainik-samachar-pdf/'.$data['sainik_samachar'][0]->id;
         //echo '<pre>';print_r($data['sainik_samachar']);
         echo json_encode($data);
        // echo '<pre>';print_r($press_release);
        // echo '====';die;
         //  $i=0;
         // foreach($press_release as $item)
         // {
         // $i++;
         // $s = strtotime($item->created_at);
         // $date_var = date('d/m/Y', $s);
 
         //  echo '<tr>
         //        <td class="left">'.$i.'</td>
         //        <td class="left">'.$item->name.'</td>
         //        <td class="left"><a href="'.base_url().$item->id.'">'.$item->press_release_title.'</a></td>     
         //        <td class="left">'.$date_var.'</td>     
         //       </tr>';
         // }
         // echo $links; 
 }
 


    public function press_realease_list()
    {  

      /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;

        if($this->uri->segment(2) > 0){
            $pro_category=$this->uri->segment(2);
        }
        else{
             $pro_category='';
        }
        /*tranlation*/
       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'press-realease-list'; 
        $config['total_rows']  = $this->home_model->get_paginated_press_release_count($lang_id,$pro_category);

       // echo $config['total_rows'];

        $offset = $this->input->post('page');
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'press-realease-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        //$config['per_page']    = 15;
        $this->ajax_pagination->initialize($config); 
        $data["links"] = $this->ajax_pagination->create_links();
        //$limit = 15;
        //$start = 1;
        $publish_status = 3;                     
        $release_from_date           = date('Y-m-d',(strtotime ( '-29 day' , strtotime (date('Y-m-d')) ) ));
        $release_to_date             = date('Y-m-d');
        $title     = '';
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['press_release'] = $this->home_model->press_release_list($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$publish_status);
        //echo '<pre>';print_r($data['press_release']);
        
         $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
         $data['pru_cate'] = $this->home_model->pru_cate($lang_id);

         $data['twitter_settings'] = $this->home_model->get_settings_twitter();
         $data['facebook_settings'] = $this->home_model->get_settings_facebook();
         $data['youtube_settings'] = $this->home_model->get_settings_youtube();
         $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
         $data['pages'] = $this->home_model->get_page_lang($lang_id);
          $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

         $this->load->view('partials/_header', $data);
         $this->load->view('press_release_list', $data);
         $this->load->view('partials/_footer', $data);
    }

    public function press_release_list_ajax()
   {    
      if($this->input->post('token_name') != $this->security->get_csrf_hash()){

         return false;
      }
     
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
      //  $data['tran_lang'] = $array;
        /*tranlation*/
        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $offset = $this->input->post('page');
        $press_release_category_id = $this->input->post('press_release_category_id');
        $daterange = $this->input->post('daterange');
        $title = $this->input->post('title');

        $start = isset($offset) ? $offset:'1';
        $daterange       = $this->input->post('daterange');
        if(!empty($daterange)){
        $daterange       = $this->input->post('daterange');

        }else{

        $daterange       = date('d/m/Y')."-".date('d/m/Y');
        }

        $var             = explode("-", $daterange);
        $date            = str_replace('/', '-', $var[0]);
        $date_1          = str_replace('/', '-', $var[1]);            
        $press_release_from_date           = date('Y-m-d', strtotime($date));
        $press_release_to_date             = date('Y-m-d', strtotime($date_1));

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'press-realease-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

         $config['total_rows']  = $this->home_model->press_release_num_rows($lang_id,$limit,$start,$press_release_category_id,$press_release_from_date,$press_release_to_date,$title);
         //print_r($config['total_rows']);
         //die();
       
   
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
        $data['page_number'] = $config['page_no'];
        $data['press_release'] = $this->home_model->get_press_release_web($lang_id,$limit,$start,$press_release_category_id,$press_release_from_date,$press_release_to_date,$title
        );
        //echo '<pre>';print_r($data['press_release']);die;
        echo json_encode($data);
      
}

    /**
     * Posts Page
     */
    public function posts()
    {
       
        //get_method();  

        get_method();
        $data['title'] = trans("posts");
        $data['description'] = trans("posts") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("posts") . "," . $this->settings->application_name;
        //set paginated
        $pagination = $this->paginate(generate_url('posts'), get_total_post_count());
        $data['user_session'] = get_user_session();
        $data['posts'] = get_cached_data('posts_page_' . $pagination['current_page']);
        if (empty($data['posts'])) {
            $data['posts'] = $this->post_model->get_paginated_posts($pagination['offset'], $pagination['per_page']);
            set_cache_data('posts_page_' . $pagination['current_page'], $data['posts']);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('post/posts', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Tag Page
     */
    public function tag($tag_slug)
    {
        get_method();
        $tag_slug = clean_slug($tag_slug);
        $data['tag'] = $this->tag_model->get_tag($tag_slug);
        //check tag exists
        if (empty($data['tag'])) {
            redirect(lang_base_url());
        }
        $data['title'] = $data['tag']->tag;
        $data['description'] = trans("tag") . ': ' . $data['tag']->tag;
        $data['keywords'] = trans("tag") . ', ' . $data['tag']->tag;
        //set paginated
        $pagination = $this->paginate(generate_tag_url($tag_slug), $this->post_model->get_post_count_by_tag($tag_slug));
        $data['posts'] = $this->post_model->get_paginated_tag_posts($tag_slug, $pagination['offset'], $pagination['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('tag', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Dynamic URL by Slug
     */
    public function any($slug)
    {
    
        if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;

        get_method();
        $slug = clean_slug($slug);
        if (empty($slug)) {

            redirect(lang_base_url());
        }

        //check pages
        $page = $this->page_model->get_page_by_lang($slug, $lang_id);
        if (!empty($page)) {
            //echo '=======';die;
            $this->page($page);
        } else {
           // echo '======='.$slug;die;
            $category = $this->category_model->get_category_by_slug($slug);

            if (!empty($category)){

                if (function_exists('get_site_mod')) {
                    get_site_mod();
                }
                $this->category($category);
            } else {
                //check posts
                $post = $this->post_model->get_post($slug);
                if (!empty($post)) {
                    $this->post($post);
                } else {
                    //not found
                    $this->error_404();
                }
            }
        }
    }

    /**
     * Page
     */
    private function page($page)
    {
       
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;


        if (empty($page)) {
            redirect(lang_base_url());
        }
        if ($page->visibility == 0) {
            $this->error_404();
        } else {
          
            $this->checkPageAuth($page);

            $data['title'] = $page->title;
            $data['description'] = $page->description;
            $data['keywords'] = $page->keywords;
            $data['page'] = $page;
            if ($page->page_default_name == 'gallery') {
                    $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                    $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                    $data['gallery_albums'] = $this->gallery_category_model->get_albums_by_lang($lang_id);
                    $data['pages'] = $this->home_model->get_page_lang($lang_id);
                    $data['twitter_settings'] = $this->home_model->get_settings_twitter();
                    $data['facebook_settings'] = $this->home_model->get_settings_facebook();
                    $data['youtube_settings'] = $this->home_model->get_settings_youtube();
                    $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
                     $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                $this->load->view('partials/_header', $data);
                $this->load->view('gallery/gallery', $data);
                $this->load->view('partials/_footer',$data);
            } elseif ($page->page_default_name == 'contact'){
                $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                $data['pages'] = $this->home_model->get_page_lang($lang_id);

                $data['twitter_settings'] = $this->home_model->get_settings_twitter();
                $data['facebook_settings'] = $this->home_model->get_settings_facebook();
                $data['youtube_settings'] = $this->home_model->get_settings_youtube();
                $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
                 $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                $this->load->view('partials/_header', $data);
                $this->load->view('contact', $data);
                $this->load->view('partials/_footer',$data);
            } else {

                    $data['twitter_settings'] = $this->home_model->get_settings_twitter();
                    $data['facebook_settings'] = $this->home_model->get_settings_facebook();
                    $data['youtube_settings'] = $this->home_model->get_settings_youtube();
                    $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
                    $data['pages'] = $this->home_model->get_page_lang($lang_id);
                    $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                    $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                    $data['pages'] = $this->home_model->get_page_lang($lang_id);
                     $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                 $this->load->view('partials/_header', $data);
                 $this->load->view('page', $data);
                 $this->load->view('partials/_footer',$data);
            }
        }
    }

    /**
     * Category
     */
    private function category($category)
    {
        if (empty($category)) {
            redirect(lang_base_url());
        }
        if ($category->parent_id != 0) {
            $this->error_404();
        } else {
            $data['title'] = $category->name;
            $data['description'] = $category->description;
            $data['keywords'] = $category->keywords;
            $data['category'] = $category;

            $count_key = 'posts_count_category' . $category->id;
            $posts_key = 'posts_category' . $category->id;
            //category posts count
            $total_rows = get_cached_data($count_key);
            if (empty($total_rows)) {
                $total_rows = $this->post_model->get_post_count_by_category($category->id);
                set_cache_data($count_key, $total_rows);
            }
            //set paginated
            $pagination = $this->paginate(generate_category_url($category), $total_rows);
            $data['posts'] = get_cached_data($posts_key . '_page' . $pagination['current_page']);
            if (empty($data['posts'])) {
                $data['posts'] = $this->post_model->get_paginated_category_posts($category->id, $pagination['offset'], $pagination['per_page']);
                set_cache_data($posts_key . '_page' . $pagination['current_page'], $data['posts']);
            }

            $data['twitter_settings'] = $this->home_model->get_settings_twitter();
            $data['facebook_settings'] = $this->home_model->get_settings_facebook();
            $data['youtube_settings'] = $this->home_model->get_settings_youtube();
            $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
             $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

            $this->load->view('partials/_header', $data);
            $this->load->view('category', $data);
            $this->load->view('partials/_footer');
        }
    }

    /**
     * Subcategory
     */
    public function subcategory($parent_slug, $slug)
    {
        get_method();
        $slug = clean_slug($slug);
        $category = $this->category_model->get_category_by_slug($slug);
        if (empty($category)) {
            redirect(lang_base_url());
        } else {
            $data['title'] = $category->name;
            $data['description'] = $category->description;
            $data['keywords'] = $category->keywords;
            $data['category'] = $category;

            $count_key = 'posts_count_category' . $category->id;
            $posts_key = 'posts_category' . $category->id;
            //category posts count
            $total_rows = get_cached_data($count_key);
            if (empty($total_rows)) {
                $total_rows = $this->post_model->get_post_count_by_category($category->id);
                set_cache_data($count_key, $total_rows);
            }
            //set paginated
            $pagination = $this->paginate(generate_category_url($category), $total_rows);
            $data['posts'] = get_cached_data($posts_key . '_page' . $pagination['current_page']);
            if (empty($data['posts'])) {
                $data['posts'] = $this->post_model->get_paginated_category_posts($category->id, $pagination['offset'], $pagination['per_page']);
                set_cache_data($posts_key . '_page' . $pagination['current_page'], $data['posts']);
            }

            $data['twitter_settings'] = $this->home_model->get_settings_twitter();
            $data['facebook_settings'] = $this->home_model->get_settings_facebook();
            $data['youtube_settings'] = $this->home_model->get_settings_youtube();
            $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
             $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

            $this->load->view('partials/_header', $data);
            $this->load->view('category', $data);
            $this->load->view('partials/_footer');
        }
    }

    /**
     * Post
     */
    private function post($post)
    {
        if (empty($post)) {
            redirect(lang_base_url());
        }
        //check post auth
        if (!$this->auth_check && $post->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_post_auth"));
            redirect(generate_url('register'));
        }

        $data['post'] = $post;
        $data['post_user'] = $this->auth_model->get_user($post->user_id);
        $data['post_tags'] = $this->tag_model->get_post_tags($post->id);
        $data['post_images'] = $this->post_file_model->get_post_additional_images($post->id);

        $data['comments'] = $this->comment_model->get_comments($post->id, $this->comment_limit);
        $data['comment_limit'] = $this->comment_limit;
        $data['related_posts'] = $this->post_model->get_related_posts($post->category_id, $post->id);
        $data['previous_post'] = $this->post_model->get_previous_post($post->id);
        $data['next_post'] = $this->post_model->get_next_post($post->id);

        $data['is_reading_list'] = $this->reading_list_model->is_post_in_reading_list($post->id);

        $data['post_type'] = $post->post_type;

        if (!empty($post->feed_id)) {
            $data['feed'] = $this->rss_model->get_feed($post->feed_id);
        }

        $data = $this->set_post_meta_tags($post, $data['post_tags'], $data);

        $this->reaction_model->set_voted_reactions_session($post->id);
        $data["reactions"] = $this->reaction_model->get_reaction($post->id);

        //gallery post
        if ($post->post_type == "gallery") {
            $data['gallery_post_total_item_count'] = $this->post_item_model->get_post_list_items_count($post->id, $post->post_type);
            $data['gallery_post_item'] = $this->post_item_model->get_gallery_post_item_by_order($post->id, 1);
            $data['gallery_post_item_order'] = 1;
        }
        //sorted list post
        if ($post->post_type == "sorted_list") {
            $data['sorted_list_items'] = $this->post_item_model->get_post_list_items($post->id, $post->post_type);
        }

        //quiz
        if ($post->post_type == "trivia_quiz" || $post->post_type == "personality_quiz") {
            $data['quiz_questions'] = $this->quiz_model->get_quiz_questions($post->id);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('post/post', $data);
        $this->load->view('partials/_footer', $data);

        //increase pageviews count
        $this->post_model->increase_post_pageviews($post);
    }

    /**
     * Gallery Post Page
     */
    public function gallery_post($slug, $item_order)
    {
        get_method();
        $slug = clean_slug($slug);
        $item_order = clean_number($item_order);
        $post = $this->post_model->get_post($slug);
        //check if post exists
        if (empty($post)) {
            redirect($this->agent->referrer());
        }
        //check post auth
        if (!$this->auth_check && $post->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_post_auth"));
            redirect(generate_url('register'));
        }
        $data['post'] = $post;
        $data['post_user'] = $this->auth_model->get_user($post->user_id);
        $data['post_tags'] = $this->tag_model->get_post_tags($post->id);
        $data['post_images'] = $this->post_file_model->get_post_additional_images($post->id);
        $data['comments'] = $this->comment_model->get_comments($post->id, $this->comment_limit);
        $data['comment_count'] = $this->comment_model->get_comment_count_by_post_id($post->id);
        $data['comment_limit'] = $this->comment_limit;

        $data['related_posts'] = $this->post_model->get_related_posts($post->category_id, $post->id);
        $data['previous_post'] = $this->post_model->get_previous_post($post->id);
        $data['next_post'] = $this->post_model->get_next_post($post->id);

        $data['is_reading_list'] = $this->reading_list_model->is_post_in_reading_list($post->id);

        $data['post_type'] = $post->post_type;

        if (!empty($post->feed_id)) {
            $data['feed'] = $this->rss_model->get_feed($post->feed_id);
        }

        $data = $this->set_post_meta_tags($post, $data['post_tags'], $data);

        $this->reaction_model->set_voted_reactions_session($post->id);
        $data["reactions"] = $this->reaction_model->get_reaction($post->id);

        //gallery post item
        $data['gallery_post_total_item_count'] = $this->post_item_model->get_post_list_items_count($post->id, $post->post_type);
        $data['gallery_post_item'] = $this->post_item_model->get_gallery_post_item_by_order($post->id, $item_order);

        if ($item_order <= 0) {
            redirect(generate_post_url($post) . "/1");
        }
        if ($item_order > $data['gallery_post_total_item_count']) {
            redirect(generate_post_url($post) . "/" . $data['gallery_post_total_item_count']);
        }
        $data['gallery_post_item_order'] = $item_order;

        $this->load->view('partials/_header', $data);
        $this->load->view('post/post', $data);
        $this->load->view('partials/_footer', $data);
    }

    /**
     * Preview
     */
    public function preview($slug)
    {
        get_method();

        if (!auth_check()) {
            redirect(lang_base_url());
            exit();
        }
        $slug = clean_slug($slug);
        if (empty($slug)) {
            redirect(lang_base_url());
            exit();
        }
        //check posts
        $post = $this->post_model->get_post_preview($slug);
        if (!empty($post)) {
            if (!check_post_ownership($this->auth_user->id)) {
                redirect(lang_base_url());
                exit();
            }
            $this->post($post);
        } else {
            //not found
            $this->error_404();
        }
    }

    //set post meta tags
    private function set_post_meta_tags($post, $post_tags, $data)
    {
        $data['title'] = $post->title;
        $data['description'] = $post->summary;
        $data['keywords'] = $post->keywords;

        $data['og_title'] = $post->title;
        $data['og_description'] = $post->summary;
        $data['og_type'] = "article";
        $data['og_url'] = generate_post_url($post);
        $data['og_image'] = base_url() . $post->image_big;
        if (!empty($post->image_url)) {
            $data['og_image'] = $post->image_url;
        }
        $data['og_width'] = "750";
        $data['og_height'] = "422";
        $data['og_creator'] = $post->author_username;
        $data['og_author'] = $post->author_username;
        $data['og_published_time'] = $post->created_at;
        $data['og_modified_time'] = $post->updated_at;
        if (empty($post->updated_at)) {
            $data['og_modified_time'] = $post->created_at;
        }
        $data['og_tags'] = $post_tags;
        return $data;
    }

    /**
     * Gallery Album Page
     */
    public function gallery_album($id)
    {
        get_method();
        $id = clean_number($id);
        $data['page'] = $this->page_model->get_page_by_default_name('gallery', $this->selected_lang->id);
        //check page exists
        if (empty($data['page'])) {
            redirect(lang_base_url());
        }
        //check page auth
        $this->checkPageAuth($data['page']);
        if ($data['page']->visibility == 0) {
            $this->error_404();
        } else {
            $data['title'] = get_page_title($data['page']);
            $data['description'] = get_page_description($data['page']);
            $data['keywords'] = get_page_keywords($data['page']);
            //get album
            $data['album'] = $this->gallery_category_model->get_album($id);
            if (empty($data['album'])) {
                redirect($this->agent->referrer());
            }
            //get gallery images
            $data['gallery_images'] = $this->gallery_model->get_images_by_album($data['album']->id);
            $data['gallery_categories'] = $this->gallery_category_model->get_categories_by_album($data['album']->id);

            $this->load->view('partials/_header', $data);
            $this->load->view('gallery/gallery_album', $data);
            $this->load->view('partials/_footer');
        }
    }

    /**
     * Contact Page Post
     */
    public function contact_post()
    {
        post_method();
        //validate inputs
        $this->form_validation->set_rules('name', trans("placeholder_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('email', trans("placeholder_email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('message', trans("placeholder_message"), 'required|xss_clean|max_length[5000]');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->contact_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if (!$this->recaptcha_verify_request()) {
                $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                $this->session->set_flashdata('error', trans("msg_recaptcha"));
                redirect($this->agent->referrer());
            } else {
                if ($this->contact_model->add_contact_message()) {
                    $this->session->set_flashdata('success', trans("message_contact_success"));
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                    $this->session->set_flashdata('error', trans("message_contact_error"));
                    redirect($this->agent->referrer());
                }
            }
        }
    }

    /**
     * Search Page
     */
    public function search()
    {
        get_method();
        $q = trim($this->input->get('q', true));
        if (empty($q)) {
            return redirect(lang_base_url());
        }
        $q = remove_forbidden_characters($q);
        $q = strip_tags($q);

        $data["q"] = $q;
        $data['title'] = trans("search") . ': ' . $q;
        $data['description'] = trans("search") . ': ' . $q;
        $data['keywords'] = trans("search") . ', ' . $q;
        //set paginated
        $pagination = $this->paginate(generate_url('search'), $this->post_model->get_search_post_count($q));
        $data['posts'] = $this->post_model->get_paginated_search_posts($q, $pagination['offset'], $pagination['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('search', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Rss Page
     */
    public function rss_feeds()
    {
        get_method();
        if ($this->general_settings->show_rss == 0) {
            $this->error_404();
        } else {
            $data['title'] = trans("rss_feeds");
            $data['description'] = trans("rss_feeds") . " - " . $this->settings->site_title;
            $data['keywords'] = trans("rss_feeds") . "," . $this->settings->application_name;
            $data['user_session'] = get_user_session();
            $this->load->view('partials/_header', $data);
            $this->load->view('rss/rss_feeds', $data);
            $this->load->view('partials/_footer');

        }
    }

    /**
     * Rss All Posts
     */
    public function rss_latest_posts()
    {
        get_method();
        //load the library
        $this->load->helper('xml');
        if ($this->general_settings->show_rss == 1):
            $data['feed_name'] = $this->settings->site_title . " - " . trans("latest_posts");
            $data['encoding'] = 'utf-8';
            $data['feed_url'] = lang_base_url() . "rss/latest-posts";
            $data['page_description'] = $this->settings->site_title . " - " . trans("latest_posts");
            $data['page_language'] = $this->selected_lang->short_form;
            $data['creator_email'] = '';
            $data['posts'] = $this->post_model->get_latest_posts($this->selected_lang->id, 30);
            header("Content-Type: application/rss+xml; charset=utf-8");
            $this->load->view('rss/rss', $data);
        endif;
    }

    /**
     * Rss By Category
     */
    public function rss_by_category($slug)
    {
        get_method();
        $slug = clean_slug($slug);
        //load the library
        $this->load->helper('xml');
        if ($this->general_settings->show_rss == 1):
            $data['category'] = $this->category_model->get_category_by_slug($slug);
            if (empty($data['category'])) {
                redirect(generate_url('rss_feeds'));
            }
            $data['feed_name'] = $this->settings->site_title . " - " . trans("title_category") . ": " . $data['category']->name;
            $data['encoding'] = 'utf-8';
            $data['feed_url'] = lang_base_url() . "rss/category/" . $data['category']->name_slug;
            $data['page_description'] = $this->settings->site_title . " - " . trans("title_category") . ": " . $data['category']->name;
            $data['page_language'] = $this->selected_lang->short_form;
            $data['creator_email'] = '';
            $data['posts'] = $this->post_model->get_category_posts($data['category']->id, 1000);
            header("Content-Type: application/rss+xml; charset=utf-8");
            $this->load->view('rss/rss', $data);
        endif;
    }

    /**
     * Rss By User
     */
    public function rss_by_user($slug)
    {
        get_method();
        $slug = clean_slug($slug);
        //load the library
        $this->load->helper('xml');
        if ($this->general_settings->show_rss == 1):
            $user = $this->auth_model->get_user_by_slug($slug);
            if (empty($user)) {
                redirect(generate_url('rss_feeds'));
            }
            $user_id = $user->id;
            $data['feed_name'] = $this->settings->site_title . " - " . $user->username;
            $data['encoding'] = 'utf-8';
            $data['feed_url'] = lang_base_url() . "rss/author/" . $user->slug;
            $data['page_description'] = $this->settings->site_title . " - " . $user->username;
            $data['page_language'] = $this->selected_lang->short_form;
            $data['creator_email'] = '';
            $data['posts'] = $this->post_model->get_user_posts($user_id, 1000);
            header("Content-Type: application/rss+xml; charset=utf-8");
            $this->load->view('rss/rss', $data);
        endif;
    }

    /**
     * Add Comment
     */
    public function add_comment_post()
    {
        post_method();
        if ($this->general_settings->comment_system != 1) {
            exit();
        }
        $limit = clean_number($this->input->post('limit', true));
        $post_id = clean_number($this->input->post('post_id', true));
        if ($this->auth_check) {
            $this->comment_model->add_comment();
        } else {
            if ($this->recaptcha_verify_request()) {
                $this->comment_model->add_comment();
            }
        }
        if ($this->general_settings->comment_approval_system == 1 && !check_user_permission('comments_contact')) {
            $data = array(
                'type' => 'message',
                'message' => "<p class='comment-success-message'><i class='icon-check'></i>&nbsp;&nbsp;" . trans("msg_comment_sent_successfully") . "</p>"
            );
            echo json_encode($data);
        } else {
            $data["post"] = $this->post_model->get_post_by_id($post_id);
            $data['comments'] = $this->comment_model->get_comments($post_id, $limit);
            $data['comment_count'] = $this->comment_model->get_comment_count_by_post_id($post_id);
            $data['comment_limit'] = $limit;

            $data_json = array(
                'type' => 'comments',
                'message' => $this->load->view('post/_comments', $data, true)
            );
            echo json_encode($data_json);
        }
    }

    //delete comment
    public function delete_comment_post()
    {
        post_method();
        $id = clean_number($this->input->post('id', true));
        $post_id = clean_number($this->input->post('post_id', true));
        $limit = clean_number($this->input->post('limit', true));

        $comment = $this->comment_model->get_comment($id);
        if ($this->auth_check && !empty($comment)) {
            if ($this->auth_user->role == "admin" || $this->auth_user->id == $comment->user_id) {
                $this->comment_model->delete_comment($id);
            }
        }

        $data["post"] = $this->post_model->get_post_by_id($post_id);
        $data['comments'] = $this->comment_model->get_comments($post_id, $limit);
        $data['comment_count'] = $this->comment_model->get_comment_count_by_post_id($post_id);
        $data['comment_limit'] = $limit;

        $data_json = array(
            'result' => 1,
            'html_content' => $this->load->view('post/_comments', $data, true)
        );
        echo json_encode($data_json);
    }

    //load subcomment box
    public function load_subcomment_box()
    {
        post_method();
        $comment_id = clean_number($this->input->post('comment_id', true));
        $limit = clean_number($this->input->post('limit', true));
        $data["parent_comment"] = $this->comment_model->get_comment($comment_id);
        $data["comment_limit"] = $limit;
        $this->load->view('post/_make_subcomment', $data);
    }

    //load more comment
    public function load_more_comment()
    {
        post_method();
        $post_id = clean_number($this->input->post('post_id', true));
        $limit = clean_number($this->input->post('limit', true));
        $new_limit = $limit + $this->comment_limit;

        $data["post"] = $this->post_model->get_post_by_id($post_id);
        $data['comments'] = $this->comment_model->get_comments($post_id, $new_limit);
        $data['comment_count'] = $this->comment_model->get_comment_count_by_post_id($post_id);
        $data['comment_limit'] = $new_limit;

        $data_json = array(
            'result' => 1,
            'html_content' => $this->load->view('post/_comments', $data, true)
        );
        echo json_encode($data_json);
    }

    /**
     * Like Comment
     */
    public function like_comment_post()
    {
        post_method();
        $comment_id = clean_number($this->input->post('comment_id', true));
        $like_count = $this->comment_model->like_comment($comment_id);
        $data = array(
            'result' => 1,
            'like_count' => $like_count
        );
        echo json_encode($data);
    }

    /**
     * Add Poll Vote
     */
    public function add_vote()
    {
        post_method();
        $poll_id = clean_number($this->input->post('poll_id', true));
        $vote_permission = clean_number($this->input->post('vote_permission', true));
        $option = $this->input->post('option', true);
        if (is_null($option)) {
            echo "required";
        } else {
            if ($vote_permission == "all") {
                $result = $this->poll_model->add_unregistered_vote($poll_id, $option);
                if ($result == "success") {
                    $data["poll"] = $this->poll_model->get_poll($poll_id);
                    $this->load->view('partials/_poll_results', $data);
                } else {
                    echo "voted";
                }
            } else {
                $user_id = user()->id;
                $result = $this->poll_model->add_registered_vote($poll_id, $user_id, $option);
                if ($result == "success") {
                    $data["poll"] = $this->poll_model->get_poll($poll_id);
                    $this->load->view('partials/_poll_results', $data);
                } else {
                    echo "voted";
                }
            }
        }
    }

    /**
     * Add to Newsletter
     */
    public function add_to_newsletter()
    {
        post_method();
        //input values
        $email = clean_str($this->input->post('email', true));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('news_error', trans("message_invalid_email"));
        } else {
            if ($email) {
                //check if email exists
                if (empty($this->newsletter_model->get_subscriber($email))) {
                    //addd
                    if ($this->newsletter_model->add_subscriber($email)) {
                        $this->session->set_flashdata('news_success', trans("message_newsletter_success"));
                    }
                } else {
                    $this->session->set_flashdata('news_error', trans("message_newsletter_error"));
                }
            }
        }
        redirect($this->agent->referrer() . "#newsletter");
    }

    /**
     * Reading List Page
     */
    public function reading_list()
    {
        get_method();
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("reading_list");
        $data['description'] = trans("reading_list") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("reading_list") . "," . $this->settings->application_name;

        //set paginated
        $pagination = $this->paginate(generate_url('reading_list'), $this->reading_list_model->get_reading_list_posts_count());
        $data['posts'] = $this->reading_list_model->get_paginated_reading_list_posts($pagination['offset'], $pagination['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('reading_list', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Load More Posts
     */
    public function load_more_posts()
    {
        post_method();
        $lang_id = clean_number($this->input->post("load_more_posts_lang_id", true));
        $last_id = clean_number($this->input->post("load_more_posts_last_id", true));

        //set language
        if ($this->general_settings->site_lang != $lang_id) {
            $lang = $this->language_model->get_language($lang_id);
            if (!empty($lang)) {
                $this->lang_base_url = base_url() . $lang->short_form . "/";
            }
        }

        $latest_posts = load_more_posts($lang_id, $last_id, $this->post_load_more_count);
        if (!empty($latest_posts)) {
            $html_content = "";
            $hide_button = false;
            foreach ($latest_posts as $post) {
                $vars = array('post' => $post, 'show_label' => true);
                $html_content .= $this->load->view("post/_post_item_horizontal", $vars, true);
                $last_id = $post->id;
            }
            if (empty($this->post_model->load_more_posts($lang_id, $last_id, $this->post_load_more_count))) {
                $hide_button = true;
            }
            $data = array(
                'result' => 1,
                'html_content' => $html_content,
                'last_id' => $last_id,
                'hide_button' => $hide_button
            );
            echo json_encode($data);
        } else {
            $data = array(
                'result' => 0,
            );
            echo json_encode($data);
        }
    }

    /**
     * Make Reaction
     */
    public function save_reaction()
    {
        post_method();
        $post_id = clean_number($this->input->post('post_id'));
        $reaction = clean_str($this->input->post('reaction'));

        $data["post"] = $this->post_admin_model->get_post($post_id);
        if (!empty($data["post"])) {
            $this->reaction_model->save_reaction($post_id, $reaction);
        }
        $data["reactions"] = $this->reaction_model->get_reaction($post_id);
        $this->load->view('partials/_emoji_reactions', $data);
    }

    //download post file
    public function download_post_file()
    {
        post_method();
        $id = $this->input->post('file_id', true);
        $file = $this->file_model->get_file($id);
        if (!empty($file)) {
            $this->load->helper('download');
            force_download(FCPATH . $file->file_path, NULL);
        }
        redirect($this->agent->referrer());
    }

    //download audio
    public function download_audio()
    {
        post_method();
        $id = $this->input->post('id', true);
        $audio = $this->file_model->get_audio($id);
        if (!empty($audio)) {
            $this->load->helper('download');
            force_download(FCPATH . $audio->audio_path, NULL);
        }
        redirect($this->agent->referrer());
    }

    //cookies warning
    public function cookies_warning()
    {
        helper_setcookie('cookies_warning', 1);
    }

    //check page auth
    private function checkPageAuth($page)
    {
        if (!auth_check() && $page->need_auth == 1) {
            $this->session->set_flashdata('error', trans("message_page_auth"));
            redirect(generate_url('register'));
        }
    }

    //error 404
    public function error_404()
    {
        get_method();
        header("HTTP/1.0 404 Not Found");
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";

        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }


    public function photo_list_ajax()
    { 

      /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
       // $data['tran_lang'] = $array;
        /*tranlation*/ 

    $offset = $this->input->post('page');
    $photo_category_id = $this->input->post('photo_category_id');
    $daterange = $this->input->post('daterange');
    $title = $this->input->post('title');
    $start = isset($offset) ? $offset:'1';

    date_default_timezone_set("Asia/Calcutta");
    $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
    $daterange       = $this->input->post('daterange');
    if(!empty($daterange)){
    $daterange       = $this->input->post('daterange');

    }else{

    $daterange       = date('d/m/Y')."-".date('d/m/Y');
    }

    $var             = explode("-", $daterange);
    $date            = str_replace('/', '-', $var[0]);
    $date_1          = str_replace('/', '-', $var[1]);            
    $photo_from_date           = date('Y-m-d', strtotime($date));
    $photo_to_date             = date('Y-m-d', strtotime($date_1));

    $config['target']      = '#dataList'; 
    $config['base_url']    = base_url() . 'photo_list';
    $config['per_page']    = 15;
    $config['page_no']    = (int)($start/15)+1;
    $limit = 15; 

     $config['total_rows']  = $this->home_model->photo_num_rows(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title);
   
    $this->ajax_pagination->initialize($config);   
    $links = $this->ajax_pagination->create_links();

    $photo = $this->home_model->get_photo_web(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title
    );
   // echo '<pre>';print_r($photo);
   // die;
   // echo '===='.$links;die;
    $count = count($photo);
  if(!empty($photo)){
    $i =1;
    $j =1;
    foreach($photo as $item)
    {
    $s = strtotime($item->created_at);
    if(strlen($item->title)>46){
        $titleshort=truncate($item->title,70);
       }
       else{
        $titleshort=$item->title;
       }
    $date_var = date('d/m/Y', $s);

     echo '<div class="col-md-4 mt-3">
                  <div class="card mb-2">
                  <div class="column">
                  <img src="'.base_url() . $item->path_small.'" style="width:100%" onclick="openModal();currentSlide('.$i.')" title="'.$item->title.'" alt="'.$item->title.'" class="hover-shadow cursor margin_none" />
                  </div>
                  <div class="row ml">
                  <div class="col-md-12"><p class="line_text_2 card-text max_height42p min_height42p">'.$titleshort.'</p>
                  </div>
                  </div>
                  
                  
                  </div> 
                  </div>
                  </div>';
        $i++;
        }
        echo '<div class="col-md-12 pagination">'.$links.'</div>';

        echo ' <div id="myModalgallery" class="modal modal_pic">
                  <span class="close cursor" onclick="closeModal()">&times;</span>
                  <div class="modal-content photo_list">';
         foreach($photo as $item)
    {
      
    $s = strtotime($item->created_at);
    $date_var = date('d/m/Y', $s);
       

                 echo '<div class="mySlides">
                  <div class="numbertext">'.$j.' / '.$count.'</div>
                  <img src="'.base_url() .$item->path_big.'" class="max_height650p min_height650p" title="'.$item->title.'" alt="'.$item->content.'" style="width:100%" alt="">
                  <p class="photo-title">'.$item->title.'","'.$date_var.'</p>
                  </div>
                  <a class="prev1" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next1" onclick="plusSlides(1)">&#10095;</a>';

                  

                $j++;
        }

        echo '

                  <div class="caption-container">
                  <p id="caption"></p>
                  </div>  
                  </div>
                  </div>';
       
      }
           
}
     public function photo_list()
    {  

       /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
      date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $photo_category_id         = '';                  
        $photo_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));
        $photo_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'photo_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_gallery_count_two();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'photo_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->photo_num_rows(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['photo'] = $this->home_model->get_photo_web(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['photo_categories'] = $this->home_model->photo_categories(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        // echo '<pre>';print_r($data['photo'] );
        // die;
        $this->load->view('partials/_header', $data);
        $this->load->view('photo', $data);
        $this->load->view('partials/_footer', $data);
    }


    public function infographics_list()
    {  

         /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/


       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $infographic_category_id         = '';                  
        $infographic_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));
        $infographic_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'infographic_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_infographic_count_two();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'infographic_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->infographic_num_rows(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['infographic'] = $this->home_model->get_infographic_web(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['infographic_categories'] = $this->home_model->infographic_categories(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('infographics', $data);
        $this->load->view('partials/_footer', $data);
    }

    public function infographic_list_ajax()
    {

      if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
       // $data['tran_lang'] = $array;

    $offset = $this->input->post('page');
    $infographic_category_id = $this->input->post('infographic_category_id');
    $daterange = $this->input->post('daterange');
    $title = $this->input->post('title');
    $start = isset($offset) ? $offset:'1';

    date_default_timezone_set("Asia/Calcutta");
    $lang_id = $lang_id;
    $lang_id = isset($lang_id) ? $lang_id:'1';
    $daterange       = $this->input->post('daterange');
    if(!empty($daterange)){
    $daterange       = $this->input->post('daterange');

    }else{

    $daterange       = date('d/m/Y')."-".date('d/m/Y');
    }

    $var             = explode("-", $daterange);
    $date            = str_replace('/', '-', $var[0]);
    $date_1          = str_replace('/', '-', $var[1]);            
    $infographic_from_date           = date('Y-m-d', strtotime($date));
    $infographic_to_date             = date('Y-m-d', strtotime($date_1));

    $config['target']      = '#dataList'; 
    $config['base_url']    = base_url() . 'infographic_list';
    $config['per_page']    = 15;
    $config['page_no']    = (int)($start/15)+1;
    $limit = 15; 

     $config['total_rows']  = $this->home_model->infographic_num_rows(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title);
   
    $this->ajax_pagination->initialize($config);   
    $links = $this->ajax_pagination->create_links();

    $infographic = $this->home_model->get_infographic_web(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title
    );
    //echo '<pre>';print_r($infographic);
    //echo '===='.$links;die;

    foreach($infographic as $item)
    {
    $s = strtotime($item->created_at);
    $date_var = date('d/m/Y', $s);

     echo '<div class="col-md-4">
                  <div class="card mb-2">
                  <div class="column">
                  <a href="'.base_url('infographics-list/').$item->id.'">
                  <img src="'.base_url() . $item->path_small.'" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor" /></a> 
                  </div>
                  <div class="row ml">
                  <div class="col-md-12"><p class="card-text">'.$item->title.'</p>
                  </div>
                  </div>
                 
                  </div>
                  </div>';
        }
       echo '<div class="col-md-12 pagination">'.$links.'</div>'; 
    }

    public function audio_list()
    {  

            /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $audio_category_id         = '';                  
        $audio_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));
        $audio_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'audio_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_gallery_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'audio_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->audio_num_rows(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title);
       //echo '====ww';die();
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        //$data['menu_links'] = $this->navigation_model->get_menu_links(1);
        $data['audio'] = $this->home_model->get_audio_web(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title);
        //echo '<pre>';print_r( $data['audio']);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['audio_categories'] = $this->gallery_category_model->get_audio_albums(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('radio-programs', $data);
        $this->load->view('partials/_footer', $data);
      
    }

    public function audio_list_ajax()
    {   

    if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        //$data['tran_lang'] = $array;

    $offset = $this->input->post('page');
    $audio_category_id = $this->input->post('audio_category_id');
    $daterange = $this->input->post('daterange');
    $title = $this->input->post('title');
    $start = isset($offset) ? $offset:'1';

    date_default_timezone_set("Asia/Calcutta");
    $lang_id = $lang_id;
    $lang_id = isset($lang_id) ? $lang_id:'1';
    $daterange       = $this->input->post('daterange');
    if(!empty($daterange)){
    $daterange       = $this->input->post('daterange');

    }else{

    $daterange       = date('d/m/Y')."-".date('d/m/Y');
    }

    $var             = explode("-", $daterange);
    $date            = str_replace('/', '-', $var[0]);
    $date_1          = str_replace('/', '-', $var[1]);            
    $audio_from_date           = date('Y-m-d', strtotime($date));
    $audio_to_date             = date('Y-m-d', strtotime($date_1));

    $config['target']      = '#dataList'; 
    $config['base_url']    = base_url() . 'audio_list';
    $config['per_page']    = 15;
    $config['page_no']    = (int)($start/15)+1;
    $limit = 15; 

     $config['total_rows']  = $this->home_model->audio_num_rows(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title);
   
    $this->ajax_pagination->initialize($config);   
    $links = $this->ajax_pagination->create_links();

    $audio = $this->home_model->get_audio_web(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title
    );

    foreach($audio as $item)
    {
    $s = strtotime($item->created_at);
    $date_var = date('d/m/Y', $s);

     echo '<div class="col-md-4">
            <div class="card mb-2">
            <div class="radios">
                <ul>
                    <a href="javascript:void(0)" class="openAudioModal" data-toggle="modal" data-src="" data-target="#audioModal'.$item->id.'">
                    <li class="d-flex">
                    <div class="icon">

                    <img src="'.base_url().'assets-front/images/audio_icon.png'.'" alt="audio">

                    </div>
                    <div class="audio-content">
                    <h3>'.$item->title.'</h3>
                    
                    </div>
                    </li>
                    </a>
                </ul>
            </div>
            </div>
            </div>

            <div class="modal fade" style="background:rgba(0,0,0,0.5);" id="audioModal'.$item->id.'" tabindex="-1" role="dialog" aria-labelledby="audioModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">               
                    <div class="modal-body text-center">
                        <button type="button" onclick="stopAudio(this.id);" id="'.$item->id.'" class="close close_audio" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" id="audioModal'.$item->id.'>">&times;
                            </span>

                        </button>

                        <audio id = "audiofile'.$item->id.'"= controls>
                            <source id="audioSrc" src="'. base_url().$item->path_audio.' " type="audio/mpeg">
                          </audio>
                    </div>
                </div>
            </div>
        </div>';
        }
         echo '<div class="col-md-12 pagination">'.$links.'</div>';

    }


    public function photos_list_whats_new()
    {
          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;

        $lang_id = isset($lang_id) ? $lang_id:'1';
        $photo_category_id         = ''; 
         $time    = strtotime('-14 days');                  
        $photo_from_date           = date('Y-m-d',$time);
        $photo_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'photo_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_gallery_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'photo_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->photo_num_rows(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['photo'] = $this->home_model->get_photo_web(1,$limit,$start,$photo_category_id,$photo_from_date,$photo_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['photo_categories'] = $this->home_model->photo_categories(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('photo_list_two', $data);
        $this->load->view('partials/_footer', $data);


    }

     public function audios_list_whats_new()
    {  
          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
     
        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $audio_category_id         = '';  
        $time    = strtotime('-14 days');                 
        $audio_from_date           = date('Y-m-d',$time);
        $audio_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'audio_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_gallery_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'audio_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

         $config['total_rows']  = $this->home_model->audio_num_rows(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['audio'] = $this->home_model->get_audio_web(1,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title);
        //echo '<pre>';print_r( $data['audio']);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['audio_categories'] = $this->gallery_category_model->get_audio_albums(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        $this->load->view('partials/_header', $data);
        $this->load->view('radio-programs-two', $data);
        $this->load->view('partials/_footer', $data);
    }


       public function videos_list_whats_new()
       { 

            /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       
        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $video_category_id         = '';  
        $time    = strtotime('-14 days');                 
        $video_from_date    = date('Y-m-d',$time);                
        $video_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'videos_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_video_count_two();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'videos_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->video_num_rows(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['video'] = $this->home_model->get_video_web(1,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['videos_categories'] = $this->home_model->video_albums(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        $this->load->view('partials/_header', $data);
        $this->load->view('videos-two', $data);
        $this->load->view('partials/_footer', $data);

       }


    public function infographics_list_whats_new()
    {  

          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

       date_default_timezone_set("Asia/Calcutta");
       $lang_id = $lang_id;
       $lang_id = isset($lang_id) ? $lang_id:'1';
        $infographic_category_id         = '';  
        $time    = strtotime('-14 days');                
        $infographic_from_date           = date('Y-m-d',$time);
        $infographic_to_date             = date('Y-m-d');
        $title     = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'infographic_list'; 
        $config['total_rows']  = $this->home_model->get_paginated_infographic_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'infographic_list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->infographic_num_rows(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['infographic'] = $this->home_model->get_infographic_web(1,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title);

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['infographic_categories'] = $this->home_model->infographic_categories(1);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('infographic_list_two', $data);
        $this->load->view('partials/_footer', $data);
    }


    public function media_invite_list(){
        if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;

       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $media_invite_category_id         = ''; 
        $time    = strtotime('-14 days');                 
        $media_invite_from_date           = date('Y-m-d',$time);
        $media_invite_to_date             = date('Y-m-d');
        $title = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'media-invite-list'; 
        $config['total_rows']  = $this->home_model->get_paginated_media_invite_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'media-invite-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->media_invite_num_rows($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['media_invite'] = $this->home_model->get_media_invite_web($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);

        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pru_cate'] = $this->home_model->pru_cate($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('media_invite_list', $data);
        $this->load->view('partials/_footer', $data);

    }


    public function media_invite_list_ajax()
    {   
        if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
       // $data['tran_lang'] = $array;

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $offset = $this->input->post('page');
        $media_invite_category_id = $this->input->post('media_invite_category_id');
        $daterange = $this->input->post('daterange');
        $title = $this->input->post('title');

        $start = isset($offset) ? $offset:'1';
        $daterange       = $this->input->post('daterange');
        if(!empty($daterange)){
        $daterange       = $this->input->post('daterange');

        }else{

        $daterange       = date('d/m/Y')."-".date('d/m/Y');
        }

        $var             = explode("-", $daterange);
        $date            = str_replace('/', '-', $var[0]);
        $date_1          = str_replace('/', '-', $var[1]);            
        $media_invite_from_date           = date('Y-m-d', strtotime($date));
        $media_invite_to_date             = date('Y-m-d', strtotime($date_1));

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'media-invite-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

         $config['total_rows']  = $this->home_model->media_invite_num_rows($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);
        
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
        $data['page_number']=$config['page_no'];
        $data['media_invite'] = $this->home_model->get_media_invite_web($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title
        );
    
        echo json_encode($data);
      
        }

      public function media_invite_archive()
      {

       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;

       date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $media_invite_category_id         = '';                 
        $media_invite_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));
        $media_invite_to_date             = date('Y-m-d');
        $title = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'media-invite-archive'; 
        $config['total_rows']  = $this->home_model->get_paginated_media_invite_archive_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        // $config['target']      = '#dataList'; 
        // $config['base_url']    = base_url() . 'media-invite-archive';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->media_invite_num_rows($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['media_invite'] = $this->home_model->get_media_invite_web($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);
      // echo '<pre>';print_r($data['media_invite']);

        //$data['menu_links'] = $this->navigation_model->get_menu_links(1);
       // $data['media_invite_categories'] = $this->home_model->media_invite_categories();
        //echo '<pre>';print_r($data['infographic_categories']);die();
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pru_cate'] = $this->home_model->pru_cate($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('media_invite_archive', $data);
        $this->load->view('partials/_footer', $data);

    }

       public function media_invite_archive_ajax()
       {

         if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
       // $data['tran_lang'] = $array;

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $offset = $this->input->post('page');
        $media_invite_category_id = $this->input->post('media_invite_category_id');
        $daterange = $this->input->post('daterange');
        $title = $this->input->post('title');

        $start = isset($offset) ? $offset:'1';
        $daterange       = $this->input->post('daterange');
        if(!empty($daterange)){
        $daterange       = $this->input->post('daterange');

        }else{

        $daterange       = date('d/m/Y')."-".date('d/m/Y');
        }

        $var             = explode("-", $daterange);
        $date            = str_replace('/', '-', $var[0]);
        $date_1          = str_replace('/', '-', $var[1]);            
        $media_invite_from_date           = date('Y-m-d', strtotime($date));
        $media_invite_to_date             = date('Y-m-d', strtotime($date_1));

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'media-invite-archive';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

         $config['total_rows']  = $this->home_model->media_invite_num_rows($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title);
        //echo '<pre>';print_r($config['total_rows']);
        //die;
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
        $data['page_number']=$config['page_no'];
        $data['media_invite'] = $this->home_model->get_media_invite_web($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title
        );
    
        echo json_encode($data);
      
        }


        public function circular_list()
        {
          if(!empty($this->session->userdata('lang_id')))
         {
          $lang_id = $this->session->userdata('lang_id');
         }else{
          $lang_id = 1;
         }

         $translations = $this->language_model->get_language_translations($lang_id);
          $array = array();
          if (!empty($translations)) {
              foreach ($translations as $translation) {
                  $array[$translation->label] = $translation->translation;
              }
          }
          $data['tran_lang'] = $array;

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $time    = strtotime('-14 days');                 
        $circular_list_from_date           = date('Y-m-d',$time);
        $circular_list_to_date             = date('Y-m-d');
        $title = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'circular-list'; 
        $config['total_rows']  = $this->home_model->get_paginated_circular_list_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

       $config['total_rows']  = $this->home_model->circular_list_num_rows($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);
              //echo '<pre>';print_r($data['total_rows']);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
       //die();

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['circular_list'] = $this->home_model->get_circular_list_web($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);

        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pru_cate'] = $this->home_model->pru_cate($lang_id);
        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        $this->load->view('partials/_header', $data);
        $this->load->view('circular_list', $data);
        $this->load->view('partials/_footer', $data);

        }


    public function circular_list_ajax()
    {

        if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
      //  $data['tran_lang'] = $array;

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $offset = $this->input->post('page');
        $daterange = $this->input->post('daterange');
        $title = $this->input->post('title');

        $start = isset($offset) ? $offset:'1';
        $daterange       = $this->input->post('daterange');
        if(!empty($daterange)){
        $daterange       = $this->input->post('daterange');

        }else{

        $daterange       = date('d/m/Y')."-".date('d/m/Y');
        }

        $var             = explode("-", $daterange);
        $date            = str_replace('/', '-', $var[0]);
        $date_1          = str_replace('/', '-', $var[1]);            
        $circular_list_from_date           = date('Y-m-d', strtotime($date));
        $circular_list_to_date             = date('Y-m-d', strtotime($date_1));

 
        $config['base_url']    = base_url() .'circular-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->circular_list_num_rows($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);
        
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
        $data['page_number']=$config['page_no'];
        $data['circular_list'] = $this->home_model->get_circular_list_web($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title

        );
        //echo '<pre>';print_r($data['circular_list']);
    
        echo json_encode($data);
      
        }



        public function circular_archive_list(){

         if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
          
        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';

        $circular_list_from_date           = date('Y-m-d',(strtotime ( '-2 year' , strtotime (date('Y-m-d')) ) ));
        $circular_list_to_date             = date('Y-m-d');
        $title = '';

        $config['target']      = '#dataList'; 
        $config['base_url']    = base_url() . 'circular-archive-list'; 
        $config['total_rows']  = $this->home_model->get_paginated_circular_archive_list_count();
        $offset = $this->input->post('page');
        $start = isset($offset) ? $offset:'1';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

       $config['total_rows']  = $this->home_model->circular_list_num_rows($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);
              //echo '<pre>';print_r($data['total_rows']);
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
       //die();

        
        $data['circular_list'] = $this->home_model->get_circular_list_web($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);
       ///echo '<pre>';print_r($data['circular_list']);

         //echo '====';die();
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pru_cate'] = $this->home_model->pru_cate($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('circular_archive_list', $data);
        $this->load->view('partials/_footer', $data);

        }


    public function circular_archive_list_ajax()
    {   
         if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        //$data['tran_lang'] = $array;

        date_default_timezone_set("Asia/Calcutta");
        $lang_id = $lang_id;
        $lang_id = isset($lang_id) ? $lang_id:'1';
        $offset = $this->input->post('page');
        $daterange = $this->input->post('daterange');
        $title = $this->input->post('title');

        $start = isset($offset) ? $offset:'1';
        $daterange       = $this->input->post('daterange');
        if(!empty($daterange)){
        $daterange       = $this->input->post('daterange');

        }else{

        $daterange       = date('d/m/Y')."-".date('d/m/Y');
        }

        $var             = explode("-", $daterange);
        $date            = str_replace('/', '-', $var[0]);
        $date_1          = str_replace('/', '-', $var[1]);            
        $circular_list_from_date           = date('Y-m-d', strtotime($date));
        $circular_list_to_date             = date('Y-m-d', strtotime($date_1));

 
        $config['base_url']    = base_url() .'circular-list';
        $config['per_page']    = 15;
        $config['page_no']    = (int)($start/15)+1;
        $limit = 15; 

        $config['total_rows']  = $this->home_model->circular_list_num_rows($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title);
        
       
        $this->ajax_pagination->initialize($config);   
        $data['links'] = $this->ajax_pagination->create_links();
        $data['page_number']=$config['page_no'];
        $data['circular_list'] = $this->home_model->get_circular_list_web($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title

        );
        //echo '<pre>';print_r($data['circular_list']);
    
        echo json_encode($data);
      
        } 


        public function archive_list(){

               /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/

        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $this->load->view('partials/_header', $data);
        $this->load->view('archive_list', $data);
        $this->load->view('partials/_footer', $data);
        } 

        public function whats_new(){

        /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }

       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
        $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
        $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);

        $data['twitter_settings'] = $this->home_model->get_settings_twitter();
        $data['facebook_settings'] = $this->home_model->get_settings_facebook();
        $data['youtube_settings'] = $this->home_model->get_settings_youtube();
        $data['social_media_settings'] = $this->home_model->get_settings_socialmedialinks();
        $data['pages'] = $this->home_model->get_page_lang($lang_id);
         $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();

        $this->load->view('partials/_header', $data);
        $this->load->view('whats_new', $data);
        $this->load->view('partials/_footer', $data);
        }  


    /*footer methods*/   
     //  public function website_policies(){
     //   $id = $this->uri->segment(2);
     //   $data['menu_links'] = $this->navigation_model->get_menu_links(1);
     //   $data['logo_gallery'] = $this->home_model->logo_gallery();
     //   $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
     //   // echo '<pre>';print_r($data['sainik_samachar']);
     //   // die();
     //   $this->load->view('partials/_header', $data);
     //   $this->load->view('website_policies', $data);
     //   $this->load->view('partials/_footer', $data);
     // }

     //  public function terms_Conditions(){
     //   $id = $this->uri->segment(2);
     //   $data['menu_links'] = $this->navigation_model->get_menu_links(1);
     //   $data['logo_gallery'] = $this->home_model->logo_gallery();
     //   $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
     //   // echo '<pre>';print_r($data['sainik_samachar']);
     //   // die();
     //   $this->load->view('partials/_header', $data);
     //   $this->load->view('terms_Conditions', $data);
     //   $this->load->view('partials/_footer', $data);
     // }

     //  public function help(){
     //   $id = $this->uri->segment(2);
     //   $data['menu_links'] = $this->navigation_model->get_menu_links(1);
     //   $data['logo_gallery'] = $this->home_model->logo_gallery();
     //   $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
     //    //echo '<pre>';print_r($data['sainik_samachar']);
     //    //die();
     //   $this->load->view('partials/_header', $data);
     //   $this->load->view('help', $data);
     //   $this->load->view('partials/_footer', $data);
     // }

     //  public function privacy_policy(){
     //   $id = $this->uri->segment(2);
     //   $data['menu_links'] = $this->navigation_model->get_menu_links(1);
     //   $data['logo_gallery'] = $this->home_model->logo_gallery();
     //   $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
     //   // echo '<pre>';print_r($data['sainik_samachar']);
     //   // die();
     //   $this->load->view('partials/_header', $data);
     //   $this->load->view('privacy_policy', $data);
     //   $this->load->view('partials/_footer', $data);
     // }

      public function feedback()
      {
      
        $random_number2 = $this->generateRandomString2();
        $this->session->set_userdata('random_number2', $random_number2);
        $vals = array(
        'word' => $random_number2,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'font_path' => './path/to/fonts/texb.ttf',
        'img_width' => '100',
        'img_height' => '32',
        'expiration' => 7200
        );
        
        $cap2 = create_captcha($vals);
        $data['captcha2'] = $cap2['image'];
                /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       $id = $this->uri->segment(2);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
       $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id);
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone_no', 'Phone', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('text', 'Text', 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    if ($this->form_validation->run() == true){
          if($this->input->post('submit'))
          {
            $data = $this->input->post();
            unset($data['submit']);
            //  print_r($data); die;
             $inserData = $this->home_model->add_feedback($data);
             if(isset($inserData)){
                   if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
                 // $this->load->helper('custom_helper');
                 // $data['subject'] = " Feedback  Form received (Date)";
                 // $email = array( 'ankurchawla.1989@gmail.com');
                 // $mailSend =   send_email($data, $email);
                 $mailSend = 1;

       if($mailSend==1){

        if($this->session->userdata('random_number') != $this->input->post('captcha_chk')){
            $this->session->set_flashdata('error', "Invalid captcha!");
              redirect($_SERVER['HTTP_REFERER']);
             }
            $this->session->set_flashdata('success', 'Thank you for submitting the feedback. Our team will analyze your concern and revert back to you asap.');
                $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id);
                $data['pages'] = $this->home_model->get_page_lang($lang_id);
                 $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                $this->load->view('partials/_header', $data);
                $this->load->view('feedback', $data);
                $this->load->view('partials/_footer', $data);
            }else{
                $this->session->set_flashdata('error', 'There is some issue in sending email to server, please try again later');
                $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id);
                $data['pages'] = $this->home_model->get_page_lang($lang_id);
                $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                $this->load->view('partials/_header', $data);
                $this->load->view('feedback', $data);
                $this->load->view('partials/_footer', $data);
            }
        }else{
            $this->session->set_flashdata('error', 'There is some issue in sending data to server, please try again later');
        }
          }
        }else{
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
        $this->load->view('partials/_header', $data);
       $this->load->view('feedback', $data);
       $this->load->view('partials/_footer', $data);
        }
     }

     public function captcha2()
      { 
         
        $random_number2 = $this->generateRandomString2();
        $this->session->set_userdata('random_number2', $random_number2);
        $vals2 = array(
        'word' => $random_number2,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'font_path' => './path/to/fonts/texb.ttf',
        'img_width' => '100',
        'img_height' => '32',
        'expiration' => 7200
        );
       
        $cap2 = create_captcha($vals2);
        $captcha2 = $cap2['image']; 
        echo json_encode($captcha2);      
      }

      function generateRandomString2($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
       }
   

    


    public function feedback_post(){
       // echo $this->session->userdata('random_number2');
       // echo '===='.$this->input->post('captcha_chk');
       // die();
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
                /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/
       $id = $this->uri->segment(2);
       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
       $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id);
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone_no', 'Phone', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('text', 'Text', 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    if ($this->form_validation->run() == true){
          if($this->input->post('submit'))
          {
            $data = $this->input->post();
            unset($data['submit']);
            //  print_r($data); die;
             $inserData = $this->home_model->add_feedback($data);
             if(isset($inserData)){
                   if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
                 // $this->load->helper('custom_helper');
                 // $data['subject'] = " Feedback  Form received (Date)";
                 // $email = array( 'ankurchawla.1989@gmail.com');
                 // $mailSend =   send_email($data, $email);
                 $mailSend = 1;

       if($mailSend==1){
  
        if($this->session->userdata('random_number2') != $this->input->post('captcha_chk')){
            $this->session->set_flashdata('error', "Invalid captcha!");
              redirect($_SERVER['HTTP_REFERER']);
             }
            $this->session->set_flashdata('success', 'Thank you for submitting the feedback. Our team will analyze your concern and revert back to you asap.');
                $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
                $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
                $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id);
                $data['pages'] = $this->home_model->get_page_lang($lang_id);
                $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
                 redirect('feedback');
                // $this->load->view('partials/_header', $data);
                // $this->load->view('feedback', $data);
                // $this->load->view('partials/_footer', $data);
            }else{
                $this->session->set_flashdata('error', 'There is some issue in sending email to server, please try again later');
                 redirect('feedback');
            }
        }else{
            $this->session->set_flashdata('error', 'There is some issue in sending data to server, please try again later');
        }
          }
        }else{
       
             redirect('feedback');
        }
     }
    
    



      public function contact_us(){
       $id = $this->uri->segment(2);
       $data['menu_links'] = $this->navigation_model->get_menu_links(1);
       $data['logo_gallery'] = $this->home_model->logo_gallery();
       $data['sainik_samachar'] = $this->home_model->sainik_samachar_list_id($id); 
        $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
       $this->load->view('partials/_header', $data);
       $this->load->view('contact_us', $data);
       $this->load->view('partials/_footer', $data);
     } 


  function screen_reader_access(){
          /*tranlation*/
       if(!empty($this->session->userdata('lang_id')))
       {
        $lang_id = $this->session->userdata('lang_id');
       }else{
        $lang_id = 1;
       }
       $translations = $this->language_model->get_language_translations($lang_id);
        $array = array();
        if (!empty($translations)) {
            foreach ($translations as $translation) {
                $array[$translation->label] = $translation->translation;
            }
        }
        $data['tran_lang'] = $array;
        /*tranlation*/


       $data['menu_links'] = $this->navigation_model->get_menu_links($lang_id);
       $data['logo_gallery'] = $this->home_model->logo_gallery($lang_id);
       $data['pages'] = $this->home_model->get_page_lang($lang_id);
       $data['visual_settings'] = $this->home_model->get_settings_uploaded_date();
       $this->load->view('partials/_header', $data);
       $this->load->view('screen_reader_access', $data);
       $this->load->view('partials/_footer', $data);

  }

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
    }

   /*Menu methods*/ 
}