<div class="modal no-border" 
	id="modal-add-slider">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Tambah slider
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
      		<form
      			action="{{url('admins/slider')}}"
      			method="post"
      			id="form-add-slider"
      			enctype="multipart/form-data">											

      			@csrf

      			<div class="form-group row">
      				<div class="col-3">
      					Link
      				</div>
      				<div class="col-9">
      					<input 
      					 	type="text" 
      					 	class="form-control" 
      					 	name="link"
      					 	data-parsley-required
                  data-parsley-type="url"
      					 	placeholder="Link">
      				</div>
      			</div>

      			<div class="form-group row">
      				<div class="col-3">
      					Gambar
      				</div>
      				<div class="col-9">
      					<input 
      						type="file"				
      						name="image"
      						data-parsley-required
      						placeholder="Gambar"
      						class="form-control"
      						onchange="onChoseImage(event)">

                <small class="text-info">
                  * Gambar ukuran width 1512px and height 756px
                </small>
      				</div>
      			</div>

      			<div class="form-group">
      				<button class="btn btn-primary" 
      					type="submit" 
      					id="button-add-slider">
      					<i class="fa fa-plus"></i> Tambah
      				</button>
      			</div>
      		</form>
        </div>      
      </div>
	</div>
</div>