<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$pro = $this -> db
           -> select('id')
           -> where('id', $this->auth_user->pro_category_id)
           -> where('is_active', 1)
           -> limit(1)
           -> get('tbl_pru_category')
           ->result_array();

?>

<!DOCTYPE html>
<html>
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo xss_clean($title); ?> - <?php echo trans("admin"); ?>&nbsp;<?php echo xss_clean($this->settings->site_title); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($this->visual_settings); ?>"/>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/select2.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/vendor/font-icons/css/font-icon.min.css" rel="stylesheet"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/_all-skins.min.css">
    
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables_themeroller.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/icheck/square/purple.css">
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.min.css">
    <!-- Tags Input -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/tagsinput/jquery.tagsinput.min.css">
    <!-- Color Picker css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- File Manager css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/file-manager/file-manager.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <!-- Upload -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/file-uploader/css/jquery.dm-uploader.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/file-uploader/css/styles.css"/>
    <!-- Datetimepicker css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">
    
    <!-- RTL -->
    <script>var directionality = "ltr";</script>
    <?php if (!empty($this->control_panel_lang)):
    if ($this->control_panel_lang->text_direction == 'rtl'):?>
    <link href="<?php echo base_url(); ?>assets/admin/css/rtl.css" rel="stylesheet"/>
        <script>directionality = "rtl";</script>
    <?php endif;
    else:
    if ($this->selected_lang->text_direction == "rtl"): ?>
    <link href="<?php echo base_url(); ?>assets/admin/css/rtl.css" rel="stylesheet"/>
        <script>directionality = "rtl";</script>
    <?php endif;
    endif; ?>

   


    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        // var csfr_token_name = "<?php //echo $this->security->get_csrf_token_name(); ?>";
        // var csfr_cookie_name = "<?php //echo $this->config->item('csrf_cookie_name'); ?>";
        // var base_url = "<?php //echo base_url(); ?>";
        // var fb_app_id = "<?php //echo $this->general_settings->facebook_app_id; ?>";
        // var txt_select_image = "<?php //echo trans("select_image"); ?>";
        // var sweetalert_ok = "<?php //echo trans("ok"); ?>";
        // var sweetalert_cancel = "<?php //echo trans("cancel"); ?>";
    </script>
	 <script type="text/javascript" language="javascript">
	 var base_url= '<?php echo base_url(); ?>';
		$(document).ready(function(){
		   jQuery(function() {
			jQuery('input').attr('autocomplete', 'off');

		   });
		});
		</script>
    <Script>
   var myVar;
    myVar = setInterval(alertFunc, 12000);
    //myVar2 = setInterval(alertFunc2, 4000);

   function alertFunc(){
   //data['csfr_token_name'] = $.cookie(csfr_cookie_name);
    //alert('heedddddddddddddddddd');
    data = {'read_status':0};
   $.ajax({
    method:"POST",
    url: base_url + 'notification/fetch_data',
    data:data,
    success:function(data)
    {    //alert(data);
       $('.notification_count').html(data);
     //$('#mobile').val(data);
    }
   });
}

</Script>
<script type="text/javascript">

 function notification_none(){
         setInterval(function() {
        $(".notification_msg").fadeOut();
        }, 5000);

    }

var myVar2;
    myVar2 = setInterval(alertFunc2, 6000);

