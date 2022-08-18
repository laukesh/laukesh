
<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $tran_lang['sainik_samachar'];?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/photo-video-gallery.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/responsive.css">
<!--   <link rel="stylesheet" href="https-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/slick.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets-front/css/slick-theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="<?php echo base_url();?>assets-front/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets-front/js/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<script src="<?php echo base_url();?>assets-front/js/popper.min.js"></script>

<!--bottom slider-->
<script src="<?php echo base_url();?>assets-front/js/slick.js"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets-front/js/custom.js"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets-front/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets-front/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-front/css/daterangepicker.css" />
</head>

<body>
    <div class="body_background" id="body_background1"style="display:none"></div>
    <!---Header Start from here--->
    <header>
    
          
                <div class="header-bottom">
                    
                   <div class="container">
                    <div class="row">
                    
                            <div class="col-md-6"></div>
                   <div class="col-md-4"> <div class="skip_screenreader">
                                <ul class="is-flex mobile">
                                    <li class="space"><a title="Skip Navigation" alt ="Skip Navigation" href="#content">
                                  <?php echo $tran_lang['skip_navigation'];?></a></li>
                                    &ndash;<li class="space">|</li>  &ndash;
                                    <li class="space"><a  title="Screen Reader Access" alt ="Screen Reader Access" href="screen-header-access"><?php echo $tran_lang['screen_reader_access'];?></a></li>
                                </ul>
                            </div>
                            </div> 
                    <?php if(!empty($social_media_settings)){
                        foreach($social_media_settings as $rowss)
                        {
                            
                        $facebook_url=$rowss->facebook_url;
                        $twitter_url=$rowss->twitter_url;
                        $linkedin_url=$rowss->linkedin_url;
                        $instagram_url=$rowss->instagram_url;
                        $youtube_url=$rowss->youtube_url;   
                         }}
                         else
                         {
                             $facebook_url='#';
                        $twitter_url='#';
                        $linkedin_url='#';
                        $instagram_url='#';
                        $youtube_url='#';
                         }
                         ?>
                    <div class="col-md-2">                      
                    <div class="top_social space">
                    
                    
  <a href="<?php echo $twitter_url;?>" title ="<?php echo $tran_lang['twitter'];?>" class="top-social external" target="_blank"><i class="fab fa-twitter"></i></a> |
  <a href="<?php echo $facebook_url;?>" title ="<?php echo $tran_lang['Facebook'];?>" class="top-social external" target="_blank"><i class="fab fa-facebook-f"></i></a> |
  <a href="<?php echo $instagram_url;?>" title ="<?php echo $tran_lang['Instagram'];?>" class="top-social external" target="_blank"><i class="fab fa-instagram"></i></a> |
  <a href="<?php echo $linkedin_url;?>" title ="<?php echo $tran_lang['Linkedin'];?>" class="top-social external" target="_blank"><i class="fab fa-linkedin-in"></i></a>|
  <a href="<?php echo $youtube_url;?>" title ="<?php echo $tran_lang['Youtube'];?>" class="top-social external" target="_blank"><i class="fab fa-youtube"></i></a>
