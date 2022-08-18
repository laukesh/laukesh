<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("video"); ?>List of Video</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-video" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_video"); ?>
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
                        <?php $this->load->view('admin/video/_filter'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('s.no'); ?>
                         </th>
                            <th><?php //echo trans('video'); ?>video</th>
                            <th><?php echo trans('title'); ?></th>
                            <th><?php echo trans('language'); ?></th>
                            <th><?php //echo trans('video-album'); ?>Category</th>
                            <th><?php //echo trans('category'); ?>Sub Category</th>
                            <th><?php echo trans('date'); ?></th>
                            <th class="max-width-120"><?php echo trans('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = 1;
                        foreach ($images as $item): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <div style="position: relative">
                                      
                                       <?php if(!empty($item->path_video))
                                       {
                                       ?>
                                        <video width="220" height="160" controls>
                                          <source src="<?php echo base_url() . html_escape($item->path_video); ?>" type="audio/mpeg">
                                        </video>
                                        <?php 
                                        }else{
                                        ?>
                                        <img src="<?php echo base_url() .'/uploads/video/sorry_no_videos.png';?>" width="220" height="160">
                                       <?php 
                                       }
                                       ?>
                                        <?php //if ($item->is_album_cover): ?>
                                            <!-- <label class="label label-success" style="position: absolute;left: 0;top: 0;"><?php //echo trans("album_cover"); ?></label> -->
                                        <?php //endif; ?>
                                    </div>
                                </td>
                                <td><?php echo html_escape($item->title); ?></td>
                                <td>
                                    <?php
                                    $lang = get_language($item->lang_id);
                                    if (!empty($lang)) {
                                        echo html_escape($lang->name);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $album = get_video_album($item->cate_id);
                                    if (!empty($album)) {
                                        echo html_escape($album->name);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $category = get_video_category($item->cate_id);
                                    if (!empty($category)) {
                                        echo html_escape($category->name);
                                    }
                                    ?>
                                </td>
                                <?php 
                                $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); 
                                 
                                ?>
                                <td class="nowrap"><?php echo $dateTime->format("d/m/y  H:i A"); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                            <!-- <?php //if ($item->is_album_cover == 0): ?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="set_as_album_cover('<?php //echo $item->id; ?>');"><i class="fa fa-check option-icon"></i><?php //echo trans('set_as_album_cover'); ?></a>
                                                </li>
                                            <?php //endif; ?> -->
                                            <li>
                                                <a href="<?php echo admin_url(); ?>update-video-img/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('video_controller/delete_video_image_post','<?php echo $item->id; ?>','<?php echo trans("confirm_image"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php 
                        $i++;
                    endforeach; ?>
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
