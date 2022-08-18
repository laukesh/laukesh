
<?php $this->load->view('common/includemain'); ?>  
<link rel="stylesheet" href="<?= base_url();?>asset/tool/tool.css">
<div class="loader" id="preloader" style="display:none;"></div>
<body class="crm_body_bg">    
<?php $this->load->view('common/leftsidebar'); ?>
<section class="main_content paddingActive dashboard_part large_header_bg">
<?php $this->load->view('common/header'); ?>
 

<style type="text/css">
    .card-text a {
    color: white !important;
}.table_tfoot td {
  color: white;
      background-color: #007adf !important;
      display: none;
}
.fa, .fas {
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
}
.buttons-excel::before {
    content: "\f1c3" !important;
}
.buttons-excel::before {
    font-family: fontAwesome;
    content: "\f1c4";
    margin-right: 5px;
}

  </style>
<style type="text/css">
  table{ border-collapse: collapse !important; }
  table tr th:first-child {
    text-align: center;
    border: 1px solid #fff;
}
#print_datatable_inner_info{ display: none; }
    .dt-buttons{

    float: right;
    padding: 10px;

  }#print_datatable_info{
  display: none;
  }

  .card-table{
border: 1px solid #fff;
min-height: 211px;
padding:0px 17px;
background-color: #0091d5;
color: #fff;
font-size: 12px;
}
.card-row1{
padding: 8px 0px;  background-color: #2c7da3;
min-height: 35px;
}
.card-row2{
padding: 8px;
background-color: #fff;
color: #2c7da3;
font-weight: 500;
    margin-top: 2px;
}
.card-text{
padding: 8px;
border-bottom: 1px dotted #fff;
}
</style>

  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
td a {
    color: #289ab4;font-weight: 500;
}
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style> 
<!-- Start main_content_iner -->
<div class="main_content_iner">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    <?php $this->load->view('common/breadcrumb'); ?>
    </div>
  </div>


  <div class="row">
       
       <div class="col-md-12">
       <div class="optionbox_main centre">
       <div class="row">
       <div class="col-md-1">
