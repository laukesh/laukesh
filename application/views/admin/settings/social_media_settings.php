<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">

        <!-- form start -->
        

        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo trans('twitter_settings'); ?></a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?php echo trans('facebook_settings'); ?></a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><?php //echo trans('social_media_settings'); ?>Social Media Page links</a></li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false"><?php echo trans('linkedin_settings'); ?></a></li>
                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false"><?php echo trans('instagram_settings'); ?></a></li>
                 <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false"><?php echo trans('youtube_settings'); ?></a></li> 
               <!--  <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false"><?php echo trans('custom_javascript_codes'); ?></a></li> -->
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content settings-tab-content">
                <!-- include message block -->
                <?php if (!empty($this->session->flashdata("mes_settings"))):
                    $this->load->view('admin/includes/_messages');
                endif; ?>

<div class="tab-pane active" id="tab_1">
    <?php echo form_open_multipart('admin_controller/twitter_settings_post'); ?>
    <?php
    $i=1;
    if(!empty($twitter_settings)){
        foreach ($twitter_settings as $row)
        {
            
        ?>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h3 class="box-title"><?php //echo trans('google_recaptcha'); ?>Twitter 1</h3> -->
            </div>
            
             <div class="box-body">
                

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Handle <?php echo $i; ?></label>
                    <input type="text" class="form-control" name="hdl_<?php echo $i;?>" placeholder=""
                           value="<?php echo $row->hdl;?>" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

              <!--   <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter api</label>
                    <input type="text" class="form-control" name="api_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                 <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Secret Key</label>
                    <input type="text" class="form-control" name="sky_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <?php $i++;} for($j=$i;$j<=28;$j++){//else{?>
         <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h3 class="box-title"><?php //echo trans('google_recaptcha'); ?>Twitter 1</h3> -->
            </div>
            
             <div class="box-body">
                

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Handle <?php echo $j; ?></label>
                    <input type="text" class="form-control" name="hdl_<?php echo $j;?>" placeholder="Enter Twitter Hanlde ID" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

              <!--   <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter api</label>
                    <input type="text" class="form-control" name="api_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                 <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Secret Key</label>
                    <input type="text" class="form-control" name="sky_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
    <?php }}else{  for($j=1;$j<=28;$j++){ ?>
    
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h3 class="box-title"><?php //echo trans('google_recaptcha'); ?>Twitter 1</h3> -->
            </div>
            
             <div class="box-body">
                

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Handle <?php echo $j; ?></label>
                    <input type="text" class="form-control" name="hdl_<?php echo $j;?>" placeholder="Enter Twitter Hanlde ID" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

              <!--   <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter api</label>
                    <input type="text" class="form-control" name="api_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                 <div class="form-group">
                    <label class="control-label"><?php //echo trans('site_key'); ?>Twitter Secret Key</label>
                    <input type="text" class="form-control" name="sky_1" placeholder=""
                           value="" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
    <?php } } ?>



<?php //}}?> 


  

    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
    </div>
            <?php echo form_close(); ?>
</div>



<div class="tab-pane" id="tab_3">
     <?php echo form_open('admin_controller/facebook_settings_post'); ?>

            <div class="box-body">
              <!--  <div class="form-group">
                    <label class="control-label"><?php //echo trans('secret_key'); ?>User</label>
                    <input type="text" class="form-control" name="user" placeholder="<?php echo 'user'; ?>"
                           value="<?php if(!empty($facebook_setting)) { echo $facebook_setting->user; } else{ echo ''; }?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Facebook Page Url</label>
                    <input type="text" class="form-control" name="api" placeholder="<?php echo 'Facebook Page Url'; ?>"
                           value="<?php if(!empty($facebook_setting)) { echo $facebook_setting->api; } else{ echo ''; }?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

               <!-- <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Facebook Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" placeholder="<?php echo 'Facebook Secret Key'; ?>"
                           value="<?php if(!empty($facebook_setting)) { echo $facebook_setting->secret_key; } else{ echo ''; }?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->
            </div>
                 <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
             <?php echo form_close(); ?>
                </div>

