
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
    <li class="breadcrumb-item"><a href="#">Media</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('infographics-list');?>">Infographics</a></li>
    <li class="breadcrumb-item active" aria-current="page">InfoGraphics Details</li>
  </ol>
</nav>

</div>
</div>



</div>

 </div> 
 </section> 
  <?php $d = date_create($infographics[0]->created_at);?>
  <!--start box gallery-->
  <div class="container">
  <section class="infographic">
  <div class="row">
  <div class="col-md-12"><h1 class="section-heading"><?php echo $infographics[0]->title;?></h1>
  </div>
  <div class="col-md-12 blockquote-footer mb-2 section-heading">Posted On: <?php echo $d->format('d/m/Y');?></div>
  </div>  
    <div class="row">
      <div class="col-md-10"></div>
      <div class="col-md-2"> 
       <!--  <i class="fas fa-print"></i>  -->
      <!--   <a href="#null" onclick="printContent('<?php echo $infographics[0]->id;?>')" class="readmore">Print</a> -->
      &nbsp;&nbsp;<i class="fas fa-download"></i> <a href="<?php echo base_url('infographics-listing/').$infographics[0]->id;?>" class="readmore">Download</a>
     </div></div>
  </section>
  <div class="row mt-3">
   <div class="col-md-12">
   <div class="card mb-2">
           <a href=""><img  class="card-img-top" src="<?php echo base_url().$infographics[0]->path_big;?>" alt="infographics1"></a> 
            <!-- <div class="share">
             <div class="row">
             <div class="col-md-12"> Migrant Workers and Labourers</div>
             </div>
             </div>-->
             </div>
    </div>
   
  </div>

  </div>

    <script type="text/javascript">
<!--
function printContent(id){
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
//-->
</script>

  
  
 

