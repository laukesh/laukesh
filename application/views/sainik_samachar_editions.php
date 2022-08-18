<script>
function getData(page){ 
   var year     = $('#year').val();
   var month    = $('#month').val();
   var biweek   = $('#biweek').val();
   $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/sainik_samachar_ajax",
        data: {page: page,
               year:year,
               month:month},
        success: function(result){
         $('.loader_css').hide();
         var returnedData = JSON.parse(result); 
         var serialnumber = returnedData.page_number;
         var serialnumber = (serialnumber-1)*15;
         var datafinal = returnedData.sainik_samachar;
         var base_url = returnedData.base_url;
         var base_url_pdf = returnedData.base_url_pdf;

         $("#sainik_samachar").html("");
          for ( var i in datafinal) {
            serialnumber++;
            var title = datafinal[i].title;
            var year  = datafinal[i].year;
            var month2 = datafinal[i].month;
              if(month2 == 1){ var month = 'January';}
            else if(month2 == 2){ var month = 'February';}
            else if(month2 == 3){ var month = 'March';}
            else if(month2 == 4){ var month = 'April';}
            else if(month2 == 5){ var month = 'May';}
            else if(month2 == 6){ var month = 'June';}
            else if(month2 == 7){ var month = 'July';}
            else if(month2 == 8){ var month = 'August';}
            else if(month2 == 9){ var month = 'September';}
            else if(month2 == 10){ var month = 'October';}
            else if(month2 == 11){ var month = 'November';}
            else if(month2 == 12){ var month = 'December';}
        
            var biweek_no2 = datafinal[i].biweek_no; 
            if(biweek_no2 == 1){ var biweek_no = '1st to 15th'} 
            else if(biweek_no2 == 2){ var biweek_no = '16th to 31st'}
            var volume = datafinal[i].volume;  
                
            
             $("#sainik_samachar").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+title+'</td><td class="left">'+year+'</td><td class="left">'+month+'</td><td class="left">'+biweek_no+'</td><td class="left">'+volume+'</td><td class="left"><a href="'+base_url+'"><i class="fas fa-eye"></i></a><!--<a href="'+base_url_pdf+'"><i class="fas fa-download"></i></a>--></td></tr>');
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
   var year    = $('#year').val();
   var month   = $('#month').val();
   var edition = $('#end-dat').val(); 
    var data = {
                 "year":year,
                 "month":month,
                 "edition":edition
                };
 $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
      $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/sainik_samachar_ajax",
        data: data,
        success: function(result){
          $('.loader_css').hide();
          var returnedData = JSON.parse(result); 
         var serialnumber = returnedData.page_number;
         var serialnumber = (serialnumber-1)*15;
         var datafinal = returnedData.sainik_samachar;
 
         var base_url = returnedData.base_url;
         var base_url_pdf = returnedData.base_url_pdf;
       
         $("#sainik_samachar").html("");
         if(datafinal !=0){
          for ( var i in datafinal) {
            serialnumber++;
            var title = datafinal[i].title;
            var year  = datafinal[i].year;
            var month2 = datafinal[i].month;
               if(month2 == 1){ var month = 'January';}
            else if(month2 == 2){ var month = 'February';}
            else if(month2 == 3){ var month = 'March';}
            else if(month2 == 4){ var month = 'April';}
            else if(month2 == 5){ var month = 'May';}
            else if(month2 == 6){ var month = 'June';}
            else if(month2 == 7){ var month = 'July';}
            else if(month2 == 8){ var month = 'August';}
            else if(month2 == 9){ var month = 'September';}
            else if(month2 == 10){ var month = 'October';}
            else if(month2 == 11){ var month = 'November';}
            else if(month2 == 12){ var month = 'December';}
        
            var biweek_no2 = datafinal[i].biweek_no; 
            if(biweek_no2 == 1){ var biweek_no = '1st to 15th'} 
            else if(biweek_no2 == 2){ var biweek_no = '16th to 31st'}
            var volume = datafinal[i].volume;  
                
            
            $("#sainik_samachar").append('<tr><td class="left">'+serialnumber+'</td><td class="left">'+title+'</td><td class="left">'+year+'</td><td class="left">'+month+'</td><td class="left">'+biweek_no+'</td><td class="left">'+volume+'</td><td class="left"><a href="'+base_url+'"><i class="fas fa-eye"></i></a><!--<a href="'+base_url_pdf+'"><i class="fas fa-download"></i></a>--></td></tr>');
          }
          }else{
                    
          $("#sainik_samachar").append('<div class="danger_message col-md-10" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div>');
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
    <li class="breadcrumb-item"><a href="#"><?php echo $tran_lang['sainik_samachar'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang_breadcrumb[0]->name; ?></li>
  </ol>
</nav>
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
 <table class="table table-bordered tablefont">
  <thead class="table-dark1">
    <tr>  
      <th scope="col" rowspan ="S.No" ><?php echo $tran_lang['s_no'];?></th>  
      <th scope="col" rowspan ="2" ><?php echo $tran_lang['title'];?></th>      
      <th scope="col" rowspan ="2" class=""><?php echo $tran_lang['year'];?></th>
      <th scope="col" rowspan ="2" class=" "><?php echo $tran_lang['month'];?></th>
      <th scope="col" rowspan ="2" ><?php echo $tran_lang['edition'];?></th>
      <th scope="col" rowspan ="2" ><?php echo $tran_lang['volume'];?></th>
      <th scope="col" rowspan ="2" ><?php echo $tran_lang['view'];?></th>
    </tr>
 
  </thead>
  <tbody id="sainik_samachar">
    <?php 
    if(!empty($sainik_samachar)){
        $i=1;
    foreach($sainik_samachar as $item)
       
    {
    ?>
    <tr>
    <td class="left"><?php echo $i; ?></td>
      <td scope="row"><?php echo $item->title; ?></td>     
            <td class="left"><?php echo $item->year; ?></td>
            <td class="left">
              <?php 
              if($item->month == 1){ echo 'January'; }
              else if($item->month == 2){ echo 'February'; }
              else if($item->month == 3){ echo 'March'; }
              else if($item->month == 4){ echo 'April'; }
              else if($item->month == 5){ echo 'May'; }
              else if($item->month == 6){ echo 'June'; }
              else if($item->month == 7){ echo 'July'; }
              else if($item->month == 8){ echo 'August'; }
              else if($item->month == 9){ echo 'September'; }
              else if($item->month == 10){ echo 'October'; }
              else if($item->month == 11){ echo 'November'; }
              else if($item->month == 12){ echo 'December'; }

            ?></td>
            <td class="left"><?php 
            if($item->biweek_no == 1){ echo '1st to 15th '; }
               else if($item->biweek_no == 2){ echo '16th to 31st'; }
            ?></td>
            <td class="left"><?php echo $item->volume; ?></td>
            <td class="left">
        <a href="<?php echo base_url('latest-sainik-samachar/').$item->id;?>"><i class="fas fa-eye"></i></a>
        <!-- <a href="<?php echo base_url('latest-sainik-samachar-pdf/').$item->id;?>"><i class="fas fa-download"></i></a> -->
    </td>
</tr>

<?php
$i++;
}
 ?>
</tbody>
</table> 
<?php } else{ ?>


<div id="media_listing" class="danger_message col-md-4" style="background-color: #ffdddd; 
  padding: 10px 12px;    text-align: center;
    margin: 0 auto;">
  <p><strong><?php echo $tran_lang['data_not_found'];?></strong></p>
</div>



<?php }
?>     
  
<ul class="pagination" id="page_link">
  <?php echo $links; ?>
</ul> 
 </div>
 </div>
 </div>
  </div>
  
<script type="text/javascript">
$(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        /*maxDate:moment(),*/
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 2 Week': [moment().subtract(12, 'days'), moment()],
          /*'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
        }
    }, cb);

    cb(start, end);

});
</script>
<script type="text/javascript">
    var start = 1980;
    var end = new Date().getFullYear();
    var options = "";

    options = "<option selected value=''><?php echo $tran_lang['year'];?></option>";
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

 $('#month').change(function(){
    var year = show_year();
    //alert(year);
    var month = $(this).val();
        //alert(month);

              if( (0 == year % 4) && ((0 != year % 100) || (0 == year % 400) ))
                {
                    if(month == 2)
                    {
                        var till = 29;
                    }  
                }
                else if(year == ''){
                    var till = 31;
                }
                else if(month == 2)
                {
                    var till = 28;
                }
                else if(month == 1 || month == 3 || month == 5  || month == 7 || month == 8 || month == 10 || month == 12)
                {
                    var till = 31;
                }
                else if(month == 4 || month == 6 || month == 9 || month == 11)
                {
                    var till = 30;
                }
                 
                var end_date = "";
                end_date += "<option>Edition</option>";
                end_date += "<option value='1'> 1-15 </option>";
                end_date += "<option value='2'> 16-"+ till +"</option>";
                document.getElementById("end-date").innerHTML = end_date ;
});
</script>

</html>