@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.log-admin.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">	
	      <h5>Kelola Log Admin</h5> 
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama</th>
	              <th>Ip</th>
	              <th>Agent</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($logAdmin as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->name}}</td>
	          		<td>{{$item->ip}}</td>
	          		<td>{{$item->user_agent}}</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>	          		
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

	    	  		if($request->has('name') && !empty($request->name)){
	    	  		  $append['name'] = $request->name;
	    	  		}	

	    	  		if($request->has('ip') && !empty($request->ip)){
	    	  		  $append['ip'] = $request->ip;
	    	  	    }

    	  			if($request->has('agent') && !empty($request->agent)){
 					  $append['agent'] = $request->agent;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp


					{{$logAdmin->appends($append)->links()}}					  
				</nav>					
			</div>
	      </div>
	    </div>
	</div>
  </div>
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
@endsection