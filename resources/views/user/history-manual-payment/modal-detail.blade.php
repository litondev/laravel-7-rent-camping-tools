<div class="modal no-border" 
	id="modal-detail-manual-payment-{{$item->id}}">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Detail Riwayat Pembayaran Invoice #{{$item->invoice_id}}
        	</h5>

        	<button class="close"
        		type="button" 					        		
        		data-dismiss="modal" 
        		aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
        	<table class="table table-hover">				        		        	
        		<tr>
        			<td class="no-border">
        				Bukti
        			</td>
        			<td class="no-border">
        				<img src="{{asset('images/proofs/'.$item->proof)}}" class="border-radius-10 cursor-pointer img-fluid" 										
							onclick="window.open('{{asset('images/proofs/'.$item->proof)}}')">
        			</td>
        		</tr>
        		<tr>
        			<td class="no-border">
        				Status
        			</td>
        			<td class="no-border">			        			
        				@if($item->status == "validasi")
						<span class="badge badge-primary">Validasi</span>
						@elseif($item->status == "success")
						<span class="badge badge-success">Success</span>
						@elseif($item->status == "failed")
						<span class="badge badge-danger">Gagal</span>
						@endif		
        			</td>
        		</tr>
        		<tr>
        			<td class="no-border">
        				Keterangan
        			</td>
        			<td class="no-border">
        				{{$item->description}}
        			</td>
        		</tr>
        		@if($item->status_description)
        		<tr>
        			<td class="no-border">
        				Keterangan Balasan
        			</td>
        			<td class="no-border">
        				{{$item->status_description}}
        			</td>
        		</tr>
        		@endif
        		<tr>
        			<td class="no-border">
        				Tgl Kirim
        			</td>
        			<td class="no-border">
        				{{$item->get_human_created_at}}
        			</td>
        		</tr>			       
        	</table>
        </div>      
      </div>
	</div>
</div>  