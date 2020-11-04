@extends("layouts.user")

@section("page_title","Riwayat Invoice")

@section("sc_header")
<style>
.history-invoice-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}

.history-invoice-card:nth-child(even){
	background: rgb(139,21,158,0.1);
	border-radius: 20px;
}
</style>
@endsection

@section("content")
@if(count($invoice) > 0)
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center mb-4">
				<h4>Riwayat Invoice</h4>
			</div>

			@foreach($invoice as $item)
				<div class="col-12 cursor-pointer mt-3 mb-5 history-invoice-card p-2">
					<div class="row p-3">	
						<div class="col-md-2 col-lg-2 col-sm-12">					
							<img 
								src="{{asset('images/invoice.png')}}" 
								class="img-fluid">
						</div>

						<div class="col-md-10 col-lg-10 col-sm-12 mt-2">
							<div class="row p-2">
								<div class="col-12">								
									<span class="badge badge-info">
										<b>No Invoice : </b>  #{{$item->id}}
									</span>
								</div>

								<div class="col-12 mt-2 ft-12">
									<b>Tgl Order : </b> {{$item->get_human_created_at}}
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 mt-2 ft-12 text-success">
									<b>Tgl Sewa : </b> {{$item->start_rent}}
								</div> 

								<div class="col-lg-6 col-md-6 col-sm-6 mt-2 ft-12 text-danger">
									<b>Tgl Sewa Berakhir : </b> {{$item->end_rent}}
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
									@if($item->status == "completed")
									<b class="badge badge-success">
										Status : Selesai
									</b>
									@elseif(
										$item->status == "expired payment" ||
										$item->status == "rejected" || 
										$item->status == "canceled" || 
										$item->status == "expired invoice"
									)
									<b class="badge badge-danger">
										Status : 
										@if($item->status == "expired payment")
											Kadaluarasa Pembayaran
										@elseif($item->status == "expired invoice")
											Kadaluarasa Invoice
										@elseif($item->status == "rejected")
											Ditolak
										@elseif($item->status == "canceled")
											Dibatalkan
										@endif
									</b>
									@elseif($item->status == "pending")
							 		<b class="badge badge-warning text-light">
							 			Status : Pending
							 		</b>
							 		@elseif($item->status == "payment")
							 		<b class="badge badge-primary text-light">
							 			Status : Pembayaran
							 		</b>
							 		@elseif($item->status == "prepare")
							 		<b class="badge badge-primary text-light">
							 			Status : Persiapan
							 		</b>
							 		@elseif($item->status == "withdrawing stuff")
							 		<b class="badge badge-success text-light">
							 			Status : Pengambilan Barang
							 		</b>
							 		@elseif($item->status == "in rent")
							 		<b class="badge badge-success text-light">
							 			Status : Dalam Penyewaan
							 		</b>
							 		@elseif($item->status == "backing stuff")
							 		<b class="badge badge-success text-light">
							 			Status : Pengembalian Barang
							 		</b>
							 		@endif
								</div>	

								<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
									<b class="badge badge-success">
										Total : Rp {{number_format($item->total,"2")}}
									</b>
								</div>	

								<div class="col-12 pt-2 mt-2">
									<button class="btn btn-violet text-light mt-2" 
										data-toggle="modal" 
										data-target="#modal-detail-invoice-{{$item->id}}">
										Detail Invoice
									</button>

									<button class="btn btn-primary text-light mt-2" 
										data-toggle="modal" 
										data-target="#modal-detail-product-invoice-{{$item->id}}">
										Detail Product
									</button>

									@if($item->is_fine)
									 <button class="btn btn-danger text-light mt-2" 
									 	data-toggle="modal" 
									 	data-target="#modal-detail-fine-invoice-{{$item->id}}">
									 	Detail Denda
									 </button>
									@endif

									@if($item->manual_payments_count > 0)
									 <button class="btn btn-success text-light mt-2"
									  data-toggle="modal" 
									  data-target="#modal-detail-manual-payment-{{$item->id}}">
									 	Detail Pembayaran
									 </button>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
		
				@include("user.history-invoice.modal-detail-manual-payment")

				@include("user.history-invoice.modal-detail-product")
			
				@include("user.history-invoice.modal-detail-invoice")	

				@include("user.history-invoice.modal-detail-fine")		 		
			@endforeach		

			<div class="col-12 p-3">
				<nav class="float-right paginate-overflow">						
					{{$invoice->links()}}					  
				</nav>					
			</div>
		</div>
	</div>	
@else
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center">
				<h4>Riwayat Invoice</h4>
			</div>

			<div class="col-12 text-center">
				<img 
					src="{{asset('images/not-found.png')}}" 
					width="40%"
					class="img-fluid">
				<br>
				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>
				<br>
				<span class="ft-13">
					Riwayat Invoice Tidak Ditemukan
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