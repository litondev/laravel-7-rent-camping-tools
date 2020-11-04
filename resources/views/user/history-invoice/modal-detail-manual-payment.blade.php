<div class="modal no-border" 
	id="modal-detail-manual-payment-{{$item->id}}">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Detail Pembayaran Manual Invoice #{{$item->id}}
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
        	<table class="table table-hover">				        		        					        	
        		@foreach($item->manual_payments as $item_payment)				        
        		<tr>
        			<td class="no-border">
	        			@if($item_payment->status == "validasi")
						<span class="badge badge-primary">Validasi</span>
						@elseif($item_payment->status == "success")
						<span class="badge badge-success">Success</span>
						@elseif($item_payment->status == "failed")
						<span class="badge badge-danger">Gagal</span>
						@endif
	        		</td>
	        		<td class="no-border">
	        			{{$item_payment->description}}
	        		</td>
	        		<td class="no-border">
	        			{{$item_payment->get_human_created_at}}
	        		</td>
	        		<td class="no-border">
	        			<img src="{{asset('images/proofs/'.$item_payment->proof)}}" 
	        				class="border-radius-10 cursor-pointer" 
	        				height="10%"							        												
							onclick="window.open('{{asset('images/proofs/'.$item_payment->proof)}}')"/>		      
	        		</td>			
	        	</tr>
	     		@endforeach
	        </table>
        </div>      
      </div>
	</div>
</div>