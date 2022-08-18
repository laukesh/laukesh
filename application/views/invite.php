 <?php 
 /*print_r($invite);
 die();*/
 $d = date_create($invite[0]->created_at);
 $currentDateTime = $invite[0]->created_at;
$newDateTime = date('h:i A', strtotime($currentDateTime));

$d2 = date_create($invite[0]->date_of_event);
 $currentDateTime2 = $invite[0]->date_of_event;
$newDateTime2 = date('h:i A', strtotime($currentDateTime2));
  ?>
    <!---Header End from here--->
<!--middle section start here-->
<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#">What's New</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('media-invite-list');?>">Media Invite</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invitation Detail</li>
  </ol>
</nav>
</div>
</div>
</div>

 </div> 
 </section> 
  
  <!--start box gallery-->
  <div class="container">

 <div class="row">
 <div class="col-md-12">
 <div class="media-heading-invite">
 <div class="row">
 <div class="col-md-9" ><h1 class="media-heading1">Media Invitation By : <span class="italic"><?php echo $invite[0]->name;?></span></h1></div>
<div class="col-md-3"> 
  <?php $d = date_create($invite[0]->created_at);
  $d2 = date_create($invite[0]->date_of_event);

// $currentDateTime = $invite[0]->created_at);
// echo $newDateTime = date('h:i A', strtotime($currentDateTime));
  ?>
 <span class="invite-date1"><strong>Posted on : </strong><?php echo $d->format('d/m/Y').' | '.$newDateTime;?> </span>
 </div>
</div>
</div>
</div>

 </div>
 


 
 <div class="row mt-2">
 <div class="col-md-12"> 
 <div class="invite_bg1 bg-light text-dark">
 <div class="row"> 
 
  <div class="col-md-12">
  <div class="row"> 
  <div class="col-md-9">
  <strong>Dear Sir/Ma’am,</strong>	<br/>	
You are cordially invited to the following event : 
  </div>
  <div class="col-md-3">
  <span class="invite-date"><strong> Event Date : </strong><?php echo $d2->format('d/m/Y H:i A');?></span>
  </div>
  </div>
  </div> 

 <div class="col-md-12">
 <div class="invie_row">
 <div class="row">
 
 <div class="col-md-12">
 <div class="invite_box1">
 <div class="row">
 <div class="col-md-12">
 <div class="row mt-2">
 <div class="col-md-12"><div class="inv-heading"><span class="dot"></span> &#8212;  <?php echo $invite[0]->title;?> &#8212; <span class="dot"></span> </div></div></div>
 <div class="row mt-2">
 <div class="col-md-12">
 <p><span class="italic2"><?php echo $invite[0]->description;?></span></p></div></div>
 
 </div>
 </div>

 </div></div>

 </div>
  
 <div class="row">
 
 <div class="col-md-12">
 <div class="invite_box1">
 <div class="row">
 <div class="col-md-12">
 <div class="row mt-2">
 <div class="col-md-12"><div class="inv-heading"><span class="dot"></span> &#8212;  Venue Details &#8212; <span class="dot"></span> </div></div></div>
 <div class="row mt-2">
 <div class="col-md-12">

 <span class="italic2"><span class="italic2"><?php echo $invite[0]->venue_event;?> </span></div></div>
 
 </div>
 </div>

 </div></div>

 </div>
 
 <div class="row">
 
 <div class="col-md-12">
 <div class="invite_box1">
 <div class="row">
 <div class="col-md-12">
 <div class="row mt-2">
 <div class="col-md-12"><div class="inv-heading"><span class="dot"></span> &#8212; Timing &#8212; <span class="dot"></span> </div></div></div>
 <div class="row mt-2">
 <div class="col-md-12">
<!-- <span class="italic1">on</span><br>-->
 <span class="italic2"><?php echo $d2->format('d/m/Y').' , '.$newDateTime2;?> </span></div></div>
 
 </div>
 </div>

 </div></div>

 </div>
  
 <div class="row">
 
 <div class="col-md-12">
 <div class="invite_box1">
 <div class="row">
 <div class="col-md-12">
 <div class="row mt-2">
 <div class="col-md-12"><div class="inv-heading"><span class="dot"></span> &#8212; Media Instruction &#8212; <span class="dot"></span> </div></div></div>
 <div class="row mt-2">
 <div class="col-md-12">
 <?php echo $invite[0]->remark;?> </span></div></div>
 
 </div>
 </div>

 </div></div>

 </div>
  
  
  
 </div>
 
 </div>
 </div>
 
 
 
  <div class="row mt-3">
 <div class="col-md-8">
 <div class="note">
 <span class="note1" >Invited Media list : </span> <?php echo $invite[0]->invitees;?>
 </div>
 </div>
 <div class="col-md-4">
 <div class="note">
<span class="note2"><strong>Contact Details - </strong></br>
  <strong> Name : </strong><?php echo $invite[0]->firstname." ".$invite[0]->lastname ;?></br>
  <strong> Phone : </strong><?php echo $invite[0]->mobile;?>
</span>
 </div>
 </div>
 </div>
 
 </div>
 
 <div class="row mt-3">
 <div class="col-md-12">
 <div class="last-media">
 <div class="row">
 <div class="col-md-9"></div>
 <div class="col-md-3">
 <span class="last-media-hd">Yours faithfully</span> <br>
 (PRO <?php echo $invite[0]->name;?>)
 </div></div>





 </div>
 </div>
 </div>
 
 
 
 
 
 </div>
 
 
  
 
 
 
 
 
 
 </div>
 
 
 
 
 
 

 
 
  
  </div>
  
  

  
  
  
    
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
 