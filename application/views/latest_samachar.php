<?php //echo '====';print_r($sainik_samachar[0]->document_path); ?>
<!--middle section start here-->
<section class="top_space">
<div class="container">
<div class="row">
<div class="col-md-12">
 <div class="breadcrumb-bg">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_text">
    <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo $tran_lang['home'];?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('previous-editions');?>"><?php echo $tran_lang['sainik_samachar'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $tran_lang['latest_magazine'];?></li>
  </ol>
</nav>
</div>
</div>
</div>

 </div> 
 </section>
 <div class="container height_600px" id="container">
 </div>
  


    
  <script src="<?php echo base_url();?>assets-front/js/latest_samachar_doc/libs/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets-front/js/latest_samachar_doc/libs/html2canvas.min.js"></script>
    <script src="<?php echo base_url();?>assets-front/js/latest_samachar_doc/libs/three.min.js"></script>
    <script src="<?php echo base_url();?>assets-front/js/latest_samachar_doc/libs/pdf.min.js"></script>


 <script type="text/javascript">
      window.PDFJS_LOCALE = {
        pdfJsWorker: '<?php echo base_url();?>assets-front/js/latest_samachar_doc/pdf.worker.js',
        pdfJsCMapUrl: 'cmaps'
      };
    </script>

    <script src="<?php echo base_url();?>assets-front/js/latest_samachar_doc/dist/3dflipbook.js"></script>
    <script type="text/javascript">

 
      $('#container').FlipBook({
        //pdf: '<?php echo base_url();?>books/pdf/FoxitPdfSdk.pdf',
        pdf: '<?php echo base_url().$sainik_samachar[0]->document_path;?>',
        template: {
          html: '<?php echo base_url();?>templates/default-book-view.html',
          styles: [
            '<?php echo base_url();?>assets-front/css/latest_samachar_css/short-black-book-view.css'
          ],
          links: [
            {
              rel: 'stylesheet',
              href: '<?php echo base_url();?>assets-front/css/latest_samachar_css/font-awesome.min.css'
            }
          ],
          script: '<?php echo base_url();?>assets-front/js/latest_samachar_doc/default-book-view.js'
        }
      });
    
    </script>  
    
<script type="text/javascript">
$(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        /*maxDate:moment(),*/
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 2 Week': [moment().subtract(12, 'days'), moment()],
          /* 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
        }
    }, cb);

    cb(start, end);

});
</script>

</html>