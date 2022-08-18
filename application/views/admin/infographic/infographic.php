<?php 
$page_no = (!empty($this->input->get("page")))?$this->input->get("page"):1;
$per_page = (!empty($this->input->get("show")))?$this->input->get("show"):15;
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("audio"); ?>List of Infographic</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-infographic" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_infographics"); ?>
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
                        <?php $this->load->view('admin/infographic/_filter'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('id'); ?>
                         </th>
                           <!--  <th><?php //echo trans('image'); ?></th> -->
                            <th><?php echo trans('title'); ?></th>
                            <th><?php echo trans('category'); ?></th>                   
                            <th><?php echo trans('language'); ?></th>
                            <th><?php echo trans('date'); ?></th>
                            <th><?php echo trans('last_update'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = ($page_no*$per_page)-$per_page+1;
                        foreach($infographic as $item): ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                               <!--  <td>
                                    <div style="position: relative">
                                        <img src="<?php echo base_url() . html_escape($item->path_big); ?>" alt="" class="img-responsive" style="max-width: 140px; max-height: 140px;">
                                         <?php if ($item->is_album_cover == 1): ?>
                                            <label class="label label-warning" style="position: absolute;left: 0;top: 0;"><?php echo trans("album_cover"); ?></label>
                                        <?php endif; ?>
                                    </div>

                                </td> -->
                                <td><?php echo html_escape($item->title); ?>
                                    <?php if ($item->is_album_cover == 1): ?>
                                            <label class="label label-warning"><?php echo trans("album_cover"); ?></label>
                                        <?php endif; ?>
                                </td>
                                <td>         
                                <?php
                                $infographic = get_infographic_category($item->infographic_category);
                                if (!empty($infographic)) {
                                echo html_escape($infographic->name);
                                }
                                ?>
                                </td>
                           
                                <td>
                                    <?php
                                    $lang = get_language($item->lang_id);
                                    if (!empty($lang)) {
                                        echo html_escape($lang->name);
                                    }
                                    ?>
                                </td>
                               
                                <?php
                                $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); 
                                $dateTime2 = new DateTime($item->updated_at, new DateTimeZone('Asia/Kolkata')); ?>
                                <td class="nowrap"><?php echo $dateTime->format("d/m/y  H:i A"); ?></td>
                                <td class="nowrap"><?php echo $dateTime2->format("d/m/y  H:i A"); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                             <?php if ($item->status == 1): ?> 
                                                <li>
                                                     <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_infographic(this.id, 0)" ><i class="fa fa-edit option-icon"></i>
                                                     Unpublish</a>
                                                </li>
                                                <?php else: ?>
                                                <li>
                                                    <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_infographic(this.id, 1)" ><i class="fa fa-edit option-icon"></i>Publish</a>
                                                </li>
                                             <?php endif; ?>

                                             <?php if($item->is_album_cover == 0): ?> 
                                                <li>
                                                     <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_home_page_infographic(this.id, 1)" ><i class="fa fa-edit option-icon"></i>
                                                     Show on Home page</a>
                                                </li>
                                                <?php else: ?>
                                                <li>
                                                    <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_home_page_infographic(this.id, 0)" ><i class="fa fa-edit option-icon"></i>Remove on Home page</a>
                                                </li>
                                             <?php endif; ?>
                                           
                                            <li>
                                                <a href="<?php echo admin_url(); ?>update-infographic/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('infographic_controller/delete_infographic_post','<?php echo $item->id; ?>','<?php echo trans("confirm_image"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                          <?php if ($item->status == 1): ?>
                                            <label class="label label-success"><i class="fa fa-eye"></i></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                        <?php endif; ?>
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
