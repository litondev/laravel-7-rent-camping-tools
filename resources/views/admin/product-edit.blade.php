@extends("layouts.admin")

@section("sc_header")
	<!-- SUMMER NOTE -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/sumernote/summernote-bs4.min.css')}}">
@endsection

@section("content")  
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-8 col-lg-8 col-sm-12">
  			<div class="card shadow mb-4">      
	    		<div class="card-body">
	    			<h5>Edit Product</h5>
	    			<hr/>
	    			<form 
	    				id="form-edit-product"
	    				method="post"
	    				action="{{url('admins/product/'.$product->id)}}"
	    				enctype="multipart/form-data">

	    				@csrf

	    				<input type="hidden" value="{{$product->id}}" name="id">

		 				<table class="table table-borderless table-hover">
		 					<tr>
		 						<td width="100px">Nama</td>
		 						<td>
		 							<input type="text"
		 								class="form-control"
		 								name="name"
		 								placeholder="Nama"
		 								data-parsley-required
		 								value="{{$product->name}}">

		 							<small>
		 								* Nama Product
		 							</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Harga Sewa</td>
		 						<td>
		 							<div class="input-group">
						        		<div class="input-group-prepend">
						          			<span class="input-group-text">
						          				Rp
						          			</span>
						        		</div>
			 							<input type="text"
			 								class="form-control"
			 								name="rent_price"
			 								placeholder="Harga Sewa"
			 								value="{{$product->rent_price}}">
		 							</div>

									<small>
		 								* Harga Sewa Product Dalam Bentuk Rupiah
		 							</small>		 							
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Kategori</td>
		 						<td>
		 							<select class="form-control"
		 								name="category_id">
		 								@foreach($category as $item)
		 									<option value="{{$item->id}}" {{$item->id == $product->category_id ? 'selected' : ''}}>{{$item->name}}</option>
		 								@endforeach
		 							</select>	

		 							<small>
		 								* Kategori Product
		 							</small>	 								
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Deskripsi</td>
		 						<td>
		 							<textarea id="sumernote-description" name="description"></textarea>
		 							<small>*Deskripsi Untuk Product</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Syarat Dan Ketentuan</td>
		 						<td>
		 							<textarea id="sumernote-condition" name="condition"></textarea>
		 							<small>*Syarat Dan Ketentuan Untuk Product</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Denda</td>
		 						<td>
		 							<textarea id="sumernote-fine" name="fine"></textarea>
		 							<small>*Denda Untuk Product</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Pertanyaan</td>
		 						<td>
			 						<textarea id="sumernote-question" name="question"></textarea>
			 						<small>*Pertanyaan Untuk Product</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Gambar</td>
		 						<td>
		 							<small>* Slot 1</small> <br>
		 							<input type="file" class="form-control mt-2" name="image1"
		 								onchange="onChoseImage(event)">								 							

		 							<small>* Slot 2</small> <br>
		 							<input type="file" class="form-control mt-2" name="image2"
		 								onchange="onChoseImage(event)">

		 							<small>* Slot 3</small> <br>
		 							<input type="file" class="form-control mt-2" name="image3"
		 								onchange="onChoseImage(event)">

		 							<small>
		 								* masukan file dislot yang telah disediakan, jika ingin menganti gambar tersebut
		 								<br>
		 								* gambar harus jpeg/png/jpg 
		 								<br>
		 								* max ukurang gambar 10 mb
		 								<br>
		 								* max dimensi gambar 5000 px
		 							</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td colspan="2">
		 							<button class="btn btn-success"
		 								id="button-edit-product">
		 								<i class="fa fa-edit"></i> Edit
		 							</button>
		 						</td>
		 					</tr>
		 				</table>
	 				</form>
	    		</div>
	    	</div>
  		</div>

  		<div class="col-md-3 col-lg-4 col-sm-12">
  			<div class="card shadow mb-4">      
	    		<div class="card-body">
	    			<h5>Detail Product</h5>

	    			<hr/>

			        <table class="table table-borderless table-hover">
			        	<tr>
			        		<td>ID</td>
			        		<td><b>{{$product->id}}</b></td>
			        	</tr>
			        	<tr>
			        		<td>Gambar</td>
			        		<td>
			        			@foreach($product->get_images as $item)
									<a href="{{asset('images/products/'.$item)}}" target="_blank">
										<img src="{{asset('images/products/'.$item)}}" width="50px">			        						        			
									</a>
			        			@endforeach
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>Status</td>
			        		<td>
			        			@if($product->status == 'aktif')
									<b class="text-success">Aktif</b>
			        			@else
			        				<b class="text-danger">Nonaktif</b>
			        			@endif
			        		</td>
			        	</tr>
			        
			        	<tr>
			        		<td>Status Sewa</td>
			        		<td>
			        			@if($product->status_rent)
			        				<b class="text-danger">Tersewa</b>
			        			@else
			        				<b class="text-success">Belum Tersewa</b>
			        			@endif
			        		</td>
			        	</tr>

			        	<tr>
			        		<td>Bintang</td>
			        		<td>
			        			@if($product->star == 1)
			          				<b class="text-danger">
			          					1 (Dari {{$product->reviews_count}} review)
			          				</b>
			          			@elseif($product->star == 2)
			          				<b class="text-danger">
			          					2 (Dari {{$product->reviews_count}} review)
			          				</b>
			          			@elseif($product->star == 3)
									<b class="text-warning">          			
										3 (Dari {{$product->reviews_count}} review)
									</b>
			          			@elseif($product->star == 4)
			          				<b class="text-info">
			          					4 (Dari {{$product->reviews_count}} review)
			          				</b>
			          			@elseif($product->star == 5)
									<b class="text-success">
										5 (Dari {{$product->reviews_count}} review)
									</b>
			          			@elseif($product->star == 0)
			          				<b class="text-dark">
			          					Blm Ada
			          				</b>
			          			@endif
			        		</td>
			        	</tr>

			        	<tr>
			        		<td>Dibuat</td>
			        		<td><b>{{$product->get_human_created_at}}</b></td>
			        	</tr>

			        	<tr>
			        		<td>Diupdate</td>
			        		<td><b>{{$product->get_human_updated_at}}</b></td>
			        	</tr>			       			       
	    			</table>
	    		</div>
	    	</div>
  		</div>
  	</div>
  </div>
