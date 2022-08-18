<script>
function getData(page){ 
   var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();
   //alert(page);
     // $('#page_link').hide(); 
  $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/media_invite_archive_ajax",
        data: {page: page,
               media_invite_category_id:cate_name,
                daterange:daterange,
                title:search_value},
        success: function(data){
          $(".loader_css").hide();
         var returnedData = JSON.parse(data); 
         var serialnumber = returnedData.page_number;
         var serialnumber = (serialnumber-1)*15;
          var datafinal = returnedData.media_invite;

         if(datafinal != 0){
         $("#media_list").html("");

          for ( var i in datafinal) {
            serialnumber++;
            var id = datafinal[i].id;
            var name = datafinal[i].name;
            var venue_event = datafinal[i].venue_event;
            var mobile = datafinal[i].mobile;
            var remark = datafinal[i].remark;
            //var created_at = moment(datafinal[i].created_at).format('DD/MM/YYYY');
            var created_at = datafinal[i].created_at;
            //var press_release_title = datafinal[i].press_release_title;  

                      
            $("#media_list").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+name+'</td><td class="left"><a href="invite.html">'+name+'</a></td><td class="left">'+venue_event+'</td><td class="left">'+created_at+'</td><td class="left Cont_details">'+mobile+'</td><td class="left">'+remark+'</td></tr>');
          }
          }else{
           
          $("#media_list").html('<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data</strong></p></div>');

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
   var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();

    var data = {
                 "media_invite_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };
   // alert(data.daterange);

    $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/media_invite_archive_ajax',
            data: data,
            success: function (data){
           $(".loader_css").hide();
           $('#media_listing').hide();

             var returnedData = JSON.parse(data); 
            // alert(returnedData.page_number);
             var serialnumber = returnedData.page_number;
            // alert(serialnumber);
             var serialnumber = (serialnumber-1)*15;
             //$("#media_list").html("");
              var datafinal = returnedData.media_invite;
              //alert(datafinal.length);

             //if(datafinal.length != 0){
             $("#media_list").html("");
              for ( var i in datafinal) {
                serialnumber++;
                var id = datafinal[i].id;
                var name = datafinal[i].name;
                var venue_event = datafinal[i].venue_event;
                var mobile = datafinal[i].mobile;
                var remark = datafinal[i].remark;
                var created_at = moment(datafinal[i].created_at).format('DD/MM/YYYY');
                //var press_release_title = datafinal[i].press_release_title;  
                 //var created_at = datafinal[i].created_at;

                          
                $("#media_list").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+name+'</td><td class="left"><a href="invite.html">'+name+'</a></td><td class="left">'+venue_event+'</td><td class="left">'+created_at+'</td><td class="left Cont_details">'+mobile+'</td><td class="left">'+remark+'</td></tr>');
              }
              $('#page_link').html(returnedData.links);
             // }else{
               
             /// $("#error_msg").html('<div class="danger_message col-md-4 error_style_center"><p><strong>Sorry... !!! There is no data found &nbsp;&nbsp;</strong></p></div>');

             // }    
         
               
              }
        });
});
});
</script>
<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('archive-list');?>"><?php echo $tran_lang['media'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['media_invite'];?></li>
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

<div class="col-md-2">
<select name="cate_name" id="cate_name" class="text-left select_default">
  <option value=""><?php echo $tran_lang['all_category'];?></option>
  <?php foreach ($pru_cate as $item){?>
    <option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
  <?php } ?> 
   
       
</select>
</div>
<!--<div class="col-md-3"><input type="search" id="" name="" class="select_dropdown_auto1" placeholder="Search"></div>-->
<div class="col-md-3">
<input type="hidden" name="daterange" id="daterange" class="reportrange"  value=""/>

<div class="input_date_bg reportrange" ><?php echo $tran_lang['date'];?>
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>

</div>

<div class="col-md-3"><input type="search" id="search_value" name="" class="search_textbox" placeholder="<?php echo $tran_lang['caption'].','.$tran_lang['keywords'];?>"></div>

<div class="col-md-1">
<button type="submit" class="btn-search" name="search2" id="search_value" value=""><?php echo $tran_lang['search'];?></button>
<input type="hidden" name="sflag" value="0" class="sflag">
</div>
<div class="col-md-1"></div>
<div class="col-md-2">
<!-- <a href="<?php echo base_url('media-invite-archive');?>" type="button" class="archived1"><?php echo $tran_lang['archives'];?></a> -->
</div>
</div>
</form>

</div>
</div>
</div>
 </div> 
 </section> 
  
  <!--start box gallery-->
  <div class="container">
  
 <div class="row mb-2 mt-3">
<!--  <div class="col-md-12" ><h1 class="media-heading"><?php echo $tran_lang['media_invite'];?><br><span class="media-heading-sub"><?php echo $tran_lang['fifteen_days_media_invite'];?>" </span></h1>
 
 
 </div> -->

 </div>
 
 
 <!--table start here-->
 
 <div class="row mt-2">

 <div class="col-md-12"> 
 <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
 <table class="table table-bordered tablefont" id="error_msg">
  <thead class="table-dark1">
    <tr> 
      <th scope="col" rowspan ="1" class="wd_1"><?php echo $tran_lang['s_no'];?></th>     
      <th scope="col" rowspan ="2" class=" wd_165"><?php echo $tran_lang['pro'];?></th>
      <th scope="col" rowspan ="2" class=""><?php echo $tran_lang['events'];?></th>
      <th scope="col" rowspan ="2" class="event-venue "><?php echo $tran_lang['venue_details'];?></th>
      <th scope="col" rowspan ="2" class=" wd_165"><?php echo $tran_lang['date_and_time'];?></th>
      <th scope="col" class="">Contact Details</th>
      <th scope="col" rowspan ="2" class="">Remarks</th>
    </tr>
 
  </thead>
  <tbody id="media_list">
      <?php 
      //echo '<pre>';print_r($media_invite);
      //die();
      $i=0;
      foreach($media_invite as $item){
        $i++;
      ?>
      <tr> 
      <td class="left"><?php echo $i;?></td>     
      <td class="left"><?php echo $item->name;?></td>
      <td class="left"><a href="<?php echo base_url('media-invite-detail/').'122';?>"><?php echo $item->venue_event;?></a></td>
      <td class="left"><?php echo $item->venue_event;?></td>
      <td class="left"><?php echo $item->created_at;?></td>
      <td class="left Cont_details"><strong><br>Mob.</strong>+<?php echo $item->mobile;?></td>
      <td class="left"><?php echo $item->remark;?></td>
      </tr>
    <?php
    }

    ?>
    
  </tbody>
</table>
<?php if(empty($media_invite)){?>
<div id="media_listing" class="danger_message col-md-4" style="background-color: #ffdddd; 
  padding: 10px 12px;    text-align: center;
    margin: 0 auto;">
  <p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data</strong></p>
</div>

<?php }?>
</div>
 </div>
 </div>
 </div>
   <div class="col-md-12 pagination_media_list" id="page_link">
<?php echo $links; ?>
</div>
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