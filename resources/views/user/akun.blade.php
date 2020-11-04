@php
	$akun = [
		[
			"title" => "Profil",
			"img" => "profil.png",
			"link" => "profil"
		],
		[
			"title" => "Keinginan",
			"img" => "wishlist.png",
			"link" => "wishlist"
		],
		[
			"title" => "Invoice",
			"img" => "invoice.png",
			"link" => "invoice"
		],
		[
			"title" => "Riwayat Invoice",
			"img" => "invoice-history.png",
			"link" => "history-invoice"
		],
		[
			"title" => "Riwayat Pembayaran Manual",
			"img" => "manual-payment.png",
			"link" => "history-manual-payment"
		]
	];
@endphp

@extends("layouts.user")

@section("page_title","Akun")

@section("sc_header")
<style>
.akun-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row p-5">
		<div class="col-12 text-center mb-4 text-camp-violet">
			<h4>Akun</h4>
		</div>

		@foreach($akun as $item)
		<div class="col-md-4 col-lg-4 col-sm-12 cursor-pointer text-center mt-5 mb-5 akun-card p-2"
		 	onclick="window.location='{{url('/'.$item['link'])}}'">
			<img class="img-fluid" 
				src="{{asset('images/akuns/'.$item['img'])}}">
				<br>
				<br>
			<span class="ft-13 text-camp-violet">
				<b>{{$item['title']}}</b>
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