@endsection

@section("sc_footer")
<!-- SUMMER NOTE -->
<script src="{{asset('admin/sumernote/summernote-bs4.min.js')}}"></script>

<script>
$("input[name=rent_price]").mask("000.000.000",{reverse: true});
</script>

<script>
$('#sumernote-description').summernote({
	placeholder : "Deskripsi",
	height: 400
});	
$("#sumernote-description").summernote("code","{!! $product->description !!}");

$("#sumernote-fine").summernote({
	placeholder : "Denda",
	height: 400
});	
$("#sumernote-fine").summernote("code","{!! $product->fine !!}");

$("#sumernote-condition").summernote({
	placeholder : "Syarat Dan Ketentuan",
	height: 400
});
$("#sumernote-condition").summernote("code","{!! $product->condition !!}");

$("#sumernote-question").summernote({
	placeholder : "Pertanyaan",
	height: 400
});
$("#sumernote-question").summernote("code","{!! $product->question !!}");
</script>

<script>
$("#form-edit-product").parsley().on('form:validate',function(){
	if($("#form-edit-product").parsley().isValid()){
		$("#button-edit-product").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-product").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>

<script>
function onChoseImage(event){
	var files = event.target.files;

	if (files && files[0]) {		
		if(!['image/png','image/jpg','image/jpeg'].includes(files[0].type)){
			document.getElementById("form-edit-product").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-edit-product").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>
@endsection