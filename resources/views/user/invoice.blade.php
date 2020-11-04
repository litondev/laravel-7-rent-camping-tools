@extends("layouts.user")

@section("page_title","Invoice")

@section("sc_header")
<style>
.list-info-invoice{
 border-radius:10px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row p-2">
		<div class="col-12 text-center p-3">
			<h4>Detail Invoice #{{$invoice->id}}</h4>
		</div>

		<!-- INFO -->
		@include("user.invoice.info")

		<div class="col-12">
			<div class="row p-3">
				<!-- DETAIL -->
				@include("user.invoice.detail")

				<!-- SIDEBAR -->
				@include("user.invoice.info-sidebar")
			</div>
		</div>
	</div>
</div>
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>

<!-- INFO -->
@include("user.invoice.js-info")

<!-- CANCEL ORDER -->
@include("user.invoice.js-cancel-order")

<!-- ON CHOSE IMAGE -->
@include("user.invoice.js-on-chose-image")

<!-- FORM VALIDATION REVIEW -->
@if(
	$invoice->status == "in rent" || 
	$invoice->status == "backing stuff"
)
	@foreach($invoice->order_items as $item)
	<script>
		$("#form-review-{{$item->id}}").parsley().on('form:validate',function(){
			if($("#form-review-{{$item->id}}").parsley().isValid()){
				$("#button-submit-form-review-{{$item->id}}").html("<i class='fa fa-spinner fa-spin'></i>")
				$("#button-submit-form-review-{{$item->id}}").attr("disabled",true);
				$("#button-cancel-form-review-{{$item->id}}").attr("disabled",true);
			}else{
				toastr.warning("Sepertinya ada data yang belum valid","");
			}
		});
	</script>
	@endforeach

	<script>
		function showFormReviewProduct(id){	
			$(".form-review-product").hide();
			$("#form-review-product-"+id).show();
		}

		function hideFormReviewProduct(){
			$(".form-review-product").hide();
		}
	</script>
@endif
@endsection