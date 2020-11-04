@extends("layouts.admin")

@section("sc_header")
	<!-- SUMMER NOTE -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/sumernote/summernote-bs4.min.css')}}">
@endsection

@section("content")  
  <div class="container-fluid">
  	@include("admin.info.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Info</h5> 

	      <button class="btn btn-primary"
	      	data-toggle="modal"
	      	data-target="#modal-add-info">
	      	<i class="fa fa-plus"></i> Tambah
	      </button>
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Judul</th>
	              <th>Gambar</th>
	              <th>Sub title</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($info as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->title}}</td>
	          		<td>
	          			<a href="{{asset('images/infos/'.$item->image)}}" target="_blank">
	          				<img src="{{asset('images/infos/'.$item->image)}}" height="50px">	          	
	          			</a>
	          		</td>
	          		<td>{{$item->sub_title}}</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>
	          			<button class="btn btn-success mt-1"
	          				onclick="editData('{{$item->title}}','{{$item->sub_title}}',`{{$item->content}}`,'{{url('admins/info/'.$item->id)}}')"
	          				data-toggle="modal"
	      					data-target="#modal-edit-info">
	          				<i class="fa fa-edit"></i> Edit
	          			</button>
	          			<button class="btn btn-danger mt-1"
	          				onclick="deleteData('{{url('admins/info/'.$item->id)}}')">
	          				<i class="fa fa-trash"></i> Hapus
	          			</button>
	          		</td>
	          	</tr>
	          	@empty
	          	<tr>
	          		<td colspan="100" class="text-center">
	          			<h5>Data tidak ditemukan</h5>
	          		</td>
	          	</tr>
	          	@endforelse
	          </tbody>	         
	        </table>

	        <div class="p-3">
				<nav class="float-right paginate-overflow">						
					@php
					$append = [];

					if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->to_id)){
					  $append['form_id'] = $request->form_id;
					  $append['to_id'] = $request->to_id;
	    	  		}

	    	  		if($request->has('title') && !empty($request->title)){
	    	  		  $append['title'] = $request->title;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$info->appends($append)->links()}}					  
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
  </div>

  @include("admin.info.modal-add")

  @include("admin.info.modal-edit")
@endsection

@section("sc_footer")
<!-- SUMMER NOTE -->
<script src="{{asset('admin/sumernote/summernote-bs4.min.js')}}"></script>

<!-- SEARCH WITH DATERANGE PICKER -->
<script>
$('#search-created-at').daterangepicker({
	timePicker: true,	
}).on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:00'));  		      
	$(this)[0].form.submit();
}).on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
}).on("outsideClick.daterangepicker",function(ev,picker){
  $(this).val('');
});

$("#search-created-at").val("{{$request->search_created_at ?? ''}}");
</script>

<!-- DELETE ALERT -->
<script>
function deleteData(action){
  swal.fire({
    title: 'Apakah Anda Yakin?',
    text: 'Menghapus data ini',
    icon: 'warning',
    confirmButtonColor: '#fe7c96',
    showCancelButton: true,
    confirmButtonText: 'Oke',
    showLoaderOnConfirm: true,
    cancelButtonText: 'Batal',      
  })
  .then(result => {
  	if(result.value){
  	 $("#loading-modal").show();
  	 $("#loading-modal > div").show();
  	 window.location = action;
  	}
  })
}
</script>

<!-- SUMERNOTE INSTALL -->
<script>
$('#sumernote-add').summernote({
	placeholder : "Kontent"
});	

$('#sumernote-edit').summernote({
	placeholder : "Kontent",
	height: 400
});
</script>

<!-- EDIT DATA -->
<script>
function editData(title,sub_title,content,action){	
	$("#form-edit-info").attr({"action" : action});
	$("#modal-edit-info").find("input[name=title]").val(title);
	$("#modal-edit-info").find("input[name=sub_title]").val(sub_title);
	$("#sumernote-edit").summernote("code",content);
}
</script>

<!-- VALIDATION -->
<script>
$("#form-add-info").parsley().on('form:validate',function(){
	if($("#form-add-info").parsley().isValid()){
		$("#button-add-info").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-info").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-edit-info").parsley().on('form:validate',function(){
	if($("#form-edit-info").parsley().isValid()){
		$("#button-edit-info").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-info").attr("disabled",true);
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
			document.getElementById("form-add-info").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-add-info").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>
@endsection