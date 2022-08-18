<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php //echo trans('update_category'); ?>update_circular</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('circular_controller/update_circular_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($category->id); ?>">

            <div class="box-body">
            <div class="row">
                <?php $this->load->view('admin/includes/_messages'); ?>
                <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_circular_category_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($category->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("category"); ?></label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>" <?php echo ($category->category_id == $album->id) ? 'selected' : ''; ?>><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-sm-4">
                   <div class="form-group">
                    <label><?php echo trans('circular_number'); ?></label>
                    <input type="text" class="form-control" name="circular_number" placeholder="<?php echo trans('category_name'); ?>"
                           value="<?php echo html_escape($category->circular_number); ?>">
                </div></div>
            </div>
                <div class="form-group">
                    <label><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($category->title); ?>">
                </div>
                <div class="form-group">
                    <label><?php echo trans('slug'); ?></label>
                    <input type="text" class="form-control" name="slug" placeholder="<?php echo trans('slug'); ?>"
                           value="<?php echo html_escape($category->slug); ?>">
                </div>
             <div class="form-group">
                    <label><?php echo trans('description'); ?></label>
                    <input type="text" class="form-control" name="description" placeholder="<?php echo trans('description'); ?>"
                           value="<?php echo html_escape($category->description); ?>">
                </div>
                <div class="form-group">
                        <!-- <div id="main_editor_pdf" hidden> -->
                              <label for="file-upload">Circular file <small>(Circular PDF Files)</small></label>
                        <input type="file" id="file-upload" accept=".doc, .docx, .ppt, .pdf" name ="file" >
                               <div id="file-upload-filename"></div>

                                </div>
                                <a href="<?php echo base_url().$category->path;?>" target="_blank"><small>View Circular File</small></a>
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
