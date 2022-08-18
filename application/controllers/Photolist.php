 <?php defined('BASEPATH') or exit('No direct script access allowed');

 class Photolist extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->post_load_more_count = 6;
        $this->comment_limit = 5;
        $this->load->helper('url');
        $this->load->model("home_model");
        $this->load->library("pagination");
    }

 public function index()
    {  
       
        $config = array();
        $config["base_url"] = base_url(). "Photolist";
        $config["total_rows"] = $this->home_model->get_count();
        $config["per_page"] = 1;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);

        echo $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["links"] = $this->pagination->create_links();

        //echo '<pre>'.print_r($data["links"]);

        $data['photo'] = $this->home_model->photo_details($config["per_page"], $page);
       
        $data['photo'] = $this->home_model->photo_details();
        $data['photo_categories'] = $this->home_model->photo_categories();
        // $data['press_release'] = $this->home_model->press_release();
         $this->load->view('partials/_header', $data);
         $this->load->view('photos', $data);
         $this->load->view('partials/_footer', $data);
    }
}

