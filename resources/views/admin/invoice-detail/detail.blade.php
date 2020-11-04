<div class="col-12">
	<div class="card shadow mb-4">      					
		<div class="card-body">
				<h5>Detail Invoice #{{$invoice->id}} - {{$invoice->user->first_name}}</h5>

			<hr/>

			<div class="table-responsive">
				<table class="table table-borderless table-hover">
					<tr>
						<td>Status</td>
						<td>
							@if($invoice->status == "pending")
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
					 		@elseif($invoice->status == "completed")
					 		<b class="badge badge-success text-light">
					 			Selesai
					 		</b>
					 		@elseif($invoice->status == "rejected")
					 		<b class="badge badge-danger text-light">
					 			Ditolak
					 		</b>
					 		@elseif($invoice->status == 'canceled')
					 		<b class="badge badge-danger text-light">
					 			Dibatalkan
					 		</b>
					 		@elseif($invoice->status == 'expired payment')
					 		<b class="badge badge-danger text-light">
					 			Kadaluarsa Pembayaran
					 		</b>
					 		@elseif($invoice->status == 'expired invoice')
					 		<b class="badge badge-danger text-light">
					 			Kadaluarsa Invoice
					 		</b>
					 		@endif
						</td>
					</tr>
					<tr>
						<td>Awal Rental</td>
						<td>
							<b class="text-succes">
								{{$invoice->start_rent}}
							</b>
						</td>
					</tr>
					<tr>
						<td>Akhir Rental</td>
						<td>
							<b class="text-danger">
								{{$invoice->end_rent}}
							</b>
						</td>
					</tr>

					<tr>
						<td>Total</td>
						<td>
							<b class="text-success">
								Rp {{number_format($invoice->total,"2")}}
							</b>							
						</td>
					</tr>
					<tr>
						<td>Jaminan</td>
						<td>
							{{$invoice->guaranteing}}
						</td>
					</tr>
					<tr>
						<td>Status Pembayaran</td>
						<td>
							@if($invoice->status_payment == 'unpaid')
		          				<span class="badge badge-danger">
		          					Belum Dibayar
		          				</span>
		          			@elseif($invoice->status_payment == 'expired')
		          				<span class="badge badge-danger">
		          					Kadaluarsa Pembayaran
		          				</span>
		          			@else
		          				<span class="badge badge-success">
		          					Dibayar
		          				</span>
		          			@endif
						</td>
					</tr>
					<tr>
						<td>Kadaluarsa Pembayaran</td>
						<td>
							{{$invoice->expired_payment}}
						</td>
					</tr>
					<tr>
						<td>Dibuat</td>
						<td>{{$invoice->get_human_created_at}}</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							@if($invoice->status == 'pending')
								<button class="btn btn-success mt-2"
									onclick="window.location='{{url('admins/invoice/action/payment/'.$invoice->id)}}';this.disabled = true">
									Lanjut Proses Pembayaran
								</button>
								<button class="btn btn-danger mt-2"
									data-toggle="modal"
									data-target="#modal-reason-rejected">
									Tolak Orderan
								</button>

								<div class="alert alert-info text-left mt-3">
									* Lanjut proses pembayaran
									<br>
										1.) Akan menandai status invoice menjadi pembayaran 
									<br>
										2.) User sudah dapat membayar
									<br>
									<br>
									* Tolak Orderan
									<br>
									 	1.) Akan menandai status invoice menjadi ditolak 
								</div>
							@elseif($invoice->status == 'prepare')
								<button class="btn btn-success mt-2"
									onclick="window.location='{{url('admins/invoice/action/withdrawing-stuff/'.$invoice->id)}}';this.disabled = true">
									Tandai Invoice, barang sudah dapat di ambil
								</button>

								<div class="alert alert-info text-left mt-3">
									* Tandai Invoice, barang sudah dapat di ambil
									<br>
										1.) Akan menandai status invoice menjadi pengambilan barang 
									<br>
										2.) User sudah dapat mengambil barang										
								</div>
							@elseif($invoice->status == "withdrawing stuff")
								<button class="btn btn-success mt-2"
									onclick="window.location='{{url('admins/invoice/action/in-rent/'.$invoice->id)}}';this.disabled = true">
									Tanda Invoice, dalam penyewaan
								</button>

								<div class="alert alert-info text-left mt-3">
									* Tanda Invoice, dalam penyewaan
									<br>
										1.) Akan menandai status invoice menjadi dalam penyewaan 
									<br>
										2.) User sudah mengambil barangnya disertai dengan jaminannya
								</div>
							@elseif($invoice->status == "in rent")
								<button class="btn btn-success mt-2"
									onclick="window.location='{{url('admins/invoice/action/backing-stuff/'.$invoice->id)}}';this.disabled = true">
									Tanda Invoice, barang harus dikembalikan
								</button>

								<div class="alert alert-info text-left mt-3">
									* Tanda Invoice, barang harus dikembalikan
									<br>
										1.) Akan menandai status invoice menjadi pengembalian barang  
										<br>
										2.) User harus mengembalikan barang dalam 1x24 jam
										<br> 
										3.) Jika user belum mengembalikan barang dalam 1x24 jam maka status akan berubah menjadi kadaluarsa invoice serta admin dapat menambahkan detail denda
								</div>
							@elseif($invoice->status == 'backing stuff')
								<button class="btn btn-success mt-2"
									onclick="window.location='{{url('admins/invoice/action/completed/'.$invoice->id)}}';this.disabled = true">
									Tanda Invoice, barang telah dikembalikan dan selesai
								</button>

								<div class="alert alert-info text-left mt-3">
									* Tanda Invoice, barang telah dikembalikan dan selesai
									<br>
										1.) Akan menandai status invoice menjadi selesai
										<br>
										2.) User dapat mengambil jaminan
								</div>
							@elseif($invoice->status == 'payment')
								<div class="alert alert-info mt-3">
									Sekarang untuk mengubah status invoice menjadi persiapan.
									<br> bisa dilakukan pada detail pembayaran manual
								</div>
							@elseif($invoice->status == 'expired invoice')
								@if(!$invoice->is_fine)
									<button class="btn btn-danger"
										data-toggle="modal"
										data-target="#modal-add-fine">
										Berikan Denda
									</button>										
								@else
									<button class="btn btn-danger"
										data-toggle="modal"
										data-target="#modal-edit-fine">
										Edit Denda
									</button>
								@endif

								<div class="alert alert-info mt-3 text-left">
									1.) Pastikan saat memberikan denda barang sudah dikembalikan oleh siuser  <br>
									2.) Karena denda setiap product memiliki denda yang berbeda-beda maka penjumlahan harus secara manual <br>
									3.) Jika user tidak mengembalikan selama lebih dari 7 - 30 hari bisa dilakukan tindakan lebih lanjut <br>
								</div>
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>