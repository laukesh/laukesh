<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">

                <div class="left">
                <h3 class="box-title"><?php echo trans('update_infographics'); ?></h3>
               </div>

              <div class="right">
                    <a href="<?php echo admin_url(); ?>infographic" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("infographics"); ?>
                    </a>
                </div>
            </div>

            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('infographic_controller/update_infographic_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($infographic->id); ?>">
                <input type="hidden" name="path_big" value="<?php echo html_escape($infographic->path_big); ?>">
                <input type="hidden" name="created_at" value="<?php echo html_escape($infographic->created_at); ?>">
        <div class="row">
             <div class="col-sm-3">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_infographic_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($infographic->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                    <label><?php echo trans("album"); ?></label>
                    <select name="infographic_category" id="infographic_category" class="form-control" >
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($infographic_cate as $info): ?>
                            <option value="<?php echo $info->id; ?>" <?php echo ($infographic->infographic_category == $info->id) ? 'selected' : ''; ?>><?php echo $info->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($infographic->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                     </div>
                 </div>
             </div>

                 
            <div class="form-group">
                <label class="control-label">Brief of Description Infographic</label>
                <div id="main_editor">
                <div class="row">
                    
                </div>
                <textarea class="tinyMCE form-control" name="content"  id="content" aria-hidden="true"><?php echo html_escape($infographic->content); ?></textarea>
            </div>
            </div>

          <!--   <div class="form-group">
                <label class="control-label">Slug
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo html_escape($infographic->title_slug); ?>" >
            </div> -->

            <div class="form-group">
                <label class="control-label">Keywords (Meta Tag)</label>
                <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="<?php echo html_escape($infographic->keywords); ?>" />
                        
            </div>

            <div class="form-group">
                <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)" ><?php echo html_escape($infographic->summary_desc); ?></textarea>
             </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('infographic'); ?> </label>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo base_url() . html_escape($infographic->path_big); ?>" alt=""
                                 class="thumbnail img-responsive">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" style="cursor: pointer;">
                            </a>
                            <span>(You can browse one image (png,jpg,jpeg,gif)</span>
                        </div>
                    </div>

                    <div id="MultidvPreview"></div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('save_changes'); ?>Update Infographic</button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>