<section class="top_space">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-bg">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb_text">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home"
                    aria-hidden="true"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('previous-editions');?>">Sainik Samachar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Feedback</li>
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
       <h3 class="pt-3" style="color:white;"><?php echo $tran_lang['Submit_your_feedback']; ?></h3><br />
  </div>
    <div class="container">


    <?php if (($this->session->flashdata('success'))) { ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong>Success!!! </strong> <?php echo $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php  $this->session->unset_userdata('success');  } ?>

    <?php if (($this->session->flashdata('error'))) { ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
     <?php echo $this->session->flashdata('error'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php  $this->session->unset_userdata('error');  } ?>
      <div class="row">
        <div class="col-md-8 mx-auto ">
          <form action="<?php echo base_url('feedback')  ?>" method="post">
            <input class="form-control" name="name" placeholder="<?php echo $tran_lang['feedback_name']; ?>" /><br />
            <small>  <?php echo form_error('name'); ?>  </small>
            <input class="form-control" type="number" maxlength="10" name="phone_no" onkeypress="return isNumberKey(event,this)" placeholder="<?php echo $tran_lang['mobile_number']; ?>" /><br />
            <small>  <?php echo form_error('phone_no'); ?>  </small>
            <input class="form-control" name="email" type="email" placeholder="<?php echo $tran_lang['email_id_feedback']; ?>" /><br />
            <small>  <?php echo form_error('email'); ?>  </small>
            <textarea class="form-control" name="text" placeholder="<?php echo $tran_lang['feedback_message']; ?>"
              style="height:150px;"></textarea><br />
              <small>  <?php echo form_error('text'); ?>  </small> 
            <button class="btn btn-primary float-right mb-4" type="submit" value="Feedback" name="submit">
            <?php echo $tran_lang['Submit_Feedback']; ?></button><br /><br />
          </form>
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