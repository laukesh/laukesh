<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class  Phpmailer_lip{

	public function __construct(){

		log_message('debug', 'phpmailer class is loadeded');
	}

	public function load(){

		require_once APPPATH. 'third_party/phpmailer/Exception.php';
		require_once APPPATH. 'third_party/phpmailer/PHPMailer.php';
		require_once APPPATH. 'third_party/phpmailer/SMTP.php';
		
		$mail = new PHPMailer();
		return $mail;
	}
}
