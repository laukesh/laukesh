<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Latest_press_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
		$this->load->model('api/auth_model');
		date_default_timezone_set('Asia/Kolkata');
		
    }

    public function index()
    {
      echo '====';die();

    }
}