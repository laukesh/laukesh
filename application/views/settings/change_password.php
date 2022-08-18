<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo generate_url('settings'); ?>"><?php echo trans("settings"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>

                <h1 class="page-title"><?php echo trans("settings"); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="row-custom">
                    <!-- load profile nav -->
                    <?php $this->load->view("settings/_setting_tabs"); ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-9">
                <div class="row-custom">
                    <div class="profile-tab-content">
                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <?php echo form_open("change-password-post", ['id' => 'form_validate']); ?>
                        
                            <div class="form-group">
                                <label><?php echo trans("form_old_password"); ?></label>
             <input type="password" name="old_password" minlength="6" maxlength="16" id="old_password" class="form-control form-input" value="<?php echo old("old_password"); ?>" placeholder="<?php echo trans("form_old_password"); ?>" required>
                            </div>
                           <!--  <input type="hidden" name="old_password_exists" value="1">
                        <?php// else: ?>
                            <input type="hidden" name="old_password_exists" value="0"> -->
                        <?php// endif; ?>
                        <div class="form-group">
                            <label><?php echo trans("form_password"); ?></label>
                            <input type="password" name="password" minlength="6" maxlength="16" id="password_change" class="form-control form-input" value="<?php echo old("password"); ?>" placeholder="<?php echo trans("form_password"); ?>" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo trans("form_confirm_password"); ?></label>
                            <input type="password" minlength="6" maxlength="16" name="password_confirm" id="password_confirm" class="form-control form-input" value="<?php echo old("password_confirm"); ?>" placeholder="<?php echo trans("form_confirm_password"); ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="return encrypt_change_password()"><?php echo trans("change_password") ?></button>
                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

