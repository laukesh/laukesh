<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$permission = array(1=>'Read', 2=>'Read/Write');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('change_password'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>users" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("users"); ?>
                    </a>
                </div>
            </div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/change_password_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">

           <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
           <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?php echo trans("password"); ?></label>
                    <input type="password" name="password" minlength="6" maxlength="16" id="txtPassword" class="form-control txtPassword" placeholder="<?php echo trans("password"); ?>" value="" required>
                     <span id="text_caps" class="pull-left">WARNING! Caps lock is ON.</span>
                   
                </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">
                    <label><?php echo trans("confirm_password"); ?>
                    </label>
                     <span id="responseDiv" style="color:red;"></span>
                    <input type="password" minlength="6" maxlength="16" name="confirm_password" class="form-control txtPassword" id="confirm_password" placeholder="<?php echo trans("confirm_password"); ?>" value="" required>
                    <span id="toggle_pwd" class="fa fa-fw field_icon fa-eye"></span>
                     <span id="text_caps_confirm_password" class="pull-left">WARNING! Caps lock is ON.</span>
                </div>   
                       
            </div>
            
        

            <!-- /.box-body -->
            <div class="col-sm-2">
            <div class="box-footer">
                <button type="submit" id="submitButton" onclick="return encrypt_pass()" class="btn btn-primary pull-right"><?php echo trans('update'); ?></button>
            </div>
              </div>
              </div>
        </div>
        </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
    </div>
</div>
       <script type="text/javascript">
        $(function () {
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $(".txtPassword").attr("type", type);
            });
        });



// $(document).ready(function (){
// $("#submitButton").click(function (e) {
// e.preventDefault();
// var matched,
// var password = $("#txtPassword").val(),
// var confirm = $("#confirmPassword").val();
// matched = (password == confirm) ? true : false;
// if(matched == 1) { 
// //Submit line commented out for example.  In production, remove the //
// //$("#passwordForm").submit(); 

// //Shows success message and prevents submission.  In production, comment out the next 2 lines.
// $("#responseDiv").html("Passwords Match");
// return false;
// }
// else { 
// $("#responseDiv").html("Passwords don't match..."); 
// return false;
// }
// });
// });

</script>
