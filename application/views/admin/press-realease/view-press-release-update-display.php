<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$pro = $this -> db
           -> select('id')
           -> where('id', $this->auth_user->pro_category_id)
           -> where('is_active', 1)
           -> limit(1)
           -> get('tbl_pru_category')
           ->result_array();

//echo '<pre>';print_r($press_realease_service);
//die();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php //echo trans("view_press_release"); ?>View Press Release Update Request</h3>
                </div>

                 <div class="right">
                    <a href="<?php echo admin_url(); ?>view_update_request_press_release" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php //echo trans("press_release"); ?> Press Release update Request List
                    </a>
                </div>
               
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('press_realease_controller/add_press_release_post'); ?>

                <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>
             <div class="row">
                <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("press_release_type"); ?><span style="color:red">*</span></label>
                     <select name="press_release_type"  class="form-control" disabled="disabled">
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($press_realease_type as $item): ?>
                            <option value="<?php echo $item->id; ?>" <?php echo ($view_press_release[0]->press_release_type  == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
                <div class="col-sm-2">
                 <div class="form-group">
                    <label><?php echo trans("pro_category"); ?><span style="color:red">*</span></label>
                   <select name="press_release_category" disabled="disabled" class="form-control" <?php if($this->auth_user->pro_category_id >0){ echo  ''; } ?>>
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php echo ($view_press_release[0]->pro_category  == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
              <div class="col-sm-2">
               <div class="form-group">
                    <label><?php echo trans("language"); ?><span style="color:red">*</span></label>
                   <select name="lang_id"  class="form-control" disabled="disabled" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  
            </div>      
                <div class="col-sm-2">
                    <div class="form-group">
                    <label class="control-label"><?php echo trans('date_event'); ?><span style="color:red">*</span></label>
                    <input type="text" class="form-control" 
                           name="date_of_event" id="datetimepicker3" disabled="disabled" placeholder="<?php echo trans('date_event'); ?>"
                           value="<?php $dateTime = new DateTime($view_press_release[0]->date_of_event, new DateTimeZone('Asia/Kolkata')); echo $dateTime->format("d-m-Y"); ?>">
                    </div>
                </div>

                <div class="col-sm-4">
                <div class="form-group">
                    <label><?php //echo trans("service"); ?><span>Services/Organisation</span></label>
                    <select name="service" class="form-control" id="service" disabled="disabled">
                        <option value=""><?php echo trans('select'); ?></option>
                    <?php foreach ($press_realease_service as $item): ?>
                    <option value="<?php echo $item->name; ?>"<?php echo ($view_press_release[0]->service  == $item->name) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>
              </div>
              </div>
        
            <div class="form-group" style="display:none;" id="row_dim">
                    <label><?php echo trans("press_release"); ?><span style="color:red">*</span></label>
                    <select name="press_release_val" disabled="disabled" class="form-control" id="selUser" style="width:645px;">
                        <option value=""><?php echo trans('select_press_release'); ?></option>
                          <?php foreach ($press_realease_by_user as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->press_release_title; ?></option>
                        <?php endforeach; ?>
                       
                    </select>
                </div>

             <div class="form-group" id="othter_service" <?php if($view_press_release[0]->service !== 'Other Establishments'){ echo 'style="display:none"';}?>>
                    <label class="control-label"><?php echo trans('other-service'); ?><span style="color:red">*</span></label>
            <input type="text" class="form-control" name="other" id="other" disabled="disabled" placeholder="<?php echo trans('other-service'); ?>" value="<?php echo $view_press_release[0]->other;?>">
                </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('event/subject'); ?><span style="color:red">*</span></label>
                    <input type="text" class="form-control" disabled="disabled"
                           name="event_subject" id="event_subject" placeholder="<?php echo trans('event/subject'); ?>"
                           value="<?php echo $view_press_release[0]->event_subject;?>">
                </div> 
               </div> 

               <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('location'); ?><span style="color:red">*</span></label>
                    <input type="text" class="form-control" disabled="disabled"
                           name="location" id="location" placeholder="<?php echo trans('location'); ?>"
                           value="<?php echo $view_press_release[0]->location;?>">
                </div> 
              </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('press_release_title'); ?><span style="color:red">*</span></label>
                    <input type="text" class="form-control"
                           name="press_release_title" id="press_release_title" placeholder="<?php echo trans('press_release_title'); ?>"
                           value="<?php echo $view_press_release[0]->press_release_title;?>" disabled="disabled">
                 </div>
              </div> 

            <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('release_sub_heading'); ?></label>
                    <input type="text" class="form-control"
                           name="release_sub_heading" id="release_sub_heading" disabled="disabled" placeholder="<?php echo trans('release_sub_heading'); ?>"
                           value="<?php echo $view_press_release[0]->release_sub_heading;?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                  </div>
                </div>
             </div>
        
        <div class="form-group">
            <label class="control-label"><?php echo trans('press_release_brief_description'); ?><span style="color:red">*</span></label>
            <input type="text" class="tinyMCE form-control"
                           name="press_release_text" id="press_release_text" disabled="disabled" placeholder="<?php echo trans('press_release_text'); ?>"
                           value="<?php echo $view_press_release[0]->press_release_text;?>">
    </div>  

<?php 
  if ($this->auth_user->role != "pro_admin"){?>
        
               <div class="row">
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_prepared'); ?></label>
                    <input type="text" class="form-control"
                           name="who_prepared" id="who_preparedq" disabled="disabled" placeholder="<?php echo trans('prepared_by'); ?>"
                           value="<?php echo $view_press_release[0]->prepared_by_email;?>">
                  </div>
                </div>

                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('who_reviewed'); ?></label>
                    <input type="text" class="form-control"
                           name="who_reviewed" id="who_reviewed" disabled="disabled" placeholder="<?php echo trans('reviewed_by'); ?>"
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
                          <label class="control-label"><?php echo trans('keywords'); ?><span style="color:red">*</span></label>
                          <input id="tags_1" type="text" disabled="disabled" name="keywords"  class="form-control" value="<?php echo $view_press_release[0]->keywords;?>" />
                          <small>(<?php echo trans('muti_keywords'); ?>)</small>
                      </div>
                  </div>
               </div> 
<?php if(!empty($view_press_release[0]->feature_image)){?>
                <div class="form-group">
                    <label class="control-label"><?php echo trans('feature_image'); ?> (Banner Image or Main Image)<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" disabled="disabled" name="feature_image" size="40" accept=".png, .jpg, .jpeg, .gif" required>
                            </a>
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
<?php }?>
<?php if(!empty($view_press_release_infographic)){?>
<hr style="width:100%;text-align:left;margin-left:0">
<div class="field_wrapper">
  <label class="control-label" style="color:black;"><span class="btn btn-success"><?php //echo trans('infographics_image'); ?>Infographics</span></label>


<?php  foreach ($view_press_release_infographic as  $value){ 
?>
<div class="row">
<div class="col-sm-4">
<img src="<?php echo base_url() . html_escape($value->media_path); ?>" alt="" class="thumbnail img-responsive" style="width:50px height:50px"></div>
<input type="text" name="caption-image-text[]" disabled="disabled" value="<?php echo html_escape($value->caption); ?>" placeholder="Brief Description">
</div>
<?php 
}
?>

</div>
<?php
}?>
<?php if(!empty($view_press_release_image)){?>
<hr style="width:100%;text-align:left;margin-left:0">
<div class="field_wrapper">
  <label class="control-label" style="color:black;"><span class="btn btn-success"><?php echo trans('image'); ?></span></label>

<?php  foreach($view_press_release_image as  $value){ 
?>
<div class="row">
<div class="col-sm-4">
<img src="<?php echo base_url() . html_escape($value->media_path); ?>" alt="" class="thumbnail img-responsive" style="width:50px height:50px"></div>
<input type="text" name="caption-image-text[]" disabled="disabled" value="<?php echo html_escape($value->caption); ?>" placeholder="Brief Description">
</div>
<?php 
}
?>
</div>
<?php
}
?>
<?php if(!empty($view_press_release_video)){?>
<hr style="width:100%;text-align:left;margin-left:0">

<div class="field_wrapper">
  <label class="control-label" style="color:black;"><span class="btn btn-warning"><?php echo trans('video'); ?></span></label>

<?php  foreach ($view_press_release_video as  $value){ 
?>
<div class="row">
<div class="col-sm-4">
<video width="220" height="160" controls="">
<source src="<?php echo base_url() . html_escape($value->media_path); ?>" alt="" class="thumbnail img-responsive" style="width:50px height:50px"></video></div>
<input type="text" name="caption-image-text[]" disabled="disabled" value="<?php echo html_escape($value->caption); ?>" placeholder="Brief Description">
</div>
<?php 
}
?>
</div>
<?php
}
?>

<hr style="width:100%;text-align:left;margin-left:0">
             <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <label><?php echo trans('is_active'); ?></label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 col-option">
                            <label for="rb_is_active_1" class="cursor-pointer">
                              <?php if($view_press_release[0]->status == 3){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Published</label>

                              <?php
                               }elseif($view_press_release[0]->status == 1){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Drafted</label>

                              <?php
                               }elseif($view_press_release[0]->status == 2){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Pending for Review</label>

                              <?php
                               }elseif($view_press_release[0]->status == 6){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Rejected</label>

                              <?php
                               }elseif($view_press_release[0]->status == 4){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Scheduled for Publish</label>
                                  <label for="rb_is_active_1" class="cursor-pointer"><?php echo $view_press_release[0]->schedule_for_publish;?></label>

                              <?php
                               }elseif($view_press_release[0]->status == 5){?>
                                  <label for="rb_is_active_1" class="cursor-pointer">Deleted</label>

                              <?php
                               }elseif($view_press_release[0]->status == 7){?>
                                  <label for="rb_is_active_1" class="cursor-pointer"><?php echo trans('withdraw'); ?></label>

                              <?php
                               }
                               ?>
                              
                            
                        </div>
                    </div>
                </div>
            <!-- /.box-body -->

         <div class="container" id="welcomeDiv" style="display:none;">
         <div class="row">
          <div class='col-sm-2'>
               <div class="form-group">
                 <label class="control-label" style="color:black;"><?php echo trans('schedule_on_publish'); ?></label>
               </div>
            </div>
            <div class='col-sm-4'>
               <div class="form-group">
                  <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="schedule_for_publish" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
         </div>
    </div>
                
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
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

 <script type="text/javascript">
  $(function(){
    $('#datetimepicker1').datetimepicker({
      minDate:new Date()
        });
     });

   $(function(){
    $('#datetimepicker2').datepicker({
      minDate:new Date()
        });
    });

  $(function(){
    $('#datetimepicker3').datepicker({
      minDate:new Date()
        });
    });


</script>

<script type="text/javascript">
   
$(document).ready(function(){
tinymce.activeEditor.mode.set("readonly");
$('#tags_1').tagsInput({
        'interactive':false,
         'width':1340
        });

});

  
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
    var addButton = $('.add_button_video'); //Add button selector
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
</script>