<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
     <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("video"); ?>View Document</h3>
        </div>
        <div class="right">
            <!-- <a href="<?php //echo admin_url(); ?>add-video" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php //echo trans("add_video"); ?>
            </a> -->
        </div>
    </div>

    <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php $this->load->view('admin/includes/_messages'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable">
                                <?php $this->load->view('admin/document/_filter'); ?>
                                <thead>
                                <tr role="row">
                                    <th width="20"><?php echo trans('id'); ?></th>
                                     <th><?php echo trans('language'); ?></th>
                                    <th><?php echo trans('title'); ?></th>
                                    <th><?php //echo trans('album'); ?>Category</th>
                                    <th><?php echo trans('slug'); ?></th>
                                    <th><?php echo trans('description'); ?></th>
                                    <th><?php //echo trans('description'); ?>Pdf</th>
                                   
                                    <th class="max-width-120"><?php echo trans('options'); ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($categories as $item): ?>
                                    <tr>
                                        <td><?php echo html_escape($item->id); ?></td>
                                         <td>
                                            <?php
                                            $lang = get_language($item->lang_id);
                                            if (!empty($lang)) {
                                                echo html_escape($lang->name);
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo html_escape($item->title); ?></td>
                                        <td>
                                            <?php $album = get_document_category($item->category_id);
                                            if (!empty($album)) {
                                                echo html_escape($album->name);
                                            } ?>
                                        </td>
                                       <td><?php echo html_escape($item->slug); ?></td>
                                       <td><?php echo html_escape($item->description); ?></td>
                                       <td><a href="<?php echo base_url().$item->path;?>" target="_blank"><small><img src="<?php echo base_url('assets/img/pdf.png')?>" width="70" height="60"></small></a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                        type="button"
                                                        data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <li>
                                                        <a href="<?php echo admin_url(); ?>update-document-manage/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="delete_item('document_controller/delete_document_category_post','<?php echo $item->id; ?>','<?php echo trans("confirm_category"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.box-body -->
 

   <!--  </div> --> 
</div>

