<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php //echo trans('update_image'); ?>Update Radio Program</h3>

            <div class="right">
                    <a href="<?php echo admin_url(); ?>audio" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("audio"); ?>
                    </a>
                </div>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('audio_controller/update_gallery_image_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
         
                <input type="hidden" name="id" value="<?php echo html_escape($image->id); ?>">
                <input type="hidden" name="path_audio" value="<?php echo html_escape($image->path_audio); ?>">
                 <input type="hidden" name="created_at" value="<?php echo html_escape($image->created_at); ?>">
            <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_audio_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($image->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
               <div class="col-sm-2">
                <div class="form-group">
                    <label><?php //echo trans("album"); ?>Category</label>
                    <select name="cate_id" id="cate_id" class="form-control" onchange="get_categories_by_audio_albums(this.value);">
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>" <?php echo ($image->audio_album_id == $album->id) ? 'selected' : ''; ?>><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              </div>
     
             <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($image->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                <label class="control-label">Brief Description of Radio Program</label>
                <div id="main_editor">
                    <div class="row">
                        
                    </div>
                    <textarea class="tinyMCE form-control" name="content" value="" id="content" aria-hidden="true"><?php echo html_escape($image->content); ?></textarea></div>
                </div>
                </div>

                <!-- <div class="form-group">
                <label class="control-label">Slug<small>(If you leave it blank, it will be generated automatically.)</small>
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo html_escape($image->title_slug); ?>">
            </div> -->

            <div class="form-group">
            <label class="control-label"><?php echo trans('keywords'); ?><span style="color:red"></span></label>
            <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo html_escape($image->keywords); ?>" />
            <small>(<?php echo trans('muti_keywords'); ?>)</small>
        </div>

            <div class="form-group">
                <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)"><?php echo html_escape(strip_tags($image->summary_desc)); ?></textarea>
             </div>

           

                <div class="form-group">
                    <label class="control-label"><?php echo trans('audio'); ?> </label>
                    <div class="row">
                        <div class="col-sm-4">
                           <audio controls>
                                  <source src="<?php echo base_url() . html_escape($image->path_audio); ?>">
                                </audio>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                       
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .mp3" style="cursor: pointer;">
                            <span>You can browse one Radio Program (mp3)</span>
                        </div>
                    </div>

                    <!-- <div id="MultidvPreview"></div> -->
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('update_audio'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>