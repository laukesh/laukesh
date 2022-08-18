<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$pro = $this -> db
           -> select('*')
           -> where('id', $this->auth_user->pro_category_id)
           -> where('is_active', 1)
           -> limit(1)
           -> get('tbl_pru_category')
           ->result_array();


?>
  <script type="text/javascript">
    $('form').submit(function(e){
        var msg = false;
        $('.press_release_text').each(function(){
        var str = jQuery(this).val().toLowerCase();

        if(str.indexOf('script>')>=0 || str.indexOf('>script')>=0 || str.indexOf('<script>')>=0 || str.indexOf('<script')>=0 || str.indexOf('/script')>=0 || str.indexOf('onload')>=0 || str.indexOf('onclick')>=0 || str.indexOf('onblur')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('ondblclick')>=0 || str.indexOf('onfocus')>=0 || str.indexOf('onkeydown')>=0 || str.indexOf('onkeyup')>=0 || str.indexOf('onkeypress')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('onmousemove')>=0 || str.indexOf('onmouseover')>=0 || str.indexOf('onmouseup')>=0 || str.indexOf('onmouseout')>=0 || str.indexOf('onchange')>=0 || str.indexOf('<div')>=0 || str.indexOf('onerror')>=0 || str.indexOf('alert(')>=0 || str.indexOf('onsubmit')>=0 || str.indexOf('<img')>=0 || str.indexOf('<span')>=0 || str.indexOf('<i')>=0 || str.indexOf('<head')>=0 || str.indexOf('<body')>=0 || str.indexOf('<style')>=0 || str.indexOf('<title')>=0 || str.indexOf('val()')>=0 || str.indexOf('src=')>=0){
        msg = true;
        e.preventDefault();
        }
        });
        if(msg){
        alert('Sorry, You are not allowed to submit special tags');
        }
        });
        Sol2 
        preg_match_all("/^[a-zA-Z0-9_@ .\/-]+$/i",$input_value)
