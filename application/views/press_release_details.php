
    <!---Header End from here--->
   <div class="container">
 <div class="float-right mt-2" onclick="window.print()"><i class="fas fa-print"></i></div>  </div>  
  <div class="clearfix"></div>
<!--middle section start here-->
<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('press-realease-list');?>"><?php echo html_escape($press_release_details[0]->name);?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo html_escape($press_release_details[0]->press_release_title);?></li>
  </ol>
</nav>
<?php if($press_release_details[0]->translated_id){?>
    <!-- <div class="lang_selector">
        <ul>
            <li>Read this press release in other language(s) : </li> 
            <li><a href="#">Hindi ,</a></li> 
            <li><a href="#">Assames ,</a></li> 
            <li><a href="#">Bengali ,</a></li> 
            <li><a href="#">Gokhali ,</a></li> 
            <li><a href="#">Kannada ,</a></li> 
            <li><a href="#">Malayalam ,</a></li> 
            <li><a href="#">Marathi ,</a></li> 
            <li><a href="#">Telugu ,</a></li> 
            <li><a href="#">Oriya ,</a></li> 
            <li><a href="#">Punjabi ,</a></li> 
            <li><a href="#">Tamil</a></li>
            <li><a href="#">Urdu</a></li>
        </ul>
    </div>  --> 
    <?php
    }
    ?> 
</div>
</div>
</div>

 





 </div> 
 </section> 
  
  
  <!--start box gallery-->
  <div class="container">
  <div class="row mt-3">
   <div class="col-md-12">
   <div class="card mb-2">
   <div class="radios">
              <div class="press-content">
             <div class="row">
             <div class="col-md-12">
             <h4 class="text-center"><strong><?php echo html_escape($press_release_details[0]->press_release_title);?></strong></h4><hr>
              <blockquote class="blockquote blockquoteDiv text-center">
   
  <div class="blockquote-footer mb-2">Posted On: <?php $d = date_create($press_release_details[0]->approved_at); echo $d->format('d/m/Y h:i:A');?>

    <cite title="Source Title"><?php echo html_escape($press_release_details[0]->name);?></cite></div>
          <div class="col-md-12 p-0">
            <?php if(!empty($press_release_details[0]->feature_image)){ ?>
          <img class="width_auto max_width_100p" src="<?php echo base_url().html_escape($press_release_details[0]->feature_image);?>" class="img-fluid img-thumbnail max_height450p">
          <?php } else{ echo "";}?>
            </div>
</blockquote>
     
<div class="pr_content">
   <h4 class="pr"><?php echo $press_release_details[0]->press_release_title;?>
  </h4>
</div>
</br>

         <div class="col-md-12 text-center mt-4 ">
        <h2 class="text-center mt-4 "><b>***</b></h2>
              </div> </br>
         <div class="container">
          <?php
    if(!empty($press_release_photos)){?>
   <div class="alert alert-secondary" role="alert">
   Photos
</div>
  <div class="row mt-3">
    <?php 
    foreach ($press_release_photos as $item){ 
    //$d = date_create($item->updated_at); 
    ?>
   <div class="col-md-4">
   <div class="card mb-2">
    <div class="column">
    <img src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor ">
  </div>

             <div class="row ml">
             <div class="col-md-12"><p class="card-text"><?php echo $item->caption; ?></p></div>
             
             </div>
             
             
             </div>
        
    </div>
    <?php 
    }
    
  ?>
  </div>
   <?php   
   }
  ?>
  
  <div id="myModalgallery" class="modal modal_pic">
  <span class="close cursor" onclick="closeModal()">×</span>
  <div class="modal-content">
     <?php 
    if(!empty($press_release_photos)){
      $count = count($press_release_photos);
      $i =1;
    foreach ($press_release_photos as $item){ 
    $d = date_create($item->updated_at); 
    ?>
    <div class="mySlides" style="display: block;">
      <div class="numbertext"><?php echo $i; ?> / <?php echo $count;?></div>
      <img src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" alt="">
      <p class="photo-title"><?php echo $item->caption;?></p>
    </div>
 <?php 
 $i++;
    }
    }
  ?>
    <a class="prev1" onclick="plusSlides(-1)">❮</a>
    <a class="next1" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    
  </div>
</div>

  
  </div>

  <div class="container">
     <?php 
    if(!empty($press_release_infographic)){?>
   <div class="alert alert-secondary" role="alert">
   Infographics
</div>
  <div class="row mt-3">
    <?php 
    if(!empty($press_release_infographic)){
    foreach ($press_release_infographic as $item){ 
    $d = date_create($item->updated_at); 
    ?>
   <div class="col-md-4">
   <div class="card mb-2">
    <div class="column">
    <img src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
  </div>

             <div class="row ml">
             <div class="col-md-12"><p class="card-text"><?php echo $item->caption; ?></p></div>
             
             </div>
             
             
             </div>
        
    </div>
    <?php
  }
}
?>


  </div>
  <?php
}
?>

   
  
  <div id="myModalgallery" class="modal modal_pic">
  <span class="close cursor" onclick="closeModal()">×</span>
  <div class="modal-content">
<?php 
    if(!empty($press_release_infographic)){
      $count = count($press_release_infographic);
      $i =1;
    foreach ($press_release_infographic as $item){ 
    $d = date_create($item->updated_at); 
    ?>
    <div class="mySlides" style="display: block;">
      <div class="numbertext"><?php echo $i; ?> / <?php echo $count;?></div>
      <img src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" alt="">
      <p class="photo-title"><?php echo $item->caption;?></p>
    </div>
<?php 
 $i++;
    }
    }
  ?>
    <a class="prev1" onclick="plusSlides(-1)">❮</a>
    <a class="next1" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    
  </div>
</div>

  
  </div>
         
<div class="container">
    <?php 
    if(!empty($press_release_video)){?>
   <div class="alert alert-secondary" role="alert">
  Videos
</div>
   <div class="row mt-3">
   <?php 
    if(!empty($press_release_video)){
    foreach ($press_release_video as $item){ 
    $d = date_create($item->updated_at); 
    ?>
   <div class="col-md-4">
   <div class="card mb-2">
    <div class="column">
       <video width="320" height="240" controls>
    <source src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor"></video>
  </div>

             <div class="row ml">
             <div class="col-md-12"><p class="card-text"><?php echo $item->caption; ?></p></div>
             
             </div>
             
             
             </div>
        
    </div>
    <?php
  }
}
?>
</div>
<?php
}
?>

   
  
  <div id="myModalgallery" class="modal modal_pic">
  <span class="close cursor" onclick="closeModal()">×</span>
  <div class="modal-content">
<?php 
    if(!empty($press_release_video)){
      $count = count($press_release_video);
      $i =1;
    foreach ($press_release_infographic as $item){ 
    $d = date_create($item->updated_at); 
    ?>
    <div class="mySlides" style="display: block;">
      <div class="numbertext"><?php echo $i; ?> / <?php echo $count;?></div>
      <img src="<?php echo base_url() . html_escape($item->media_path); ?>" style="width:100%" alt="">
      <p class="photo-title"><?php echo $item->caption;?></p>
    </div>
<?php 
 $i++;
    }
    }
  ?>

    <a class="prev1" onclick="plusSlides(-1)">❮</a>
    <a class="next1" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
      <p id="caption"></p>
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
</div>


 