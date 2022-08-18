<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("pages"); ?>Feedback List</h3>
        </div>
        <!-- <div class="right">
            <a href="<?php echo admin_url(); ?>add-page" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_page"); ?>
            </a>
        </div> -->
    </div><!-- /.box-header -->


    <div class="box-body">
        <div class="row">
            <!-- include message block -->
            <div class="col-sm-12">
                <?php $this->load->view('admin/includes/_messages'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable" id="cs_datatable_lang" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('id'); ?></th>
                            <th><?php echo trans('name'); ?></th>
                            <th><?php echo trans('phone'); ?></th>
                            <th><?php echo trans('email'); ?></th>
                            <th><?php echo trans('content'); ?></th>
                            <th><?php echo trans('date_added'); ?></th>
                            
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($pages as $item): ?>
                                <tr>
                                    <td><?php echo html_escape($item->id); ?></td>
                                    <td><?php echo html_escape($item->name); ?></td>
                                    <td><?php echo html_escape($item->phone_no); ?></td>
                                    <td><?php echo html_escape($item->email); ?></td>
                                    <td><?php echo html_escape($item->text); ?></td>
                                   
                        
                                  <td><?php echo formatted_date($item->updated_at); ?></td> 
                                   <!--  <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                    type="button"
                                                    data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <a href="<?php echo admin_url(); ?>update-page/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="delete_item('page_controller/delete_page_post','<?php echo $item->id; ?>','<?php echo trans("confirm_page"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> -->
                                </tr>
                            
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>
