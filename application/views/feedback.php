<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo $tran_lang['lang_id'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('previous-editions');?>"><?php echo $tran_lang['sainik_samachar'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['feedback'];?></li>
  </ol>
</nav>
</div>
</div>
</div>

  </div>
</section>

<!--start box gallery-->
<div class="container" id="container" >
  <div id ="content">
  <div class="card-text">
    <div class="card">
    <div class="card-header text-center" style="background: #1d3a7c;">
       <h3 class="pt-3" style="color:white;"><?php echo $tran_lang['Submit_your_feedback']; ?></h3>
  </div>
    <div class="container">


    <?php if(($this->session->flashdata('success'))){
     ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong>Success!!! </strong> <?php echo $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php  $this->session->unset_userdata('success');  }else{?>
       <div class="" style="margin: 0 auto; margin-top: 20px; text-align:center;" >
    <img src="<?php echo base_url();?>assets-front/images/loading.gif" id="gif" style="display: none;     position: absolute;
    top: 50%;
    left: 50%;
    margin: -50px 0px 0px -50px;
    z-index: 2222;
}">
   <?php } ?>

    <?php if (($this->session->flashdata('error'))) { ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
     <?php echo $this->session->flashdata('error'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <!-- NASEER KHAN -->
    <?php  $this->session->unset_userdata('error');  } ?>
      <div class="row">
        <div class="col-md-8 mx-auto ">
        <div class="" style="text-align:center;" id="form_wrapper">
    <img src="<?php echo base_url();?>assets-front/images/loading.gif" id="gif" style="display: block; margin: 0 auto; width: 100px; visibility: hidden; position: absolute; position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;">
   <!--  <div class='loader_css' id="gif" style='display:none; text-align:center;'><img class='loader_img_css' src='<?php echo base_url();?>assets-front/images/loading.gif'/><span class='loader_text_css'>Loading ...</span></div> -->
          
            <div class="card p-3 m-1 mx-auto col-md-8">

          <form action="<?php echo base_url('feedback_post')  ?>" id="login_form" method="post">
            <input class="form-control" name="name" placeholder="<?php echo $tran_lang['feedback_name']; ?>" /><br />
            <small>  <?php echo form_error('name'); ?>  </small>
            <input class="form-control" type="number" maxlength="10" name="phone_no" onkeypress="return isNumberKey(event,this)" placeholder="<?php echo $tran_lang['mobile_number']; ?>" /><br />
            <small>  <?php echo form_error('phone_no'); ?>  </small>
            <input class="form-control" name="email" type="email" placeholder="<?php echo $tran_lang['email_id_feedback']; ?>" /><br />
            <small>  <?php echo form_error('email'); ?>  </small>
            <textarea class="form-control" name="text" placeholder="<?php echo $tran_lang['feedback_message']; ?>"
              ></textarea><br />
              
              <small>  <?php echo form_error('text'); ?>  </small> 
                <div class="row mt-3">
                  <div class="col-md-4 m-0 p-0" id="captcha_feedback">
                       <?php echo $captcha2;?>      
                  </div>
                <div class="col-md-6 p-0 m-0">    
                  <input type="text" class="form-control" name="captcha_chk" value="" style="height: 26px;" >
               </div>
            <div class="col-md-2">
              <a href="#" class="btn btn-primary btn-md btn-flat" id="feedback">
              <span class="glyphicon glyphicon-refresh"></span></a>
          </div>
        </div>
            <button class="btn btn-primary btn-md float-right mb-2 mt-4" type="submit" value="Feedback" name="submit">
            <?php echo $tran_lang['Submit_Feedback']; ?></button><br /><br />
            </form>
        </div>
         <!-- NASEER KHAN -->
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<script> 
   function isNumberKey(evt, obj) 
   {
            var charCode = (evt.which) ? evt.which : event.keyCode
            var value = obj.value;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
                return true;
   }
</script>

<script type="text/javascript">
     $('#login_form').submit(function() {
     // alert('ddd');
       $('#gif').show(); 
       return true;
     });
 </script>

 <script type="text/javascript">
      $('#feedback').click(function(event){
        $.ajax({
        url:'<?php echo base_url();?>home_controller/captcha2',
        method: 'POST',
        dataType:"json",
        success: function(data){        
            $('#captcha_feedback').html(data);
           }
         });
        });     
</script>
