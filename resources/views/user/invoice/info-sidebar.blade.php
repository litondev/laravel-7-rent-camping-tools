<div class="col-md-4 col-lg-4 col-sm-12">							
	<div class="col-12 list-info-invoice box-camp mb-4">
		<div class="row p-2">
			<div class="col-12 text-center">
				<b>Aksi Tersedia</b>
			</div>

			<div class="col-12 text-center mb-3">					
				@if(
					$invoice->status == "payment" && 
					$invoice->status_payment != "paid"
				)
				<div class="mt-3">
					<button class="btn btn-primary" onclick="window.location='{{url('manual-payment')}}'">
						<i class="fa fa-dollar-sign"></i> Pembayaran Manual
					</button>
				</div>
				@endif

				<button class="btn btn-success mt-2" 
					onclick="window.open('{{url('action/download-pdf-invoice/'.$invoice->id)}}')">
					<i class="fa fa-download"></i> Download Pdf
				</button>

				@if(
					$invoice->status == "pending" || 
					$invoice->status == "payment" || 
					$invoice->status == "prepare"
				)
					<button class="btn btn-danger mt-2" 
						onclick="cancelOrder('{{$invoice->id}}')">
						<i class="fa fa-times"></i> Batalkan
					</button>
				@endif
			</div>

			<div class="col-12 text-center">
				<b>Penjelassan Status Invoice Aktif</b>
			</div>

			<div class="col-12 mt-3 ft-14">
				<i class="fa fa-square text-warning"></i> 
					<b>Pending</b> : 
					<br> status yang menandakan invoice akan di validasi oleh admin 
				<br>

				<i class='fa fa-square text-primary'></i>
					<b>Pembayaran</b> :
					<br> status yang menandakan anda harus membayar sebelum waktu expired yang di tentukan
				<br>

				<i class="fa fa-square text-primary"></i>
					<b>Persiapan</b> : 
					<br> status yang menandakan barang akan dipersiapkan
				<br>

				<i class="fa fa-square text-success"></i>
					<b>Pengambilan Barang</b> : 
					<br> status yang menandakan barang sudah dapat di ambil
				<br>

				<i class="fa fa-square text-success"></i>
					<b>Dalam Penyewaan</b> : 
					<br> status yang menandakan barang dalam penyewaan anda
				<br>

				<i class="fa fa-square text-success"></i>
					<b>Pengembalian Barang</b> : 
					<br> status yang menandakan barang harus di kembailkan
			</div>
		</div>						
	</div>						
</div>