$( document ).ready(function() {
  //alert('dddd');
var input = document.getElementById('txtPassword');
var text_caps = document.getElementById('text_caps');
  
  input.addEventListener("keyup", function(event) {

    if (event.getModifierState("CapsLock")) {
    text_caps.style.display = "block";
    } else {
    text_caps.style.display = "none"
    }

    });

    var input = document.getElementById('confirm_password');
    var text_caps_confirm_password = document.getElementById('text_caps_confirm_password');

    input.addEventListener("keyup", function(event) {

    if (event.getModifierState("CapsLock")) {
    text_caps_confirm_password.style.display = "block";
    } else {
    text_caps_confirm_password.style.display = "none"
    }

    });

});



function show() {
  var p = document.getElementById('txtPassword');
  p.setAttribute('type', 'text');
}

function hide() {
  var p = document.getElementById('txtPassword');
  p.setAttribute('type', 'password');
}

function showHide() {
   // alert('a');

      var ids = document.getElementById('showpassword');
      if(ids.classList.contains('glyphicon-eye-open')){
          ids.classList.remove("glyphicon-eye-open");
          var p = document.getElementById('txtPassword');
        p.setAttribute('type', 'text');
          ids.classList.add("glyphicon-eye-close");
      }
      else{
         ids.classList.remove("glyphicon-eye-close");
          ids.classList.add("glyphicon-eye-open");
           var p = document.getElementById('txtPassword');
            p.setAttribute('type', 'password');
      }

  var pwShown = 0;

  document.getElementById("eye").addEventListener("click", function() {
    if (pwShown == 0) {
      pwShown = 1;
      show();
    } else {
      pwShow = 0;
      hide();
    }
  }, false);
}


function check_audio(id, status){
    //alert('hlll');
        var data = {
        "post_id": id,
        "status": status
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_audio_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.status);
              if(returnedData.status == 1 || returnedData.status == 0){
               location.reload();
              }else{

              }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}


function check_home_page_audio(id, is_album_cover){
       //alert('hhhh');
        var data = {
        "post_id": id,
        "is_album_cover": is_album_cover
        };

      //  alert(data.is_album_cover);


        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_audio_ajax2",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.is_album_cover);
             // if(returnedData.is_album_cover == 1 || returnedData.is_album_cover == 0){
               location.reload();
              //}else{

             // }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  

function check_video(id, status){
        var data = {
        "post_id": id,
        "status": status
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_video_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.status);
              if(returnedData.status == 1 || returnedData.status == 0){
               location.reload();
              }else{

              }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}

function check_home_page_video(id, is_album_cover){
        var data = {
        "post_id": id,
        "is_album_cover": is_album_cover
        };

        //alert(data.is_album_cover);


        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_video_ajax2",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.is_album_cover);
             // if(returnedData.is_album_cover == 1 || returnedData.is_album_cover == 0){
               location.reload();
              //}else{

             // }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  


function check_infographic(id, status){
        var data = {
        "post_id": id,
        "status": status
        };
        //alert('qqqq');
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_infographic_ajax",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.status);
              if(returnedData.status == 1 || returnedData.status == 0){
               location.reload();
              }else{

              }
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}

function check_home_page_infographic(id, is_album_cover){
        var data = {
        "post_id": id,
        "is_album_cover": is_album_cover
        };

        //alert(data.is_album_cover);


        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
        type: "POST",    
        url: base_url + "CommanAjax_controller/post_action_infographic_ajax2",
        data:data,
        success : function(data){
             var returnedData = JSON.parse(data);
             //alert(returnedData.is_album_cover);
             // if(returnedData.is_album_cover == 1 || returnedData.is_album_cover == 0){
               location.reload();
                                           
        },
        error : function(data)
        {
            //do something
        }
    });

}  
