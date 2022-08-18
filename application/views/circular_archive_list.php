<script>
function getData(page){ 
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();

  $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");

    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/circular_list_ajax",
        data: {page: page,
                daterange:daterange,
                title:search_value},
        success: function(data){
          $("#media_listing").hide();
          $(".loader_css").hide();
             var returnedData = JSON.parse(data); 
             var serialnumber = returnedData.page_number;
             var serialnumber = (serialnumber-1)*15;
             var datafinal = returnedData.circular_list;

             if(datafinal.length != 0){
             $("#circular_list").html("");
              for ( var i in datafinal) {
                serialnumber++;
                var id = datafinal[i].id;
                var title = datafinal[i].title;
                var created_at = moment(datafinal[i].created_at).format('DD/MM/YYYY');
                var pdf_url = 'circular-list/'+id;
                var file_size = datafinal[i].file_size;

                $("#circular_list").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+title+'</td><td class="left">'+created_at+'</td><td class="left">'+title+'&nbsp;<a href="'+pdf_url+'"><i class="fas fa-file-pdf pdf"></i></a>&nbsp;'+file_size+'(KB)</td></tr>');
              }
              
              }else{
               
              $("#circular_list").html('<div class="danger_message col-md-4 error_style_center"><p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data</strong></p></div>');

              } 
              $('#page_link').html(returnedData.links); 

        }
    });
}
</script>
<script>
$(document).ready(function (){
$("#searchForm").submit(function(event) {
  event.preventDefault();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();

    var data = {
                 "daterange":daterange,
                 "title":search_value
                };
   // alert(data.title);

     $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/circular_list_ajax',
            data: data,
            success: function(data){
           $(".loader_css").hide();
           $("#media_listing").hide();
             var returnedData = JSON.parse(data); 
             var serialnumber = returnedData.page_number;
             var serialnumber = (serialnumber-1)*15;
             var datafinal = returnedData.circular_list;

             if(datafinal.length != 0){
             $("#circular_list").html("");
              for ( var i in datafinal) {
                serialnumber++;
                var id = datafinal[i].id;
                var title = datafinal[i].title;
                var created_at = moment(datafinal[i].created_at).format('DD/MM/YYYY');
                var pdf_url = 'circular-list/'+id;
                 var file_size = datafinal[i].file_size;

                $("#circular_list").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+title+'</td><td class="left">'+created_at+'</td><td class="left">'+title+'&nbsp;<a href="'+pdf_url+'"><i class="fas fa-file-pdf pdf"></i></a>&nbsp;'+file_size+'(KB)</td></tr>');
              }
              
              }else{
               
              $("#circular_list").html('<div class="danger_message col-md-4 error_style_center"><p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data</strong></p></div>');

              } 
              $('#page_link').html(returnedData.links);
              }
        });
});
});
</script>
    <!---Header End from here--->
<!--middle section start here-->
<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('archive-list');?>"><?php echo $tran_lang['archives'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['notifications_circulars'];?></li>
  </ol>
</nav>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="search_main">
<form role="form" method="post" id="searchForm" action="/">
<div class="row">

<div class="col-md-3">
<input type="hidden" name="daterange" id="daterange" class="reportrange"  value=""/>

<div class="input_date_bg reportrange" >Date
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>

</div>

<div class="col-md-3"><input type="search" id="search_value" name="" class="search_textbox" placeholder="caption, keywords to search"></div>

<div class="col-md-1">
<button type="submit" class="btn-search" name="search2" id="search_value" value="">Search</button>
<input type="hidden" name="sflag" value="0" class="sflag">
</div>
<div class="col-md-1"></div>
<!-- <div class="col-md-2">
<a href="<?php echo base_url('media-invite-archive');?>" type="button" class="archived1">Archives</a>
</div> -->
</div>
</form>

</div>
</div>
</div>

 </div> 
 </section> 
  
  <!--start box gallery-->
  <div class="container">
  
<!--  <div class="row mb-2 mt-3">
 <div class="col-md-12" ><h1 class="media-heading">Notifications & Circulars<br><span class="media-heading-sub">for Notifications & Circulars beyond 15 days, see "Archives" </span></h1></div>

 </div> -->
 
 
 <!--table start here-->
 
 <div class="row mt-2">

 <div class="col-md-12"> 
 <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
  <table class="table table-bordered tablefont" id="error_msg">
  <thead class="table-dark1">
    <tr> 
      <th scope="col" rowspan ="2" class="">S.No</th>     
      <th scope="col" rowspan ="2" class="">Notifications / Circulars</th>
      <th scope="col" rowspan ="2" class=" wd_165">Uploaded on</th>
      <th scope="col" rowspan ="2" class="document">Document(s)</th>
    </tr>
 
  </thead>
  <tbody id="circular_list">
      <?php 
      //echo '<pre>';print_r($media_invite);
      //die();
      $i=0;
      foreach($circular_list as $item){
        $i++;
      ?>
      <tr> 
      <td class="left"><?php echo $i;?></td>     
      <td class="left"><?php echo $item->title;?></td>
      <td class="left"><?php echo $item->created_at;?></td>
      <td class="left"><?php echo $item->title;?>
      <a href="<?php echo base_url('circular-list/').$item->id;?>"><i class="fas fa-file-pdf pdf"></i></a>&nbsp;<?php echo $item->file_size;?>(KB)</td>
      </tr>
    <?php
    }

    ?>
    
  </tbody>
</table>
<?php if(empty($circular_list)){?>
<div id="media_listing" class="danger_message col-md-4" style="background-color: #ffdddd; 
  padding: 10px 12px;    text-align: center;
    margin: 0 auto;">
  <p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data
  </strong></p>
</div>

<?php }?>
 
 
 
 
 </div>
 </div>

 </div>
 
  </div>
   <div class="col-md-12 pagination_media_list" id="page_link">
<?php echo $links; ?>
</div>  
  
  
<script type="text/javascript">
$(function() {
  
    var start = moment().subtract(2, 'years');
    var end = moment();

    function cb(start, end) {

      $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('.reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')); 
    } 

    $('.reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        maxDate:moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    });


// $(function () {
//   $('#myModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget); // Button that triggered the modal
//     var code = button.data('code'); // Extract info from data-* attributes
//     var company = button.data('company'); // Extract info from data-* attributes
//     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//     var modal = $(this);
//     modal.find('#code').val(code);
//     modal.find('#company').val(company);
//   });
// });

</script>

</html>

</html>