 <script type="text/javascript">
function check(id, setofcover){
        var data = {
        "post_id": id,
        "set_of_cover": setofcover
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
              if(returnedData.set_of_cover == 1 || returnedData.set_of_cover == 0){
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

 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans("list_sainik_samachar"); ?></h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-sainik-samachar" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_sainik_samachar"); ?>
            </a>
        </div>
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
                    <table class="table table-bordered table-striped dataTable" id="" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('s.no'); ?></th>
                            <th><?php echo trans('title'); ?></th>
                            <th><?php echo trans('language'); ?></th>
                            <th><?php echo trans('year'); ?></th>
                            <th><?php echo trans('month'); ?></th>
                            <th><?php echo trans('edition'); ?></th>
                            <th><?php echo trans('volume'); ?></th>
                             
                            <!-- <th>Categ/ory</th> -->
                          <!--   <th><?php //echo trans('visibility'); ?></th> -->
                           <!--  <th><?php echo trans('page_type'); ?></th> -->
                            <th><?php   //echo trans('Publishe Date'); ?>Published Date</th>
                            <th class="max-width-120"><?php //echo trans('options'); ?>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         
                        <?php $i = 1;
                        foreach ($pages as $item): ?>
                            <?php //if ($item->page_type != "link"): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                
                                    <td><?php echo html_escape($item->title); ?></td>
                                    <td><?php 
                                            $lang = get_language($item->lang_id);
                                            if (!empty($lang)) {
                                                echo html_escape($lang->name);
                                            }
                                        ?>
                                    </td>
                                     <td><?php echo html_escape($item->year); ?></td>
                                     <td><?php echo html_escape($item->month); ?></td>
                                     <td><?php echo html_escape($item->biweek_no); ?></td>
                                     <td><?php echo html_escape($item->volume); ?></td>
                                    <!-- <td>
                                    <?php
                                    //$category = get_sainikpatrika_category($item->category_id);
                                    //if (!empty($category)) {
                                        //echo html_escape($category->name);
                                    //}
                                    ?>
                                </td>-->
                                   
                                   <!--  <td>
                                        <?php if ($item->visibility == 1): ?>
                                            <label class="label label-success"><i class="fa fa-eye"></i></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                        <?php endif; ?>
                                    </td> -->
                                    <?php  $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); ?>
                                    <td><?php echo $dateTime->format("d/m/y  H:i A"); ?></td>
                                    <td width="132px">
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                    type="button"
                                                    data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <?php if ($item->visibility == 1): ?> 
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
                                                    <a href="<?php echo admin_url(); ?>update-sainik-samachar/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo admin_url(); ?>view-sainik-samachar/<?php echo html_escape($item->id); ?>"><i class="fa fa-eye option-icon"></i><?php echo trans('view'); ?></a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" onclick="delete_item('SainikPratika_controller/delete_sainik_patrika','<?php echo $item->id; ?>','<?php echo trans("confirm_sainik_samachar"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                </li>
                                            </ul>
                                      
                                      
                                        <?php if ($item->visibility == 1): ?>
                                            <label class="label label-success"><i class="fa fa-eye"></i></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                        <?php endif; ?>
                                    </td>
                                       </div> 
                                </tr>
                            <?php //endif; ?>
                        <?php 
                        $i++;
                         endforeach; 
                         ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="col-sm-12 text-right">
                <?php  echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>


