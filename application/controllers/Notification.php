<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Categories
     */
    public function index()
    {

        $user_id = $this->auth_user->id;
        $data['title'] = trans("notifications");

        if($this->auth_user->role == 'pro_admin')
        {
         $pagination = $this->paginate(admin_url() . 'notification', $this->category_model->get_paginated_notification_count());
         $limit = $pagination['per_page']; 
          $offset = $pagination['offset'];  
           
        $pro_id = $this->auth_user->pro_category_id;
            $query = $this->db->query("SELECT * FROM tbl_notification WHERE pro_id = '$pro_id'  and action_by_id != '$user_id' order by action_at desc limit $offset, $limit");
            //echo '==============';
            //die;
        }else{

          $pagination = $this->paginate(admin_url() . 'notification', $this->category_model->get_paginated_notification_count()); 
         // echo '<pre>';print_r($pagination);
          //die();   
          $limit = $pagination['per_page']; 
          $offset = $pagination['offset']; 
             $query = $this->db->query("SELECT * FROM tbl_notification where action_by_id != '$user_id' and read_status = '0' order by action_at desc limit $offset, $limit");
             //die;
        }

           //echo '==='.$this->db->last_query();
            $data['notification'] = $query->result();
            $this->load->view('admin/includes/_header', $data);
            $this->load->view('admin/notification/notification', $data);
            $this->load->view('admin/includes/_footer');
    }



    public function view_notification()
    {
        //echo '=====';die();
        $user_id = $this->auth_user->id;
        $data['title'] = trans("notifications");

        if($this->auth_user->role == 'pro_admin')
        {
         $pagination = $this->paginate(admin_url() . 'notification', $this->category_model->get_paginated_notification_count()); 
          $limit = $pagination['per_page']; 
          $offset = $pagination['offset']; 
        $pro_id = $this->auth_user->pro_category_id;
            $query = $this->db->query("SELECT * FROM tbl_notification WHERE pro_id = $pro_id  and action_by_id != $user_id order by action_at desc limit $offset, $limit");
            //echo '==============';
            //die;
        }else{

          $pagination = $this->paginate(admin_url() . 'view-notification', $this->category_model->get_paginated_notification_read_count()); 
         // echo '<pre>';print_r($pagination);
          //die();   
          $limit = $pagination['per_page']; 
          $offset = $pagination['offset']; 
             $query = $this->db->query("SELECT * FROM tbl_notification where action_by_id != $user_id and read_status = 1 order by action_at desc limit $offset, $limit");
             //die;
        }

        //echo '==='.$this->db->last_query();
            $data['notification'] = $query->result();
            $this->load->view('admin/includes/_header', $data);
            $this->load->view('admin/notification/notification_read', $data);
            $this->load->view('admin/includes/_footer');
    }

    public function fetch_data()
    {   $user_id = $this->auth_user->id;
       
       if($this->auth_user->role == 'pro_admin'){
         
         $pro_id = $this->auth_user->pro_category_id;
         $query = $this->db->query("SELECT * FROM tbl_notification WHERE read_status = '0' and pro_id = $pro_id and action_by_id != $user_id ");

         }else{
        $query = $this->db->query("SELECT * FROM tbl_notification WHERE read_status = '0' and action_by_id != $user_id");
         }
        
        $data =  $query->num_rows();
        echo '('.$data.')';

     }

     public function fetch_data2()
    {  
        $user_id = $this->auth_user->id;      
       if($this->auth_user->role == 'pro_admin'){
         
          $pro_id = $this->auth_user->pro_category_id;       

        $this->db->select('tbl_notification.id, tbl_notification.pro_id, tbl_notification.action_by_id, tbl_notification.action_at, tbl_notification.action_meta, users.id, users.firstname, users.lastname, press_release.pro_category, press_release.press_release_title, tbl_pru_category.id, tbl_pru_category.name');
         $this->db->from('tbl_notification');
         $this->db->join('users','tbl_notification.action_by_id = users.id','left'); 
         $this->db->join('press_release','tbl_notification.item_id = press_release.id','left'); 
         $this->db->join('tbl_pru_category','tbl_notification.pro_id = tbl_pru_category.id','left'); 
         $this->db->where('tbl_notification.read_status','0');
         $this->db->where('tbl_notification.pro_id',$pro_id);
         $this->db->where('tbl_notification.action_by_id !=',$user_id);
         $this->db->where("tbl_notification.action_at BETWEEN DATE_SUB(NOW(), INTERVAL 180 SECOND) AND NOW()");
         $this->db->order_by('tbl_notification.action_at','DESC');
         $query = $this->db->get();

    }else{
        
         $this->db->select('tbl_notification.id, tbl_notification.pro_id, tbl_notification.action_by_id, tbl_notification.action_at, tbl_notification.action_meta, users.id, users.firstname, users.lastname, press_release.pro_category, press_release.press_release_title, tbl_pru_category.id, tbl_pru_category.name');
         $this->db->from('tbl_notification');
         $this->db->join('users','tbl_notification.action_by_id = users.id','left'); 
         $this->db->join('press_release','tbl_notification.item_id = press_release.id','left'); 
         $this->db->join('tbl_pru_category','tbl_notification.pro_id = tbl_pru_category.id','left'); 
         $this->db->where('tbl_notification.read_status','0');
         $this->db->where('tbl_notification.action_by_id !=',$user_id);
         $this->db->where("tbl_notification.action_at BETWEEN DATE_SUB(NOW(), INTERVAL 180 SECOND) AND NOW()");
         $this->db->order_by('tbl_notification.action_at','DESC');
         $query = $this->db->get();

        }

        $data['data_val'] = $query->result_array();
        if(!empty($data['data_val'])){
        echo json_encode($data);
        }
     }


     public function post_action_notification_ajax(){    
        //post_method();
        date_default_timezone_set("Asia/Kolkata");
        $t=time(); 

        $data = array(
                      'read_status' => $this->input->post('read_status', true),
                      'read_at'     => date('Y-m-d H:i:s',$t),
                      'read_by'     => $this->auth_user->id
                      );
        $post_id = $this->input->post('post_id', true);
        $this->db->where('id', $post_id);
        $this->db->update('tbl_notification', $data);

        $sql = "SELECT * FROM tbl_notification WHERE id =  ?";
        $query = $this->db->query($sql, array(clean_str($post_id)));
        $data_val =  $query->result();

        $val = array(
            'id'=> $data_val[0]->id,
            'read_status'=> $data_val[0]->read_status

         );

        echo json_encode($val);

       // return;
    }

    public function post_action_notification_all_read_ajax(){    
        //post_method();
        $data = array(
        'read_status'=> 1
          );
       // $this->db->where('action_by_id !=',1);
        $this->db->update('tbl_notification', $data);

        $sql = "SELECT * FROM tbl_notification";
        $query = $this->db->query($sql);
        $data_val =  $query->result();

        $val = array(
            'read_status'=> $data_val[0]->read_status

         );

        echo json_encode($val);

       return;
    }

}