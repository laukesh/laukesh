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
        url: "<?php echo base_url();?>home_controller/audio_list_ajax",
        data: {page: page,
               audio_category_id:cate_name,
                daterange:daterange,
                title:search_value},
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(data){
          //alert(data);
            $('.loader_css').hide();
            $('#audio_list').html(data);
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
                 "audio_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };

         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/audio_list_ajax',
            data: data,
            success: function (response){
                 $('.loader_css').hide();
              if(response != 0){
                $("#audio_list").html(response);        
               }else{
                
              $("#audio_list").html('<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong><?php echo $tran_lang['data_not_found'];?></strong></p></div>');
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
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('archive-list');?>"><?php echo $tran_lang['archives'];?></a></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['raidio_programs'];?></li>
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
  <?php foreach ($audio_categories as $item){?>
    <option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
  <?php } ?> 
   
           
</select>
</div>
<div class="col-md-3">
<input type="hidden" name="daterange" id="daterange" class="reportrange"  value=""/>

<div class="input_date_bg reportrange" ><?php echo $tran_lang['date'];?>
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>

</div>
<div class="col-md-3"><input type="text"  name="search" id="search_value" class="search_textbox" placeholder="<?php echo $tran_lang['caption'].','.$tran_lang['keywords'];?>" 
  value=""></div>
<div class="col-md-2">
<button type="submit" class="btn-search" name="search2" id="search_value" value=""><?php echo $tran_lang['search'];?></button>
</div>
  </form>

</div>
</div>
</div>

 </div>  
 </section> 
  
  <!--start box gallery-->
  <div class="container">
    <div class="row mt-3" id="audio_list">
<?php if(!empty($audio)){
     foreach($audio as $item){

        $s = strtotime($item->created_at);
    $date_var = date('d/m/Y', $s);
      ?>
  <div class="col-md-4">
   <div class="card mb-2">
   <div class="radios">
   
            <ul>
            <a href="" data-id="<?php echo $item->id;?>"  class="openAudioModal" data-toggle="modal" data-target="#audioModal<?php echo $item->id;?>">
            <li class="d-flex">
            <div class="icon">

            <img src="<?php echo base_url();?>assets-front/images/audio_icon.png" alt="audio">


            </div>

            <div class="audio-content">
            <h3><?php echo $item->title;?></h3>
            <!-- <p><?php // echo $date_var; ?></p> -->

            </div>
            </li> </a>
            </ul>
            </div>
            <!--   <div class="share">
             <div class="row">
             <div class="col-md-4"></div>
             <div class="col-md-4"></div>
             <div class="col-md-4"> <i class="fas fa-download"></i> <a href="<?php echo base_url('audio-list/').$item->id;?>" class="readmore">Download</a></div>
             </div>
             </div> -->
             </div>
        
    </div>

    <div class="modal fade" style="background: 
    rgba(0,0,0,0.5);" id="audioModal<?php echo $item->id;?>" tabindex="-1" role="dialog" aria-labelledby="audioModal" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
                         
            <div class="modal-body text-center">
                <button type="button" onclick="stopAudio(this.id);" id="<?php echo $item->id;?>" class="close close_audio" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" id="audioModal<?php echo $item->id;?>">&times;
                      

                    </span>

                </button>

                <audio id = "audiofile<?php echo $item->id;?>"= controls>
                    <source id="audioSrc" src="<?php echo base_url(); echo $item->path_audio;?> " type="audio/mpeg">
                  </audio>
            </div>
        </div>
    </div>
</div>
       <?php
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
  </div>
  <div class="col-md-12 pagination" id="page_link">
<?php echo $links; ?>
</div>
</div>
  


<!--Audio Play Section Modal for Video Play-->
<script>
function openModal() {
  document.getElementById("myModalgallery").style.display = "block";
}

function stopAudio(id) {
  var audio_id = 'audiofile'+id;
  var myPlayer = document.getElementById(audio_id);
 // alert(audio_id);
  // var myPlayer = document.getElementsByTagName('audio')[0];
    myPlayer.pause();
   myPlayer.currentTime = 0;
}


function closeModal(){
  document.getElementById("myModalgallery").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function stopAudio(id) {
  var audio_id = 'audiofile'+id;
  var myPlayer = document.getElementById(audio_id);

   myPlayer.pause();
   myPlayer.currentTime = 0;
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
      //alert(start);
    <?php
    #print_r($_POST['daterange']); 
    if(isset($dateRateDef) && $startDatedef !='' && $startDatedef !='10/11/2021'){
    ?>

      var start1 = '<?php echo $startDatedef; ?>';
      var end1 = '<?php   echo $endDatedef; ?>';
       //alert(start1);
      $('.reportrange span').html(start1 + ' - ' + end1);
      $('.reportrange').val(start1 + ' - ' + end1);
      
    <?php }else { ?>
      
      $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('.reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

    <?php } ?>
       
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