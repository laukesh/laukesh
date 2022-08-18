<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    //input values
    public function input_values()
    {
         $data = array(
            'lang_id'        => $this->input->post('lang_id', true),
            'name'           => $this->input->post('name', true),
            'slug'           => $this->input->post('slug', true),
            'title'          => $this->input->post('title', true),
            'description'    => $this->input->post('description', true),
            'keyword'        => $this->input->post('keyword', true),
            'is_active'      => $this->input->post('is_active', true),
            'is_headquarter' => $this->input->post('is_headquarter', true)
        );
        return $data;
    }

    //add category
    public function add_category()
    {
        $data = $this->input_values();
        if (empty($data["slug"])) {
            //slug for title
            $data["slug"] = str_slug($data["name"]);
        } else {
            $data["slug"] = remove_special_characters($data["slug"], true);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = $this->auth_user->id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->auth_user->id;
        return $this->db->insert('tbl_pru_category', $data);
    }

    //add subcategory
    public function add_subcategory()
    {
        $data = $this->input_values();

        $category = $this->get_category($data["parent_id"]);
        if ($category) {
            $data["color"] = $category->color;
        } else {
            $data["color"] = "#0a0a0a";
        }

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug($data["name"]);
        } else {
            $data["name_slug"] = remove_special_characters($data["name_slug"], true);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('categories', $data);
    }

    //update slug
    public function update_slug($id)
    {
        $category = $this->get_category($id);
        if (!empty($category)) {
            if (empty($category->name_slug) || $category->name_slug == "-") {
                $data = array(
                    'name_slug' => $category->id
                );
                $this->db->where('id', $category->id);
                $this->db->update('categories', $data);
            } else {
                if ($this->check_slug_exists($category->name_slug, $category->id) == true) {
                    $data = array(
                        'name_slug' => $category->name_slug . "-" . $category->id
                    );
                    $this->db->where('id', $id);
                    $this->db->update('categories', $data);
                }
            }
        }
    }

    //check slug
    public function check_slug_exists($slug, $id)
    {
        $sql = "SELECT * FROM categories WHERE categories.name_slug = ? AND categories.id != ?";
        $query = $this->db->query($sql, array(clean_str($slug), clean_number($id)));
        if (!empty($query->row())) {
            return true;
        }
        return false;
    }

    //get category
    public function get_category($id)
    {
        $sql = "SELECT categories.*, (SELECT name_slug FROM categories AS tbl_categories WHERE tbl_categories.id = categories.parent_id) as parent_slug FROM categories WHERE categories.id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //get category by slug
    public function get_category_by_slug($slug)
    {
        $sql = "SELECT categories.*, (SELECT name_slug FROM categories AS tbl_categories WHERE tbl_categories.id = categories.parent_id) as parent_slug FROM categories WHERE categories.name_slug =  ?";
        $query = $this->db->query($sql, array(clean_str($slug)));
        return $query->row();
    }

    //get parent categories
    public function get_parent_categories()
    {
        $query = $this->db->query("SELECT * FROM categories WHERE categories.parent_id = 0 ORDER BY created_at DESC");
        return $query->result();
    }

    //get parent categories by lang
    public function get_parent_categories_by_lang($lang_id)
    {
        $sql = "SELECT * FROM categories WHERE categories.parent_id = 0 AND categories.lang_id =  ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

    //get categories
    public function get_categories()
    {
        $query = $this->db->query("SELECT * FROM tbl_pru_category where is_active = 1 ORDER BY created_at DESC");
        return $query->result();
    }



    public function get_invitees()
    {
        $query = $this->db->query("SELECT * FROM invitees ORDER BY id ASC");
        return $query->result();
    }

     public function get_categories_val($id)
    {
        $sql = "SELECT * FROM tbl_pru_category WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

    //get categories by lang
    public function get_categories_by_lang($lang_id)
    {
        $sql = "SELECT categories.*, (SELECT name_slug FROM categories AS tbl_categories WHERE tbl_categories.id = categories.parent_id) as parent_slug FROM categories WHERE categories.lang_id =  ? ORDER BY category_order";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

    //get subcategories
    public function get_subcategories()
    {
        $query = $this->db->query("SELECT * FROM categories WHERE categories.parent_id != 0");
        return $query->result();
    }

    //get subcategories by lang
    public function get_subcategories_by_lang($lang_id)
    {
        $sql = "SELECT * FROM categories WHERE categories.parent_id != 0 AND categories.lang_id =  ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

    //get subcategories by parent id
    public function get_subcategories_by_parent_id($parent_id)
    {
        $sql = "SELECT * FROM categories WHERE categories.parent_id = ?";
        $query = $this->db->query($sql, array(clean_number($parent_id)));
        return $query->result();
    }

    //get category count
    public function get_category_count()
    {
        $sql = "SELECT COUNT(categories.id) AS count FROM categories";
        $query = $this->db->query($sql);
        return $query->row()->count;
    }

    //update category
    public function update_category($id)
    {
        $id = clean_number($id);
        $data = $this->input_values();
        if (empty($data["slug"])) {
            //slug for title
            $data["slug"] = str_slug($data["name"]);
        } else {
            $data["slug"] = remove_special_characters($data["slug"], true);
        }


        $this->db->where('id', $id);
        return $this->db->update('tbl_pru_category', $data);
    }

    //update subcategory color
    public function update_subcategories_color($parent_id, $color)
    {
        $categories = $this->get_subcategories_by_parent_id($parent_id);
        if (!empty($categories)) {
            foreach ($categories as $item) {
                $data = array(
                    'color' => $color,
                );
                $this->db->where('parent_id', $parent_id);
                return $this->db->update('categories', $data);
            }
        }
    }

    //delete category
    public function delete_category($id)
    {
            $this->db->where('id', $id);
            return $this->db->delete('tbl_pru_category');
        
    }


    // press realse type

    public function input_values_type()
    {
         $data = array(
            'lang_id'        => $this->input->post('lang_id', true),
            'name'           => $this->input->post('name', true),
            'status'         => $this->input->post('status', true)

        );
        return $data;
    }

    public function add_press_release_type()
    {
        $data = $this->input_values_type();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = $this->auth_user->id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->auth_user->id;
        return $this->db->insert('press_release_type', $data);
    }


     public function get_press_realease_type()
    {
        $query = $this->db->query("SELECT * FROM press_release_type where status = 1");
        return $query->result();
    }

     public function get_press_realease_service()
    {
        $query = $this->db->query("SELECT * FROM services where status = 1");
        return $query->result();

    }

    public function get_press_realease_by_user()
    {
        $query = $this -> db
           -> select('*')
           -> where('created_by', $this->auth_user->id)
           -> where('is_active', 1)
           -> where('status', 3)
           -> get('press_release');
          return $query->result();
    }


     public function get_press_release_type($id)
    {
        $sql = "SELECT * FROM press_release_type WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

    public function get_view_press_release_show($id)
    {
        $sql = "SELECT * FROM press_release WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

    public function get_view_press_release_update_show($id)
    {
        $sql = "SELECT * FROM press_release_history_log WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }


    public function get_view_press_release_video_show($id)
    {
        //$this->filter_press_release();
        $this->db->where('media_type', 'press_release_video');
        $this->db->where_in('release_id', $id);
        $this->db->where('status_img', 1);
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
    }


    public function get_view_press_release_image_show($id)
    {
        //$this->filter_press_release();
        $this->db->where('media_type', 'press_release_image');
        $this->db->where('release_id', $id);
        $this->db->where('status_img', 1);
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
    }

 

    public function get_view_press_release_infographic_show($id)
    {
        //$this->filter_press_release();
        $this->db->where('media_type', 'press_release_infographic');
        $this->db->where('release_id', $id);
        $this->db->where('status_img', 1);
        //$this->db->limit($per_page, $offset);
        $query = $this->db->get('tbl_press_release_media');
        return $query->result();
    }

    public function get_view_press_release_infographic_update_show($id)
    {
        //echo $id;die;
        //$this->filter_press_release();
        $this->db->where('media_type', 'press_release_infographic');
        $this->db->where('press_release_row_id', $id);
        $this->db->where('status', 2);
        //$this->db->where('press_release_type', 2);
        $this->db->where('status_img', 1);
        $query = $this->db->get('tbl_press_release_media_history_log');
        return $query->result();
    }

       public function get_view_press_release_image_update_show($id)
    {
        $this->db->where('media_type', 'press_release_image');
        $this->db->where_in('press_release_row_id', $id);
        $this->db->where('status_img', 1);
        //$this->db->where('press_release_type', 2);
        $query = $this->db->get('tbl_press_release_media_history_log');
        return $query->result();
    }

    public function get_view_press_release_video_update_show($id)
    {
        //$this->filter_press_release();
        $this->db->where('media_type', 'press_release_video');
        $this->db->where_in('press_release_row_id', $id);
        $this->db->where('status_img', 1);
        //$this->db->where('press_release_type', 2);
        $query = $this->db->get('tbl_press_release_media_history_log');
        return $query->result();
    }

    public function update_press_realease_type($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_type();

        $this->db->where('id', $id);
        return $this->db->update('press_release_type', $data);
    }

     public function delete_press_release_type($id)
    {
            $this->db->where('id', $id);
            return $this->db->delete('press_release_type');
        
    }

    public function get_pro_category($id)
    {
        $sql = "SELECT * FROM tbl_pru_category WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

     public function get_pro_category_by_lang($lang_id)
    {
        $sql = "SELECT * FROM tbl_pru_category WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }


    public function input_values_press()
    {

    $date_var = $this->input->post('date_of_event');
    $orgDate =str_replace("/","-",$date_var);
    $date_of_event =  date("Y-m-d", strtotime($orgDate));

    $date_var2 = $this->input->post('schedule_for_publish');
    $orgDate2 =str_replace("/","-",$date_var2);
    $schedule_for_publish =  date("Y-m-d H:i:s", strtotime($orgDate2));

    $data = array(
        'pro_category'              => $this->input->post('press_release_category', true),
        'lang_id'                   => $this->input->post('lang_id', true),
        'press_release_type'        => $this->input->post('press_release_type', true),        
        'date_of_event'             => $date_of_event,
        'event_subject'             => $this->input->post('event_subject', true),
        'location'                  => $this->input->post('location', true),
        'service'                   => $this->input->post('service', true),
        'other'                     => $this->input->post('other', true),
        'keywords'                  => $this->input->post('keywords', true),
        'press_release_title'       => $this->input->post('press_release_title', true),
        'release_sub_heading'       => $this->input->post('release_sub_heading', true),
        'press_release_text'        => $this->input->post('press_release_text', true),   
        'status'                    => $this->input->post('status', true),             
        'prepared_by_email'         => $this->input->post('who_prepared', true),             
        'reviewed_by_email'         => $this->input->post('who_reviewed', true),                        
        'schedule_for_publish'      => $schedule_for_publish                     
        );

      // echo '<pre>';print_r($data);
        //die();

        return $data;
    }


    public function add_press_realease()
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        
        $press_release_type      = $this->input->post('press_release_type');
        $press_release_category  = $this->input->post('press_release_category');
        $press_release_ids       = $this->input->post('press_release_ids');
        $status                  = $this->input->post('status');   

        $date_var = $this->input->post('date_of_event');
        $orgDate =str_replace("/","-",$date_var);
        $date_of_event =  date("Y-m-d", strtotime($orgDate));

         $date_var2 = $this->input->post('schedule_for_publish');
         $orgDate2 =str_replace("/","-",$date_var2);
         $schedule_for_publish =  date("Y-m-d H:i:s", strtotime($orgDate2));

        $this->db->where('id', $press_release_ids);
         $q = $this->db->get('press_release')->row();

         //$pro_name = $this->auth_model->get_pro_by_key($this->auth_user->pro_category_id);
         $pro_val = $this->auth_user->firstname.' '.$this->auth_user->lastname;
         $press_release_title  = $this->input->post('press_release_title');

            if($press_release_type == '3' && $status == '2'){
            $action = 'Withdrawl for Requested';
            }else if($press_release_type == '2' && $status == '2'){
                $action = 'Update for Requested';
            }else if($press_release_type == '1' && $status == '2'){
                $action = 'Submitted';
            }else if($press_release_type == '1' && $status == '3'){
                $action = 'Published';
            }else if($press_release_type == '1' && $status == '4'){
                $action = 'Scheduled for Published';
            }
       
        if($this->auth_user->role == 'pro_admin'){
         $pro_name = $this->auth_model->get_pro_by_key($this->auth_user->pro_category_id);
         $title = $pro_name->name.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '.$action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);

        }else{
     
         $title = 'admin'.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '. $action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);
         
        }
         $notification = array(
                              'pro_id'             => $this->auth_user->pro_category_id,
                              'item_id'            => $press_release_ids,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Submitted',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                               );
        

        if($status == '3'){
            
        $data = array(
                      'approved_at'           => date('Y-m-d H:i:s',$t), 
                      'approved_by'           => $this->auth_user->id,
                      'created_at'            => date('Y-m-d H:i:s',$t), 
                      'created_by'            => $this->auth_user->id,
                      'updated_at'            => date('Y-m-d H:i:s',$t), 
                      'updated_by'            => $this->auth_user->id,
                      'status'                => $this->input->post('status'),
                      'pro_category'          => $this->input->post('press_release_category', true),
                      'lang_id'               => $this->input->post('lang_id', true),
                      'press_release_type'    => $this->input->post('press_release_type', true),        
                      'date_of_event'         => $date_of_event,
                      'event_subject'         => $this->input->post('event_subject', true),
                      'location'              => $this->input->post('location', true),
                      'service'               => $this->input->post('service', true),
                      'other'                 => $this->input->post('other', true),
                      'keywords'              => $this->input->post('keywords', true),
                      'press_release_title'   => $this->input->post('press_release_title', true),
                      'release_sub_heading'   => $this->input->post('release_sub_heading', true),
                      'press_release_text'    => $this->input->post('press_release_text', true),   
                      'status'                => $this->input->post('status', true),             
                      'prepared_by_email'     => $this->input->post('who_prepared', true),             
                      'reviewed_by_email'     => $this->input->post('who_reviewed', true),                        
                      'schedule_for_publish'  => $schedule_for_publish
                      );
         }else if($status == '2' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || 
            $status == '8')
          {
          
        $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                      'updated_by'            => $this->auth_user->id,
                      'created_by'            => $this->auth_user->id,
                      'created_at'            => date('Y-m-d H:i:s',$t), 
                      'status'                => $this->input->post('status'),
                      'pro_category'          => $this->input->post('press_release_category', true),
                      'lang_id'               => $this->input->post('lang_id', true),
                      'press_release_type'    => $this->input->post('press_release_type', true),        
                      'date_of_event'         => $date_of_event,
                      'event_subject'         => $this->input->post('event_subject', true),
                      'location'              => $this->input->post('location', true),
                      'service'               => $this->input->post('service', true),
                      'other'                 => $this->input->post('other', true),
                      'keywords'              => $this->input->post('keywords', true),
                      'press_release_title'   => $this->input->post('press_release_title', true),
                      'release_sub_heading'   => $this->input->post('release_sub_heading', true),
                      'press_release_text'    => $this->input->post('press_release_text', true),   
                      'status'                => $this->input->post('status', true),             
                      'prepared_by_email'     => $this->input->post('who_prepared', true),             
                      'reviewed_by_email'     => $this->input->post('who_reviewed', true),                        
                      'schedule_for_publish'  => $schedule_for_publish
                        );

          }else{
             
                           
        $data = array('created_at'            => date('Y-m-d H:i:s',$t), 
                      'updated_at'            => date('Y-m-d H:i:s',$t), 
                      'created_by'            => $this->auth_user->id,
                      'status'                => $this->input->post('status'),
                      'pro_category'          => $this->input->post('press_release_category', true),
                      'lang_id'               => $this->input->post('lang_id', true),
                      'press_release_type'    => $this->input->post('press_release_type', true),        
                      'date_of_event'         => $date_of_event,
                      'event_subject'         => $this->input->post('event_subject', true),
                      'location'              => $this->input->post('location', true),
                      'service'               => $this->input->post('service', true),
                      'other'                 => $this->input->post('other', true),
                      'keywords'              => $this->input->post('keywords', true),
                      'press_release_title'   => $this->input->post('press_release_title', true),
                      'release_sub_heading'   => $this->input->post('release_sub_heading', true),
                      'press_release_text'    => $this->input->post('press_release_text', true),   
                      'status'                => $this->input->post('status', true),             
                      'prepared_by_email'     => $this->input->post('who_prepared', true),             
                      'reviewed_by_email'     => $this->input->post('who_reviewed', true),                        
                      'schedule_for_publish'  => $schedule_for_publish 
                );
          } 


        if (!empty($_FILES['feature_image'])) {

            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])) {
                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif'){
                            $gif_path = $this->upload_model->press_release_gif_image_upload($temp_data['file_name']);
                            $data["feature_image"] = $gif_path;
                            $data["feature_image"] = $gif_path;
                        } else {
                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path,$temp_data['image_type']);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }               

                    if($press_release_type == '2'){
                    }else{ 
                    $this->db->insert('press_release', $data);
                    $last_pr_id = $this->db->insert_id();

                    $notification['item_id'] = $this->db->insert_id();
                    $this->db->insert('tbl_notification', $notification);
 
                   
                   }
                }
                return $last_pr_id;
        
        }
        return false;
    }

     public function press_release_history_log($press_release_id,$pre_image='')
    {   

        date_default_timezone_set("Asia/Kolkata");
         $t=time();

        $date_var = $this->input->post('date_of_event');
        $orgDate =str_replace("/","-",$date_var);
        $date_of_event =  date("Y-m-d", strtotime($orgDate));

         $date_var2 = $this->input->post('schedule_for_publish');
         $orgDate2 =str_replace("/","-",$date_var2);
         $schedule_for_publish =  date("Y-m-d H:i:s", strtotime($orgDate2));


         $status = $this->input->post('status');
         $press_release_type = $this->input->post('press_release_type');
         $press_release_ids  = $this->input->post('press_release_ids');
         if($press_release_type == '2' && $status == '2')
         {
         $pro_val = $this->auth_user->firstname.' '.$this->auth_user->lastname;
         $press_release_title  = $this->input->post('press_release_title');
         $press_release_category  = $this->input->post('press_release_category');

        if($press_release_type == '3' && $status == '2'){
            $action = 'Withdrawl for Requested';
        }else if($press_release_type == '2' && $status == '2'){
            $action = 'Update for Requested';
        }else if($press_release_type == '1' && $status == '2'){
            $action = 'Submitted';
        }else if($press_release_type == '1' && $status == '3'){
            $action = 'Published';
        }else if($press_release_type == '1' && $status == '4'){
            $action = 'Scheduled for Published';
        }
       
        if($this->auth_user->role == 'pro_admin'){
         $pro_name = $this->auth_model->get_pro_by_key($this->auth_user->pro_category_id);
         $title = $pro_name->name.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '.$action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);

        }else{
         $pro_name = $this->auth_model->get_pro_by_key($press_release_category);
         $title = $pro_name->name.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '. $action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);
        }


         $notification = array(
                              'pro_id'             => $this->auth_user->pro_category_id,
                              'item_id'            => $press_release_ids,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Update Requested',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                              );
            $this->db->insert('tbl_notification', $notification);

         }

    
        if($status == '3')
         {
          $data = array('approved_at'          => date('Y-m-d H:i:s',$t), 
                        'approved_by'          => $this->auth_user->id,
                        'created_at'           => date('Y-m-d H:i:s',$t), 
                        'created_by'           => $this->auth_user->id,
                        'updated_at'           => date('Y-m-d H:i:s',$t), 
                        'updated_by'           => $this->auth_user->id,
                        'press_release_id'     => $press_release_id,
                        'status'               => $this->input->post('status'),
                        'pro_category'         => $this->input->post('press_release_category', true),
                        'lang_id'              => $this->input->post('lang_id', true),
                        'press_release_type'   => $this->input->post('press_release_type', true),        
                        'date_of_event'        => $date_of_event,
                        'event_subject'        => $this->input->post('event_subject', true),
                        'location'             => $this->input->post('location', true),
                        'service'              => $this->input->post('service', true),
                        'other'                => $this->input->post('other', true),
                        'keywords'             => $this->input->post('keywords', true),
                        'press_release_title'  => $this->input->post('press_release_title', true),
                        'release_sub_heading'  => $this->input->post('release_sub_heading', true),
                        'press_release_text'   => $this->input->post('press_release_text', true),   
                        'status'               => $this->input->post('status', true),             
                        'prepared_by_email'    => $this->input->post('who_prepared', true),             
                        'reviewed_by_email'    => $this->input->post('who_reviewed', true),                        
                        'schedule_for_publish' => $schedule_for_publish
                      );

           }else if($status == '2' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || 
            $status == '8')
            {

              $data = array('updated_at'           => date('Y-m-d H:i:s',$t), 
                            'updated_by'           => $this->auth_user->id,
                            'created_at'           => date('Y-m-d H:i:s',$t), 
                            'created_by'           => $this->auth_user->id,
                            'press_release_id'     => $press_release_id,
                            'status'               => $this->input->post('status'),
                            'pro_category'         => $this->input->post('press_release_category', true),
                            'lang_id'              => $this->input->post('lang_id', true),
                            'press_release_type'   => $this->input->post('press_release_type', true),        
                            'date_of_event'        => $date_of_event,
                            'event_subject'        => $this->input->post('event_subject', true),
                            'location'             => $this->input->post('location', true),
                            'service'              => $this->input->post('service', true),
                            'other'                => $this->input->post('other', true),
                            'keywords'             => $this->input->post('keywords', true),
                            'press_release_title'  => $this->input->post('press_release_title', true),
                            'release_sub_heading'  => $this->input->post('release_sub_heading', true),
                            'press_release_text'   => $this->input->post('press_release_text', true),   
                            'status'               => $this->input->post('status', true),             
                            'prepared_by_email'    => $this->input->post('who_prepared', true),             
                            'reviewed_by_email'    => $this->input->post('who_reviewed', true),                        
                            'schedule_for_publish' => $schedule_for_publish
                        );

          }else{

              if(!empty($this->input->post('created_at'))){
                $created_at = $this->input->post('created_at');
                $created_by = $this->input->post('created_by');
               }else{
                 $created_at = date('Y-m-d H:i:s',$t);
                 $created_by = $this->auth_user->id;
               }
            $data = array('created_at'            => $created_at, 
                          'created_by'            => $created_by,
                          'press_release_id'      => $press_release_id,
                          'status'                => $this->input->post('status'),
                          'pro_category'          => $this->input->post('press_release_category', true),
                          'lang_id'               => $this->input->post('lang_id', true),
                          'press_release_type'    => $this->input->post('press_release_type', true),        
                          'date_of_event'         => $date_of_event,
                          'event_subject'         => $this->input->post('event_subject', true),
                          'location'              => $this->input->post('location', true),
                          'service'               => $this->input->post('service', true),
                          'other'                 => $this->input->post('other', true),
                          'keywords'              => $this->input->post('keywords', true),
                          'press_release_title'   => $this->input->post('press_release_title', true),
                          'release_sub_heading'   => $this->input->post('release_sub_heading', true),
                          'press_release_text'    => $this->input->post('press_release_text', true),   
                          'status'                => $this->input->post('status', true),             
                          'prepared_by_email'     => $this->input->post('who_prepared', true),             
                          'reviewed_by_email'     => $this->input->post('who_reviewed', true),                        
                          'schedule_for_publish'  => $schedule_for_publish
                        );
          }    

        if (!empty($_FILES['feature_image'])){
            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])){
                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif'){
                            $gif_path = $this->upload_model->press_release_gif_image_upload($temp_data['file_name']);
                            $data["feature_image"] = $gif_path;
                            $data["feature_image"] = $gif_path;
                        } else {
                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path,$temp_data['image_type']);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                    if(!empty($pre_image)){
                    $data['feature_image'] = $pre_image;
                    }
                    $this->db->insert('press_release_history_log', $data);
                }
            return true;
        }

        return false;
    }



    public function press_release_media($press_release_id)
     {   
        
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 

        $caption_infographic_text = $this->input->post('caption-infographic-text');
        $caption_image_text       = $this->input->post('caption-image-text');
        $caption_video_text       = $this->input->post('caption-video-text');
        $status       = $this->input->post('status');
        $data['press_release_type'] = $this->input->post('press_release_type');
        $data2['status']  = $status; 
         
         if($status == '3')
         {
          $data = array('approved_at'   => date('Y-m-d H:i:s',$t), 
                        'approved_by'   => $this->auth_user->id,
                        // 'updated_at'    => date('Y-m-d H:i:s',$t), 
                        // 'updated_by'    => $this->auth_user->id,
                        'created_at'    => date('Y-m-d H:i:s',$t), 
                        'created_by'    => $this->auth_user->id, 
                        'lang_id'       => $this->input->post('lang_id'),
                        'status'        => $this->input->post('status'),
                        'release_id'    => $press_release_id,
                        'press_release_type'    => $data['press_release_type']
                      );

        }else if($status == '2' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || $status == '8')
          {

          $data =  array('updated_at'     => date('Y-m-d H:i:s',$t), 
                         'updated_by'     => $this->auth_user->id,
                         'created_at'    => date('Y-m-d H:i:s',$t), 
                         'created_by'    => $this->auth_user->id,
                         'lang_id'        => $this->input->post('lang_id'),
                         'status'         => $this->input->post('status'),
                         'release_id'     => $press_release_id,
                         'press_release_type'    => $data['press_release_type']
                        );

          }else{
              if(!empty($this->input->post('created_at'))){
                $created_at = $this->input->post('created_at');
                $created_by = $this->input->post('created_by');
               }else{
                 $created_at = date('Y-m-d H:i:s',$t);
                 $created_by = $this->auth_user->id;
               }
              
              $data = array('created_at'     => $created_at, 
                            'created_by'     => $created_by,
                            'updated_at'     => date('Y-m-d H:i:s',$t), 
                            'updated_by'     => $this->auth_user->id,
                            'lang_id'        => $this->input->post('lang_id'),
                            'status'         => $this->input->post('status'),
                            'release_id'     => $press_release_id,
                            'press_release_type'    => $data['press_release_type']
                        );
          }

          $data_history = $data;

            

         if (!empty($_FILES['infographic']['name'][0])){
             // $path = 'uploads/press_release_infographic';
             //         $path2 = 'uploads/press_release_infographic/' . date("Y");
             //         $path3 = 'uploads/press_release_infographic/' . date("Y") . '/' . date("m") .'/';

             //        if(!is_dir($path)){
             //           mkdir($path,0655);
             //           if(!is_dir($path2)){
             //              mkdir($path2,0655);
             //                 if(!is_dir($path3)){
             //                 mkdir($path3,0655);
             //               }
             //           }
             //        }

            $this->load->model('upload_model');
            $file_count = count($_FILES['infographic']['name']);
            for ($i = 0; $i < $file_count; $i++){
                if (isset($_FILES['infographic']['name'])){
                     

                    $_FILES['file']['name']      = $_FILES['infographic']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['infographic']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['infographic']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['infographic']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['infographic']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["infographic"]["name"][$i]);
                     $data['media_type'] = 'press_release_infographic';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_infographic_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = 'uploads/press_release_infographic'; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['infographic']['name'][$i];  
                      $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if (!$this->upload->do_upload('infographic')) {
                      throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                       $data['media_path'] = 'uploads/press_release_infographic/'.$filename;
                      $data_history['media_path'] = $data['media_path'];
                      }
                }
                $this->db->insert('tbl_press_release_media', $data);

                $data_history['press_release_media_id'] = $this->db->insert_id();
                if($data['press_release_type'] != 2){
                $this->db->insert('tbl_press_release_media_history_log', $data_history);
                }   
            }
         }

          if (!empty($_FILES['image']['name'][0])){
                     $path  = 'uploads/press_release_image';
                     $path2 = 'uploads/press_release_image/' . date("Y");
                     $path3 = 'uploads/press_release_image/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }

            $this->load->model('upload_model');
            $file_count = count($_FILES['image']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['image']['name'])){
                     $_FILES['file']['name']     = $_FILES['image']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['image']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['image']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['image']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["image"]["name"][$i]);
                     $data['media_type'] = 'press_release_image';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_image_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['image']['name'][$i];  
                     $this->load->library('upload', $config);  
                     $this->upload->initialize($config);
                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                       $data['media_path'] = $path3.$filename;
                      $data_history['media_path'] = $data['media_path'];
                      }
                }
              $this->db->insert('tbl_press_release_media', $data);

                $data_history['press_release_media_id'] = $this->db->insert_id();
                if($data['press_release_type'] != 2){
                $this->db->insert('tbl_press_release_media_history_log', $data_history);
                } 
            }
         }

         if (!empty($_FILES['video']['name'][0])){

             $path = 'uploads/press_release_video';
                     $path2 = 'uploads/press_release_video/' . date("Y");
                     $path3 = 'uploads/press_release_video/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['video']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['video']['name'])){
                    //file
                     $_FILES['file']['name']     = $_FILES['video']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['video']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['video']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['video']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["video"]["name"][$i]);

                     $data['media_type'] = 'press_release_video';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_video_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['video']['name'][$i];  
                     $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                        $data['media_path'] = $path3.$filename;
                         $data_history['media_path'] = $data['media_path'];
                      }
                }
                $this->db->insert('tbl_press_release_media', $data);

                $data_history['press_release_media_id'] = $this->db->insert_id();
                if($data['press_release_type'] != 2){
                $this->db->insert('tbl_press_release_media_history_log', $data_history);
                } 
                
            }
      
    }

    if($data['press_release_type'] == 2){
         $newstr = $this ->db
                               -> select('*')
                               -> where('release_id', $press_release_id)
                               -> where('status_img', 1)
                               -> get('tbl_press_release_media')
                               ->result_array();

                     $count = count($newstr);

                    for($i=0; $i < $count; $i++){  
                           $arr['lang_id'] =  $newstr[$i]['lang_id']; 
                           $arr['release_id'] =  $newstr[$i]['release_id']; 
                           $arr['press_release_row_id'] =  $press_history_id; 
                           $arr['press_release_type'] =  $data['press_release_type']; 
                           $arr['press_release_media_id'] =  $newstr[$i]['id']; 
                           $arr['media_type'] =  $newstr[$i]['media_type']; 
                           $arr['media_format'] =  $newstr[$i]['media_format']; 
                           $arr['media_size'] =  $newstr[$i]['media_size']; 
                           $arr['media_path'] =  $newstr[$i]['media_path']; 
                           $arr['caption'] =  $newstr[$i]['caption'];
                           $arr['status'] =  $status;
                           $arr['schedule_for_publish'] =  $newstr[$i]['schedule_for_publish']; 
                           $arr['created_at'] =  $newstr[$i]['created_at']; 
                           $arr['created_by'] =  $newstr[$i]['created_by']; 
                           $arr['updated_at'] =  date('Y-m-d H:i:s',$t); 
                           $arr['updated_by'] =  $this->auth_user->id; 

                    $var = $this->db->insert('tbl_press_release_media_history_log',$arr);
                  } 
      }
      return true;
}


    public function update_press_realease($id)
    {   
        
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        $data = $this->input_values_press();
        $press_release_type = $this->input->post('press_release_type');
       
        $pro_val = $this->auth_user->firstname.' '.$this->auth_user->lastname;
        $lang_id = $this->input->post('lang_id'); 
        $press_release_title  = $this->input->post('press_release_title');
        $press_release_category  = $this->input->post('press_release_category');
        $data["status"]  = $this->input->post('status');
        $status_code = $data["status"];

        if($press_release_type == '3' && $status_code == '2'){
            $action = 'Withdrawl for Requested';
        }else if($press_release_type == '2' && $status_code == '2'){
            $action = 'Update for Requested';
        }else if($press_release_type == '1' && $status_code == '2'){
            $action = 'Submitted';
        }else if($press_release_type == '1' && $status_code == '3'){
            $action = 'Published';
        }else if($press_release_type == '1' && $status_code == '4'){
            $action = 'Scheduled for Published';
        }else if($press_release_type == '1' && $status_code == '9'){
            $action = 'UnPublished';
        }
       
    if($status_code != '1'){
        if($this->auth_user->role == 'pro_admin'){
         $pro_name = $this->auth_model->get_pro_by_key($this->auth_user->pro_category_id);
         $title = $pro_name->name.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '.$action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);

        }else{
         $pro_name = $this->auth_model->get_pro_by_key($press_release_category);
         $title = $pro_name->name.' ('.$this->auth_user->firstname.' '.$this->auth_user->lastname.') '.'has '. $action.' a Press release titled'.' "'.$press_release_title.'"'.' at '.date('Y-m-d H:i:s',$t);
        }
    }
        //echo '<pre>';print_r($title);
        //die;
         if ($press_release_type == '3')
         {
           
            $data["status_withdraw"] = 1;
            $data["status"]  = 3;
            $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Requested for Withdrawl',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );
         }else if($press_release_type == 2)
         {
          $status = 3; 
          $data['status'] = $status;
          $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Update for Request',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );
         }else{
          //$status = 3; 
          //$data['status'] = $status;
         } 
         

        if($data["status"] == '3' && $press_release_type != 3)
        { 
          if(empty($this->input->post('approved_at'))){
            $data['approved_at']   = date('Y-m-d H:i:s',$t);
            }else{
                 $data['approved_at']   = $this->input->post('approved_at'); 
            }
          $data['approved_by']   = $this->auth_user->id;
          $data['updated_at']    = date('Y-m-d H:i:s',$t); 
          $data['updated_by']    = $this->auth_user->id;
          $data['created_at']    = $this->input->post('created_at');
          $data['created_by']    = $this->input->post('created_by');

          $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Published',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );

        }else if($data["status"] == '2')
        {
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');

           $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Submitted',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );

        }else if($data["status"] == '4'){
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');

           $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Sheduled for Published',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );
        }else if($data["status"] == '9')
        { 
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');

           $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Unpublish',
                              'item_title'         => $title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );

        }

        if (!empty($_FILES['feature_image'])) {
            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])) {
                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif'){
                            $gif_path = $this->upload_model->press_release_gif_image_upload($temp_data['file_name']);
                            $data["feature_image"] = $gif_path;
                            $data["feature_image"] = $gif_path;
                        } else {
                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path);
                        }
                    }
                }     
             }

        $this->db->where('id',$id);
        $query = $this->db->update('press_release', $data);
        if($query && $status_code != '1'){
          $this->db->insert('tbl_notification', $notification);  
        }
        return true;
     
}


    public function update_press_release_history_log($press_release_id)
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time();

        $data = $this->input_values_press();

        $data['press_release_type'] = $this->input->post('press_release_type');
         if (!empty($data["press_release_type"] == 3)){
            //echo '========';die;
            $data["status_withdraw"] = 1;
            $data["status"]  = 3;
            }else{
           $status = $this->input->post('status'); 
           $data['status'] = $status;
            } 


        $data['press_release_id'] = $press_release_id;  
        $status = $this->input->post('status');
        $lang_id = $this->input->post('lang_id');

        if($lang_id > 1){
        $data['translated_id'] = $press_release_id;
        $data['updated_at']    = date('Y-m-d H:i:s',$t); 
        $data['updated_by']    = $this->auth_user->id;
        }
      
         
         if($status == '3'){

              $data['approved_at']   = date('Y-m-d H:i:s',$t); 
              $data['approved_by']   = $this->auth_user->id;
              $data['updated_at']    = date('Y-m-d H:i:s',$t); 
              $data['updated_by']    = $this->auth_user->id;
              $data['created_at']   = $this->input->post('created_at');
              $data['created_by']   = $this->input->post('created_by');

          }else if($status == '2' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || $status == '8'){
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');
          }
          

        if (!empty($_FILES['feature_image']['name'][0])){

            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])) {

                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif|png|jpg|jpeg'){
                            // $gif_path = $this->upload_model->gallery_gif_image_upload($temp_data['file_name']);          
                            $data["feature_image"] = $gif_path;
                        }else{

                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path);
                        }
                    }
                    
                }
           
        }else{

        $data["feature_image"] = $this->input->post('pre_image');
        }
        
        $this->db->insert('press_release_history_log', $data);
        return true;
    }

    public function update_press_release_media($press_release_id,$press_history_id)
     {  
       
        date_default_timezone_set("Asia/Kolkata");
        $t = time();

        $press_release_type = $this->input->post('press_release_type');
        if($press_release_type == 3)
        {
           $data['status_withdraw'] = 1;
           $data2['status_withdraw'] = 1;
           $data['status'] = 3;
           $data2['status'] = 3;
           $status = 3;
        }else{
           $status = $this->input->post('status');
           $data2['status'] = $status;
           
        }


            

        $caption_infographic_text = $this->input->post('caption-infographic-text');
        $caption_image_text       = $this->input->post('caption-image-text');
        $caption_video_text       = $this->input->post('caption-video-text');

        $infographic_caption_id   = $this->input->post('infographic_caption_id');
        $image_caption_id         = $this->input->post('image_caption_id');
        $video_caption_id         = $this->input->post('video_caption_id');

        
         if($status == '3'){
             
          $data = array('approved_at'           => date('Y-m-d H:i:s',$t), 
                        'approved_by'           => $this->auth_user->id,
                        'updated_at'            => date('Y-m-d H:i:s',$t), 
                        'updated_by'            => $this->auth_user->id,
                        'created_at'            => $this->input->post('created_at'),
                        'created_by'            => $this->input->post('created_by'),
                        'lang_id'               => $this->input->post('lang_id'),
                        'status'                => $this->input->post('status'),
                        'release_id'            => $press_release_id,
                        'press_release_row_id'  => $press_history_id,
                        'press_release_type'    => $this->input->post('press_release_type'),
                        'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                      );

          
          }else if($status == '4' || $status == '5' || $status == '6' || $status == '7' || $status == '8')
          {
          $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                        'updated_by'            => $this->auth_user->id,
                        'created_at'            => $this->input->post('created_at'),
                        'created_by'            => $this->input->post('created_by'),
                        'lang_id'               => $this->input->post('lang_id'),
                        'status'                => $this->input->post('status'),
                        'release_id'            => $press_release_id,
                        'press_release_row_id'  => $press_history_id,
                        'press_release_type'    => $this->input->post('press_release_type'),
                        'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                        );
            

           }else if($status == '2' && $press_release_type == 2){
           

            $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                          'updated_by'            => $this->auth_user->id,
                          'created_at'            => $this->input->post('created_at'),
                          'created_by'            => $this->input->post('created_by'),
                          'lang_id'               => $this->input->post('lang_id'),
                          'status'                => $this->input->post('status'),
                          'release_id'            => $press_release_id,
                          'press_release_row_id'  => $press_history_id,
                          'press_release_type'    => $this->input->post('press_release_type'),
                          'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                        );
           }else if($status == '2' &&  $press_release_type != 2){
            $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                          'updated_by'            => $this->auth_user->id,
                          'created_at'            => $this->input->post('created_at'),
                          'created_by'            => $this->input->post('created_by'),
                          'lang_id'               => $this->input->post('lang_id'),
                          'status'                => $this->input->post('status'),
                          'release_id'            => $press_release_id,
                          'press_release_row_id'  => $press_history_id,
                          'press_release_type'    => $this->input->post('press_release_type'),
                          'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                        );
           }else if($status == '1' &&  $press_release_type != 2){
            $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                          'updated_by'            => $this->auth_user->id,
                          'created_at'            => $this->input->post('created_at'),
                          'created_by'            => $this->input->post('created_by'),
                          'lang_id'               => $this->input->post('lang_id'),
                          'status'                => $this->input->post('status'),
                          'release_id'            => $press_release_id,
                          'press_release_row_id'  => $press_history_id,
                          'press_release_type'    => $this->input->post('press_release_type'),
                          'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                        );
           }

          $data_history = $data;

          //echo '===='.'<pre>';print_r($data_history);
          //die;
          
         if (!empty($_FILES['infographic']['name'][0])){
            $path = 'uploads/press_release_infographic';
                     $path2 = 'uploads/press_release_infographic/' . date("Y");
                     $path3 = 'uploads/press_release_infographic/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }

            $this->load->model('upload_model');
            $file_count = count($_FILES['infographic']['name']);
            for ($i = 0; $i < $file_count; $i++){
                if (isset($_FILES['infographic']['name'])){
                    $_FILES['file']['name']     = $_FILES['infographic']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['infographic']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['infographic']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['infographic']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['infographic']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["infographic"]["name"][$i]);
                     $data['media_type'] = 'press_release_infographic';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_infographic_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['infographic']['name'][$i];  
                     $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if (!$this->upload->do_upload('file')) {
                      throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                       $data['media_path'] = $path3.$filename;
                      $data_history['media_path'] = $data['media_path'];
                      }
                }
                
                     $this->db->insert('tbl_press_release_media', $data);
                    $data_history['press_release_media_id'] = $this->db->insert_id();
                    $this->db->insert('tbl_press_release_media_history_log', $data_history);
                  
                  
            }
         }

          if (!empty($_FILES['image']['name'][0])){
              $path = 'uploads/press_release_image';
                     $path2 = 'uploads/press_release_image/' . date("Y");
                     $path3 = 'uploads/press_release_image/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['image']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['image']['name'])){
                     $_FILES['file']['name']     = $_FILES['image']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['image']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['image']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['image']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["image"]["name"][$i]);
                     $data['media_type'] = 'press_release_image';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_image_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['image']['name'][$i];  
                     $this->load->library('upload', $config);  
                     $this->upload->initialize($config);
                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                       $data['media_path'] = $path3.$filename;
                      $data_history['media_path'] = $data['media_path'];
                      }
                }
                 
                    $this->db->insert('tbl_press_release_media', $data);
                    $data_history['press_release_media_id'] = $this->db->insert_id();
                    $this->db->insert('tbl_press_release_media_history_log', $data_history);
                  
                  
               
            }
         }

         if (!empty($_FILES['video']['name'][0])){
              $path = 'uploads/press_release_video';
                     $path2 = 'uploads/press_release_video/' . date("Y");
                     $path3 = 'uploads/press_release_video/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['video']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['video']['name'])){
                    //file
                     $_FILES['file']['name']     = $_FILES['video']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['video']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['video']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['video']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["video"]["name"][$i]);
                     $data['media_type'] = 'press_release_video';
                     $data_history['media_type'] = $data['media_type'];                   
                     $data['caption'] = $caption_video_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['video']['name'][$i];  
                      $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                        $data['media_path'] = $path3.$filename;
                         $data_history['media_path'] = $data['media_path'];
                      }
                }
               
                    $this->db->insert('tbl_press_release_media', $data);
                    $data_history['press_release_media_id'] = $this->db->insert_id();
                    $this->db->insert('tbl_press_release_media_history_log', $data_history);
               
               
            }
      
    }

    if(!empty($infographic_caption_id)){    
    $infographic_count = count($infographic_caption_id);  
    for($i=0; $i < $infographic_count; $i++)
    {
    $data2['media_type'] = 'press_release_infographic';                   
    $data2['caption']     = $caption_infographic_text[$i];


    $this->db->where('id', $infographic_caption_id[$i]);
    $query = $this->db->update('tbl_press_release_media', $data2);
   
                $newstr = $this ->db
                       -> select('*')
                       -> where('release_id', $press_release_id)
                       -> where('id', $infographic_caption_id[$i])
                       -> where('status_img', 1)
                       -> get('tbl_press_release_media')
                       ->result_array();

                 $count = count($newstr);

                    for($i=0; $i < $count; $i++){  
                           $arr['lang_id'] =  $newstr[$i]['lang_id']; 
                           $arr['release_id'] =  $newstr[$i]['release_id']; 
                           $arr['press_release_type'] =  $newstr[$i]['press_release_type']; 
                           $arr['press_release_media_id'] =  $newstr[$i]['id']; 
                           $arr['media_type'] =  $newstr[$i]['media_type']; 
                           $arr['media_format'] =  $newstr[$i]['media_format']; 
                           $arr['media_size'] =  $newstr[$i]['media_size']; 
                           $arr['media_path'] =  $newstr[$i]['media_path']; 
                           if($newstr[$i]['media_type'] = 'press_release_infographic'){
                            $arr['caption']   =  $caption_infographic_text;
                           }elseif($newstr[$i]['media_type'] = 'press_release_image'){
                            $arr['caption']   =  $caption_image_text;
                           }
                           elseif($newstr[$i]['media_type'] = 'press_release_video'){
                            $arr['caption']   =  $caption_video_text;
                           }
                           $arr['caption']    =  $newstr[$i]['caption'];
                           $arr['status']     =  $status;
                           $arr['schedule_for_publish'] =  $newstr[$i]['schedule_for_publish']; 
                           $arr['created_at'] =  $newstr[$i]['created_at']; 
                           $arr['created_by'] =  $newstr[$i]['created_by']; 
                           $arr['updated_at'] =  date('Y-m-d H:i:s',$t); 
                           $arr['updated_by'] =  $this->auth_user->id; 
                           if($newstr[$i]['status'] == '3'){
                           $arr['approved_at'] =  date('Y-m-d H:i:s',$t);  
                           $arr['approved_by'] =  $this->auth_user->id; 
                           }
                           if($newstr[$i]['status_withdraw'] == '1'){
                           $arr['status_withdraw'] = 1;  
                           
                           }

                    $var = $this->db->insert('tbl_press_release_media_history_log',$arr);
                  }         
                    
               }
        }

