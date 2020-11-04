<div class="modal no-border" 
	id="modal-detail-invoice-{{$item->id}}">
<div class="modal-dialog no-border">
  <div class="modal-content no-border">        
  	<div class="modal-header">
    	<h5 class="modal-title">
    		Detail Invoice #{{$item->id}}
    	</h5>
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
  	</div>

    <div class="modal-body no-border">
    	<table class="table table-hover">				        		        	
    		<tr>
    			<td class="no-border">Status</td>

    			<td class="no-border">
    				@if($item->status == "completed")
					<b class="badge badge-success">
						Status : Selesai
					</b>
					@elseif(
                        $item->status == "expired payment" || 
                        $item->status == "rejected" || 
                        $item->status == "canceled" || 
                        $item->status == "expired invoice"
                    )
					<b class="badge badge-danger">
						Status : 
						@if($item->status == "expired payment")
							Kadaluarasa Pembayaran
						@elseif($item->status == "expired invoice")
							Kadaluarasa Invoice
						@elseif($item->status == "rejected")
							Ditolak
						@elseif($item->status == "canceled")
							Dibatalkan
						@endif
					</b>
					@elseif($item->status == "pending")
			 		<b class="badge badge-warning text-light">
			 			Status : Pending
			 		</b>
			 		@elseif($item->status == "payment")
			 		<b class="badge badge-primary text-light">
			 			Status : Pembayaran
			 		</b>
			 		@elseif($item->status == "prepare")
			 		<b class="badge badge-primary text-light">
			 			Status : Persiapan
			 		</b>
			 		@elseif($item->status == "withdrawing stuff")
			 		<b class="badge badge-success text-light">
			 			Status : Pengambilan Barang
			 		</b>
			 		@elseif($item->status == "in rent")
			 		<b class="badge badge-success text-light">
			 			Status : Dalam Penyewaan
			 		</b>
			 		@elseif($item->status == "backing stuff")
			 		<b class="badge badge-success text-light">
			 			Status : Pengembalian Barang
			 		</b>
			 		@endif
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Tgl Order</td>
    			<td class="no-border">
    				{{$item->get_human_created_at}}
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Total Biaya</td>
    			<td class="no-border">
					<b class="badge badge-success">
						Total Biaya : Rp {{number_format($item->total,"2")}}
					</b>
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Tgl Sewa</td>
    			<td class="no-border text-success">
    				{{$item->start_rent}}
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Tgl Sewa Berakhir</td>
    			<td class="no-border text-danger">
    				{{$item->end_rent}}
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Tgl Expired Pembayaran</td>
    			<td class="no-border">
    				{{$item->expired_payment}}
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Pembayaran</td>
    			<td class="no-border">
    				@if($item->status_payment == "unpaid")
						<b class="badge badge-danger">Belum Bayar</b>
					@elseif($item->status_payment ==  "expired")
						<b class="badge badge-danger text-light">Kadaluarsa Pembayaran</b>
					@elseif($item->status_payment == "paid")
						<b class="badge badge-success text-light">Sudah Bayar</b>
					@endif
    			</td>
    		</tr>

    		<tr>
    			<td class="no-border">Jaminan</td>
    			<td class="no-border">
    				<b>{{$item->guaranteing}}</b>
    			</td>
    		</tr>
    	</table>
    </div>      
  </div>
</div>
</div> 