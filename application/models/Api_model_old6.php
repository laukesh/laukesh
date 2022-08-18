<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{
    //get contact messages
    public function get_latest_press_release($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$publish_status)
    {

        $this->db->select('press_release.id,press_release.lang_id,press_release.pro_category,press_release.press_release_title,press_release.date_of_event,press_release.keywords,press_release.press_release_text,press_release.feature_image,press_release.release_sub_heading,press_release.approved_at,press_release.created_at,press_release.updated_at,tbl_pru_category.name');
        $this->db->from('press_release');
        $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.id','left');
        if(!empty($lang_id)){
         $this->db->where('press_release.lang_id',$lang_id);
        }
        if(!empty($publish_status)){
         $this->db->where('press_release.status',$publish_status);
        }
        if(empty($publish_status)){
         $this->db->where('press_release.status',3);
        }  
        if(!empty($pro_category))
         {
        $this->db->where('pro_category',$pro_category);
        }
        if(!empty($release_from_date) && !empty($release_to_date)){
       
        $this->db->where('approved_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($release_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($release_to_date)).'"');
        }
        if(!empty($title)){
          $this->db->like('press_release_title',$title,'both',false);
        }
        $this->db->order_by('approved_at','DESC');

         if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        return $var =  $query->result();
        //echo $this->db->last_query();
        //die;
    }

    public function get_latest_press_release_detail($id,$lang_id)
    {

        $this->db->select('press_release.id,press_release.lang_id,press_release.pro_category,press_release.press_release_title,press_release.date_of_event,press_release.keywords,press_release.press_release_text,press_release.feature_image,press_release.release_sub_heading,press_release.approved_at,press_release.created_at,press_release.updated_at,tbl_pru_category.name');
        $this->db->from('press_release');
        $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.id','left');
        
        if(!empty($lang_id)){
         $this->db->where('press_release.lang_id',$lang_id);
        }

        if(!empty($id)){
         $this->db->where('press_release.id',$id);
        }

        $query = $this->db->get();
        return $query->result();
    }


     public function get_latest_press_release_photo($id,$lang_id)
     {

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,created_at,updated_at,approved_at,media_format,media_size,status');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($id)){
         $this->db->where('release_id',$id);
        }
        $this->db->where('media_type','press_release_image');
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
     }

     public function get_latest_press_release_infogrphic($id,$lang_id)
     {

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,updated_at,created_at,approved_at,media_format,media_size,status');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($id)){
         $this->db->where('release_id',$id);
        }
        $this->db->where('media_type','press_release_infographic');      

        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
     }

     public function get_latest_press_release_video($id,$lang_id)
     {

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,created_at,updated_at,approved_at,media_format,media_size,status');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($id)){
         $this->db->where('release_id',$id);
        }
        $this->db->where('media_type','press_release_video');
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
     }

      public function get_latest_pro_categories($lang_id)
     {

        $this->db->select('id,lang_id,name');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }       
         $this->db->order_by('name','ASC');
        $query = $this->db->get('tbl_pru_category');
        return $query->result();
     }

     public function get_latest_photo_galleries($lang_id)
     {

        $this->db->select('id,lang_id,name');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }       
         $this->db->order_by('name','ASC');
        $query = $this->db->get('gallery_albums');
        return $query->result();
     }


     public function get_gallery($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     {

        $this->db->select('gallery.id,gallery.album_id,gallery.title,gallery.content,gallery.summary_desc,gallery.path_small,gallery.path_big,gallery.keywords,
            gallery.updated_at,gallery.created_at');
        $this->db->from('gallery');
        $this->db->join('gallery_albums', 'gallery_albums.id = gallery.album_id');

        if(!empty($lang_id)){
         $this->db->where('gallery.lang_id',$lang_id);
        }
       if(!empty($gallery_category_id)){
         $this->db->where('gallery.album_id',$gallery_category_id);
         } 

       if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('gallery.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('gallery.title',$title,'both',false);
         $this->db->or_like('gallery.summary_desc',$title,'both',false);
         $this->db->or_like('gallery.keywords',$title,'both',false);  
         $this->db->or_like('gallery.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('gallery.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
       // echo $this->db->last_query();
        //die;
        return $query->result();
     }


     public function get_latest_video_galleries($lang_id)
     {

        $this->db->select('id,lang_id,name');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }       
         $this->db->order_by('name','ASC');
        $query = $this->db->get('video_albums');
        return $query->result();
     }



      public function get_videos($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     {

        $this->db->select('video.id,video.cate_id,video.title,video.content,video.summary_desc,video.path_video,video.youtube_link,video.keywords,
            video.updated_at,video.created_at');
        $this->db->from('video');
        $this->db->join('video_albums', 'video.cate_id = video_albums.id');

        if(!empty($lang_id)){
         $this->db->where('video.lang_id',$lang_id);
        }
       if(!empty($gallery_category_id)){
         $this->db->where('video.cate_id',$gallery_category_id);
         } 

       if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('video.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('video.title',$title,'both',false);
         $this->db->or_like('video.summary_desc',$title,'both',false);
         $this->db->or_like('video.keywords',$title,'both',false);  
         $this->db->or_like('video.content',$title,'both',false); 
         $this->db->group_end();     
       }
        $this->db->order_by('video.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
       // echo $this->db->last_query();
        //die;
        return $query->result();
     }

   public function get_audio_galleries($lang_id)
     {

        $this->db->select('id,lang_id,name');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }       
         $this->db->order_by('name','ASC');
        $query = $this->db->get('audio_albums');
        return $query->result();
     }



      public function get_audio($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     {

        $this->db->select('audios.id,audios.audio_album_id,audios.title,audios.content,audios.summary_desc,audios.path_audio,audios.keywords,
            audios.updated_at,audios.created_at');
        $this->db->from('audios');
        $this->db->join('audio_albums', 'audios.audio_album_id = audio_albums.id');

        if(!empty($lang_id)){
         $this->db->where('audios.lang_id',$lang_id);
        }
       if(!empty($gallery_category_id)){
         $this->db->where('audios.audio_album_id',$gallery_category_id);
         } 

       if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('audios.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('audios.title',$title,'both',false);
         $this->db->or_like('audios.summary_desc',$title,'both',false);
         $this->db->or_like('audios.keywords',$title,'both',false);  
         $this->db->or_like('audios.content',$title,'both',false); 
         $this->db->group_end();    
       }
        $this->db->order_by('audios.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
       // echo $this->db->last_query();
        //die;
        return $query->result();
     }

     public function get_infographics_galleries($lang_id)
     {

        $this->db->select('id,lang_id,name');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }       
         $this->db->order_by('name','ASC');
        $query = $this->db->get('infographic_category');
        return $query->result();
     }



      public function get_infographics($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     {

        $this->db->select('infographic.id,infographic.infographic_category,infographic.title,infographic.content,infographic.summary_desc,infographic.path_big,infographic.path_small,infographic.keywords,infographic.updated_at,infographic.created_at');
        $this->db->from('infographic');
        $this->db->join('infographic_category', 'infographic.infographic_category = infographic_category.id');

        if(!empty($lang_id)){
         $this->db->where('infographic.lang_id',$lang_id);
        }
       if(!empty($gallery_category_id)){
         $this->db->where('infographic.infographic_category',$gallery_category_id);
         } 

       if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('infographic.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('infographic.title',$title,'both',false);
         $this->db->or_like('infographic.summary_desc',$title,'both',false);
         $this->db->or_like('infographic.keywords',$title,'both',false);  
         $this->db->or_like('infographic.content',$title,'both',false); 
         $this->db->group_end();    
       }
        $this->db->order_by('infographic.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
       // echo $this->db->last_query();
        //die;
        return $query->result();
     }     

     public function get_latest_sainik_samachar_list($lang_id,$year,$month,$edition,$limit,$start)
     {

        $this->db->select('id,lang_id,title,volume,year,month,biweek_no,keywords,description,document_type,document_path,path_small as cover_image,created_at,updated_at');
        $this->db->from('sainik_pratika_master');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($year)){            
         $this->db->where('year',$year);
        }
        if(!empty($month)){
         $this->db->where('month',$month);
        }
        if(!empty($edition)){
         $this->db->where('biweek_no',$edition);
        }
        
        $this->db->order_by('year','DESC');
        $this->db->order_by('month','DESC');
        $this->db->order_by('biweek_no','DESC');

        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }   
        
        $query = $this->db->get();
        return $query->result();
     }

     public function get_latest_sainik_samachar_details($id)
     {

        $this->db->select('id,lang_id,title,volume,year,month,biweek_no,keywords,description,document_type,document_path,path_small as cover_image,created_at,updated_at');
        $this->db->from('sainik_pratika_master');
        if(!empty($id)){
         $this->db->where('id',$id);
        }       
        
        $query = $this->db->get();
        return $query->result();
     }
     
    public function get_latest_media_invites_list($lang_id,$pro_id,$title,$invite_from_date,$invite_to_date,$limit,$start)
     {

         $this->db->select('media.id,media.lang_id,media.title,media.venue_event,media.pro_category,tbl_pru_category.name as pro_name,media.regional_pro_id,media.name,users.firstname,users.lastname,media.mobile,media.date_of_event,media.reporting_time,media.remark,media.invitees,media.keywords,media.description,media.created_at,media.updated_at');
         $this->db->from('media');
         $this->db->join('users', 'media.regional_pro_id = users.id');
         $this->db->join('tbl_pru_category', 'media.pro_category = tbl_pru_category.id');

       if(!empty($lang_id)){
         $this->db->where('media.lang_id',$lang_id);
        }
       if(!empty($pro_id)){
         $this->db->where('media.pro_category',$pro_id);
         } 

       if(!empty($invite_from_date) && !empty($invite_to_date)){
         $this->db->where('media.date_of_event BETWEEN "'. date('Y-m-d 00:00:00', strtotime($invite_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($invite_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('media.title',$title,'both',false);
         $this->db->or_like('media.keywords',$title,'both',false);
         $this->db->or_like('media.description',$title,'both',false);  
         $this->db->or_like('media.remark',$title,'both',false); 
         $this->db->group_end();    
       }
        $this->db->order_by('media.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }  
        
        $query = $this->db->get();
        return $query->result();
     }  
     
     public function get_latest_media_invite_details($id)
     {

       $this->db->select('media.id,media.lang_id,media.title,media.venue_event,media.pro_category,tbl_pru_category.name as pro_name,media.regional_pro_id,media.name,users.firstname,users.lastname,media.mobile,media.date_of_event,media.reporting_time,media.remark,media.invitees,media.keywords,media.description,media.created_at,media.updated_at');
         $this->db->from('media');
         $this->db->join('users', 'media.regional_pro_id = users.id');
         $this->db->join('tbl_pru_category', 'media.pro_category = tbl_pru_category.id');

        if(!empty($id)){
         $this->db->where('media.id',$id);
        }       
        
        $query = $this->db->get();
        return $query->result();
     }

     public function get_language_master()
     {

        $this->db->select('id,name,language_code');       
         $this->db->order_by('id','ASC');
        $query = $this->db->get('languages');
        return $query->result();
     }

      public function post_app_user_details($user_code,$platform,$created_at,$notification_pros,$preferred_language,$notification_token)
     {
        $data = array(
            'user_code'=> $user_code,
            'platform' => $platform,
            'created_at' => $created_at,
            'notification_pros' => $notification_pros,
            'preferred_language' => $preferred_language,
            'notification_token' => $notification_token
        );

       $this->db->insert('users_app_public', $data);
       return $this->db->insert_id(); 
        //return ($this->db->affected_rows() != 1) ? false : true;
     }

     public function update_app_user_details($id,$notification_pros,$preferred_language,$notification_token)
     {
        $data = array(                       
            'notification_pros' => $notification_pros,
            'preferred_language' => $preferred_language,
            'notification_token' => $notification_token
        );
        $this->db->where('id',$id);
       $this->db->update('users_app_public', $data);
      // return $this->db->insert_id(); 
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 

        //return ($this->db->affected_rows() != 1) ? false : true;
     }

      public function get_pages_list($lang_id)
     {

        $this->db->select('id,lang_id,title,page_content,page_type');       
         $this->db->where('lang_id',$lang_id);
         $this->db->where('page_type','page');
        $query = $this->db->get('pages');
        return $query->result();
     }

      public function get_latest_circular_notifications_list($lang_id,$title,$publish_from_date,$publish_to_date,$limit,$start)
     {

         $this->db->select('circular_management.id,circular_management.lang_id,circular_management.category_id,circular_category.name,circular_management.title,circular_management.circular_number,circular_management.description,circular_management.path,circular_management.created_at,circular_management.file_size,circular_management.document_type');
         $this->db->from('circular_management');
         $this->db->join('circular_category', 'circular_management.category_id = circular_category.id');

       if(!empty($lang_id)){
         $this->db->where('circular_management.lang_id',$lang_id);
        }
       if(!empty($publish_from_date) && !empty($publish_to_date)){
         $this->db->where('circular_management.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($publish_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($publish_to_date)).'"');
       } 
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('circular_management.title',$title,'both',false);
         $this->db->or_like('circular_management.description',$title,'both',false);  
         $this->db->group_end();    
       }
        $this->db->order_by('circular_management.created_at','DESC');
        if(!empty($limit) && !empty($start)){
         $start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }  
        
        $query = $this->db->get();
        return $query->result();
     } 

      public function get_dashboard_first_data($id,$lang_id)
     {
        
        $curr_date = date('Y-m-d');

         $this->db->select('users.pro_category_id');       
         $this->db->where('users.id',$id);         
        $query = $this->db->get('users');
        $user_id= $query->row()->pro_category_id;
        if($user_id>0){
            $query2= $this->db->query("Select (Select count(id) from press_release where pro_category= $user_id and status != 1 and lang_id = $lang_id and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as total_submitted,(Select count(id) from press_release where pro_category=$user_id and lang_id = $lang_id and status = 2 and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as pending_review, (Select count(id) from press_release where pro_category=$user_id and lang_id = $lang_id and status = 3 and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as published, (Select count(id) from press_release where pro_category=$user_id and lang_id = $lang_id and status = 7 and updated_at  BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as unpublished");
        
                $query2->result();
        }
        else{
            $query2= $this->db->query("Select (Select count(id) from press_release where status != 1 and lang_id = $lang_id and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as total_submitted,(Select count(id) from press_release where status = 2  and lang_id = $lang_id and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as pending_review, (Select count(id) from press_release where  status = 3  and lang_id = $lang_id and created_at BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as published, (Select count(id) from press_release where status = 7  and lang_id = $lang_id and updated_at  BETWEEN '".date('Y-m-d 00:00:00', strtotime($curr_date))."' and '".date('Y-m-d 23:59:59', strtotime($curr_date))."') as unpublished");
        
                $query2->result();
        }
       // return $this->db->last_query();
        //return $users->pro_category_id;
        return $query2->result();
     }

     public function get_logo_gallery($limit,$start,$lang_id)
     {

        $this->db->select('lang_id,path_small,updated_at');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        $this->db->order_by('updated_at','DESC');
        if(!empty($limit) && !empty($start)){
        $this->db->limit($limit,$start);
        }
        $query = $this->db->get('logo_gallery');
        return $query->result();
     }
    

}
