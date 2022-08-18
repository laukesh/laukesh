<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('update_image'); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('event_controller/update_event_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($event->id); ?>">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_event_by_lang(this.value);">
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($event->lang_id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($event->title); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                 <div class="form-group">
                <label class="control-label">Slug
                </label>
                <input type="text" class="form-control" name="title_slug" placeholder="Slug" value="<?php echo html_escape($event->title_slug); ?>" required>
            </div>

               <div class="form-group">
                <label class="control-label">Address
                </label>
                <input type="text" class="form-control" name="address" placeholder="address" value="<?php echo html_escape($event->address); ?>" required>
            </div>

            <div class="form-group">
                <label class="control-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start" placeholder="" value="<?php echo html_escape($event->start_date); ?>" required>
            </div>

            <div class="form-group">
                <label class="control-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end" placeholder="" value="<?php echo html_escape($event->end_date); ?>" required>
            </div>

            <div class="form-group">
                <label class="control-label">Keywords (Meta Tag)</label>
                <input type="text" class="form-control" name="keywords" placeholder="Keywords (Meta Tag)" value="<?php echo html_escape($event->keywords); ?>" required>
            </div>

            <div class="form-group">
                <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)" required><?php echo html_escape($event->summary_desc); ?></textarea>
             </div>

            <div class="form-group">
                <label class="control-label">Content</label>
                <div id="main_editor">
                <div class="row">
                    
                </div>
                <textarea class="tinyMCE form-control" name="content"  id="content" aria-hidden="true"><?php echo html_escape($event->content); ?></textarea>
            </div>
            </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?> </label>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo base_url() . html_escape($event->path_big); ?>" alt=""
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