<!--  <a href="#" class="youtube"><i class="fab fa-youtube"></i></a> -->
 
                        
                        </div></div>
                    </div>
  </div>
                    
                </div>
            

       
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="left-sec is-flex">                          
                            <a href ="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets-front/images/sainik_logo1.png" title = "<?php echo $tran_lang['sainik_samachar'] ?>" alt="<?php echo $tran_lang['sainik_samachar'] ?>"></a>
                            <div class="samacharlogo">
                             
                            <p class="sainik-logo"> <?php echo $tran_lang['directorate_of_public_relations'];?>,<br>
                             <?php echo $tran_lang['ministry_of_defence'];?></p>
                                <p><?php echo $tran_lang['sainik_samachar'];?></p>      
                            </div>                  
                        </div>
                    </div>
                    <div class="col-md-3"><a class="external" target="blank" href ="https://amritmahotsav.nic.in/"><img src="<?php echo base_url();?>assets-front/images/ss_amrit_logo.png" title ="<?php echo $tran_lang['amrit_mahotsava'] ?>" alt="<?php echo $tran_lang['amrit_mahotsava'] ?>"></a></div>
                    <div class="col-md-4">
                        <div class="right-sec is-flex">
                         <!--   <div class="skip_screenreader ">
                                <ul class="is-flex">
                                    <li><a title="Skip Navigation" alt ="Skip Navigation" href="#home">Skip Navigation</a></li>
                                    <li>|</li>
                                    <li><a  title="Screen Reader Access" alt ="Screen Reader Access" href="#">Screen Reader Access</a></li>
                                </ul>
                            </div>-->
                            <div class="accessbility" style="margin-left:160px;">
                                <ul class="is-flex">
                                    <li id="btn-decrease">A-</li>
                                    <li id="btn-increase">A+</li>
                                    <li id="btn-orig" class="active">A</li>
                                  <!--  <li>A</li>-->
                                </ul>
                                
                            </div>
                            <!-- <div class="tree_link">
                                <a href="#"><img title ="Sitemap" src="<?php echo base_url();?>assets-front/images/tree_icon.png" alt=""></a>
                            </div> -->
                            <!-- <div class="search_sec">
                                <div class="search_icon"><a href="#" title="Search"><img src="<?php echo base_url();?>assets-front/images/search_icon.png" alt=""></a></div> -->
                                <!-- <div class="search_box">
                                    <input type="text" class="form-control">
                                </div> -->
                         <!--    </div> -->
                            <div class="lang">
                                <?php 
                                 if($this->session->userdata('lang_id')){
                                    $session_lang=$this->session->userdata('lang_id');
                                 }
                                 else
                                 {
                                    $session_lang = 1;
                                 }
                                      
                                        ?>
                                <select title=" <?php echo $tran_lang['select_language'];?>" onchange="return set_language(this.value);">
                                    <?php foreach ($this->languages as $language): 

                                       
                                        ?>
                               <option value="<?php echo $language->id; ?>" <?php echo ($session_lang == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
                            <?php endforeach; ?>                                
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu"
                                aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                                <span class="navbar-toggler-icon"></span>
                            </button>

<div class="collapse navbar-collapse" id="mainMenu">
<ul class="navbar-nav mr-auto">
     <li class="nav-item active">
        <a class="nav-link pl-0" href="<?php echo base_url();?>"><?php echo $tran_lang['home'];?></a>
    </li> 
                <?php 
                  $i =1;
                foreach ($menu_links as $menu_item):
                    if($i<3){
                if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
                $sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mt-0" href="#" id="navbarDropdown" role="button"
                aria-haspopup="true" aria-expanded="true"><?php echo $menu_item->item_name; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach ($sub_links as $sub_link): ?>
                <a class="dropdown-item pr-dropdown-item" href="<?php echo base_url().$sub_link->item_link;?>"><?php echo $sub_link->item_name; ?></a>
                <?php endforeach; ?>
                </div>
                </li>
                <?php 
                endif;
                } 
                $i++;
                endforeach; ?>
<li class="nav-item has-megamenu">
<a class="nav-link dropdown-toggle dropdown" href="#" id="navbarDropdown" role="button"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <?php echo $tran_lang['press_release'];?> 
</a>
<div class="dropdown-content mega-bg">
<!--  <div class="header">
<h2>menu</h2>
</div>  --> 
<div class="row">

<div class="col-md-2">
<div class="">
<h3 class="hq_title"><?php echo $tran_lang['dpq_hq'];?></h3>
<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i<4 || $i>65 && $i<67){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j<5){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>
</div>
</div>

<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i <4){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j>4 && $j<10){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>

<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i <4){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j>9 && $j<15){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>

<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i <4){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j>14 && $j<20){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>

<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i <4){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j>19 && $j<25){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>

<?php
  $i =1;
foreach ($menu_links as $menu_item):
    if($i>2 && $i <4){
if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
$sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>
<div class="col-md-2">
<div class="">
<?php 
$j=1;
foreach ($sub_links as $sub_link): 
if($j>24 && $j<30){
?>
<a class="pr-dropdown-item" href="<?php echo base_url('press-realease-list/').$sub_link->item_link; ?>" title=""><?php echo $sub_link->item_name; ?></a><br/>
 <?php 
}
$j++;
endforeach; ?>
</div>
<div class="menu_viewall"><button type="button" class="btn menu-btm"><a class="" href="<?php echo base_url('press-realease-list');?>" title=""><?php echo $tran_lang['view_all'];?></a></button></div>
</div>
<?php 
endif;
} 
$i++;
endforeach; 
?>



<!---end-press----->
</div>

</li>
<?php 
      $k=1;
    foreach ($menu_links as $menu_item):
        if($k>3 && $k <5){
    if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
    $sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); ?>

  <!--   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mt-0" href="#" id="navbarDropdown" role="button"
    aria-haspopup="true" aria-expanded="true"><?php //echo $menu_item->item_name; ?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <?php foreach ($sub_links as $sub_link): ?>
    <a class="dropdown-item pr-dropdown-item" href="<?php //echo base_url().$sub_link->item_link; ?>"><?php echo $sub_link->item_name; ?></a>
    <?php endforeach; ?>
    </div>
    </li> -->
    <?php 
    endif;
    } 
    $k++;
    endforeach; ?>

    <?php 
    $k=1;
    foreach ($menu_links as $menu_item):
    if($k > 3 && $k < 5){ ?>
     <li class="nav-item active">
      <a class="nav-link" href="<?php echo base_url('archive-list');?>"><?php echo $menu_item->item_name; ?></a>
     </li>
    <?php 
    } 
    $k++;
    endforeach; ?>

