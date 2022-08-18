
function checksocial_title($){


function checkone(){
    if($("div.ss_facebook").hasClass("active")){  
        $("h3.ss_facebook_head").css("display", "block");
        $("h3.ss_insta_head").css("display", "none");
    }
    else{             
        $("h3.ss_facebook_head").css("display", "none");
        $("h3.ss_insta_head").css("display", "block");
    }
}

function checkone2(){
    if($("div.ss_twitter").hasClass("active")){  
        $("h3.ss_twitter_head").css("display", "block");
        $("h3.ss_linkedin_head").css("display", "none");
    }
    else{             
        $("h3.ss_twitter_head").css("display", "none");
        $("h3.ss_linkedin_head").css("display", "block");
    }
}


window.setInterval(checkone,50);
window.setInterval(checkone2,50);
}

jQuery(document).ready(function ($) {

    checksocial_title($);

//Stop Audio on Modal Close
    // $("#audioModal .close").on('click', function(){
    //     var audio  = $("#audioModal audio");
    //     console.log(audio);
    //     audio.pause();
    // })

    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
          $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');
      
      
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
          $('.dropdown-submenu .show').removeClass('show');
        });
      
      
        return false;
      });


        $('#audioModal').on('hide.bs.modal', function () { //Change #myModal with your modal id
      $('audio').each(function(){
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
      }); 
        });

     
    $('.openAudioModal').click(function(){
        $('#audioModal').modal({
            backdrop: 'static'
        });
    }); 
    
  //Show Sticky social icons
  $(window).scroll(function() {
  const scrollTop = $(window).scrollTop();
  if(scrollTop > 50) {
    $("#stickySocialIcons").addClass('show');
  }else {
    $("#stickySocialIcons").removeClass('show');
  }
  });




 //Show Sticky social icons
  $(window).scroll(function() {
  const scrollTop = $(window).scrollTop();
  if(scrollTop > 100) {
    $("#stickySocialIcons1").addClass('show');
  }else {
    $("#stickySocialIcons1").removeClass('show');
  }
  });

//Footer Slier
$('.footerSlider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay:true,
  
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});






















});



















