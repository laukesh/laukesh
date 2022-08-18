<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    //input values
    public function input_values()
    {
      date_default_timezone_set("Asia/Kolkata");
      $data = array(
            'id' => $this->input->post('id', true),
            'username' => remove_special_characters($this->input->post('username', true)),
            'email' => $this->input->post('email', true),
            'firstname' => $this->input->post('firstname', true),
            'lastname' => $this->input->post('lastname', true),
            'designation' => $this->input->post('designation', true),
            'phone' => $this->input->post('phone', true),
            'email' => $this->input->post('email', true),
            'password' => $this->input->post('password', true),
            'pro_category_id' => $this->input->post('pro_category_id', true),
            'role' => $this->input->post('role', true),
            'permission' => $this->input->post('permission', true),
            'created_by' => @$this->auth_user->id,
            'updated_by' => $this->auth_user->id,
            'created_at' =>  date('Y-m-d h:i:s'),
            'updated_at' =>  date('Y-m-d h:i:s')
            );
        return $data;
    }

    //change password input values
    public function change_password_input_values()
    {
        $data = array(
            'old_password' => $this->input->post('old_password', true),
            'password' => $this->input->post('password', true),
            'token' => generate_unique_id(),
            'password_confirmation' => $this->input->post('password_confirmation', true)
        );
        return $data;
      }

      /*Naseer khan*/ 

        function myCrypt($value, $key, $iv){
        $encrypted_data = openssl_encrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encrypted_data);
        }
        function myDecrypt($value, $key, $iv){
        $value = base64_decode($value);
        $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if(empty($data)){
        $data = rand();
        }
        return $data;
        }

        function myDecrypt2($value, $key, $iv){
        $value = base64_decode($value);
        $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if(empty($data)){
        $data = rand();
        }
        return $data;
        }
     

    //login
      public function login()
      {
        $this->load->library('bcrypt');
        $data = $this->input_values();
        
        $user = $this->get_user_by_email($data['email']);

        $pass=$data['password'];

        $key="01234567890123456789012345678901"; 
        $vector="1234567890123412";
        $decrypted2 = $this->myDecrypt($pass, $key, $vector);
        $decrypted1 = explode('.', $decrypted2);
        $decrypted  = $decrypted1[0];

        if (!empty($user)) {
            //check password
            if (!$this->bcrypt->check_password($decrypted, $user->password)) {
                $this->session->set_flashdata('error', trans("login_error"));
                return false;
            }
            if ($user->status == 0) {
                $this->session->set_flashdata('error', trans("message_ban_error"));
                return false;
            }
            //set user data
            $user_data = array(
                'vr_sess_user_id' => $user->id,
                'vr_sess_user_email' => $user->email,
                'vr_sess_user_role' => $user->role,
                'token'=>$user->token,
                'vr_sess_logged_in' => true,
                'vr_sess_app_key' => $this->config->item('app_key'),
            );
               $this->session->set_userdata($user_data);
               $this->session->set_userdata('login',$user_data);
            return true;
        } else {
            $this->session->set_flashdata('error', trans("login_error"));
            return false;
        }
    }
     /*Naseer khan*/ 

    public function login_app($email,$password)
    {
        $this->load->library('bcrypt');        
        $user = $this->get_user_by_email($email);

        if (!empty($user)) {
            //check password
            if (!$this->bcrypt->check_password($password, $user->password)) {
               
                return false;
            }
            if ($user->status == 0) {               
                return false;
            }
          
            return $user->id;
        } else {
            
            return false;
        }
    }

    //login direct
    public function login_direct($user)
    {
        //set user data
        $user_data = array(
            'vr_sess_user_id' => $user->id,
            'vr_sess_user_email' => $user->email,
            'vr_sess_user_role' => $user->role,
            'vr_sess_logged_in' => true,
            'vr_sess_app_key' => $this->config->item('app_key'),
        );

        $this->session->set_userdata($user_data);
    }

    //login with facebook
    public function login_with_facebook($fb_user)
    {
        if (!empty($fb_user)) {
            $user = $this->get_user_by_email($fb_user->email);
            //check if user registered
            if (empty($user)) {
                if (empty($fb_user->name)) {
                    $fb_user->name = "user-" . uniqid();
                }
                $username = $this->generate_uniqe_username($fb_user->name);
                $slug = $this->generate_uniqe_slug($username);
                //add user to database
                $data = array(
                    'facebook_id' => $fb_user->id,
                    'email' => $fb_user->email,
                    'email_status' => 1,
                    'token' => generate_unique_id(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => "https://graph.facebook.com/" . $fb_user->id . "/picture?type=large",
                    'user_type' => "facebook",
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->db->insert('users', $data);
                    $user = $this->get_user_by_email($fb_user->email);
                    $this->login_direct($user);
                }
            } else {
                //login
                $this->login_direct($user);
            }
        }
    }

    //login with google
    public function login_with_google($g_user)
    {
        if (!empty($g_user)) {
            $user = $this->get_user_by_email($g_user->email);
            //check if user registered
            if (empty($user)) {
                if (empty($g_user->name)) {
                    $g_user->name = "user-" . uniqid();
                }
                $username = $this->generate_uniqe_username($g_user->name);
                $slug = $this->generate_uniqe_slug($username);
                //add user to database
                $data = array(
                    'google_id' => $g_user->id,
                    'email' => $g_user->email,
                    'email_status' => 1,
                    'token' => generate_unique_id(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => $g_user->avatar,
                    'user_type' => "google",
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->db->insert('users', $data);
                    $user = $this->get_user_by_email($g_user->email);
                    $this->login_direct($user);
                }
            } else {
                //login
                $this->login_direct($user);
            }
        }
    }

    //login with vk
    public function login_with_vk($vk_user)
    {
        if (!empty($vk_user)) {
            $user = $this->get_user_by_email($vk_user->email);
            //check if user registered
            if (empty($user)) {
                if (empty($vk_user->name)) {
                    $vk_user->name = "user-" . uniqid();
                }
                $username = $this->generate_uniqe_username($vk_user->name);
                $slug = $this->generate_uniqe_slug($username);
                //add user to database
                $data = array(
                    'vk_id' => $vk_user->id,
                    'email' => $vk_user->email,
                    'email_status' => 1,
                    'token' => generate_unique_id(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => $vk_user->avatar,
                    'user_type' => "vkontakte",
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->db->insert('users', $data);
                    $user = $this->get_user_by_email($vk_user->email);
                    $this->login_direct($user);
                }
            } else {
                //login
                $this->login_direct($user);
            }
        }
    }

    //register
    public function register()
    {
        $this->load->library('bcrypt');

        $data = $this->auth_model->input_values();


        //secure password
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        $data['user_type'] = "registered";
        $data["slug"] = $this->generate_uniqe_slug($data["username"]);
        $data['status'] = 1;
        $data['token'] = generate_unique_id();
        $data['role'] = 'user';
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');

        if ($this->db->insert('users', $data)) {
            $last_id = $this->db->insert_id();
            if ($this->general_settings->email_verification == 1) {
                $data['email_status'] = 0;
                $this->load->model("email_model");
                $this->email_model->send_email_activation($last_id);
            } else {
                $data['email_status'] = 1;
            }
            return $this->get_user($last_id);
        } else {
            return false;
        }
    }
   function myDecrypt3($value, $key, $iv){
        $value = base64_decode($value);
        $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if(empty($data)){
        $data = rand();
        }
        return $data;
        }
    //add user
    public function add_user()
    {
        $this->load->library('bcrypt');

        $data = $this->auth_model->input_values();
        $pass=$data['password'];

        $key="01234567890123456789012345678901"; 
        $vector="1234567890123412";
        $decrypted2 = $this->myDecrypt3($pass, $key, $vector);       
        $decrypted1 = explode('.', $decrypted2);
        $decrypted  = $decrypted1[0];

        //secure password
        $data['password'] = $this->bcrypt->hash_password($decrypted);    
        $data['user_type'] = "registered";
        $data["slug"] = $this->generate_uniqe_slug($data["username"]);
        $data['role'] = $this->input->post('role', true);
        $data['status'] = 1;
        $data['email_status'] = 1;
        $data['token'] = generate_unique_id();
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');  

        return $this->db->insert('users', $data);
    }

    //generate uniqe username
    public function generate_uniqe_username($username)
    {
        $new_username = $username;
        if (!empty($this->get_user_by_username($new_username))) {
            $new_username = $username . " 1";
            if (!empty($this->get_user_by_username($new_username))) {
                $new_username = $username . " 2";
                if (!empty($this->get_user_by_username($new_username))) {
                    $new_username = $username . " 3";
                    if (!empty($this->get_user_by_username($new_username))) {
                        $new_username = $username . "-" . uniqid();
                    }
                }
            }
        }
        return $new_username;
    }

    //generate uniqe slug
    public function generate_uniqe_slug($username)
    {
        $slug = str_slug($username);
        if (!empty($this->get_user_by_slug($slug))) {
            $slug = str_slug($username . "-1");
            if (!empty($this->get_user_by_slug($slug))) {
                $slug = str_slug($username . "-2");
                if (!empty($this->get_user_by_slug($slug))) {
                    $slug = str_slug($username . "-3");
                    if (!empty($this->get_user_by_slug($slug))) {
                        $slug = str_slug($username . "-" . uniqid());
                    }
                }
            }
        }
        return $slug;
    }

    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('vr_sess_user_id');
        $this->session->unset_userdata('vr_sess_user_email');
        $this->session->unset_userdata('vr_sess_user_role');
        $this->session->unset_userdata('vr_sess_logged_in');
        $this->session->unset_userdata('vr_sess_app_key');
        helper_deletecookie("remember_user_id");
        $this->session->sess_destroy();
    }

    //reset password
    public function reset_password($token)
    {
        $user = $this->get_user_by_token($token);
        if (!empty($user)) {
            $this->load->library('bcrypt');
            $new_password = $this->input->post('password', true);
            $data = array(
                'password' => $this->bcrypt->hash_password($new_password),
                'token' => generate_unique_id()
            );
            //change password
            $this->db->where('id', $user->id);
            return $this->db->update('users', $data);
        }
        return false;
    }

    //verify email
    public function verify_email($user)
    {
        if (!empty($user)) {
            $data = array(
                'email_status' => 1,
                'token' => generate_unique_id()
            );
            $this->db->where('id', $user->id);
            return $this->db->update('users', $data);
        }
        return false;
    }

    //change user role
    public function change_user_role($id, $role)
    {
        $id = clean_number($id);
        $data = array(
            'role' => $role
        );

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    //delete user
    public function delete_user($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);
        if (!empty($user)) {
            if (file_exists(FCPATH . $user->avatar)) {
                @unlink(FCPATH . $user->avatar);
            }
            //delete comments
            @$this->db->where('user_id', $id)->delete('comments');
            //delete reading list
            @$this->db->where('user_id', $id)->delete('reading_lists');
            //delete posts
            $this->db->where('user_id', $id);
            $query = $this->db->get('posts');
            $posts = $query->result();
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    $this->post_admin_model->delete_post($post->id);
                }
            }
            //delete account
            $this->db->where('id', $id);
            return $this->db->delete('users');
        }
        return false;
    }

    //ban user
    public function ban_user($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);
        if (!empty($user)) {

            $data = array(
                'status' => 0
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        } else {
            return false;
        }
    }

    //remove user ban
    public function remove_user_ban($id)
    {
        $id = clean_number($id);
        $user = $this->get_user($id);

        if (!empty($user)) {

            $data = array(
                'status' => 1
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        } else {
            return false;
        }
    }

    //is logged in
    public function is_logged_in()
    {

        //check if user logged in
        if ($this->session->userdata('vr_sess_logged_in') == true && $this->session->userdata('vr_sess_app_key') == $this->config->item('app_key')) {
            $sess_user_id = @clean_number($this->session->userdata('vr_sess_user_id'));
            if (!empty($sess_user_id) && !empty($this->get_user($sess_user_id))) {
                return true;
            }
        }
        return false;
    }

    //function get user
    public function get_logged_user()
    {
        if ($this->session->userdata('vr_sess_logged_in') == true && $this->session->userdata('vr_sess_app_key') == $this->config->item('app_key') && !empty($this->session->userdata('vr_sess_user_id'))) {
            $sess_user_id = @clean_number($this->session->userdata('vr_sess_user_id'));
            if (!empty($sess_user_id)) {
                return $this->get_user($sess_user_id);
            }
        }
        return false;
    }

    //is admin
    public function is_admin()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }
        //check role
        if (user()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    //is author
    public function is_author()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'author') {
            return true;
        } else {
            return false;
        }
    }

    //get user by id
    public function get_user($id)
    {
        $sql = "SELECT * FROM users WHERE users.id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    public function get_user_name($id)
    {
        $sql = "SELECT * FROM users WHERE users.id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }

    //get user by email
    public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM users WHERE users.email = ?";
        $query = $this->db->query($sql, array(clean_str($email)));
        return $query->row();
    }

    public function get_user_logs($email)
    {
        $sql = "SELECT * FROM users WHERE users.email = ?";
        $query = $this->db->query($sql, array(clean_str($email)));
        $result =$query->row();
        date_default_timezone_set('Asia/Kolkata');
        $publicIP = file_get_contents("http://ipecho.net/plain");
        $localIp = gethostbyname(gethostname());
        $divicename = gethostname();
        $data = array(
                     'user_id'            =>$result->id,
                     'action'             =>'login',
                     'ip'                 =>$localIp,
                     'application_medium' =>$divicename,
                     'browser_info'       =>$_SERVER['HTTP_USER_AGENT'],
                     'datetime'           => date('Y-m-d H:i:s')
                 );

         $var = $this->db->insert('user_logs',$data);
         return true;

    }

    public function get_user_fail_logs($email)
    {
        $sql = "SELECT * FROM users WHERE users.email = ?";
        $query = $this->db->query($sql, array(clean_str($email)));
        $result =$query->row();
        date_default_timezone_set('Asia/Kolkata');
        $publicIP = file_get_contents("http://ipecho.net/plain");
        $localIp = gethostbyname(gethostname());
        $divicename = gethostname();
        $data = array(
                     'user_id'            =>$result->id,
                     'action'             =>'Fail',
                     'ip'                 =>$localIp,
                     'application_medium' =>$divicename,
                     'browser_info'       =>$_SERVER['HTTP_USER_AGENT'],
                     'datetime'           => date('Y-m-d H:i:s')
                 );
         //echo '<pre>';print_r($data);die;

         $var = $this->db->insert('user_logs',$data);
          
            return true;

    }

     public function get_user_logs_logout($userid)
    {
        date_default_timezone_set('Asia/Kolkata');
        $publicIP = file_get_contents("http://ipecho.net/plain");
        $localIp = gethostbyname(gethostname());
        $divicename = gethostname();
        $data = array(
                     'user_id'            =>$userid,
                     'action'             =>'logout',
                     'ip'                 => $localIp,
                     'application_medium' => $divicename,
                     'browser_info'       =>$_SERVER['HTTP_USER_AGENT'],
                     'datetime'           => date('Y-m-d H:i:s')
                 );

         $var = $this->db->insert('user_logs',$data);
          //$this->db->last_qurery($var);
          
            return true;

    }

    public function get_fail_count()
    {   
        $localIp = gethostbyname(gethostname());    
        $this->db->select('*');
        $this->db->from('user_logs');
        $this->db->where('action','Fail');
        $this->db->where('ip',$localIp);
        $this->db->where("datetime > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
        $this->db->order_by('datetime', 'DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->num_rows();
        
    }

    //get user by username
    public function get_user_by_username($username)
    {
        $sql = "SELECT * FROM users WHERE users.username = ?";
        $query = $this->db->query($sql, array(clean_str($username)));
        return $query->row();
    }

    //get user by slug
    public function get_user_by_slug($slug)
    {
        $sql = "SELECT * FROM users WHERE users.slug = ?";
        $query = $this->db->query($sql, array(clean_str($slug)));
        return $query->row();
    }

    //get user by token
    public function get_user_by_token($token)
    {
        $sql = "SELECT * FROM users WHERE users.token = ?";
        $query = $this->db->query($sql, array(clean_str($token)));
        return $query->row();
    }

    //get user by vk id
    public function get_user_by_vk_id($vk_id)
    {
        $sql = "SELECT * FROM users WHERE users.vk_id = ?";
        $query = $this->db->query($sql, array($vk_id));
        return $query->row();
    }

    //get users
    public function get_users()
    {
        $sql = "SELECT * FROM users WHERE users.role != 'admin'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get all users
    public function get_all_users()
    {
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get users
    public function get_administrators()
    {
        $sql = "SELECT * FROM users WHERE users.role = 'admin'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get active users
    public function get_active_users()
    {
        $sql = "SELECT * FROM users WHERE users.status = 1 ORDER BY users.username";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get last users
    public function get_last_users()
    {
        $sql = "SELECT * FROM users ORDER BY users.id DESC LIMIT 6";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //user count
    public function get_user_count()
    {
        $sql = "SELECT COUNT(users.id) AS count FROM users";
        $query = $this->db->query($sql);
        return $query->row()->count;
    }

    //get roles and permissions
    public function get_roles_permissions()
    {
        $sql = "SELECT * FROM roles_permissions";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get role
    public function get_role($id)
    {
        $sql = "SELECT * FROM roles_permissions WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //get role by key
    public function get_role_by_key($key)
    {
        //$sql = "SELECT * FROM roles_permissions WHERE role = ?";
        //$query = $this->db->query($sql, $key);
        //$query = $this->db->query($sql, array(clean_str($key)));
        //return $query->row();

        $this->db->where('role',$key);
        $query=$this->db->get('roles_permissions');
        return $query->row();
    }
    public function get_pro_by_key($key)
    {
        //$sql = "SELECT * FROM roles_permissions WHERE role = ?";
        //$query = $this->db->query($sql, $key);
        //$query = $this->db->query($sql, array(clean_str($key)));
        //return $query->row();

        $this->db->where('id',$key);
        $query=$this->db->get('tbl_pru_category');
        return $query->row();
    }

    //update role
    public function update_role($id)
    {
        $data = array(
            'admin_panel' => $this->input->post('admin_panel', true) == 1 ? 1 : 0,
            'add_post' => $this->input->post('add_post', true) == 1 ? 1 : 0,
            'manage_all_posts' => $this->input->post('manage_all_posts', true) == 1 ? 1 : 0,
            'navigation' => $this->input->post('navigation', true) == 1 ? 1 : 0,
            'pages' => $this->input->post('pages', true) == 1 ? 1 : 0,
            'rss_feeds' => $this->input->post('rss_feeds', true) == 1 ? 1 : 0,
            'categories' => $this->input->post('categories', true) == 1 ? 1 : 0,
            'widgets' => $this->input->post('widgets', true) == 1 ? 1 : 0,
            'polls' => $this->input->post('polls', true) == 1 ? 1 : 0,
            'gallery' => $this->input->post('gallery', true) == 1 ? 1 : 0,
            'press_release' => $this->input->post('press_release', true) == 1 ? 1 : 0,
            'sainik_patrika' => $this->input->post('sainik_patrika', true) == 1 ? 1 : 0,
            'comments_contact' => $this->input->post('comments_contact', true) == 1 ? 1 : 0,
            'newsletter' => $this->input->post('newsletter', true) == 1 ? 1 : 0,
            'ad_spaces' => $this->input->post('ad_spaces', true) == 1 ? 1 : 0,
            'users' => $this->input->post('users', true) == 1 ? 1 : 0,
            'seo_tools' => $this->input->post('seo_tools', true) == 1 ? 1 : 0,
            'settings' => $this->input->post('settings', true) == 1 ? 1 : 0,
        );

        $this->db->where('id', $id);
        return $this->db->update('roles_permissions', $data);
    }

    //edit user
    public function edit_user($id)
    {
         $this->load->library('bcrypt');
         $data = array(
            'username' => remove_special_characters($this->input->post('username', true)),
            'email' => $this->input->post('email', true),
            'firstname' => $this->input->post('firstname', true),
            'lastname' => $this->input->post('lastname', true),
            'designation' => $this->input->post('designation', true),
            'phone' => $this->input->post('phone', true),
            'email' => $this->input->post('email', true),
            'password' => $this->bcrypt->hash_password($this->input->post('password')),
            'pro_category_id' => $this->input->post('pro_category_id', true),
            'role' => $this->input->post('role', true),
            'permission' => $this->input->post('permission', true),
            'created_by' => $this->auth_user->id,
            'updated_by' => $this->auth_user->id,
            'created_at' =>  date('Y-m-d h:i:s'),
            'updated_at' =>  date('Y-m-d h:i:s')
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
    }

     public function change_password($id)
    {
         $this->load->library('bcrypt');
         $data = array(
            'password' => $this->bcrypt->hash_password($this->input->post('password')),
            ' tocken'  => generate_unique_id(),
            'created_by' => $this->auth_user->id,
            'updated_by' => $this->auth_user->id
            //'created_at' =>  date('Y-m-d h:i:s'),
            //'updated_at' =>  date('Y-m-d h:i:s')
            );
        
       // echo '<pre>';print_r($data);
       // die; 

            $this->db->where('id', $id);
            $this->db->update('users', $data);
          // echo '===='.$this->db->last_query();
           //die;
    }

    //check slug
    public function check_is_slug_unique($slug, $id)
    {
        $sql = "SELECT * FROM users WHERE users.slug = ? AND users.id != ?";
        $query = $this->db->query($sql, array(clean_str($slug), clean_number($id)));
        if (!empty($query->row())) {
            return true;
        }
        return false;
    }

    //check if email is unique
    public function is_unique_email($email, $user_id = 0)
    {
        $user = $this->auth_model->get_user_by_email($email);
        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }
        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //email taken
                return false;
            } else {
                return true;
            }
        }
    }

    //check if username is unique
    public function is_unique_username($username, $user_id = 0)
    {
        $user = $this->get_user_by_username($username);
        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }
        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //username taken
                return false;
            } else {
                return true;
            }
        }
    }

    //update last seen time
    public function update_last_seen()
    {
        if ($this->auth_check) {
            //update last seen
            $data = array(
                'last_seen' => date("Y-m-d H:i:s"),
            );
            $this->db->where('id', $this->auth_user->id);
            $this->db->update('users', $data);
        }
    }

    //remember me
    public function remember_me($user_id)
    {
        helper_setcookie("remember_user_id", $user_id);
    }

    //check remember
    public function check_remember()
    {
        $user_id = helper_getcookie('remember_user_id');
        if (!empty($user_id)) {
            $user = $this->get_user($user_id);
            if (!empty($user)) {
                $this->login_direct($user);
            }
        }
    }

    //get paginated users
    public function get_paginated_users($per_page, $offset)
    {
        $this->filter_users();
       // $this->db->where('role !=', 'admin');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_paginated_user_logs($per_page, $offset)
    {
        $this->filter_users2();
        //$this->db->where('role !=', 'admin');
        $this->db->order_by('datetime', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('user_logs');
        return $query->result();
    }

    //get paginated users count
    public function get_paginated_users_count()
    {
        $this->db->select('COUNT(id) AS count');
        $this->db->where('role !=', 'admin');
        $this->filter_users();
        $query = $this->db->get('users');
        return $query->row()->count;
    }

    public function get_paginated_user_logs_count()
    {
        $this->db->select('COUNT(id) AS count');
        //$this->db->where('role !=', 'admin');
        $this->filter_users2();
        $query = $this->db->get('user_logs');
        return $query->row()->count;
    }


    //users filter
    public function filter_users()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('username', clean_str($q));
            $this->db->or_like('email', clean_str($q));
            $this->db->group_end();
        }
        $status = trim($this->input->get('status', true));
        if ($status != null && ($status == 1 || $status == 0)) {
            $this->db->where('status', clean_number($status));
        }
        $role = trim($this->input->get('role', true));
        if (!empty($role)) {
            $this->db->where('role', clean_str($role));
        }
        $email_status = trim($this->input->get('email_status', true));
        if ($email_status != null && ($email_status == 1 || $email_status == 0)) {
            $this->db->where('email_status', clean_number($email_status));
        }
        $reward_system = trim($this->input->get('reward_system', true));
        if ($reward_system != null && ($reward_system == 1 || $reward_system == 0)) {
            $this->db->where('reward_system_enabled', clean_number($reward_system));
        }
    }


    public function filter_users2()
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            //$this->db->group_start();
            $this->db->like('action', clean_str($q));
            $this->db->or_like('user_id', clean_str($q));
            $this->db->or_like('ip', clean_str($q));
            //$this->db->or_like('email', clean_str($q));
           // $this->db->group_end();
        }
        
        
    }

    public function validateEmailWithType($email)
    {
      // $query =   $this->db->query("SELECT email, role from users WHERE email='$email' AND role='hq admin' OR email='$email' AND role ='pro_admin'");
     $where = 'email="$email" or role ="pro_admin"';         
      $this->db->select('email','role');
      $this->db->from("users");
      $this->db->where('email',$email);
      $this->db->where('role','hq admin');     
      $this->db->or_where($where);
      $query = $this->db->get();

      if($query->num_rows()==1)
      {
       return $query->num_rows();
      }else{
          return false;
      }
    }

    public function updateTocken($data, $email)
    {
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function resetPassword($tocken)
    {

      $where = 'email="$email" or role ="pro_admin"';         
      $this->db->select('reset_password_token_status','reset_password_token','expired_token');
      $this->db->from("users");
      $this->db->where('reset_password_token',$tocken);
      $this->db->where('reset_password_token_status','1');     
      $this->db->or_where($where);
      $query = $this->db->get();


      if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function updateNewPassword($tockenPassword, $tocken)
    {
        $this->db->where('reset_password_token', $tocken);
        $this->db->update('users', $tockenPassword);

        // echo $this->db->last_query(); die;
    }
}
