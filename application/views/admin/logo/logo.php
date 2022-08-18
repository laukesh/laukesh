<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("audio"); ?>Logo Gallery Image</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-logo" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php //echo trans("add_media"); ?>Add Logo Gallery Image
            </a>
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
                    <table class="table table-bordered table-striped">
                        <?php $this->load->view('admin/logo/_filter'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('id'); ?>
                         </th>
                            <th>Image</th>
                            <th><?php echo trans('title'); ?></th>
                            <th>Url</th>
                            <th><?php echo trans('language'); ?></th>

                            <th><?php echo trans('date'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = 1;
                        foreach($logo_gallery as $item): ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td>
                                    <div style="position: relative">
                                        <img src="<?php echo base_url() . html_escape($item->path_small); ?>" alt="" class="img-responsive" style="max-width: 70px; max-height: 70px;">
                                    </div>
                                </td>
                                <td><?php echo html_escape($item->title); ?></td>
                                <td><?php echo html_escape($item->url); ?></td>
                                <td>
                                    <?php
                                    $lang = get_language($item->lang_id);
                                    if (!empty($lang)) {
                                        echo html_escape($lang->name);
                                    }
                                    ?>
                                </td>
                               <!--  <td><?php //echo html_escape($item->content); ?></td> -->
                                <?php
                                $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); ?>
                                <td class="nowrap"><?php echo $dateTime->format("d/m/y  H:i A"); ?></td>
                                <td>
                                <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button> 
                                        <ul class="dropdown-menu options-dropdown"> 
                                           
                                             <li>
                                                <a href="<?php echo admin_url(); ?>update-logo/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                             </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('logo_controller/delete_logo_gallery','<?php echo $item->id; ?>','<?php echo trans("confirm_image"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                          </ul>
                                        
                                     </div> 
                                </td>
                            </tr>

                        <?php 
                        $i++;
                        endforeach; 
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>
