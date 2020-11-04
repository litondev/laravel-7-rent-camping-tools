@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-8 col-lg-8 col-sm-12">
  			<div class="row">
  				@include("admin.manual-payment-detail.detail")

				@include("admin.manual-payment-detail.riwayat")
			</div>
		</div>

		<div class="col-md-4 col-lg-4 col-sm-12">
			@include("admin.manual-payment-detail.detail-invoice")
		</div>
  	</div>
  </div>

  @include("admin.manual-payment-detail.modal-reason-failed")
@endsection

@section("sc_footer")
<script>
$("#form-reason-failed").parsley().on('form:validate',function(){
	if($("#form-reason-failed").parsley().isValid()){
		$("#button-reason-failed").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-reason-failed").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection