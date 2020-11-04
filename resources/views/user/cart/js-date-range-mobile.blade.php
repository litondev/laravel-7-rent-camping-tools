<script>
$('#date-mobile').daterangepicker({ 
	startDate: moment().add("{{config('app.expired_invoice')}}", 'day'), 
	endDate: moment().add("{{intval(config('app.min_rent_product'))+intval(config('app.expired_invoice'))}}", 'day'),
	minDate : moment(moment().add("{{config('app.expired_invoice')}}", 'day').format("YYYY-MM-DD 00:00:00")),
	timePicker: true,
}).on('apply.daterangepicker', function(ev, picker) {
	if(moment(picker.endDate.format('YYYY-MM-DD HH:mm:SS')).isAfter(moment(picker.startDate.format('YYYY-MM-DD HH:mm:SS')).add("{{config('app.max_rent_product')}}",'day'))){
 		$(this).val('');

  		swal.fire({
  		  	title: "Maaf Terjadi Kesalahan",
  		  	icon : "warning",
  		  	text : "Max Sewa Adalah {{config('app.max_rent_product')}} Hari"
  		});

  		return false;
	}

	if(moment(picker.startDate.format('YYYY-MM-DD HH:mm:SS')).add("{{config('app.min_rent_product')}}",'day').isAfter(picker.endDate.format('YYYY-MM-DD HH:mm:SS'))){
		$(this).val('');

	  	swal.fire({
	  		title: "Maaf Terjadi Kesalahan",
	  		icon : "warning",
		  	text : "Min Sewa Adalah {{config('app.min_rent_product')}} Hari"
	  	});

	    return false;
	}

	$(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:00'));  		      
}).on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
}).on("outsideClick.daterangepicker",function(ev,picker){
  $(this).val('');
});

$("#date-mobile").val(""); 
</script>