<!--<a href="national_state_district_dashboard_mucormycosis_report.html"><button type="button" class="btn btn-yellow padding5" title="add more division">Back</button></a>
  -->
        </div>
       <div class="col-md-11 muco-space">Mucormycosis Analysis</div>
       </div>
       </div>
       </div>
       </div>
       
      <?php

      $type_selection = isset($_GET['type_selection'])?$_GET['type_selection']:''; 
      $district = isset($_GET['district'])?$_GET['district']:''; 
      $hospital = isset($_GET['hospital'])?$_GET['hospital']:''; 
      $state = isset($_GET['state'])?$_GET['state']:'';
      $patient_status  = $patient_status['out_data'][0];  
      $age_wise        = $age_wise['out_data'][0]; 
      $classified      = $classified['out_data']; 
      $gender          = $gender['out_data'][0];
      $diebetic        = $diebetic['out_data'][0];
      $covid_count     = $covid_count['out_data'][0];
      $stero           = $stero['out_data'][0];
      $oxygen          = $oxygen['out_data'][0];
      #echo "<pre>"; print_r($patient_status); die;
      $total = $patient_status['Count_Cured']+$patient_status['Count_UT']+$patient_status['Count_death']+$patient_status['Count_lama']; 
      ?>
    
    
       <div class="row mt-2">
         <div class="col-md-12 col-lg-12">
          <div class="card">
          <div class="card-body">
          <div class="row">
           <div class="col-md-12">
           <div class="row">
             <div class="col-md-4">
         
             <a href="national_state_district_dashboard_patients_status.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer">Patients Medical Status </a><br></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer">  Total Cases (Overall)</a></div>

             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php  echo $total; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"> <a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer">Under Treatment</a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php  echo isset($patient_status['Count_UT'])?$patient_status['Count_UT']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"> <a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer">Cured</a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php  echo  isset($patient_status['Count_Cured'])?$patient_status['Count_Cured']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9 text-white">Deaths</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['Count_death'])?$patient_status['Count_death']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9 text-white">Lama</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['Count_lama'])?$patient_status['Count_lama']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             </div> </div>
             </div>
             </a> 
            
           </div>
              
              
              <div class="col-md-4">
         
             <a href="national_state_district_dashboard_age_wise.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"> Deaths Reported</a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Total Deaths Reported</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['Count_death'])?$patient_status['Count_death']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Deaths Due to Mucormycosis</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['mmDeath'])?$patient_status['mmDeath']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Deaths Due to Other Causes
             </div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['otherDeath'])?$patient_status['otherDeath']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Deaths Cases where cause of death not updated/entered</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=2#pointer"><?php echo isset($patient_status['noCause'])?$patient_status['noCause']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
            
             </div> </div>
             </div>
             </a> 
            
           </div>
           
           
             <div class="col-md-4">
         
             <a href="national_state_district_dashboard_classified.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"> Mucormycosis Cases  (Age wise)</a> </div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer">  age=<18 </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"><?php echo isset($age_wise['Count_Age18'])?$age_wise['Count_Age18']:0 ; ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer">18< age<=45 </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"><?php  echo isset($age_wise['Count_AgeAbove18_45'])?$age_wise['Count_AgeAbove18_45']:0 ;  ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"> 45 < age<=60 </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer"> <?php  echo isset($age_wise['Count_AboveAge45_60'])?$age_wise['Count_AboveAge45_60']:0 ;  ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5">  60 < age </a></div>
             <div class="col-md-3"><a  class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=5#pointer">  <?php echo isset($age_wise['Count_AgeAbove60'])?$age_wise['Count_AgeAbove60']:0 ;   ?> </a></div>
             </div>
             </div>
             </div>
             </div>

             
             </div> </div>
             </div>
             </a> 
            
           </div>
           
           
           </div>
           <div class="row mt-3">
             <div class="col-md-4">
         
             <a href="national_state_district_dashboard_Covid_nonCovid.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=10#pointer">Mucormycosis Cases (Mucormycosis classified)</a></div></div>
             </div>
             <?php
              foreach ($classified as $value) { ?>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=10#pointer"><?php echo $value['classification_description']; ?> </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=10#pointer"><?php  echo isset($value['count_classified'])?$value['count_classified']:0 ;  ?></a></div>
             </div>
             </div>
             </div>
             </div>
            <?php } ?>
            
             
             </div> </div>
             </div>
             </a> 
            
           </div>
              
              <div class="col-md-4">
         
             <a href="national_state_district_dashboard_steroid_therapy.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4#pointer">Mucormycosis Cases (Gender) </a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4#pointer">   Male </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4#pointer">  <?php  echo isset($gender['Count_Male'])?$gender['Count_Male']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4">Female </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4#pointer">  <?php  echo isset($gender['Count_Female'])?$gender['Count_Female']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Other</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=4#pointer"> <?php  echo isset($gender['Count_Others'])?$gender['Count_Others']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>

             
             </div> </div>
             </div>
             </a> 
            
           </div>
              
           <div class="col-md-4">
         
             <a href="national_state_district_dashboard_o2_support.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer">   Mucormycosis Cases </a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer">Diabetes </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer"> <?php  echo isset($diebetic['Count_patient_diebetic'])?$diebetic['Count_patient_diebetic']:0 ?> </a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer">Immunocompromised Status </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer"> <?php  echo isset($diebetic['Immunocompromised_Status'])?$diebetic['Immunocompromised_Status']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11">Comorbidity </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=11#pointer"><?php  echo isset($diebetic['Count_comorbidity'])?$diebetic['Count_comorbidity']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>

             
             </div> </div>
             </div>
             </a> 
            
           </div>
           
             
           
           
           </div>
           <div class="row mt-3">
             <div class="col-md-4">
         
             <a href="national_state_district_dashboard_gender.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=3#pointer">Mucormycosis Cases (Covid/NonCovid) </a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=3">with COVID history </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=3#pointer"><?php  echo isset($covid_count['Count_covid'])?$covid_count['Count_covid']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=3">Non-Covid </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=3#pointer">  <?php  echo isset($covid_count['Count_Noncovid'])?$covid_count['Count_Noncovid']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
            
             
             </div> </div>
             </div>
             </a> 
            
           </div>
              
            <div class="col-md-4">
         
             <a href="national_state_district_dashboard_Mucormycosis_cases.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=6">  Mucormycosis Cases ( steroid therapy)  </a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=6#pointer"> Yes </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=6#pointer"> <?php  echo isset($stero['Count_steroid_received'])?$stero['Count_steroid_received']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=6#pointer">No </a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=6#pointer">  <?php  echo isset($stero['Count_steroid_not_received'])?$stero['Count_steroid_not_received']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
        
             </div> </div>
             </div>
             </a> 
            
           </div>
              

            <div class="col-md-4">
         
             <a href="national_state_district_dashboard_Mucormycosis_cases.html">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_main_box">
             <div class="row">
             <div class="col-md-12">
             <div class="mucormycosis_box"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=7#pointer"> Mucormycosis Cases (o2 support received  prior  to onset of Mucormycosis)</a></div></div>
             </div>
             
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9">Yes</div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=7#pointer">  <?php  echo isset($oxygen['Count_oxygen_received'])?$oxygen['Count_oxygen_received']:0 ?></a></div>
             </div>
             </div>
             </div>
             </div>
             <div class="row">
             <div class="col-md-12">
             <div class="border_btm">
             <div class="row">
             <div class="col-md-9"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=7#pointer">No</a></div>
             <div class="col-md-3"><a class="text-white" href="<?php echo base_url() ?>Mucormycosis_report/report?type_selection=7#pointer"> <?php  echo isset($oxygen['Count_oxygen_not_received'])?$oxygen['Count_oxygen_not_received']:0 ?>
                                                  </a></div>
             </div>
             </div>
             </div>
             </div>
     
             </div> </div>
             </div>
             </a> 
            
           </div>
           
           
             
           
           
           </div>
           </div>
           
           </div>
           
           
          

<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar scroll evenTable" >
                 
