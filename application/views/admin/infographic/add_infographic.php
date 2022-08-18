<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans("add_infographics"); ?></h3>
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
            <?php echo form_open_multipart('infographic_controller/add_infographic_post'); ?>

            <div class="box-body">
                 <?php $this->load->view('admin/includes/_messages_form'); ?>
                 <div class="row">
                <!-- include message block -->
                <div class="col-sm-2">
                <div class="form-group">
                    <label><?php echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control" onchange="get_infographic_by_lang(this.value);">
                        <option>All</option>
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
               </div>

               <div class="col-sm-2">
                <div class="form-group">
                    <label><?php  echo trans("category"); ?></label>
                    <select name="infographic_category" id="infographic_category" class="form-control" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($infographic as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
               </div>
               <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control"
                           name="title" id="edValue" onKeyPress="edValueKeyPress()" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
            </div>


            <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label">Brief Description Of Infographics</label>
                <div id="main_editor">
                <div class="row">
                    
                </div>
                <textarea class="tinyMCE form-control" name="content" value="" id="content" aria-hidden="true"></textarea></div>
              </div>
             </div>
    
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">Keywords (Meta Tag)</label>
                    <input id="tags_1" width="auto" type="text" name="keywords"  class="form-control emp" value="" />
                              <small>(<?php echo trans('muti_keywords'); ?>)</small>
                </div>
             </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">Summary &amp; Description (Meta Tag)</label>
                    <textarea class="form-control text-area" name="summary_desc" placeholder="Summary &amp; Description (Meta Tag)" ></textarea>
                 </div>
             </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('infographics'); ?></label>
                    <div class="col-sm-12">
                        <div class="row">
                            
                                <input type="file" id="Multifileupload" name="files" size="40" accept=".png, .jpg, .jpeg, .gif"  required>
                           
                            You can browse one image (png,jpg,jpeg,gif)
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

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('add_image'); ?>Add Infographic</button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>