<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php //echo trans('update_image'); ?>Update Logo Gallery</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('logo_controller/update_logo_gallery_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($logo_gallery->id); ?>">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_logo_gallery_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($logo_gallery->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($logo_gallery->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>


               <div class="form-group">
                <label class="control-label">url
                </label>
                <input type="text" class="form-control" name="url" placeholder="url" value="<?php echo html_escape($logo_gallery->url); ?>" required>
            </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?> </label>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo base_url() . html_escape($logo_gallery->path_small); ?>" alt=""
                                 class="thumbnail img-responsive">
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