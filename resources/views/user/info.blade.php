@extends("layouts.user")

@section("page_title","Info")

@section("sc_header")
<style>
.info-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row pt-5 pb-5">
		<div class="col-12 text-center mb-4 text-camp-violet">
			<h4>Info</h4>
		</div>
		
		@foreach($info as $item)
		<div class="col-md-4 col-lg-4 col-sm-12 cursor-pointer text-center mt-5 mb-5 info-card p-2" 
			onclick="window.location=`{{url('/info/'.$item->slug)}}`">
			<img class="img-fluid" 
				src="{{asset('images/infos/'.$item->image)}}">
				<br>
				<br>
			<span class="ft-13 text-camp-violet">
				<b>{{$item->title}}</b>
			</span>
		</div>
		@endforeach
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
@endsection