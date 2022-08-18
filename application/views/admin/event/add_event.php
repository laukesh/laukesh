<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php //echo trans("add_image"); ?>Add Event</h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>event" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php //echo trans("images"); ?>Events
                    </a>
                </div>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('event_controller/add_event_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <span id="dateval"></span>
                <?php $this->load->view('admin/includes/_messages_form'); ?>
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_infographic_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              
                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="edValue" onKeyPress="edValueKeyPress()" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>


            <div class="form-group">
                <label class="control-label">Slug
                </label>
                <input type="text" class="form-control" name="title_slug" id="lblValue" placeholder="Slug" value="" required>
            </div>

            <div class="form-group">
                <label class="control-label">Address
                </label>
                <input type="text" class="form-control" name="address" id="address" placeholder="address" value="" required>
            </div>
            
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start" placeholder="" value="" required>
            </div>

            <div class="form-group">
                <label class="control-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end" placeholder="" value="" required>
            </div>

            <div class="form-group">
                <label class="control-label">Keywords (Meta Tag)</label>
                <input type="text" class="form-control" name="keywords" placeholder="Keywords (Meta Tag)" value="" required>
            </div>

            <div class="form-group">
                <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)" required></textarea>
             </div>

            <div class="form-group">
                <label class="control-label">Content</label>
                <div id="main_editor">
                <div class="row">
                    
                </div>
                <textarea class="tinyMCE form-control" name="content" value="" id="content" aria-hidden="true"></textarea></div>
            </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?php echo trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="files[]" size="40" accept=".png, .jpg, .jpeg, .gif" multiple="multiple"  required>
                            </a>
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
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_image'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>