
  <!--start box gallery-->
  <div class="container">
  <div class="row mt-3">

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
          <div class="col-md-4"> <i class="fas fa-download"></i> <a href="#" class="readmore">Download</a></div>
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
  <p><strong>There is no data found for the selected filter(s), Please change and try some other selection to view data</strong></p>
</div>
<?php
}
  ?>
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
<div class="container">
<div class="row mt-5">
<div class="col-md-12">
<div class="pagination_top">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-9">
Page Size: 
<select id="states" class="page_dropdown">
	 <option selected>10</option>
		    <option>20</a></option>
		    <option>30</option>
		    <option>40</option>
		    <option>50</option>
</select>
<!-- <span> Total Records :- 1100</span> -->
</div>
<div class="col-md-3 float-right">
 <?php echo $this->pagination->create_links(); ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>