<?php if(!$hospital){ ?>
      <table class="table table-bordered tablefont" id="print_datatable">
           
  <?php if($type_selection ==1){ ?>
          <thead class="report-heading-box">
              <tr>
              <th scope="col" class="centre nowrap table-sno">S.no</th>
              <th scope="col" class="centre nowrap">State/UT </th>
              <?php if(isset($_GET['state']) || isset($_GET['district'])){
              ?>  <th>District </th><?php 

              } ?>
              <?php if(isset($_GET['district'])){
              ?>  <th>Facility Name </th><?php 

              } ?>
              <th scope="col" class="centre nowrap">Mucormycosis cases with eye affected</th>
              <th scope="col" class="centre nowrap"> Mucormycosis cases with Lungs affected</th>
              <th scope="col" class="centre nowrap"> Mucormycosis cases with Mouth affected</th>  
              <th scope="col" class="centre nowrap">Mucormycosis cases with others</th>
              </tr>
          </thead>
    <?php } ?>
   <?php if($type_selection ==2){ ?>
      <thead class="report-heading-box ">
        <tr>
        <tr scope="col" class="centre nowrap">
        <?php if($_SESSION['admin']['role_id'] == 1){

        if(isset($_GET['state'])){ ?>

        <th colspan="10" scope="col" class="centre nowrap">Patients Status </th>
        <?php } else if(isset($_GET['district'])){ ?>
        <th colspan="10" scope="col" class="centre nowrap">Patients Status </th>
        <?php } else { ?>
        <th colspan="11" scope="col" class="centre nowrap">Patients Status </th>
        <?php } ?>
        <?php } else if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){

        if($_SESSION['admin']['role_id'] == 2){
        ?>

        <th colspan="11" scope="col" class="centre nowrap">Patients Status    
        </th>

        <?php }  else{  

        ?><th colspan="8" scope="col" class="centre nowrap">Patients Status    
        </th><?php } ?>

        <?php }else if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){

        ?>
        <th colspan="10" scope="col" class="centre nowrap">Patients Status  
        </th>
        <?php }else{ ?>

        <th colspan="8" scope="col" class="centre nowrap">Patients Status 
        </th>
        <?php } ?>

        </tr>
      <tr>

        <th scope="col" class="centre nowrap table-sno">S.no</th>
        <th scope="col" class="centre nowrap">State/UT </th>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        ?>  <th scope="col" class="centre nowrap">District </th><?php 

        } ?>
        <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
        ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

        } ?>
        <th>Total Cases (Overall) </th>
        <th scope="col" class="centre nowrap">Under Treatment  </th>
        <th scope="col" class="centre nowrap">Cured </th>
        <th scope="col" class="centre nowrap">Deaths Due to MM </th>  
        <th scope="col" class="centre nowrap">Deaths Due to Other Cause</th>  
        <th scope="col" class="centre nowrap">Deaths Where Cause is not Entered </th>  
        <th scope="col" class="centre nowrap">Lama </th>  
      </tr>
    </thead>
  <?php } ?>
     <?php if($type_selection ==3){ ?>
    <thead class="report-heading-box">
        <tr>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        if($_SESSION['admin']['role_id'] == 2){
        ?>
        <th colspan="6" scope="col" class="centre nowrap">Mucormycosis Cases   (Covid/NonCovid)
        </th>
        <?php }else{  
        ?><th colspan="5" scope="col" class="centre nowrap">Mucormycosis Cases   (Covid/NonCovid)
        </th><?php } ?>
        <?php }else if(isset($_GET['district'])){
        ?>
        <th colspan="6" scope="col" class="centre nowrap"> Mucormycosis Cases   (Covid/NonCovid)
        </th>
        <?php }else{ ?>

        <th colspan="5" scope="col" class="centre nowrap"> Mucormycosis Cases   (Covid/NonCovid)
        </th>
        <?php } ?>
        </tr>
        <tr>
        <th scope="col" class="centre nowrap table-sno">S.no</th>
        <th scope="col" class="centre nowrap">State/UT </th>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        ?>  <th>District </th><?php 

        } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
        ?>  <th>Hospital </th><?php 

        } ?>
        <th scope="col" class="centre nowrap">with COVID history  </th>
        <th scope="col" class="centre nowrap">  Non-Covid </th>
        </tr>
    </thead> 
  <?php } ?>
     <?php if($type_selection ==4){ ?>
     <thead class="report-heading-box ">
        <tr scope="col" class="centre nowrap">
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        if($_SESSION['admin']['role_id'] == 2){
        ?>
        <th colspan="7" scope="col" class="centre nowrap"> Mucormycosis Cases    (Gender)
        </th>
        <?php }else{  

        ?>   <th colspan="6" scope="col" class="centre nowrap"> Mucormycosis Cases    (Gender)
        </th><?php } ?>

        <?php }else if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){

        ?>
        <th colspan="7" scope="col" class="centre nowrap"> Mucormycosis Cases   (Gender)  
        </th>
        <?php }else{ ?>

        <th colspan="5" scope="col" class="centre nowrap"> Mucormycosis Cases    (Gender)
        </th>
        <?php } ?>

        </tr>
        <tr>

        <th scope="col" class="centre nowrap table-sno">S.no</th>

        <th scope="col" class="centre nowrap">State/UT </th>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2 ){
        ?>  <th scope="col" class="centre nowrap">District </th><?php 

        } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
        ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

        } ?>
        <th scope="col" class="centre nowrap">Male  </th>
        <th scope="col" class="centre nowrap">Female </th>
        <th scope="col" class="centre nowrap">Others </th>
        </tr>
    </thead> 
  <?php } ?>
     <?php if($type_selection ==5){ ?>
       <thead class="report-heading-box">
        <tr>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13){
        if($_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13){
        ?>

        <th colspan="9" scope="col" class="centre nowrap">Mucormycosis Cases    (Age wise)
        </th>

        <?php }else{  

        ?>   <th colspan="8" scope="col" class="centre nowrap">Mucormycosis Cases   (Age wise)
        </th><?php } ?>

        <?php }else if(isset($_GET['district'])){

        ?>
        <th colspan="9" scope="col" class="centre nowrap">Mucormycosis Cases   (Age wise)
        </th>
        <?php }else{ ?>

        <th colspan="6" scope="col" class="centre nowrap">Mucormycosis Cases   (Age wise) 
        </th>
        <?php } ?>

        </tr>
        <tr>
        <th scope="col" class="centre nowrap table-sno">S.no</th>
        <th scope="col" class="centre nowrap">State/UT </th>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        ?>  <th scope="col" class="centre nowrap">District </th><?php 

        } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13 ){
        ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

        } ?>
        <th scope="col" class="centre nowrap">age=<18</th>
        <th scope="col" class="centre nowrap">18< age< =45 </th>
        <th scope="col" class="centre nowrap">45 < age<=60 </th>
        <th scope="col" class="centre nowrap">60 < age </th>
        </tr>
    </thead> 
  <?php } ?>
     <?php if($type_selection ==6){ ?>
    <thead class="report-heading-box">
      <tr scope="col" class="centre nowrap">
      <?php if(isset($_GET['state'])  ||  $_SESSION['admin']['role_id'] == 2){
      if($_SESSION['admin']['role_id'] == 2){
      ?>

      <th colspan="9" scope="col" class="centre nowrap"> Mucormycosis Cases  ( steroid therapy)
      </th>

      <?php }else{  

      ?>   <th colspan="8" scope="col" class="centre nowrap"> Mucormycosis Cases  ( steroid therapy)
      </th><?php } ?>


      <?php }else if(isset($_GET['district'])){

      ?>
      <th colspan="9" scope="col" class="centre nowrap"> Mucormycosis Cases    ( steroid therapy)
      </th>
      <?php }else{ ?>

      <th colspan="6" scope="col" class="centre nowrap"> Mucormycosis Cases   ( steroid therapy)
      </th>
      <?php } ?>

      </tr>
      <tr>
      <th scope="col" class="centre nowrap table-sno">S.no</th>
      <th scope="col" class="centre nowrap">State/UT </th>
      <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
      ?>  <th scope="col" class="centre nowrap">District </th><?php 

      } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
      ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

      } ?>
      <th scope="col" class="centre nowrap">Yes</th>
      <th scope="col" class="centre nowrap">No</th>
      </tr>
    </thead> 
  <?php } ?>
    <?php if($type_selection ==11){ ?>
    <thead class="report-heading-box">
      <tr>
      <tr>
      <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2  || $_SESSION['admin']['role_id'] == 13){
      if($_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13 ){
      ?>
      <th colspan="8" scope="col" class="centre nowrap"> Mucormycosis Cases ( steroid therapy)
      </th>
      <?php }else{  

      ?>     <th colspan="7" scope="col" class="centre nowrap"> Mucormycosis Cases ( steroid therapy)
      </th><?php } ?>

      <?php }else if(isset($_GET['district'])){

      ?>
      <?php }else{ ?>

      <th colspan="5" scope="col" class="centre nowrap">  Mucormycosis Cases ( steroid therapy)
      </th>
      <?php } ?>

      </tr>
    
      <tr>

      <th scope="col" class="centre nowrap table-sno">S.no</th>

      <th scope="col" class="centre nowrap">State/UT </th>
      <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
      ?>  <th scope="col" class="centre nowrap">District </th><?php 

      } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
      ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

      } ?>
      <th scope="col" class="centre nowrap">Diabetes</th>
      <th>Immunocompromised Status </th>
      <th>Comorbidity</th>
      </tr>
    </thead> 
  <?php } ?>
     <?php if($type_selection ==7){ ?>
     <thead class="report-heading-box">
        <tr>

        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        if($_SESSION['admin']['role_id'] == 2){
        ?>

        <th colspan="6" scope="col" class="centre nowrap">  Mucormycosis Cases (o2 support received  prior  to onset of Mucormycosis)
        </th>

        <?php }else{  

        ?>      <th colspan="5" scope="col" class="centre nowrap">  Mucormycosis Cases (o2 support received  prior  to onset of Mucormycosis)
        </th><?php } ?>

        <?php }else if(isset($_GET['district'])){

        ?>
        <th colspan="6" scope="col" class="centre nowrap"> Mucormycosis Cases (o2 support received  prior  to onset of Mucormycosis)
        </th>
        <?php }else{ ?>

        <th colspan="5" scope="col" class="centre nowrap">  Mucormycosis Cases (o2 support received  prior  to onset of Mucormycosis)
        </th>
        <?php } ?>

        </tr>
        <tr>
        <th scope="col" class="centre nowrap table-sno">S.no</th>
        <th scope="col" class="centre nowrap">State/UT </th>
        <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
        ?>  <th scope="col" class="centre nowrap">District </th><?php 

        } ?> <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
        ?>  <th scope="col" class="centre nowrap">Hospital </th><?php 

        } ?>
        <th scope="col" class="centre nowrap">Yes  </th>
        <th scope="col" class="centre nowrap">No</th>

        </tr>
    </thead>
  <?php } ?>
 <?php if($type_selection == 10){
    ?>

     <thead class="report-heading-box">
      <tr>
      <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13){
      if($_SESSION['admin']['role_id'] == 2){
      ?>
      
      <th colspan="9" scope="col" class="centre nowrap">Mucormycosis Cases (Mucormycosis classified) 
      </th>

      <?php }else{  

      ?>        <th colspan="9" scope="col" class="centre nowrap">Mucormycosis Cases (Mucormycosis classified) 
      </th><?php } ?> 

      <?php }else if(isset($_GET['district'])){

      ?>
      <th colspan="10" scope="col" class="centre nowrap"> Mucormycosis Cases (Mucormycosis classified) 
      </th>
      <?php }else{ ?>

      <th colspan="8" scope="col" class="centre nowrap">  Mucormycosis Cases (Mucormycosis classified) 
      </th>
      <?php } ?>

      </tr>
      <tr>

      <th scope="col" class="centre nowrap table-sno">S.no</th> 
      <th scope="col" class="centre nowrap">State/UT </th>
      <?php if($_SESSION['admin']['role_id']==2 || $_SESSION['admin']['role_id']==13){
      ?> <th scope="col" class="centre nowrap"> District </th><?php 
      } ?>
      <th scope="col" class="centre nowrap">Rhinocerebral</th>
      <th scope="col" class="centre nowrap">Pulmonary</th>
      <th scope="col" class="centre nowrap">Cutaneous</th>
      <th scope="col" class="centre nowrap">Gastrointestinal</th>
      <th scope="col" class="centre nowrap">Disseminated</th>
      <th scope="col" class="centre nowrap">Uncommon presentations</th>
      </tr>
    </thead>
  <?php } ?>
           
   <tbody> 

      <?php
      $covid =$covid['out_data']??array();
      #echo "----<pre>"; print_r($covid); die;
      if(!empty($covid)){ 
        // start type_selection 
        if(isset($_GET['type_selection']) && $_GET['type_selection']!=10){
        ?>
      
      <?php $count=1;
        $coloum_1='0';
        $coloum_2='0';
        $coloum_3='0';
        $coloum_4='0';
        $coloum_5='0';
        $coloum_6='0';
        $grand_total=0;
        $totalMMDeath=0;
        $totalNoCause=0;
        $totalOtherDeath=0;
        $totalCount_UT=0;
        $totalCount_Cured=0;
        $totalCount_lama=0;

       ?>
      <?php 
      //Start loop foreach
    foreach($covid as $key) {
     //echo '===';die();
         if(isset($_GET['type_selection']) && $_GET['type_selection']==2){
          ?>
          <tr>
             <td><?php echo $count++; ?></td>
              <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13 ){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=2"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=2"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>

                <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                } ?>
                <?php 
                $lama =($key['Count_lama'])?$key['Count_lama']:0;
                $total =  $key['Count_Cured']+$key['Count_UT']+$key['Count_death']+$lama;
                $grand_total+=$total??0;

                $totalMMDeath += $key['mmDeath'];
                $totalNoCause += $key['noCause'];
                $totalOtherDeath += $key['otherDeath'];
                $totalCount_UT += $key['Count_UT'];
                $totalCount_Cured += $key['Count_Cured'];
                $totalCount_lama += $key['Count_lama'];

                $coloum_1+=$key['Count_UT'];
                $coloum_2+=$key['Count_Cured'];
                $coloum_3+=$key['mmDeath'];
                $coloum_4+=$key['otherDeath'];
                $coloum_5+=$key['noCause'];
                $coloum_6+=$key['Count_lama'];
                 ?>

            <td><?php echo $total; ?></td>
            <td><?php echo $key['Count_UT']; ?></td>
            <td><?php echo $key['Count_Cured']; ?></td>
           
            <td><?php echo $key['mmDeath']; ?></td>
            <td><?php echo $key['otherDeath']; ?></td>
            <td><?php echo $key['noCause']; ?></td>
             <td><?php echo $key['Count_lama']; ?></td>
          </tr>
         

        <?php
        }else if($_GET['type_selection']==5){
           ?>
         <tr>    <td><?php echo $count++; ?></td><?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=5"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=5"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                }

                $coloum_1+=$key['Count_Age18'];
                $coloum_2+=$key['Count_AgeAbove18_45'];
                $coloum_3+=$key['Count_AboveAge45_60'];
                $coloum_4+=$key['Count_AgeAbove60'];
                 ?>

            <td><?php echo $key['Count_Age18']; ?></td>
            <td><?php echo $key['Count_AgeAbove18_45']; ?></td>
            <td><?php echo $key['Count_AboveAge45_60']; ?></td>
            <td><?php echo $key['Count_AgeAbove60']; ?></td>
              
          </tr>

        <?php
        }
        else if($_GET['type_selection']==3){
           ?>
          <tr>     <td><?php echo $count++; ?></td>    <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2  || $_SESSION['admin']['role_id'] == 13){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=3"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=3"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                }

                $coloum_1+=$key['Count_covid'];
                $coloum_2+=$key['Count_Noncovid'];

                 ?>
            <td><?php echo $key['Count_covid']; ?></td>
            <td><?php echo $key['Count_Noncovid']; ?></td>
            
            
          </tr>

        <?php
        }else if($_GET['type_selection']==6){
             ?>
          <tr>       <td><?php echo $count++; ?></td>  <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2  || $_SESSION['admin']['role_id'] == 13){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=6"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=6"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                } 
                $coloum_1+=$key['Count_steroid_received'];
                $coloum_2+=$key['Count_steroid_not_received'];

                ?>
            <td><?php echo $key['Count_steroid_received']; ?></td>
            <td><?php echo $key['Count_steroid_not_received']; ?></td>
            
            
          </tr>

        <?php
        }else if($_GET['type_selection']==7){
              ?>
          <tr> <td><?php echo $count++; ?></td>
                    <?php if(isset($_GET['state'])  || $_SESSION['admin']['role_id'] == 13  || $_SESSION['admin']['role_id'] == 2){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=7"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=7"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                } 
                $coloum_1+=$key['Count_oxygen_received'];
                $coloum_2+=$key['Count_oxygen_not_received'];

                ?>
            <td><?php echo $key['Count_oxygen_received']; ?></td>
            <td><?php echo $key['Count_oxygen_not_received']; ?></td>
            
            
          </tr>

        <?php
        }else if($_GET['type_selection']==4){
      ?>
          <tr>
            <td><?php echo $count++; ?></td>  
            <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2  || $_SESSION['admin']['role_id'] == 13){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=4"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td><a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=4"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                } 
              $coloum_1+=$key['Count_Male'];
              $coloum_2+=$key['Count_Female'];
              $coloum_3+=$key['Count_Others'];

                ?>
            <td><?php echo $key['Count_Male']; ?></td>
            <td><?php echo $key['Count_Female']; ?></td>
             <td><?php echo $key['Count_Others']; ?></td>
            
            
          </tr>

        <?php
        }
         else if($_GET['type_selection']==11){
        ?>
          <tr>
           <td><?php echo $count++; ?></td>   <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2  || $_SESSION['admin']['role_id'] == 13){
                      ?><td>

                    <?php echo $key['State_Name']; ?></td><?php 

                  }else{

                     ?><td>

                  <a href="<?php echo base_url() ?>Mucormycosis_report/report?state=<?php echo $key['state_code_lg']; ?>&type_selection=11"><?php echo $key['State_Name']; ?></a></td><?php
                    
                       
                  } ?>
                
                
                <?php if(isset($_GET['state']) || $_SESSION['admin']['role_id'] == 2){
                  ?>  <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?district=<?php echo $key['district_code_lg']; ?>&type_selection=11"><?php echo $key['District_Name_In_English_LG']; ?></a></td><?php 

                } ?>
                 <?php if(isset($_GET['district']) || $_SESSION['admin']['role_id'] == 13){
                  ?>   <td> <a href="<?php echo base_url() ?>Mucormycosis_report/report?hospital=<?php echo $key['hospital_id']; ?>"><?php echo $key['hospital_name']; ?></a></td><?php 

                } 
              $coloum_1+=$key['Count_patient_diebetic'];
              $coloum_2+=$key['Immunocompromised_Status'];
              $coloum_3+=$key['Count_comorbidity'];


                ?>
            <td><?php echo $key['Count_patient_diebetic']; ?></td>
            <td><?php echo $key['Immunocompromised_Status']; ?></td>
             <td><?php echo $key['Count_comorbidity']; ?></td>
             </tr>

        <?php
        }
      }  
      //End loop foreach
    }  // End type_selection 

    
    else{
      ?>
           <?php 
           $count_new=1;
            $coloum_1='0';
            $coloum_2='0';
            $coloum_3='0';
            $coloum_4='0';
            $coloum_5='0';
            $coloum_6='0';
        #echo "<pre>--";  print_r($covid);
           foreach ($covid as $value) {
            // echo '===';die();
                ?> 
                <tr>       
                <td><?php echo $count_new++; ?></td>
               
                <td> 
                  <?php echo $value['State_Name']; ?></th>
                   <?php 
                   if($_SESSION['admin']['role_id']==2 || $_SESSION['admin']['role_id']==13){
                  ?> <td><?php echo $value['District_Name_In_English_LG']; ?></td><?php 
                } 
              $coloum_1+=$value['count_classified_1'];
              $coloum_2+=$value['count_classified_2'];
              $coloum_3+=$value['count_classified_3'];
              $coloum_4+=$value['count_classified_4'];
              $coloum_5+=$value['count_classified_5'];
              $coloum_6+=$value['count_classified_6'];

                ?>
                <td><?php echo $value['count_classified_1']; ?></td>
                <td><?php echo $value['count_classified_2']; ?></td>
                <td><?php echo $value['count_classified_3']; ?></td>
                <td><?php echo $value['count_classified_4']; ?></td>
                <td><?php echo $value['count_classified_5']; ?></td>
                <td><?php echo $value['count_classified_6']; ?></td>
                   </tr>

             <?php 
              } ?>


         <?php 
    }

      ?>
    
    </tbody>
   
   
     
  <?php } 
