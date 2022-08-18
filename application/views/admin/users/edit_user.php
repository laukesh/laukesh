<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$permission = array(1=>'Read', 2=>'Read/Write');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('update_profile'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>users" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("users"); ?>
                    </a>
                </div>
            </div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/edit_user_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">

           <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("username"); ?></label>
                    <input type="text" name="username" class="form-control auth-form-input" placeholder="<?php echo trans("username"); ?>" value="<?php echo $user->username; ?>" required>
                </div>
            </div>

           <!--  <div class="col-sm-4">
                <div class="form-group">
                    <label><?php //echo trans("form_password"); ?></label>
                    <input type="password" name="password" class="form-control auth-form-input" placeholder="" value="<?php echo $user->password; ?>" required>
                </div>
            </div> -->

            <div class="col-sm-4">
                 <div class="form-group">
                    <label><?php echo trans("first_name"); ?></label>
                    <input type="text" name="firstname" class="form-control auth-form-input" placeholder="<?php echo trans("first_name"); ?>" value="<?php echo $user->firstname; ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                 <div class="form-group">
                    <label><?php echo trans("last_name"); ?></label>
                    <input type="text" name="lastname" class="form-control auth-form-input" placeholder="<?php echo trans("last_name"); ?>" value="<?php echo $user->lastname; ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                 <div class="form-group">
                    <label><?php echo trans("designation"); ?></label>
                    <input type="text" name="designation" class="form-control auth-form-input" placeholder="<?php echo trans("designation"); ?>" value="<?php echo $user->designation; ?>" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("email"); ?></label>
                    <input type="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email"); ?>" value="<?php echo $user->email; ?>" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("phone_number"); ?></label>
                    <input type="number" name="phone" class="form-control auth-form-input" placeholder="<?php echo trans("phone_number"); ?>" value="<?php echo $user->phone; ?>" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("role"); ?></label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role->role; ?>"<?php echo ($user->role == $role->role) ? 'selected' : ''; ?>><?php echo $role->role_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <!-- <div id="hidden_div" style="display: none;"> -->
                    <div id="hidden_div">
                        <label><?php echo trans("pro_categories"); ?></label>
                        <select name="pro_category_id" class="form-control">
                            <option value="">Select Pro Category</option>
                             <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"<?php echo ($user->pro_category_id ==  $item->id) ? ' selected="selected"' : '';?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">  
                        <label><?php echo trans("permission"); ?></label>
                        <select name="permission" class="form-control">                             
                        <option value="">Select Permission</option>  
                        <?php foreach ($permission as $key => $value){ 
                            //echo '<pre>'; print_r($value);
                            ?>                       
                            <option value="<?php echo $key; ?>"<?php echo ($user->permission==  $key) ? ' selected="selected"' : '';?>><?php echo $value; ?></option>     
                        <?php
                        }
                        ?>                     
                        </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('update'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
    </div>
</div>