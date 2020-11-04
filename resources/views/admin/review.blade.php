@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.review.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Komentar</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama User</th>
	              <th>Nama Product</th>
	              <th>Komentar</th>
	              <th>Bintang</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($review as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->user->first_name}}</td>
	          		<td>{{$item->product->name}}</td>
	          		<td>{{$item->komentar}}</td>
	          		<td>
	          			@if($item->star == 1)
	          				<b class="text-danger">
	          					1 
	          				</b>
	          			@elseif($item->star == 2)
	          				<b class="text-danger">
	          					2
	          				</b>
	          			@elseif($item->star == 3)
							<b class="text-warning">          			
								3 
							</b>
	          			@elseif($item->star == 4)
	          				<b class="text-info">
	          					4 
	          				</b>
	          			@elseif($item->star == 5)
							<b class="text-success">
								5 
							</b>
	          			@elseif($item->star == 0)
	          				<b class="text-dark">
	          					Blm Ada
	          				</b>
	          			@endif
	          		</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>	          			          
	          			@if(empty($item->replay))
	          				<button class="btn btn-primary mt-2"
	          					data-toggle="modal"
	          					data-target="#modal-add-komentar"
	          					onclick="onAddData('{{$item->id}}')">
		          				<i class="fa fa-reply"></i>
	          					Berikan Balasan
	          				</button>
	          			@else
	          				<button class="btn btn-primary mt-2"
	          					data-toggle="modal"
	          					data-target="#modal-edit-komentar"
	          					onclick="onEditData('{{$item->id}}','{{$item->replay}}')">
		          				<i class="fa fa-reply"></i>
		          				Edit Balasan
	          				</button>
	          			@endif

	          			<button class="btn btn-danger mt-2"
	          			 	onclick="deleteData('{{url('admins/review/'.$item->id)}}')">
	          				<i class="fa fa-trash"></i>
	          				Hapus
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

	    	  		if($request->has('product_name') && !empty($request->product_name)){
	    	  			$append["product_name"] = $request->product_name;
	    	  		}

					if($request->has('first_name') && !empty($request->first_name)){
	    	  			$append["first_name"] = $request->first_name;
	    	  		}

					if($request->has('komentar') && !empty($request->komentar)){
	    	  			$append["komentar"] = $request->komentar;
	    	  		}

	    	  		if($request->has('star') && !empty($request->star)){
	    	  			$append["star"] = $request->star;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$review->appends($append)->links()}}					  
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
  </div>

  @include("admin.review.modal-add")

  @include("admin.review.modal-edit")
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

<!-- ON EDIT DAN ADD -->
<script>
function onAddData(id){
	$("#form-add-komentar").find("input[name=id]").val(id);
}

function onEditData(id,replay){
	$("#form-edit-komentar").find("input[name=id]").val(id);
	$("#form-edit-komentar").find("textarea[name=replay]").val(replay);
}
</script>

<!-- DELETE DATA -->
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
$("#form-edit-komentar").parsley().on('form:validate',function(){
	if($("#form-edit-komentar").parsley().isValid()){
		$("#button-edit-komentar").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-komentar").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-add-komentar").parsley().on('form:validate',function(){
	if($("#form-add-komentar").parsley().isValid()){
		$("#button-add-komentar").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-add-komentar").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection