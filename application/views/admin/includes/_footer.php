<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<?php 
$user_id = $this->session->userdata('vr_sess_user_id');
$token = $this->session->userdata('token');
$this->db->where('id',$user_id);
$q = $this->db->get('users')->row();    
 if($this->session->userdata('token') != $q->token){
        $this->session->unset_userdata('vr_sess_user_id');
        $this->session->unset_userdata('vr_sess_user_email');
        $this->session->unset_userdata('vr_sess_user_role');
        $this->session->unset_userdata('vr_sess_logged_in');
        $this->session->unset_userdata('vr_sess_app_key');
        helper_deletecookie("remember_user_id");
        $this->session->sess_destroy();
    $baseurl= base_url('admin/login');
    redirect($baseurl);
exit;
 }

?>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
 
<footer id="footer" class="main-footer">
    <div class="pull-right hidden-xs">
        <strong style="font-weight: 600;"><?php echo $this->settings->copyright; ?>&nbsp;</strong>
    </div>
    <!-- <b>Version</b>&nbsp;1.8.1 -->
</footer>
</div><!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with+9
+ Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js"></script>
<!-- DataTables js -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Lazy Load js -->
<script src="<?php echo base_url(); ?>assets/admin/js/lazysizes.min.js"></script>
<!-- iCheck js -->
<script src="<?php echo base_url(); ?>assets/vendor/icheck/icheck.min.js"></script>
<!-- Pace -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.min.js"></script>
<!-- File Manager -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/file-manager/file-manager.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/file-uploader/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/file-uploader/js/ui.js"></script>
<!-- Plugins js -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins.js"></script>
<!-- Color Picker js -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- Datepicker js -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url(); ?>assets/admin/js/custom-1.8.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/common-custom.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/post-types.js"></script>

<!--tinyMCE-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $('form').submit(function(e){
        var msg = false;
        jQuery(this).find('input').each(function(){
        var str = jQuery(this).val().toLowerCase();

        if(str.indexOf('script>')>=0 || str.indexOf('>script')>=0 || str.indexOf('<script>')>=0 || str.indexOf('<script')>=0 || str.indexOf('/script')>=0 || str.indexOf('onload')>=0 || str.indexOf('onclick')>=0 || str.indexOf('onblur')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('ondblclick')>=0 || str.indexOf('onfocus')>=0 || str.indexOf('onkeydown')>=0 || str.indexOf('onkeyup')>=0 || str.indexOf('onkeypress')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('onmousemove')>=0 || str.indexOf('onmouseover')>=0 || str.indexOf('onmouseup')>=0 || str.indexOf('onmouseout')>=0 || str.indexOf('onchange')>=0 || str.indexOf('<div')>=0 || str.indexOf('onerror')>=0 || str.indexOf('alert(')>=0 || str.indexOf('onsubmit')>=0 || str.indexOf('<img')>=0 || str.indexOf('<span')>=0 || str.indexOf('<i')>=0 || str.indexOf('<head')>=0 || str.indexOf('<body')>=0 || str.indexOf('<style')>=0 || str.indexOf('<title')>=0 || str.indexOf('<')>=0 || str.indexOf('$')>=0 || str.indexOf('#')>=0 || str.indexOf('%')>=0 || str.indexOf('>')>=0 ||  str.indexOf('val()')>=0 || str.indexOf('src=')>=0){
        msg = true;
        e.preventDefault();
        }
        });
        if(msg){
        alert('Sorry, You are not allowed to submit special tags');
        }
        });
       

       $('form').submit(function(e){
        var msg = false;
        jQuery(this).find('textarea').each(function(){
          //  alert("aaaa");
        var str = tinymce.activeEditor.getContent();
        //alert(str);

        if(str.indexOf('script>')>=0 || str.indexOf('>script')>=0 || str.indexOf('<script>')>=0 || str.indexOf('<script')>=0 || str.indexOf('/script')>=0 || str.indexOf('onload')>=0 || str.indexOf('onclick')>=0 || str.indexOf('onblur')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('ondblclick')>=0 || str.indexOf('onfocus')>=0 || str.indexOf('onkeydown')>=0 || str.indexOf('onkeyup')>=0 || str.indexOf('onkeypress')>=0 || str.indexOf('onmousedown')>=0 || str.indexOf('onmousemove')>=0 || str.indexOf('onmouseover')>=0 || str.indexOf('onmouseup')>=0 || str.indexOf('onmouseout')>=0 || str.indexOf('onchange')>=0 || str.indexOf('<div')>=0 || str.indexOf('onerror')>=0 || str.indexOf('alert(')>=0 || str.indexOf('onsubmit')>=0 ||  str.indexOf('<style')>=0 || str.indexOf('val()')>=0 || str.indexOf('^')>=0  || str.indexOf('src=')>=0){
        msg = true;
        e.preventDefault();
        }
        });
        if(msg){
        alert('Sorry, You are not allowed to submit special tags');
        }
        });
</script>


<script>
    function init_tinymce(selector, min_height) {
        var menu_bar = 'file edit view insert format tools table help';
        if (selector == '.tinyMCEQuiz') {
            menu_bar = false;
        }
        tinymce.init({
            selector: selector,
            min_height: min_height,
            valid_elements: '*[*]',
            relative_urls: false,
            remove_script_host: false,
            directionality: directionality,
            language: '<?php echo $this->selected_lang->text_editor_lang; ?>',
            menubar: menu_bar,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code codesample fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: 'fullscreen code preview | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent',
            content_css: ['<?php echo base_url(); ?>assets/admin/plugins/tinymce/editor_content.css'],
        });
        tinymce.DOM.loadCSS('<?php echo base_url(); ?>assets/admin/plugins/tinymce/editor_ui.css');
    }

    if ($('.tinyMCE').length > 0) {
        init_tinymce('.tinyMCE', 500);
    }
    if ($('.tinyMCEsmall').length > 0) {
        init_tinymce('.tinyMCEsmall', 300);
    }
    if ($('.tinyMCEQuiz').length > 0) {
        init_tinymce('.tinyMCEQuiz', 200);
    }
</script>

<?php if (isset($lang_search_column)): ?>
    <script>
        var table = $('#cs_datatable_lang').DataTable({
            dom: 'l<"#table_dropdown">frtip',
            "order": [[0, "asc"]],
            "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
        });
        //insert a label
        $('<label class="table-label"><label/>').text('Language').appendTo('#table_dropdown');

        //insert the select and some options
        $select = $('<select class="form-control input-sm"><select/>').appendTo('#table_dropdown');

        $('<option/>').val('').text('<?php echo trans("all"); ?>').appendTo($select);
        <?php foreach ($this->languages as $lang): ?>
        $('<option/>').val('<?php echo $lang->name; ?>').text('<?php echo $lang->name; ?>').appendTo($select);
        <?php endforeach; ?>


        $("#table_dropdown select").change(function () {
            table.column(<?php echo $lang_search_column; ?>).search($(this).val()).draw();
        });

        
    </script>
<?php endif; ?>
<script type="text/javascript">
      $(function(){
    $('#datetimepicker1').datetimepicker({ format: "DD/MM/YYYY HH:mm",
            stepping: 10,
            minDate:new Date()
         });
     });


</script>

<script>
//$(document).ready(function(){
   $(".btn").click(function(){  
      var data = 'http://localhost/sainik-patrika/admin/login'
     // var session = '<?php //logout2();?>'
       //location.href = data;
       //  if (data == 'http://localhost/sainik-patrika/admin/login'){        
       //  var sess = '<?php //session_destroy();?>'
       // }
      //var sess = '<?php //session_destroy();?>'

  });
//});

</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js">  </script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js">   -->
</script> 
</body>
<?php  
$minutesBeforeSessionExpire=15;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire*60))) {
    logout2();
}
 $_SESSION['LAST_ACTIVITY'] = time();

 function logout2(){
        session_unset();
        session_destroy();
        $baseurl= base_url('admin/login');
        echo '<script>window.location.href = "'.$baseurl.'"</script>';
    }
?>
<script  src="<?php echo base_url(); ?>assets/admin/js/crypto-js.min.js"></script>
<script type="text/javascript">
    function encrypt_change_password(){
    var old_password       = jQuery('#old_password').val();
    var password_change       = jQuery('#password_change').val();
    var password_confirm       = jQuery('#password_confirm').val();
    var DataKey    = CryptoJS.enc.Utf8.parse("01234567890123456789012345678901");
    var DataVector = CryptoJS.enc.Utf8.parse("1234567890123412");
    if(old_password == '' || password_change == '' || password_confirm == ''){
        alert("Please enter old password, changed password, confirm changed password fields");
        return false;
    }
    else{
        var encrypted_old_password  = CryptoJS.AES.encrypt(old_password, DataKey, { iv: DataVector });
    jQuery('#old_password').val(encrypted_old_password);
     var encrypted_password_change  = CryptoJS.AES.encrypt(password_change, DataKey, { iv: DataVector });
    jQuery('#password_change').val(encrypted_password_change);
     var encrypted_password_confirm  = CryptoJS.AES.encrypt(password_confirm, DataKey, { iv: DataVector });
    jQuery('#password_confirm').val(encrypted_password_confirm);
    return true;
    } 
   
   }
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
   jQuery(function() {
    jQuery('input').attr('autocomplete', 'off');

   });
});

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



<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</html>


<script type="text/javascript">
 $().ready(function() {
  $('[type="file"]').change(function() {

    var fileInput = $(this);
     var fullPath = this.value;

     var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    const count =filename.split(".").length; 
    if(count>2){
        alert('Please upload a valid file with single dot & extension');
         $('#Multifileupload_image') = '';
         $('#MultidvPreview').hide();
       
        return false;
    }
    if (fileInput.length && fileInput[0].files && fileInput[0].files.length) {
      var url = window.URL || window.webkitURL;
      var image = new Image();
      image.onload = function() {
        alert('Valid Image');
      };
      image.onerror = function() {
        alert('Invalid image');
      };
      image.src = url.createObjectURL(fileInput[0].files[0]);
    }
  });
});


</script>


