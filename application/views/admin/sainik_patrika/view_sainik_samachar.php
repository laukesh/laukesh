<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
$day = array('1'=>'1-15','16-');
$month = array('1'=>'Janaury','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');

$count_days = cal_days_in_month(CAL_GREGORIAN, $page->month, $page->year); 
$doc_type = array('1'=>'PDF');

?>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php //echo trans("add_pratika"); ?>Update Sainik Samachar</h3>
                    </div>
                    <div class="right">
                        <a href="<?php echo admin_url(); ?>view-sainik-samachar" class="btn btn-success btn-add-new">
                            <i class="fa fa-bars"></i>
                            <?php //echo trans("add_pratika"); ?>View Sainik Samachar
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <!-- form start -->
                <?php echo form_open_multipart('SainikPratika_controller/update_page_post'); ?>
                <input type="hidden" name="id" value="<?php echo html_escape($page->id); ?>">
                <div class="box-body">
                    <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
                  <div class="row">
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label><?php echo trans("language"); ?></label>
                        <select name="lang_id" class="form-control" disabled="disabled" onchange="get_menu_links_by_lang(this.value);" style="max-width: 600px;">
                            <?php foreach ($this->languages as $language): ?>
                                <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    </div>  

                     <!-- <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control" onchange="get_menu_links_by_lang(this.value);" style="max-width: 600px;">
                            <option value="">---Select Category---</option>
                            <?php //foreach ($categories as $item): ?>
                    <option value="<?php //echo $item->id; ?>"<?php //echo ($page->category_id == $item->id) ? 'selected' : ''; ?>><?php //echo $item->name; ?></option>
                            <?php //endforeach; ?>
                        </select>
                    </div> -->
                   <div class="col-sm-2">
                    <div class="form-group">
                            <label class=""><?php //echo trans("Year"); ?>Year
                        </label>    
                        <select type="text" disabled="disabled" required="required" class="form-control-date form-control" name="year"  id="year" placeholder="<?php echo trans("year"); ?>"> 
                        <option selected value=''>--Select Year--</option>
                        <?php
                         $start = 1990;
                         $end = date("Y");
                        for( $year = $start; $year <=$end; $year++)
                        {?>
                         <option value="<?php echo $year; ?>" <?php echo ($page->year == $year) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                        <?php
                        }
                        ?>   
                        </select> 
                        </div>
                    </div>

                       <div class="col-sm-2">          
                        <label class=""><?php echo trans("month"); ?> </label>
                        <select type="text" disabled="disabled" required="required" class="form-control-date form-control" onchange="val()" name="month"  id="month" placeholder="<?php echo trans("month"); ?>">
                        <option selected value=''>--Select Month--</option>
                      <?php 
                       foreach($month as $key => $value)
                       {?>
                        <option value="<?php echo $key; ?>" <?php echo ($page->month == $key) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                        <?php
                        } 
                        ?>
                        </select>  </div>

                       <div class="col-sm-2">     
                        <label class=""><?php //echo trans('date'); ?>Edition</label>
                        <select type="text" disabled="disabled" required="required" class="form-control-date form-control" name="end-date"  id="end-date" placeholder="<?php echo trans("date"); ?>">
                        <option>----Select date---</option>
                        <?php 
                       foreach($day as $key => $value)
                       {?>
                        <option value="<?php echo $key; ?>"<?php 
                        
                        echo ($page->biweek_no == $key) ? 'selected' : ''; ?>>
                         <?php if($key == 1){
                         echo $value;
                         }else{

                             echo $value.''.$count_days;
                         } ?>
                            
                        </option>
                        <?php
                        } 
                        ?>
                     </select> 
                 </div>
                    <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label"><?php //echo trans('document_type'); ?>Document Type</label>
                    <select type="text" disabled="disabled" class="form-control" name="document_type"  id="document_type" placeholder="<?php echo trans("document_type"); ?>">
                            <option selected value=''>--Select Type--</option>
                     <?php 
                   foreach($doc_type as $key => $value)
                   {?>
                    <option value="<?php echo $key; ?>"<?php echo ($page->document_type == $key) ? 'selected' : ''; ?>><?php echo $value;?>
                        
                    </option>
                    <?php
                    } 
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                        <label class="control-label"><?php //echo trans('title'); ?>Volume</label>
                        <input type="text" disabled="disabled" class="form-control"
                           name="volume" id="volume" placeholder="Volume"
                           value="<?php echo $page->volume; ?>">
                       </div>
            </div>           
        </div>

              <div class="form-group">
                        <label class="control-label"><?php echo trans('title'); ?></label>
                        <input  disabled="disabled" type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo $page->title; ?>">
                       </div>
          <div class="form-group">
                     <label class="control-label">Keywords (Meta Tag)</label>
                     <input disabled="disabled" type="text" class="form-control" name="keywords" id="Keywords" placeholder="Keywords (Meta Tag)" value="<?php echo $page->keywords; ?>" required="">
                </div>
    
         
            <div class="form-group">
            <label  class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="description" disabled="disabled" placeholder="Summary &amp; Description (Meta Tag)" required=""><?php echo $page->description; ?></textarea>
            </div>

              <!--   <div class="form-group"> -->
                   <!--  <div id="main_editor_image" hidden> -->
                       <!--  <label class="control-label"><?php echo trans('image'); ?></label>
                        <div class="col-sm-12">
                            <div class="row">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    <?php echo trans('select_image'); ?>
                                    <input type="file" id="Multifileupload" name="files[]" size="40" accept=".png, .jpg, .jpeg, .gif" multiple="multiple">
                                </a>
                                <span>(<?php echo trans("select_multiple_images"); ?>)</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div id="MultidvPreview">
                                    <img src="<?php echo base_url();?>">
                                </div>
                            </div>
                        </div> -->
                 <!-- </div> -->
               <!--  </div> -->
                    <div class="form-group">
                        <!-- <div id="main_editor_pdf" hidden> -->
                              <label for="file-upload">Sainik Samachar file <small>(Sainik Samachar PDF Files Only)</small></label>
                        <input disabled="disabled" type="file" id="file-upload" accept="application/pdf" name ="file" >
                               <div id="file-upload-filename"></div>

                                </div>
                                <a href="<?php echo base_url().$page->document_path;?>" target="_blank"><small>View Sainik Samachar File</small></a>
                           <!--  </div> -->

                     
                   </div>
                </div>

            </div>

             
                <!-- /.box-body -->
               <!--  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('add_pratika'); ?>Update Sainik Samachar</button>
                </div> -->
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>

