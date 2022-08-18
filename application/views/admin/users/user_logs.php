<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php //echo trans("users"); ?>Users Information</h3>
        </div>
        <div class="right">
            <a href="<?php echo admin_url(); ?>user-logs" class="btn btn-success btn-add-new">
                <i class="fa fa-view"></i>
                <?php echo 'Users Information'; ?>
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
                    <?php $this->load->view('admin/users/_filter2'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th><?php echo trans('s_no'); ?></th>
                            <th><?php echo trans('user_id'); ?></th>
                            <th><?php echo trans('ip_address'); ?></th>
                            <th><?php echo trans('application_device'); ?></th>
                            <th><?php echo trans('browser_info'); ?></th>
                            <th><?php echo trans('action'); ?></th>
                            <th><?php echo trans('date_time'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php 
                        $i = 1; 
                        foreach ($users_logs as $user):
                         ?>
                            <tr>
                                <td><?php echo html_escape($i); ?></td>
                                <td><?php echo html_escape($user->user_id); ?></td>
                                <td><?php echo html_escape($user->ip); ?></td>
                                <td><?php echo html_escape($user->application_medium);?></td>
                                <td><?php echo html_escape($user->browser_info);?></td>
                                <td><?php if ($user->action == 'login'): ?>
                                <button type="button" class="btn btn-success">Login</button>
                                    <?php elseif ($user->action == 'Fail'): ?>
                                <button type="button" class="btn btn-warning">Failed</button>
                                  <?php else: ?>
                                <button type="button" class="btn btn-danger">Logout</button>
                                    <?php endif; ?></td>
                                <td><?php echo html_escape($user->datetime); ?></td>
                               
                            </tr>
                        <?php 
                        $i++; 
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

<