</script>
  <script src="https://cdn.tiny.cloud/1/fy8rgy5s50tm0pcccxkus2bc5u32egc9s41j48v3oq0chcgc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>    
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans("add_press_release"); ?></h3>
                </div>
                 <?php 
                if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
                 <div class="right">
                    <a href="<?php echo admin_url(); ?>view-press-release-list" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("press_release"); ?>
                    </a>
                </div>
                <?php 
                }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor'){
                ?>
                     <div class="right">
                    <a href="<?php //echo admin_url(); ?>view-press-release-list" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("press_release"); ?>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('press_realease_controller/add_press_release_post'); ?>
               <input type = "hidden" name="id" id="id" value="" />
               <input type = "hidden" name="pre_image"   id="pre_image" value="" />
               <input type = "hidden" name="created_at"  id="created_at" value="" />
               <input type = "hidden" name="created_by"  id="created_by" value="" />
               <input type = "hidden" name="keywords"    id="Keywords" value="" />

            <div class="box-body">
              <?php if($this->auth_user->role == 'pro_admin'){?>
             <input type = "hidden" name="press_release_category" value="<?php echo $pro[0]['id']; ?>" />
            <?php
            }
            ?>
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>
             <div class="row">
                <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("press_release_type"); ?><span style="color:red"></span></label>
                    <select name="press_release_type" class="form-control" id="type">
                        <option value="1">New</option>
                        <?php if($this->auth_user->role == 'pro_admin'){?> 
                        <option value="2">Update</option>
                        <option value="3">Withdrawl</option> 
                        <?php
                        }
                        ?>
                          <!-- <?php //foreach ($press_realease_type as $item): ?>
                            <option value="<?php //echo $item->id; ?>"><?php //echo $item->name; ?></option>
                        <?php //endforeach; ?> -->
                       
                    </select>
                </div>
              </div>                
              <div class="col-sm-2" id="lang_id">
               <div class="form-group">
                    <label><?php echo trans("language"); ?><span style="color:red"></span></label>
                    <select name="lang_id" id="lang_id" class="form-control emp" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  
            </div>
            <div class="col-sm-2" id="pro_id">
                 <div class="form-group">
                    <label><?php echo trans("pro_category"); ?><span style="color:red"></span></label>
                    <select  name="press_release_category" id="pro_category" class="form-control" <?php if($this->auth_user->role == 'pro_admin'){ echo  'disabled="disabled"'; } ?>>
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php echo ($this->auth_user->pro_category_id  == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
            <div class="col-sm-2" id="date_of_event">
                    <div class="form-group">
                    <label class="control-label"><?php echo trans('date_event'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control emp"
                           name="date_of_event" id="datetimepicker3" autocomplete="off" placeholder="<?php echo trans('date_event'); ?>"
                           value="">
                    </div>
                </div>

                <div class="col-sm-4" id="service_h">
                <div class="form-group">
                    <label><?php echo trans("Services/Organisation"); ?><span style="color:red"></span></label>
                    <select name="service" class="form-control" id="service">
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($press_realease_service as $item): ?>
                            <option value="<?php echo $item->name; ?>"><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>

              <!-- <div class="col-sm-2" id="location">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('location'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control"
                           name="location" id="location" placeholder="<?php echo trans('location'); ?>"
                           value="">
                </div> 
              </div> -->
          </div>
        <div class="form-group" id="othter_service" style="display:none;">
                    <label class="control-label"><?php //echo trans('other-service'); ?><span style="color:red"></span>Other Service/Organisation</label>
                    <input type="text" class="form-control emp"
                           name="other" id="other" placeholder="Other Service/Organisation"
                           value="">
                </div>
              <div class="form-group" style="display:none;" id="row_dim">
                    <label><?php echo trans("press_release"); ?><span style="color:red"></span></label>
                    <select name="press_release_ids" class="form-control e" id="selUser" style="width:1340px;">
                        <option value=""><?php //echo trans('select_press_release'); ?></option>
                          <?php foreach ($press_realease_by_user as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->press_release_title; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              <div class="row" id="group3">                
               <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('event/subject'); ?><span style="color:red"></span></label>
                    <!-- <input type="text" class="form-control emp" name="event_subject" id="event_subject" placeholder="<?php //echo trans('event/subject'); ?>"
                           value=""> -->
                <select class="form-control emp" name="event_subject" id="event_subject" onchange="this.id()" >
                  <option value="">Select</option>
                <option value="Photo Release">Photo Release</option>
                <option value="Press Release">Press Release</option>
                </select>
                </div>

              </div>   
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('location'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control emp"
                           name="location" id="location" placeholder="<?php echo trans('location'); ?>"
                           value="">
                </div> 
              </div>
            </div>
            
            <div class="row" id="group2">      
             <div class="col-sm-6">
              <div class="form-group">
                    <label class="control-label"><?php echo trans('press_release_title'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control emp"
                           name="press_release_title" id="press_release_title" placeholder="<?php echo trans('press_release_title'); ?>"
                           value="" required>
                 </div> 
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('release_sub_heading'); ?></label>
                    <input type="text" class="form-control emp"
                           name="release_sub_heading" id="release_sub_heading" placeholder="<?php echo trans('release_sub_heading'); ?>"
                           value="<?php echo old('release_sub_heading'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                  </div>
                 </div>
            </div>

  <?php 
  if ($this->auth_user->role != "pro_admin"){?>
                <div class="row" id="group1">
                 <div class="col-sm-6" >
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_reviewed'); ?></label>
                    <input type="text" class="form-control emp"
                           name="who_reviewed" id="who_reviewed" placeholder="<?php echo trans('reviewed_by'); ?>"
                           value="">
                  </div>
                </div>
 
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_prepared'); ?></label>
                    <input type="text" class="form-control"
                           name="who_prepared" id="who_prepared" placeholder="<?php echo trans('prepared_by'); ?>"
                           value="">
                  </div>
                </div>
               </div> 
        <?php
        }
   ?>
                
                <div class="form-group" id="group4">
                    <label class="control-label"><?php echo trans('press_release_brief_description'); ?><span style="color:red"></span></label>
                    <textarea  class="tinyMCE form-control emp"
                           name="press_release_text" id="press_release_text" placeholder="<?php echo trans('press_release_text'); ?>"
                           value=""></textarea>
                  </div>   

              <div class="form-group" id="group5">
                  <div class="row">
                      <div class="col-sm-12">
                          <label class="control-label"><?php echo trans('keywords'); ?><span style="color:red"></span></label>
                          <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="" />
                          <small>(<?php echo trans('muti_keywords'); ?>)</small>
                      </div>
                  </div>
               </div> 

               <!--  <div class="form-group" id="group6">
                  <div class="row">
                <div class="col-sm-4" id="feature_image">
                        
                    </div>
                  </div>
                    <label class="control-label"><?php echo trans('feature_image'); ?> (Banner Image or Main Image)<span style="color:red"></span></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="feature_image" size="40" accept=".png, .jpg, .jpeg, .gif">
                            </a>
                            <span>You can browse one image (png,jpg,jpeg,gif)</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="MultidvPreview">
                            </div>
                        </div>
                    </div>
                </div> -->
 
                 
  <div class="field_wrapper_image" id="row_dim1">
      <hr style="width:100%;text-align:left;margin-left:0">
      <div id="MultidvPreview4"></div>
      <label class="control-label"><?php //echo trans('image'); ?> Images * <span style="color: red">(Please select atleast & only one image as feature image (Banner Image or Main Image)</span>)</label>
      <span><a href="javascript:void(0);" class="add_button_image" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px" /></a></span>
              </br></br>       
              
                <div class="row" style="margin-bottom:4px;">
                    <input type="hidden" name="img_setup" id="img_setup">
                    <div class="col-sm-3">
            <input type="file" id="upload_file" name="image[]" size="20" accept=".png, .jpg, .jpeg, .gif">
                          </div>
                      <div class="col-sm-9">
                        <div class="boxinl">
        <input type="checkbox" name="progress[]" class="checkbox_data" id="progress" value="0" data-value="0" required="required" tabIndex="1" onClick="ckChange(this,'1')">
                            <span class="image_checkbox">Main Image</span>
                            <input type="text" id="caption-image-text" name="caption-image-text[]" style="margin-left: 10px;" class="form-control" value="" placeholder="Brief Description">
                        </div>
                    </div>
                        <style type="text/css">
                            .boxinl {
                               display: flex; 
                            }
                        </style>
                    </div>
            
    </div>
 
           <div class="field_wrapper_infographic" id="row_dim3">
             <div id="MultidvPreview3"></div>
              <label class="control-label"><?php //echo trans('infographics_image'); ?>Infographics</label>
               <span><a href="javascript:void(0);" class="add_button_infographic" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px" /></a></span>         
                <div class="row">
                   <div class="col-sm-3">
                            <input type="file" name="infographic[]" id="upload_files" size="20" accept=".png, .jpg, .jpeg, .gif"> 
                        </div>
                    <div class="col-sm-8">      
                        <input type="text" id="caption-infographic-text" name="caption-infographic-text[]" class="form-control" placeholder="Brief Description"> 
                         </div>
                  </div>
          </div>

<div class="field_wrappers_video" id="row_dim2">
    <hr style="width:100%;text-align:left;margin-left:0">
    <div id="MultidvPreview5"></div> 
<label class="control-label"><?php //echo trans('video'); ?>Video</label>
<a href="javascript:void(0);" class="add_button_video" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px"/></a>
   </br></br>
      <div class="row">
        <div class="col-sm-3">
          <input type="file" name="video[]" size="20" accept=".mp4,.mpeg,.mov,.avi" id="video" value="">
         </div>
        <div class="col-sm-8">
          <input type="text" id="caption-video-text" class="form-control" name="caption-video-text[]" value="" placeholder="Brief Description">
        </div>                               
      </div>
           
</div>

<hr style="width:100%;text-align:left;margin-left:0">
             <div class="form-group" id="status_all" style="display:none;">
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <label><?php echo trans('is_active'); ?></label>
                        </div>

                <?php 
                if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_show_on_menu_1" class="message_pri_1" name="status" value="1" onclick="hideDiv()">
                            <label for="rb_is_active_1" id="rb_show_on_menu_show" class="cursor-pointer"><?php echo trans('draft'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" class="message_pri_2" name="status" value="2" onclick="hideDiv()">
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('submit'); ?></label>
                        </div>

              <?php }elseif($this->auth_user->role == 'hq admin' && $this->auth_user->pro_category_id = $pro['0']['id'] && $this->auth_user->permission = 2)
                {?>
                      

                       <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" class="message_pri_3" name="status" value="3" onclick="hideDiv()" checked="checked">
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('publish'); ?></label>
                        </div>
                        
                         <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" name="status" class="message_pri_4" value="4" onclick="ShowDiv()">
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('schedule_for_publish'); ?></label>
                        </div>
                <?php 
                }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor' && $this->auth_user->permission == 2){?>
                  <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" class="message_pri_3" name="status" value="3" onclick="hideDiv()" checked="checked">
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('publish'); ?></label>
                        </div>
                        
                         <div class="col-md-4 col-sm-4 col-xs-12  col-option">
                            <input type="radio" name="status" class="message_pri_4" value="4" onclick="ShowDiv()">
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('schedule_for_publish'); ?></label>
                        </div>
                    <?php
                  }
                  ?>

                 
                    </div>
                </div>

<div class="form-group" id="status_withdraw" style="display:none;">
        <div class="row">
            <div class="col-sm-2 col-xs-12">
                <label><?php echo trans('is_active'); ?></label></div>
                        
                <?php 
                if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" name="status" value="7" >
                            <label for="rb_is_active_1" class="cursor-pointer"><?php echo trans('withdraw'); ?></label>
                        </div>
                        

              <?php }?>

                 
                    </div>
                </div>
            <!-- /.box-body -->

         <div class="container" id="welcomeDiv" style="display:none;">
         <div class="row">
          <div class='col-sm-2'>
               <div class="form-group">
                 <label class="control-label"><?php echo trans('schedule_for_publish'); ?></label>
               </div>
            </div>
            <div class='col-sm-4'>
               <div class="form-group">
                  <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="schedule_for_publish" id="schedule_for_publish" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
         </div>
    </div>
              <?php 
                if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
                 <div class="box-footer button-save">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('submit_press_release'); ?></button>
            </div>
                <?php 
                }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor' && $this->auth_user->permission == 2){?>
                     <div class="box-footer button-save">
                <button type="submit" id="custom" class="btn btn-primary pull-right"><?php echo trans('submit_press_release'); ?></button>
            </div>
                <?php
                }
            ?>
             <div class="box-footer" id="update-button">
              <button type="submit" class="btn btn-primary pull-right"><?php echo trans('update_press_release'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/jquery.notifyBar.js"></script>  -->

<script type="text/javascript">
  function ShowDiv(){
    //alert('heeloo');
    document.getElementById("welcomeDiv").style.display = "";
  }
   function hideDiv() {
    //alert('heeloo');
    document.getElementById("welcomeDiv").style.display = "none";
  }
</script>
<!-- Select2 CSS --> 
 <link //href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />  

<!-- jQuery --> 

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
  $("#selUser").select2();
    
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();
    $('#row_dim').html("id : " + userid + ", name : " + username);
  });
  
  $('#selUser').on('change', function() {
        var id =  this.value; 
        var data = {'post_id': id}; 
        $('#rb_show_on_menu_1').hide();
        $('#rb_show_on_menu_show').hide();

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax({
        type: "POST",    
        url: base_url + 'CommanAjax_controller/press_release_ajax_val',
        data:data,
        success : function(data){ 
             // alert(data);
             var returnedData = JSON.parse(data); 
            // alert(returnedData.press_release);
             //console.log(returnedData.press_release_infographic);

             // $("#MultidvPreview3").empty();
             // $("#MultidvPreview4").empty();
             // $("#MultidvPreview5").empty();
           // alert(returnedData.press_release_infographic);

            jQuery.each(returnedData.press_release_infographic, function(index, value){

            //console.log(value.caption);
            $("#MultidvPreview3").append('<div class="row"><div class="col-sm-3"><img src="<?php echo base_url();?>'+value["media_path"]+'" width="70" height="60"></div><div class="col-sm-8"><input type="text" class="form-control" placeholder="Brief Description of Infographics" name="infographic_path['+value.id+'][title]" value="'+value["caption"]+'"></div><a href="javascript:void(0);"  onclick="remove_media('+value.id+')"; class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a><input type="hidden" name="infographic_path['+value.id+'][path]" value="'+value["media_path"]+'"><input type="hidden" name="infographic_path['+value.id+'][id]" value="'+value.id+'"><input type="hidden" name="infographic_path['+value.id+'][old_title]" value="'+value["caption"]+'"><input type="hidden" name="infographic_path['+value.id+'][media_format]" value="'+value["media_format"]+'"><input type="hidden" name="infographic_path['+value.id+'][media_size]" value="'+value["media_size"]+'"></div>'); 
               
            });

             jQuery.each(returnedData.press_release_image, function(index, value){
            $("#MultidvPreview4").append('<div class="row"><div class="col-sm-3"><img src="<?php echo base_url();?>'+value["media_path"]+'" width="70" height="60"></div><div class="col-sm-8"><input type="text" name="image_path['+value.id+'][title]" class="form-control"  placeholder="Brief Description of Image" value="'+value["caption"]+'" ></div><a href="javascript:void(0);"  onclick="remove_media('+value.id+')"; class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a><input type="hidden" name="image_path['+value.id+'][path]" value="'+value["media_path"]+'"><input type="hidden" name="image_path['+value.id+'][id]" value="'+value.id+'"><input type="hidden" name="image_path['+value.id+'][old_title]" value="'+value["caption"]+'"><input type="hidden" name="image_path['+value.id+'][media_format]" value="'+value["media_format"]+'"><input type="hidden" name="image_path['+value.id+'][media_size]" value="'+value["media_size"]+'"></div>');
            });

            jQuery.each(returnedData.press_release_video, function(index, value){
            
           $("#MultidvPreview5").append('<div class="row"><div class="col-sm-3"><video width="200" height="100" controls><source src="<?php echo base_url();?>'+value["media_path"]+'"></video></div><div class="col-sm-8"><input type="text" name="video_path['+value.id+'][title]" placeholder="Brief Description of Video" class="form-control" value="'+value["caption"]+'"></div><a href="javascript:void(0);"  onclick="remove_media('+value.id+')"; class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a><input type="hidden" name="video_path['+value.id+'][path]" value="'+value["media_path"]+'"><input type="hidden" name="video_path['+value.id+'][id]" value="'+value.id+'"><input type="hidden" name="video_path['+value.id+'][old_title]" value="'+value["caption"]+'"><input type="hidden" name="video_path['+value.id+'][media_format]" value="'+value["media_format"]+'"><input type="hidden" name="video_path['+value.id+'][media_size]" value="'+value["media_size"]+'"></div>');
            });

                
             $('#datetimepicker3').val(returnedData.press_release.date_of_event);  
             $('#pro_category').val(returnedData.press_release.pro_category);  
             $('#lang_id').val(returnedData.press_release.lang_id);  
             $('#location').val(returnedData.press_release.location);  
             $('#service').val(returnedData.press_release.service); 
             $('#other').val(returnedData.press_release.other); 
            
             //$('#other').val(returnedData.press_release.other);  
             $('#pre_image').val(returnedData.press_release.feature_image);  
             $('#created_at').val(returnedData.press_release.created_at);  
             $('#created_by').val(returnedData.press_release.created_by);  
             //$('#datetimepicker2').val(returnedData.press_release.release_date_to_be_issued );   
             $('#event_subject').val(returnedData.press_release.event_subject); 
             //$('#who_prepared').val(returnedData.press_release.prepared_by_email);   
             //$('#who_reviewed').val(returnedData.press_release.reviewed_by_email); 
             $('#press_release_title').val(returnedData.press_release.press_release_title); 
             $('#MultidvPreview').html('<img src="<?php echo base_url();?>'+returnedData.press_release.feature_image+'"  width="70" height="60">');
             //$("#Multifileupload").attr("src",returnedData.press_release.feature_image); 
             $('#release_sub_heading').val(returnedData.press_release.release_sub_heading);
             $('#schedule_for_publish').val(returnedData.press_release.schedule_for_publish);
            if(returnedData.press_release.service === 'Other Service/Organisation'){
              $('#othter_service').show();
             }else{
              $('#othter_service').hide();
             }

              if(returnedData.press_release.event_subject === 'Press Release'){
              $('#group4').show();
             }else{
              $('#group4').hide();
             }

            var status = returnedData.press_release.status;
            var schedule_for_publish = returnedData.press_release.schedule_for_publish;
             if(status == '4'){
              $('.message_pri_4').prop('checked', true);
               document.getElementById("welcomeDiv").style.display = '';
              }else if(status == '3'){
              $('.message_pri_3').prop('checked', true);
              }else if(status == '2'){
              $('.message_pri_2').prop('checked', true);
              }else if(status == '1'){
              $('.message_pri_').prop('checked', true);
              }else if(status == '6'){
              $('.message_pri_6').prop('checked', true);
              }else if(status == '5'){
              $('.message_pri_5').prop('checked', true);
              }else{
                 document.getElementById("welcomeDiv").style.display = 'none';
              }
             tinymce.get("press_release_text").setContent(returnedData.press_release.press_release_text);


              $(document).ajaxComplete(function () {
                  $(document).find('.tagsinput').tagsInput({
                  'width':1340
                });

              });
             
               $('.tagsinput').tagsinput(returnedData.press_release.keywords);
                            
        },

        error : function(data)
        {
            // do something
        }
    });
});

});

