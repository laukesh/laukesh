<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('update_image'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('gallery_controller/update_gallery_image_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($image->id); ?>">
                <input type="hidden" name="path_big" value="<?php echo html_escape($image->path_big); ?>">
                <input type="hidden" name="path_small" value="<?php echo html_escape($image->path_small); ?>">
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
                    <label><?php echo trans("album"); ?></label>
                    <select name="album_id" id="albums" class="form-control" onchange="get_categories_by_albums(this.value);">
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>" <?php echo ($image->album_id == $album->id) ? 'selected' : ''; ?>><?php echo $album->name; ?></option>
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
                <label class="control-label">Brief Description of Photo</label>
                <div id="main_editor">
                <div class="row">
                    
                </div>
                <!-- <textarea class="tinyMCE form-control" name="content"  id="content" aria-hidden="true"><?php echo html_escape($image->content); ?></textarea> -->
                <textarea rows="10" class="form-control" name="content"  id="content" aria-hidden="true"><?php echo html_escape($image->content); ?></textarea>
            </div>
            </div>
        </div>

<!--               <div class="col-sm-12">

                 <div class="form-group">
                <label class="control-label">Slug
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo html_escape($image->title_slug); ?>" >
            </div>
            </div> -->
            <div class="col-sm-12">
            <div class="form-group">            
              <label class="control-label"><?php echo trans('keywords'); ?><span style="color:red"></span></label>
              <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo html_escape($image->keywords); ?>" />
              <small>(<?php echo trans('muti_keywords'); ?>)</small>
            </div></div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)" ><?php echo html_escape($image->summary_desc); ?></textarea>
             </div>
         </div>

            
         <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <div class="row">

                        <div class="col-sm-4">
                           <?php if(!empty($image->path_small)){?>
                            <img src="<?php echo base_url() . html_escape($image->path_small); ?>" alt=""
                                 class="thumbnail img-responsive">
                           <?php }else{?>
                            <img src="<?php echo base_url();?>assets-front/images/no-image.png" alt=""
                                 class="thumbnail img-responsive">
                            <?php
                             }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" style="cursor: pointer;">
                            </a>
                        </div>
                    </div>

                    <div id="MultidvPreview"></div>
                </div>
            </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>