<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_ajaxcontroller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->post_load_more_count = 6;
        $this->comment_limit = 5;
        $this->load->helper('url');
        $this->load->model("home_model");
        //$this->load->model("api_model");
        $this->load->model("navigation_model");
        $this->load->library("pagination");
        $this->load->library("ajax_pagination");
    }


    public function index()
    {
 
      get_method();
       
        $config = array();
        $config["base_url"] = base_url() . "photo-list";
        $config["total_rows"] = $this->home_model->get_paginated_images_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data["photo"] = $this->home_model->get_gallery_web($lang_id,$config["per_page"],$page,$gallery_category_id,$gallery_from_date,$gallery_to_date,$title);

       //$this->load->view('partials/_header', $data);
       $this->load->view('ajax_photo_list', $data);
       //$this->load->view('partials/_footer', $data);
    }
}