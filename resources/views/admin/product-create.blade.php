@extends("layouts.admin")

@section("sc_header")
	<!-- SUMMER NOTE -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/sumernote/summernote-bs4.min.css')}}">
@endsection

@section("content")  
  <div class="container-fluid">
	<div class="card shadow mb-4">      
		<div class="card-body">
			<h5>Tambah Product</h5>
			<hr/>
			<form 
				id="form-add-product"
				method="post"
				action="{{url('admins/product/add')}}"
				enctype="multipart/form-data">

				@csrf

 				<table class="table table-borderless table-hover">
 					<tr>
 						<td width="200px">
 							Nama <br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
 							<input type="text"
 								class="form-control"
 								name="name"
 								placeholder="Nama"
 								data-parsley-required>

 							<small>
 								* Nama Product
 							</small>
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Harga Sewa 
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
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
	 								placeholder="Harga Sewa">
 							</div>

							<small>
 								* Harga Sewa Product Dalam Bentuk Rupiah
 							</small>		 							
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Kategori 
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
 							<select class="form-control"
 								name="category_id">
 								@foreach($category as $item)
 									<option value="{{$item->id}}">{{$item->name}}</option>
 								@endforeach
 							</select>	

 							<small>
 								* Kategori Product
 							</small>	 								
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Deskripsi
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
 							<textarea id="sumernote-description" name="description"></textarea>
 							<small>*Deskripsi Untuk Product</small>
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Syarat Dan Ketentuan
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
 							<textarea id="sumernote-condition" name="condition"></textarea>
 							<small>*Syarat Dan Ketentuan Untuk Product</small>
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Denda
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
 							<textarea id="sumernote-fine" name="fine"></textarea>
 							<small>*Denda Untuk Product</small>
 						</td>
 					</tr>
 					<tr>
 						<td>
 							Pertanyaan
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 						</td>
 						<td>
	 						<textarea id="sumernote-question" name="question"></textarea>
	 						<small>*Pertanyaan Untuk Product</small>
 						</td>
 					</tr>
 					<tr>
 						<td>Gambar</td>
 						<td>
 							<small>* Slot 1</small> 
 							<br>
 							<span class="badge badge-danger">Wajib</span>
 							<br>
 							<input type="file" class="form-control mt-2" name="image1"
 								data-parsley-required
 								onchange="onChoseImage(event)">								 							

 							<small>* Slot 2</small> 
 							<br>
 							<span class="badge badge-info">Tidak Wajib</span>
 							<br>
 							<input type="file" class="form-control mt-2" name="image2"
 								onchange="onChoseImage(event)">

 							<small>* Slot 3</small> 
 							<br>
 							 <span class="badge badge-info">Tidak Wajib</span>
 							<br>
 							<input type="file" class="form-control mt-2" name="image3"
 								onchange="onChoseImage(event)">

 							<small>
 								* masukan file dislot yang telah disediakan
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
 								id="button-add-product">
 								<i class="fa fa-plus"></i> Tambah
 							</button>
 						</td>
 					</tr>
 				</table>
				</form>
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

$("#sumernote-fine").summernote({
	placeholder : "Denda",
	height: 400
});	

$("#sumernote-condition").summernote({
	placeholder : "Syarat Dan Ketentuan",
	height: 400
});

$("#sumernote-question").summernote({
	placeholder : "Pertanyaan",
	height: 400
});
</script>

<script>
$("#form-add-product").parsley().on('form:validate',function(){
	if($("#form-add-product").parsley().isValid()){
		$("#button-add-product").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-product").attr("disabled",true);
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
			document.getElementById("form-add-product").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-add-product").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>
@endsection