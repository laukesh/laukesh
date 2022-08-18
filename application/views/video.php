<?php 
//echo '============';die();
$count = count($video);
if(!empty($video)){
    $i =1;
     foreach($video as $item){
    }
}      
?>
<script>
function getData(page){ 
  var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();
      $('#page_link').hide(); 
      $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/video_list_ajax",
        data: {page: page,
               video_category_id:cate_name,
                daterange:daterange,
                title:search_value},
        success: function(data){
            $('.loader_css').hide();
            //alert(data);
            $('#video_list').html(data);
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
                 "video_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };

         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/video_list_ajax',
            data: data,
            success: function (response){
             
                $('.loader_css').hide();
              if(response != 0){
                $("#video_list").html(response);        
               }else{
                
              $("#video_list").html('<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div>');
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
    <li class="breadcrumb-item"><a href="<?php echo base_url('archive-list');?>"><?php echo $tran_lang['archives'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['video_gallery'];?></li>
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
  <?php foreach ($videos_categories as $item){?>
    <option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
  <?php } ?> 
   
       
</select>
</div>
<div class="col-md-3">
<input type="hidden" name="daterange" id="daterange" class="reportrange"  value="" />

<div class="input_date_bg reportrange" ><?php echo $tran_lang['date'];?>
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>

</div>
<div class="col-md-3">
  <input type="text"  name="search_value" id="search_value" class="search_textbox" placeholder="<?php echo $tran_lang['caption'].','.$tran_lang['keywords'];?>" 
  value="">
</div>
<div class="col-md-1">
<button type="submit" class="btn-search"><?php echo $tran_lang['search'];?></button>
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
<!--  <div class="col-md-12"><h1 class="media-heading">Videos<br><span class="media-heading-sub">for Videos beyond 15 days, see "Media-&gt;Videos or Archives" </span></h1></div> -->

 </div>
  <div class="row mt-3" id="video_list">

<?php 
$count = count($video);
//echo '<pre>';print_r($video);

if(!empty($video)){
  $i = 1;
     foreach($video as $item){
       $d = date_create($item->updated_at);
      //echo $d->format('d-m-yyyy');

       if(strlen($item->title)>46){
        $titleshort=truncate($item->title,70);
       }
       else{
        $titleshort=$item->title;
       }
      ?>
   <div class="col-md-4 mt-3">
   <div class="card mb-2">
            <div class="column">
                <img src="<?php echo base_url() . $item->path_image; ?>" style="width:100%" onclick="openModal();currentSlide(<?php echo $i;?>)" class="hover-shadow cursor margin_none card-img-top" title="<?php echo $item->title;?>" alt="<?php echo $item->title;?>">

  </div>

         <div class="row ml">
         <div class="col-md-12">
          <p class="line_text_2 card-text max_height42p min_height42p"> <?php echo $titleshort /*'.$d->format('d/m/Y')*/ ; ?></p>
        </div>
         
         </div>
        <div class="share">
             <div class="row">
             <!-- <div class="col-md-4"> <a class="btn btn-primary readmore" href="#"><i class="fas fa-share-alt"></i> Share</a></div> -->
             <div class="col-md-2"></div>
             <div class="col-md-6">             
             
                <?php if($item->link==1){?>
            
             <!--  <a class="btn btn-success readmore float-right" href="<?php //echo base_url('video-list/').$item->id;?>"><i class="fas fa-download"></i> Download</a> -->
               
              <?php } else{ //echo '<span class="btn btn-warning float-right" title="Youtube Videos can not be downloaded">Youtube Video</span>';}
              } ?>
              </div>
             
             </div>
             </div>
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
<?php
}
  ?>




   <div id="myModalgallery" class="modal modal_pic">   
      <div class="modal-content">

        <?php 
$count = count($video);
//echo '<pre>';print_r($video);

if(!empty($video)){
  $i = 1;
     foreach($video as $item){
       $d = date_create($item->updated_at);
      //echo $d->format('d-m-yyyy');
      
      if($item->link == 2){

    ?>
      <div class="mySlides">
        <button type="button" class="close cursor" onclick="closeModal(); stopVideo(this.id,2);" id="<?php echo $item->id;?>" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"  class="popup_close" id="audioModal<?php echo $item->id;?>">&times;
                    </span>

        </button>
      <div class="numbertext"><?php echo $i;?> / <?php echo $count;?></div>
      <div class="min_height500p">
      <iframe width="100%" height="500"id="youtube<?php  echo $item->id;?>" src="<?php echo $item->youtube_link;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>

      </iframe>
        <p class="photo-title"><?php echo $item->title.','.$d->format('d/m/Y');?></p>
      </div>
      </div>
    <?php } else {?>

      <div class="mySlides">
        <button type="button" class="close cursor" onclick="closeModal(); stopVideo(this.id,1);" id="<?php echo $item->id;?>" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="popup_close" id="audioModal<?php echo $item->id;?>">&times;
                    </span>

        </button>
      <div class="numbertext"><?php echo $i;?> / <?php echo $count;?></div>
      <div class="min_height500p">
      <video id ="videofile<?php echo $item->id;?>" width="100%" height="430" controls>
          <source id ="videoid<?php  echo $item->id;?>" src="<?php echo base_url(); echo $item->path_video;?>" type="video/mp4">   

        </video>
      <p class="photo-title"><?php echo $item->title.',Updated On '.$d->format('d/m/Y');?></p>
      </div>
      </div>

    <?php } ?>


      <?php $i++; }} ?>
      </div>
      </div>

<div class="col-md-12 pagination" id="page_link">
<?php echo $links; ?>
</div>
</div>
</div>  
 <!--pagination start here--> 
    
<script>
function openModal() {
  document.getElementById("myModalgallery").style.display = "block";
}

function closeModal(){
  //alert(id);
  document.getElementById("myModalgallery").style.display = "none";
}

function stopVideo(id,link) {
 //alert(link);
 if(link == 2){
   var slides = document.getElementById("youtube"+id).src;

 //  alert(slides);
  var video_id = 'youtube'+id;
  $("#"+video_id).prop('src','');

    $("#"+video_id).prop('src',slides);
 }
 else{
   var slides = document.getElementById("videoid"+id).src;
  var video_id2 = 'videofile'+id;
 var myPlayer = document.getElementById(video_id2);
 // alert(audio_id);
  // var myPlayer = document.getElementsByTagName('audio')[0];
    myPlayer.pause();
    myPlayer.src = '';
    myPlayer.src = slides;
       myPlayer.currentTime = 0;
}
  
  
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

</script>
<?php 
    $dateRateDef = $_POST['daterange']; 
    //echo "--gggggggggg"; die;
    $dateRateDefArr =explode('-', $dateRateDef);
    $startDatedef =trim($dateRateDefArr[0]);
    $endDatedef =trim($dateRateDefArr[1]);
?>
<script type="text/javascript">
$(function() {

    var start =  moment().subtract(2, 'years');
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
</script>
</html>