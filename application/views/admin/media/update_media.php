<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$this->db->where('id', $image[0]->regional_pro_id);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('users');
      $data  = $query->result();
      //echo '<pre>';print_r($image[0]);
      //die;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php //echo trans("add_audio"); ?>Update Media Invite</h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>media-invite" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php //echo trans("audio"); ?>Media Invite
                    </a>
                </div>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('media_controller/update_media_post'); ?>
            <input type="hidden" name="id" value="<?php echo html_escape($image[0]->id); ?>">
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
             <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('pro_category'); ?></label>
                    <select  name="pro_category" id="pro_category" class="form-control" <?php if($this->auth_user->role == 'pro_admin'){ echo  'disabled="disabled"'; } ?>>
                        <option value=""><?php echo trans('select'); ?></option>
                          <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php echo ($image[0]->pro_category == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
              
              <div class="col-sm-2">
              <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Name of Regional PRO</label>
                     <Select class="form-control" name='regional_pro_id' id="regional_pro_id">
                    <?php if(empty($data)){?>
                      <option value="Others">Others</option> 
                    <?php }else{?>
                       <option value="<?php if($data[0]->id){ echo $data[0]->id;} ; ?>"><?php echo html_escape($data[0]->firstname.' '.$data[0]->lastname); ?></option> 
                       <option value="Others">Others</option>
                       <?php } ?>
                    </Select>
                </div>
            </div>
             
           <div class="col-sm-2" style="display:none;" id="prname">
          <div class="form-group" >
                <label class="control-label"><?php //echo trans(''); ?>Name</label>
                <input type="text" class="form-control" name="pro_name" id="pro_name"  placeholder="PRO Name"
                           value="<?php if(!empty($image[0]->name)){ echo html_escape($image[0]->name); } ?>">
                
                </div>
            </div>

                 <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Mobile No</label>
                    <input type="text" class="form-control"
                           name="mobile" id="mobile" required placeholder="Mobile Number"
                           value="<?php echo html_escape($image[0]->mobile); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
                </div>
                <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Date & Time of Event</label>
                    <div class='input-group date' id='datetimepicker1'>
                       <input type='text' class="form-control" name="date_of_event" value="<?php echo html_escape($image[0]->date_of_event); ?>" />
                       <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                     </div>
                </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Reporting Time</label>
                    <div class='input-group date' id='datetimepicker3'>
                       <input type='text' class="form-control" name="reporting_time" value="<?php echo html_escape($image[0]->reporting_time); ?>" />
                       <span class="input-group-addon">
                       <span class="glyphicon glyphicon-time"></span>
                       </span>
                    </div>
                </div>
            </div>
          </div>
            
            <div class="row">
               <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" required placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($image[0]->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Venue Of Event</label>
                    <input type="text" class="form-control"
                           name="venue_event" id="venue_event" placeholder="Venue Of Event"
                           value="<?php echo html_escape($image[0]->venue_event); ?>">
                    </div>
                
                </div>
            </div>
             <div class="row">
                <div class="col-sm-10">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Remarks</label>
                    <input type="text" class="form-control"
                           name="remark" id="remark" required placeholder="remark"
                           value="<?php echo html_escape($image[0]->remark); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
              </div>
              <div class="col-sm-2">
              <div class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>Invitees</label>
                    <select name="invitees" id="invitees" class="form-control">
                     <?php  foreach ($invitees as  $value){ ?>
                        <option value="<?php echo $value->id;?>" <?php echo ($image[0]->invitees == $value->id) ? 'selected' : ''; ?>><?php echo $value->name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
          </div>

                
        <div class="form-group">
            <label class="control-label">Keywords (Meta Tag)</label>
            <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo html_escape($image[0]->keywords); ?>" />
            <small>(<?php echo trans('muti_keywords'); ?>)</small>
        </div>

        <div class="form-group">
            <label class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="description" placeholder="Summary &amp; Description (Meta Tag)"><?php echo html_escape($image[0]->description); ?></textarea>
         </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('add_audio'); ?>Update Media Invite</button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script type="text/javascript">
         $(function () {
             $('#datetimepicker1').datetimepicker({ format: "YYYY-MM-DD HH:mm:ss" });
         });

          $(function () {
             $('#datetimepicker3').datetimepicker({
                 format: 'LT'
             });
         });
      </script>

<script>
$(document).ready(function(){
 $('#pro_category').change(function(){
  var pro_category = $('#pro_category').val();
  if(pro_category != '')
  {
    data = {'pro_category':pro_category}
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
   $.ajax({
    method:"POST",
    url: base_url + 'media_controller/fetch_pro',
    data:data,
    success:function(data)
    {
       
     $('#regional_pro_id').html(data);
    // $('#city').html('<option value="">Select City</option>');
    }
   });

  }

 });

 $('#regional_pro_id').change(function(){
  var regional_pro_id = $('#regional_pro_id').val();
  if(regional_pro_id != '')
  {
    //alert(regional_pro_id);
    if(regional_pro_id == 'Others'){
       // alert('hello');
        $('#prname').show();   
    }else{
     $('#prname').hide();  
    }
    //alert(regional_pro_id);
    data = {'regional_pro_id':regional_pro_id}
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
   $.ajax({
    method:"POST",
    url: base_url + 'media_controller/fetch_pro_id',
    data:data,
    success:function(data)
    {
      if(!empty(data)){
     $('#mobile').val(data);
  }
    }
   });

  }

 });

});
</script>
<script>
$(document).ready(function(){
 var regional_pro_id = $('#regional_pro_id').val();
    if(regional_pro_id == 'Others'){
       $('#prname').show();
    }else{
         $('#prname').hide();
    }
    });
</script>