


 <script type="text/javascript">
$(function() {

    var start = moment();
    var end = moment();
    
      var min_date = moment().subtract(14, 'days');
    

    function cb(start, end) {
      //alert(start);
    

      $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('.reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

    } 

    $('.reportrange').daterangepicker({
     
        
        startDate: start,
        endDate: end,
        maxDate:moment(),
        minDate:min_date,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 2 Week': [moment().subtract(14, 'days'), moment()],
          /* 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]*/
        }
    }, cb);

    cb(start, end);

});
</script> 