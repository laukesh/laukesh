<?php defined('BASEPATH') or exit('No direct script access allowed'); 
$url =  $_SERVER['QUERY_STRING'];
if($url){
$var = explode('&',$url);
$var2 = $var[1];
$cat2 = $var[2];
$var3 = explode('lang_id=',$var2);
$cat3 = explode('category_id=',$cat2);
$lang_url = $var3[1];
$cat_url = $cat3[1];
}else{
    $lang_url = '';
    $cat_url  = '';
}
//echo '<pre>';print_r($albums);
?>
<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open(admin_url() . 'view-download', ['method' => 'GET']); ?>

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
             <select name="lang_id" class="form-control" onchange="get_download_category_by_lang(this.value)">
                         
                        <?php foreach ($this->languages as $language): ?>
                            <option value="<?php echo $language->id; ?>"<?php if ($lang_url == $language->id) { ?> selected="selected"<?php } ?> ><?php echo $language->name; ?></option>
                        <?php endforeach; ?>
                    </select>
        </div>

        <div class="item-table-filter">
            <label><?php //echo trans('album'); ?>Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                       <option><?php echo trans('select');?></option>
                        <?php foreach ($albums as $album): ?>
                            <option value="<?php echo $album->id; ?>" <?php if ($cat_url == $album->id) { ?>selected="selected"<?php } ?>><?php echo $album->name; ?></option>
                        <?php endforeach; ?>
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


<script type="text/javascript">
 function get_download_category_by_lang(val){
    alert(val);
    var data = {
        "lang_id": val
        };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "download_controller/download_category_by_lang",
        data: data,
        success: function (response){
            //alert(response);
            $('#category_id').children('option:not(:first)').remove();
            $("#category_id").append(response);
        }
    });

}

</script>