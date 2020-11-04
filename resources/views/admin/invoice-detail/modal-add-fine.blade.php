<!-- MODAL ADD FINE -->
<div class="modal no-border" 
	id="modal-add-fine">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
            Denda
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
      		<form
      			action="{{url('admins/invoice/fine')}}"
      			method="post"
      			id="form-add-fine"
      			enctype="multipart/form-data">											

      			@csrf

            	<input type="hidden" name="id" value="{{$invoice->id}}">

      			<div class="form-group row">
      				<div class="col-3">
      					Deskripsi Denda
      				</div>
      				<div class="col-9">
      					<textarea class="form-control" 
                  			name="fine_description" 
                  			data-parsley-required></textarea>
      				</div>
      			</div>

      			<div class="form-group row">
      				<div class="col-3">
      					Total Denda
      				</div>
      				<div class="col-9">
      					<input 
      						type="text"
      						class="form-control"
      						name="fine_total"
      						data-parsley-required/>
      				</div>
      			</div>

      			<div class="form-group">
      				<button class="btn btn-primary" 
      					type="submit" 
      					id="button-add-fine">
      					<i class="fab fa-telegram-plane"></i> Kirim
      				</button>
      			</div>
      		</form>
        </div>      
      </div>
	</div>
</div>
<!-- MODAL ADD FINE -->