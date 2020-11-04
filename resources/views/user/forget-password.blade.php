@extends("layouts.user")

@section("page_title","Lupa Password")

@section("sc_header")
<style>
.box-forget-password{
	margin: auto;
	border: 0px solid rgb(127,127,127,0.3) !important;
	border-radius: 10px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row pt-5 pb-5">
		<div class="col-md-4 col-sm-12 col-lg-4 box-camp box-forget-password">
			<div class="row">
				<div class="col-12">
					<div class="text-center text-camp-violet">
						<h2>Lupa Password</h2>
					</div>				
					<div class="text-center">
						<img class="img-fluid" 
							src="{{asset('images/forget-password.png')}}">
					</div>
				</div>

				<div class="col-12">				
				 <form
				 	id="form-forget-password"
				 	action="{{url('/action-forget-password')}}"
				 	method="post"/>

				 	@csrf

				 	<div class="form-group row">
				 		<div class="col-12 text-camp-violet">
				 			Email
				 		</div>
				 		<div class="col-12">
				 			<input class="form-control input-camp-violet"
				 				type="text"
				 				name="email"
						 		value="{{old('email')}}"
						 		data-parsley-required
						 		data-parsley-type="email">
				 		</div>
				 	</div>
				 
				 	<div class="form-group row">
				 		<div class="col-12">
				 			<button class="btn btn-violet btn-block text-center text-light border-radius-10 box-button-camp no-border"
				 				id="button-forget-password">
				 				<i class="fab fa-telegram-plane"></i>
				 				Kirim
				 			</button>
				 		</div>
				 	</div>
				 </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){
	$(".box-forget-password").css({"border" : "0px solid white"});
	$(".box-forget-password").removeClass("box-camp");
}

function tablet_res(){
	$(".box-forget-password").css({"border" : "0px solid white"});
	$(".box-forget-password").removeClass("box-camp");
}

function destop_res(){	
	$(".box-forget-password").css({"border" : "2px solid rgb(127,127,127,0.3)"});
	$(".box-forget-password").removeClass("box-camp").addClass("box-camp");
}
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-forget-password").parsley().on('form:validate',function(){
	if($("#form-forget-password").parsley().isValid()){
		$("#button-forget-password").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-forget-password").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection