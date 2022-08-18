<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
$month = array('1'=>'Janaury','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>


        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans("add_sainik_samachar"); ?></h3>
                    </div>
                    <div class="right">
                        <a href="<?php echo admin_url(); ?>view-sainik-samachar" class="btn btn-success btn-add-new">
                            <i class="fa fa-bars"></i>
                            <?php //echo trans("add_pratika"); ?>View Sainik Samachar
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <!-- form start -->
                <?php echo form_open_multipart('SainikPratika_controller/SainikPratika_add_page_post'); ?>
                <div class="box-body">
                    <!-- include message block -->
                    <?php $this->load->view('admin/includes/_messages'); ?>
             <div class="row">
                <div class="col-sm-2">
                        <label><?php echo trans("language"); ?></label>
                        <select name="lang_id" class="form-control" onchange="get_menu_links_by_lang(this.value);" style="max-width: 600px;">
                            <?php foreach ($this->languages as $language): ?>

                                <option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                       </div>

                    <div class="col-sm-2">   
                        <label class="">Year</label>
                        <select type="text" class="form-control-date form-control" name="year"  id="year" placeholder="<?php echo trans("year"); ?>">    
                        </select> 
                      </div>

                        <div class="col-sm-2">          
                        <label class="">Month</label>
                        <select type="text" class="form-control-date form-control" onchange="val()" name="month"  id="month" placeholder="<?php echo trans("month"); ?>" required="required">
                         <option selected value='999'>Select Month</option>
                      <?php 
                       foreach($month as $key=> $value)
                       {
                        ?>
                         <option value="<?php echo $key;?>"><?php echo $value;?></option>
                       
                        <?php
                        }
                        
                        ?>
                        </select></div>

                        <div class="col-sm-2">     
                        <label class="">Edition</label>
                        <select type="text" class="form-control-date form-control" name="end-date"  id="end-date" placeholder="<?php echo trans("date"); ?>" required="required">
                        <option> Select Edition</option>
                        <option value="1"> 1-15 </option>
                        <option value = "2">16-30</option>
                     </select> </div>
    

                    <div class="col-md-2">
                        <label class="control-label">Document Type</label>
                        <select type="text" class="form-control" name="document_type"  id="document_type" placeholder="<?php echo trans("document_type"); ?>" required="required">
                               <!--  <option selected value=''>--Select Type--</option> -->
                                <option  value='1'>PDF</option>
                                <!-- <option value='2'>Image</option> -->
                        </select>
                    </div>

                    <div class="col-md-2">  
                <div class="form-group">
                        <label class="control-label"><?php //echo trans('title'); ?>Volume</label>
                        <input type="text" class="form-control"
                           name="volume" id="volume" placeholder="Volume"
                           value="<?php echo old('volume'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                       </div>
                </div>
                   </div>
                <div class="col-md-">  
                <div class="form-group">
                        <label class="control-label"><?php echo trans('title'); ?></label>
                        <input type="text" class="form-control"
                           name="title" id="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
                       </div>
                </div>
         
                <div class="form-group">
                     <label class="control-label">Keywords (Meta Tag)</label>
                     <input type="text" class="form-control" name="keywords" id="tags_1" placeholder="Keywords (Meta Tag)" value="" required="">
                </div>
    
         
            <div class="form-group">
            <label class="control-label">Summary &amp; Description (Meta Tag)</label>
            <textarea class="form-control text-area" name="description" placeholder="Summary &amp; Description (Meta Tag)" required=""></textarea>
            </div>
 

           <div class="form-group"> 
                    <!-- <div id="main_editor_image" hidden> -->
                    <label class="control-label"><?php echo trans('sainik_samachar_cover_Image'); ?><small>(Upload jpg,png,jpeg Files Only)</small></label>
                    <div class="col-sm-12">
                        <div class="row">
                                <input type="file" id="Multifileupload" name="sainik_patrika_image" size="40" accept=".png, .jpg, .jpeg">
                            <span>You can browse image (png,jpg,jpeg)</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="MultidvPreview">
                            </div>
                        </div>
                    </div>
                  </div> 
   
                    <div class="form-group">
                        <label class="control-label"><?php echo trans('sainik_samachar_pdf_file'); ?></label>
                              <label for="file-upload">Sainik Samachar Upload file <small>(Upload PDF Files Only)</small></label>
                        <input type="file" id="file-upload" accept="application/pdf" name ="file" >
                               <div id="file-upload-filename"></div>
                        </div>  
                   </div>
                </div>

            </div>

             
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?php //echo trans('add_pratika'); ?>Add Sainik Samachar</button>
                </div>
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>


<?php $this->load->view('admin/file-manager/_load_file_manager', ['load_images' => true, 'load_files' => false, 'load_videos' => false, 'load_audios' => false]); ?>
<script type="text/javascript">
    var start = 1980;
    var end = new Date().getFullYear();
    var options = "";
    options = "<option selected value=''>Select Year</option>";
    for(var year = end; year >= start; year--){
      options += "<option>"+ year +"</option>";
    }
    document.getElementById("year").innerHTML = options;



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
$('#year').change(function(){
document.getElementById("month").value = 999;
document.getElementById("end-date").value = 999;
});


 $('#month').change(function(){
    var year = show_year();
    var month = $(this).val();
    //alert(month);

        if( (0 == year % 4) || ((0 == year % 100) && (0 == year % 400)) )
        {
          //alert('Hello sir');
            if(month == 2)
            {
            var till = 29;
            }
            else if(month == 1 || month == 3 || month == 5  || month == 7 || month == 8  || month == 10 || month == 12)
            {

            var till = 31;
            }
            else if(month == 4 || month == 6 || month == 9 || month == 11)
            {
            var till = 30;
            }
        } 
        else
            {
                 if(month == 2){
                    var till = 28;
                }
                else if(month == 1 || month == 3 || month == 5  || month == 7 || month == 8  || month == 10 || month == 12)
                {

                var till = 31;
                }
                else if(month == 4 || month == 6 || month == 9 || month == 11)
                {
                var till = 30;
                }
            }

            
                var end_date = "";
                end_date += "<option selected value='999'>Select Edition</option>";
                end_date += "<option value='1'> 1-15 </option>";
                end_date += "<option value='2'> 16-"+ till +"</option>";
                document.getElementById("end-date").innerHTML = end_date;
        
});
       var input    = document.getElementById( 'file-upload' );
       var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = 'File name: ' + fileName;
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

<script type="text/javascript">
 // $().ready(function() {
 //  $('#file-upload').change(function() {

 //     var fileInput = $(this);
 //     var fullPath = this.value;

 //     var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
 //    var filename = fullPath.substring(startIndex);
 //    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
 //        filename = filename.substring(1);
 //    }
 //     const count =filename.split(".").length; 
 //     const ext = filename.split(".").pop(); 
       
 //    if(count>2){
 //        alert('Please upload a valid file with single dot & extension');
 //         $('#file-upload-filename') == '';
 //         $('#file-upload-filename').hide();
 //        return false;
 //    }

 //    if($.inArray(ext, ['pdf','doc','docx']) == -1) {
 //              alert('Please upload only pdf,doc,docx format files.');
 //            //  $('#file-upload-filename') == '';
 //              //$('#file-upload-filename').attr('value', '');
 //              $('#file-upload-filename').remove();

 //              var $el = $('#file-upload-filename');
 //              $el.wrap('<form>').closest('form').get(0).reset();
 //              $el.unwrap()
 //              return false;
 //          }
    // if (fileInput.length && fileInput[0].files && fileInput[0].files.length) {
    //   var url = window.URL || window.webkitURL;
    //   var image = new image();
    //   image.onload = function() {
    //     alert('Valid Image');
    //   };
    //   image.onerror = function() {
    //     alert('Invalid image');
    //   };
    //   image.src = url.createObjectURL(fileInput[0].files[0]);
    // }
  });
});


</script>