if(!empty($image_caption_id)){    
$image_count = count($image_caption_id);  
for($i=0; $i < $image_count; $i++)
{
        $data2['media_type'] = 'press_release_image';                   
        $data2['caption']     = $caption_image_text[$i];


    $this->db->where('id', $image_caption_id[$i]);
    $query = $this->db->update('tbl_press_release_media', $data2);
   
  

                    $newstr = $this ->db
                               -> select('*')
                               -> where('release_id', $press_release_id)
                               -> where('id', $image_caption_id[$i])
                               -> where('status_img', 1)
                               -> get('tbl_press_release_media')
                               ->result_array();

                     $count = count($newstr);

                    for($i=0; $i < $count; $i++){  
                           $arr['lang_id'] =  $newstr[$i]['lang_id']; 
                           $arr['release_id'] =  $newstr[$i]['release_id']; 
                           $arr['press_release_type'] =  $newstr[$i]['press_release_type']; 
                           $arr['press_release_media_id'] =  $newstr[$i]['id']; 
                           $arr['media_type'] =  $newstr[$i]['media_type']; 
                           $arr['media_format'] =  $newstr[$i]['media_format']; 
                           $arr['media_size'] =  $newstr[$i]['media_size']; 
                           $arr['media_path'] =  $newstr[$i]['media_path']; 
                           if($newstr[$i]['media_type'] = 'press_release_infographic'){
                            $arr['caption']   =  $caption_infographic_text;
                           }elseif($newstr[$i]['media_type'] = 'press_release_image'){
                            $arr['caption']   =  $caption_image_text;
                           }
                           elseif($newstr[$i]['media_type'] = 'press_release_video'){
                            $arr['caption']   =  $caption_video_text;
                           }
                           $arr['caption']    =  $newstr[$i]['caption'];
                           $arr['status']     =  $status;
                           $arr['schedule_for_publish'] =  $newstr[$i]['schedule_for_publish']; 
                           $arr['created_at'] =  $newstr[$i]['created_at']; 
                           $arr['created_by'] =  $newstr[$i]['created_by']; 
                           $arr['updated_at'] =  date('Y-m-d H:i:s',$t); 
                           $arr['updated_by'] =  $this->auth_user->id; 
                           if($newstr[$i]['status'] == '3'){
                           $arr['approved_at'] =  date('Y-m-d H:i:s',$t);  
                           $arr['approved_by'] =  $this->auth_user->id; 
                           }
                           if($newstr[$i]['status_withdraw'] == '1'){
                           $arr['status_withdraw'] = 1;  
                           
                           }

                    $var = $this->db->insert('tbl_press_release_media_history_log',$arr);
                  }         
                    
               }
        }
