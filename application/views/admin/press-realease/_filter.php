<?php 
$status = array('Pending for Review','Published','Scheduled for Publish','Withdrawl Request','Unpublished');

defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open(admin_url() . 'view-press-release-list', ['method' => 'GET']); ?>

        <div class="item-table-filter" style="width: 80px; min-width: 80px;">
            <label><?php echo trans("show"); ?></label>
            <select name="show" class="form-control">
                <option value="15" <?php echo ($this->input->get('show', true) == '15') ? 'selected' : ''; ?>>15</option>
                <option value="30" <?php echo ($this->input->get('show', true) == '30') ? 'selected' : ''; ?>>30</option>
                <option value="60" <?php echo ($this->input->get('show', true) == '60') ? 'selected' : ''; ?>>60</option>
                <option value="100" <?php echo ($this->input->get('show', true) == '100') ? 'selected' : ''; ?>>100</option>
            </select>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("language"); ?></label>
            <select name="lang_id" class="form-control" onchange="get_pro_cate_by_lang(this.value);">
                <option value=""><?php echo trans("all"); ?></option>
                <?php foreach ($this->languages as $language): ?>
                    <option value="<?php echo $language->id; ?>" <?php echo ($this->input->get('lang_id', true) == $language->id) ? 'selected' : ''; ?>><?php echo html_escape($language->name); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php if($this->auth_user->role == "admin" || $this->auth_user->role == "hq_admin" )
        {?>

        <div class="item-table-filter">
            <label><?php //echo trans('album'); ?>Category</label>
            <select id="pro_cate" name="pro_cate" class="form-control">
                <option value=""><?php echo trans("all"); ?></option>
                <?php if (!empty($this->input->get('lang_id', true))) {
                $pro_category = $this->category_model->get_pro_category_by_lang($this->input->get('lang_id', true));
                } else {
                    $pro_category = $this->category_model->get_pro_category_by_lang($this->selected_lang->id);
                } ?>
                <?php
                if (!empty($pro_category)):
                    foreach ($pro_category as $item): ?>
                        <option value="<?php echo $item->id; ?>" <?php echo ($this->input->get('pro_cate', true) == $item->id) ? 'selected' : ''; ?>>
                            <?php echo html_escape($item->name); ?>
                        </option>
                    <?php endforeach;
                endif; ?>
            </select>
        </div>
    <?php }?>

         <div class="item-table-filter">
            <label><?php echo trans('status'); ?></label>
            <select id="status" name="status" class="form-control">
                <option value=""><?php echo trans("all"); ?></option>
                <?php 
                if (!empty($status)):
                    $i = 2;
                    foreach ($status as $item): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($this->input->get('status', true) == $i) ? 'selected' : ''; ?>>
                            <?php echo html_escape($item); ?>
                        </option>
                    <?php 
                    $i++;
                   endforeach;
                endif; ?>
            </select>
        </div>


        <div class="item-table-filter item-table-filter-long">
            <label><?php echo trans("search"); ?></label>
            <input name="q" class="form-control" placeholder="<?php echo trans("search") ?>" type="search" value="<?php echo html_escape($this->input->get('q', true)); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
        </div>


        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
            <label style="display: block">&nbsp;</label>
            <button type="submit" class="btn bg-purple"><?php echo trans("filter"); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>