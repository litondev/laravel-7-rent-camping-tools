@extends("layouts.user")

@section("page_title","Info Detail")

@section("sc_header")
<style>
.box-info-detail{
	border-radius: 10px;
	padding:20px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row pt-5 pb-5">		
		<div class="col-12 box-camp box-info-detail">
			<div class="row">
				<div class="col-12 text-center mb-3">
					<h4>{{ucwords($info->title)}}</h4>
				</div>

				<div class="col-12">
					<div class="ft-18">
						{{ucwords($info->sub_title)}}
					</div>
					<div class="ft-15">
						Terakhir diupdate {{$info->get_human_updated_at}}
					</div>
				</div>
				
				<div class="col-12 mt-3">				
					{!! $info->content !!}
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
	$(".box-info-detail").css({"border" : "0px solid white"});
	$(".box-info-detail").removeClass("box-camp");
}

function tablet_res(){
	$(".box-info-detail").css({"border" : "0px solid white"});
	$(".box-info-detail").removeClass("box-camp");
}

function destop_res(){	
	$(".box-info-detail").css({"border" : "0px solid rgb(127,127,127,0.3)"});
	$(".box-info-detail").removeClass("box-camp").addClass("box-camp");
}
</script>
@endsection