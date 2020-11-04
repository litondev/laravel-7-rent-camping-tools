<div class="modal no-border" 
id="modal-reason-failed">
<div class="modal-dialog no-border">
    <div class="modal-content no-border">        
    	<div class="modal-header">
      	<h5 class="modal-title">
      		Berikan Alasan Anda
      	</h5>
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
      	</button>
    	</div>

      <div class="modal-body no-border">
    		<form
    			action="{{url('admins/manual-payment/failed/'.$manualPayment->id)}}"
    			method="post"
    			id="form-reason-failed">

    			@csrf

    			<div class="form-group row">
    				<div class="col-3">
    					Alasan
    				</div>
    				<div class="col-9">
    					<textarea class="form-control" 
    						name="status_description"
    						data-parsley-required></textarea>
    				</div>
    			</div>
    			
    			<div class="form-group">
    				<button class="btn btn-primary" 
    					type="submit" 
    					id="button-reason-failed">
    					<i class="fab fa-telegram-plane"></i> Kirim
    				</button>
    			</div>
    		</form>
      </div>      
    </div>
</div>
</div>