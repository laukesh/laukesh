<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <script type="text/javascript">
function check(id, status){
      //alert(status);
      //alert(id);
        var data = {
        "post_id": id,
        "status": status
        };
       data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_media_ajax",
        data:data,
        success : function(data){
               //alert(data);
             var returnedData = JSON.parse(data);
              if(returnedData.status == 1 || returnedData.status == 0){
               location.reload();
              }else{

              //$('#show').html('');
              }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  
</script>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("audio"); ?>Media Invite</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-media-invite" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php //echo trans("add_media"); ?>Add Media Invite
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
                    <table class="table table-bordered table-striped dataTable" id="cs_datatable_lang" role="grid"
                           aria-describedby="example1_info">
                        <?php $this->load->view('admin/media/_filter'); ?>
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('s.no'); ?>
                         </th>
                            <th><?php echo trans('title'); ?></th>
                            <th><?php //echo trans('title'); ?>Venue Of Event</th>
                            <th><?php echo trans('language'); ?></th>
                            <th><?php //echo trans('audio-album'); ?>Name of PRO</th>
                            <th><?php //echo trans('category'); ?>Mobile No</th>
                            <th><?php //echo trans('category'); ?>Date & Time of Event</th>
                            <th><?php //echo trans('category'); ?>Reporting Time</th>
                            <th><?php //echo trans('Created On'); ?>Created On</th>
                            <th class="max-width-120"><?php echo trans('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = 1;
                        foreach ($images as $item): ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td><?php echo html_escape($item->title); ?></td>
                                <td><?php echo html_escape($item->venue_event); ?></td>
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
                                    
                                       //  $regional_pro_name = regional_pro_name($item->regional_pro_id);
                                       // if (!empty($regional_pro_name)) {
                                       //  echo $regional_pro_name[0]->firstname.' '.$regional_pro_name[0]->lastname;
                                       //  }
                                     if($item->name){
                                        echo $item->name;
                                     }else{

                             $regional_pro_name = regional_pro_name($item->regional_pro_id);
                                       
                               echo $regional_pro_name[0]->firstname.' '.$regional_pro_name[0]->lastname;
                                   

                                     }

                                    ?>
                                
                                </td>
                                <td>
                                    <?php
                                    if (!empty($item->mobile)){
                                        echo html_escape($item->mobile);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($item->date_of_event)){
                                        echo html_escape(strip_tags($item->date_of_event));
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($item->reporting_time)) {
                                        echo html_escape(strip_tags($item->reporting_time));
                                    }
                                    ?>
                                </td>
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
                                            <li>
                                                <a href="<?php echo admin_url(); ?>update-media/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('media_controller/delete_media_post','<?php echo $item->id; ?>','<?php echo trans("confirm_image"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                        <?php if ($item->status == 1): ?>
                                            <label class="label label-success"><i class="fa fa-eye"></i></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                        <?php endif; ?>
                                    
                                </td>
                                </div>
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