setTimeout(() => { clearInterval(myVar2); 
    //alert('stop'); 
}, 12000);
   
 function alertFunc2() {
    ///data[csfr_token_name] = $.cookie(csfr_cookie_name);
    //alert('heedddddddddddddddddd');
    data = {'read_status':0};
   $.ajax({
    method:"POST",
    url: base_url + 'notification/fetch_data2',
    data:data,
    //dataType : "",
    success:function(data)
    {  
        //alert(data);
         var returnedData = JSON.parse(data); 
             //alert(returnedData.notification);
             //console.log(returnedData.notification);

        jQuery.each(returnedData.data_val, function(index, value){
                    $(".notification_msg").css("display", "block");

             $(".notification_msg").append('<div class="alert alert-success alert-dismissible notification"><a href="#" onlcick="'+notification_none()+'" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Notification!</strong> '+value["name"]+' ('+value["firstname"]+' '+value["lastname"]+') has '+value["action_meta"]+' a Press release titled'+' "'+value["press_release_title"]+'" at '+value["action_at"]+'</div>'); 

               
         });
        e.preventDefault();
    }
   });
}
</Script>
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo admin_url(); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?php //http://localhost/varient/assets-front/images/sainik_logo1.png ?></b> <?php //echo trans("panel"); ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <div class="navbar-custom-menu">
                <?php echo form_open('admin_controller/control_panel_language_post', ['id' => 'form_control_panel_lang']); ?>
                <ul class="nav navbar-nav">
                    <li>
                        <a class="btn btn-sm btn-success pull-left btn-site-prev" target="_blank" href="<?php echo base_url(); ?>"><i class="fa fa-eye"></i> <?php echo trans("view_site"); ?></a>
                    </li>
                   <li>
                   <a href="<?php echo admin_url(); ?>notification">
                    <i  style="color:blue;" class="fa fa-bell"></i>
                    <strong style="color:red;" class="notification_count" style="font-size:17px;">&nbsp;(0)</strong>
                   </a>
                  </li>
                    <li class="dropdown user-menu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-globe"></i>&nbsp;
                            <?php if (!empty($this->control_panel_lang)) {
                                echo $this->control_panel_lang->name;
                            } ?>
                            <span class="fa fa-caret-down"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <?php
                            foreach ($this->languages as $language):
                                $lang_url = base_url() . $language->short_form . "/";
                                if ($language->id == $this->general_settings->site_lang) {
                                    $lang_url = base_url();
                                } ?>
                                <li>
                                    <button type="submit" value="<?php echo $language->id; ?>" name="lang_id" class="control-panel-lang-btn"><?php echo character_limiter($language->name, 20, '...'); ?></button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo get_user_avatar($this->auth_user->avatar); ?>" class="user-image" alt="">
                            <span class="hidden-xs"><?php echo $this->auth_user->username; ?> <i class="fa fa-caret-down"></i> </span>
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                            <li>
                                <a href="<?php echo generate_profile_url($this->auth_user->slug); ?>"><i class="fa fa-user"></i> <?php echo trans("profile"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo generate_url('settings'); ?>"><i class="fa fa-cog"></i> <?php echo trans("update_profile"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo generate_url('settings', 'change_password'); ?>"><i class="fa fa-lock"></i> <?php echo trans("change_password"); ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo generate_url('logout'); ?>"><i class="fa fa-sign-out"></i> <?php echo trans("logout"); ?></a>
                            </li>
                        </ul>
                    </li>
                     
                </ul>
                <?php echo form_close(); ?>
            </div>
        </nav>
        <div id="notification_msg" class="notification_msg notification" style="display:none"></div>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo get_user_avatar($this->auth_user->avatar); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo html_escape($this->auth_user->username); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> <?php echo trans("online"); ?></a>
                </div>
            </div>
           
         

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <!-- <li class="header"><?php //echo trans("main_navigation"); ?></li> -->
                  <?php if($this->auth_user->role == 'pro_admin' || $this->auth_user->role == 'admin' || $this->auth_user->role == 'hq_admin'): ?>
                     <li class="nav-categories">
                       <a href="<?php echo admin_url(); ?>notification">
                        <i class="fa fa-bell"></i>
                            Notifications<span class="notification_count" style="font-size:17px;">&nbsp;(0)</span> 
                      </li> 

                       <?php endif; ?>
                <li class="nav-home <?php is_admin_nav_active(['']); ?>">
                    <a href="<?php echo admin_url(); ?>">
                        <i class="fa fa-home"></i>
                        <span><?php echo trans("home"); ?></span>
                    </a>
                </li>
                <?php if (check_user_permission('navigation')): ?>
                    <li class="nav-navigation">
                        <a href="<?php echo admin_url(); ?>navigation?lang=<?php echo $this->general_settings->site_lang; ?>">
                            <i class="fa fa-th"></i>
                            <span><?php echo trans("navigation"); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php //if (is_admin()): ?>
                   <!--  <li class="nav-themes">
                        <a href="<?php //echo admin_url(); ?>themes">
                            <i class="fa fa-leaf"></i>
                            <span><?php //echo trans("themes"); ?></span>
                        </a>
                    </li> -->
                <?php //endif; ?>
                <?php if (check_user_permission('pages')): ?>
                     <li class="treeview<?php is_admin_nav_active(['add-page', 'pages', 'update-page']); ?>">
                        <a href="#">
                            <i class="fa fa-file-text"></i> <span><?php echo trans("pages"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-page">
                                <a href="<?php echo admin_url(); ?>add-page"><?php echo trans("add_page"); ?></a>
                            </li>
                            <li class="nav-pages">
                                <a href="<?php echo admin_url(); ?>pages"><?php echo trans("pages"); ?></a>
                            </li>
                        </ul>
                    </li> 

                    <?php if (check_user_permission('feedback')): ?>
                     <li class="nav-categories <?php is_admin_nav_active(['pro-category']); ?>">
                       <a href="<?php echo admin_url(); ?>feedback-list">
                        <i class="fa fa-folder-open"></i>
                            <span>Feedback Form Submissions</span></a>
                      </li> 
                       <?php endif; ?>
                <?php endif; ?>
                <?php //if (check_user_permission('add_post')): ?>
                   <!--  <li class="nav-post-format">
                        <a href="<?php //echo admin_url(); ?>post-format">
                            <i class="fa fa-file"></i>
                            <span><?php ///echo trans("add_post"); ?></span>
                        </a>
                    </li>
                    <li class="nav-import-posts">
                        <a href="<?php //echo admin_url(); ?>bulk-post-upload">
                            <i class="fa fa-cloud-upload"></i>
                            <span><?php //echo trans("bulk_post_upload"); ?></span>
                        </a>
                    </li>
                     <li class="nav-import-posts">
                        <a href="<?php //echo admin_url(); ?>event">
                            <i class="fa fa-cloud-upload"></i>
                            <span><?php //echo trans("event"); ?>Events</span>
                        </a>
                    </li>
                    <li class="nav-import-posts">
                        <a href="<?php //echo admin_url(); ?>sainik-pratika">
                            <i class="fa fa-cloud-upload"></i>
                            <span><?php //echo trans("event"); ?>SainikPratika</span>
                        </a>
                    </li> -->
                    <?php if (check_user_permission('logo_gallery')): ?>
                     <li class="nav-import-posts <?php is_admin_nav_active(['logo','add-logo']); ?>">
                        <a href="<?php echo admin_url(); ?>logo">
                            <i class="fa fa-cloud-upload"></i>
                            <span><?php //echo trans("event"); ?>Logo Gallery</span>
                        </a>
                    </li>
                  <?php endif; ?>
                    <?php if (check_user_permission('pro_categories')): ?>
                     <li class="nav-categories <?php is_admin_nav_active(['pro-category']); ?>">
                       <a href="<?php echo admin_url(); ?>pro-category">
                        <i class="fa fa-folder-open"></i>
                            <span>PRO Categories</a></span></a>
                      </li> 
                       <?php endif; ?>

                    <!-- <li class="treeview<?php //is_admin_nav_active(['posts', 'slider-posts', 'featured-posts', 'breaking-news', 'recommended-posts', 'pending-posts', 'scheduled-posts', 'drafts', 'update-post']); ?>">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span><?php ///echo trans("posts"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-posts">
                                <a href="<?php //echo admin_url(); ?>posts"><?php //echo trans("posts"); ?></a>
                            </li>
                            <?php //if (check_user_permission('manage_all_posts')): ?>
                                <li class="nav-slider-posts">
                                    <a href="<?php //echo admin_url(); ?>slider-posts"><?php //echo trans("slider_posts"); ?></a>
                                </li>
                                <li class="nav-featured-posts">
                                    <a href="<?php //echo admin_url(); ?>featured-posts"><?php //echo trans("featured_posts"); ?></a>
                                </li>
                                <li class="nav-breaking-news">
                                    <a href="<?php //echo admin_url(); ?>breaking-news"><?php //echo trans("breaking_news"); ?></a>
                                </li>
                                <li class="nav-recommended-posts">
                                    <a href="<?php //echo admin_url(); ?>recommended-posts"><?php //echo trans("recommended_posts"); ?></a>
                                </li>
                            <?php //endif; ?>
                            <li class="nav-pending-posts">
                                <a href="<?php //echo admin_url(); ?>pending-posts"><?php //echo trans("pending_posts"); ?></a>
                            </li>
                            <li class="nav-scheduled-posts">
                                <a href="<?php //echo admin_url(); ?>scheduled-posts"><?php //echo trans("scheduled_posts"); ?></a>
                            </li>
                            <li class="nav-drafts">
                                <a href="<?php //echo admin_url(); ?>drafts"><?php //echo trans("drafts"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php //if (check_user_permission('rss_feeds')): ?>
                    <!-- <li class="treeview<?php //is_admin_nav_active(['import-feed', 'feeds', 'update-feed']); ?>">
                        <a href="#">
                            <i class="fa fa-rss"></i> <span><?php //echo trans("rss_feeds"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-import-feed">
                                <a href="<?php //echo admin_url(); ?>import-feed"><?php //echo trans("import_rss_feed"); ?></a>
                            </li>
                            <li class="nav-feeds">
                                <a href="<?php //echo admin_url(); ?>feeds"><?php //echo trans("rss_feeds"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php //if (check_user_permission('categories')): ?>
                    <!-- <li class="treeview<?php //is_admin_nav_active(['categories', 'subcategories', 'update-category', 'update-subcategory']); ?>">
                        <a href="#">
                            <i class="fa fa-folder-open"></i> <span><?php //echo trans("categories"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">

                            <li class="nav-categories">
                                <a href="<?php //echo admin_url(); ?>add-press"><?php //echo trans("categories"); ?>Add Press Release</a>
                            </li>

                               <li class="nav-categories">
                                <a href="<?php //echo admin_url(); ?>categories"><?php //echo trans("categories"); ?>View Press Releases</a>
                            </li>

                            <li class="nav-categories">
                                <a href="<?php //echo admin_url(); ?>categories"><?php //echo trans("categories"); ?></a>
                            </li>
                            <li class="nav-subcategories">
                                <a href="<?php //echo admin_url(); ?>subcategories"><?php //echo trans("subcategories"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>

                 <?php if (check_user_permission('sainik_patrika')): ?>
                    <li class="treeview<?php is_admin_nav_active(['add-sainik-samachar', 'view-sainik-samachar', 'update-sainik-samachar']); ?>">
                        <a href="#">
                            <i class="fa fa-folder-open"></i> <span><?php //echo trans("categories"); ?>Sainik Samachar</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">

                            <li class="nav-categories <?php is_admin_nav_active(['add-sainik-samachar']); ?>">
                                <a href="<?php echo admin_url(); ?>add-sainik-samachar">Add Sainik Samachar</a>
                            </li>

                               <li class="nav-categories <?php is_admin_nav_active(['view-sainik-samachar', 'update-sainik-samachar']); ?>">
                                <a href="<?php echo admin_url(); ?>view-sainik-samachar">View Sainik Samachars</a>
                            </li>


                            <!-- <li class="nav-categories">
                                <a href="<?php echo admin_url(); ?>add-sainik-samachar-category">Sainik Samachar Category</a>
                            </li>   -->
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (check_user_permission('press_release')): ?>
                    <li class="treeview<?php is_admin_nav_active(['add-press-release', 'view-press-release-list', 'update-press-release','view-press-release','view-schedule-publish-list','view-press-realease-withdraw-request','view_update_request_press_release','rejected_press_release']); ?>">
                        <a href="#">
                            <i class="fa fa-folder-open"></i> <span><?php //echo trans("categories"); ?>Press Releases</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">

                        <?php 
                        if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                          {

                          ?>

                            <li class="nav-press-realease <?php is_admin_nav_active(['add-press-release']); ?>">
                                <a href="<?php echo admin_url(); ?>add-press-release">Add Press Release</a>
                            </li>
                        <?php
                         }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor'){?>
                         <li class="nav-press-realease <?php is_admin_nav_active(['add-press-release']); ?>">
                                <a href="<?php echo admin_url(); ?>add-press-release">Add Press Release</a>
                            </li>
                        <?php
                        }
                        ?>

                           <li class="nav-press-realease <?php is_admin_nav_active(['view-press-release-list', 'update-press-release','view-press-release','rejected-press-release']); ?>">
                                <a href="<?php echo admin_url(); ?>view-press-release-list">View Press Release</a>
                            </li>
                           <!--  <li class="nav-press-realease">
                                <a href="<?php echo admin_url(); ?>view-press-release-status">Panding for Publish</a>
                            </li> -->
                            <li class="nav-press-realease <?php is_admin_nav_active(['view-schedule-publish-list']); ?>">
                            <a href="<?php echo admin_url(); ?>view-schedule-publish-list">Scheduled For Publish</a>
                            </li>
                            <li class="nav-press-realease <?php is_admin_nav_active(['view-press-realease-withdraw-request']); ?>">
                            <a href="<?php echo admin_url(); ?>view-press-realease-withdraw-request">Withdrawl Request</a>
                            </li>
                            <li class="nav-press-realease <?php is_admin_nav_active(['view_update_request_press_release']); ?>">
                            <a href="<?php echo admin_url(); ?>view_update_request_press_release">Update Request</a>
                            </li>
                            <!-- rejected press release navbar -->

                            <li class="nav-press-realease <?php is_admin_nav_active(['view-rejected-publish-list']); ?>">
                            <a href="<?php echo admin_url(); ?>view-rejected-publish-list">Rejected Press Release</a>
                            </li>
                            <!-- <li class="nav-press-realease">
                                <a href="<?php echo admin_url(); ?>view_press_realease">Delete Request</a>
                            </li> -->

                            <!--<li class="nav-press realease History">
                                <a href="<?php echo admin_url(); ?>view_press_realease_history">Press Realease History</a>
                            </li>

                            <li class="nav-press realease History">
                                <a href="<?php echo admin_url(); ?>view_press_realease_media">Press Realease Media</a>
                            </li>

                            <li class="nav-press realease History">
                                <a href="<?php echo admin_url(); ?>view_press_realease_media">Press Realease History</a>
                            </li> -->

                              <!-- <li class="nav-press-release-type">
                                <a href="<?php echo admin_url(); ?>press-release-type">Press Release Type</a>
                            </li>   -->
                        </ul>
                    </li>
                <?php endif; ?>
                <?php //if (check_user_permission('widgets')): ?>
                    <!-- <li class="treeview<?php //is_admin_nav_active(['widgets', 'add-widget', 'update-widget']); ?>">
                        <a href="#">
                            <i class="fa fa-th"></i> <span><?php //echo trans("widgets"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-widget">
                                <a href="<?php //echo admin_url(); ?>add-widget"><?php //echo trans("add_widget"); ?></a>
                            </li>
                            <li class="nav-widgets">
                                <a href="<?php //echo admin_url(); ?>widgets"><?php //echo trans("widgets"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php //if (check_user_permission('polls')): ?>
                    <!-- <li class="treeview<?php //is_admin_nav_active(['polls', 'add-poll', 'update-poll']); ?>">
                        <a href="#">
                            <i class="fa fa-list"></i> <span><?php //echo trans("polls"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-add-poll">
                                <a href="<?php //echo admin_url(); ?>add-poll"><?php //echo trans("add_poll"); ?></a>
                            </li>
                            <li class="nav-polls">
                                <a href="<?php //echo admin_url(); ?>polls"><?php //echo trans("polls"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php if (check_user_permission('media_invite')): ?>
                    <li class="treeview<?php is_admin_nav_active(['media-invite',  'add-media-invite','update-media']); ?>">

                       <a href="#">
                            <i class="fa fa-image"></i> <span><?php //echo trans("audio"); ?>Media Invites</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-audio <?php is_admin_nav_active(['add-media-invite']); ?>">
                                <a href="<?php echo admin_url(); ?>add-media-invite">Add Media Invite</a>
                            </li>

                            <li class="nav-audio <?php is_admin_nav_active(['media-invite','update-media']); ?>">
                                <a href="<?php echo admin_url(); ?>media-invite"><?php //echo trans("audio"); ?>View Media Invites</a>
                            </li>


                        </ul>
                        
                    </li>
                <?php endif; ?>


                <?php if (check_user_permission('gallery')): ?>
                    <li class="treeview<?php is_admin_nav_active(['gallery-images', 'gallery-albums', 'update-gallery-image', 'update-gallery-album', 'gallery-add-image']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php echo trans("photo_gallery"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-gallery-images <?php is_admin_nav_active(['gallery-images','update-gallery-image', 'gallery-add-image']); ?>">
                                <a href="<?php echo admin_url(); ?>gallery-images"><?php //echo trans("images"); ?>Add & View Photos</a>
                            </li>
                            <li class="nav-gallery-albums">
                                <a href="<?php echo admin_url(); ?>gallery-albums"><?php //echo trans("albums"); ?>Categories</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                 <?php if (check_user_permission('audio')): ?>
                    <li class="treeview<?php is_admin_nav_active(['audio', 'audio-albums', 'audio-categories', 'update-audio-image', 'update-audio-album', 'update-audio-category', 'audio-add-image']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php //echo trans("audio_gallery"); ?>Radio Programmes</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-audio <?php is_admin_nav_active(['audio']); ?>">
                                <a href="<?php echo admin_url(); ?>audio"><?php //echo trans("audio"); ?>Add & View Radio Programmes</a>
                            </li>
                            <li class="nav-audio-albums <?php is_admin_nav_active(['audio-categories','update-audio-album','']); ?>">
                                <a href="<?php echo admin_url(); ?>audio-categories"><?php //echo trans("albums"); ?>Categories</a>
                            </li>
                            <!-- <li class="nav-audio-categories">
                                <a href="<?php echo admin_url(); ?>audio-sub-categories"><?php //echo trans("categories"); ?>Sub categories</a>
                            </li> -->
                        </ul>
                    </li>
                <?php endif; ?>
          

                <?php if (check_user_permission('videos')): ?>
                    <li class="treeview<?php is_admin_nav_active(['video', 'add-video', 'update-video','video-category', 'update-video-album']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php echo trans("video_gallery"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-video <?php is_admin_nav_active(['video', 'add-video', 'update-video']); ?>">
                                <a href="<?php echo admin_url(); ?>video"><?php //echo trans("video"); ?>Add & View Videos</a>
                            </li>
                            <li class="nav-video-category <?php is_admin_nav_active(['video-category', 'update-video-album']); ?>">
                                <a href="<?php echo admin_url(); ?>video-category"><?php //echo trans("Categories"); ?>Categories</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                  <?php if (check_user_permission('infographics')): ?>
                    <li class="treeview<?php is_admin_nav_active(['infographic',  'add-infographic','update-infographic','infographic-category','update-infographic-category']); ?>">

                       <a href="#">
                            <i class="fa fa-image"></i> <span><?php //echo trans("audio"); ?>Infographics</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav <?php is_admin_nav_active(['infographic',  'add-infographic','update-infographic']); ?>">
                                <a href="<?php echo admin_url(); ?>infographic">Add & View Infographics</a>
                            </li>
                            <li class="nav <?php is_admin_nav_active(['infographic-category','update-infographic-category']); ?>">
                                <a href="<?php echo admin_url(); ?>infographic-category">Categories</a>
                            </li>
                        </ul>
                        
                    </li>
                <?php endif; ?>

                <?php if (check_user_permission('circular_management')): ?>
                    <li class="treeview<?php is_admin_nav_active(['circular-manage', 'circular-category', 'update-circular-category', 'view-circular', 'update-circular-manage']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php echo trans("Circular Management"); ?>Circular Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav <?php is_admin_nav_active(['circular-manage']); ?>">
                                <a href="<?php echo admin_url(); ?>circular-manage"><?php //echo trans("categories"); ?>Add Circular</a>
                            </li>
                            <li class="nav <?php is_admin_nav_active(['circular-category', 'update-circular-category']); ?>">
                                <a href="<?php echo admin_url(); ?>circular-category"><?php //echo trans("albums"); ?>Categories</a>
                            </li>
                             <li class="nav <?php is_admin_nav_active(['view-circular', 'update-circular-manage']); ?>">
                                <a href="<?php echo admin_url(); ?>view-circular"><?php //echo trans("images"); ?>View Circulars</a>
                            </li>     
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (check_user_permission('document_management')): ?>
                    <li class="treeview<?php is_admin_nav_active(['add-document', 'document-category', 'update-document-category', 'view-document', 'update-document-manage']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php echo trans("Document Management"); ?>Document Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                             <li class="nav <?php is_admin_nav_active(['add-document']); ?>">
                                <a href="<?php echo admin_url(); ?>add-document"><?php //echo trans("categories"); ?>Add Document</a>
                            </li>
                            <li class="nav <?php is_admin_nav_active(['document-category', 'update-document-category']); ?>">
                                <a href="<?php echo admin_url(); ?>document-category"><?php //echo trans("albums"); ?>Categories</a>
                            </li>
                           
                            <li class="nav <?php is_admin_nav_active(['view-document', 'update-document-manage']); ?>">
                                <a href="<?php echo admin_url(); ?>view-document"><?php //echo trans("categories"); ?>View Documents</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                 <?php if (check_user_permission('download_management')): ?>
                    <li class="treeview<?php is_admin_nav_active(['add-download', 'download-category', 'update-download-category', 'view-download', 'update-download-manage']); ?>">
                        <a href="#">
                            <i class="fa fa-image"></i> <span><?php echo trans("download-management"); ?>Download Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav<?php is_admin_nav_active(['add-download']); ?>">
                                <a href="<?php echo admin_url(); ?>add-download"><?php //echo trans("categories"); ?>Add Download </a>
                            </li>
                            <li class="nav<?php is_admin_nav_active(['download-category', 'update-download-category']); ?>">
                                <a href="<?php echo admin_url(); ?>download-category"><?php //echo trans("albums"); ?>Categories</a>
                            </li>
                            <li class="nav<?php is_admin_nav_active(['view-download', 'update-download-manage']); ?>">
                                <a href="<?php echo admin_url(); ?>view-download"><?php //echo trans("categories"); ?>View Downloads </a>
                            </li>
                            
                        </ul>
                    </li>
                <?php endif; ?>
               
                <?php //if (check_user_permission('comments_contact')): ?>
                    <!-- <li class="nav-contact-messages">
                        <a href="<?php //echo admin_url(); ?>contact-messages">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <span><?php //echo trans("contact_messages"); ?></span>
                        </a>
                    </li>
                    <li class="treeview<?php //is_admin_nav_active(['comments', 'pending-comments']); ?>">
                        <a href="#">
                            <i class="fa fa-comments"></i> <span><?php //echo trans("comments"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-pending-comments">
                                <a href="<?php //echo admin_url(); ?>pending-comments"><?php //echo trans("pending_comments"); ?></a>
                            </li>
                            <li class="nav-comments">
                                <a href="<?php //echo admin_url(); ?>comments"><?php //echo trans("approved_comments"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php //if (check_user_permission('newsletter')): ?>
                    <!-- <li class="treeview<?php //is_admin_nav_active(['send-email-subscribers', 'subscribers', 'send-email-subscriber']); ?>">
                        <a href="#">
                            <i class="fa fa-envelope"></i> <span><?php //echo trans("newsletter"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-send-email-subscribers">
                                <a href="<?php //echo admin_url(); ?>send-email-subscribers"><?php //echo trans("send_email_subscribers"); ?></a>
                            </li>
                            <li class="nav-subscribers">
                                <a href="<?php ////echo admin_url(); ?>subscribers"><?php //echo trans("subscribers"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php //endif; ?>
                <?php //if (check_user_permission('reward_system')): ?>
                   <!--  <li class="treeview<?php //is_admin_nav_active(['reward-system']); ?>">
                        <a href="#">
                            <i class="fa fa-money"></i> <span><?php //echo trans("reward_system"); ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="nav-reward-system">
                                <a href="<?php //echo admin_url(); ?>reward-system"><?php //echo trans("reward_system"); ?></a>
                            </li>
                            <li class="nav-reward-system-earnings">
                                <a href="<?php //echo admin_url(); ?>reward-system/earnings"><?php //echo trans("earnings"); ?></a>
                            </li>
                            <li class="nav-reward-system-payouts">
                                <a href="<?php //echo admin_url(); ?>reward-system/payouts"><?php //echo trans("payouts"); ?></a>
                            </li>
                            <li class="nav-reward-system-add-payout">
                                <a href="<?php //echo admin_url(); ?>reward-system/add-payout"><?php //echo trans("add_payout"); ?></a>
                            </li>
                            <li class="nav-reward-system-pageviews">
                                <a href="<?php //echo admin_url(); ?>reward-system/pageviews"><?php //echo trans("pageviews"); ?></a>
                            </li>
                        </ul>
                    </li> -->
                <?php ///endif; ?>
                <?php //if (check_user_permission('ad_spaces')): ?>
                    <!-- <li class="nav-ad-spaces">
                        <a href="<?php //echo admin_url(); ?>ad-spaces">
                            <i class="fa fa-dollar" aria-hidden="true"></i>
                            <span><?php //echo trans("ad_spaces"); ?></span>
                        </a>
                    </li> -->
                <?php //endif; ?>
                <?php if (check_user_permission('users')): ?>
                    <li class="treeview<?php is_admin_nav_active(['add-user', 'administrators','users','edit-new-password','edit-user','edit-user','user-logs']); ?>">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span><?php echo trans("users"); ?></span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (is_admin()): ?>
                                <li class="nav-add-user">
                                    <a href="<?php echo admin_url(); ?>add-user"> <?php echo trans("add_user"); ?></a>
                                </li>
                                <li class="nav-administrators">
                                    <a href="<?php echo admin_url(); ?>administrators"> <?php echo trans("administrators"); ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="nav <?php is_admin_nav_active(['users','edit-new-password','edit-user','edit-user']); ?>">
                                <a href="<?php echo admin_url(); ?>users"> <?php echo trans("users"); ?></a>
                            </li>
                            <li class="nav-user-logs">
                                <a href="<?php echo admin_url(); ?>user-logs"> <?php echo trans("user_logs"); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (is_admin()): ?>
                    <li class="nav <?php is_admin_nav_active(['edit-role','permissions']); ?>">
                        <a href="<?php echo admin_url(); ?>roles-permissions">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <span><?php echo trans("roles_permissions"); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php //if (check_user_permission('seo_tools')): ?>
                  <!--   <li class="nav-seo-tools">
                        <a href="<?php echo admin_url(); ?>seo-tools"><i class="fa fa-wrench"></i>
                            <span><?php echo trans("seo_tools"); ?></span>
                        </a>
                    </li> -->
                <?php //endif; ?>
                <?php //if (is_admin()): ?>
                   <!--  <li class="nav-social-login-configuration">
                        <a href="<?php //echo admin_url(); ?>social-login-configuration"><i class="fa fa-share-alt"></i>
                            <span><?php //echo trans("social_login_configuration"); ?></span>
                        </a>
                    </li> -->
                   <!--  <li class="nav-cache-system">
                        <a href="<?php echo admin_url(); ?>cache-system">
                            <i class="fa fa-database"></i>
                            <span><?php echo trans("cache_system"); ?></span>
                        </a>
                    </li> -->
                <?php //endif; ?>

                <?php if (check_user_permission('settings')): ?>
                    <li class="header"><?php echo trans("settings"); ?></li>
                    <!-- <li class="nav-preferences">
                        <a href="<?php //echo admin_url(); ?>preferences">
                            <i class="fa fa-check-square-o"></i>
                            <span><?php //echo trans("preferences"); ?></span>
                        </a>
                    </li> -->
                   <!--  <li class="nav-route-settings">
                        <a href="<?php //echo admin_url(); ?>route-settings">
                            <i class="fa fa-map-signs"></i>
                            <span><?php //echo trans("route_settings"); ?></span>
                        </a>
                    </li> -->
                   <!--  <li class="nav-email-settings">
                        <a href="<?php //echo admin_url(); ?>email-settings">
                            <i class="fa fa-cog"></i>
                            <span><?php //echo trans("email_settings"); ?></span>
                        </a>
                    </li> -->
                    <li class="nav-visual-settings">
                        <a href="<?php echo admin_url(); ?>visual-settings">
                            <i class="fa fa-paint-brush"></i>
                            <span><?php echo trans("visual_settings"); ?></span>
                        </a>
                    </li>
                    <!-- <li class="nav-font-settings">
                        <a href="<?php //echo admin_url(); ?>font-settings"><i class="fa fa-font" aria-hidden="true"></i>
                            <span><?php //echo trans("font_settings"); ?></span>
                        </a>
                    </li> -->
                  <li class="nav-language-settings">
                        <a href="<?php echo admin_url(); ?>language-settings">
                            <i class="fa fa-language"></i>
                            <span><?php //echo trans("language_settings"); ?>Language Settings</span>
                        </a>
                    </li> 
                    <li class="nav-settings">
                        <a href="<?php echo admin_url(); ?>settings">
                            <i class="fa fa-cogs"></i>
                            <span><?php echo trans("general_settings"); ?></span>
                        </a>
                    </li>
                  <!--   <li class="nav-social-media-setting">
                        <a href="<?php echo admin_url(); ?>social-media-setting">
                            <i class="fa fa-cogs"></i>
                            <span><?php //echo trans("social_media_setting"); ?></span>
                        </a>
                    </li> -->
                <?php endif; ?>
                 <?php if (check_user_permission('social_media_setting')): ?>
                  <li class="nav-social-media-setting">
                        <a href="<?php echo admin_url(); ?>social-media-setting">
                            <i class="fa fa-cogs"></i>
                            <span><?php echo trans("social_media_setting"); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <?php
    $segment2 = @$this->uri->segment(2);
    $segment3 = @$this->uri->segment(3);

    $uri_string = $segment2;
    if (!empty($segment3)) {
        $uri_string .= '-' . $segment3;
    } ?>
    <style>
        <?php if(!empty($uri_string)):
        echo '.nav-'.$uri_string.' > a{color: #fff !important;}';
        else:
        echo '.nav-home > a{color: #fff !important;}';
        endif;?>
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
