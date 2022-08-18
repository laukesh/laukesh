
<?php
$year     = $latest_sainik_samachar[0]->year;
$month    = $latest_sainik_samachar[0]->month;
$biweek   = $latest_sainik_samachar[0]->biweek_no;
$last_day ='';
?>
<div class="">
    <section class="latestPressRelease">
        <div class="container" id ="content">
           
            <div class="row">
                <div class="col-md-3 pr-0 animate__animated animate__fadeInLeft">
                    <h1 class="section-heading"><?php echo $tran_lang['latest_sainik_samachar'];?></h1>
                    <div class="card mt40 ">
                        <a href="<?php echo base_url('latest-sainik-samachar/').$latest_sainik_samachar[0]->id;?>">
                        <div class="card-body p-0">
                            <?php if($latest_sainik_samachar[0]->path_small)
                            {
                            ?>
                            <img class="card-img-top sainik_patrika_img" src="<?php echo base_url().$latest_sainik_samachar[0]->path_small;?>" alt="<?php echo $latest_sainik_samachar[0]->title;?>" title ="<?php echo $latest_sainik_samachar[0]->title;?>">
                          <?php 
                           }else{?>
                             <img class="card-img-top sainik_patrika_img" src="<?php echo base_url();?>assets-front/images/no-image.png"
                                alt="<?php echo $latest_sainik_samachar[0]->title;?>" title ="<?php echo $latest_sainik_samachar[0]->title;?>">
                            <?php
                             }
                             ?>
                             <div class="readbox">
                                <?php if($biweek==1){
                                    echo "1st-15th ".get_month_name($month)." ".$year;
                                    }
                                    else{
                                        if(get_month_last_day($month,$year)==31){
                                            $last_day_is=get_month_last_day($month,$year)."st";
                                        }
                                        else{
                                            $last_day_is=get_month_last_day($month,$year)."th";
                                        }
                                    echo "16th-".$last_day_is. " ".get_month_name($month)." ".$year;
                                    
                                    }
                                ?>&nbsp; <!-- <?php // echo $tran_lang['view'];?> -->
                             </div>   
                            
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-9 animate__animated animate__fadeInRight">
                     <h1 class="section-heading text-center"><?php echo $tran_lang['latest_press_release'];?></h1>
                  <a href="<?php echo base_url('press-realease-list');?>" class="viewAll"><?php echo $tran_lang['view_all'];?></a>
                    <!--Carousel Wrapper-->
                    <div id="press-slider" class="carousel slide carousel-multi-item" data-ride="carousel" data-interval="3000" pause ="hover">

                        <!--Controls-->
                        <div class="controls-top">
                            <a class="btn-floating" href="#press-slider" data-slide="prev">
                                <i class="fas fa-angle-left"></i></a>
                            <a class="btn-floating" href="#press-slider" data-slide="next"><i class="fas fa-angle-right"></i></a>
                        </div>
                        <!--/.Controls-->

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                      
                            <!--First slide-->

                            <div class="carousel-item active">

                                <div class="row">
                                     <?php 
                                   //  print_r($press_release);die;
                                       if(!empty($press_release))
                                       {
                                        foreach($press_release as $item){

                                        ?>
                                    <div class="col-md-4">
                                        <div class="card mb-2 mb-2_2 border_radius_20px">
                                             <?php if(empty($item->feature_image)){
                                                ?>
                                            <a href="<?php echo base_url('press-realease-details/').$item->id;?>"><img class="card-img-top border_imagee_20px" src="<?php echo base_url();?>assets-front/images/no-image.png"
                                                alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>"></a>
                                            <?php }else{?>
                                                <a href="<?php echo base_url('press-realease-details/').$item->id;?>"><img class="card-img-top border_imagee_20px" src="<?php echo base_url().html_escape($item->feature_image);?>"
                                                alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>"></a>
                                            <?php }?>
                                            <div class="card-body">
                                                <h4 class="card-title press_release_text"><?php echo $item->name;?></h4>
                                                <p class="card-text press_release_text"><?php echo $item->press_release_title;?></p>

                                                <a href="<?php echo base_url('press-realease-details/').$item->id;?>" class="readmore"><?php echo $tran_lang['read_more'];?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    //$i++;
                                    }
                                    }
                                    ?>
                                    
                                </div>

                            </div>

                             <div class="carousel-item">

                                <div class="row">
                                     <?php 
                                       if(!empty($press_release2))
                                       {
                                                                              
                                        foreach($press_release2 as $item){
                                        ?>
                                    <div class="col-md-4">
                                        <div class="card mb-2 mb-2_2 border_radius_20px">
                                               <?php if(empty($item->feature_image)){
                                                ?>
                                            <a href="<?php echo base_url('press-realease-details/').$item->id;?>"><img class="card-img-top border_imagee_20px" src="<?php echo base_url();?>assets-front/images/no-image.png"
                                                alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>"></a>
                                            <?php }else{?>
                                               <a href="<?php echo base_url('press-realease-details/').$item->id;?>"> <img class="card-img-top border_imagee_20px" src="<?php echo base_url().html_escape($item->feature_image);?>"
                                                alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>"></a>
                                            <?php }?>
                                            <div class="card-body">
                                                <h4 class="card-title press_release_text"><?php echo $item->name;?></h4>
                                                <p class="card-text press_release_text"><?php echo $item->press_release_title;?></p>
                                                <a href="<?php echo base_url('press-realease-details/').$item->id;?>" class="readmore"><?php echo $tran_lang['read_more'];?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                   // $i++;
                                    }
                                    }
                                    ?>
                                    
                                </div>

                            </div>
                           

                        </div>
                        <!--/.Slides-->

                    </div>
                    <!--/.Carousel Wrapper-->
                </div>
            </div>
        </div>
    </section>
    <!--Latest Press Release--->

    <!-- <div class="image_slider">
        <div class="image_slider_bg"></div>
            <div class="container">
                <div class="row">
                     <div class="col-md-12">
                        <img class="home_slider" src = "http://sainiksamachar.nic.in/beta_site/beta/uploads/press_release_image/Photo_212.jpeg" />
                    </div>

                </div>
            </div>
    </div> -->
  <!--Latest image slider-->
    <!-- <div id="carouselExampleControls" class="carousel slide socail-media-sec animate__animated animate__fadeInUp" data-ride="carousel">
     <div class="container">
  <div class="carousel-inner">
    <?php 
    $i = 1;
    foreach($latest_image as $value){?>
    <div class="carousel-item <?php if($i == 1){ echo 'active';}?>">
      <img class="d-block w-100" src="<?php echo base_url().$value->media_path;?>" width="300px" height="300px" alt="First slide">
    </div>
    <?php
    $i++;
    }
    ?>
   
