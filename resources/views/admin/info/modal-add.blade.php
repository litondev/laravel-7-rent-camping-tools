<div class="modal no-border" 
	id="modal-add-info">
	<div class="modal-dialog no-border modal-lg">
      <div class="modal-content no-border">        
      	<div class="modal-header">
        	<h5 class="modal-title">
        		Tambah info
        	</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>

        <div class="modal-body no-border">
      		<form
      			action="{{url('admins/info')}}"
      			method="post"
      			id="form-add-info"
      			enctype="multipart/form-data">											

      			@csrf

      			<div class="form-group row">
      				<div class="col-3">
      					Judul
      				</div>
      				<div class="col-9">
      					<input 
      					 	type="text" 
      					 	class="form-control" 
      					 	name="title"
      					 	data-parsley-required
      					 	placeholder="Judul">
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
                  * Gambar ukuran width 150px and height 82px
                </small>
      				</div>
      			</div>

      			<div class="form-group row">
      				<div class="col-3">
      					Sub Judul
      				</div>
      				<div class="col-9">
      					<input 
      						type="text" 
      						class="form-control"
      						data-parsley-required
      						name="sub_title"
      						placeholder="Sub Judul">
      				</div>
      			</div>

      			<div class="form-group row">
      				<div class="col-3">
      					Kontent
      				</div>
      				<div class="col-9">
  						<textarea id="sumernote-add" name="content"></textarea>
      				</div>
      			</div>

      			<div class="form-group">
      				<button class="btn btn-primary" 
      					type="submit" 
      					id="button-add-info">
      					<i class="fa fa-plus"></i> Tambah
      				</button>
      			</div>
      		</form>
        </div>      
      </div>
	</div>
</div>