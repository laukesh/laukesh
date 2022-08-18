<?php defined('BASEPATH') or exit('No direct script access allowed');
class Gallery_model extends CI_Model
{
    //input values
    public function input_values()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t = time();
        $data = array(
            'lang_id'      => $this->input->post('lang_id', true),
            'album_id'     => $this->input->post('album_id', true),
            'title'        => $this->input->post('title', true),
            'keywords'     => $this->input->post('keywords', true),
            'summary_desc'  => $this->input->post('summary_desc', true),
            'created_at'    => date('Y-m-d H:i:s',$t),
            'content'      => $this->input->post('content', true)
        );

        return $data;
    }

    public function input_values_infographic()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t = time();
        $data = array(
            'lang_id'      => $this->input->post('lang_id', true),
            'infographic_category'     => $this->input->post('infographic_category', true),
            'title'        => $this->input->post('title', true),
            'title_slug'   => $this->input->post('title_slug', true),
            'keywords'     => $this->input->post('keywords', true),
            'summary_desc' => $this->input->post('summary_desc', true),
            'created_at'   => date('Y-m-d H:i:s',$t),
            'content'      => $this->input->post('content', true)
            );
       if(!empty($this->input->post('created_at'))){
        $data['created_at'] = $this->input->post('created_at');
        } 

       //echo '<pre>';print_r($data);die;

        return $data;
    }

     public function input_values_event()
    {
        $data = array(
            'lang_id'         => $this->input->post('lang_id', true),
            'title'           => $this->input->post('title', true),
            'title_slug'      => $this->input->post('title_slug', true),
            'address'         => $this->input->post('address', true),
            'keywords'        => $this->input->post('keywords', true),
            'summary_desc'    => $this->input->post('summary_desc', true),
            'content'         => $this->input->post('content', true),
            'start_date'      => $this->input->post('start_date', true),
            'end_date'        => $this->input->post('end_date', true)
        );
        return $data;
    }

     public function input_values_media()
    {   
        date_default_timezone_set("Asia/Kolkata");
        $t = time();

         if($this->input->post('pro_name')){
            $regional_pro_id = '';
            $pro_name = $this->input->post('pro_name');
         }else{
           $regional_pro_id = $this->input->post('regional_pro_id');
            $pro_name = '';
         }
        
        $data = array('lang_id'             => $this->input->post('lang_id', true),
                      'pro_category'        => $this->input->post('pro_category', true),
                      'regional_pro_id'     => $regional_pro_id,
                      'name'                => $pro_name,
                      'mobile'              => $this->input->post('mobile', true),
                     'date_of_event'       => date('Y-m-d H:i:s', strtotime($this->input->post('date_of_event'))),
                      'title'               => $this->input->post('title', true),
                      'venue_event'         => $this->input->post('venue_event', true),
                      'remark'              => $this->input->post('remark', true),
                      'reporting_time'      => date('H:i:s', strtotime($this->input->post('reporting_time', true))),
                      'invitees'            => $this->input->post('invitees', true),
                      'keywords'            => $this->input->post('keywords', true),
                      'created_at'          => date('Y-m-d H:i:s',$t),
                      'description'         => $this->input->post('description', true)
                     );
     // echo '<pre>';print_r($data);
      //die;

      $this->db->insert('media', $data);
         //echo $this->db->last_qurery(); die();
        return true;
    }

    
    public function update_media($id)
    {
        date_default_timezone_set("Asia/Kolkata");
        $t = time();
           $regional_pro_id = $this->input->post('regional_pro_id');
 
          if(!empty($this->input->post('pro_name'))){
            //$regional_pro_id = 'null';
            $pro_name = $this->input->post('pro_name');
         }else{
           $regional_pro_id = $this->input->post('regional_pro_id');
            $pro_name = '';
         }

        $id = clean_number($id);
        $data = array('lang_id'             => $this->input->post('lang_id', true),
                      'pro_category'        => $this->input->post('pro_category', true),
                      'regional_pro_id'     => $regional_pro_id,
                      'name'                => $pro_name,
                      'mobile'              => $this->input->post('mobile', true),
                      'date_of_event'       => date('Y-m-d H:i:s', strtotime($this->input->post('date_of_event'))),
                      'title'               => $this->input->post('title', true),
                      'venue_event'         => $this->input->post('venue_event', true),
                      'remark'              => $this->input->post('remark', true),
                      'reporting_time'      => date('H:i:s', strtotime($this->input->post('reporting_time', true))),
                      'invitees'            => $this->input->post('invitees', true),
                      'keywords'            => $this->input->post('keywords', true),
                      'created_at'          => date('Y-m-d H:i:s',$t),
                      'description'         => $this->input->post('description', true)
                     );


        $this->db->where('id', $id);
        return $this->db->update('media', $data);
         
    }


    //add image
    public function add()
    {
        $data = $this->input_values();
        if (!empty($_FILES['files'])){
            $this->load->model('upload_model');
            $file_count = count($_FILES['files']['name']);

           

            for ($i = 0; $i < $file_count; $i++){
                if (isset($_FILES['files']['name'])) {
                    //file
                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file', 'array');
                    $gftype=$_FILES['file']['type'];
                    $rftype = count(explode('.',$_FILES['file']['name']));

                    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    $detectedType = exif_imagetype($_FILES['file']['tmp_name']);
                    $error = !in_array($detectedType, $allowedTypes);
                   
                   
                     
                    if(($detectedType != 1 && $error == 1) ||  $rftype > 2){

                        $this->session->set_flashdata('errors_form', 'Please upload correct file');
                        redirect($this->agent->referrer());
                    }
                   
                   

                    if (!empty($temp_data)){
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif'){

                            $gif_path = $this->upload_model->gallery_gif_image_upload($temp_data['file_name']);
                            $data["path_big"] = $gif_path;
                            $data["path_small"] = $gif_path;

                        }else{

                            $data["path_big"] = $this->upload_model->gallery_big_image_upload($temp_path,$temp_data['image_type']);
                            $data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                    $this->upload_model->delete_temp_image($temp_path);
                    $this->db->insert('gallery', $data);
                }
            }
            return true;
        }

        return false;
    }


     public function add_infographic()
    {
        $data = $this->input_values_infographic();
        if (!empty($_FILES['files'])) {
            $this->load->model('upload_model');
            //$file_count = count($_FILES['files']['name']);
           // for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['files']['name'])) {
                    //file
                    $_FILES['file']['name'] = $_FILES['files']['name'];
                    $_FILES['file']['type'] = $_FILES['files']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['files']['error'];
                    $_FILES['file']['size'] = $_FILES['files']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file', 'array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif') {
                            $gif_path = $this->upload_model->infographic_gif_image_upload($temp_data['file_name']);
                            $data["path_big"] = $gif_path;
                           // $data["path_small"] = $gif_path;
                        } else {
                            $data["path_big"] = $this->upload_model->infographic_big_image_upload($temp_path,$temp_data['image_type']);
                          $data["path_small"] = $this->upload_model->infographic_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                    $this->upload_model->delete_temp_image($temp_path);
                    $this->db->insert('infographic', $data);
                }
            //}
            return true;
        }

        return false;
    }

    public function add_event()
    {
        $data = $this->input_values_event();
        if (!empty($_FILES['files'])){
            $this->load->model('upload_model');
            $file_count = count($_FILES['files']['name']);
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['files']['name'])) {
                    //file
                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file', 'array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif') {
                            $gif_path = $this->upload_model->event_gif_image_upload($temp_data['file_name']);
                            $data["path_big"] = $gif_path;
                           // $data["path_small"] = $gif_path;
                        } else {
                            $data["path_big"] = $this->upload_model->event_big_image_upload($temp_path);
                            //$data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path);
                        }
                    }
                    $this->upload_model->delete_temp_image($temp_path);
                    $this->db->insert('event', $data);
                }
            }
            return true;
        }

        return false;
    }


     public function input_values_audio()
    {
      //echo '====';die();
     date_default_timezone_set("Asia/Calcutta");
     $curdate = date('Y-m-d H:i:s');
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'audio_album_id' => $this->input->post('cate_id', true),
            'title' => $this->input->post('title', true),
           // 'title_slug' => $this->input->post('title_slug', true),
            'keywords' => $this->input->post('keywords', true),
            'summary_desc' => $this->input->post('summary_desc', true),
            'created_at' =>  $curdate,
            'content' => $this->input->post('content', true)
           
        );
        $curdate = $this->input->post('created_at', true);
        if (!empty($curdate)) {
            $data['created_at'] = $curdate;
        }

        return $data;
    }

    public function input_values_video()
    {
       date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = array(
            'lang_id'       => $this->input->post('lang_id', true),
            'cate_id'       => $this->input->post('cate_id', true),
            'link'          => $this->input->post('link', true),
            'created_at'    => date('Y-m-d H:i:s',$t),
            'summary_desc'  => $this->input->post('summary_desc', true),
            'keywords'      => $this->input->post('keywords', true),
            'content'       => $this->input->post('content', true),
            'title'         => $this->input->post('title', true),
            'youtube_link'  => $this->input->post('youtube_link', true)
        );
         $created_at = $this->input->post('created_at', true);
        if (!empty($created_at)) {
            $data['created_at'] = $created_at;
        }

        return $data;
    }

    public function add_video()
    {
      $data = $this->input_values_video();
     echo $_FILES['cover_img']['name'];
     die();

         if(isset($_FILES['cover_img']['name'])){
            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('cover_img', 'array');
            $temp_path = $temp_data['full_path'];
            $data["path_image"] = $this->upload_model->video_small_image_upload($temp_path,$temp_data['image_type']);
          }
        
     $fullimagename = clean($_FILES['video']['name']); 
     $date          = date('Y-m-d');
     $date_format   = str_replace("-","_",$date);
     $time          = date('H:i');
     $time_formate  =  str_replace(":","_",$time); 
     $clean_video   = "sainik_samachar_video_".$date_format.'_'.$time_formate.'.'.pathinfo($fullimagename, PATHINFO_EXTENSION);

      if(isset($clean_video)){
         $path = 'uploads/video_gallery';
             $path2 = 'uploads/video_gallery/' . date("Y");
               $path3 = 'uploads/video_gallery/' . date("Y") . '/' . date("m") .'/';            
              if(!is_dir($path)){
                 mkdir($path,755, true);
                   mkdir($path2,755, true);
                     mkdir($path3,755, true);
               }
               else{
                if(!is_dir($path2)){
                    mkdir($path2,755, true);
                     mkdir($path3,755, true);
                       
                 }
                 else{
                   if(!is_dir($path3)){
                    mkdir($path3,755, true);
                       
                 }
                 }
               }

            
          // echo '======'.$path2;
           //die;
            $config['upload_path']    = $path3;  
            $config["allowed_types"]  = 'mp4|mov|mpeg'; 
            $config['max_size']       = 50000; 
            $config['max_width']      = 1024; 
            $config['max_height']     = 768; 
            $config['file_name']      = $clean_video;
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('video'))
            {                
             $error = array('error' => $this->upload->display_errors()); 
           
            }else{ 
                $data1 =  $this->upload->data(); 
                $data['path_video'] = $path3.$data1['file_name'];
                $var = $this->db->insert('video',$data);

            } 
         return true;   
      }

      $data['path_video'] = NULL;
      $var = $this->db->insert('video',$data);
      return true; 
             
    }


    //add image
    public function add_audio()
    {
        $data = $this->input_values_audio(); 
        $fullimagename = clean($_FILES['audio_file']['name']); 
        $date          = date('Y-m-d');
        $date_format   = str_replace("-","_",$date);
        $time          = date('H:i');
        $time_formate  =  str_replace(":","_",$time); 
        $clean_audio   = "sainik_samachar_audio_".$date_format.'_'.$time_formate.'.'.pathinfo($fullimagename, PATHINFO_EXTENSION);

        $mime_types = array('mp3' => 'audio/mp3');
        $ext = pathinfo($fullimagename, PATHINFO_EXTENSION);
        $rftype = count(explode('.',$_FILES['audio_file']['name']));

        if (!array_key_exists($ext, $mime_types)  || $rftype >2) {
             $this->session->set_flashdata('errors_form', 'Please upload correct file');
            redirect($this->agent->referrer());
        }

          if(isset($clean_audio))
          {    

           $path = 'uploads/audio_gallery';
             $path2 = 'uploads/audio_gallery/' . date("Y");
               $path3 = 'uploads/audio_gallery/' . date("Y") . '/' . date("m") . '/';
             if(!is_dir($path)){
                 mkdir($path,755, true);
                   mkdir($path2,755, true);
                     mkdir($path3,755, true);
               }
               else{
                if(!is_dir($path2)){                   
                    mkdir($path2,755, true);
                     mkdir($path3,755, true);
                       
                 }
                 else{
                   if(!is_dir($path3)){
                    mkdir($path3,755, true);
                       
                 }
                 }
               }
               
         $config['upload_path']    = $path3; 
         $config['allowed_types']  = '*'; 
         $config['max_size']       = 40000; 
         $config['max_width']      = 1024; 
         $config['max_height']     = 768;  
         $config['file_name']      = $clean_audio;  
         $this->load->library('upload', $config);
         $this->upload->initialize($config);   

         if (!$this->upload->do_upload('audio_file')){
            $error = array('error' => $this->upload->display_errors());         
         }        
         else{ 
           $data_val =  $this->upload->data(); 
            $data['path_audio'] = $path3.$data_val['file_name'];           
         } 
          
          $var = $this->db->insert('audios',$data);
          //echo $this->db->last_query();
          return true;
       }
    }

    //get gallery images
    public function get_images()
    {
        $sql = "SELECT * FROM gallery WHERE lang_id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id)));
        return $query->result();
    }

    public function get_media_id($id)
    {
        $sql = "SELECT * FROM media WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

    //get paginated images
    public function get_paginated_images($per_page, $offset)
    {
        $this->filter_images();
        $this->db->order_by('updated_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('gallery');
        return $query->result();
    }

        //get paginated audio
    public function get_paginated_audio($per_page, $offset)
    {
        $this->filter_audios();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('audios');
      //  echo $this->db->last_query();
        return $query->result();
    }

        //get paginated audio
    public function get_paginated_media($per_page, $offset)
    {
        $this->filter_media();
        $this->db->order_by('id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('media');
        return $query->result();
    }

     public function get_paginated_infographic($per_page, $offset)
    {
        $this->filter_infographic();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('infographic');
        return $query->result();
    }

      public function get_paginated_event($per_page, $offset)
    {
        $this->filter_event();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('event');
        return $query->result();
    }

     public function get_paginated_video($per_page, $offset)
    {
        $this->filter_video();
        $this->db->order_by('updated_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('video');
       // echo '=='.$this->db->last_query();
        //die;
        return $query->result();
    }

     public function get_footer_logo_images()
    {
        $this->filter_images();
        $this->db->where('album_id',1);
        $this->db->where('category_id',2);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(12);
        $query = $this->db->get('gallery');
        return $query->result();
    }

     public function get_website_setting()
    {
        //$this->filter_images();
        $this->db->where('id',1);
        //$this->db->where('category_id',2);
        //$this->db->order_by('created_at', 'DESC');
        //$this->db->limit(12);
        $query = $this->db->get('settings');
        return $query->result();
    }

    public function get_visual_setting()
    {
        //$this->filter_images();
        $this->db->where('id',1);
        //$this->db->where('category_id',2);
        //$this->db->order_by('created_at', 'DESC');
        //$this->db->limit(12);
        $query = $this->db->get('visual_settings');
        return $query->result();
    }

      public function get_website_video()
    {
        //$this->filter_images();
        $this->db->where('id',2);
        //$this->db->where('category_id',2);
        //$this->db->order_by('created_at', 'DESC');
        //$this->db->limit(12);
        $query = $this->db->get('video');
        //echo $this->db->last_qurery();
        return $query->result();
    }

      public function get_website_audio()
    {
        //$this->filter_images();
        //$this->db->where('id',1);
        //$this->db->where('category_id',2);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get('audios');
        return $query->result();
    }

     public function get_footer_photo_images()
    {
        $this->filter_images();
        $this->db->where('album_id',2);
        $this->db->where('category_id',3);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(12);
        $query = $this->db->get('gallery');
        return $query->result();
    }

    //get paginated images count
    public function get_paginated_images_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_images();
        $query = $this->db->get('gallery');
        return $query->row()->count;
    }
  //get paginated audio count
    public function get_paginated_audio_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_audios();
        $query = $this->db->get('audios');
        return $query->row()->count;
    }

     //get paginated media count
    public function get_paginated_media_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_media();
        $query = $this->db->get('media');
        return $query->row()->count;
    }

    public function get_paginated_infographic_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_media();
        $query = $this->db->get('infographic');
        return $query->row()->count;
    }

       public function get_paginated_event_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_media();
        $this->db->order_by('created_at','DESC');
        $query = $this->db->get('event');
        return $query->row()->count;
    }

     public function get_paginated_video_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_video();
        $query = $this->db->get('video');
        return $query->row()->count;
    }

    //images filter
    public function filter_images()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }
        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $album = trim($this->input->get('album', true));
        if (!empty($album)) {
            $this->db->where('album_id', clean_number($album));
        }
        $category = trim($this->input->get('category', true));
        if (!empty($category)) {
            $this->db->where('category_id', clean_number($category));
        }
    }

       public function filter_audios()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }
        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $album = trim($this->input->get('album', true));
        if (!empty($album)) {
            $this->db->where('audio_album_id', clean_number($album));
        }
        $category = trim($this->input->get('audio_cat_id', true));
        if (!empty($category)) {
            $this->db->where('category_id', clean_number($category));
        }
    }

       public function filter_media()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }

        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }



    }

     public function filter_infographic()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }

        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $album = trim($this->input->get('infographic_category', true));
        if (!empty($album)) {
            $this->db->where('infographic_category', clean_number($album));
        }

    }

     public function filter_event()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }

        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }

    }


     public function filter_video()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('title', clean_str($q));
        }
        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $album = trim($this->input->get('cate_id', true));
        if (!empty($album)) {
            $this->db->where('cate_id', clean_number($album));
        }
        $category = trim($this->input->get('sub_cate_id', true));
        if (!empty($category)) {
            $this->db->where('sub_cate_id', clean_number($category));
        }
    }


    //get gallery images by category
    public function get_images_by_category($category_id)
    {
        $sql = "SELECT gallery.* , gallery_categories.name as category_name FROM gallery 
                INNER JOIN gallery_categories ON gallery_categories.id = gallery.category_id
                WHERE gallery.lang_id = ? AND gallery.category_id = ? ORDER BY gallery.id DESC";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id), clean_number($category_id)));
        return $query->result();
    }

    //get gallery images by album
    public function get_images_by_album($album_id)
    {
        $sql = "SELECT * FROM gallery WHERE album_id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array(clean_number($album_id)));
        return $query->result();
    }

    //get category image count
    public function get_category_image_count($category_id)
    {
        $sql = "SELECT COUNT(id) AS count FROM gallery WHERE lang_id = ? AND category_id = ?";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id), clean_number($category_id)));
        return $query->row()->count;
    }

    //set as album cover
    public function set_as_album_cover($id)
    {
        $image = $this->get_audio($id);
        if (!empty($image)) {
            //reset all
            $data = array(
                'is_album_cover' => 0
            );
            $this->db->where('audio_album_id', $image->album_id);
            $this->db->update('audio', $data);
            //set new
            $data = array(
                'is_album_cover' => 1
            );
            $this->db->where('id', $image->id);
            $this->db->update('audio', $data);
        }
    }

    //get gallery album cover image
    public function get_cover_image($album_id)
    {
        $sql = "SELECT * FROM gallery WHERE album_id = ? AND is_album_cover = 1 ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql, array(clean_number($album_id)));
        $row = $query->row();
        if (empty($row)) {
            $sql = "SELECT * FROM gallery WHERE album_id = ? ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql, array(clean_number($album_id)));
            $row = $query->row();
        }
        return $row;
    }

    //get image
    public function get_image($id)
    {
        $sql = "SELECT * FROM gallery WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //get audio
    public function get_audio($id)
    {
        $sql = "SELECT * FROM audios WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

     public function get_infographic($id)
    {
        $sql = "SELECT * FROM infographic WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

     public function get_event($id)
    {
        $sql = "SELECT * FROM event WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

      public function get_video($id)
    {
        $sql = "SELECT * FROM video WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //update image
    public function update($id)
    {
        $id = clean_number($id);
        $data = $this->input_values();
        if (!empty($_FILES['file'])) {
            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('file', 'array');
            if (!empty($temp_data)) {
                $temp_path = $temp_data['full_path'];
                if ($temp_data['image_type'] == 'gif') {
                    $gif_path = $this->upload_model->gallery_gif_image_upload($temp_data['file_name']);
                    $data["path_big"] = $gif_path;
                    $data["path_small"] = $gif_path;
                } else {
                    $data["path_big"] = $this->upload_model->gallery_big_image_upload($temp_path,$temp_data['image_type']);
                    $data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path,$temp_data['image_type']);
                }
                $this->upload_model->delete_temp_image($temp_path);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('gallery', $data);
    }

      public function update_infographic($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_infographic();
        if (!empty($_FILES['file'])) {
            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('file', 'array');
            if (!empty($temp_data)) {
                $temp_path = $temp_data['full_path'];
                if ($temp_data['image_type'] == 'gif') {
                    $gif_path = $this->upload_model->infographic_gif_image_upload($temp_data['file_name']);
                    $data["path_big"] = $gif_path;
                    $data["path_small"] = $gif_path;
                } else {
                    $data["path_big"] = $this->upload_model->infographic_big_image_upload($temp_path,$temp_data['image_type']);
                    //$data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path);
                }
                $this->upload_model->delete_temp_image($temp_path);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('infographic', $data);
    }

    public function update_event($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_event();
        if (!empty($_FILES['file'])){
            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('file', 'array');
            if (!empty($temp_data)) {
                $temp_path = $temp_data['full_path'];
                if ($temp_data['image_type'] == 'gif') {
                    $gif_path = $this->upload_model->event_gif_image_upload($temp_data['file_name']);
                    $data["path_big"] = $gif_path;
                    //$data["path_small"] = $gif_path;
                } else {
                    $data["path_big"] = $this->upload_model->event_big_image_upload($temp_path);
                    //$data["path_small"] = $this->upload_model->gallery_small_image_upload($temp_path);
                }
                $this->upload_model->delete_temp_image($temp_path);
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('event', $data);
    }

 public function update_video($id)
 {       
        $id = clean_number($id);
        $data = $this->input_values_video();

        if($data['link']==1){
            $data['youtube_link']=NULL;
        }     
            
        if(isset($_FILES['cover_img']['name'])){ 
            $this->load->model('upload_model');
            $temp_data = $this->upload_model->upload_temp_image('cover_img', 'array');
            $temp_path = $temp_data['full_path'];
            $data["path_image"] = $this->upload_model->video_small_image_upload($temp_path,$temp_data['image_type']);
            
          }

            $fullimagename = clean($_FILES['video']['name']); 
            $date          = date('Y-m-d');
            $date_format   = str_replace("-","_",$date);
            $time          = date('H:i');
            $time_formate  =  str_replace(":","_",$time); 
            $clean_video   = "sainik_samachar_video_".$date_format.'_'.$time_formate.'.'.pathinfo($fullimagename, PATHINFO_EXTENSION);

        if(isset($clean_video)){   

           $path = 'uploads/video_gallery';
             $path2 = 'uploads/video_gallery/' . date("Y");
               $path3 = 'uploads/video_gallery/' . date("Y") . '/' . date("m") .'/'; 

            if(!is_dir($path)){          
                   mkdir($path,755,true);
                   mkdir($path2,755,true);
                   mkdir($path3,755,true);

             }else{

              if(!is_dir($path2)){
                  mkdir($path2,755,true);
                   mkdir($path3,755,true);
                     
                 }else{
                 if(!is_dir($path3)){
                  mkdir($path3,755,true);
                     
                  }
               }
             }
             
             
              $config['upload_path']    = $path3; 
              $config['allowed_types']  = 'mp4|mov|mpeg'; 
              $config['max_size']       = 40000; 
              $config['max_width']      = 1024; 
              $config['max_height']     = 768;  
              $config['file_name']     = $clean_video;  
              $this->load->library('upload', $config);
              $this->upload->initialize($config);
              
            if(!$this->upload->do_upload('video'))
            {                
             $error = array('error' => $this->upload->display_errors());  
            }
            else{ 
                $data1 =  $this->upload->data(); 
                $data['path_video'] = $path3.$data1['file_name']; 
              }          
     }
    else{
            $data['path_video'] = NULL;
    }
     
      $this->db->where('id', $id);
      $var =  $this->db->update('video', $data);
      return $var;
}

    public function update_audio($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_audio();
     $fullimagename = clean($_FILES['file']['name']);
     $date          = date('Y-m-d');
     $date_format   = str_replace("-","_",$date);
     $time          = date('H:i');
     $time_formate  =  str_replace(":","_",$time); 
     $clean_audio   = "sainik_samachar_audio_".$date_format.'_'.$time_formate.'.'.pathinfo($fullimagename, PATHINFO_EXTENSION);

        $mime_types = array('mp3' => 'audio/mp3');
        $ext = pathinfo($fullimagename, PATHINFO_EXTENSION);
        $rftype = count(explode('.',$_FILES['file']['name']));

        if (!array_key_exists($ext, $mime_types)  || $rftype >2) {
             $this->session->set_flashdata('errors_form', 'Please upload correct file');
            redirect($this->agent->referrer());
        }
        if(isset($clean_audio)){
           $path = 'uploads/audio_gallery';
             $path2 = 'uploads/audio_gallery/' . date("Y");
               $path3 = 'uploads/audio_gallery/' . date("Y") . '/' . date("m") .'/';   
            if(!is_dir($path)){
               mkdir($path,755,true);
                 mkdir($path2,755,true);
                   mkdir($path3,755,true);
             }
             else{
              if(!is_dir($path2)){
                  mkdir($path2,0655);
                   mkdir($path3,0655);
                     
               }
               else{
                 if(!is_dir($path3)){
                  mkdir($path3,0655);
                     
               }
               }
             }
            $config['upload_path']    = $path3; 
            $config['allowed_types']  = '*'; 
            $config['max_size']       = 40000; 
            $config['max_width']      = 1024; 
            $config['max_height']     = 768;  
            $config['file_name']     = $clean_audio;  
             $this->load->library('upload', $config);
             $this->upload->initialize($config);   
           
           if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());  
             }        
             else{ 
                $data1 =  $this->upload->data(); 
                $data['path_audio'] = $path3.$data1['file_name'];
     
             } 
        }

        $this->db->where('id', $id);
        return $this->db->update('audios', $data);
    }

    //delete image
    public function delete($id)
    {
        $image = $this->get_image($id);
        if (!empty($image)) {
            //delete image
            delete_image_from_server($image->path_big);
            delete_image_from_server($image->path_small);

            $this->db->where('id', $image->id);
            return $this->db->delete('gallery');
        }
        return false;
    }

     public function delete_audio($id)
    {
         $image = $this->get_audio($id);

        if (!empty($image)) {
            //delete image
            delete_image_from_server($image->path_audio);
            //delete_image_from_server($image->path_small);

            $this->db->where('id', $image->id);
            return $this->db->delete('audios');
        }
        return false;
    }

    public function delete_media($id)
    {
            //$image = $this->get_media($id);
            //$this->db->where('id', $image->id);
            $this->db->where('id', $id);
            return $this->db->delete('media');
    }

      public function delete_infographic($id)
    {
          //$image = $this->get_media($id);

            $this->db->where('id', $id);
            return $this->db->delete('infographic');
    }

       public function delete_event($id)
    {
          //$image = $this->get_media($id);

            $this->db->where('id', $id);
            return $this->db->delete('event');
    }


    public function delete_video($id)
    {
         $image = $this->get_video($id);

        if (!empty($image)) {
            //delete image
            delete_image_from_server($image->path_audio);
            //delete_image_from_server($image->path_small);

            $this->db->where('id', $image->id);
            return $this->db->delete('video');
        }
        return false;
    }

    
}