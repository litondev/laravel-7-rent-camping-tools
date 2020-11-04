<div class="col-md-6 col-lg-6 col-sm-12">
		<div class="card shadow mb-4">      
    	<div class="card-body">
  			<h5>Statistik 5 Pembayaran Terakhir</h5>
  			<hr/>
  			<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">
    				<tr>
    					<td><b>Id</b></td>	        					
    					<td><b>Status</b></td>
    				</tr>	      
    				@forelse($data->manualPayment as $item)  				
        				<tr>
        					<td>
        						{{$item->id}}
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
        				</tr>
    				@empty
        				<tr>
        					<td colspan="2" class="text-center">
        						<h5>Tidak ditemukan</h5>
        					</td>
        				</tr>
    				@endforelse

    				@if(count($data->manualPayment))
    				<tr>
    					<td colspan="2">
    						<div class="float-right">
    							<a href="{{url('admins/manual-payment')}}">
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