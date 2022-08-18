<?php //echo '<pre>'; print_r($home_page_footer);die();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sainik Samachar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/style.css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets_new/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_favicon($this->visual_settings); ?>"/>
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
                             <img src="<?php echo base_url().$visual_setting[0]->logo_footer;?>" alt="Sainik Patrika Logo" class="sainik-logo">
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
                           <?php if ($this->general_settings->multilingual_system == 1 && count($this->languages) > 1): ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="icon-language"></i>&nbsp;
                                <?php echo html_escape($this->selected_lang->name); ?> <span class="icon-arrow-down"></span>
                            </a>
                            <ul class="dropdown-menu lang-dropdown">
                                <?php
                                foreach ($this->languages as $language):
                                    $lang_url = base_url() . $language->short_form . "/";
                                    if ($language->id == $this->general_settings->site_lang) {
                                        $lang_url = base_url();
                                    } ?>
                                    <li>
                                        <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $this->selected_lang->id) ? 'selected' : ''; ?> ">
                                            <?php echo $language->name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!function_exists('user_session')){exit();}
         $menu_limit = $this->general_settings->menu_limit; ?>
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
                    <?php if ($this->general_settings->show_home_link == 1): ?>
                        <li class="<?php echo (uri_string() == 'index' || uri_string() == "") ? 'active' : ''; ?> nav-item active">
                            <a class="nav-link pl-0" href="<?php echo lang_base_url(); ?>">
                                <?php echo trans("home"); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php
                    $total_item = 0;
                    $i = 1;
                    if (!empty($this->menu_links)):
                        foreach ($this->menu_links as $item):
                            //echo '<pre>';print_r($item);die();
                            if ($item->item_visibility == 1 && $item->item_location == "main" && $item->item_parent_id == "0"):
                                if ($i < $menu_limit):
                                    $sub_links = get_sub_menu_links($this->menu_links, $item->item_id, $item->item_type);
                                    if ($item->item_type == "category") {
                                        if (!empty($sub_links)) {
                                            $this->load->view('nav/_megamenu_multicategory', ['category_id' => $item->item_id]);
                                        } else {
                                            $this->load->view('nav/_megamenu_singlecategory', ['category_id' => $item->item_id]);
                                        }
                                    } else {
                                        if (!empty($sub_links)): ?>
                                            <li class="dropdown <?php echo (uri_string() == $item->item_slug) ? 'active' : ''; ?>">
                                                <a class="nav-link dropdown-toggle mt-0" data-toggle="dropdown" href="<?php echo generate_menu_item_url($item); ?>">
                                                    <?php echo html_escape($item->item_name); ?>
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-more dropdown-top">
                                                    <?php foreach ($sub_links as $sub_item): 

                                                        //echo '<pre>';print_r($sub_item);
                                                        ?>
                                                        <?php if ($sub_item->item_visibility == 1): ?>
                                                          <!--   <li class="dropdown-toggle disabled" data-toggle="dropdown">
                                                                <a class="dropdown-item" role="menuitem" href="<?php echo generate_menu_item_url($sub_item); ?>">
                                                                    <?php echo html_escape($sub_item->item_name); ?><span class="icon-arrow-right"></span>
                                                                </a>
                                                            </li> -->
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#"><?php echo html_escape($sub_item->item_name); ?></a>
                                            <?php
                                            $this->db->select("*");
                                            $this->db->from("pages");
                                            $this->db->where('parent_id',$sub_item->item_id);
                                            $this->db->where('location','main');
                                            $query = $this->db->get();
                                            $results = $query->result_array();

                                        if(!empty($results)){?>
                                           <ul class="dropdown-menu">
                                                <?php 
                                                foreach ($results as $item){
                                                ?>
                                                  <li><a class="dropdown-item" href="<?php echo generate_menu_item_url($sub_item); ?>"><?php echo $item['title']; ?></a>
                                                  </li>
                                                  <?php
                                                  }
                                                  ?>
                                              
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                          </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li class="<?php echo (uri_string() == $item->item_slug) ? 'active' : ''; ?>">
                                                <a class="nav-link" href="<?php echo generate_menu_item_url($item); ?>">
                                                    <?php echo html_escape($item->item_name); ?>
                                                </a>
                                            </li>
                                        <?php endif;
                                    }
                                    $i++;
                                endif;
                                $total_item++;
                            endif;
                        endforeach;
                    endif; ?>

                    <?php
                     
                    if ($total_item >= $menu_limit): 
                        ?>
                        <li class="dropdown relative">
                            <a class="dropdown-toggle dropdown-more-icon" data-toggle="dropdown" href="#">
                                <i class="icon-ellipsis-h"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-more dropdown-top">
                                <?php $i = 1;
                                if (!empty($this->menu_links)):
                                    foreach ($this->menu_links as $item):
                                        if ($item->item_visibility == 1 && $item->item_location == "main" && $item->item_parent_id == "0"):
                                            if ($i >= $menu_limit):
                                                $sub_links = get_sub_menu_links($this->menu_links, $item->item_id, $item->item_type);
                                                if (!empty($sub_links)): ?>
                                                    <li class="dropdown-more-item">
                                                        <a class="dropdown-toggle disabled" data-toggle="dropdown" href="<?php echo generate_menu_item_url($item); ?>">
                                                            <?php echo html_escape($item->item_name); ?> <span class="icon-arrow-right"></span>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-sub">
                                                            <?php foreach ($sub_links as $sub_item): 
                                                                ?>
                                                                <?php if ($sub_item->item_visibility == 1): ?>
                                                                    <li>
                                                                        <a role="menuitem" href="<?php echo generate_menu_item_url($sub_item); ?>">
                                                                            <?php echo html_escape($sub_item->item_name); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a href="<?php echo generate_menu_item_url($item); ?>">
                                                            <?php echo html_escape($item->item_name); ?>
                                                        </a>
                                                    </li>
                                                <?php endif;
                                            endif;
                                            $i++;
                                        endif;
                                    endforeach;
                                endif; ?>
                            </ul> 
                        </li>
                    <?php endif; ?>
                </ul>


                            </div>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <!---Header End from here--->