</script>

<script type="text/javascript">
 $(function(e) {
  $('#row_dim').hide(); 
    $('#update-button').hide(); 
     $('#status_all').show();
    $('#type').change(function(){
        if($('#type').val() == '2') {
          //alert('heldddddd');
            $('#row_dim').show();
           // $('#row_dim1').hide(); 
           // $('#row_dim2').hide();   
            $('#status_all').show(); 
            $('#status_withdraw').hide(); 
            $('.button-save').hide();   
            $('#update-button').show();  
            $('#update-button').show();
            $('#pro_id').show();
            $('#group1').show();
            $('#group2').show();
            $('#group3').show();
            $('#group4').show();
            $('#group5').show();
            $('#group6').show();
            $('#lang_id').show();
            $('#date_of_event').show();
            $('#service').show();
            $('#location').show();
            //$('#release_date_issued').show();  
        }else if($('#type').val() == '3'){
            $('#row_dim').show();
           // $('#row_dim1').hide(); 
           // $('#row_dim2').hide();   
            $('#status_all').hide();   
            $('#status_withdraw').show();   
            $('.button-save').hide();   
            $('#update-button').show();  
            $('#update-button').show();
            $('#pro_id').show();
            $('#group1').show();
            $('#group2').show();
            $('#group3').show();
            $('#group4').show();
            $('#group5').show();
            $('#group6').show();
            $('#lang_id').show();
            $('#date_of_event').show();
            $('#service').show();
            $('#location').show();

        }else{

            $('#row_dim').hide();
            $('#row_dim1').show(); 
            $('#row_dim2').show();
            $('#row_dim3').show();
            $('.button-save').show(); 
            $('#update-button').hide();
            $('#pro_id').show();
            $('#group1').show();
            $('#group2').show();
            $('#group3').show();
            $('#group4').show();
            $('#group5').show();
            $('#group6').show();
            $('#lang_id').show();
            $('#date_of_event').show();
            $('#service').show();
            $('#location').show();
            $('#release_date_issued').show(); 
            location.reload();
        } 
    });
});