<?php $this->load->view('admin/file-manager/_load_file_manager', ['load_images' => true, 'load_files' => false, 'load_videos' => false, 'load_audios' => false]); ?>
<script type="text/javascript">
   
function show_month(){
        var month = document.getElementById("month").value;
        return month;
}
function show_year(){
        var year = document.getElementById("year").value;
          // alert(year);
        return year;
}
    month.onchange=show_month;
    year.onchange=show_year;

 $('#month').change(function(){
    var year = show_year();
    var month = $(this).val();
        //alert(month);

                if( (0 == year % 4) && (0 != year % 100) || (0 == year % 400) )
                {
                    if(month == 2)
                    {
                        var till = 29;
                    }  
                }
                else if(month == 2)
                {
                    var till = 28;
                }
                else if(month == 1 || month == 3 || month == 5 || month == 7 || month == 9 || month == 11 )
                {
                    var till = 31;
                }
                else if(month == 4 || month == 6 || month == 8 || month == 10 || month == 12)
                {
                    var till = 30;
                }
                var end_date = "";
                end_date += "<option>----select date---</option>";
                end_date += "<option value='1'> 1-15 </option>";
                end_date += "<option value='2'> 16-"+ till +"</option>";
                document.getElementById("end-date").innerHTML = end_date ;
});
var input = document.getElementById( 'file-upload' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
  // use fileName however fits your app best, i.e. add it into a div
  //infoArea.textContent = 'File name: ' + fileName;
}
document.getElementById('document_type').addEventListener('change', function() {
    var document_type = this.value;
    if(document_type == 1)
    {
        var div = document.getElementById("main_editor_pdf");
        var div2 = document.getElementById("main_editor_image");
        div.style.display = "block";
        div2.style.display = "none";
    }
    else if(document_type == 2)
    {
        var div = document.getElementById("main_editor_image");
        var div2 = document.getElementById("main_editor_pdf");
        div.style.display = "block";
        div2.style.display = "none";
    }
    else {
        var div = document.getElementById("main_editor_image");
        var div2 = document.getElementById("main_editor_pdf");
        div.style.display = "none";
        div2.style.display = "none";

    }

    });


</script>