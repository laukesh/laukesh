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
                <h3 class="box-title"><?php echo trans('update_image'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('video_controller/update_video_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($image->id); ?>">
                <input type="hidden" name="path_video" value="<?php echo html_escape($image->path_video); ?>">
          <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($image->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
             </div>
            
            <div class="col-sm-2">
                <div class="form-group">
                    <label><?php //echo trans("album"); ?>Category</label>
                    <select name="cate_id" id="albums" class="form-control" required onchange="get_categories_by_albums(this.value);">
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>" <?php echo ($image->cate_id == $album->id) ? 'selected' : ''; ?>><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('category'); ?>Sub Category</label>
                    <select id="sub_cat_id" name="sub_cat_id" class="form-control">
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($categories as $item):
                         ?>
                            <?php if ($item->id == $image->cate_id): ?>
                                <option value="<?php echo html_escape($item->id); ?>" selected>
                                    <?php echo html_escape($item->name); ?>
                                </option>
                            <?php else: ?>
                                <option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
             </div>
               <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($image->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Brief of Description Video</label>
           <div id="main_editor">
            <textarea class="tinyMCE form-control" name="content"  id="content" aria-hidden="true">
             <?php echo $image->content; ?>      
            </textarea>
            </div>
        </div>
            
        <div class="form-group">
                <label class="control-label">Slug<small>(If you leave it blank, it will be generated automatically.)</small>
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo $image->title_slug; ?>">
            </div>

        <div class="form-group">
            <label class="control-label">Keywords (Meta Tag)</label>
            <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo $image->keywords; ?>" />
            <small>(<?php echo trans('muti_keywords'); ?>)</small>
        </div>

        <div class="form-group">
            <label class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)"><?php echo $image->summary_desc; ?></textarea>
         </div>

                <div class="form-group">
                    <label class="control-label"><?php //echo trans('category'); ?>Video Link</label>
                     <select id="video_link" name="video_link" class="form-control" required onchange="showDiv('hidden_div', this)">
                         <option value=""><?php echo trans('select'); ?></option>
                        <?php $var = array('1'=>'Mp4 Video', '2'=>'Youtube Video');
                        foreach ($var as $key => $value):
                             if ($key == $image->link): ?>
                                <option value="<?php echo html_escape($key); ?>" selected>
                                    <?php echo html_escape($value); ?>
                                </option>
                            <?php else: ?>
                                <option value="<?php echo html_escape($key); ?>"><?php echo html_escape($value); ?></option>
                            <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </div>
               
                 <div id="<?php if($image->link == 2){ echo '';}else{ echo 'hidden_div2';}?>" class="form-group">
                    <label class="control-label"><?php //echo trans('title'); ?>youtube</label>
                    <input type="text" class="form-control"
                           name="youtube_link" id="youtube_link" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($image->youtube_link); ?>">
                </div>


              

                <div id="<?php if($image->link == 1){ echo '';}else{ echo 'hidden_div';}?>" class="form-group">
                    <label class="control-label"><?php //echo trans('video'); ?> video</label>
                    <div class="row">
                        <div class="col-sm-4">

                          <?php if(!empty($image->path_video))
                           {
                           ?>
                            <video width="220" height="160" controls>
                              <source src="<?php echo base_url() . html_escape($image->path_video); ?>" type="audio/mpeg">
                            </video>
                            <?php 
                            }else{
                            ?>
                            <img src="<?php echo base_url() .'/uploads/video/sorry_no_videos.png';?>" width="220" height="160">
                           <?php 
                           }
                           ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_video'); ?>
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".mp4,.mpeg,.mov,.avi" style="cursor: pointer;">
                            </a>
                            <span>You can browse one Video (mp4,mpeg,mov,avi)</span>
                        </div>
                    </div>

                    <div id="MultidvPreview"></div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('save_changes'); ?>Update Video</button>
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