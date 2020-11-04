<div class="col-12">
	<div class="card shadow mb-4">      					
		<div class="card-body">
			<h5>Pembayaran Manual</h5>

			<hr/>

			<table class="table table-borderless table-hover">
				<tr>
					<td>Id</td>
					<td>Status</td>
					<td>Deskripsi</td>
					<td>Bukti</td>
					<td>Dikirim</td>
				</tr>
				@forelse($invoice->manual_payments as $item)
				<tr>
					<td>
						<a href="{{url('admins/manual-payment/detail/'.$item->id)}}">
							{{$item->id}}
						</a>
					</td>
					<td>
						@if($item->status == 'validasi')
							<span class="badge badge-primary">
								Validasi
							</span>
	          			@elseif($item->status == 'failed')
	          				<span class="badge badge-danger">
	          					Gagal
	          				</span>
	          			@elseif($item->status == 'success')
	          				<span class="badge badge-success">
	          					Berhasil
	          				</span>
	          			@endif	
		          	</td>
					<td>{{$item->description}}</td>
					<td>
						<a href="{{asset('images/proofs/'.$item->proof)}}" target="_blank">
							<img src="{{asset('images/proofs/'.$item->proof)}}" width="50px">
						</a>
					</td>
					<td>
						{{$item->get_human_created_at}}
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="100" class="text-center">
						Data tidak ditemukan
					</td>
				</tr>
				@endforelse							
			</table>
		</div>
	</div>
</div>