?> 
    <?php if($_SESSION['admin']['role_id'] == 1){ ?>
       <?php if(isset($grand_total) && $grand_total) { ?>
       <tr class="total">
        <?php if(isset($_GET['state'])){ ?> 
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td>
        <?php } else if(isset($_GET['district'])){ ?> 
          <td colspan="2"><b>Total</b></td>
          <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td> 
        <?php } else { ?>
          <td colspan="2"><b>Total</b></td>
          <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td>
        <?php } ?>

        
      </tr>
    <?php } ?>
    <?php } ?>
    
    <?php if($_SESSION['admin']['role_id'] == 2 || $_SESSION['admin']['role_id'] == 13){ ?>
      <?php if(isset($grand_total)) { ?>
       <tr class="total">
      
        <?php if(isset($_GET['district']) && $_GET['type_selection']==5){ ?> 
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <td><?php echo $coloum_3; ?></td>            
          <td><?php echo $coloum_4; ?></td>
          <!-- <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td> -->
          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==2){?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td>
        <?php }elseif($_GET['type_selection']==2){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $grand_total; ?></td>
          <td><?php echo $totalCount_UT; ?></td>
          <td><?php echo $totalCount_Cured; ?></td>            
          <td><?php echo $totalMMDeath; ?></td>
          <td><?php echo $totalOtherDeath; ?></td>
          <td><?php echo $totalNoCause; ?></td>
          <td><?php echo $totalCount_lama; ?></td>

          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==7){ ?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td> 
          <?php }elseif($_GET['type_selection']==7){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>

          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==4){ ?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td> 
          <td><?php echo $coloum_3; ?></td>
          <?php }elseif($_GET['type_selection']==4){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <td><?php echo $coloum_3; ?></td>
          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==11){?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <td><?php echo $coloum_3; ?></td>
          <?php }elseif($_GET['type_selection']==11){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <td><?php echo $coloum_3; ?></td>
          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==3){?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
         
          <?php }elseif($_GET['type_selection']==3){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <?php }elseif(isset($_GET['district']) && $_GET['type_selection']==6){?>
          <td colspan="4"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <?php }elseif($_GET['type_selection']==6){?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <?php }else{?>
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1; ?></td>
          <td><?php echo $coloum_2; ?></td>
          <td><?php echo $coloum_3; ?></td>            
          <td><?php echo $coloum_4; ?></td>
       <?php } ?>

        
      </tr>
      
      <?php } else{?> 
        <tr  class="total">      
          <td colspan="3"><b>Total</b></td>
          <td><?php echo $coloum_1;?></td>
          <td><?php echo $coloum_2;?></td>
          <td><?php echo $coloum_3;?></td>           
          <td><?php echo $coloum_4;?></td>
          <td><?php echo $coloum_5;?></td>
          <td><?php echo $coloum_5;?></td>
            </tr>
      <?php }
      } ?>

     
 <?php
}else{

?>

<table id="print_datatable_inner" class="table table-bordered tablefont evenTable">
<thead class="report-heading-box">
  <tr>

        <th>S.No</th> 
        
          <th>Hospital Name</th>
          <th>Patient Name</th>
          
          <th>Father Name</th>
          <th>Patient age</th>
          <th>Patient gender</th>
          <th>    Patient      Contact Number</th>

          <th>Patient address</th>

          <th>Patient village </th>
           <th>Patient State </th> 
           <th>Patient District </th>
          <th>Patient Pincode</th>
          <th>Covid NonCovid</th>

          <th>Test Date</th>
          <th>ICMR UNIQUE ID</th>
          <th>Mucormycosis Date</th>
           <th>Type of case</th>
          <th>Mucormycosis classified</th>
         
          <th>Patient Medical status</th>
          <th>Date of Death (if)</th>
        
          <th>Patient diabetes</th>
          <th>Immunocompromised Status</th>
          <th>Steroid received</th>
          <th>Oxygen received</th>
          <th>Remarks</th> 
          <th>created on</th>
      </tr>
<tbody>
  
<?php 
$count=1;
$hospital_data =$hospital_data['out_data']??array();
if(!empty($hospital_data)){ //echo "<pre>"; print_r($hospital_data); exit;
foreach ($hospital_data as $key) {
 ?>  <tr>
      <td class="left nowrap"><?php echo $count++; ?></td>
      <td class="left nowrap"><?php echo $key['hospital_name'];  ?></td>
      <td class="left nowrap"><?php echo $key['patient_name'];  ?></td>

      <td class="left nowrap"><?php echo $key['father_name'];  ?></td>
      <td class="left nowrap"><?php echo $key['Patient_age'];  ?></td>
      <td class="left nowrap"><?php echo $key['patient_gender'];  ?></td>
      <td class="left nowrap"><?php echo $key['contact_number'];  ?></td>
      <td class="left nowrap"><?php echo $key['patient_address'];  ?></td>
      <td class="left nowrap"><?php echo $key['patient_village'];  ?></td>

      <td class="left nowrap"><?php echo $key['State_Name'];  ?></td>
      <td class="left nowrap"><?php echo $key['District_Name_In_English_LG'];  ?></td>
      <?php if($key['patient_pin_Code_LG'] != 0){ ?>
      <td class="left nowrap"><?php echo $key['patient_pin_Code_LG'];  ?></td>

      <?php  }else{
      ?>  <td></td><?php 

      } ?>

      <td class="left nowrap"><?php if($key['covidNonCovid']==1){

      ?>Yes<?php 
      }else if($key['covidNonCovid']==0){
      ?>No<?php 
      } ?> </td>
      <?php if($key['date_covid_test'] == '0000-00-00'){ ?>

      <td></td>

      <?php }else{

      ?> <td class="left nowrap"><?php echo date('d-m-Y', strtotime($key['date_covid_test']));  ?></td>
      <?php 
      }
      ?>
      <td class="left nowrap"><?php echo $key['icmr_unique_id'];  ?></td>

      <td class="left nowrap"><?php echo date('d-m-Y', strtotime($key['mucormycosis_Date']));  ?></td>
      <td class="left nowrap"><?php if($key['patient_type_of_case']==1){

      ?>Clinically Reported<?php 
      }else if($key['patient_type_of_case']==2){
      ?>Lab Confirmed<?php 
      } ?> </td>

      <td class="left nowrap"><?php echo $key['classification_description'];  ?></td>
      <td class="left nowrap"><?php if($key['patient_present_status_id']==1){

      ?>Cured<?php 
      }else if($key['patient_present_status_id']==2){
      ?>Under Treatment<?php 
      }else if($key['patient_present_status_id']==3){
      ?>Death<?php 
      }else if($key['patient_present_status_id']==4){
      ?>LAMA <?php 
      }  ?> 
      </td>

      <td class="left nowrap"><?php if($key['patient_present_status_id']==3){ echo !empty($key['date_of_death'])?date('d-M-Y',strtotime($key['date_of_death'])):'';}  ?></td>
      <td class="left nowrap"><?php if($key['patient_diebetic']==1){

      ?>Yes<?php 
      }else if($key['patient_diebetic']==0){
      ?>No<?php 
      } ?> 
      </td>
      <td class="left nowrap"><?php if($key['Immunocompromised_Status']==1){
      ?>Yes<?php 
      }else if($key['Immunocompromised_Status']==0){
      ?>No<?php 
      } ?> 
      </td>
      <td class="left nowrap">
      <?php if($key['steroid_received']==1){
      ?>Yes<?php 
      }else if($key['steroid_received']==0){
      ?>No<?php 
      } ?> 
      </td>
      <td class="left nowrap"><?php if($key['oxygen_received']==1){

      ?>Yes<?php 
      }else if($key['oxygen_received']==0){
      ?>No<?php 
      } ?> 
      </td>
      <td class="left nowrap"><?php echo $key['remarks'];  ?></td>
      <td class="left nowrap"><?php echo date('d-m-Y', strtotime($key['created_on'])); ?></td>

 </tr> <?php 
}} ?>

</tbody>
<?php 
} ?>       


          
          </table>  
                   </div> 
            </div> 
           </div> 
          
           </div>
           </div>
          
          </div>
          <!--End Row-->
         
         
          
          
        </div>
        
     <!--pagination start here-->
        
      <!--pagination end here-->

  </div>
  <!-- End container-fluid-->
