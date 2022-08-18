<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
  <style>
#text {display:none;color:red}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo html_escape($title); ?> - <?php echo trans("admin"); ?>&nbsp;<?php echo html_escape($this->settings->site_title); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($this->visual_settings); ?>"/>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/_all-skins.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">

    <script  src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <script  src="<?php echo base_url(); ?>assets/admin/js/crypto-js.min.js"></script>
    


</head>

<body class="hold-transition login-page" style="background-color:lightblue;">
<div class="login-box" style="text-align: center;">
<img src="<?php echo base_url(); ?>/assets-front/images/sainik_logo1.png" alt="Sainik Patrika Logo">
    <div class="login-logo"> 
        <a href="<?php echo base_url(); ?>admin/login"><b><?php //echo html_escape($this->settings->application_name); ?>Sainik Samachar Admin Portal
</b>&nbsp;<?php //echo trans("panel"); ?></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <h4 class="login-box-msg"><?php echo trans("login"); ?></h4>

        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>

        <!-- form start -->
        <?php echo form_open('common_controller/admin_login_post'); ?>

        <div class="form-group has-feedback">
            <input type="email" name="email" maxlength="32" minlength="6"  class="form-control form-input"
                   placeholder="<?php echo trans("placeholder_email"); ?>"
                   value="<?php echo old('email'); ?>"<?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="input-group">
        <input type="password" name="password" maxlength="16" minlength="6" class="form-control form-input myInput" id="txtPassword" placeholder="password">
        <span onclick="showHide()" id="showpassword"class="input-group-addon glyphicon glyphicon-eye-open "></span>

        </div>
         <p class="mt-1 pt-1"><?php //echo $error;?></p>
         <span id="text_caps" class="pull-left">WARNING! Caps lock is ON.</span>
        <style>

</style>

<body>

       <div class="row">
        <div class="col-md-4" id="captcha">
       
        
           <?php echo $captcha;?>
      
     
    </div>

         <div class="col-md-6" style="position:relative;">    
        <input type="text" name="captcha_chk" value="" style="position: relative; height: 32px;     margin-left: -20px;">
        
       
    </div>
    <div class="col-md-2">
        <a href="#" class="btn btn-primary btn-sm btn-flat" id="demo" style="position: absolute;
    left: 5px;
    width: 38px;">
                 <span class="glyphicon glyphicon-refresh"></span></a>
    </div>
</div>
 
<br>
    <div class="row">
        <div class="col-sm-6">
       
        <label>
          <a href="<?php echo admin_url();?>forgot-password" title="Forgot Password">Forgot Password?</a>
        </label>
       
    </div>

        <!-- /.col -->
        <div class="col-sm-4" style="margin-left:55px;">
            <button type="submit"  onclick="return encrypt()"  class="btn btn-primary btn-block btn-flat">
                <?php echo trans("login"); ?>
            </button>
        </div>
        <!-- /.col -->
    </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js">  
</script>  

<?php echo form_close(); ?><!-- form end -->

    </div><!-- /.login-box-body -->
    <div class="text-center m-t-15">
        <a class="btn btn-md" href="<?php echo lang_base_url(); ?>"><?php ///echo trans("btn_goto_home"); ?></a>
    </div>

</div><!-- /.login-box -->
</body>
</html>

<script  src="<?php echo base_url(); ?>assets/admin/js/common-custom.js"></script>
<script type="text/javascript">
      $('#demo').click(function(event){
        var baseURL = '<?php echo admin_url(); ?>';
        $.ajax({
        url:baseURL+'login/captcha',
        method: 'GET',
        //data: {},
        dataType:"json",
        success: function(data){
            $('#captcha').html(data);
        }
        });
        });     

</script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
   jQuery(function() {
    jQuery('input').attr('autocomplete', 'off');

   });
});
</script>


<!-- Naseer khan -->

<script type="text/javascript">
    function encrypt(){
    var pass       = jQuery('#txtPassword').val()+"."+'<?php echo $random_number; ?>';
    var DataKey    = CryptoJS.enc.Utf8.parse("01234567890123456789012345678901");
    var DataVector = CryptoJS.enc.Utf8.parse("1234567890123412");
    var encrypted  = CryptoJS.AES.encrypt(pass, DataKey, { iv: DataVector });
    jQuery('#txtPassword').val(encrypted);
   return true;
   }
</script>

<!-- Naseer khan -->