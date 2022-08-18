<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 
$page_no = (!empty($this->input->get("page")))?$this->input->get("page"):1;
$per_page = (!empty($this->input->get("show")))?$this->input->get("show"):15;

?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h3 class="box-title"><?php //echo trans('pro_categories'); ?>Notifications</h3>
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
                            <table class="table table-bordered table-striped datatable" id="cs_datatable_lang" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?php echo trans('s.no'); ?></th>
                                    <th><?php //echo trans('category_name'); ?>Notification Details</th>
                                    <th><?php //echo trans('category_name'); ?>Status&nbsp; &nbsp;
                                        <!-- <a href="#" onclick="read_all(this.id, 1)">All Read / </a> -->
                                    <a href="<?php echo admin_url().'view-notification'; ?>">View Notification</a>
                                    </th>
                                  
                                </tr>
                                </thead>
                                <tbody>

                                <?php 

                                  $i = ($page_no*$per_page)-$per_page+1;
                                foreach ($notification as $item): ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo html_escape($item->item_title); ?></td>
                                        <td>
                                         <?php if($item->read_status == 1){
                                             ?>
                                            <a href="#" id="<?php echo html_escape($item->id); ?>" class="btn btn-success" onclick="check(this.id, 0)" >Read</a> 
                                        <?php }else{?>
                                          <a href="#" id="<?php echo html_escape($item->id); ?>" class="btn btn-danger" onclick="check(this.id, 1)" >Unread</a>
                                        <?php } ?>
                                        </td>
                                       <!--  <td>          
                                        <a href="<?php echo admin_url(); ?>update-press-release-category/<?php echo html_escape($item->id); ?>"><i class="fa fa-eye"></i></a>
                                                
                                        </td> -->
                                    </tr>

                                <?php 
                                $i++;
                            endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                         <div class="col-sm-12 text-right">
                        <?php  echo $this->pagination->create_links(); ?>
                    </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
<script type="text/javascript">
function check(id, read_status){
     
        var data = {
        "post_id": id,
        "read_status": read_status
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "notification/post_action_notification_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
              if(returnedData.read_status == 1 || returnedData.read_status == 0){
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

function read_all(read_status){
       //alert(read_status);
        var data = {
        "set_of_cover": read_status
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "notification/post_action_notification_all_read_ajax",
        data:data,
        success : function(data){
              //alert(data);
             //var returnedData = JSON.parse(data);
              //if(returnedData.read_status == 1 || returnedData.read_status == 0){
               location.reload();
        //}else{

              //$('#show').html('');
             // }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  
</script>