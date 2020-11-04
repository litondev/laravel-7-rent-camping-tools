<!DOCTYPE HTML>
<html>
	<head>
		<style>
			table {
				padding: 10px !important;
			}

	        .clearfix::after {
	  			content: "";
		  		clear: both;
	  			display: table;
			}

			.list-invoice{
				padding: 10px;
				margin-left: 10px;
			}

			.list-item-invoice{
				padding: 0px;
			}
		</style>
	</head>
<body>
	<div class="clearfix">		
		<div style="float:left">
			<h3>Invoice No #{{$invoice->id}}</h3>				
		</div>
		<div style="float:right">
			Dibuat Pada 
			<br>
			<b>{{$invoice->created_at}}</b>
		</div>
	</div>

	<div class="clearfix">		
		<div style="float:left">
			<div class="list-invoice">
				<div class="list-item-invoice">Status Sekarang</div>
				<div class="list-item-invoice">
					@if($invoice->status == "completed")
					<b class="badge badge-success">
						Selesai
					</b>
					@elseif(
						$invoice->status == "expired payment" || 
						$invoice->status == "rejected" || 
						$invoice->status == "canceled" || 
						$invoice->status == "expired invoice"
					)
					<b class="badge badge-danger">
						@if($invoice->status == "expired payment")
							Kadaluarasa Pembayaran
						@elseif($invoice->status == "expired invoice")
							Kadaluarasa Invoice
						@elseif($invoice->status == "rejected")
							Ditolak
						@elseif($invoice->status == "canceled")
							Dibatalkan
						@endif
					</b>
					@elseif($invoice->status == "pending")
			 		<b class="badge badge-warning text-light">
			 			Pending
			 		</b>
			 		@elseif($invoice->status == "payment")
			 		<b class="badge badge-primary text-light">
			 			Pembayaran
			 		</b>
			 		@elseif($invoice->status == "prepare")
			 		<b class="badge badge-primary text-light">
			 			Persiapan
			 		</b>
			 		@elseif($invoice->status == "withdrawing stuff")
			 		<b class="badge badge-success text-light">
			 			Pengambilan Barang
			 		</b>
			 		@elseif($invoice->status == "in rent")
			 		<b class="badge badge-success text-light">
			 			Dalam Penyewaan
			 		</b>
			 		@elseif($invoice->status == "backing stuff")
			 		<b class="badge badge-success text-light">
			 			Pengembalian Barang
			 		</b>
			 		@endif
				</div>
			</div>		

			<div class="list-invoice">
				<div class="list-item-invoice">Tgl Sewa</div>
				<div class="list-item-invoice">
					<b>{{$invoice->start_rent}}</b>
				</div>
			</div>

			<div class="list-invoice">
				<div class="list-item-invoice">Tgl Sewa Berakhir</div>
				<div class="list-item-invoice">
					<b>{{$invoice->end_rent}}</b>
				</div>
			</div>

			<div  class="list-invoice">
				<div class="list-item-invoice">Jaminan</div>
				<div class="list-item-invoice">
					<b>{{$invoice->guaranteing}}</b>
				</div>
			</div>
		</div>

		<div style="float:right">
			@if($invoice->status != "pending")
				<div class="list-invoice">
					<div class="list-item-invoice">Status Pembayaran</div>
					<div class="list-item-invoice">
						@if($invoice->status_payment == "unpaid")
							<b>Belum bayar</b>
						@elseif($invoice->status_payment == "expired")
							<b>Expired</b>
						@elseif($invoice->status_payment == "paid")
							<b>Sudah Bayar</b>
						@endif
					</div>
				</div>

				<div class="list-invoice">
					<div class="list-item-invoice">Expired Pembayaran</div>
					<div class="list-item-invoice">
						{{$invoice->expired_payment}}
					</div>
				</div>
			@endif
		</div>
	</div>

	<table>
		<tr>
			<th>Product name</th>
			<th>Harga</td>
		</tr>

		@foreach($invoice->order_items as $order_item)
		<tr>
			<td width="400px">
				{{$order_item->product->name}}
			</td>
			<td width="400px">
				<span style="color:green">
					<b>{{$order_item->product->get_rent_price}}</b>
				</span>
			</td>
		</tr>
		@endforeach
	</table>

	<table>
		<tr>
			<td width="200px">
				<b>Jumlah Biaya Total</b>
			</td>
			<td width="100px">
				<b style="color:green">
					Rp {{number_format($invoice->total,"2")}}
				</b>
			</td>
		</tr>	
	</table>
</body>
</html>