</li>
<?php 
      $k=1;
    foreach ($menu_links as $menu_item):
       // echo '<pre>';print_r($menu_item);

    if($k>4){
    if ($menu_item->item_location == "main" && $menu_item->item_parent_id == 0):
    $sub_links = get_sub_menu_links($menu_links, $menu_item->item_id, $menu_item->item_type); 
    ?>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mt-0" href="#" id="navbarDropdown" role="button"
    aria-haspopup="true" aria-expanded="true"><?php echo $menu_item->item_name; ?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <?php foreach ($sub_links as $sub_link): ?>
    <a class="dropdown-item pr-dropdown-item" href="<?php echo base_url().$sub_link->item_link;?>"><?php echo $sub_link->item_name; ?></a>
    <?php endforeach; ?>
    </div>
    </li>
    <?php 
    endif;
    } 
    $k++;
    endforeach; ?>


</div>
</div>
</div>
</li>


                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

<div id="stickySocialIcons" class="icon-bar" style="">
  <a href="<?php echo $twitter_url;?>" class="twitter" title="<?php echo $tran_lang['twitter'];?>"  target="_blank"><i class="fab fa-twitter"></i></a> 
  <a href="<?php echo $facebook_url;?>" class="facebook" title="<?php echo $tran_lang['Facebook'];?>"  target="_blank"><i class="fab fa-facebook-f"></i></a> 
  <a href="<?php echo $instagram_url;?>" class="google" title="<?php echo $tran_lang['Instagram'];?>"  target="_blank"><i class="fab fa-instagram"></i></a> 
  <a href="<?php echo $linkedin_url;?>" class="linkedin" title="<?php echo $tran_lang['Linkedin'];?>"  target="_blank"><i class="fab fa-linkedin-in"></i></a>
  <a href="<?php echo $youtube_url;?>" class="youtube" title="<?php echo $tran_lang['Youtube'];?>"  target="_blank"><i class="fab fa-youtube"></i></a>
<!--  <a href="#" class="youtube"><i class="fab fa-youtube"></i></a> -->
</div>

</header>

<script type="text/javascript">
function set_language(lang_id){
    var currentURL = window.location.href;
    var str=currentURL;
    var n = str.split('/');
    var string = n[5];     
    //alert(string); 
    if($.isNumeric(string)){

    var base_url = window.location.host;
         window.location= base_url;
    }else{
         window.location.href="home_controller/set_language/"+lang_id;
    }                       

}

</script>
<div class="page_bg2">