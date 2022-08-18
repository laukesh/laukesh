<?php  
$page_no = (!empty($this->input->get("page")))?$this->input->get("page"):1;
$per_page = (!empty($this->input->get("show")))?$this->input->get("show"):15;

defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("users"); ?>List of User</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>add-user" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>
                <?php echo trans("add_user"); ?>
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
                    <?php $this->load->view('admin/users/_filter'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?php echo trans('s.no'); ?></th>
                            <th><?php echo trans('username'); ?></th>
                            <th><?php echo trans('email'); ?></th>
                            <th><?php echo trans('role'); ?></th>
                            <th><?php echo trans('pro_name'); ?></th>
                            <th><?php echo trans('permission'); ?></th>
                            <th><?php echo trans('status'); ?></th>
                            <th><?php echo trans('date'); ?></th>
                            <th class="max-width-120"><?php //echo trans('options'); ?>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i = ($page_no*$per_page)-$per_page+1;
                        foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td>
                                    <a href="<?php echo generate_profile_url($user->slug); ?>" target="_blank" class="link-black">
                                        <?php echo html_escape($user->username); ?>
                                    </a>
                                    &nbsp;
                                    <?php if ($user->reward_system_enabled == 1): ?>
                                        <label class="label label-info"><?php echo trans("reward_system"); ?></label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo html_escape($user->email);
                                    if ($user->email_status == 1): ?>
                                        <small class="text-success"><!-- (<?php //echo trans("confirmed"); ?>) --></small>
                                    <?php else: ?>
                                        <small class="text-danger"><!-- (<?php //echo trans("unconfirmed"); ?>) --></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php $role = $this->auth_model->get_role_by_key($user->role);
                                    if (!empty($role)):
                                        if ($user->role == "pro_admin"):?>
                                            <label class="label bg-olive"><?php echo $role->role_name; ?></label>
                                        <?php elseif ($user->role == "hq admin"): ?>
                                            <label class="label label-warning"><?php echo $role->role_name; ?></label>
                                        <?php elseif ($user->role == "admin"): ?>
                                        <label class="label label-primary"><?php echo $role->role_name; ?></label>
                                        <?php elseif ($user->role == "sainik_samachar"): ?>
                                            <label class="label label-default"><?php echo $role->role_name; ?></label>
                                        <?php 
                                        elseif ($user->role == "photo_division"): ?>
                                            <label class="label label-info"><?php echo $role->role_name; ?></label>
                                        <?php 
                                        elseif ($user->role == "broadcasting"): ?>
                                            <label class="label label-default"><?php echo $role->role_name; ?></label>
                                        <?php 
                                        elseif ($user->role == "social_media_admin"): ?>
                                            <label class="label label-danger"><?php echo $role->role_name; ?></label>
                                        <?php endif;
                                    endif; ?>
                                </td>
                                <td>
                                <?php $pro_name = $this->auth_model->get_pro_by_key($user->pro_category_id);
                                   
                                   if(!empty($pro_name)):?>
                                     <label class="label label-primary"><?php echo $pro_name->name;?></label>
                                   <?php else: ?>
                                <label class="label label-default">N.A.</label>
                                <?php
                                endif;
                                ?>
                                </td>
                                 <td><?php if ($user->permission == 1): ?>
                                        <?php echo trans('read'); ?>
                                    <?php else: ?>
                                        <?php echo trans('read/write'); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user->status == 1): ?>
                                        <label class="label label-success"><?php echo trans('active'); ?></label>
                                    <?php else: ?>
                                        <label class="label label-danger"><?php echo trans('dactive'); ?></label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                <?php  $dateTime = new DateTime($user->created_at, new DateTimeZone('Asia/Kolkata'));  
                                      echo $dateTime->format("d/m/y  H:i A"); ?>
                                          
                                      </td>
                                <td>
                                    <!-- form post options -->
                                    <?php echo form_open('admin_controller/user_options_post'); ?>
                                    <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu options-dropdown">
                                                
                                            <li>
                                                <?php if ($user->email_status != 1): ?>
                                                    <a href="javascript:void(0)" onclick="confirm_user_email(<?php echo $user->id; ?>);"><i class="fa fa-check option-icon"></i><?php echo trans('confirm_user_email'); ?></a>
                                                <?php endif; ?>
                                            </li>
                                            <?php if ($user->status == "1"): ?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="ban_user('<?php echo $user->id; ?>','<?php echo trans("confirm_ban"); ?>', 'ban');"><i class="fa fa-stop-circle option-icon"></i><?php //echo trans('dactive_user'); ?>Deactivate User</a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="ban_user('<?php echo $user->id; ?>', '<?php echo trans("confirm_remove_ban"); ?>', 'remove_ban');"><i class="fa fa-stop-circle option-icon"></i><?php //echo trans('active_user'); ?>Activate User</a>
                                                </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="<?php echo admin_url(); ?>edit-new-password/<?php echo html_escape($user->id); ?>"><i class="fa fa-edit option-icon"></i><?php //echo trans('edit'); ?>Change Password</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url(); ?>edit-user/<?php echo html_escape($user->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_user_post','<?php echo $user->id; ?>','<?php echo trans("confirm_user"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <?php echo form_close(); ?><!-- form end -->
                                </td>
                            </tr>
                        <?php $i++; 
                          endforeach; 
                          ?>
                        </tbody>
                    </table>
                    <?php if (empty($users)): ?>
                        <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('change_user_role'); ?></h4>
            </div>
            <?php echo form_open('admin_controller/change_user_role_post'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">

                        <input type="hidden" name="user_id" id="modal_user_id" value="">

                        <div class="col-sm-3">
                            <input type="radio" name="role" value="admin" id="role_admin" class="square-purple" required>&nbsp;&nbsp;
                            <?php $role = $this->auth_model->get_role_by_key('admin'); ?>
                            <label for="role_admin" class="option-label cursor-pointer"><?php echo !empty($role) ? $role->role_name : ''; ?></label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="role" value="moderator" id="role_moderator" class="square-purple" required>&nbsp;&nbsp;
                            <?php $role = $this->auth_model->get_role_by_key('hq admin'); ?>
                            <label for="role_moderator" class="option-label cursor-pointer"><?php echo !empty($role) ? $role->role_name : ''; ?></label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="role" value="author" id="role_editor" class="square-purple" required>&nbsp;&nbsp;
                            <?php $role = $this->auth_model->get_role_by_key('pro_admin'); ?>
                            <label for="role_editor" class="option-label cursor-pointer"><?php echo !empty($role) ? $role->role_name : ''; ?></label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="role" value="user" id="role_user" class="square-purple" required>&nbsp;&nbsp;
                            <?php $role = $this->auth_model->get_role_by_key('regional office editor'); ?>
                            <label for="role_user" class="option-label cursor-pointer"><?php echo !empty($role) ? $role->role_name : ''; ?></label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><?php echo trans('save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close'); ?></button>
            </div>

            <?php echo form_close(); ?><!-- form end -->
        </div>

    </div>
</div>
