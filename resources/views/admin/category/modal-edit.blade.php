  <div class="modal no-border" 
	id="modal-edit-category">
	<div class="modal-dialog no-border">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Edit category
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
      		<form      	
      			method="post"
      			id="form-edit-category"
      			enctype="multipart/form-data">											

      			@csrf

      			<div class="form-group row">
      				<div class="col-3">
      					Nama
      				</div>
      				<div class="col-9">
      					<input 
      					 	type="text" 
      					 	class="form-control" 
      					 	name="name"
      					 	data-parsley-required
      					 	placeholder="Nama">
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
      						placeholder="Gambar"
      						class="form-control"
      						onchange="onChoseImage(event)">
      					<small class="text-info">
      						* Pilih gambar jika ingin mengubah yang lama <br>
                  * Gambar ukuran width 150px and height 82px
      					</small>
      				</div>
      			</div>

      			<div class="form-group">
      				<button class="btn btn-success" 
      					type="submit" 
      					id="button-edit-category">
      					<i class="fa fa-edit"></i> Edit
      				</button>
      			</div>
      		</form>
        </div>      
      </div>
	</div>
  </div>