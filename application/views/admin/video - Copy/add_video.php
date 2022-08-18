<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    #hidden_div {
    display: none;
}
    #hidden_div2 {
    display: none;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans("add_video"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>video" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("video"); ?>
                    </a>
                </div>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('video_controller/add_video_post'); ?>

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
                    <label><?php //echo trans("video"); ?>Category</label>
                    <select name="cate_id" id="cate_id" class="form-control" required onchange="get_categories_by_albums(this.value);">
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($album as $video): ?>
                            <option value="<?php echo $video->id; ?>"><?php echo $video->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('category'); ?>Sub Category</label>
                    <select id="categories" name="sub_cate_id" class="form-control">
                        <option value=""><?php echo trans('select'); ?></option>
                    </select>
                </div> 
            </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
        </div>

           

        <div class="form-group">
        <label class="control-label">Brief of Description Video</label>
        <div id="main_editor">
            <div class="row">
                
            </div>
            <textarea class="tinyMCE form-control" name="content" value="" id="content" aria-hidden="true"></textarea></div>
        </div>

         <div class="form-group">
                <label class="control-label">Slug<small>(If you leave it blank, it will be generated automatically.)</small>
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="">
            </div>

        <div class="form-group">
            <label class="control-label">Keywords (Meta Tag)</label>
           <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="" />
            <small>(<?php echo trans('muti_keywords'); ?>)</small>
        </div>

        <div class="form-group">
            <label class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)"></textarea>
         </div>

        
                <div class="form-group">
                    <label class="control-label"><?php echo trans('type'); ?></label>
                    <select id="link" name="link" class="form-control" required onchange="showDiv('hidden_div', this)">
                        <option value="">Select</option>
                        <option value="1">Mp4 Video</option>
                        <option value="2">Youtube Video</option>
                    </select>
                </div>

                <div id="hidden_div2" class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>youtube</label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="">
                </div>

              



                <div id="hidden_div" class="form-group">
                    <label class="control-label"><?php echo trans('video'); ?></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_video'); ?>
                                <input type="file" id="video" name="video" size="40" accept=".mp4">
                            </a>
                            <span><?php echo trans("select_multiple_video"); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="MultidvPreview">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_video'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div> 
<script type="text/javascript">

function showDiv(divId, element)
{
if(element.value == 1){
document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';  
  
}else if(element.value == 2){
    var hide_div = 'hidden_div2';
    document.getElementById(hide_div).style.display = element.value == 2 ? 'block' : 'none'; 
    $('#hidden_div').hide();
}
}

</script>