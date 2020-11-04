<div class="modal no-border" 
id="modal-blokir-user">
<div class="modal-dialog no-border">
    <div class="modal-content no-border">        
    	<div class="modal-header">
      	<h5 class="modal-title">
      		Blokir User
      	</h5>
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
      	</button>
    	</div>

      <div class="modal-body no-border">
    		<form
    			action="{{url('admins/user/blokir')}}"
    			method="post"
    			id="form-blokir-user"
    			enctype="multipart/form-data">											

    			@csrf

    			<input type="hidden" name="id">

    			<div class="form-group row">
    				<div class="col-3">
    					Deskripsi Blokir
    				</div>
    				<div class="col-9">
    					<textarea
    						name="description_blokir"
    						placeholder="Deskripsi Blokir"
    						data-parsley-required
						class="form-control"></textarea>
    				</div>
    			</div>

    			<div class="form-group">
    				<button class="btn btn-primary" 
    					type="submit" 
    					id="button-blokir-user">
    					<i class="fab fa-telegram-plane"></i> Kirim
    				</button>
    			</div>
    		</form>
      </div>      
    </div>
</div>
</div>  