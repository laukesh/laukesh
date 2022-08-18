<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page" style="background-color:lightblue;">
<div class="login-box" style="text-align: center;">
<img src="<?php echo base_url(); ?>/assets-front/images/sainik_logo1.png" alt="Sainik Patrika Logo">
    <div class="login-logo"> 
        <a href="<?php echo base_url(); ?>admin/login"><b><?php //echo html_escape($this->settings->application_name); ?>Sainik Samachar Admin Portal
</b>&nbsp;<?php //echo trans("panel"); ?></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <h4 class="login-box-msg"><?php echo trans("forgot_password"); ?></h4>

        <!-- include message block -->
        <?php $this->load->view('partials/_messages'); ?>

        <!-- form start -->
        <?php echo form_open('common_controller/admin_forget_password_post'); ?>

        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control form-input"
                   placeholder="<?php echo trans("placeholder_email"); ?>"
                   value="<?php echo old('email'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

     <!--    <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control form-input"
                   placeholder="<?php //echo trans("placeholder_password"); ?>"
                   value="<?php //echo old('password'); ?>" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> required>
            <span class=" glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <p id="captImg"><?php echo $captchaImg; ?></p> -->

        <div class="row">
            <div class="col-sm-4">
          <div class="checkbox icheck">
            <label>
              <a href="<?php echo admin_url();?>login" title="Go Back to Login">Login</a>
            </label>
          </div>
        </div>

            <!-- /.col -->
            <div class="col-sm-4" style="margin-left: 33%;">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    <?php echo trans("submit"); ?>
                </button>
            </div>
            <!-- /.col -->
        </div>

        <?php echo form_close(); ?><!-- form end -->

    </div><!-- /.login-box-body -->
    <div class="text-center m-t-15">
        <a class="btn btn-md" href="<?php echo lang_base_url(); ?>"><?php ///echo trans("btn_goto_home"); ?></a>
    </div>

</div><!-- /.login-box -->
</body>
</html>