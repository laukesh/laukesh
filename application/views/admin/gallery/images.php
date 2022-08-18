<?php 
$page_no = (!empty($this->input->get("page")))?$this->input->get("page"):1;
$per_page = (!empty($this->input->get("show")))?$this->input->get("show"):15;
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans("images"); ?></h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>gallery-add-image" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_image"); ?>
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
                        <?php $this->load->view('admin/gallery/_filter'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('s.no'); ?></th>
                            <th><?php echo trans('image'); ?></th>
                            <th><?php echo trans('title'); ?></th>
                            <th><?php echo trans('language'); ?></th>
                            <th><?php echo trans('category'); ?></th>
                            <th><?php echo trans('date'); ?></th>
                            <th><?php echo trans('last_update'); ?></th>
                            <th class="max-width-120"><?php echo trans('options'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = ($page_no*$per_page)-$per_page+1;
                        foreach ($images as $item): ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td>
                                    <div style="position: relative">
                                    <?php if(!empty($item->path_small)){?>
                                        <img src="<?php echo base_url() . html_escape($item->path_small); ?>" alt="" class="img-responsive" style="max-width: 140px; max-height: 140px;">
                                          <?php }else{?>
                                        <img src="<?php echo base_url();?>assets-front/images/no-image.png" alt=""
                                             class="thumbnail img-responsive" style="max-width: 140px; max-height: 140px;">
                                        <?php
                                         }
                                         ?> 
                                        <?php if ($item->is_album_cover == 1): ?>
                                            <label class="label label-warning" style="position: absolute;left: 0;top: 0;"><?php echo trans("album_cover"); ?></label>
                                        <?php endif; ?>
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
                                    $album = get_gallery_album($item->album_id);
                                    if (!empty($album)) {
                                        echo html_escape($album->name);
                                    }
                                    ?>
                                </td>
                             
                                <?php  $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); 
                                 
                                ?>
                                <td class="nowrap"><?php echo $dateTime->format("d/m/y  H:i A"); ?></td>
                                 <?php  $dateTime2 = new DateTime($item->updated_at, new DateTimeZone('Asia/Kolkata')); 
                                 
                                ?>
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
                                                     <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check(this.id, 0)" ><i class="fa fa-edit option-icon"></i>
                                                     Unpublish</a>
                                                </li>
                                                <?php else: ?>
                                                <li>
                                                    <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check(this.id, 1)" ><i class="fa fa-edit option-icon"></i>Publish</a>
                                                </li>
                                             <?php endif; ?>

                                              <?php if($item->is_album_cover == 0): ?> 
                                                <li>
                                                     <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_home_page(this.id, 1)" ><i class="fa fa-edit option-icon"></i>
                                                     Show on Home page</a>
                                                </li>
                                                <?php else: ?>
                                                <li>
                                                    <a href="#" id="<?php echo html_escape($item->id); ?>" onclick="check_home_page(this.id, 0)" ><i class="fa fa-edit option-icon"></i>Remove on Home page</a>
                                                </li>
                                             <?php endif; ?>

                                            <li>
                                                <a href="<?php echo admin_url(); ?>update-gallery-image/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('gallery_controller/delete_gallery_image_post','<?php echo $item->id; ?>','<?php echo trans("confirm_image"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
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
 <script type="text/javascript">
function check(id, status){
        var data = {
        "post_id": id,
        "status": status
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_image_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.status);
              if(returnedData.status == 1 || returnedData.status == 0){
               location.reload();
              }else{

              }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  


function check_home_page(id, is_album_cover){
        var data = {
        "post_id": id,
        "is_album_cover": is_album_cover
        };

        //alert(data.is_album_cover);


        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_image_ajax2",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.is_album_cover);
             // if(returnedData.is_album_cover == 1 || returnedData.is_album_cover == 0){
               location.reload();
              //}else{

             // }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

} 
</script>