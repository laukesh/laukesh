<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$pro = $this -> db
           -> select('id,name')
           -> where('id', $this->auth_user->pro_category_id)
           -> where('is_active', 1)
           -> limit(1)
           -> get('tbl_pru_category')
           ->result_array();
//echo '==='.$view_press_release[0]->date_of_event;
//die;
//echo '<pre>';print_r($view_press_release_image);

$data_val = array('0'=>'Photo Release', '1'=>'Press Release');
?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans("update_press_release"); ?></h3>
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
                }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor'){?>
                     <div class="right">
                    <a href="<?php echo admin_url(); ?>view-press-release-list" class="btn btn-success btn-add-new">
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
 <?php echo form_open_multipart('press_realease_controller/update_press_release_value_post'); ?>
          
  <div class="box-body">          
       <?php if(!empty($view_press_release[0])){?>
      <input type = "hidden" name="id" value="<?php echo $view_press_release[0]->id; ?>" />
      <input type = "hidden" name="pre_image" value="<?php echo $view_press_release[0]->feature_image; ?>" />
      <input type = "hidden" name="created_at" value="<?php echo $view_press_release[0]->created_at; ?>" />
      <input type = "hidden" name="created_by" value="<?php echo $view_press_release[0]->created_by; ?>" />
      <input type = "hidden" name="approved_at" value="<?php echo $view_press_release[0]->approved_at; ?>" />
      <input type = "hidden" name="translated_id" value="<?php echo $view_press_release[0]->translated_id; ?>" />
        
        <?php if($this->auth_user->role == 'pro_admin'){?>
        <input type = "hidden" name="press_release_category" value="<?php echo $pro[0]['id']; ?>" />
        <?php
        }
        ?>
        
        <?php } ?>
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>
             <div class="row">
                <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("press_release_type"); ?><span style="color:red"></span></label>
                     <select name="press_release_type" id="type"  class="form-control">
                        <option value="1">New</option>
                        <?php if($this->auth_user->role == 'pro_admin'){?> 
                        <option value="2">Update</option>
                        <option value="3">Withdraw</option> 
                      <!--   <option value="4">Remove Photo/video</option> --> 
                        <?php
                        }
                        ?>
                          <?php //foreach ($press_realease_type as $item): ?>
                           <!--  <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option> -->
                        <?php //endforeach; ?>
                       
                    </select>
                </div>
              </div>
                <div class="col-sm-2">
                 <div class="form-group">
                    <label><?php echo trans("pro_category"); ?><span style="color:red"></span></label>
                   <!-- <select name="press_release_category"  class="form-control" <?php if($this->auth_user->pro_category_id >0){ echo 'disabled'; } ?>>
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php ($this->auth_user->pro_category_id  == $item->id) ? 'selected' : ''; ?>><?php echo $item->name.$this->auth_user->pro_category_id; ?></option>
                        <?php endforeach; ?>
                       
                    </select> -->
                    <select name="press_release_category" id="pro_category" required="required" class="form-control" <?php if($this->auth_user->role == 'pro_admin'){ echo  'disabled="disabled"'; } ?>>
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php if($this->auth_user->role == 'pro_admin'){ echo ($this->auth_user->pro_category_id  == $item->id) ? 'selected' : ''; }else{ echo ($view_press_release[0]->pro_category  == $item->id) ? 'selected' : ''; } ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
              <div class="col-sm-2">
               <div class="form-group">
                    <label><?php echo trans("language"); ?><span style="color:red"></span></label>
                   <select name="lang_id"  class="form-control" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($view_press_release[0]->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  
            </div>
        
             
                <div class="col-sm-2">
                    <div class="form-group">
                    <label class="control-label"><?php echo trans('date_event'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control" 
                           name="date_of_event" id="datetimepicker3" placeholder="<?php echo trans('date_event'); ?>"
                           value="<?php $dateTime = new DateTime($view_press_release[0]->date_of_event, new DateTimeZone('Asia/Kolkata')); echo $dateTime->format("d/m/Y"); ?>">
                    </div>
                </div>
               <div class="col-sm-4">
                <div class="form-group">
                    <label><?php //echo trans("service"); ?><span>Services/Organisation</span></label>
                    <select name="service" class="form-control" id="service">
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($press_realease_service as $item): ?>
                            <option value="<?php echo $item->name; ?>"<?php echo ($view_press_release[0]->service  == $item->name) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
            </div>

            <div class="form-group" style="display:none;" id="row_dim">
                    <label><?php echo trans("press_release"); ?><span style="color:red"></span></label>
                    <select name="press_release_val" class="form-control" id="selUser" style="width:1340px;">
                        <option value=""><?php echo trans('select_press_release'); ?></option>
                          <?php foreach ($press_realease_by_user as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->press_release_title; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
             <div class="form-group" id="othter_service" <?php if($view_press_release[0]->service !== 'Other Service/Organisation'){ echo 'style="display:none"';}?>>
                    <label class="control-label"><?php echo trans('other-service'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control"
                           name="other" id="other" placeholder="<?php echo trans('other-service'); ?>"
                           value="<?php echo $view_press_release[0]->other;?>">
                </div>

           <div class="row">
               <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('event/subject'); ?><span style="color:red"></span></label>
                <select class="form-control emp" name="event_subject" id="event_subject">
                  <option value=""><?php echo trans('select'); ?></option>
                  <?php foreach ($data_val as $item){?>
                <option value="<?php echo $item;?>" <?php echo ($view_press_release[0]->event_subject  == $item) ? 'selected' : ''; ?>><?php echo $item;?></option>
              <?php }?>
                </select>

                </div> 
            </div>

            <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('location'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control"
                           name="location" id="location" placeholder="<?php echo trans('location'); ?>"
                           value="<?php echo $view_press_release[0]->location;?>">
                </div> 
              </div>
             <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('press_release_title'); ?><span style="color:red"></span></label>
                    <input type="text" class="form-control"
                           name="press_release_title" id="press_release_title" placeholder="<?php echo trans('press_release_title'); ?>"
                           value="<?php echo $view_press_release[0]->press_release_title;?>">
                 </div> 
            </div>        

            <div class="col-sm-6">  
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('release_sub_heading'); ?></label>
                    <input type="text" class="form-control"
                           name="release_sub_heading" id="release_sub_heading" placeholder="<?php echo trans('release_sub_heading'); ?>"
                           value="<?php echo $view_press_release[0]->release_sub_heading;?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                  </div>
            </div>
        </div>

            <div class="form-group" id="brief_des"<?php if($view_press_release[0]->event_subject == 'Photo Release'){ echo 'style="display:none"';}?>>
                    <label class="control-label">
                        <?php echo trans('press_release_brief_description'); ?><span style="color:red"></span></label>
                    <textarea class="tinyMCE form-control" name="press_release_text" id="press_release_text" 
                           ><?php echo $view_press_release[0]->press_release_text;?></textarea>
                  </div> 
              <?php 
              if ($this->auth_user->role != "pro_admin"){?>
              <div class="row"> 
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_prepared'); ?></label>
                    <input type="text" class="form-control"
                           name="who_prepared" id="who_preparedq" placeholder="<?php echo trans('prepared_by'); ?>"
                           value="<?php echo $view_press_release[0]->prepared_by_email;?>">
                  </div>
                </div>

                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_reviewed'); ?></label>
                    <input type="text" class="form-control"
                           name="who_reviewed" id="who_reviewed" placeholder="<?php echo trans('reviewed_by'); ?>"
                           value="<?php echo $view_press_release[0]->reviewed_by_email;?>">
                  </div>
                </div>
              </div>
              <?php 
              }
              ?>
              <div class="form-group">
                  <div class="row">
                      <div class="col-sm-12">
                          <label class="control-label"><?php echo trans('keywords'); ?><span style="color:red"></span></label>
                          <input id="tags_1" type="text" name="keywords"  class="form-control tags_1" value="<?php echo $view_press_release[0]->keywords;?>" />
                          <small>(<?php echo trans('muti_keywords'); ?>)</small>
                      </div>
                  </div>
               </div> 

                <div class="form-group">
                    <label class="control-label"><?php echo trans('feature_image'); ?> (Banner Image or Main Image)<span style="color:red"></span></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="feature_image" size="40" accept=".png, .jpg, .jpeg, .gif" value="<?php echo base_url() . html_escape($view_press_release[0]->feature_image); ?>">
                            </a>
                            <span>You can browse one image (png,jpg,jpeg,gif)</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="MultidvPreview">
                              <img src="<?php echo base_url() . html_escape($view_press_release[0]->feature_image); ?>" alt="" class="thumbnail img-responsive" >
                            </div>
                        </div>
                    </div>
                </div>

             <div class="field_wrapper_infographic" id="row_dim3">
              <label class="control-label"><?php //echo trans('infographics_image'); ?>Infographics</label>
               <span><a href="javascript:void(0);" class="add_button_infographic" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px" /></a></span>
  <?php
if(!empty($view_press_release_infographic)){
foreach($view_press_release_infographic as $items){?> 
       <div class="row">
           <div class="col-sm-3">
            <img src="<?php echo base_url() . html_escape($items->media_path); ?>" alt="" class="thumbnail img-responsive" >
        </div>
         </br>
          <div class="col-sm-8">
             <input type = "hidden" name="infographic_caption_id[]" value="<?php echo $items->id; ?>" />
             <input type="text" id="caption-infographic-text" class="form-control" name="caption-infographic-text[]" placeholder="Caption" value="<?php echo $items->caption;?>">
          </div><a href="javascript:void(0);" onclick="remove_media('<?php echo $items->id.','.$items->release_id.','.$items->media_type.','.$items->lang_id.','.$items->media_format.','.$items->media_size.','.$items->media_path.','.$items->caption.','.$items->status.','.$items->schedule_for_publish.','.$items->created_at.','.$items->created_by;?>');" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a>
       </div>
 <?php 
}
}
?>             
                <div class="row">
                   <div class="col-sm-3">
                            <input type="file" name="infographic[]" id="upload_files" size="20" accept=".png, .jpg, .jpeg, .gif"> 
                            </div> 
                        <div class="col-sm-8">     
                        <input type="text" id="caption-infographic-text" name="caption-infographic-text[]" class="form-control" placeholder="Brief Description"> 
                         </div>
                        </div>
   
                  </div>
                 


      <div class="field_wrapper_image" id="row_dim1">
      <hr style="width:100%;text-align:left;margin-left:0">
      <div id="MultidvPreview4"></div>
      <label class="control-label"><?php echo trans('image'); ?></label>
      <span><a href="javascript:void(0);" class="add_button_image" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px" /></a></span>
<?php
if(!empty($view_press_release_image)){
foreach($view_press_release_image as $items){?>
          <div class="row">
           <div class="col-sm-3">
            <img src="<?php echo base_url() . html_escape($items->media_path); ?>" alt="" class="thumbnail img-responsive" >
        </div>
         </br> 
          <div class="col-sm-8">
            <input type = "hidden" name="image_caption_id[]" value="<?php echo $items->id; ?>" />
             <input type="text" id="caption-image-text" class="form-control" name="caption-image-text[]" placeholder="Caption" value="<?php echo $items->caption;?>">
          </div>
          <a href="javascript:void(0);" onclick="remove_media('<?php echo $items->id.','.$items->release_id.','.$items->media_type.','.$items->lang_id.','.$items->media_format.','.$items->media_size.','.$items->media_path.','.$items->caption.','.$items->status.','.$items->schedule_for_publish.','.$items->created_at.','.$items->created_by;?>');" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a>
       </div>  
    <?php 
    }
    }
    ?>         
              
      <div class="row">
          <div class="col-sm-3">
                  <input type="file" id="upload_file" name="image[]" size="20" accept=".png, .jpg, .jpeg, .gif">
            </div>
            <div class="col-sm-8">
                  <input type="text"  id="caption-image-text" name="caption-image-text[]" class="form-control" value="" placeholder="Brief Description">
             </div>
              
          </div>
            
    </div>

<div class="field_wrappers_video" id="row_dim2">
    <hr style="width:100%;text-align:left;margin-left:0">
    <div id="MultidvPreview5"></div> 
<label class="control-label"><?php echo trans('video'); ?></label>
<a href="javascript:void(0);" class="add_button_video" title="Add field"><img src="<?php echo base_url(); ?>/assets/img/add-more-new.png" width="35px" height="35px"/></a>
<?php 
if(!empty($view_press_release_video)){
foreach($view_press_release_video as $items){?>
 <div class="row">
           <div class="col-sm-3">
            <video width="180" height="180" controls>
             <source src="<?php echo base_url() . html_escape($items->media_path); ?>" type="video/mp4"></video>
        </div>
        </br> </br> 
          <div class="col-sm-8">
            <input type = "hidden" name="video_caption_id[]" value="<?php echo $items->id; ?>" />
             <input type="text" id="caption-video-text" class="form-control" name="caption-video-text[]" placeholder="Caption" value="<?php echo $items->caption;?>">
          </div><a href="javascript:void(0);" onclick="remove_media('<?php echo $items->id.','.$items->release_id.','.$items->media_type.','.$items->lang_id.','.$items->media_format.','.$items->media_size.','.$items->media_path.','.$items->caption.','.$items->status.','.$items->schedule_for_publish.','.$items->created_at.','.$items->created_by;?>');" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a>
       </div>
<?php 
}
}
?>
   
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
             <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <label><?php echo trans('is_active'); ?></label>
                        </div>
                <?php 
                if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_show_on_menu_1" name="status" value="1" onclick="hideDiv()" <?php if($view_press_release[0]->status == 1){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_1" class="cursor-pointer"><?php echo trans('draft'); ?></label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="2" onclick="hideDiv()" <?php if($view_press_release[0]->status == 2){ echo "checked=checked";}  ?> >
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('submit'); ?></label>
                        </div>

              <?php }else  if($this->auth_user->role == 'hq admin' && $this->auth_user->pro_category_id = $pro['0']['id'] && $this->auth_user->permission = 2)
                {?>
                      

                       <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="3" onclick="hideDiv()" <?php if($view_press_release[0]->status == 3){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('publish'); ?>ss</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="6" onclick="hideDiv()" <?php if($view_press_release[0]->status == 6){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('reject'); ?></label>
                        </div>
                         <div class="col-md-2 col-sm-2 col-xs-12 col-option">
                            <input type="radio" name="status" value="4" onclick="ShowDiv()" <?php if($view_press_release[0]->status == 4){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('schedule_for_publish'); ?></label>
                        </div>
                <?php 
                }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $view_press_release[0]->status == 'regional office editor' && $this->auth_user->permission == 2 ){ 
                     if($view_press_release[0]->status_withdraw == 0){ ?>
                  <div class="col-md-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="3" onclick="hideDiv()" <?php if($view_press_release[0]->status == 3){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('publish'); ?></label>
                        </div>
                          <?php if($view_press_release[0]->status == 3){?>
                            <div class="col-md-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="9" onclick="hideDiv()" <?php if($view_press_release[0]->status == 9){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('un_published'); ?></label>
                        </div>
                      <?php }else if($view_press_release[0]->status == 9){?>
                          <div class="col-md-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="9" onclick="hideDiv()" <?php if($view_press_release[0]->status == 9){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('un_published'); ?></label>
                        </div>
                      <?php }?>
                         <div class="col-md-4 col-xs-12 col-option">
                            <input type="radio" name="status" value="4" onclick="ShowDiv()" <?php if($view_press_release[0]->status == 4){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('schedule_for_publish'); ?></label>
                        </div>


                    <?php }else{?>

                           <div class="col-md-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="9" onclick="hideDiv()" <?php if($view_press_release[0]->status == 9){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('un_published'); ?></label>
                        </div>
                          <div class="col-md-2 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="status" value="3" onclick="hideDiv()" <?php if($view_press_release[0]->status == 3){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('publish'); ?></label>
                        </div>
                          <div class="col-md-4 col-xs-12 col-option">
                            <input type="radio" name="status" value="4" onclick="ShowDiv()" <?php if($view_press_release[0]->status == 4){ echo "checked=checked";}  ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('schedule_for_publish'); ?></label>
                        </div>
                    <?php
                    } 
                   } ?>

                 
                    </div>
                </div>
            <!-- /.box-body -->
<?php if($view_press_release[0]->status == 4 && $this->auth_user->role != 'pro_admin'){?>
         <div class="container" id="welcomeDiv">
         <div class="row">
          <div class='col-sm-2'>
               <div class="form-group">
                 <label class="control-label"><?php echo trans('schedule_for_publish'); ?></label>
               </div>
            </div>
            <div class='col-sm-4'>
               <div class="form-group">
                  <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="schedule_for_publish" value="<?php echo $view_press_release[0]->schedule_for_publish;?>" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
         </div>
    </div>
<?php 
}else{?>
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
                     <input type='text' class="form-control" name="schedule_for_publish" value="" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
         </div>
    </div>

<?php
}
?>

    <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('update_press_release'); ?></button>
            </div>
                
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  function ShowDiv(){
    //alert('hi naazreen khan');
    document.getElementById("welcomeDiv").style.display = "";
  }
   function hideDiv() {
    document.getElementById("welcomeDiv").style.display = "none";
  }

</script>

<script type="text/javascript">
    $(function() {
    $('#service').change(function(){
        if($('#service').val() == 'Other Establishments') {
            $('#othter_service').show();  
        } else {
             $('#othter_service').hide(); 
            
        } 
    });
});
</script>
<?php $date =  $view_press_release[0]->schedule_for_publish;?>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:i:s'});
</script>            
 <script type="text/javascript">

  $(function(){
  $('#datetimepicker1').datetimepicker({ format: "YYYY-MM-DD HH:mm:ss" });
  });

   $(function(){
    $('#datetimepicker2').datepicker({
      minDate:new Date()
        });
    });

  $(function(){
    // $('#datetimepicker3').datepicker({
    //   minDate:new Date()
      $('#datetimepicker3').datetimepicker({ format: "DD/MM/YYYY" });
       // });
    });

//   $(function() {
// $('#service').change(function(){
//     if($('#service').val() == 'Other Service/Organisation') {
//         $('#othter_service').show();  
//     } else {
//          $('#othter_service').hide(); 
        
//     } 
// });
// });


</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="file" name="field_name[]" accept=".png, .jpg, .jpeg, .gif" value=""/><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div>'; //New input field html 
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

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttons_video'); //Add button selector
    var wrapper = $('.field_wrappers'); //Input field wrapper
    var fieldHTML = '<div><input type="file" name="field_name[]" accept=".mp4" value=""/><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div>'; //New input field html 
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

 $(function(e) {
    ///alert('hello');
    $('#row_dim').hide(); 
    $('#update-button').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '2') {
            //alert('hello');
            $('#row_dim').show();
            $('#row_dim1').hide(); 
            $('#row_dim2').hide();   
            $('#row_dim3').hide();   
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
            $('#pro_id').hide(); 
            $('#row_dim2').hide();   
            $('#row_dim3').hide();   
            $('.button-save').hide();   
            $('#update-button').show();  
            $('#group1').hide();
            $('#group2').hide();
            $('#group3').hide();
            $('#group4').hide();
            $('#group5').hide();
            $('#group6').hide();
            $('#lang_id').hide();
            $('#date_of_event').hide();
            $('#service_h').hide();
            $('#location').hide();
            $('#date_of_event').hide();
            //$('#release_date_issued').hide();
           // $('.img3').hide();
            //$('.img4').hide();
            //$('.img5').hide();
            $('#row_dim1').show(); 
            $('#row_dim2').show();   
            $('#row_dim3').show();
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


 $(document).ready(function(){
  // Initialize select2
  $("#selUser").select2();

  // Read selected option
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();
    $('#row_dim').html("id : " + userid + ", name : " + username);

  });

  $('#selUser').on('change', function() {

        var id =  this.value; 
        alert(id);
         var data = {
        'post_id': id
        //"set_of_cover": setofcover
        };
        
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        //alert(data[csfr_token_name]);

        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/press_release_ajax_val",
        data:data,
        success : function(data){ 
              //alert(data);
             var returnedData = JSON.parse(data); 
            // alert(returnedData.press_release);
             //console.log(returnedData.press_release_infographic);

             $("#MultidvPreview3").empty();
             $("#MultidvPreview4").empty();
             $("#MultidvPreview5").empty();

            jQuery.each(returnedData.press_release_infographic, function(index, value){
             
            $("#MultidvPreview3").append('<div class="row"><div class="col-sm-3"><img src="<?php echo base_url();?>'+value["media_path"]+'" width="70" height="60"></div><input type="text" placeholder="Caption" value="'+value["caption"]+'" disabled="disabled"></div>'); 
            });

             jQuery.each(returnedData.press_release_image, function(index, value){
            $("#MultidvPreview4").append('<div class="row"><div class="col-sm-3"><img src="<?php echo base_url();?>'+value["media_path"]+'" width="70" height="60"></div><input type="text"  placeholder="Caption" value="'+value["caption"]+'" disabled="disabled"></div>');
            });

            jQuery.each(returnedData.press_release_video, function(index, value){
            
           $("#MultidvPreview5").append('<div class="row"><div class="col-sm-3"><video width="200" height="100" controls><source src="<?php echo base_url();?>'+value["media_path"]+'"></video></div><input type="text" placeholder="Caption" value="'+value["caption"]+'" disabled="disabled"></div>');
            });
                
             $('#datetimepicker3').val(returnedData.press_release.date_of_event);  
             $('#pro_category').val(returnedData.press_release.pro_category);  
             $('#lang_id').val(returnedData.press_release.lang_id);  
             $('#location').val(returnedData.press_release.location);  
             $('#service').val(returnedData.press_release.service);  
             $('#other').val(returnedData.press_release.other);  
             //$('#datetimepicker2').val(returnedData.press_release.release_date_to_be_issued );   
             $('#event_subject').val(returnedData.press_release.event_subject); 
             //$('#who_prepared').val(returnedData.press_release.prepared_by_email);   
             //$('#who_reviewed').val(returnedData.press_release.reviewed_by_email); 
             $('#press_release_title').val(returnedData.press_release.press_release_title); 
             $('#MultidvPreview').html('<img src="<?php echo base_url();?>'+returnedData.press_release.feature_image+'"  width="70" height="60">');
             //$("#Multifileupload").attr("src",returnedData.press_release.feature_image); 
             $('#release_sub_heading').val(returnedData.press_release.release_sub_heading);
             $('#schedule_for_publish').val(returnedData.press_release.schedule_for_publish);
            if(returnedData.service === 'Other Establishments'){
              $('#othter_service').show();
             }else{
              $('#othter_service').hide();
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

               $('.tagsinput').val(returnedData.press_release.keywords);
               //$('.tagsinput').addClass('important');
                             
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
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_image'); //Add button selector
    var wrapper = $('.field_wrapper_image'); //Input field wrapper
    var fieldHTML = '<div><div class="row"><div class="col-md-3"><input type="file" id="upload_file" name="image[]" accept=".png, .jpg, .jpeg, .gif" value=""/></div><div class="col-md-8"><input type="text" name="caption-image-text[]" value="" placeholder="Brief Description" class="form-control"></div><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html//Add field html
        }
    });

     $(wrapper).on('change', '#upload_file', function(e){
      // if(x < maxField){ 
      //       x++; 
      e.preventDefault();
     $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[0])+"'>");  

      // }
   
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
    var addButton = $('.add_button_infographic'); //Add button selector
    var wrapper = $('.field_wrapper_infographic'); //Input field wrapper
     var fieldHTML = '<div><div class="row"><div class="col-md-3"><input type="file" id="upload_files" name="infographic[]" accept=".png, .jpg, .jpeg, .gif" value=""/></div><div class="col-md-8"><input type="text" name="caption-infographic-text[]" class="form-control" value="" placeholder="Brief Description"></div><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div></div>'; //New input field html  
    var x = 1; //Initial field counter is 1


    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
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
    var fieldHTML = '<div><div class="row"><div class="col-md-3"><input type="file" name="video[]" accept=".mp4,.mpeg,.mov,.avi" value=""/></div><div class="col-md-8"><input type="text" name="caption-video-text[]" placeholder="Brief Description" class="form-control" value=""></div><a href="javascript:void(0);" class="remove_button"><img src="<?php echo base_url(); ?>/assets/img/delete-image.png" width="35px" height="35px"/></a></div>'; //New input field html 
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
        url: base_url + "CommanAjax_controller/press_release_media_remove",
        data:data,
        success : function(data){
                                           
        },
        error : function(data)
        {
            //do something
        }
    });
    

}

    $(function() {
    $('#event_subject').change(function(){
        if($('#event_subject').val() == 'Photo Release') {
            $('#brief_des').hide();  
        } else {
             $('#brief_des').show(); 
            
        } 
    });
});

</script>
