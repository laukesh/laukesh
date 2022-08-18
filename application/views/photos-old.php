
<script>
$(document).ready(function (){
$("#searchForm").submit(function(event) {
  event.preventDefault();
   var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val();
    var data = {
                 "gallery_category_id":cate_name,
                 "daterange":daterange,
                 "title":search_value
                };
 $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");  
         $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>home_controller/photos_list_ajax',
            data: data,
            success: function (response){
           $('.loader_css').hide();
              if(response != 0){
                $("#list_photo").html(response);        
               }else{
                
              $("#list_photo").html('<div class="danger_message col-md-4" style="background-color: #ffdddd; margin-bottom: 40px;padding: 10px 12px; margin-top:40px; text-align:center; left: 356px"><p><strong>Photo List! &nbsp;&nbsp;</strong>Data Not Available</p></div>');
                 }
              }
        });
});
});
</script>
<script>
function getData(page){
//alert('dfdsfdfs0'); 
  var cate_name    = $('#cate_name').val();
   var daterange    = $('#daterange').val();
   var search_value = $('#search_value').val(); 

  $('body').prepend("<div class='loader_css' style='display:block'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div>");   
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>home_controller/photos_list_ajax",
        data:{page:page,
               gallery_category_id:cate_name,
               daterange:daterange,
               title:search_value},
        success: function(data){
            $('.loader_css').hide();
            $('#list_photo').html(data);
        }
    });
}
</script>

<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">What's New</a></li>
    <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
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
  <option value="">All Category</option>
  <?php foreach ($photo_categories as $item){?>
    <option value="<?php echo $item->id;?>"<?php echo ($item->id == $_POST['cate_name']) ? 'selected' : ''; ?>><?php echo $item->name;?></option>
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

<div class="col-md-3"><input type="search" id="search_value" name="search_value" class="search_textbox" placeholder="caption, keywords to search" value=""></div>

<div class="col-md-1">
<button type="submit" class="btn-search" name="search" id="search_value" value="">Search</button>
<input type="hidden" name="sflag" value="0" class="sflag">
</div>
<div class="col-md-1"></div>
<div class="col-md-2">
<button type="button" class="archived1">Archives</button>
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
 <div class="col-md-12" ><h1 class="media-heading">Photos<br><span class="media-heading-sub">for Photos beyond 15 days, see "Media->Photos or Archives" </span></h1>
 </div>

 </div>
  <div class="row mt-3" id="list_photo">

<?php if(!empty($photo)){
     foreach($photo as $item){
       $d = date_create($item->updated_at);
      //echo $d->format('d-m-yyyy');
      ?>
          <div class="col-md-4">
          <div class="card mb-2">
          <div class="column">
          <img src="<?php echo base_url() . html_escape($item->path_small); ?>" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
          </div>
          <div class="row ml">
          <div class="col-md-12"><p class="card-text"> <?php echo $item->title.", Updated on - ".$d->format('d/m/Y'); ?></p></div>
          </div>
          <div class="share">
          <div class="row">
          <div class="col-md-4"> <i class="fas fa-share-alt"></i> <a href="#" class="readmore">Share</a></div>
          <div class="col-md-4"></div>
          <div class="col-md-4"> <i class="fas fa-download"></i><a href="<?php echo base_url('photo-list-image/').$item->id;?>" class="readmore">Download</a></div>
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
  <p><strong>Photo List! &nbsp;&nbsp;</strong>Sorry... !!! There is no data found &nbsp;&nbsp;</p>
</div>

<?php
}
?>
<ul class="pagination" id="page_link">
<?php echo $links; ?>
</ul>
  </div>

  <div id="myModalgallery" class="modal modal_pic">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

<?php 
$count = count($photo);
if(!empty($photo)){
    $i =1;
     foreach($photo as $item){
      ?>
  
    <div class="mySlides">
      <div class="numbertext"><?php echo $i; ?> / <?php echo $count;?></div>
      <img src="<?php echo base_url() . html_escape($item->path_small); ?>" style="width:100%" alt="">
      <p class="photo-title">Swarnim Vijay Mashal welcomed by Sarla Battalion at Generals War Memorial, Jhullas, taken to the house of Veer Nari Gurucharan Kaur w/o Sub (Late) Seva Singh (11 JAK LI) who made supreme sacrifice on December 4, 1971 in defence of Poonch.</p>
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
 <!--pagination start here--> 

<section class="foterSlider">
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <!--Carousel Wrapper-->
 <div class="footerSlider">
       
  <img src="<?php echo base_url().$logo_gallery[0]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[1]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[2]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[3]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[4]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[5]->path_small;?>" width="70" height="70" alt="press release pic">
   <img src="<?php echo base_url().$logo_gallery[6]->path_small;?>" width="70" height="70" alt="press release pic">

 
    <!--/.Carousel Wrapper-->
                </div>
            </div>
        </div>
      
    </section>
    <!----Footer Slider---->

    <!--Footer link-->

    <section class="footerlink">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <a href="#">Website Policies</a>
                        </li>
                        <li>
                            <a href="#">Terms & Conditions </a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#">Feedback</a>
                        </li>
                        <li>
                            <a href="#">Message of ministry</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!--Footer link-->

<!---footer-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-footer">
                        <p><span>Copyright @2020</span>  Ministry of Defence L-1 Block, Church Road,   New Delhi-110001</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-footer">
                        <p class="text-right"><span>Visitor Counter:</span> 102439   <span>Updated On:</span>  24 May 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!---footer-->

<!--Audio Play Section Modal for Video Play-->
<!-- Modal -->
<div class="modal fade" id="audioModal" tabindex="-1" role="dialog" aria-labelledby="audioModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <audio controls>
                    <source id="audioSrc" src="<?php echo base_url();?>assets-front/audio/audio.mp3" type="audio/mpeg">
                  </audio>
            </div>

        </div>
    </div>
</div>
    
<!--Audio Play Section Modal for Video Play-->
</body>
<script>
function openModal() {
  document.getElementById("myModalgallery").style.display = "block";
}

function closeModal() {
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

<script type="text/javascript">
$(function() {
  
    var start = moment();
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
    $(".applyBtn").on("click", function(){
      $('.sflag').val('0');
    });


});
</script>
</html>


  