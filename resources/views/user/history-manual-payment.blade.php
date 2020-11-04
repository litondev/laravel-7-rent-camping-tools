@extends("layouts.user")

@section("page_title","Riwayat Pembayaran Manual")

@section("sc_header")
<style>
.history-manual-payment-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}
</style>
@endsection

@section("content")
	@if(count($historyManualPayment) > 0)
		<div class="container">
			<div class="row p-5">
				<div class="col-12 text-center mb-4">
					<h4>Riwayat Pembayaran Manual</h4>
				</div>

				@foreach($historyManualPayment as $item)
					<div class="col-md-4 col-lg-4 col-sm-12 cursor-pointer text-center mt-3 mb-3 history-manual-payment-card p-2">
						<div class="row p-3">
							<div class="col-12">
								<img src="{{asset('images/proofs/'.$item->proof)}}" class="border-radius-10" 
									width="70px"
									height="70px"
									onclick="window.open('{{asset('images/proofs/'.$item->proof)}}')">
								<br>
								<span class="small ft-10">
									*Klik gambar
								</span>
							</div>

							<div class="col-12 mt-2 clearfix">
								<div class="float-left">
									<b class="badge badge-dark">
										Tgl Kirim : {{$item->get_human_created_at}}
									</b>
								</div>
								<div class="float-right">
									@if($item->status == "validasi")
									<span class="badge badge-primary">Validasi</span>
									@elseif($item->status == "success")
									<span class="badge badge-success">Success</span>
									@elseif($item->status == "failed")
									<span class="badge badge-danger">Gagal</span>
									@endif						
								</div>
							</div>

							<div class="col-12 mt-2">
								<button class="btn btn-violet btn-block text-light"
									data-toggle="modal" 
									data-target="#modal-detail-manual-payment-{{$item->id}}">
									Detail
								</button>
							</div>
						</div>
					</div>

				 	@include("user.history-manual-payment.modal-detail")
				@endforeach		

				@if(count($historyManualPayment) > 0)
					<div class="col-12 p-3">
						<nav class="float-right paginate-overflow">						
							{{$historyManualPayment->links()}}					  
						</nav>					
					</div>
				@endif
			</div>
		</div>
	@else
		<div class="container">
			<div class="row p-5">
				<div class="col-12 text-center">
					<h4>Riwayat Pembayaran Manual</h4>
				</div>

				<div class="col-12 text-center">
					<img class="img-fluid"
						src="{{asset('images/not-found.png')}}" 
						width="40%">
						<br>
					<span class="ft-20">
						<b>Data Tidak Ditemukan</b>
					</span>
						<br>
					<span class="ft-13">
						Riwayat Pembayaran Manual Tidak Ditemukan
					</span>
				</div>
			</div>
		</div> 
	@endif
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>
@endsection