</div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->

 <!--End Latest image slider-->

    <!--Socail Media Section start-->
        <div class="socail-media-sec animate__animated animate__fadeInUp">
            <div class="container">
                <div class="row">
                
                    <div class="col-md-4">
                        <div class="common-box">
                            <div class="d-flex justify-content-between">
                            <h3 class="width_88p"><?php echo $tran_lang['twitter'];?></h3>                           
                           <?php 
                                      // if(!empty($twitter_settings))
                                     //  {
                                                                              
                                      //  foreach($twitter_settings as $items11){
                                        ?>
                                        <!--  <h3 class="ss_twitter_head"><?php echo $items11->hdl;?></h3>-->
                                       <?php //}}?>
                               <!--Controls-->
                        <div class="controls-top">
                            <a class="btn-floating social_left" href="#socialfeedCarousel1" data-slide="prev">
                                <i class="fas fa-angle-left"></i></a>
                            <a class="btn-floating social_right" href="#socialfeedCarousel1" data-slide="next">
                                <i class="fas fa-angle-right"></i></a>
                        </div>
                        </div>
                        <!--/.Controls-->
                        
                            <div id="socialfeedCarousel1" class="carousel slide" data-ride="carouse1">
                            
                              <div class="carousel-inner">
                                   <?php 
                                       if(!empty($twitter_settings))
                                       {
                                         $i=1;                                     
                                        foreach($twitter_settings as $items){
                                        ?>
                                  <div class="carousel-item <?php if($i==1){?>active<?php }else{?><?php }?>">
                                    <a class="twitter-timeline" data-width="330" data-height="370" href="https://twitter.com/<?php echo $items->hdl;?>?ref_src=twsrc%5Etfw">Tweets by <?php echo $items->hdl;?></a> 
                                  </div>
                                     <?php $i++;}}?>    
                                 <!-- <div class="carousel-item ss_linkedin">
                                  <a class="twitter-timeline" data-width="320" data-height="260" href="https://twitter.com/PIB_India?ref_src=twsrc%5Etfw">Linkedin Feeds by PIB_India</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                  </div> 
                                   <div class="carousel-item ss_twitter">
                                    <a class="twitter-timeline" data-width="320" data-height="260" href="https://twitter.com/PIB_India?ref_src=twsrc%5Etfw">Tweets by PIB_India</a> 
                                  </div>-->
                                </div>
                                                            
                              </div>
                                
                              
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="common-box">
                            <div class="d-flex justify-content-between gap">
                            
                               <!--Controls-->
                        <!-- <div class="controls-top arrow">
                            <a class="btn-floating social_left" href="#socialfeedCarousel" data-slide="prev" >
                                <i class="fas fa-angle-left"></i></a>
                            <a class="btn-floating social_right" href="#socialfeedCarousel" data-slide="next">
                                <i class="fas fa-angle-right"></i></a>
                              
                        </div> -->
                        </div>
                        <!--/.Controls-->
                            <div id="socialfeedCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item ss_facebook active">
                                  <h3 class=""><?php echo $tran_lang['Facebook'];?></h3>
                                  
                                  
                                   <?php 
                                       if(!empty($facebook_settings))
                                       {
                                                                              
                                        foreach($facebook_settings as $itemss){
                                            $facebook_href=$itemss->api;
                                       }}
                                       else
                                       {
                                          $facebook_href=''; 
                                       }
                                        ?>
                                    <iframe name="f21208a877b4178" width="350px" height="335px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.3/plugins/page.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df10d265bb5e618c%26domain%3Dpib.gov.in%26origin%3Dhttps%253A%252F%252Fpib.gov.in%252Ff1ab8bad6beb028%26relation%3Dparent.parent&amp;container_width=330&amp;height=335&amp;hide_cover=false&amp;href=<?php echo $facebook_href;?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=false&amp;show_posts=true&amp;width=400" class=""></iframe>
                                  </div>
                                  
                                 <!-- <div class="carousel-item ss_insta">
                                  <h3 class=""><?php echo $tran_lang['Instagram'];?></h3>
                                  <a class="twitter-timeline" data-width="320" data-height="260" href="https://twitter.com/PIB_India?ref_src=twsrc%5Etfw">Insta Stories by PIB_India</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                  </div>   
                                   <div class="carousel-item ss_linkedin">
                                    <h3 class=""><?php echo $tran_lang['Linkedin'];?></h3>
                                  <a class="twitter-timeline" data-width="320" data-height="260" href="https://twitter.com/PIB_India?ref_src=twsrc%5Etfw">Linkedin Feeds by PIB_India</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                          
                                  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                  </div>-->  
                                </div>                               
                              </div>
                        </div>
                    </div>

                    
                    
                    
                       <div class="col-md-4">
                        <div class="common-box">                            
                        <!--/.Controls-->
                            <div id="socialfeedCarousel3" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item ss_facebook active">
                                  <h3 class=""><?php echo $tran_lang['Youtube'];?></h3>
                                    <div class="card mb-2 mb-2_2">
                                      <div class="vidiobox">
                                <!-- <a href="javascript:void(0)" class="openVideoModal" data-toggle="modal" data-src="https://www.youtube.com/embed/QMiRry1m34w&t=2s" data-target="#videoModal"><img src="<?php echo base_url();?>assets-front/images/vidios_thumbnail.jpg" alt="video"></a> -->
                               <?php if(!empty($youtube_settings)){
                                   foreach($youtube_settings as $rowd)
                                   {
                                   ?>

                               <iframe id="vid_frame" style="width:100%; height:330px" src="<?php echo $rowd->api;?>" frameborder="0" allowfullscreen=""></iframe>
                               
                               <?php }}?>



                               </div>
                                    </div> 
                                  </div>                                  
                                  </div>  
                                   
                                </div>                               
                              </div>
                        </div>
                    </div>         
                </div>
            </div>
     </div>
      
    <!--Socail Media Section End-->

    <!--Video Photo Section-->
        <section class="videoPhoto" style="display: none;">
            <div class="container bg_white videos_sections_class">
                <div class="row">
                    <div class="col-md-4">
                             <div class="common-box photos photos_mb">
                            <h2><?php echo $tran_lang['videos'];?></h2>
                            <div class="innerbg1">
                            <div id="gallerySlider_video"  class="carousel slide" data-interval="false" data-ride="carousel">
                                <div class="carousel-inner">
                            <?php if(!empty($youtube_video)){
                                $i=1;
                                $j=1;
                                $k=1;
                                foreach($youtube_video as $item){
                                ?>
                                  <div class="carousel-item <?php if($i == 1){ echo 'active';}else{ echo ''; } ?>">
                                    <?php if(!empty($item->link == 1))
                                    {?>
                                        <video class="home_videos" id="home_video<?php echo $j;?>" controls>
                                      <source id="home_video_id<?php echo $j;?>" src="<?php echo base_url() . html_escape($item->path_video); ?>" alt="gallery image">
                                    </video>
                                    <?php
                                    $j++;
                                    }else{
                                    ?>
                                      <iframe id="vid_frame<?php echo $k;?>" style="width:100%; height:235px" src="<?php echo $item->youtube_link;?>" frameborder="0" allowfullscreen=""></iframe>
                                    
                                 <?php
                                 $k++;
                                  }?>
                                    <div class="overlay photo_text"><?php echo $item->title;?></div>
                                  </div>
                              <?php 
                              $i++;
                              }
                              }
                              ?>
                                 
                                </div>
                                <a class="carousel-control-prev arrow_bg_black" href="#gallerySlider_video" onclick="stopVideo2();" role="button" data-slide="prev">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                                <a class="carousel-control-next arrow_bg_black" href="#gallerySlider_video" onclick="stopVideo2();" role="button" data-slide="next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                              </div>
                              <a href="<?php echo base_url('video-list');?>" class="viewAll pull-right">
                                <?php echo $tran_lang['view_all'];?></a>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="common-box radios">
                            <h2><?php echo $tran_lang['radio_programs'];?></h2>
                            <div class="innerbg">
                            <ul>
                            <?php 
                            foreach($audio as $item){
                             //echo '<pre>';print_r($item->title);
                              ?>
                                <a href="" data-id="<?php echo $item->id;?>" class="openAudioModal" data-toggle="modal" data-target="#audioModal<?php echo $item->id;?>">
                                <li class="d-flex">
                                <div class="icon">

                                <img src="<?php echo base_url();?>assets-front/images/audio_icon.png" alt="audio">


                                </div>
                                <div class="audio-content audio_text">
                                <p class="audio_text"><?php echo $item->title?></p>
                                </div>
                                </li>
                                </a>
                                    <div class="modal fade" style="background: 
      rgba(0,0,0,0.5);" id="audioModal<?php echo $item->id;?>" tabindex="-1" role="dialog" aria-labelledby="audioModal" aria-hidden="true">

      <div class="modal-dialog">
          <div class="modal-content">
                           
              <div class="modal-body text-center">
                  <button type="button" onclick="stopAudio_index(this.id);" id="<?php echo $item->id;?>" class="close close_audio" data-dismiss="modal" aria-label="Close">
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
                                ?>
                            </ul>
                            <a href="<?php echo base_url('audio-list');?>" class="viewAll pull-right"><?php echo $tran_lang['view_all'];?></a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="common-box photos photos_mb">
                            <h2><?php echo $tran_lang['photos'];?></h2>
                            <div class="innerbg1">
                            <div id="gallerySlider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                            <?php if(!empty($photo)){
                                $i=1;
                                foreach($photo as $item){
                                    //print_r($item);
                                ?>
                                  <div class="carousel-item <?php if($i == 1){ echo 'active';}else{ echo ''; } ?>">
                                    <?php if(!empty($item->media_path)){?>
                                    <img class="d-block w-100" src="<?php echo base_url() . html_escape($item->media_path); ?>" alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>" height="240px;" width="300px;">
                                    <?php
                                    }else{
                                    ?>
                                     <img class="d-block w-100" src="<?php echo base_url();?>assets-front/images/no-image.png" alt="<?php echo $item->press_release_title;?>" title ="<?php echo $item->press_release_title;?>" height="240px;" width="300px;">
                                 <?php }?>
                                    <div class="overlay photo_text"><?php echo $item->press_release_title;?></div>
                                  </div>
                              <?php 
                              $i++;
                              }
                              }
                              ?>
                                 
                                </div>
                                <a class="carousel-control-prev arrow_bg_black" href="#gallerySlider" role="button" data-slide="prev">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                                <a class="carousel-control-next arrow_bg_black" href="#gallerySlider" role="button" data-slide="next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                              </div>
                              <a href="<?php echo base_url('photo-list');?>" class="viewAll pull-right">
                                <?php echo $tran_lang['view_all'];?></a>
                              </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">&nbsp;
            </div>
        </section>
    <!--Video Photo Section-->

    <!---important Link--->
        <!-- <section class="importantLink">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3><?php echo $tran_lang['archives'];?></h3>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-md-12">
                        <div class="common-box">
                            <div class="heading">
                            <?php echo $tran_lang['archives'];?>
                            </div>
                            <div class="icon">
                              <a href="<?php echo base_url('archive-list');?>"><img src="<?php echo base_url();?>assets-front/images/archive_icon.png" alt="Archive"></a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section> -->
    <!---important Link--->

    <!----Footer Slider---->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="width:100%">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Important Information</h5>
        </div>
        <div class="modal-body">
      <!--   <h5 class="modal-title" id="exampleModalLongTitle">Sainik Patrika Description</h5> -->
      <?php if($visual_settings_home_popup[0]->imgstatus==1){?>
      <img class="d-block w-100" src="<?php echo base_url().$visual_settings_home_popup[0]->home_popup_image;?>" height="500px" alt="First slide"></br></br>
      
       <?php }?>

      
        <?php echo $visual_settings_home_popup[0]->description;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function stopVideo2() {
     
        for (var i = 1;  i <= 3; i++){

        if(document.getElementById("vid_frame"+i)){
            var slides = document.getElementById("vid_frame"+i).src;        
           // alert('iframe');
             var video_id = 'vid_frame'+i;
             $("#"+video_id).prop('src','');
             $("#"+video_id).prop('src',slides);
         }
        
        if(document.getElementById("home_video_id"+i)){
        // alert('no iframe');
        var slides2 = document.getElementById("home_video_id"+i).src;
        var video_id2 = 'home_video'+i;
        var myPlayer = document.getElementById(video_id2);       
        myPlayer.pause();
        myPlayer.src = '';
        myPlayer.src = slides2;
        myPlayer.currentTime = 0;
        }
    }
}

$(window).scroll(function() {    
    var scroll = $(window).height();

     //>=, not <=
    if (scroll >= 400) {
        //clearHeader, not clearheader - caps H
         //$("div.videoPhoto").css("display","block");
        $(".videoPhoto").addClass("display_block");
        $(".videoPhoto").addClass("animate__animated");
        $(".videoPhoto").addClass("animate__fadeInUp");
       
    }
}); //missing );

</script>
<script type="text/javascript">
    $(window).on('load', function() {
       <?php if($visual_settings_home_popup[0]->status == 1){?>
         $('#exampleModalLong').modal('show');
       <?php } ?>
    });
</script>