<div class="col-12">
		<div class="card shadow mb-4">      
    	<div class="card-body">
    		<h5>Detil Pembayaran Manual #{{$manualPayment->id}}</h5>

    		<hr/>

    		<div class="table-responsive mt-2">
    			<table class="table table-borderless table-hover">		    			
    				<tr>
    					<td>Bukti</td>
    					<td>Deskripsi</td>
    					@if($manualPayment->status_description)			        					
    						<td>Status Deskripsi</td>
    					@endif
    					<td>Status</td>
    					<td>Dikirim</td>
    				</tr>
    				<tr>
    					<td>
    						<a href="{{asset('images/proofs/'.$manualPayment->proof)}}" target="_blank">
									<img src="{{asset('images/proofs/'.$manualPayment->proof)}}" height="50px">	          	
								</a>
    					</td>
    					<td>{{$manualPayment->description}}</td>
    					@if($manualPayment->status_description)			        					
    						<td>{{$manualPayment->status_description}}</td>
    					@endif
    					<td>
    						@if($manualPayment->status == 'validasi')
								<span class="badge badge-primary">
									Validasi
								</span>
		          			@elseif($manualPayment->status == 'failed')
		          				<span class="badge badge-danger">
		          					Gagal
		          				</span>
		          			@elseif($manualPayment->status == 'success')
		          				<span class="badge badge-success">
		          					Berhasil
		          				</span>
		          			@endif	    
    					</td>
    					<td>{{$manualPayment->get_human_created_at}}</td>
    				</tr>
    				<tr>
    					<td colspan="10" class="text-center">
    						@if($manualPayment->invoice->status_payment == 'unpaid' && $manualPayment->invoice->status == 'payment' && $manualPayment->status == "validasi")
    							<hr/>
    							<button class="btn btn-primary"
    								onclick="window.location='{{url('admins/manual-payment/success/'.$manualPayment->id)}}';this.disabled = true">
    								<i class="fa fa-check"></i> 
    								Tandai Berhasil
    							</button>
    							<button class="btn btn-danger"
    								data-toggle="modal"
    								data-target="#modal-reason-failed">
    								<i class="fa fa-times"></i> 
    								Tandai Gagal
    							</button>
    						@endif
    					</td>
    				</tr>
    			</table>
    		</div>	        		
    	</div>
    </div>
</div>