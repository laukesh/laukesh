<script>
function getData(page){ 
   var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();
   //alert(daterange);
   $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/press_release_list_ajax",
        data: {page: page,
               press_release_category_id:cate_name,
               daterange:daterange,
               title:search_value},
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(data){
         $(".loader_css").hide();
         $('#msg_error').hide();
         var returnedData = JSON.parse(data); 
         var serialnumber = returnedData.page_number;
         var serialnumber = (serialnumber-1)*15;
        //  alert(serialnumber);
          var datafinal = returnedData.press_release;
 
        
         if(datafinal != 0){
         $("#press_release").html("");

          for ( var i in datafinal) {
            serialnumber++;
            var id = datafinal[i].id;
            var pro_name = datafinal[i].name;
            var approved_at = datafinal[i].approved_at;
            var approved_at = moment(approved_at).format('DD/MM/YYYY');
            var press_release_title = datafinal[i].press_release_title;           
            
            $("#press_release").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+pro_name+'</td><td class="left"><a href= "<?php echo base_url();?>press-realease-details/'+id+'">'+press_release_title+'</a></td><td class="left">'+approved_at+'</td></tr>');
          }
          }else{

          $("#press_tables_msg").html("");
          $("#press_tables_msg").append('<tr><td class="left"></td><td class="left"></td> <td class="left">  <div class="danger_message col-md-12 data_not_found_error"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div></td><td class="left"></td></tr>');

          }    
         
          $('#page_link').html(returnedData.links);
           //});


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
                 "press_release_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };
     //$('#page_link').hide();
    $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");

      $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/press_release_list_ajax",
        data: data,
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(data){
         $(".loader_css").hide();
         $('#msg_error').hide();
         var returnedData = JSON.parse(data); 
         var serialnumber = returnedData.page_number;
         var serialnumber = (serialnumber-1)*15;
        //  alert(serialnumber);
          var datafinal = returnedData.press_release;
         if(datafinal != 0){
         $("#press_release").html("");

          for ( var i in datafinal) {
            serialnumber++;
            var id = datafinal[i].id;
            var pro_name = datafinal[i].name;
            var approved_at = datafinal[i].approved_at;
            var approved_at = moment(approved_at).format('DD/MM/YYYY');
            var press_release_title = datafinal[i].press_release_title;           
            
            $("#press_release").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+pro_name+'</td><td class="left"><a href= "<?php echo base_url();?>press-realease-details/'+id+'">'+press_release_title+'</a></td><td class="left">'+approved_at+'</td></tr>');
          } 

        }else{
          $("#press_release").html("");
          $("#press_release").append('<tr><td class="left"></td><td class="left"></td> <td class="left">  <div class="danger_message col-md-12 table_error"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div></td><td class="left"></td></tr>');

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
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="#"><?php echo $tran_lang['media'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['press_release'];?></li>
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
  <?php if(empty($this->uri->segment(2))){?>
  <option value=""><?php echo $tran_lang['all_category'];?></option>
<?php }  else{ ?>
  <option value=""><?php echo $tran_lang['all_category'];?></option>

  <?php } foreach ($pru_cate as $item){?>
    <option value="<?php echo $item->id;?>"<?php echo ($this->uri->segment(2) == $item->id) ? 'selected' : ''; ?>><?php echo $item->name;?></option>
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
</div>
</form>
</div>
</div>

 </div> 





 </div> 
 </section> 
  
  <!--start box gallery-->
  <div class="container">

 
 
 <!--table start here-->
 
 <div class="row mt-2">

 <div class="col-md-12"> 
 <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
 <table class="table table-bordered tablefont" id="press_tables_msg">
  <thead class="table-dark1">
    <tr>      
       <th scope="col" rowspan ="2" class="wd_165"><?php echo $tran_lang['s_no'];?></th> 
      <th scope="col" rowspan ="2" class="wd_165"><?php echo $tran_lang['pro'];?></th>
       <th scope="col" rowspan ="2" class=""><?php echo $tran_lang['press_release'];?></th>
      <th scope="col" rowspan ="2" class="wd_165"><?php echo $tran_lang['release_date'];?></th> 
      
    </tr>
 
  </thead>
  <tbody id="press_release">
    <?php 
       if(!empty($press_release))
       {
       $i=0;
        foreach($press_release as $item)
        {
          $i++;
         $d = date_create($item->approved_at); 
        ?>
      <tr>   
    <td class="left"><?php echo $i;?></td>  
          <td class="left"><?php echo $item->name;?></td>
          <td class="left"><a href="<?php echo base_url('press-realease-details/').$item->id;?>"><?php echo $item->press_release_title;?></a></td>     
           <td class="left"><?php echo $d->format('d/m/Y'); ?></td>    
      </tr>
    <?php
    }
    }
    ?> 
  </tbody>

</table>
<?php if(empty($press_release)){?>
<div id="msg_error" class="danger_message col-md-4 data_not_found_error_firstload" >
  <p><strong><?php echo $tran_lang['data_not_found'];?></strong></p>
</div>

<?php }?>

<ul class="pagination" id="page_link">
  <?php echo $links; ?>
</ul> 
 </div>

 

 </div>

 </div>
  </div>
  
  

  <?php 
    $dateRateDef = $_POST['daterange']; 
    //echo "--gggggggggg"; die;
    $dateRateDefArr =explode('-', $dateRateDef);
    $startDatedef =trim($dateRateDefArr[0]);
    $endDatedef =trim($dateRateDefArr[1]);
?>
  
 <script type="text/javascript">
 $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
     
      $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('.reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));  
    } 

    $('.reportrange').daterangepicker({    
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 2 Week': [moment().subtract(14, 'days'), moment()],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>   
