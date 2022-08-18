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

        $this->db->select('id,lang_id,press_release_title,date_of_event,keywords,press_release_text,feature_image,release_sub_heading,updated_at,status');
        
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }

        if(!empty($id)){
         $this->db->where('id',$id);
        }

        $query = $this->db->get('press_release');
        return $query->result();
    }


     public function get_latest_press_release_photo($id,$lang_id)
     {

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,created_at,updated_at,status');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($id)){
         $this->db->where('release_id',$id);
        }
        $this->db->where('media_type','strip_tags(press_release_image)');
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
     }

     public function get_latest_press_release_infogrphic($id,$lang_id)
     {

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,updated_at,created_at,status');
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

        $this->db->select('id,lang_id,release_id,media_type,media_path,caption,created_at,updated_at,status');
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
         $this->db->like('gallery.title',$title,'both',false);
         $this->db->or_like('gallery.summary_desc',$title,'both',false);
         $this->db->or_like('gallery.keywords',$title,'both',false);  
         $this->db->or_like('gallery.content',$title,'both',false);     
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
         $this->db->like('video.title',$title,'both',false);
         $this->db->or_like('video.summary_desc',$title,'both',false);
         $this->db->or_like('video.keywords',$title,'both',false);  
         $this->db->or_like('video.content',$title,'both',false);     
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



     public function get_latest_sainik_samachar($lang_id)
     {

        $this->db->select('*');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        $this->db->order_by('updated_at','DESC');
        $this->db->limit(1);
        $query = $this->db->get('sainik_pratika_master');
        return $query->result();
     }

     public function get_latest_sainik_samachar_list($lang_id,$year,$month,$edition)
     {

        $this->db->select('*');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
        if(!empty($year) && !empty($month) && !empty($edition)){
         $this->db->where('year',$year);
         $this->db->where('month',$month);
         $this->db->where('edition',$edition);
        }
        $this->db->order_by('updated_at','DESC');
        $this->db->limit(1);
        $query = $this->db->get('sainik_pratika_master');
        return $query->result();
     }


     
      public function get_audio($lang_id,$audio_category,$audio_date,$audio_date_to,$title,$limit,$start)
     {

        $this->db->select('audios.title,audios.content,audios.summary_desc,audios.path_audio,audios.audio_cat_id,audios.id,
            audio_categories.id,audios.updated_at');
        $this->db->from('audios');
        $this->db->join('audio_categories', 'audios.audio_cat_id = audio_categories.id');

        if(!empty($lang_id)){
         $this->db->where('audios.lang_id',$lang_id);
        }

        $this->db->order_by('audios.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
        $this->db->limit($limit,$start);
        }

        if(!empty($audio_category) && !empty($audio_date) && !empty($audio_date_to) && !empty($title)){
        $this->db->where('audios.category',$audio_category);
        $this->db->like('audios.title',"%$title%");
        $this->db->where('audios.updated_at BETWEEN "'. date('Y-m-d', strtotime($audio_date)). '" and "'. date('Y-m-d', strtotime($audio_date_to)).'"');
        }

        $query = $this->db->get();
        return $query->result();
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
