<?php 
defined('BASEPATH') or exit('No direct script access allowed'); 
$pro = $this -> db
           -> select('id')
           -> where('id', $this->auth_user->pro_category_id)
           -> where('is_active', 1)
           -> limit(1)
           -> get('tbl_pru_category')
           ->result_array();

$page_no = (!empty($this->input->get("page")))?$this->input->get("page"):1;
$per_page = (!empty($this->input->get("show")))?$this->input->get("show"):15;
//die;
?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans("withdraw_request"); ?></h3>
        </div>
    <?php 
     if($this->auth_user->role == 'pro_admin' && $this->auth_user->pro_category_id == $pro['0']['id'] && $this->auth_user->permission == 2)
                {
                ?>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-press-release" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_press_release"); ?>
            </a>
        </div>
        <?php 
        }else if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin' || $this->auth_user->role == 'regional office editor'){?>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-press-release" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_press_release"); ?>
            </a>
        </div>
        <?php
        }
        ?>
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
                    <table class="table table-bordered table-striped datatable" id="example">

                        <?php 
                         //if($this->uri->segment(2)  == 'view-schedule-publish-list'){
                        
                        $this->load->view('admin/press-realease/_filter_withdraw_request.php');
                        // }else{
                            //$this->load->view('admin/press-realease/_filter');
                        // } ?>
                        <thead>
                        <tr role="row">
                            <th class="td_text_center"><?php echo trans('s.no'); ?></th>
                            <th class="td_text_center"><?php echo trans('title'); ?></th>
                            <th class="td_text_center"><?php echo trans('language'); ?></th>
                            <th class="td_text_center"><?php echo trans('pro_category'); ?></th>
                            <th class="td_text_center"><?php //echo trans('submitted_on'); ?>Created On</th>
                            <th class="td_text_center"><?php echo trans('created_by'); ?></th>
                            <th class="td_text_center"><?php echo trans('status'); ?></th>

                            <th class="max-width-120"><?php //echo trans('options'); ?>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = ($page_no*$per_page)-$per_page+1;
                      //echo  count($view_press_release);
                        foreach ($view_press_release as $item): ?>

                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td><?php echo html_escape($item->press_release_title); ?></td>
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
                                    $category = get_pro_category($item->pro_category);
                                    //echo '<pre>';print_r($category);
                                    if (!empty($category)) {
                                        echo html_escape($category[0]->name);
                                    }
                                    ?>
                                </td>

                                <?php  $dateTime = new DateTime($item->created_at, new DateTimeZone('Asia/Kolkata')); 
                                 
                                ?>
                                <td class="nowrap"><?php echo $dateTime->format("d/m/Y  H:i A"); ?></td>
                                <td>
                                <?php
                                    $user = get_user_name($item->created_by);
                                    if (!empty($user)) {?>
                                       <a href="<?php echo admin_url();?>view-press-release-list" title="<?php echo html_escape($user[0]->email);?>"><?php echo html_escape(ucfirst(strtolower($user[0]->username)));?></a>
                                    <?php
                                    }
                                  ?>
                                </td>
                                <td class="nowrap">
                                    <?php if($item->status == 1){?>
                                    <label class="label label-warning">Drafted</label>
                                <?php 
                                 }else if($item->status == 2){
                                    ?>
                                 <label class="label label-primary">Pending For Review</label>
                                <?php
                                 }else if($item->status == 3){?>
                                     <label class="label label-success">Published</label>
                                <?php
                                 }else if($item->status == 4){
                                 ?>
                                 <label class="label label-primary">Scheduled for Publish</label>
                                 <?php
                                 }else if($item->status == 5){
                                 ?>
                                 <label class="label label-danger">Deleted</label>
                                 <?php
                                 }
                                 else if($item->status == 6){
                                 ?>
                                 <label class="label label-info">Rejected</label>
                                 <?php
                                 }else if($item->status == 9){
                                 ?>
                                 <label class="label label-danger">UnPublished</label>
                                 <?php
                                 }
                                 ?> 
                                 <?php 
                                    if ($item->status_withdraw == 1 && $item->status !=7): ?>
                                        <small class="text-danger">(<?php echo trans("requested_withdraw"); ?>)</small>
                                    <?php else: ?>
                                        <!-- <small class="text-danger">(<?php //echo trans("unconfirmed"); ?>)</small> -->
                                    <?php endif; ?>
                                </td>
                                
                           
                               <td>
                   
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $item->press_release_id;?>" title="Press Relasae History">Audit History</button>
           
                                <?php 
                                  if($this->auth_user->role == 'admin' || $this->auth_user->role == 'hq admin'){?>
                                  <a href="<?php echo admin_url(); ?>view-press-realease-withdraw-request/<?php echo html_escape($item->id); ?>" title="Approve Withdraw request"><i class="fa fa-edit option-icon"></i></a> 
                                 <?php
                                  }
                                 ?>
                     <div id="message<?php echo $item->press_release_id;?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Press Release Withdraw Request Audit History</h4>
                </div>
                <?php if(!empty($item->press_release_id)){?>
                <div class="modal-body">
                <?php 
                $sql = "SELECT * FROM `press_release_history_log` WHERE press_release_id = $item->press_release_id and status != 1 ORDER by id desc";
                $query = $this->db->query($sql);
                $data = $query->result();
                ?>

                <table class="table table-bordered">
                <thead>
                <tr>
                <th><?php echo trans('s.no').$item->press_release_id;?></th>
                <th>Updated By</th>
                <th>Updated On</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
             <?php 
            $i=1;
            foreach($data as $value){?>
            <tr>
            <td><?php echo $i;?></td>
            <td><?php


            $user = get_user_name($value->updated_by);
            if (!empty($user))
            { 
            echo html_escape(ucfirst(strtolower($user[0]->username)));
            }
            ?>
            </td>
            <td><?php echo $value->updated_at;?></td>
            <td><?php if($value->status == 2  && $value->press_release_type == 2){
                ?>
             <label class="label label-primary">Update Request</label>
            <?php
             }else if($value->status == 2  && $value->press_release_type == 1){?>
             <label class="label label-primary">Pending For Review</label>
             <?php
              }else if($value->status == 3){?>
                 <label class="label label-success">Published</label>
            <?php
             }else if($value->status == 4){
             ?>
             <label class="label label-primary">Scheduled for Publish</label>
             <?php
             }else if($value->status == 5){
             ?>
             <label class="label label-danger">Deleted</label>
             <?php
             }
             else if($value->status == 6){
             ?>
             <label class="label label-info">Rejected</label>
             <?php
             }else if($value->status == 7){
             ?>
             <label class="label label-danger"><?php echo trans("withdraw"); ?></label>
             <?php
             }
             ?> 
             <?php 
                if ($value->status_withdraw == 1 && $value->status !=7): ?>
                    <small class="text-danger">(<?php echo trans("requested_withdraw"); ?>)</small>
                <?php else: ?>
                    <!-- <small class="text-danger">(<?php //echo trans("unconfirmed"); ?>)</small> -->
                <?php endif; ?>
            </td>
            <td>
                <?php   if($this->auth_user->role != 'pro_admin'){?>
                <!-- <a href="<?php echo admin_url(); ?>update-press-release-request/<?php echo html_escape($value->id); ?>"><i class="fa fa-edit option-icon"></i></a> -->
                <?php } ?> 

                <a  target="_blank" href="<?php echo admin_url(); ?>view_press_release_withdraw_request_display/<?php echo html_escape($value->id); ?>" title="View Press Release"><i class="fa fa-eye option-icon"></i></a>
            </td>
            </tr>
            <?php 
            $i++;
            }
            ?>
            </tbody>
            </table>
            </div>
            <?php }?>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

            </div>
        </div>
                         </td>

                                
                            </tr>

                        <?php 
                        $i++;
                    endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (empty($view_press_release)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?php  echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function del_check(id, status){
   // alert(status);
        var data = {
        "post_id": id,
        "del_id": status
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_press_release_action_ajax",
        data:data,
        success : function(data){
             alert(data);
             //var returnedData = JSON.parse(data);
              //if(returnedData.set_of_cover == 1 || returnedData.set_of_cover == 0){
               location.reload();
              //}else{

              //$('#show').html('');
              //}
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  
</script>