<div class="tab-pane" id="tab_4">
                 <?php echo form_open_multipart('admin_controller/social_media_post'); ?>
                  <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">Facebook <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="facebook_url"
                               placeholder="Facebook <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->facebook_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Twitter <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control"
                               name="twitter_url" placeholder="Twitter <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->twitter_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Instagram <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="instagram_url" placeholder="Instagram <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->instagram_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label">Pinterest <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="pinterest_url" placeholder="Pinterest <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->pinterest_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label">LinkedIn <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="linkedin_url" placeholder="LinkedIn <?php echo trans('url'); ?>"
                               value="<?php echo html_escape($settings->linkedin_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label">VK <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="vk_url"
                               placeholder="VK <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->vk_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div> -->

                    <!-- <div class="form-group">
                        <label class="control-label">Telegram <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="telegram_url"
                               placeholder="Telegram <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->telegram_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label">Youtube <?php echo trans('url'); ?></label>
                        <input type="text" class="form-control" name="youtube_url"
                               placeholder="Youtube <?php echo trans('url'); ?>" value="<?php echo html_escape($settings->youtube_url); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
                     </div>
                     <?php echo form_close(); ?>
                </div>  

<div class="tab-pane" id="tab_5">
        <?php echo form_open('admin_controller/linkedin_settings_post'); ?>

            <div class="box-body">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('secret_key'); ?>User</label>
                    <input type="text" class="form-control" name="user" placeholder="<?php echo 'user'; ?>"
                           value="<?php echo $linkedin_setting->user; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Api</label>
                    <input type="text" class="form-control" name="api" placeholder="<?php echo 'linkedin Api'; ?>"
                           value="<?php echo $linkedin_setting->api; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Linkedin Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" placeholder=""
                           value="<?php echo $linkedin_setting->secret_key; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
                 <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
             <?php echo form_close(); ?>

                </div>
<div class="tab-pane" id="tab_6">
                     <?php echo form_open('admin_controller/instagram_settings_post'); ?>

            <div class="box-body">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('secret_key'); ?>User</label>
                    <input type="text" class="form-control" name="user" placeholder="<?php echo 'user'; ?>"
                           value="<?php echo $instagram_setting->user; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Api</label>
                    <input type="text" class="form-control" name="api" placeholder="<?php echo 'instagram Api'; ?>"
                           value="<?php echo $instagram_setting->api; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Instagram Secret Key
                        </label>
                    <input type="text" class="form-control" name="secret_key" placeholder=""
                           value="<?php echo $instagram_setting->secret_key; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
                 <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
             <?php echo form_close(); ?>

                </div>

 <div class="tab-pane" id="tab_7">
                 <?php echo form_open('admin_controller/youtube_settings_post'); ?>
<?php if(!empty($youtube_settings)){
    foreach($youtube_settings as $rowss)
{
    $title=$rowss->user;
    $emd_url=$rowss->api;
    
    
}}
else
{
    $title='';
    $emd_url='';
}
    
    ?>

                    <div class="box-body">

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('secret_key'); ?></label>
                    <input type="text" class="form-control" name="user" placeholder="<?php echo 'Youtube Title'; ?>"
                           value="<?php echo $title; ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Youtube Embed Url</label>
                    <input type="text" class="form-control" name="api" placeholder="<?php echo 'Youtube Embed Url'; ?>"
                           value="<?php echo $emd_url; ?>" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

             <!--   <div class="form-group">
                    <label class="control-label"><?php //echo trans('language'); ?>Youtube Secret Key</label>
                    <input type="text" class="form-control" name="recaptcha_lang" placeholder="<?php echo 'Youtube Secret Key'; ?>"
                           value="<?php //echo $this->general_settings->recaptcha_lang; ?>" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->
            </div>
                 <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
              <?php echo form_close(); ?>
                </div> 



<style>
    .tox-tinymce {
        height: 340px !important;
    }
</style>