</div>
<!--End content-wrapper-->

  </div>
</div>
<!-- End main_content_iner -->

<!-- Footer start here -->
<?php $this->load->view('common/footer'); ?>
<!-- End Footer  -->
</section>
<!-- main content part end -->
<?php $this->load->view('common/footerbottom'); ?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
      
      
<script>
  
        $(document).ready(function() {
          
          $('#print_datatable').DataTable({
            dom: 'Bfrtip',
            "paging":   false,
            "ordering": false,
            "searching": false,
            "pageLength": 50,
            "ordering": false,
             buttons: [
                {
                  extend: 'excel',
                  text: 'Export to Excel', 
                  className: 'btn btn-success',               
                  title: 'Mucormycosis Report-<?php echo date('Y-m-d H:i:s'); ?>',
                  exportOptions: {
                          columns: "thead th:not(.noExports)",
                          rows:"tbody tr:not(.noExports)"
                        }
                } , 
                {
                  extend: 'pdf',
                  text: 'Export to Pdf',
                  className: 'btn btn-success',
                  title: 'Mucormycosis Report-<?php echo date('Y-m-d H:i:s'); ?>',
                  exportOptions: {
                          columns: "thead th:not(.noExports)",
                          rows:"tbody tr:not(.noExports)"
                        }
                        
                } 
              ]
          });

          $('#print_datatable_inner').DataTable( {
            dom: 'Bfrtip',
            "paging":   false,
            "ordering": false,
            "searching": false,
            "pageLength": 50,
            "ordering": false,
             buttons: [
                {
                  extend: 'excel',
                  text: 'Export to Excel', 
                  className: 'btn btn-success',               
                  title: 'Mucormycosis Report-<?php echo date('Y-m-d H:i:s'); ?>',
                  exportOptions: {
                          columns: "thead th:not(.noExports)",
                          rows:"tbody tr:not(.noExports)"
                        }
                } , 
                {
                  extend: 'pdf',
                  text: 'Export to Pdf',
                  className: 'btn btn-success',
                  title: 'Mucormycosis Report-<?php echo date('Y-m-d H:i:s'); ?>',
                  exportOptions: {
                          columns: "thead th:not(.noExports)",
                          rows:"tbody tr:not(.noExports)"
                        },
                  orientation: 'landscape',
                  pageSize: 'A2',
                        
                } 
              ]
          } );
        } );
      </script>  


