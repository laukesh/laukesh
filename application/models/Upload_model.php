<?php defined('BASEPATH') or exit('No direct script access allowed');

//include image resize library
require_once APPPATH . "third_party/intervention-image/vendor/autoload.php";

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class Upload_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->img_quality = 85;
    }

    //upload temp image
    public function upload_temp_image($file_name, $response)
    {
        if (isset($_FILES[$file_name])) {
            if (empty($_FILES[$file_name]['name'])) {
                return null;
            }
        }
        $config['upload_path'] = './uploads/tmp/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
        $config['file_name'] = 'img_' . generate_unique_id();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)){         
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                if ($response == 'array') {
                    return $data['upload_data'];
                } else {
                    return $data['upload_data']['full_path'];
                }
            }
            return null;
        } else {
            return null;
        }
    }

    public function upload_temp_image2($file_name, $response)
    {
        $config['upload_path'] = './uploads/quiz/';
       // $config['allowed_types'] = 'pdf';
       // $config['file_name'] = $file_name;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                if ($response == 'array') {
                    return $data['upload_data'];
                } else {
                    return $data['upload_data']['full_path'];
                }
            }
            return null;
        } else {
            return null;
        }
    }




    public function circular_upload($file_name)
    {   
           $path = 'uploads/circular';
                     $path2 = 'uploads/circular/' . date("Y");
                     $path3 = 'uploads/circular/' . date("Y") . '/' . date("m") .'/';

            
                if(!is_dir($path)){
                   mkdir($path,0655);
                     mkdir($path2,0655);
                       mkdir($path3,0655);
                 }
                 else{
                  if(!is_dir($path2)){
                      mkdir($path2,0655);
                       mkdir($path3,0655);
                         
                   }
                   else{
                     if(!is_dir($path3)){
                      mkdir($path3,0655);
                         
                   }
                   }
                 }

                $config = array();
                $config['upload_path']          = $path3; 
                $config['file_name']            = $file_name; 
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 120000000;
                $config['max_width']            = 10248;
                $config['max_height']           = 7688;
        
        $this->load->library('upload',$config); 
        $this->upload->initialize($config);
        //  if(!is_dir($date_directory)){
        //   @mkdir($date_directory, 0777, true);
        // }
       if ( ! $this->upload->do_upload('file')) {
        throw new Exception($this->upload->display_errors());
       } else {
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];
       }
        return $path3.$filename;
    }

     public function document_upload($file_name)
    {   
        $path = 'uploads/document';
        $path2 = 'uploads/document/' . date("Y");
        $path3 = 'uploads/document/' . date("Y") . '/' . date("m") .'/';

                  
                if(!is_dir($path)){
                   mkdir($path,755,true);
                     mkdir($path2,755,true);
                       mkdir($path3,755,true);
                 }
                 else{
                  if(!is_dir($path2)){
                      mkdir($path2,755,true);
                       mkdir($path3,755,true);
                         
                   }
                   else{
                     if(!is_dir($path3)){
                      mkdir($path3,755,true);
                         
                   }
                   }
                 }

                $config = array();
                $config['upload_path']          = $path3; 
                $config['file_name']            = $file_name; 
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 120000000;
                $config['max_width']            = 10248;
                $config['max_height']           = 7688;
        
        $this->load->library('upload',$config); 
        $this->upload->initialize($config);
        //  if(!is_dir($date_directory)){
        //   @mkdir($date_directory, 0777, true);
        // }
       if ( ! $this->upload->do_upload('file')) {
        throw new Exception($this->upload->display_errors());
       } else {
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];
       }
        return $path3 .$filename;
    }

     public function download_upload($file_name)
    {   
        $path   =  'uploads/download';
       $path2 = 'uploads/download/' . date("Y");
       $path3 = 'uploads/download/' . date("Y") . '/' . date("m") .'/';


                if(!is_dir($path)){
                   mkdir($path,777,true);
                     mkdir($path2,777,true);
                       mkdir($path3,777,true);
                 }
                 else{
                  if(!is_dir($path2)){
                      mkdir($path2,777,true);
                       mkdir($path3,777,true);
                         
                   }
                   else{
                     if(!is_dir($path3)){
                      mkdir($path3,777,true);                         
                   }
                   }
               }

                $config = array();
                $config['upload_path']          = $path3; 
                $config['file_name']            = $file_name; 
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 120000000;
                $config['max_width']            = 10248;
                $config['max_height']           = 7688;
        
        $this->load->library('upload',$config); 
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('file')) {
        throw new Exception($this->upload->display_errors());
        } else {
        $uploadData = $this->upload->data(); 
        $filename = $uploadData['file_name'];
        }
        return $path3.$filename;
    }


     public function sainik_samachar_upload($file_name)
    {   
         if(!empty($file_name)){
           $path = 'uploads/sainik_samachar/image';
             $path2 = 'uploads/sainik_samachar/image/' . date("Y");
               $path3 = 'uploads/sainik_samachar/image/' . date("Y") . '/' . date("m") .'/';


                if(!is_dir($path)){
                  mkdir($path,755, true);
                   mkdir($path2,755, true);
                     mkdir($path3,755, true);
                 }
                 else{
                  if(!is_dir($path2)){
                      mkdir($path2,755, true);
                       mkdir($path3,755, true);
                         
                   }
                   else{
                     if(!is_dir($path3)){
                      mkdir($path3,755, true);
                         
                   }
                   }
                 }
            
                $config = array();
                $config['upload_path']          = $path3; 
                $config['file_name']            = $file_name; 
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 10000000;
                $config['max_width']            = 10248;
                $config['max_height']           = 7688;
        
        $this->load->library('upload',$config); 
        $this->upload->initialize($config);
        // echo '========='.$this->upload->do_upload('sainik_patrika_image');
       if ( ! $this->upload->do_upload('sainik_patrika_image')) {
        //echo '====';
        //throw new Exception($this->upload->display_errors());
       } else {
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];
       }
       return $path3.$filename;
      }
        
    }

    public function pratika_upload($file_name)
    {   
       $cleanfilename = $file_name;

         if(isset($cleanfilename)){
           $path = 'uploads/sainik_samachar';
             $path2 = 'uploads/sainik_samachar/' . date("Y");
               $path3 = 'uploads/sainik_samachar/' . date("Y") . '/' . date("m") .'/';


              if(!is_dir($path)){
                 mkdir($path,755, true);
                   mkdir($path2,755, true);
                     mkdir($path3,755, true);
               }
               else{
                if(!is_dir($path2)){
                    mkdir($path2,755, true);
                     mkdir($path3,755, true);
                       
                 }
                 else{
                   if(!is_dir($path3)){
                    mkdir($path3,755, true);
                       
                 }
                 }
               }
                $config = array();
                $config['upload_path']          = $path3; 
                $config['file_name']            = $cleanfilename; 
                $config['allowed_types']        = "*";
                $config['max_size']             = 120000000;
                $config['max_width']            = 10248;
                $config['max_height']           = 7688;
        
        $this->load->library('upload',$config); 
        $this->upload->initialize($config);
        //  if(!is_dir($date_directory)){
        //   @mkdir($date_directory, 0777, true);
        // }
       if ( ! $this->upload->do_upload('file')) {
        throw new Exception($this->upload->display_errors());
       } else {
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];
       }

        return $path3 .$filename;
       }
    }

    //post gif image upload
    public function post_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('images');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/images/' . $date_directory . $file_name);
        return 'uploads/images/' . $date_directory . $file_name;
    }

    //post big image upload
    public function post_big_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('images') . 'image_750x500_' . uniqid() . '.jpg';
        $new_path = 'uploads/images/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(750, 500);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //post default image upload
    public function post_default_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('images') . 'image_750x_' . uniqid() . '.jpg';
        $new_path = 'uploads/images/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(750, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //post slider image upload
    public function post_slider_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('images') . 'image_600x460_' . uniqid() . '.jpg';
        $new_path = 'uploads/images/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(600, 460);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //post mid image upload
    public function post_mid_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('images') . 'image_380x226_' . uniqid() . '.jpg';
        $new_path = 'uploads/images/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(380, 226);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //post small image upload
    public function post_small_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('images') . 'image_140x98_' . uniqid() . '.jpg';
        $new_path = 'uploads/images/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(140, 98);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //quiz gif image upload
    public function quiz_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('quiz');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/quiz/' . $date_directory . $file_name);
        return 'uploads/quiz/' . $date_directory . $file_name;
    }

    //quiz default image upload
    public function quiz_default_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('quiz') . 'image_750x_' . uniqid() . '.jpg';
        $new_path = 'uploads/quiz/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(750, 500);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //quiz small image upload
    public function quiz_small_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('quiz') . 'image_300_' . uniqid() . '.jpg';
        $new_path = 'uploads/quiz/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->fit(300, 250);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //gallery big image upload
    public function gallery_big_image_upload($path,$ext)
    {
        // $new_name = $this->create_directory_by_date('sainik_samachar_photo') . 'image_1600_' . uniqid() .'.'. $ext;

        $date         = date('Y-m-d');
        $date_format  = str_replace("-","_",$date);
        $time         = date('H:i:s');
        $time_formate =  str_replace(":","_",$time);
        $new_name     = "sainik_samachar_photo_".$date_format.'_'.$time_formate.'.'.$ext;


        $new_path = 'uploads/gallery/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }


    public function sainik_patrika_big_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('sainik_patrika') . 'image_1600_' . uniqid() . '.jpg';
        $new_path = 'uploads/sainik_patrika/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

      public function infographic_big_image_upload($path,$ext)
    {
        $new_name = $this->create_directory_by_date('infographic') . 'image_1600_' . uniqid() .'.'. $ext;
        $new_path = 'uploads/infographic/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

     public function infographic_small_image_upload($path,$ext)
    {
        $new_name = $this->create_directory_by_date('infographic') . 'image_550_' . uniqid() .'.'. $ext;
        $new_path = 'uploads/infographic/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(550, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }


         public function event_big_image_upload($path)
    {
        $new_name = $this->create_directory_by_date('event') . 'image_1600x_' . uniqid() . '.jpg';
        $new_path = 'uploads/event/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

  

    public function logo_gallery_small_image_upload($path,$ext)
    {
        
        $new_name = $this->create_directory_by_date('logo_gallery') . 'image_500x_' . uniqid() .'.' .$ext; 
        $new_path = 'uploads/logo_gallery/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(500, null, function ($constraint){
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

     public function logo_gallery_gif_image_upload($file_name,$ext)
    {
        $date_directory = $this->create_directory_by_date('logo_gallery');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/logo_gallery/' . $date_directory . $file_name.'.' .$ext);
        return 'uploads/logo_gallery/' . $date_directory . $file_name;
    }



     public function press_release_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('press_release');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/press_release/' . $date_directory . $file_name);
        return 'uploads/press_release/' . $date_directory . $file_name;
    }


    public function press_release_small_image_upload($path,$ext)
    {
        $new_name = $this->create_directory_by_date('press_release') . 'image_500x_' . uniqid() .'.' .$ext;
        $new_path = 'uploads/press_release/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(500,350, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

      public function press_release_big_image_upload($path,$ext)
    {
        $new_name = $this->create_directory_by_date('press_release') . 'image_1000x_' . uniqid() .'.' .$ext;
        $new_path = 'uploads/press_release/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(1000,700, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }



    //gallery small image upload
    public function gallery_small_image_upload($path,$ext)
    {
        // $new_name = $this->create_directory_by_date('gallery') . 'image_500x_' . uniqid() .'.' .$ext;

        $date         = date('Y-m-d');
        $date_format  = str_replace("-","_",$date);
        $time         = date('H:i:s');
        $time_formate =  str_replace(":","_",$time);
        $new_name     = "sainik_samachar_photo_".$date_format.'_'.$time_formate.'.'.$ext;

        $new_path = 'uploads/gallery/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(350,350, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

     public function video_small_image_upload($path,$ext)
    {
        // $new_name = $this->create_directory_by_date('video_image') . 'image_600x_' . uniqid() .'.' .$ext;

        $date         = date('Y-m-d');
        $date_format  = str_replace("-","_",$date);
        $time         = date('H:i:s');
        $time_formate =  str_replace(":","_",$time);
        $new_name     = "sainik_samachar_video_cover_image_".$date_format.'_'.$time_formate.'.'.$ext;


        $new_path = 'uploads/video_image/' . $new_name;
        $img = Image::make($path)->orientate();
        $img->resize(600,400, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //gallery gif image upload
    public function gallery_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('gallery');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/gallery/' . $date_directory . $file_name);
        return 'uploads/gallery/' . $date_directory . $file_name;
    }

     public function sainik_samachar_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('sainik_samachar');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/gallery/' . $date_directory . $file_name);
        return 'uploads/sainik_samachar/' . $date_directory . $file_name;
    }

    public function infographic_gif_image_upload($file_name)
    {
        $date_directory = $this->create_directory_by_date('infographic');
        rename(FCPATH . 'uploads/tmp/' . $file_name, FCPATH . 'uploads/infographic/' . $date_directory . $file_name);
        return 'uploads/infographic/' . $date_directory . $file_name;
    }

    //avatar image upload
    public function avatar_upload($user_id, $path)
    {
        $new_path = 'uploads/profile/avatar_' . $user_id . '_' . uniqid() . '.jpg';
        $img = Image::make($path)->orientate();
        $img->fit(240, 240);
        $img->save(FCPATH . $new_path, $this->img_quality);
        return $new_path;
    }

    //logo image upload
    public function logo_upload($file_name)
    {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
        $config['file_name'] = 'logo_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/logo/' . $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    //favicon image upload
    public function favicon_upload($file_name)
    {
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = 'favicon_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/logo/' . $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    public function press_release_video_upload($file_name)
    {
        $config['upload_path'] = './uploads/videos/';
        $config['allowed_types'] = 'mp4';
        $config['file_name'] = 'press_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/videos/' . $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    //ad upload
    public function ad_upload($file_name)
    {
        $config['upload_path'] = './uploads/blocks/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = 'block_' . uniqid();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return 'uploads/blocks/' . $data['upload_data']['file_name'];
            }
            return null;
        } else {
            return null;
        }
    }

    //upload file
    public function upload_file($file_name)
    {
        $date_directory = $this->create_directory_by_date('files');
        $name = $this->generate_file_name($file_name);
        if (empty($name)) {
            $name = "file_" . uniqid();
        }
        $config['upload_path'] = './uploads/files/' . $date_directory;
        $config['allowed_types'] = '*';
        $config['file_name'] = $name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                $file_array = array(
                    'file_name' => $data['upload_data']['file_name'],
                    'file_path' => 'uploads/files/' . $date_directory . $data['upload_data']['file_name']
                );
                return $file_array;
            }
            return null;
        } else {
            return null;
        }
    }

    //upload video
    public function upload_video($file_name)
    {
        $date_directory = $this->create_directory_by_date('videos');
        $name = $this->generate_file_name($file_name);
        if (empty($name)) {
            $name = "video_" . uniqid();
        }
        $config['upload_path'] = './uploads/videos/' . $date_directory;
        $config['allowed_types'] = '*';
        $config['file_name'] = $name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                $file_array = array(
                    'media_video_path' => 'uploads/videos/' . $date_directory . $data['upload_data']['file_name']
                );
                return $file_array;
            }
            return null;
        } else {
            return null;
        }
    }

    //upload audio
    public function upload_audio($file_name)
    {
        $date_directory = $this->create_directory_by_date('audios');
        $name = $this->generate_file_name($file_name);
        if (empty($name)) {
            $name = "audio_" . uniqid();
        }
        $config['upload_path'] = './uploads/audios/' . $date_directory;
        $config['allowed_types'] = '*';
        $config['file_name'] = $name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_name)) {
            $data = array('upload_data' => $this->upload->data());
            if (isset($data['upload_data']['full_path'])) {
                return ['file_path' => 'uploads/audios/' . $date_directory . $data['upload_data']['file_name'], 'file_name' => $data['upload_data']['client_name']];
            }
            return null;
        } else {
            return null;
        }
    }

    //create directory by date
    public function create_directory_by_date($target_folder)
    {
        $year = date("Y");
        $month = date("m");

        $directory_year = FCPATH . "uploads/" . $target_folder . "/" . $year . "/";
        $directory_month = FCPATH . "uploads/" . $target_folder . "/" . $year . "/" . $month . "/";

        //If the directory doesn't already exists.
        if (!is_dir($directory_month)) {
            //Create directory.
            @mkdir($directory_month, 0755, true);
        }

        //add index.html if does not exist
        if (!file_exists($directory_year . "index.html")) {
            copy(BASEPATH . "core/index.html", $directory_year . "index.html");
        }
        if (!file_exists($directory_month . "index.html")) {
            copy(BASEPATH . "core/index.html", $directory_month . "index.html");
        }

        return $year . "/" . $month . "/";
    }

    //check file mime type
    public function check_file_mime_type($file_name, $allowed_types)
    {
        if (!isset($_FILES[$file_name])) {
            return false;
        }
        if (empty($_FILES[$file_name]['name'])) {
            return false;
        }
        $ext = pathinfo($_FILES[$file_name]['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $allowed_types)) {
            return true;
        }
        return false;
    }

    //generate file name
    public function generate_file_name($file_name)
    {
        if (!empty($_FILES[$file_name]['name'])) {
            $name = @pathinfo(@$_FILES[$file_name]['name'], PATHINFO_FILENAME);
            $name = str_replace('.', '-', $name);
            return str_slug($name);
        }
    }

    //get file original name
    public function get_file_original_name($file)
    {
        if (!empty($file['name'])) {
            return pathinfo($file['name'], PATHINFO_FILENAME);
        }
        return '';
    }

    //get file original name with extension
    public function get_file_original_name_with_extension($data)
    {
        if (!empty($data['name'])) {
            return $data['name'];
        }
        return '';
    }

    //get file name without extension
    public function get_file_name_without_extension($file_name)
    {
        if (!empty($file_name)) {
            return @mb_convert_encoding((string)pathinfo($file_name, PATHINFO_FILENAME), 'UTF-8', 'auto');
        }
        return '';
    }

    //get file type
    public function get_file_type($file_name)
    {
        if (!empty($_FILES[$file_name]['name'])) {
            $ext = pathinfo($_FILES[$file_name]['name'], PATHINFO_EXTENSION);
            if ($ext == 'mp3' || $ext == 'MP3' || $ext == 'wav' || $ext == 'WAV' || $ext == 'ogg' || $ext == 'OGG' || $ext == 'm3u' || $ext == 'M3U') {
                return 'audio';
            } elseif ($ext == 'mp4' || $ext == 'MP4' || $ext == 'webm' || $ext == 'WEBM') {
                return 'video';
            }
        }
        return 'file';
    }

    //delete temp image
    public function delete_temp_image($path)
    {
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}