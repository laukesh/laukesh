<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha_controller extends Admin_Core_Controller
{

	echo '=====';die;
  
	 $files = glob('./captcha/*'); // get all file names
	foreach($files as $file)
	{ 
	  // iterate files
	  if(is_file($file))
	    unlink($file); // delete file
	}
  
}