</script>

<style>
.important {
  width:450px;
}
</style>

 


 <script type="text/javascript">

  $(function(){
    $('#datetimepicker1').datetimepicker({ format: "DD/MM/YYYY HH:mm",
            stepping: 10,
            minDate:new Date()
         });
     });


   $(function(){
    $('#datetimepicker2').datepicker({
      //minDate:new Date()
        });
    });

  $(function(){
    $('#datetimepicker3').datepicker({
       dateFormat: 'dd/mm/yy'
        });
    });

$(function() {
$('#service').change(function(){
    if($('#service').val() == 'Other Service/Organisation') {
        $('#othter_service').show();  
    } else {
         $('#othter_service').hide(); 
        
    } 
});
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_image'); //Add button selector
    var wrapper = $('.field_wrapper_image'); //Input field wrapper
    var x = 1;
    var i = 0;
    //New input field html 
     //Initial field counter is 1

    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        //var i =1;
        if(x < maxField){ 
           x++; 
           i++;
            
        var fieldHTML = '<div><div class="row" style="margin-bottom:4px;"><div class="col-md-3"><input type="file" id="upload_file"  name="image[]" accept=".png, .jpg, .jpeg, .gif" value=""/></div><div class="col-md-8"><div class="boxinl"><input type="checkbox" name="progress[]" id="progress'+x+'" data-value="'+i+'" class="checkbox_data" value="'+i+'" tabIndex="1" onClick="ckChange(this,'+x+')"><span class="image_checkbox">Main Image</span><input type="text" name="caption-image-text[]" style="margin-left: 10px;" value="" placeholder="Brief Description" class="form-control"></div></div><a href="javascript:void(0);" class="remove_button" data-value="'+x+'"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div></div>'; 
        $(wrapper).append(fieldHTML); 
        }       
    });

     $(wrapper).on('change', '#upload_file', function(e){
      e.preventDefault();
     $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[0])+"'>");  
     });

    $(wrapper).on('click', '.remove_button', function(e){
     $(".checkbox_data").removeAttr('disabled',false);   
        e.preventDefault();
        $(this).parent('div').remove(); 
        x--; 
    });
});

