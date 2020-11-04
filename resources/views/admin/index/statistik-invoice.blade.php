<div class="col-md-6 col-lg-6 col-sm-12">
	<div class="card shadow mb-4">      
	<div class="card-body">
			<h5>Statistik 5 Invoice Terakhir</h5>
			<hr/>
			<div class="table-responsive mt-2">
			<table class="table table-borderless table-hover">
				<tr>
					<td><b>Id</b></td>	        					
					<td><b>Status</b></td>
				</tr>	

				@forelse($data->invoice as $item)  				
    				<tr>
    					<td>
    						{{$item->id}}
    					</td>
    					<td>
    						@if($item->status == 'pending')
    						<span class="badge badge-warning">
    							Pending
    						</span>
    						@elseif($item->status == 'payment')
    						<span class="badge badge-primary">
    							Pembayaran
    						</span>
    						@elseif($item->status == "canceled")
    						<span class="badge badge-danger">
    							Batal
    						</span>
    						@elseif($item->status == "completed")
    						<span class="badge badge-success">
    							Selesai
    						</span>
    						@elseif($item->status == "prepare")
    						<span class="badge badge-primary">
    							Persiapan
    						</span>
    						@elseif($item->status == "rejected")
    						<span class="badge badge-danger">
    							Ditolak
    						</span>
    						@elseif($item->status == "expired invoice")
    						<span class="badge badge-danger">
    							Kadaluarsa Invoice
    						</span>
    						@elseif($item->status == "expired payment")
    						<span class="badge badge-danger">
    							Kadaluarsa Pembayaran
    						</span>
    						@elseif($item->status == "in rent")
    						<span class="badge badge-success">
    							Dalam Penyewaan
    						</span>
    						@elseif($item->status == "withdrawing stuff")
    						<span class="badge badge-success">
    							Pengambilan Barang
    						</span>
    						@elseif($item->status == "backing stuff")
    						<span class="badge badge-success">
    							Pengembalian Barang
    						</span>
    						@endif
    					</td>
    				</tr>
				@empty
    				<tr>
    					<td colspan="2" class="text-center">
    						<h5>Tidak ditemukan</h5>
    					</td>
    				</tr>
				@endforelse

				@if(count($data->invoice))
				<tr>
					<td colspan="2">
						<div class="float-right">
							<a href="{{url('admins/invoice')}}">
								Lihat Semuanya
							</a>
						</div>
					</td>
				</tr>
				@endif
			</table>
		</div>
		</div>
	</div>
</div>