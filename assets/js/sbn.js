
/*start@reccuringOrder*/
/*click function..*/
$(".dtr_rc").on('click',function(){
    if($(this).prop('checked')==true){
      $(".dt_rc").css("display","block");
      $("#delivery_asap").attr("disabled", true);
      $(".delivery-asap").css("display","none");
    }
    if($(this).prop('checked')==false){
      $(".dt_rc").css("display","none");
      $("#delivery_asap").removeAttr("disabled");
      $(".delivery-asap").css("display","block");
    }
  });
/*end of click function..*/
var start = moment();
$('input[name="start_date_recurring"]').daterangepicker({
    startDate: start,
    minDate: start,
    drops:'up'
});
$('input[name="start_date_recurring"]').on('apply.daterangepicker', function(ev, picker) {
  $('.date_recurring_start').val(picker.startDate.format('YYYY-MM-DD'));
  $('.date_recurring_end').val(picker.endDate.format('YYYY-MM-DD'));

   var start = moment(picker.startDate.format('YYYY-MM-DD'));
   var end   = moment(picker.endDate.format('YYYY-MM-DD'));
   var diff = start.diff(end, 'days'); // returns correct number
   console.log(diff);
});
/*end@recuuringOrder*/
