@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.user-blokir.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola User Blokir</h5> 	
	      <hr/>
	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama depan</th>
	              <th>Email</th>
	              <th>Deskripsi Blokir</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($user as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->first_name}}</td>
	          		<td>{{$item->email}}</td>	          			         
	          		<td>
	          			<b>{{$item->description_blokir}}</b>
	          		</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>	     	          				   		          
          				<button class="btn btn-info mt-1"
          					onclick="unBlokirUser('{{url('admins/user/unblokir/'.$item->id)}}')">
          					<i class="fa fa-check"></i> Unblokir
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

	    	  		if($request->has('gender') && !empty($request->gender) && ($request->gender == 'male' || $request->gender == 'female')){
	    	  			$append['gender'] = $request->gender;
	    	  		}
	    	  	
	    	  		if($request->has('first_name') && !empty($request->first_name)){
	    	  			$append['first_name'] = $request->first_name;
	    	  		}

	    	  		if($request->has('last_name') && !empty($request->last_name)){
	    	  			$append['last_name'] = $request->last_name;
	    	  		}

	    	  		if($request->has('email') && !empty($request->email)){
	    	  			$append['email'] = $request->email;
	    	  		}

	    	  		if($request->has('phone') && !empty($request->phone)){
	    	  			$append['phone'] = $request->phone;
	    	  		}
	    	  	
	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}

	    	  		if($request->has('per_page') && !empty($request->per_page)){
	    	  			$append['per_page'] = $request->per_page;
	    	  		}

	    	  		if($request->has('column') && !empty($request->column)){
	    	  			$append['column'] = $request->column;
	    	  		}

	    	  		if($request->has('order_by') && !empty($request->order_by)){
	    	  			$append['order_by'] = $request->order_by;
	    	  		}
					@endphp

					{{$user->appends($append)->links()}}					  
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
  </div>

  @include("admin.user.modal-blokir-user")
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

<script>
// UNBLOKIR USER
function unBlokirUser(action){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();
  	window.location = action;
}
</script>
@endsection