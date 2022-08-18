<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
 <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="left">
                <h3 class="box-title"><?php //echo trans('add_category'); ?>Add Circular</h3>
            </div>
              <!--  <div class="right">
                    <a href="<?php echo admin_url(); ?>view-circular" class="btn btn-success btn-add-new">
                        <i class="fa fa-plus"></i>
                        <?php echo trans("list_circular"); ?>
                    </a>
               </div> -->
         </div>
 
            <?php echo form_open_multipart('circular_controller/add_circular_manage_post'); ?>
            <input type="hidden" name="parent_id" value="0">
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>
        <div class="row">
            <div  class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_circular_category_by_lang(this.value)">
                        <!-- <option>Select Language</option> -->
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
              </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php //echo trans("album"); ?>Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
                    </select>   
                   </div>
                 </div>

            <div class="col-sm-4">
                 <div class="form-group">
                    <label><?php echo trans('circular_number'); ?></label>
                    <input type="number" class="form-control" name="circular_number" placeholder="<?php echo trans('circular_number'); ?>"
                           value="<?php echo old('circular_number'); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> >
                  </div>
               </div>
            </div>
             <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> >
                </div>
               </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans('slug'); ?></label>
                    <input type="text" class="form-control" name="slug" placeholder="<?php echo trans('slug'); ?>"
                           value="<?php echo old('slug'); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
                </div>
            </div>
              <div class="row">
                <div class="col-sm-6">
                 <div class="form-group">
                    <label><?php echo trans('description'); ?></label>
                    <input type="text" class="form-control" name="description" placeholder="<?php echo trans('description'); ?>"
                           value="<?php echo old('description'); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div></div>
             <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans('file'); ?></label>
                    <input type="file" class="form-control" name="file" accept=".doc, .docx, .ppt, .pdf"
                           value="" >
                </div>
            </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('add_category'); ?>Add Circular</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
 function get_circular_category_by_lang(val){
    var data = {
        "lang_id": val
        };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "circular_controller/circular_category_by_lang",
        data: data,
        success: function (response){
            //alert(response);
            $('#category_id').children('option:not(:first)').remove();
            $("#category_id").append(response);
        }
    });

}

</script>