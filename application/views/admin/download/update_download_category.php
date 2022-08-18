<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('update_download_category'); ?>Update download category</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('download_controller/update_download_category_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($download_category->id); ?>">
            <input type="hidden" name="created_at" value="<?php echo html_escape($download_category->created_at); ?>">

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($download_category->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                  <div class="col-sm-6">
                <div class="form-group">
                    <label><?php //echo trans('download_category_name'); ?>Category Name</label>
                    <input type="text" class="form-control" name="name" placeholder="<?php echo trans('download_category_name'); ?>"
                           value="<?php echo html_escape($download_category->name); ?>" maxlength="200" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div></div></div>
         <div class="row">
                 <div class="col-sm-6">
                <div class="form-group">
                        <label class="control-label">Slug<small>(If you leave it blank, it will be generated automatically.)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" placeholder="Slug" value="<?php echo html_escape($download_category->slug); ?>">
                    </div></div>
                  <div class="col-sm-6">
                <div class="form-group">
                        <label class="control-label">Description (Meta Tag)</label>
                        <input type="text" class="form-control" name="description" placeholder="" value="<?php echo html_escape($download_category->description); ?>">
                    </div></div></div>
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
