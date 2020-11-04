@extends("layouts.user")

@section("page_title","Product")

@section("sc_header")
<style>
#box-search{
	border-radius: 10px;
	background: white;
}

#box-search-mobile{
	z-index:1035;
	top:0px;
	bottom:0px;
	position:fixed;
	display:none;
	overflow: auto;
}

#box-search-mobile > div{
	height: 100%;
}
</style>
@endsection

@section("content")
<!-- DEKSTOP -->
<div class="container">
	<div class="row pb-5 pt-5">
		<div class="col-3">
			<div class="box-camp p-3" 
				id="box-search">
				@include("user.product.category")

				@include("user.product.price")			
			</div>
		</div>

		@include("user.product.product")	
	</div>
</div>
<!-- DEKSTOP -->

<!-- MOBILE -->
<div class="container-fluid" 
	id="box-search-mobile">
	<div class="row">
		<div class="col-2 p-3 bg-dark">
			<i class="fa fa-times text-white fa-2x cursor-pointer" 
				onclick="onOpenBoxSearchMobile('hide')"></i>
		</div>

		<div class="col-10 pt-2 pb-2" style="background:white">
			@include("user.product.category")

			@include("user.product.price")			
		</div>
	</div>
</div>
<!-- MOBILE -->
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){
	$("#box-search").hide();
	$("#icon-search-mobile").show();
	$("#box-product").removeClass("col-md-9 col-sm-12 col-lg-9").addClass("col-md-12 col-sm-12 col-lg-12");
	$(".list-product").removeClass("col-4").addClass("col-6");
}

function tablet_res(){
	$("#box-search").hide();
	$("#icon-search-mobile").show();
	$("#box-product").removeClass("col-md-9 col-sm-12 col-lg-9").addClass("col-md-12 col-sm-12 col-lg-12");
	$(".list-product").removeClass("col-4").addClass("col-6");
}

function destop_res(){
	$("#box-search").show();
	$("#icon-search-mobile").hide();
	$("#box-product").removeClass("col-md-12 col-sm-12 col-lg-12").addClass("col-md-9 col-sm-12 col-lg-9");
	$(".list-product").removeClass("col-6").addClass("col-4");
}
</script>

<script>
function onOpenBoxSearchMobile(way){
	if(way == 'show'){
		$("#box-search-mobile").show();
		$("body").css({"overflow" : "hidden"});
	}else{
		$("#box-search-mobile").hide();
		$("body").css({"overflow" : "auto"});
	}
}
</script>
@endsection