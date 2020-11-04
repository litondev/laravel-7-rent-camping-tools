<script>
$("#form-checkout-dekstop").parsley().on('form:validate',function(){
	if($("#form-checkout-dekstop").parsley().isValid()){
		$("#button-checkout-dekstop").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-checkout-dekstop").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-checkout-mobile").parsley().on('form:validate',function(){
	if($("#form-checkout-mobile").parsley().isValid()){
		$("#button-checkout-mobile").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-checkout-mobile").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>