if(!empty($video_caption_id)){    
$video_count = count($video_caption_id);  
for($i=0; $i < $video_count; $i++)
{
        $data2['media_type'] = 'press_release_video';                   
        $data2['caption']     = $caption_video_text[$i];


    $this->db->where('id', $video_caption_id[$i]);
    $query = $this->db->update('tbl_press_release_media', $data2);
   
  

                    $newstr = $this ->db
                               -> select('*')
                               -> where('release_id', $press_release_id)
                               -> where('id', $video_caption_id[$i])
                               -> where('status_img', 1)
                               -> get('tbl_press_release_media')
                               ->result_array();

                     $count = count($newstr);
                    for($i=0; $i < $count; $i++){  
                           $arr['lang_id'] =  $newstr[$i]['lang_id']; 
                           $arr['release_id'] =  $newstr[$i]['release_id']; 
                           $arr['press_release_type'] =  $newstr[$i]['press_release_type']; 
                           $arr['press_release_media_id'] =  $newstr[$i]['id']; 
                           $arr['media_type'] =  $newstr[$i]['media_type']; 
                           $arr['media_format'] =  $newstr[$i]['media_format']; 
                           $arr['media_size'] =  $newstr[$i]['media_size']; 
                           $arr['media_path'] =  $newstr[$i]['media_path']; 
                           if($newstr[$i]['media_type'] = 'press_release_infographic'){
                            $arr['caption']   =  $caption_infographic_text;
                           }elseif($newstr[$i]['media_type'] = 'press_release_image'){
                            $arr['caption']   =  $caption_image_text;
                           }
                           elseif($newstr[$i]['media_type'] = 'press_release_video'){
                            $arr['caption']   =  $caption_video_text;
                           }
                           $arr['caption']    =  $newstr[$i]['caption'];
                           $arr['status']     =  $status;
                           $arr['schedule_for_publish'] =  $newstr[$i]['schedule_for_publish']; 
                           $arr['created_at'] =  $newstr[$i]['created_at']; 
                           $arr['created_by'] =  $newstr[$i]['created_by']; 
                           $arr['updated_at'] =  date('Y-m-d H:i:s',$t); 
                           $arr['updated_by'] =  $this->auth_user->id; 
                           if($newstr[$i]['status'] == '3'){
                           $arr['approved_at'] =  date('Y-m-d H:i:s',$t);  
                           $arr['approved_by'] =  $this->auth_user->id; 
                           }
                           if($newstr[$i]['status_withdraw'] == '1'){
                           $arr['status_withdraw'] = 1; 
                           }

                    $var = $this->db->insert('tbl_press_release_media_history_log',$arr);
                  }         
                    
               }
        }



    return true;
    
}


    public function get_paginated_update_press_release_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_press_release();
        // $this->db->where('status',2);
        // $this->db->group_by('press_release_type');
        // $this->db->group_by('press_release_id');
        // $this->db->group_by('pro_category');
        $query = $this->db->get('press_release_history_log');
        return $query->row()->count;
    }

     public function get_paginated_press_release_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_press_release();
         if($this->auth_user->role == "pro_admin")
        {
            $pro_id = $this->auth_user->pro_category_id;
            $this->db->where('pro_category', $pro_id);
        }else{
            $this->db->where('status !=', '1');
        }
        $query = $this->db->get('press_release');
        return $query->row()->count;
    }

      public function get_paginated_press_release__request_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_press_release();
        $query = $this->db->get('press_release');
        return $query->row()->count;
    }




    public function get_view_press_release_list($per_page, $offset)
    { 

        $this->filter_press_release();
        $this->db->where('is_active', '1');
        
        if($this->auth_user->role == "pro_admin")
        {
            $pro_id = $this->auth_user->pro_category_id;
            $this->db->where('pro_category', $pro_id);
        }else{
            $this->db->where('status !=', '1');
        }
        $this->db->order_by('updated_at','DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('press_release');
        return $query->result();
    }


     public function get_press_release_update_request($per_page, $offset)
    { 
        $this->filter_press_release();
    //     $this->db->where('is_active', '1');
    // if($this->auth_user->role == "pro_admin")
    // {
    //     $pro_id = $this->auth_user->pro_category_id;
    //     $this->db->order_by('pro_category', $pro_id);
    // }else{
    //     $this->db->where('status !=', '1');
    // }
        //$this->db->order_by('created_at', 'DESC');
        //$this->db->where('status', '3');
        //$this->db->where('press_release_type', '2');
        //$this->db->group_by('press_release_type');

        $this->db->limit($per_page, $offset);
        $query = $this->db->get('press_release_history_log');
        return $query->result();
    }

    public function get_press_release_withdraw_request($per_page, $offset)
    { 
        $this->filter_press_release();
        $this->db->where('is_active', '1');
    if($this->auth_user->role == "pro_admin")
    {
        $pro_id = $this->auth_user->pro_category_id;
        $this->db->order_by('pro_category', $pro_id);
        $this->db->where('status_withdraw', '1');
    }else{
        //$this->db->where('status !=', '1');
        $this->db->where('status_withdraw', '1');
    }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('press_release');
        return $query->result();
    }

     public function get_paginated_press_release_status_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->filter_press_release();
        $query = $this->db->get('press_release');
        return $query->row()->count;
    }

    public function get_view_press_release_status_list($per_page, $offset)
    {
        $this->filter_press_release();
        $this->db->where('is_active', '1');
        //$this->db->where('status', '1');
        //$this->db->or_where('status', '2');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('press_release');
        return $query->result();
    }

    public function filter_press_release()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->like('press_release_title', clean_str($q));
        }
        $lang_id = trim($this->input->get('lang_id', true));
        if (!empty($lang_id)) {
            $this->db->where('lang_id', clean_number($lang_id));
        }
        $category = trim($this->input->get('pro_cate', true));
        if (!empty($category)) {
            $this->db->where('pro_category', clean_number($category));
        }

        $status = trim($this->input->get('status', true));
        if($status == 5){
            $this->db->where('status_withdraw', clean_number(1));
            $this->db->where('status', clean_number(3));
        }elseif($status == 6){
         $this->db->where('status', clean_number(7));
        }else{
            if (!empty($status)) {
            $this->db->where('status', clean_number($status));
           }
        }

    }


   public function fetch_pro($pro_category)
    {
      $this->db->where('pro_category_id', $pro_category);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('users');
      $output = '<option value="">Select PRO Name</option>';
    
      foreach($query->result() as $row)
      {
       $output .= '<option value="'.$row->id.'">'.$row->firstname.' '.$row->lastname.'</option>';
      }
       $output  .= '<option value="Others">Others</option>';
      return $output;
    }

    public function fetch_pro_id($regional_pro_id)
    {
      $this->db->where('id', $regional_pro_id);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('users');
      $row  = $query->result();
      $output = $row[0]->phone; 
      return $output;
    }





    public function update_request_press_realease($id)
    {   
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 
        //echo '===='.$id;
        $data = $this->input_values_press();
       //echo '<pre>';print_r($data);
       // die;
        $press_release_category = $this->input->post('press_release_category');
        $press_release_title = $this->input->post('press_release_title');
        if($data['status'] == '3')
        {
          $data['approved_at']   = date('Y-m-d H:i:s',$t); 
          $data['approved_by']   = $this->auth_user->id;
          $data['updated_at']    = date('Y-m-d H:i:s',$t); 
          $data['updated_by']    = $this->auth_user->id;
          $data['created_at']    = $this->input->post('created_at');
          $data['created_by']    = $this->input->post('created_by');

          $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Published',
                              'item_title'         => $press_release_title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );

        }else if($data['status'] == '4')
        {
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');

          $notification = array(
                              'pro_id'             => $press_release_category,
                              'item_id'            => $id,
                              'action_by_id'       => $this->auth_user->id,
                              'pro_name'           => $pro_val,
                              'action_by_name'     => $pro_val,
                              'item_type'          => 'press release',
                              'action_meta'        => 'Scheduled for Published',
                              'item_title'         => $press_release_title, 
                              'action_at'          => date('Y-m-d H:i:s',$t)
                            );
        }  

        if (!empty($_FILES['feature_image'])) {
            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])) {
                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif'){
                            $gif_path = $this->upload_model->press_release_gif_image_upload($temp_data['file_name']);
                            $data["feature_image"] = $gif_path;
                            $data["feature_image"] = $gif_path;
                        } else {
                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path,$temp_data['image_type']);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                }     
             }

        
        $this->db->where('id',$id);
        $this->db->update('press_release', $data);
        $this->db->insert('tbl_notification', $notification);
        return true;
     
}


    public function update_request_press_release_history_log($press_release_id)
    {
        date_default_timezone_set("Asia/Kolkata");
        $t=time();

        $data = $this->input_values_press();
        $data['press_release_id'] = $press_release_id;  
         
        if($data['status'] == '3'){
           
           $data['approved_at']   = date('Y-m-d H:i:s',$t); 
           $data['approved_by']   = $this->auth_user->id;
           $data['updated_at']    = date('Y-m-d H:i:s',$t); 
           $data['updated_by']    = $this->auth_user->id;
           $data['created_at']   = $this->input->post('created_at');
           $data['created_by']   = $this->input->post('created_by');

          }else if($data['status'] == '4'){
          $data['updated_at']   = date('Y-m-d H:i:s',$t); 
          $data['updated_by']   = $this->auth_user->id;
          $data['created_at']   = $this->input->post('created_at');
          $data['created_by']   = $this->input->post('created_by');
          }
          

        if (!empty($_FILES['feature_image']['name'][0])){

            $this->load->model('upload_model');
                if (isset($_FILES['feature_image']['name'])) {

                    //file
                    $_FILES['file']['name']     = $_FILES['feature_image']['name'];
                    $_FILES['file']['type']     = $_FILES['feature_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['feature_image']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['feature_image']['error'];
                    $_FILES['file']['size']     = $_FILES['feature_image']['size'];
                    //upload
                    $temp_data = $this->upload_model->upload_temp_image('file','array');
                    if (!empty($temp_data)) {
                        $temp_path = $temp_data['full_path'];
                        if ($temp_data['image_type'] == 'gif|png|jpg|jpeg'){
                            // $gif_path = $this->upload_model->gallery_gif_image_upload($temp_data['file_name']);          
                            $data["feature_image"] = $gif_path;
                        }else{

                            $data["feature_image"] = $this->upload_model->press_release_big_image_upload($temp_path,$temp_data['image_type']);
                            $data["feature_image"] = $this->upload_model->press_release_small_image_upload($temp_path,$temp_data['image_type']);
                        }
                    }
                 $this->db->insert('press_release_history_log', $data);     
                }
         
           
        }else{

        $data["feature_image"] = $this->input->post('pre_image');
        }
        $this->db->where('status','2');
        $this->db->where('press_release_type','2');
        $this->db->update('press_release_history_log', $data);
        return true;
    }

    public function update_request_press_release_media($press_release_id,$press_history_id)
     {  
       
        date_default_timezone_set("Asia/Kolkata");
        $t = time();
        $data = $this->input_values_press();
         
        $data['press_release_type'] = $this->input->post('press_release_type');
        $status = $this->input->post('status');
        $data['status'] = $status;           

        $caption_infographic_text = $this->input->post('caption-infographic-text');
        $caption_image_text       = $this->input->post('caption-image-text');
        $caption_video_text       = $this->input->post('caption-video-text');
         
         if($status == '3'){
             
          $data = array('approved_at'           => date('Y-m-d H:i:s',$t), 
                        'approved_by'           => $this->auth_user->id,
                        'updated_at'            => date('Y-m-d H:i:s',$t), 
                        'updated_by'            => $this->auth_user->id,
                        'created_at'            => $this->input->post('created_at'),
                        'created_by'            => $this->input->post('created_by'),
                        'lang_id'               => $this->input->post('lang_id'),
                        'status'                => $this->input->post('status'),
                        'release_id'            => $press_release_id,
                        'press_release_type'    => $this->input->post('press_release_type'),
                        'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                      );

          
          }else if($status == '4')
          {
          $data = array('updated_at'            => date('Y-m-d H:i:s',$t), 
                        'updated_by'            => $this->auth_user->id,
                        'created_at'            => $this->input->post('created_at'),
                        'created_by'            => $this->input->post('created_by'),
                        'lang_id'               => $this->input->post('lang_id'),
                        'status'                => $this->input->post('status'),
                        'release_id'            => $press_release_id,
                        'press_release_type'    => $this->input->post('press_release_type'),
                        'schedule_for_publish'  => $this->input->post('schedule_for_publish')
                        );
            

           }

          $data_history = $data;
          $data_history['press_release_row_id'] = $press_history_id;
          
         if (!empty($_FILES['infographic']['name'][0])){
            $path = 'uploads/press_release_infographic';
                     $path2 = 'uploads/press_release_infographic/' . date("Y");
                     $path3 = 'uploads/press_release_infographic/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['infographic']['name']);
            for ($i = 0; $i < $file_count; $i++){
                if (isset($_FILES['infographic']['name'])){
                    $_FILES['file']['name']     = $_FILES['infographic']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['infographic']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['infographic']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['infographic']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['infographic']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["infographic"]["name"][$i]);
                     $data['media_type'] = 'press_release_infographic';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_infographic_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['infographic']['name'][$i];  
                     $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if (!$this->upload->do_upload('file')) {
                      throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                       $data['media_path'] = $path3 .$filename;
                      $data_history['media_path'] = $data['media_path'];
                      }
                }
                
                    $this->db->insert('tbl_press_release_media', $data);  
                    $data_history['press_release_media_id'] = $this->db->insert_id();        
                    $this->db->insert('tbl_press_release_media_history_log', $data_history);
                    
                  
                  
            }
         }

          if (!empty($_FILES['image']['name'][0])){
            $path = 'uploads/press_release_image';
                     $path2 = 'uploads/press_release_image/' . date("Y");
                     $path3 = 'uploads/press_release_image/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['image']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['image']['name'])){
                     $_FILES['file']['name']     = $_FILES['image']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['image']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['image']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['image']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["image"]["name"][$i]);
                     $data['media_type'] = 'press_release_image';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_image_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['image']['name'][$i];  
                     $this->load->library('upload', $config);  
                     $this->upload->initialize($config);
                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                        $data['media_path'] = $path3.$filename;
                        $data_history['media_path'] = $data['media_path'];
                      }
                }
                 
                   $this->db->insert('tbl_press_release_media', $data);
                   $data_history['press_release_media_id'] = $this->db->insert_id();
                   $this->db->insert('tbl_press_release_media_history_log', $data_history);

                  
                  
               
            }
         }

         if (!empty($_FILES['video']['name'][0])){
            $path = 'uploads/press_release_video';
                     $path2 = 'uploads/press_release_video/' . date("Y");
                     $path3 = 'uploads/press_release_video/' . date("Y") . '/' . date("m") .'/';

                    if(!is_dir($path)){
                       mkdir($path,0655);
                       if(!is_dir($path2)){
                          mkdir($path2,0655);
                             if(!is_dir($path3)){
                             mkdir($path3,0655);
                           }
                       }
                    }
            $this->load->model('upload_model');
            $file_count = count($_FILES['video']['name']);   
            for ($i = 0; $i < $file_count; $i++) {
                if (isset($_FILES['video']['name'])){
                    //file
                     $_FILES['file']['name']     = $_FILES['video']['name'][$i];
                     $_FILES['file']['type']     = $_FILES['video']['type'][$i];
                     $_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'][$i];
                     $_FILES['file']['error']    = $_FILES['video']['error'][$i];
                     $_FILES['file']['size']     = $_FILES['video']['size'][$i];
                     
                     $path_parts = pathinfo($_FILES["video"]["name"][$i]);

                     $data['media_type'] = 'press_release_video';
                     $data_history['media_type'] = $data['media_type'];
                     
                     $data['caption'] = $caption_video_text[$i];
                     $data_history['caption'] = $data['caption'];

                     $data['media_format'] = $path_parts['extension'];
                     $data_history['media_format'] = $data['media_format'];

                     $data['media_size'] =  $_FILES['file']['size'];
                     $data_history['media_size'] =  $data['media_size'];

                     $config['upload_path']    = $path3; 
                     $config['allowed_types']  = '*'; 
                     $config['max_size']       = '40000'; 
                     $config['file_name']      = $_FILES['video']['name'][$i];  
                      $this->load->library('upload', $config);  
                      $this->upload->initialize($config);

                     if ( ! $this->upload->do_upload('file')) {
                         throw new Exception($this->upload->display_errors());
                      } else {
                        $uploadData = $this->upload->data(); 
                        $filename = $uploadData['file_name']; 
                        $data['media_path'] = $path3.$filename;
                         $data_history['media_path'] = $data['media_path'];
                      }
                }
               
                    $this->db->insert('tbl_press_release_media', $data);
                    $data_history['press_release_media_id'] = $this->db->insert_id();
                    $this->db->insert('tbl_press_release_media_history_log', $data_history);
                                                
            }
      
    }
      


        $this->db->where('release_id',$press_release_id);
        $query = $this->db->update('tbl_press_release_media', $data);
            
    
      
      if($query){

        $this->db->where('release_id',$press_release_id);
        $this->db->where('press_release_type','2');
        $this->db->where('status','2');
        $this->db->where('release_id',$press_release_id);
        $query = $this->db->update('tbl_press_release_media_history_log', $data);
                    
       }

    return true;
    
}


  

}                                           