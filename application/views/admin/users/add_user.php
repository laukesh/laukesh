<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans("add_user"); ?></h3>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>users" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans("users"); ?>
                    </a>
                </div>
            </div>

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/add_user_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans("username"); ?></label>
                    <input type="text" name="username" class="form-control" placeholder="<?php echo trans("username"); ?>" value="" required>
                </div>
            </div>

            <div class="col-md-6">
                            <!--  <div class="form-group">
                    <label><?php echo trans("form_password"); ?></label>
                    <input type="password" name="password" class="form-control" placeholder="<?php echo trans("form_password"); ?>" value="<?php echo old("password"); ?>" required>
                </div> -->
            <div class="form-group">
                <label><?php echo trans("form_password"); ?></label>
                <input type="password" name="password"  class="form-control" id="txtPassword" 
                placeholder="<?php echo trans("form_password"); ?>" value="<?php echo old("password"); ?>">
                
                <span onclick="showHide()"  id="showpassword"class="input-group-addon glyphicon glyphicon-eye-open ipass_ico" style=""></span>
                  <span id="text_caps" class="pull-left">WARNING! Caps lock is ON.</span>
                
            </div>
          </div>
            <div class="col-sm-6">
                 <div class="form-group">
                    <label><?php echo trans("first_name"); ?></label>
                    <input type="text" name="firstname" class="form-control auth-form-input" placeholder="<?php echo trans("first_name"); ?>" value="<?php echo old("first_name"); ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                 <div class="form-group">
                    <label><?php echo trans("last_name"); ?></label>
                    <input type="text" name="lastname" class="form-control auth-form-input" placeholder="<?php echo trans("last_name"); ?>" value="<?php echo old("last_name"); ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                 <div class="form-group">
                    <label><?php echo trans("designation"); ?></label>
                    <input type="text" name="designation" class="form-control auth-form-input" placeholder="<?php echo trans("designation"); ?>" value="<?php echo old("designation"); ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans("email"); ?></label>
                    <input type="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email"); ?>" value="<?php echo old("email"); ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans("phone_number"); ?></label>
                    <input type="number" name="phone" class="form-control auth-form-input" placeholder="<?php echo trans("phone_number"); ?>" value="<?php echo old("phone_number"); ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo trans("role"); ?></label>
                    <select name="role" id="role" onchange="check()" class="form-control" required="required">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role->role; ?>"><?php echo $role->role_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <!-- <div id="hidden_div" style="display: none;"> -->
                        <div id="hidden_div">
                        <label><?php echo trans("pro_categories"); ?></label>
                        <select name="pro_category_id"  disabled id="servername" class="form-control">
                            <option value="">Select Pro Category</option>
                             <?php foreach ($pru_categories as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                 <div class="form-group">  
                        <label><?php echo trans("permission"); ?></label>
                        <select name="permission" class="form-control" required="required">
                            <option value="">Select Permission</option>
                            <option value="1">Read</option>
                            <option value="2">Read/Write</option>
                        </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit"  onclick="return encrypt()" class="btn btn-primary pull-right"><?php echo trans('add_user'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>


<!-- <script type="text/javascript">
    document.getElementById('role').addEventListener('change', function() {
    var role = this.value;
     if(role === 'pro_admin'){
        document.getElementById('hidden_div').style.display = "block";
     }
      
    });


</script> -->
<Script>
    
function check(){      
  if(document.getElementById('role').value == 'admin')
    document.getElementById('servername').disabled=true;
  else if(document.getElementById('role').value == 'hq admin')
    document.getElementById('servername').disabled=true;
  else 
    document.getElementById('servername').disabled=false;
  }
</Script>

<script type="text/javascript">

function show() {
  var p = document.getElementById('txtPassword');
  p.setAttribute('type', 'text');
}

function hide() {
  var p = document.getElementById('txtPassword');
  p.setAttribute('type', 'password');
}

function showHide() {
   // alert('a');

      var ids = document.getElementById('showpassword');
      if(ids.classList.contains('glyphicon-eye-open')){
          ids.classList.remove("glyphicon-eye-open");
          var p = document.getElementById('txtPassword');
        p.setAttribute('type', 'text');
          ids.classList.add("glyphicon-eye-close");
      }
      else{
         ids.classList.remove("glyphicon-eye-close");
          ids.classList.add("glyphicon-eye-open");
           var p = document.getElementById('txtPassword');
            p.setAttribute('type', 'password');
      }

  var pwShown = 0;

  document.getElementById("eye").addEventListener("click", function() {
    if (pwShown == 0) {
      pwShown = 1;
      show();
    } else {
      pwShow = 0;
      hide();
    }
  }, false);
}
</script>

<script type="text/javascript">
    function encrypt(){
    var pass       = jQuery('#txtPassword').val()+"."+'<?php echo $random_number; ?>';
    var DataKey    = CryptoJS.enc.Utf8.parse("01234567890123456789012345678901");
    var DataVector = CryptoJS.enc.Utf8.parse("1234567890123412");
    var encrypted  = CryptoJS.AES.encrypt(pass, DataKey, { iv: DataVector });
    jQuery('#txtPassword').val(encrypted);
   return true;
   }
</script>