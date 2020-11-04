@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.slider.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Slider</h5> 

	      <button class="btn btn-primary"
	      	data-toggle="modal"
	      	data-target="#modal-add-slider">
	      	<i class="fa fa-plus"></i> Tambah
	      </button>
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Link</th>
	              <th>Aktif</th>
	              <th>Gambar</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($slider as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>
	          			<a href="{{$item->link}}" target="_blank">
	          				{{$item->link}}
	          			</a>
	          		</td>
	          		<td>
	          			<input type="checkbox" data-plugin="switchery" 
	          			onchange="onChangeStatus(event)"
	          			{{$item->status == 'aktif' ? 'checked' : ''}}
	          			value="{{$item->id}}">
	          		</td>
	          		<td>
	          			<a href="{{asset('images/sliders/'.$item->image)}}" target="_blank">
	          				<img src="{{asset('images/sliders/'.$item->image)}}" height="50px">	          	
	          			</a>
	          		</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>	          			
	          			<button class="btn btn-danger mt-1"
	          				onclick="deleteData('{{url('admins/slider/'.$item->id)}}')">
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

	    	  		if($request->has('status') && !empty($request->status)){
	    	  			$append['status'] = $request->status;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$slider->appends($append)->links()}}					  
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
  </div>

  @include("admin.slider.modal-add")
@endsection

@section("sc_footer")
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

<!-- VALIDATION -->
<script>
$("#form-add-slider").parsley().on('form:validate',function(){
	if($("#form-add-slider").parsley().isValid()){
		$("#button-add-slider").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-slider").attr("disabled",true);
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
			document.getElementById("form-add-slider").reset();       
			toastr.warning("Sepertinya gambar tidak valid","");	
		}
		
		if(files[0].size >= 1 * 1024 * 1024){
			document.getElementById("form-add-slider").reset();       
			toastr.warning("Sepertinya ukuran gambar tidak valid","");	
		}           
	}
}
</script>

<script>
function onChangeStatus(event){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();

	if(event.target.checked){
 		window.location = "{{url('admins/slider/')}}/"+event.target.value+"/aktif";
	}else{
		window.location = "{{url('admins/slider/')}}/"+event.target.value+"/nonaktif";
	}
}
</script>
@endsection