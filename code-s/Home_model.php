<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function get_settings_socialmedialinks()
    { 
      $query = $this->db->get('social_media_url');

        return $query->result();
    }

    public function photo($lang_id)
    {
       
        $query = $this->db->query("SELECT * FROM gallery  where lang_id=$lang_id ORDER BY id DESC ");
        return $query->result();
    }

     public function audio_gallery($lang_id)
    {
       
 $query = $this->db->query("SELECT * FROM audios where status = 1 and lang_id = $lang_id ORDER BY updated_at  DESC LIMIT 5");
        return $query->result();
    }
     public function get_settings_twitter()
    { //  $id = 1;
       // $sql = "SELECT * FROM twitter order_by rand() ";
        
            //  $this->db->order_by('id', 'RANDOM');
     // $this->db->limit(1);
      $query = $this->db->get('twitter');

       //echo $this->db->last_query();
        return $query->result();
    }

    public function get_page_lang($lang_id)
    {
        $sql = "SELECT * FROM pages WHERE lang_id =  ? and page_type ='page' and location = 'footer'";
        $query = $this->db->query($sql, array(clean_str($lang_id)));
        return $query->result();
    }
    
    
    
     public function get_site_languages($lang_id)
    { //  $id = 1;
        $sql = "SELECT *  FROM languages where id=".$lang_id."";
        $query = $this->db->query($sql);
        foreach($query->result() as $rlang)
        {
            
            $this->session->set_userdata("language_id", $rlang->id);
            $this->session->set_userdata("language_short_form", $rlang->short_form);    

            
        }
        
        
    }
    
    
     public function get_settings_languages()
    { //  $id = 1;
        $sql = "SELECT * FROM languages order by language_order asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    

     public function get_settings_facebook()
    { //  $id = 1;
        $sql = "SELECT * FROM tbl_facebook ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
     public function get_settings_youtube()
    { //  $id = 1;
        $sql = "SELECT * FROM tbl_youtube ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function youtube_video()
    {
        $query = $this->db->query("SELECT * FROM video  where is_album_cover = 1 and status = 1 ORDER BY id DESC");
        //echo $this->db->last_query();
        return $query->result();
    }

    public function latest_sainik_samachar($lang_id)
    {
        $query = $this->db->query("SELECT * FROM sainik_pratika_master where lang_id = $lang_id ORDER BY year DESC,month DESC,biweek_no DESC");
        //echo $this->db->last_query();
        return $query->result();
    }

    public function get_count() {
      date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $curdate =  date('Y-m-d');
        $query = $this->db->query('SELECT * FROM gallery  where updated_at = " $curdate"');
         return $query->num_rows();
    }

    public function get_audios_count() {
        $query = $this->db->query('SELECT * FROM audios');
         return $query->num_rows();
    }

     public function get_infographics_count() {
        $query = $this->db->query('SELECT * FROM infographic');
         return $query->num_rows();
    }

    public function photo_list($limit, $offset)
    {  
     
       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $curdate =  date('Y-m-d');

       $datarange   = $this->input->post('daterange');
       $cate        = $this->input->post('cate_name');
       $search      = $this->input->post('search');
       $var         = explode('-', $datarange);

       $date        = str_replace('/', '-', $var[0]);
       $date_1      = str_replace('/', '-', $var[1]);

       $start       = date('Y-m-d', strtotime($date));
       $end         = date('Y-m-d', strtotime($date_1));
       
        
    $query = $this->db->query("SELECT * FROM gallery where DATE(created_at) = '$curdate' and status = '1' order by updated_at desc limit $limit , $offset");
     
        return $query->result();
    }

     public function radio_details()
    {  
     
       //die;

       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $curdate =  date('Y-m-d');

       $datarange   = $this->input->post('daterange');
       $cate        = $this->input->post('cate_name');
       $search      = $this->input->post('search');
       $var         = explode('-', $datarange);

       $date        = str_replace('/', '-', $var[0]);
       $date_1      = str_replace('/', '-', $var[1]);

        $start       = date('Y-m-d', strtotime($date));
        $end         = date('Y-m-d', strtotime($date_1));
       

       if(!empty($search) || !empty($cate))
       {
        
            if($search){
            $query = $this->db->query("SELECT * FROM audios where DATE(updated_at) between '$start' and '$end' and audio_albums = '$cate' and title = '$search' order by updated_at desc");
            }else if($cate !='All Category'){
                $query = $this->db->query("SELECT * FROM audios where DATE(updated_at) between '$start' and '$end' and audio_albums = '$cate' order by updated_at desc");
            }else{
                 $query = $this->db->query("SELECT * FROM audios where DATE(updated_at) between '$start' and '$end' order by updated_at desc");
            }
        }else{
        $query = $this->db->query("SELECT * FROM audios where DATE(updated_at) = '$curdate' and is_album_cover = '1' order by updated_at desc");
        }
        //echo '='.$this->db->last_query();
        //die;
        return $query->result();
    }


     public function infographics_details()
    {  
     
       //die;

       date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
       $curdate =  date('Y-m-d');

       $datarange   = $this->input->post('daterange');
       $cate        = $this->input->post('cate_name');
       $search      = $this->input->post('search');
       $var         = explode('-', $datarange);

       $date        = str_replace('/', '-', $var[0]);
       $date_1      = str_replace('/', '-', $var[1]);

        $start       = date('Y-m-d', strtotime($date));
        $end         = date('Y-m-d', strtotime($date_1));
       

       if(!empty($search) || !empty($cate))
       {
        
            if($search){
            $query = $this->db->query("SELECT * FROM infographic where DATE(updated_at) between '$start' and '$end' and infographic_category = '$cate' and title = '$search' order by updated_at desc");
            }else if($cate !='All Category'){
                $query = $this->db->query("SELECT * FROM infographic where DATE(updated_at) between '$start' and '$end' and infographic_category = '$cate' order by updated_at desc");
            }else{
                 $query = $this->db->query("SELECT * FROM infographic where DATE(updated_at) between '$start' and '$end' order by updated_at desc");
            }
        }else{
        $query = $this->db->query("SELECT * FROM infographic where DATE(updated_at) = '$curdate' and is_album_cover = '1' order by updated_at desc");
        }
        //echo '='.$this->db->last_query();
        //die;
        return $query->result();
    }


     public function video_details()
    {  
     
       //die;

       date_default_timezone_set("Asia/Calcutta"); 
       $curdate =  date('Y-m-d');

       $datarange   = $this->input->post('daterange');
       $cate        = $this->input->post('cate_name');
       $search      = $this->input->post('search');
       $var         = explode('-', $datarange);

       $date        = str_replace('/', '-', $var[0]);
       $date_1      = str_replace('/', '-', $var[1]);

        $start       = date('Y-m-d', strtotime($date));
        $end         = date('Y-m-d', strtotime($date_1));
       

        if(!empty($search) || !empty($cate))
       {
        
            if($search){
            $query = $this->db->query("SELECT * FROM video where DATE(updated_at) between '$start' and '$end' and cate_id = '$cate' and title = '$search' order by updated_at desc");
            }else if($cate !='All Category'){
                $query = $this->db->query("SELECT * FROM video where DATE(updated_at) between '$start' and '$end' and cate_id = '$cate' order by updated_at desc");
            }else{
                 $query = $this->db->query("SELECT * FROM video where DATE(updated_at) between '$start' and '$end' order by updated_at desc");
            }
        }else{
        $query = $this->db->query("SELECT * FROM video where DATE(updated_at) = '$curdate' and is_album_cover = '1' order by updated_at desc");
        }
        //echo '=='.$this->db->last_query();
        //die;
        return $query->result();
    }

    public function video_albums($lang_id)
    {
       
        $query = $this->db->query("SELECT * FROM video_albums where lang_id = $lang_id  ORDER BY id asc");
        return $query->result();
    }


     public function photo_categories($lang_id)
    {
       
        $query = $this->db->query("SELECT * FROM gallery_albums where lang_id = $lang_id ORDER BY id asc");
        return $query->result();
    }  
    public function infographic_categories($lang_id)
    {
       
        $query = $this->db->query("SELECT * FROM infographic_category where lang_id = $lang_id  ORDER BY id asc");
        return $query->result();
    }

     public function logo_gallery($lang_id)
    {
       
        $query = $this->db->query("SELECT * FROM logo_gallery where lang_id = $lang_id ORDER BY id asc");
        return $query->result();
    }

    public function infographics_views($id)
    {
       
        $query = $this->db->query("SELECT * FROM infographic where id = '$id'");
        return $query->result();
    }

    public function radio_categories()
    {
       
        $query = $this->db->query("SELECT * FROM audio_albums  ORDER BY id asc");
        return $query->result();
    }

    public function sainik_samachar_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,document_path,month,biweek_no FROM sainik_pratika_master where id = '$id'");
        return $query->result();
      }else{
        $query = $this->db->query("SELECT id,document_path,month,biweek_no FROM sainik_pratika_master ORDER BY updated_at desc limit 1");
        return $query->result();
      }
       
    }

    public function add_feedback($data)
    {
     $query = $this->db->insert('feedback',$data);
     if($query->num_rows > 0){
      return $query; 
      }else{
      return false;
      }
    }

    public function circular_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,path FROM circular_management where id = '$id'");
        return $query->result();
      }else{
        $query = $this->db->query("SELECT id,path FROM circular_management ORDER BY updated_at desc limit 1");
        return $query->result();
      }
       
    }

    public function audio_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,path_audio FROM audios where id = '$id'");
        return $query->result();
     }else{
        $query = $this->db->query("SELECT id,path_audio FROM audios ORDER BY updated_at desc limit 1");
        return $query->result();
     }
       
    }


    public function video_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,path_video FROM video where id = '$id'");
        return $query->result();
     }else{
        $query = $this->db->query("SELECT id,path_video FROM video ORDER BY updated_at desc limit 1");
        return $query->result();
     }
       
    }

    public function image_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,path_small FROM gallery where id = '$id'");
        return $query->result();
      }else{
        $query = $this->db->query("SELECT id,path_small FROM gallery ORDER BY updated_at desc limit 1");
        return $query->result();
      }
       
    }

    public function infographic_image_list_id($id)
    {
      if(!empty($id)){
       $query = $this->db->query("SELECT id,path_small FROM  infographic where id = '$id'");
        return $query->result();
      }else{
        $query = $this->db->query("SELECT id,path_small FROM  infographic ORDER BY updated_at desc limit 1");
        return $query->result();
      }
       
    }

    public function invite($id)
    {
         $this->db->select('a.title,a.venue_event,a.pro_category,a.name,a.mobile,a.status,a.date_of_event,a.reporting_time,a.remark,d.name as invitees,a.keywords,a.description,a.created_at,a.updated_at,b.id,b.name,a.id,c.firstname,c.lastname');
         $this->db->from('media a');
         $this->db->join('tbl_pru_category b', 'b.id = a.pro_category','left');
         $this->db->join('users c', 'c.id = a.regional_pro_id','left');
         $this->db->join('invitees d', 'd.id = a.invitees','left');
         $this->db->where('a.status','1');
         //if(!empty($id)){
         $this->db->where('a.id',$id);
        // }
         //$this->db->order_by('a.updated_at','desc');
        // $this->db->limit(1);
         $query = $this->db->get();
        //echo  $this->db->last_query();
         return $query->result();
       
    }


    public function sainik_samachar_list($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$visibility)
    {    
        $this->db->select('id,lang_id,title,year,month,biweek_no,visibility,volume');
        $this->db->from('sainik_pratika_master');
        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }

        if(empty($visibility)){
         $this->db->where('visibility',1);
        }  
 
        if(!empty($release_from_date) && !empty($release_to_date)){
       
        $this->db->where('year BETWEEN "'. date('Y', strtotime($release_from_date)). '" and "'. date('Y', strtotime($release_to_date)).'"');
        }
        if(!empty($title)){
          $this->db->like('title',$title,'both',false);
        }
        $this->db->order_by('year','DESC');
        $this->db->order_by('month','DESC');
        $this->db->order_by('biweek_no','DESC');
        if(!empty($limit) && !empty($start)){
          if($start == 1){
            $start = 0;

          }
         //$start = ($start - 1) * $limit;
        $this->db->limit($limit,$start);
        }

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $var =  $query->result();
    }

    



      public function pru_cate($lang_id)
    {
        
        if($lang_id==1){      
        $query = $this->db->query("SELECT id,name,lang_id FROM tbl_pru_category  where lang_id ='$lang_id' ORDER BY id asc ");
        }
        else{
            $query = $this->db->query("SELECT pro_parent_id as id,name,lang_id FROM tbl_pru_category  where lang_id ='$lang_id' ORDER BY id asc ");
        }
        return $query->result();
    }
    

    public function press_release($limit,$start,$lang_id)
    {
        
         $this->db->select('b.id,a.id,a.lang_id,a.status,a.pro_category,a.press_release_title,a.feature_image,b.name');
         $this->db->from('press_release a');
         $this->db->join('tbl_pru_category b', 'b.id = a.pro_category','left');
         $this->db->where('a.status','3');
         $this->db->where('a.lang_id',$lang_id);
         $this->db->where('a.status','3');
         $this->db->order_by('a.updated_at','desc');
         $this->db->limit($limit,$start);
         $query = $this->db->get();
         return $query->result();
    }



    public function press_release_list($limit,$start,$lang_id,$pro_category,$release_from_date,$release_to_date,$title,$publish_status)
    {    
         $this->db->select('press_release.id,press_release.pro_category,press_release.press_release_title,
            press_release.press_release_text,press_release.status,press_release.keywords,tbl_pru_category.name,
            press_release.updated_at,press_release.created_at,press_release.approved_at');
        $this->db->from('press_release');
        if($lang_id==1){
            $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.id');
        }
        else{
            $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.pro_parent_id');
        }
        
        if(!empty($lang_id)){
         $this->db->where('press_release.lang_id',$lang_id);
        }
        if(!empty($publish_status)){
         $this->db->where('press_release.status',$publish_status);
        }
         
        if(!empty($pro_category))
         {
        $this->db->where('press_release.pro_category',$pro_category);
        }
        if(!empty($release_from_date) && !empty($release_to_date)){
       
        $this->db->where('approved_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($release_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($release_to_date)).'"');
        }
        if(!empty($title)){
          $this->db->like('press_release_title',$title,'both',false);
        }
        $this->db->order_by('approved_at','DESC');
        if(!empty($limit) && !empty($start)){
          if($start == 1){
            $start = 0;
            $this->db->limit($limit,$start);
          }
       
        }

        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result();
    }



    public function sainik_samachar_num_rows($lang_id,$limit,$start,$year,$month,$edition){

        $this->db->select('*');
        $this->db->from('sainik_pratika_master');

        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
       //if(!empty($visibility)){
         $this->db->where('visibility',1);
        // } 

       if(!empty($year) && !empty($year)){
         $this->db->where('year',$year);
       }  
        if(!empty($month)){
         $this->db->where('month',$month);
         } 
         if(!empty($edition)){
         $this->db->where('biweek_no',$edition);
         } 

        //$this->db->order_by('year','DESC');
        //$this->db->order_by('month','DESC');
        //$this->db->order_by('biweek_no','DESC');
        if(!empty($limit) && !empty($start)){
          //$start = ($start - 1) * $limit;
          //$this->db->limit($limit,$start);
        }         
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rowcount = $query->num_rows();  
    }

    public function get_sainik_samachar_ajax($lang_id,$limit,$start,$year,$month,$edition){

        $this->db->select('id,title,year,month,biweek_no,volume,visibility');
        $this->db->from('sainik_pratika_master');

        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }
       ///if(!empty($visibility)){
         $this->db->where('visibility',1);
       //  } 

        if(!empty($year)){
        $this->db->where('year',$year);
        }else{
        $year = date('Y');
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
           if($start == 1){
            $start = 0;
           }
          $this->db->limit($limit,$start);
        }         
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();  
    }


      public function press_release_num_rows($lang_id,$limit,$start,$pro_category,$release_from_date,$release_to_date,$title){

        $this->db->select('press_release.id,press_release.pro_category,press_release.press_release_title,
            press_release.press_release_text,press_release.status,press_release.keywords,tbl_pru_category.name,
            press_release.updated_at,press_release.created_at,press_release.approved_at');
        $this->db->from('press_release');
        $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.id','left');

        if(!empty($lang_id)){
         $this->db->where('press_release.lang_id',$lang_id);
        }
       if(!empty($pro_category)){
         $this->db->where('press_release.pro_category',$pro_category);
         } 

       if(!empty($release_from_date) && !empty($release_to_date)){
         $this->db->where('press_release.approved_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($release_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($release_to_date)).'"');
       }  
       $this->db->where('press_release.status','3');
       //$this->db->where('press_release.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('press_release.press_release_title',$title,'both',false);
         $this->db->or_like('press_release.press_release_text',$title,'both',false);
         $this->db->or_like('press_release.keywords',$title,'both',false);  
         //$this->db->or_like('press_release.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('press_release.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
 
        //$this->db->limit($limit,$start);
        }         
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();  
    }

    public function get_press_release_web($lang_id,$limit,$start,$pro_category,$release_from_date,$release_to_date,$title){

        $this->db->select('press_release.id,press_release.pro_category,press_release.press_release_title,
            press_release.press_release_text,press_release.status,press_release.keywords,tbl_pru_category.name,
            press_release.updated_at,press_release.created_at,press_release.approved_at');
        $this->db->from('press_release');
        if($lang_id==1){
        $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.id','left');
        }
        else{
            $this->db->join('tbl_pru_category', 'press_release.pro_category = tbl_pru_category.pro_parent_id','left');
        }

        if(!empty($lang_id)){
         $this->db->where('press_release.lang_id',$lang_id);
        }
       if(!empty($pro_category)){
        if($lang_id==1){
         $this->db->where('press_release.pro_category',$pro_category);
        }
        else{
             $this->db->where('press_release.pro_category',$pro_category);
         } 
        }

       if(!empty($release_from_date) && !empty($release_to_date)){
         $this->db->where('press_release.approved_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($release_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($release_to_date)).'"');
       }  
       $this->db->where('press_release.status','3');
       //$this->db->where('press_release.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('press_release.press_release_title',$title,'both',false);
         $this->db->or_like('press_release.press_release_text',$title,'both',false);
         $this->db->or_like('press_release.keywords',$title,'both',false);  
         //$this->db->or_like('press_release.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('press_release.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
          
          if($start == 1){
            $start = 0;
           }
          $this->db->limit($limit,$start);
        }         
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();  
    }


      public function press_release_details($id,$lang_id)
    {
        
         $this->db->select('b.id,a.pro_category,a.lang_id,a.press_release_title,a.feature_image,a.translated_id,b.name,a.press_release_text,a.updated_at,a.approved_at');
         $this->db->from('press_release a');
         $this->db->join('tbl_pru_category b', 'b.id = a.pro_category');
         //$this->db->join('tbl_press_rb.id,a.pro_category,a.press_release_title,a.feature_image,b.namee.id',$id);
          $this->db->where('a.id', $id);
          $this->db->where('a.lang_id', $lang_id);
          $this->db->where('a.status', '3');

         $query = $this->db->get();
        //s echo $this->db->last_query();
         //die;
         return $query->result();
    }

    public function press_release_photos($id,$lang_id)
    {
        
         $this->db->select('b.release_id,a.lang_id,a.id,b.media_type,b.media_path,b.caption');
         $this->db->from('press_release a');
         $this->db->join('tbl_press_release_media b', 'b.release_id = a.id');
         $this->db->where('b.media_type','press_release_image');
         $this->db->where('b.release_id',$id);
         $this->db->where('b.lang_id',$lang_id);
         $query = $this->db->get();
         return $query->result();
    }

      public function press_release_infographic($id,$lang_id)
    {
       
         $this->db->select('b.release_id,a.id,a.lang_id,b.media_type,b.media_path,b.caption');
         $this->db->from('press_release a');
         $this->db->join('tbl_press_release_media b', 'b.release_id = a.id');
         $this->db->where('b.media_type','press_release_infographic');
         $this->db->where('b.release_id',$id);
         $this->db->where('a.lang_id',$lang_id);
         $query = $this->db->get();
         return $query->result();
    }

      public function press_release_video($id,$lang_id)
    {
        
         $this->db->select('b.release_id,a.id,a.lang_id,b.media_type,b.media_path,b.caption');
         $this->db->from('press_release a');
         $this->db->join('tbl_press_release_media b', 'b.release_id = a.id');
         $this->db->where('b.media_type','press_release_video');
         $this->db->where('b.release_id',$id);
         $this->db->where('a.lang_id',$lang_id);
         $query = $this->db->get();
         return $query->result();
    }


    public function get_photo_list($start,$end,$cate_name,$search_value)
    {


         $this->db->select('gallery.id,gallery.album_id,gallery.title,gallery.content,gallery.summary_desc,gallery.path_small,gallery.status,gallery.path_big,gallery.keywords,
            gallery.updated_at,gallery.created_at');

         $this->db->from('gallery');
         $this->db->join('gallery_albums', 'gallery_albums.id = gallery.album_id');
         $this->db->where('gallery.status','1');
         $this->db->where("DATE_FORMAT(gallery.created_at,'%Y-%m-%d') >= '$start'");
         $this->db->where("DATE_FORMAT(gallery.created_at,'%Y-%m-%d') <='$end'");
         //$this->db->where('is_album_cover','1');
         $this->db->where('gallery.album_id',$cate_name);
         $this->db->like('gallery.title',$search_value);
         $this->db->or_like('keywords',$search_value); 
         //$this->db->limit($limit,$start);
         $query = $this->db->get();
         $var =  $query->result();
         //echo $this->db->last_query();
    }

    public function get_paginated_gallery_count()
    {   $time           = strtotime('-14 days');
        $gallery_from_date           = date('Y-m-d', $time);
        $gallery_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('gallery.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
        }
        $query = $this->db->get('gallery');
       //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

     public function get_paginated_gallery_count_two()
    {   //$time           = strtotime('-14 days');
        $gallery_from_date           = date('Y-m-d');
        $gallery_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($gallery_from_date) && !empty($gallery_to_date)){
         $this->db->where('gallery.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($gallery_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($gallery_to_date)).'"');
        }
        $query = $this->db->get('gallery');
       // echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }



    public function get_paginated_media_invite_count()
    {   $time    = strtotime('-14 days');
        $media_invite_from_date           = date('Y-m-d',$time);
        $media_invite_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($media_invite_from_date) && !empty($media_invite_to_date)){
         $this->db->where('media.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($media_invite_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($media_invite_to_date)).'"');
        }
        $query = $this->db->get('media');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

    public function get_paginated_circular_list_count()
    {   $time    = strtotime('-14 days');
        $circular_list_from_date           = date('Y-m-d',$time);
        $circular_list_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($circular_list_from_date) && !empty($circular_list_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($circular_list_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($circular_list_to_date)).'"');
        }
        $query = $this->db->get('circular_management');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

     public function get_paginated_circular_archive_list_count()
    {   
        $circular_list_from_date           = date('Y-m-d');
        $circular_list_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($circular_list_from_date) && !empty($circular_list_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($circular_list_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($circular_list_to_date)).'"');
        }
        $query = $this->db->get('circular_management');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

    public function get_paginated_media_invite_archive_count()
    {   //$time    = strtotime('-14 days');
        $media_invite_from_date           = date('Y-m-d');
        $media_invite_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($media_invite_from_date) && !empty($media_invite_to_date)){
         $this->db->where('media.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($media_invite_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($media_invite_to_date)).'"');
        }
        $query = $this->db->get('media');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }
     


     public function get_photo_web($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     { 
        $this->db->select('gallery.id,gallery.album_id,gallery.title,gallery.content,gallery.summary_desc,gallery.path_small,gallery.status,gallery.is_album_cover,gallery.path_big,gallery.keywords,
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
       $this->db->where('gallery.status','1');
       //$this->db->where('gallery.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('gallery.title',trim($title),'both',false);
         $this->db->or_like('gallery.summary_desc',trim($title),'both',false);
         $this->db->or_like('gallery.keywords',trim($title),'both',false);  
         $this->db->or_like('gallery.content',trim($title),'both',false);
         $this->db->group_end();      
        }
        $this->db->order_by('gallery.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
          if($start == 1){
            $start = 0;
          }
          
          $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
     }


    public function photo_num_rows($lang_id,$limit,$start,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title)
     { 
        $this->db->select('gallery.id,gallery.album_id,gallery.title,gallery.content,gallery.summary_desc,gallery.path_small,gallery.status,gallery.is_album_cover,gallery.path_big,gallery.keywords,
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
       $this->db->where('gallery.status','1');
       //$this->db->where('gallery.is_album_cover','1');
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
          //$start = ($start - 1) * $limit;
          //$this->db->limit($limit,$start);
        }         
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rowcount = $query->num_rows();
     }


    public function get_paginated_infographic_count()
    {
        $time = strtotime('-14 days');
        $infographic_from_date = date("Y-m-d",$time);
        $infographic_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($infographic_from_date) && !empty($infographic_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($infographic_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($infographic_to_date)).'"');
        }
        $query = $this->db->get('infographic');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

     public function get_paginated_infographic_count_two()
    {
        //$time = strtotime('-14 days');
        $infographic_from_date = date("Y-m-d");
        $infographic_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($infographic_from_date) && !empty($infographic_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($infographic_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($infographic_to_date)).'"');
        }
        $query = $this->db->get('infographic');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }

      public function get_infographic_web($lang_id,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title)
     { 

    
        $this->db->select('infographic.id,infographic.infographic_category,infographic.title,infographic.content,infographic.summary_desc,infographic.path_small,infographic.status,infographic.is_album_cover,infographic.path_big,infographic.keywords,
            infographic.updated_at,infographic.created_at');
        $this->db->from('infographic');
        $this->db->join('infographic_category', 'infographic_category.id = infographic.infographic_category');

        if(!empty($lang_id)){
         $this->db->where('infographic.lang_id',$lang_id);
        }
       if(!empty($infographic_category_id)){
         $this->db->where('infographic.infographic_category',$infographic_category_id);
         } 

       if(!empty($infographic_from_date) && !empty($infographic_to_date)){
         $this->db->where('infographic.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($infographic_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($infographic_to_date)).'"');
       } 
       $this->db->where('infographic.status','1');
       //$this->db->where('infographic.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('infographic.title',trim($title),'both',false);
         $this->db->or_like('infographic.summary_desc',trim($title),'both',false);
         $this->db->or_like('infographic.keywords',trim($title),'both',false);  
         $this->db->or_like('infographic.content',trim($title),'both',false);
         $this->db->group_end();      
        }
        $this->db->order_by('infographic.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
           if($start == 1){
            $start = 0;
           }
          $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result();
     }


      public function infographic_num_rows($lang_id,$limit,$start,$infographic_category_id,$infographic_from_date,$infographic_to_date,$title)
     { 


        $this->db->select('infographic.id,infographic.infographic_category,infographic.title,infographic.content,infographic.summary_desc,infographic.path_small,infographic.status,infographic.is_album_cover,infographic.path_big,infographic.keywords,
            infographic.updated_at,infographic.created_at');
        $this->db->from('infographic');
        $this->db->join('infographic_category', 'infographic_category.id = infographic.infographic_category');

        if(!empty($lang_id)){
         $this->db->where('infographic.lang_id',$lang_id);
        }
       if(!empty($infographic_category_id)){
         $this->db->where('infographic.infographic_category',$infographic_category_id);
         } 

       if(!empty($infographic_from_date) && !empty($infographic_to_date)){
         $this->db->where('infographic.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($infographic_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($infographic_to_date)).'"');
       } 
       $this->db->where('infographic.status','1');
       //$this->db->where('infographic.is_album_cover','1');
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

        }          
        $query = $this->db->get();
        return $rowcount = $query->num_rows();
      
  }

    public function media_invite_num_rows($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title)
     { 


        $this->db->select('media.id,media.regional_pro_id,tbl_pru_category.id,tbl_pru_category.name,media.name,media.pro_category,media.title,media.description,media.status,,media.keywords,
            media.updated_at,media.created_at');
        $this->db->from('media');
        $this->db->join('tbl_pru_category', 'tbl_pru_category.id = media.pro_category','left');
        $this->db->join('users','users.id = media.regional_pro_id','left');

        if(!empty($lang_id)){
         $this->db->where('media.lang_id',$lang_id);
        }
       if(!empty($media_invite_category_id)){
         $this->db->where('media.pro_category',$media_invite_category_id);
         } 
        if(!empty($media_invite_regional_pro_id)){
         $this->db->where('media.pro_category',$media_invite_category_id);
         } 

       if(!empty($media_invite_from_date) && !empty($media_invite_to_date)){
         $this->db->where('media.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($media_invite_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($media_invite_to_date)).'"');
       } 
       $this->db->where('media.status','1');
       //$this->db->where('infographic.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('media.title',$title,'both',false);
         $this->db->or_like('media.description',$title,'both',false);
         $this->db->or_like('media.keywords',$title,'both',false);  
        // $this->db->or_like('media.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('media.updated_at','DESC');
        if(!empty($limit) && !empty($start)){

        }          
        $query = $this->db->get();
        return $rowcount = $query->num_rows();
      
  }

    public function circular_list_num_rows($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title)
     { 
        $this->db->select('*');
        $this->db->from('circular_management');

        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }

       if(!empty($circular_list_from_date) && !empty($circular_list_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($circular_list_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($circular_list_to_date)).'"');
       } 
       $this->db->where('status','1');
       //$this->db->where('infographic.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('title',$title,'both',false);
         $this->db->or_like('description',$title,'both',false);
         //$this->db->or_like('media.keywords',$title,'both',false);  
        // $this->db->or_like('media.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('updated_at','DESC');
        if(!empty($limit) && !empty($start)){

        }          
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rowcount = $query->num_rows();
      
  }

      public function get_circular_list_web($lang_id,$limit,$start,$circular_list_from_date,$circular_list_to_date,$title)
     { 
        $this->db->select('*');
        $this->db->from('circular_management');

        if(!empty($lang_id)){
         $this->db->where('lang_id',$lang_id);
        }

       if(!empty($circular_list_from_date) && !empty($circular_list_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($circular_list_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($circular_list_to_date)).'"');
       } 
       $this->db->where('status','1');
       //$this->db->where('infographic.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('title',$title,'both',false);
         $this->db->or_like('description',$title,'both',false);
         //$this->db->or_like('media.keywords',$title,'both',false);  
        // $this->db->or_like('media.content',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('updated_at','DESC');
        if(!empty($limit) && !empty($start)){
           //if($start == 1){
            //$start = 0;
            $this->db->limit($limit,$start);
          //}
        }          
        $query = $this->db->get();
         //echo $this->db->last_query();
        return $query->result();
      
  }



    public function get_media_invite_web($lang_id,$limit,$start,$media_invite_category_id,$media_invite_from_date,$media_invite_to_date,$title)
     { 


        $this->db->select('media.id,media.regional_pro_id,tbl_pru_category.name,media.pro_category,media.title,media.description,media.status,media.mobile,media.keywords,media.remark,media.venue_event,media.invitees,users.firstname,users.lastname,media.updated_at,media.created_at');
        $this->db->from('media');
        $this->db->join('tbl_pru_category', 'tbl_pru_category.id = media.pro_category','left');
        $this->db->join('users','users.id = media.regional_pro_id','left');

        if(!empty($lang_id)){
         $this->db->where('media.lang_id',$lang_id);
        }
       if(!empty($media_invite_category_id)){
         $this->db->where('media.pro_category',$media_invite_category_id);
         } 
        if(!empty($media_invite_regional_pro_id)){
         $this->db->where('media.pro_category',$media_invite_category_id);
         } 

       if(!empty($media_invite_from_date) && !empty($media_invite_to_date)){
         $this->db->where('media.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($media_invite_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($media_invite_to_date)).'"');
       } 
       $this->db->where('media.status','1');
       //$this->db->where('infographic.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('media.title',$title,'both',false);
         $this->db->or_like('media.description',$title,'both',false);
         $this->db->or_like('media.keywords',$title,'both',false);  
         $this->db->or_like('media.venue_event',$title,'both',false);
         $this->db->group_end();      
       }
        $this->db->order_by('media.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
          if($start == 1){
            $start = 0;
          }
         $this->db->limit($limit,$start);
        }          
        $query = $this->db->get();
        return $query->result();
      
  }
  public function get_paginated_sainik_samachar_count($lang_id)
  {
      $press_release_from_date           = date('Y');
      $press_release_to_date             = date('Y');

      $this->db->select('COUNT(id) AS count');
       if(!empty($press_release_from_date) && !empty($press_release_to_date)){
       $this->db->where('year BETWEEN "'. date('Y', strtotime($press_release_from_date)). '" and "'. date('Y', strtotime($press_release_to_date)).'"');
      }
      $this->db->where('visibility',1);
       $this->db->where('lang_id',$lang_id);
      $query = $this->db->get('sainik_pratika_master');
      return $query->row()->count;
  }


   public function get_paginated_press_release_count($lang_id,$pro_category)
    {
        $press_release_from_date           = date('Y-m-d',(strtotime ( '-29 day' , strtotime (date('Y-m-d')) ) ));
        $press_release_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count,status');
         if(!empty($press_release_from_date) && !empty($press_release_to_date)){
         $this->db->where('approved_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($press_release_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($press_release_to_date)).'"');
        }
        $this->db->where('status',3);
        $this->db->where('lang_id',$lang_id);
        if(!empty($pro_category)) {
        $this->db->where('pro_category',$pro_category);
        }
        $query = $this->db->get('press_release');
       // echo $this->db->last_query();
       // die;
        return $query->row()->count;
    }


    public function get_paginated_video_count()
    {    
        $video_from_date           = date('Y-m-d');
        $video_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($video_from_date) && !empty($video_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($video_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($video_to_date)).'"');
        }
        $query = $this->db->get('video');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }


    public function get_paginated_video_count_two()
    {   
        $time = strtotime('-14 days'); 
        $video_from_date           = date('Y-m-d',$time);
        $video_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($video_from_date) && !empty($video_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($video_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($video_to_date)).'"');
        }
        $query = $this->db->get('video');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }


    public function get_video_web($lang_id,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title)
     { 
   
        $this->db->select('video.id,video.cate_id,video.title,video.link,video.content,video.summary_desc,video.path_video,video.status,video.is_album_cover,video.keywords,video.path_image,video.youtube_link,    
            video.updated_at,video.created_at');
        $this->db->from('video');
        $this->db->join('video_albums', 'video_albums.id = video.cate_id');

        

        if(!empty($lang_id)){
         $this->db->where('video.lang_id',$lang_id);
        }
       if(!empty($video_category_id)){
         $this->db->where('video.cate_id',$video_category_id);
         } 

       if(!empty($video_from_date) && !empty($video_to_date)){
           $videos_list = $this->uri->segment(1);
          if($videos_list == 'videos-list'){
            $this->db->where('video.created_at BETWEEN "'.$video_from_date. '" and "'.$video_to_date.'"');
          }else{
            $this->db->where('video.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($video_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($video_to_date)).'"');
          }

       } 
       $this->db->where('video.status','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('video.title',trim($title),'both',false);
         $this->db->or_like('video.summary_desc',trim($title),'both',false);
         $this->db->or_like('video.keywords',trim($title),'both',false);  
         $this->db->or_like('video.content',trim($title),'both',false);
         $this->db->group_end();      
        }
        $this->db->order_by('video.updated_at','DESC');
        if(!empty($limit) && !empty($start)){
          if($start == 1){
            $start = 0;
          }
          $this->db->limit($limit,$start);
        }           

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
     }

      public function video_num_rows($lang_id,$limit,$start,$video_category_id,$video_from_date,$video_to_date,$title)
     { 


        $this->db->select('video.id,video.cate_id,video.title,video.content,video.summary_desc,video.path_video,video.status,video.is_album_cover,video.keywords,
            video.updated_at,video.created_at');
        $this->db->from('video');
        $this->db->join('video_albums', 'video_albums.id = video.cate_id');

        if(!empty($lang_id)){
         $this->db->where('video.lang_id',$lang_id);
        }
       if(!empty($video_category_id)){
         $this->db->where('video.cate_id',$video_category_id);
         } 

       if(!empty($video_from_date) && !empty($video_to_date)){
         $this->db->where('video.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($video_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($video_to_date)).'"');
       } 
       $this->db->where('video.status','1');
       //$this->db->where('video.is_album_cover','1');
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

        }         
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $rowcount = $query->num_rows();
       
     }


      public function get_paginated_audio_count()
    {
        $audio_from_date           = date('Y-m-d');
        $audio_to_date             = date('Y-m-d');

        $this->db->select('COUNT(id) AS count');
         if(!empty($audio_from_date) && !empty($audio_to_date)){
         $this->db->where('created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($audio_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($audio_to_date)).'"');
        }

        $query = $this->db->get('audios');
        //echo $this->db->last_query();
        //die;
        return $query->row()->count;
    }


      public function get_audio_web($lang_id,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title)
     { 

    
        $this->db->select('audios.id,audios.audio_album_id,audios.title,audios.content,audios.summary_desc,audios.path_audio,audios.status,audios.is_album_cover,audios.keywords,
            audios.updated_at,audios.created_at');
        $this->db->from('audios');
        $this->db->join('audio_albums', 'audio_albums.id = audios.audio_album_id');

        if(!empty($lang_id)){
         $this->db->where('audios.lang_id',$lang_id);
        }
       if(!empty($audio_category_id)){
         $this->db->where('audios.audio_album_id',$audio_category_id);
         } 

       if(!empty($audio_from_date) && !empty($audio_to_date)){
         $this->db->where('audios.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($audio_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($audio_to_date)).'"');
       } 
       $this->db->where('audios.status','1');
       //$this->db->where('video.is_album_cover','1');
       if(!empty($title)){
         $this->db->group_start();
         $this->db->like('audios.title',trim($title),'both',false);
         $this->db->or_like('audios.summary_desc',trim($title),'both',false);
         $this->db->or_like('audios.keywords',trim($title),'both',false);  
         $this->db->or_like('audios.content',trim($title),'both',false);
         $this->db->group_end();      
        }
        $this->db->order_by('audios.created_at','DESC');
        if(!empty($limit) && !empty($start)){
           if($start == 1){
            $start = 0;
           }
          $this->db->limit($limit,$start);
        }         
        $query = $this->db->get();       
        return $query->result();
     }


      public function audio_num_rows($lang_id,$limit,$start,$audio_category_id,$audio_from_date,$audio_to_date,$title)
     { 

        $this->db->select('audios.id,audios.audio_album_id,audios.title,audios.content,audios.summary_desc,audios.path_audio,audios.status,audios.is_album_cover,audios.keywords,
            audios.updated_at,audios.created_at');
        $this->db->from('audios');
        $this->db->join('audio_albums', 'audio_albums.id = audios.audio_album_id');

        if(!empty($lang_id)){
         $this->db->where('audios.lang_id',$lang_id);
        }
       if(!empty($audio_category_id)){
         $this->db->where('audios.audio_album_id',$audio_category_id);
         } 

       if(!empty($audio_from_date) && !empty($audio_to_date)){
         $this->db->where('audios.created_at BETWEEN "'. date('Y-m-d 00:00:00', strtotime($audio_from_date)). '" and "'. date('Y-m-d 23:59:59', strtotime($audio_to_date)).'"');
       } 
       $this->db->where('audios.status','1');
       //$this->db->where('audio.is_album_cover','1');
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
            //$this->db->limit($limit,$start);
        }                 
        $query = $this->db->get();
        return $rowcount = $query->num_rows();
      
     }


    
}