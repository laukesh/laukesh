<script>
function getData(page){ 
   var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();
   //alert(page);
      $('#page_link').hide(); 
      $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/photo_list_ajax",
        data: {page: page,
               photo_category_id:cate_name,
                daterange:daterange,
                title:search_value},
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(data){
          //alert(data);
            $('.loading').hide();
            $('.loader_css').hide();
            $('#photo_list').html(data);
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

   $('#page_link').hide();
   $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    var data = {
                 "photo_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };

         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/photo_list_ajax',
            data: data,
            success: function (response){
              $('.loader_css').hide()
              if(response != 0){
                $("#photo_list").html(response);        
               }else{
                
              $("#photo_list").html('<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div>');
                 }
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
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo $tran_lang['home'];?></a></li>
     <li class="breadcrumb-item"><a href="<?php echo base_url('whats-new');?>"><?php echo $tran_lang['whats_new'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['photo_gallery'];?></li>
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
  <?php foreach ($photo_categories as $item){?>
    <option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
  <?php } ?> 
   
       
</select>
</div>
<!--<div class="col-md-3"><input type="search" id="" name="" class="select_dropdown_auto1" placeholder="Search"></div>-->
<div class="col-md-3">
<input type="hidden" name="daterange" id="daterange" class="reportrange"  value=""/>

<div class="input_date_bg reportrange" >Date
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>

</div>

<div class="col-md-3"><input type="search" id="search_value" name="" class="search_textbox" placeholder="<?php echo $tran_lang['caption'].','.$tran_lang['keywords'];?>"></div>

<div class="col-md-2">
<button type="submit" class="btn-search" name="search2" id="search_value" value=""><?php echo $tran_lang['search'];?></button>
<input type="hidden" name="sflag" value="0" class="sflag">
</div>
<!-- <div class="col-md-2">
<a href="<?php echo base_url('photo-list');?>" type="button" class="archived1"><?php echo $tran_lang['archives'];?></a>
</div> -->
<div class="col-md-1"></div>
</div>
</form>
</div>
</div>
<div class="col-md-12">
<h1 class="media-heading"><?php echo $tran_lang['photos'];?><br>
<span class="media-heading-sub"><a href="<?php echo base_url('photo-list');?>"><?php echo $tran_lang['fifteen_days_photos'];?></a></span></h1></div>
</div> 

 </div>

 </section> 
  
  <!--start box gallery-->
  <div class="container "> 
  <div class="row mt-3 photo_list bg_white bg_padding" id="photo_list">

<?php 
//$count = 15;
if(!empty($photo)){
  $i=1;
     foreach($photo as $item){
       $d = date_create($item->updated_at);
       if(strlen($item->title)>46){
        $titleshort=truncate($item->title,105);
       }
       else{
        $titleshort=$item->title;
       }
      //echo $d->format('d-m-yyyy');
      ?>
          <div class="col-md-4 mt-3">
          <div class="card mb-2">
          <div class="column">
          <img src="<?php echo base_url() . html_escape($item->path_small); ?>" style="width:100%" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow margin_none cursor" title="<?php echo $item->title;?>" alt="<?php echo $item->title;?>">
          </div>
          <div class="row ml">
          <div class="col-md-12"><p class="line_text_2 card-text max_height42p min_height42p "> <?php echo $titleshort; ?></p></div>
          </div>

           <div class="share">
          <div class="col-md-12"> <a href="#" type="button" class="readmore btn btn-success float-right" data-toggle="modal"  data-target="#myshare_modal<?php echo $item->id;?>" data-id="<?php echo $item->id; ?>"><i class="fas fa-share"></i> Share</a>
          </div>
          </div>

          <div class="modal fade" id="myshare_modal<?php echo $item->id;?>" role="dialog">
              <div class="modal-dialog">   
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Social Media Link</h4>
                  </div>
                  <div class="modal-body">
                  <!-- Facebook -->
              <a href="http://www.facebook.com/sharer.php?u=<?php echo base_url() . html_escape($item->path_big); ?>" target="_blank">Share on FaceBook</a><br>

              <a href="http://twitter.com/intent/tweet?url=<?php echo base_url() . html_escape($item->path_big); ?>&text=<?php echo $item->title; ?>&hashtags=sainiksamachar&original_referer=<?php echo base_url() . html_escape($item->path_big); ?>" target="_blank">Share on Twitter</a><br>

               <a href="https://api.whatsapp.com/send?text=<?php echo $item->title; ?>&nbsp;<?php echo base_url() . html_escape($item->path_big); ?>" target="_blank">Share on Whatsapp</a><br>
           <!--    <a href="https://plus.google.com/share?url=<?php echo base_url() . html_escape($item->path_big); ?>" target="_blank">Share on Google+</a><br> -->

              <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url() . html_escape($item->path_big); ?>&title=<?php echo $item->title; ?>&summary=<?php echo $item->title; ?>&source=LinkedIn" target="_blank">Share on LinkedIn</a><br>

              <a href="mailto:?Subject=Sainik Samachar Photo Share&Body=<?php echo base_url() . html_escape($item->path_big); ?>">Share on Email</a> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
                
              </div>
              </div> 

      <!-- <div class="share">
          <div class="row">
          <div class="col-md-4"> <button type="button" class="btn btn-info btn-lg" data-toggle="modal" 
            data-target="#myModal<?php echo $item->title;?>" data-id="<?php echo $item->title; ?>">Open Modal</button></div> 
          <div class="col-md-2"></div>
          <div class="col-md-6"> <a href="<?php echo base_url('photo-list-image/').$item->id;?>" class="readmore btn btn-success float-right"><i class="fas fa-download"></i> Download</a></div>
          </div>
          </div> -->
          </div>
          </div>


    <?php
    $i++;
    }
  }else{
  ?>
    
<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;
  padding: 10px 12px; margin-top:40px; text-align:center; left: 356px">
  <p><strong><?php echo $tran_lang['data_not_found'];?></strong></p>
</div>
</div>
<?php
}
  ?>
<div class="col-md-12 pagination" id="page_link">
<?php echo $links; ?>
</div>
  


<div id="myModalgallery" class="modal modal_pic">
<span class="close cursor" onclick="closeModal()">&times;</span>
<div class="modal-content photo_list">
<?php 
$count = count($photo);
if(!empty($photo)){
  $i=1;
     foreach($photo as $item){
       $d = date_create($item->updated_at);
      //echo $d->format('d-m-yyyy');
      ?>
<div class="mySlides">
<div class="numbertext"><?php echo $i; ?> / <?php echo $count;?></div>
<img src="<?php echo base_url() . html_escape($item->path_big); ?>" class="line_text_2 card-text max_height500p min_height500p"  style="width:100%" title="<?php echo $item->title; ?>" alt="<?php echo $item->content; ?> "/></br>
<p class="photo-title"><?php echo $item->title.','.$d->format('d/m/Y'); ?></p>
</div>


    <?php
    $i++;
    }
  }
  ?>
<a class="prev1" onclick="plusSlides(-1)">&#10094;</a>
<a class="next1" onclick="plusSlides(1)">&#10095;</a>

<div class="caption-container">
<p id="caption"></p>
</div>  
</div>
</div> 
</div>  


    
<!--Audio Play Section Modal for Video Play-->
</body>

<?php 

    // $dateRateDef = $_POST['daterange']; 
    // $search     = $_POST['search2']; 
    // //echo "--gggggggggg"; die;
    // $dateRateDefArr =explode('-', $dateRateDef);
    // $startDatedef =trim($dateRateDefArr[0]);
    // $endDatedef =trim($dateRateDefArr[1]);
?>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(14, 'days');
    var end = moment();
    
      //var min_date = moment().subtract(14, 'days');
    

    function cb(start, end) {
      //alert(start);
    

      $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('.reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

    } 

    $('.reportrange').daterangepicker({
     
        
        startDate: start,
        endDate: end,
        maxDate:moment(),
        //minDate:min_date,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 2 Week': [moment().subtract(14, 'days'), moment()],
          /* 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
        }
    }, cb);

    cb(start, end);

});
</script>
</html>