@extends("layouts.admin")

@section("content")  
<div class="container-fluid">
  	<div class="row">
  		<div class="col-md-7 col-lg-7 col-sm-12">
  			<div class="row">		
  				@include("admin.invoice-detail.detail")
	    		
	    		@include("admin.invoice-detail.manual-payment")
	    	</div>
    	</div>

    	<div class="col-md-5 col-lg-5 col-sm-12">
			@include("admin.invoice-detail.product")
    	</div>
	</div>
	
	@include("admin.invoice-detail.modal-add-fine")

	@include("admin.invoice-detail.modal-edit-fine")

	@include("admin.invoice-detail.modal-reason-rejected")	
</div>
@endsection

@section("sc_footer")
<!-- MASK -->
<script>
$("input[name=fine_total]").mask("000.000.000",{reverse: true});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-reason-rejected").parsley().on('form:validate',function(){
	if($("#form-reason-rejected").parsley().isValid()){
		$("#button-reason-rejected").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-reason-rejected").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-add-fine").parsley().on('form:validate',function(){
	if($("#form-add-fine").parsley().isValid()){
		$("#button-add-fine").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-fine").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-edit-fine").parsley().on('form:validate',function(){
	if($("#form-edit-fine").parsley().isValid()){
		$("#button-edit-fine").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-fine").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection