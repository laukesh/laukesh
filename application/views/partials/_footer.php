


  <?php 
if(!empty($logo_gallery)){?>
    </div>
    </div>
    <section class="foterSlider">
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <!--Carousel Wrapper-->
       <div class="footerSlider">

  <?php 
        foreach($logo_gallery as $value){
    ?>
  
   <a href="<?php echo $value->url;?>" alt="<?php echo $value->title;?>" class="external" target="_blank"><img src="<?php echo base_url().$value->path_small;?>" width="70" height="70" alt="<?php echo $value->title;?>" title ="<?php echo $value->title;?>"></a>
 <?php 
  }
  ?>
                </div>
            </div>
        </div>
      
    </section>

<?php
  }
  ?>
    <!----Footer Slider---->

    <!--Footer link-->

    <section class="footerlink importantLink">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <?php foreach($pages as $value){
                            //echo '====='.print_r($value);
                            ?>
                        <li>
                            <a href="<?php echo base_url().$value->slug;?>"><?php echo $value->title;?></a>
                        </li>
                        <?php }?>
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
                 <div class="col-md-7">
                    <div class="left-footer">
                        <p><span><?php echo $tran_lang['copyright'];?> @ <?php echo date('Y'); ?> </span>  <?php echo $tran_lang['contact_address'];?></p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="left-footer">
                        <p class="text-right"><span><?php echo $tran_lang['visitor_counter'];?>:</span> <?php //$page_id= !empty($this->uri->uri_string())?$this->uri->uri_string():1;
                         echo total_views()->views_count;?><span> |  <?php echo $tran_lang['last_update'];?> </span>
                         <?php echo date("d M Y", strtotime($visual_settings[0]->uploaded_date));?></p>
                    </div>  
                </div>
            </div>
        </div>
    </footer>
<!---footer-->

<!--Audio Play Section Modal for Video Play-->
<!-- Modal -->
<!--  <div class="modal fade" id="audioModal" tabindex="-1" role="dialog" aria-labelledby="audioModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <audio controls>
                    <source id="audioSrc" src="<?php echo base_url();?>assets-front/audio/audio.mp3" type="audio/mpeg">
                  </audio>
            </div>

        </div>
    </div>
</div> --> 
    
<!--Audio Play Section Modal for Video Play-->
</body>
<script>
function openModal() {
  document.getElementById("body_background1").style.display = "block";
  document.getElementById("myModalgallery").style.display = "block";
}


function closeModal(){
  document.getElementById("body_background1").style.display = "none";
  document.getElementById("myModalgallery").style.display = "none";

}

function stopAudio_index(id) {
  var audio_id = 'audiofile'+id;
  var myPlayer = document.getElementById(audio_id);

   myPlayer.pause();
   myPlayer.currentTime = 0;
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
  //alert(n);
  var slides = document.getElementsByClassName("mySlides");
  //alert('slidelenght '+slides.length);
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
          /* 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
        }
    }, cb);

     cb(start, end);

});
</script>

<script>var $affectedElements = $("div,ul,li,a,tr,td,th ,p,collapse,container,h3,h1,h2,span.someClass"); // Can be extended, ex. 

// Storing the original size in a data attribute so size can be reset
$affectedElements.each( function(){
  var $this = $(this);
  $this.data("orig-size", $this.css("font-size") );
});

$("#btn-increase").click(function(){
  changeFontSize(1);
})

$("#btn-decrease").click(function(){
  changeFontSize(-1);
})

$("#btn-orig").click(function(){
  $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , $this.data("orig-size") );
   });
})

function changeFontSize(direction){
    $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , parseInt($this.css("font-size"))+direction );
    });
}

</script>  
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
</html>