<div class="card shadow mb-4">      
<div class="card-body">
 <h5>Detail Invoice #{{$manualPayment->invoice_id}}</h5>

 <hr/>

 <div class="table-responsive mt-2">
  <table class="table table-borderless table-hover">		    						        				
	<tr>
	 <td>Invoice</td>
	 <td>
	  <a href="{{url('admins/invoice/detail/'.$manualPayment->invoice_id)}}">
		{{$manualPayment->invoice_id}}
	  </a>
	 </td>
	</tr>
	<tr>
	 <td>Total Bayar</td>
	 <td>
	       <b class="text-success">Rp {{number_format($manualPayment->invoice->total,"2")}}</b>
	 </td>
	</tr>
	<tr>
	 <td>Awal Rental</td>
	 <td>
	       <b>{{$manualPayment->invoice->start_rent}}</b>
	 </td>
	</tr>
	<tr>
	 <td>Akhir Rental</td>
	 <td>
		<b>{{$manualPayment->invoice->end_rent}}</b>
	 </td>
	</tr>
	<tr>
	 <td>Kadaluarsa Pembayaran</td>
	 <td>
		<b>{{$manualPayment->invoice->expired_payment}}</b>
	 </td>
	</tr>
	<tr>
	 <td>Status</td>
	 <td>
	       @if($manualPayment->invoice->status == "pending")
 		<b class="badge badge-warning text-light">
 			Pending
 		</b>
 		@elseif($manualPayment->invoice->status == "payment")
 		<b class="badge badge-primary text-light">
 			Pembayaran
 		</b>
 		@elseif($manualPayment->invoice->status == "prepare")
 		<b class="badge badge-primary text-light">
 			Persiapan
 		</b>
 		@elseif($manualPayment->invoice->status == "withdrawing stuff")
 		<b class="badge badge-success text-light">
 			Pengambilan Barang
 		</b>
 		@elseif($manualPayment->invoice->status == "in rent")
 		<b class="badge badge-success text-light">
 			Dalam Penyewaan
 		</b>
 		@elseif($manualPayment->invoice->status == "backing stuff")
 		<b class="badge badge-success text-light">
 			Pengembalian Barang
 		</b>
 		@elseif($manualPayment->invoice->status == "completed")
 		<b class="badge badge-success text-light">
 			Selesai
 		</b>
 		@elseif($manualPayment->invoice->status == "rejected")
 		<b class="badge badge-danger text-light">
 			Ditolak
 		</b>
 		@elseif($manualPayment->invoice->status == 'canceled')
 		<b class="badge badge-danger text-light">
 			Dibatalkan
 		</b>
 		@elseif($manualPayment->invoice->status == 'expired payment')
 		<b class="badge badge-danger text-light">
 			Kadaluarsa Pembayaran
 		</b>
 		@elseif($manualPayment->invoice->status == 'expired invoice')
 		<b class="badge badge-danger text-light">
 			Kadaluarsa Invoice
 		</b>
 		@endif
	 </td>
	</tr>

	<tr>
	 <td>Status Pembayaran</td>
	 <td>
		@if($manualPayment->invoice->status_payment == 'unpaid')
		 <b class="badge badge-danger">Belum Bayar</b>
		@elseif($manualPayment->invoice->status_payment == 'paid')
		 <b class="badge badge-success">Dibayar</b>
		@else
		 <b class="badge badge-danger">Kadaluarsa Pembayaran</b>
		@endif
	 </td>
	</tr>

	<tr>
	 <td colspan="2" class="text-center">
	@if($manualPayment->invoice->status_payment == 'unpaid' && $manualPayment->invoice->status == 'payment' && $isThreeValidasi == 0)
		<button class="btn btn-success mt-3" 			        								
			onclick="window.location='{{url('admins/manual-payment/paid/'.$manualPayment->invoice->id)}}';this.disabled = true">
			<i class="fa fa-check"></i> 
			Tandai Sudah Bayar
		</button>
		<br>
		<small class="text-primary">
			* Tandai Sudah Bayar Akan Mengubah Status Invoice Menjadi Persiapan
		</small>
	@else
		@if($manualPayment->invoice->status == 'payment')
			<small class="text-primary">
				* Button tandai sudah bayar akan muncul ketika tidak ada status validasi pada pembayaran manual
			</small>
		@endif
	@endif
	 </td>
	</tr>
  </table>
 </div>		    			
</div>
</div>