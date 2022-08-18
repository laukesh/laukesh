OCTYPE html>
<html lang="en">

<head>
    <title>Sainik Samachar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/style.css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets_new/js/bootstrap.min.js"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets_new/js/custom.js"></script>
</head>

<body>
    <!---Header Start from here--->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="left-sec is-flex">                          
                            <img src="<?php echo base_url().$visual_setting[0]->logo;?>" alt="Sainik Patrika Logo">
                            <div class="samacharlogo">
                             <img src="<?php echo base_url().$visual_setting[0]->logo2;?>" alt="Sainik Patrika Logo" class="sainik-logo">
                                <p>Directorate of Public Relations, Ministry of Defence</p>      
                            </div>                  
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="right-sec is-flex">
                            <div class="skip_screenreader">
                                <ul class="is-flex">
                                    <li><a title="Skip Navigation" alt ="Skip Navigation" href="#home">Skip Navigation</a></li>
                                    <li>|</li>
                                    <li><a  title="Screen Reader Access" alt ="Screen Reader Access" href="#">Screen Reader Access</a></li>
                                </ul>
                            </div>
                            <div class="accessbility">
                                <ul class="is-flex">
                                    <li>A-</li>
                                    <li>A+</li>
                                    <li class="active">A</li>
                                    <li>A</li>
                                </ul>
                            </div>
                            <div class="tree_link">
                                <a href="#"><img title ="Sitemap" src="<?php echo base_url();?>assets_new/images/tree_icon.png" alt=""></a>
                            </div>
                            <div class="search_sec">
                                <div class="search_icon"><a href="#" title="Search"><img src="<?php echo base_url();?>assets_new/images/search_icon.png" alt=""></a></div>
                                <!-- <div class="search_box">
                                    <input type="text" class="form-control">
                                </div> -->
                            </div>
                            <?php if ($this->general_settings->multilingual_system == 1){?>
                            <div class="lang">
                                <select title="Select Language">
                            <?php
                                foreach ($this->languages as $language){
                                if ($language->id == $this->site_lang->id){
                                ?>
                                    <option><?php echo $language->language_code ?></option>
                                <?php } else{?>
                               <option><?php echo $language->language_code ?></option>
                                <?php } }?>
                                                                       
                                </select>
                            </div>
                        <?php }?>
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
                                        <a class="nav-link pl-0" href="#">Home </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle mt-0" href="#" id="navbarDropdown" role="button"
                                             aria-haspopup="true" aria-expanded="true">
                                            What's New
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Press Releases</a>
                                            <a class="dropdown-item" href="#">Notifications & Circulars</a>
                                            
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle mt-0" href="#" id="navbarDropdown" role="button"
                                             aria-haspopup="true" aria-expanded="true">
                                            Sainik Samachar
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Latest Magazine</a>
                                            <a class="dropdown-item" href="#">Archived Magazines</a>
                                            
                                        </div>
                                    </li>
                                   
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Press Release
                                        </a>
                                       <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">DPR HQ</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRO Airforce</a></li>
                                              <li><a class="dropdown-item" href="#">PRO Army</a></li>
                                              <li><a class="dropdown-item" href="#">PRO Defence</a></li>
                                              <li><a class="dropdown-item" href="#">PRO Navy</a></li>
                                              
                                            </ul>
                                          </li>

                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">PRU East</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRU Kolkata</a></li>
                                              <li><a class="dropdown-item" href="#">PRU Delhi</a></li>
                                              
                                            </ul>
                                          </li>
                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">PRU North</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRU Kolkata</a></li>
                                              <li><a class="dropdown-item" href="#">PRU Delhi</a></li>
                                              
                                            </ul>
                                          </li>
                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">PRU South-West</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRU Kolkata</a></li>
                                              <li><a class="dropdown-item" href="#">PRU Delhi</a></li>
                                              
                                            </ul>
                                          </li>
                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">PRU South</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRU Kolkata</a></li>
                                              <li><a class="dropdown-item" href="#">PRU Delhi</a></li>
                                              
                                            </ul>
                                          </li>
                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">PRU West</a>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#">PRU Kolkata</a></li>
                                              <li><a class="dropdown-item" href="#">PRU Delhi</a></li>
                                              
                                            </ul>
                                          </li>

                                       </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Media
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Photos</a>
                                            <a class="dropdown-item" href="#">Videos</a>
                                            <a class="dropdown-item" href="#">Radio Programs</a>

                                        </div>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Download </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            About Us
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">History</a>
                                            <a class="dropdown-item" href="#">Milestones</a>
                                            <a class="dropdown-item" href="#">Editorial Board</a>
                                            <a class="dropdown-item" href="#">Correspondents</a>
                                            <a class="dropdown-item" href="#">Who's Who</a>
                                            <a class="dropdown-item" href="#">Contact Us</a>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <!---Header End from here--->