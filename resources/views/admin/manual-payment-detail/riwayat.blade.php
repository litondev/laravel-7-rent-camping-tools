<div class="col-12">
	<div class="card shadow mb-4">      
    	<div class="card-body">
    		<h5>Riwayat Pembayaran Manual Invoice</h5>

    		<hr/>

    		<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">		    			
    				<tr>
    					<td>Id</td>
    					<td>Bukti</td>
    					<td>Deskripsi</td>
    					<td>Status</td>
    					<td>Dikirim</td>
    				</tr>
    				@foreach($manualPayment->invoice->manual_payments as $item)
    				<tr>
    					<td>
    						<a href="{{url('admins/manual-payment/detail/'.$item->id)}}">{{$item->id}}</a>
    					</td>
    					<td>
    						<a href="{{asset('images/proofs/'.$item->proof)}}" target="_blank">
									<img src="{{asset('images/proofs/'.$item->proof)}}" height="50px">	          	
								</a>
    					</td>
    					<td>{{$item->description}}</td>
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
    					<td>{{$item->get_human_created_at}}</td>
    				</tr>
    				@endforeach
    			</table>
    		</div>	        		
    	</div>
    </div>
</div>