$(document).ready(function(){
    var maxField = 10; 
    var addButton = $('.add_button_infographic'); 
    var wrapper = $('.field_wrapper_infographic'); 
    var fieldHTML = '<div><div class="row"><div class="col-md-3"><input type="file" id="upload_files" name="infographic[]" accept=".png, .jpg, .jpeg, .gif" value=""/></div><div class="col-md-8"><input type="text" name="caption-infographic-text[]" class="form-control" value="" placeholder="Brief Description"></div><a href="javascript:void(0);" class="remove_button" ><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div></div>';   
    
    var x = 1; 
    $(addButton).click(function(){
        if(x < maxField){ 
            x++; 
            $(wrapper).append(fieldHTML); 
        }
    });

    $(wrapper).on('change', '#upload_files', function(){
      if(x < maxField){ 
            x++; 
     $('#image_previews').append("<img src='"+URL.createObjectURL(event.target.files[0])+"'>").serialize();  

       }
   
     });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_video'); //Add button selector
    var wrapper = $('.field_wrappers_video'); //Input field wrapper
    var fieldHTML = '<div><div class="row"><div class="col-md-3"><input type="file" name="video[]" accept=".mp4,.mov,.avi,.mpeg" value=""/></div><div class="col-md-8"><input type="text" name="caption-video-text[]" placeholder="Brief Description" class="form-control" value=""></div><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
    
function remove_media(media_id)
{   
    //alert(media_id);
    var media_value = media_id;
    var id = media_value.split(',');
    var release_id = media_value.split(',');
    var media_type = media_value.split(',');
    var lang_id = media_value.split(',');
    var media_format = media_value.split(',');
    var media_size = media_value.split(',');
    var media_path = media_value.split(',');
    var caption = media_value.split(',');
    var status = media_value.split(',');
    var schedule_for_publish = media_value.split(',');
    var created_at = media_value.split(',');
    var created_by = media_value.split(',');


    var data = {
        'id': id[0],
        'release_id': release_id[1],
        'media_type': media_type[2],
        'lang_id': lang_id[3],
        'media_format': media_format[4],
        'media_size': media_size[5],
        'media_path': media_path[6],
        'caption': caption[7],
        'status': status[8],
        'schedule_for_publish': schedule_for_publish[9],
        'created_at': created_by[10],
        'created_by': created_by[11]
        };



        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        //alert(data[csfr_token_name]);

        $.ajax({
        type: "POST",    
       // url: base_url + "CommanAjax_controller/press_release_media_remove",
        data:data,
        success : function(data){
                                           
        },
        error : function(data)
        {
            //do something
        }
    });
    

}

document.getElementById('event_subject').addEventListener('change', function(){
  var event_subject = this.value;
  if(event_subject == 'Photo Release')
  {
    $('#group4').hide();
  }else{
     $('#group4').show();
  }
});

// $('.mainImage').click(function()
// {
//     var $inputs = $('.mainImage')
//         if($(this).is(':checked')){
//         $inputs.not(this).prop('disabled',true); 
//         }else{
//         $inputs.prop('disabled',false); 
//         }
// });



function ckChange(ckType,ckid){  
  var ckName = document.getElementsByName(ckType.name);
  var ckval = $('#progress'+ckid).attr('data-value');
  $('#img_setup').val(ckval);

  for (var i = 0; i < ckName.length; i++) {

    if (!ckType.checked) {
      ckName[i].disabled = false;
    } else {
      if (!ckName[i].checked) {
        ckName[i].disabled = true;
      } else {
        ckName[i].disabled = false;
      }
    }
  }

}

</script>

