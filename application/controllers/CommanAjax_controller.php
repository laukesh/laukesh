<?php defined('BASEPATH') or exit('No direct script access allowed');


class CommanAjax_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check_permission('sainik_pratika');
        $this->load->model('SainikPratika_model');
        $this->load->model('home_model');
    }

    public function post_action_ajax(){    
        //post_method();
        $data = array(
        'set_of_cover'=>$this->input->post('set_of_cover', true),
        'visibility'=>$this->input->post('set_of_cover', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('sainik_pratika_master', $data);

        $sql = "SELECT * FROM sainik_pratika_master WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
        	'id'=> $data_val[0]->id,
        	'title'=> $data_val[0]->title,
        	'lang_id'=> $data_val[0]->lang_id,
        	'set_of_cover'=> $data_val[0]->set_of_cover,
        	'set_of_cover'=> $data_val[0]->set_of_cover,
        	'set_of_cover'=> $data_val[0]->set_of_cover,

         );

        echo json_encode($val);

       // return;
    }

    public function post_action_image_ajax(){    
        //post_method();
        $data = array(
        'status' => $this->input->post('status', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('gallery', $data);

        $sql = "SELECT * FROM gallery WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'     => $data_val[0]->id,
                     'title'  => $data_val[0]->title,
                     'lang_id'=> $data_val[0]->lang_id,
                     'status' => $data_val[0]->status
                    );

        echo json_encode($val);
    }


      public function post_action_video_ajax(){    
        //post_method();
        $data = array(
        'status' => $this->input->post('status', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('video', $data);

        $sql = "SELECT * FROM video WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'     => $data_val[0]->id,
                     'title'  => $data_val[0]->title,
                     'lang_id'=> $data_val[0]->lang_id,
                     'status' => $data_val[0]->status
                    );

        echo json_encode($val);
    }


     public function post_action_image_ajax2(){    
        $data = array(
        'is_album_cover' => $this->input->post('is_album_cover', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('gallery', $data);

        $sql = "SELECT * FROM gallery WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'             => $data_val[0]->id,
                     'title'          => $data_val[0]->title,
                     'lang_id'        => $data_val[0]->lang_id,
                     'is_album_cover' => $data_val[0]->is_album_cover
                    );

        echo json_encode($val);
    }

     public function post_action_video_ajax2(){    
        //post_method();
        $data = array(
        'is_album_cover' => $this->input->post('is_album_cover', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('video', $data);

        $sql = "SELECT * FROM video WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'             => $data_val[0]->id,
                     'title'          => $data_val[0]->title,
                     'lang_id'        => $data_val[0]->lang_id,
                     'is_album_cover' => $data_val[0]->is_album_cover
                    );

        echo json_encode($val);
    }

       public function post_action_media_ajax(){    
        //post_method();
       // echo '=====================';
        //die;
        $data = array('status'=>$this->input->post('status'));

        $post_id = $this->input->post('post_id');
        $this->db->where('id', $post_id);
        $this->db->update('media', $data);

        $sql = "SELECT * FROM media WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
            // 'id'=> $data_val[0]->id,
            // 'title'=> $data_val[0]->title,
            // 'lang_id'=> $data_val[0]->lang_id,
            // 'set_of_cover'=> $data_val[0]->set_of_cover,
            // 'set_of_cover'=> $data_val[0]->set_of_cover,
            'status'=> $data_val[0]->status,

         );

        echo json_encode($val);

       // return;
    }

        public function post_action_infographic_ajax(){    
        //post_method();
        $data = array(
        'status' => $this->input->post('status', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('infographic', $data);

        $sql = "SELECT * FROM infographic WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'     => $data_val[0]->id,
                     'title'  => $data_val[0]->title,
                     'lang_id'=> $data_val[0]->lang_id,
                     'status' => $data_val[0]->status
                    );

        echo json_encode($val);
    }

         public function post_action_infographic_ajax2(){    
        //post_method();
        $data = array(
        'is_album_cover' => $this->input->post('is_album_cover', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('infographic', $data);

        $sql = "SELECT * FROM infographic WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'             => $data_val[0]->id,
                     'title'          => $data_val[0]->title,
                     'lang_id'        => $data_val[0]->lang_id,
                     'is_album_cover' => $data_val[0]->is_album_cover
                    );

        echo json_encode($val);
    }


     public function post_press_release_action_ajax(){
         
         
        //post_method();
         $data = array(
        'is_active'=>$this->input->post('del_id', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('press_release', $data);


       // return;
    }

     public function press_release_media_remove(){
          $id = $this->input->post('id');
          $release_id = $this->input->post('release_id');
          $media_type = $this->input->post('media_type');
          $lang_id = $this->input->post('lang_id');
          $media_format = $this->input->post('media_format');
          $media_size = $this->input->post('media_type');
          $media_path = $this->input->post('media_path');
          $caption = $this->input->post('caption');
          $status = $this->input->post('status');
          $schedule_for_publish = $this->input->post('schedule_for_publish');
          $created_at = $this->input->post('created_at');
          $created_by = $this->input->post('created_by');

          $data['status_img'] = '0';
          $post_id = $this->input->post('post_id', true);
          $this->db->where('id', $id);
          $this->db->where('release_id', $release_id);
          $this->db->where('media_type', $media_type);
          $query = $this->db->update('tbl_press_release_media', $data);

//          $pro2 = $this -> db
//            -> select('*')
//            -> where('id',1)
//            -> where('release_id', $release_id)
//            -> where('status_img', 1)
//            -> limit(1)
//            -> get('tbl_press_release_media')
//            ->row();

// $array = json_decode(json_encode($pro2), true);

// $a2=array("status_img"=>"0");
// $array_replace = array_replace($array, $a2);
// $arr3['press_release_media_id'] = $array_replace['id'];
// unset($array_replace['id']);
    date_default_timezone_set("Asia/Kolkata");
    $t=time(); 

$array_replace['press_release_media_id'] = $release_id;
$array_replace['release_id'] = $release_id;
$array_replace['media_type'] = $media_type;
$array_replace['lang_id'] = $lang_id;
$array_replace['media_format'] = $media_format;
$array_replace['media_size'] = $media_size;
$array_replace['media_path'] = $media_path;
$array_replace['caption'] = $caption;
$array_replace['status'] = 5;
$array_replace['status_img'] = '0';
$array_replace['schedule_for_publish'] = $schedule_for_publish;
$array_replace['created_at'] = $created_at;
$array_replace['created_by'] = $created_by;
$array_replace['deleted_at'] =  date('Y-m-d H:i:s',$t);
$array_replace['deleted_by'] = $this->auth_user->id;
$var = $this->db->insert('tbl_press_release_media_history_log',$array_replace);
          return true;
       // return;
    }


     public function press_release_ajax_val(){

        $post_id = $this->input->post('post_id', true); 

        $sql = "SELECT * FROM press_release WHERE id =  ? ";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val = $query->result();


        $sql2 = "SELECT * FROM tbl_press_release_media WHERE release_id =  ? and media_type = 'press_release_infographic' and status_img = '1' and status = 3";
        $query2 = $this->db->query($sql2, array(clean_str($post_id)));
        $data_val2 = $query2->result_array();

        $sql3 = "SELECT * FROM tbl_press_release_media WHERE release_id =  ? and media_type = 'press_release_image' and status_img = '1' and status = 3";
        $query3 = $this->db->query($sql3, array(clean_str($post_id)));
        $data_val3 = $query3->result_array();

         $sql4 = "SELECT * FROM tbl_press_release_media WHERE release_id =  ? and media_type = 'press_release_video' and status_img = '1' and status = 3";
        $query4 = $this->db->query($sql4, array(clean_str($post_id)));
        $data_val4 = $query4->result_array();

        $items['press_release_infographic'] = $data_val2;
        $items['press_release_image'] = $data_val3;
        $items['press_release_video'] = $data_val4;
        
        $items['press_release'] = array(
            'id'=> $data_val[0]->id,
            'press_release_title'=> $data_val[0]->press_release_title,
            'pro_category'=> $data_val[0]->pro_category,
            'lang_id'=> $data_val[0]->lang_id,
            'location'=> $data_val[0]->location,
            'service'=> $data_val[0]->service,
            'other'=> $data_val[0]->other,
            'status'=> $data_val[0]->status,
            'date_of_event'=> $data_val[0]->date_of_event,
            'event_subject'=> $data_val[0]->event_subject,
            'keywords'=> $data_val[0]->keywords,
            'release_sub_heading'=> $data_val[0]->release_sub_heading,
            'press_release_text'=> $data_val[0]->press_release_text,
            //'prepared_by_email'=> $data_val[0]->prepared_by_email,
            //'reviewed_by_email'=> $data_val[0]->reviewed_by_email,
            'feature_image'=> $data_val[0]->feature_image,
            'created_at'=> $data_val[0]->created_at,
            'created_by'=> $data_val[0]->created_by,
            'schedule_for_publish'=> $data_val[0]->schedule_for_publish

        );   

        echo json_encode($items);

    }



      public function post_action_audio_ajax(){    
        //post_method();
        $data = array(
        'status' => $this->input->post('status', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('audios', $data);

        $sql = "SELECT * FROM audios WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'     => $data_val[0]->id,
                     'title'  => $data_val[0]->title,
                     'lang_id'=> $data_val[0]->lang_id,
                     'status' => $data_val[0]->status
                    );

        echo json_encode($val);
    }

  public function post_action_audio_ajax2(){    
        //post_method();
        $data = array(
        'is_album_cover' => $this->input->post('is_album_cover', true)
          );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('audios', $data);

        $sql = "SELECT * FROM audios WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
                     'id'             => $data_val[0]->id,
                     'title'          => $data_val[0]->title,
                     'lang_id'        => $data_val[0]->lang_id,
                     'is_album_cover' => $data_val[0]->is_album_cover
                    );

        echo json_encode($val);
    }


}

