<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    #hidden_div {
    display: none;
}
    #hidden_div2 {
    display: none;
}
    #hidden_div3 {
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

                <input type="hidden" name="id" value="<?php echo html_escape($video->id); ?>">
                <input type="hidden" name="path_video" value="<?php echo html_escape($video->path_video); ?>">
                <input type="hidden" name="created_at" value="<?php echo html_escape($video->created_at); ?>">
          <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_albums_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($video->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
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
                            <option value="<?php echo $album->id; ?>" <?php echo ($video->cate_id == $album->id) ? 'selected' : ''; ?>><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              </div>

               <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($video->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Brief of Description Video</label>
           <div id="main_editor">
           <!--  <textarea class="tinyMCE form-control" name="content"  id="content" aria-hidden="true">
             <?php //echo $video->content; ?>      
            </textarea> -->
             <textarea rows="10" class="form-control" name="content"  id="content" aria-hidden="true">
             <?php echo $video->content; ?>      
            </textarea>
            </div>
        </div>
            
   <!-- <div class="form-group">
            <label class="control-label">Slug<small>(If you leave it blank, it will be generated automatically.)</small>
            </label>
            <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo $image->title_slug; ?>">
    </div>-->

        <div class="form-group">
            <label class="control-label">Keywords (Meta Tag)</label>
            <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo $video->keywords; ?>" />
            <small>(<?php echo trans('muti_keywords'); ?>)</small>
        </div>

        <div class="form-group">
            <label class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)"><?php echo $video->summary_desc; ?>
            </textarea>
         </div>

                <div class="form-group">
                    <label class="control-label">Video Link</label>
                     <select id="video_link" name="link" class="form-control" onchange="showDiv(this.value)">
                        <?php $var = array('1'=>'Mp4 Video', '2'=>'Youtube link');
                        foreach ($var as $key => $value):?>
                            <option value="<?php echo html_escape($key); ?>"
                                <?php if($key == $video->link): ?> selected="selected"<?php endif; ?>>
                                <?php echo html_escape($value); ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
               
                 <div id="youtube" class="form-group">
                    <label class="control-label">Youtube</label>
                    <input type="text" class="form-control"
                           name="youtube_link" id="youtube_link" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($video->youtube_link); ?>">
                </div>

                  <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?><span style="color:red"></span></label>
                    <div class="col-sm-12">
                        <div class="row">
                        <input type="file" id="Multifileupload" name="cover_img" size="40" accept=".png, .jpg, .jpeg, .gif" value="<?php echo base_url() . html_escape($video->path_image); ?>">
                           
                            <span>You can browse one image (png,jpg,jpeg,gif)</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="MultidvPreview">
                              <img src="<?php echo base_url() . html_escape($video->path_image); ?>" alt="" class="thumbnail img-responsive" >
                            </div>
                        </div>
                    </div>
                </div>

   

                <div id="video" class="form-group">
                    <label class="control-label">Video</label>
                    <div class="row">
                        <div class="col-sm-4">
                          <?php if(!empty($video->path_video))
                           {
                           ?>
                            <video width="220" height="160" controls>
                              <source src="<?php echo base_url() . html_escape($video->path_video); ?>" type="audio/mpeg">
                            </video>
                            <?php 
                            }else{
                            ?>
                            
                           <?php 
                           }
                           ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">               
                                <?php //echo trans('select_video'); ?>
                                <input type="file" id="Multifileupload" class="video_file" name="video" size="40" accept=".mp4,.mpeg" style="cursor: pointer;">
                            
                            <span>(You can select only .mp4, .mpeg Video.)</span>
                        </div>
                    </div>

                   <!--  <div id="MultidvPreview"></div> -->
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

function showDiv(item)
{  
    var ht = item;
    if(ht == '1'){
        $('#youtube').hide();
        $('.video_file').attr('name', 'video');
        $('#video').show();
    }else{
        $('#video').hide();
        $('.video_file').attr('name', 'newname');
        $('#youtube').show();
    }
   

}

$( document ).ready(function() {

   var ht = $('#video_link').val();
    
    if(ht == '1'){
        $('#youtube').hide();
         $('.video_file').attr('name', 'video');
        $('#video').show();
    }else{
        $('#video').hide();
        $('.video_file').attr('name', 'newname');
        $('#youtube').show();
    }
});

</script>