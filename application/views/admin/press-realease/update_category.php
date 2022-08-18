<?php 
$pru_cate2 = $this->uri->segment(3);

$query = $this->db->query("SELECT * FROM  tbl_pru_category where  id = $pru_cate2");
$result =  $query->result_array();


if(empty($result[0]['pro_parent_id'])){
    $pru_cate = $this->uri->segment(3);
}else{
    $pru_cate = $result[0]['pro_parent_id'];
}

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_category"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('press_realease_controller/update_category_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($category[0]->id); ?>">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); 
               
                ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><?php echo trans("language"); ?></label>
                        <select name="lang_id" class="form-control" onchange="getval(this);">
                            <?php foreach ($this->languages as $language): ?>
                                <option value="<?php echo $language->id.','.$pru_cate; ?>" <?php echo ($category[0]->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
              <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("category_name"); ?></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo trans("category_name"); ?>"
                           value="<?php echo html_escape($category[0]->name); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> required>
                     </div>
                </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?>
                    </label>
                    <input type="text" class="form-control" name="name_slug" id="name_slug" placeholder="<?php echo trans("slug"); ?>"
                           value="<?php echo html_escape($category[0]->slug); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
        </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="<?php echo trans('description'); ?>" value="<?php echo html_escape($category[0]->description); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

               <!--  <div class="form-group">
                    <label class="control-label"><?php //echo trans('keyword'); ?><?php //echo trans('keyword_tag'); ?></label>
                    <input type="text" class="form-control" name="keyword"
                           placeholder="<?php //echo trans('keyword'); ?>" value="<?php //echo html_escape($category[0]->keyword); ?>" <?php //echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div> -->



                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <label><?php echo trans('is_active'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_1" name="is_active"  value="1" class="square-purple" <?php echo ($category[0]->is_active == '1') ? 'checked' : ''; ?>>
                            <label for="rb_is_active_1" class="cursor-pointer"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_is_active_2" name="is_active"  value="0" class="square-purple" <?php echo ($category[0]->is_active != '1') ? 'checked' : ''; ?>>
                            <label for="rb_is_active_2" class="cursor-pointer"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <label><?php echo trans('is_headquarter'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_is_headquarter_1" name="is_headquarter" id="is_headquarter" value="1" class="square-purple" <?php echo ($category[0]->is_headquarter == '1') ? 'checked' : ''; ?>>
                            <label for="rb_ is_headquarter_1" class="cursor-pointer"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_ is_headquarter_2" name="is_headquarter" id="is_headquarter" value="0" class="square-purple" <?php echo ($category[0]->is_headquarter != '1') ? 'checked' : ''; ?>>
                            <label for="rb_ is_headquarter_2" class="cursor-pointer"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>


            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?> </button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>

</div>


<script type="text/javascript">
function getval(sel)
{
    var langval = sel.value;
    var items = langval.split(',');
    var lang_id = items[0];
    var pru_id = items[1];
      
      var data = {
        "lang_id": items[0],
        "pru_id": items[1]
        };

      data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "press_realease_controller/post_action_pru_lang_ajax",
        data:data,
        success : function(data)
        {
              var returnedData = JSON.parse(data);  
              //alert(returnedData);


               if(returnedData){
               $('#name').val(returnedData.name);
               $('#name_slug').val(returnedData.slug);
               $('#description').val(returnedData.description);
               $('#rb_is_active_1').val(returnedData.is_active);
               $('#is_headquarter').val(returnedData.is_headquarter);
              
              // if(returnedData.is_active == "1"){
              //     alert(returnedData.is_active);
              //   $('#rb_is_active_1').find(':radio[name=is_active][value="1"]').prop('checked', true);
              //   } else {
              //   $('#rb_is_active_2').find(':radio[name=is_active][value="0"]').prop('checked', true);
              //   } 


               }else{
                      
                    $('#name').val('');
                    $('#name_slug').val('');
                    $('#description').val('');
                    $('.is_active').val('');
                    $('.is_headquarter').val('');
               }
              

                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}

</script>