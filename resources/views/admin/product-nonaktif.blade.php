@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.product-nonaktif.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Product</h5> 	
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>Nama</th>
	              <th>Gambar</th>
	              <th>Harga</th>
	              <th>Status</th>
	              <th>Status Sewa</th>
	              <th>Bintang</th>
	              <th>Dibuat</th>	             
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($product as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->name}}</td>
	          		<td class="text-center">
	          			<a href="{{asset('images/products/'.$item->get_images[0])}}" target="_blank">
	          				<img src="{{asset('images/products/'.$item->get_images[0])}}" height="50px">	          	
	          			</a>
	          		</td>

	          		<td>
	          			<b class="text-success">
	          				{{$item->get_rent_price}}
	          			</b>
	          		</td>

	          		<td>
	          			<input type="checkbox" data-plugin="switchery" 
	          				onchange="onChangeStatus(event)"
	          				{{$item->status == 'aktif' ? 'checked' : ''}}
	          				value="{{$item->id}}">
	          		</td>

	          		<td>
	          			@if($item->status_rent)
	          				<b class="text-danger">
	          					Tersewa
	          				</b>
	          			@else
	          				<b class="text-success">
	          					Blm Tersewa
	          				</b>
	          			@endif
	          		</td>	 
	          		         	
	          		<td>
	          			@if($item->star == 1)
	          				<b class="text-danger">
	          					1 (Dari {{$item->reviews_count}} review)
	          				</b>
	          			@elseif($item->star == 2)
	          				<b class="text-danger">
	          					2 (Dari {{$item->reviews_count}} review)
	          				</b>
	          			@elseif($item->star == 3)
							<b class="text-warning">          			
								3 (Dari {{$item->reviews_count}} review)
							</b>
	          			@elseif($item->star == 4)
	          				<b class="text-info">
	          					4 (Dari {{$item->reviews_count}} review)
	          				</b>
	          			@elseif($item->star == 5)
							<b class="text-success">
								5 (Dari {{$item->reviews_count}} review)
							</b>
	          			@elseif($item->star == 0)
	          				<b class="text-dark">
	          					Blm Ada
	          				</b>
	          			@endif
	          		</td>

	          		<td>
	          			{{$item->get_human_created_at}}
	          		</td>

	          		<td>
	          			<button class="btn btn-success mt-1"
		          			onclick="window.location='{{url('admins/product/'.$item->id)}}'">	          				
	          				<i class="fa fa-edit"></i> Edit
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

	    	  		if($request->has('name') && !empty($request->name)){
	    	  		  $append['name'] = $request->name;
	    	  		}

	    	  		if($request->has('rent_price') && !empty($request->rent_price)){
	    	  		 $append['rent_price'] = $request->rent_price;
	    	  		}
	  
	    	  		if($request->has('status_rent') && !empty($request->status_rent)){
	    	  		 $append['status'] = $request->status_rent;
	    	  		}

	    	  		if($request->has('star') && !empty($request->star)){
	    	  		 $append['star'] = $request->star;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$product->appends($append)->links()}}					  
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

<script>
function onChangeStatus(event){
	$("#loading-modal").show();
  	$("#loading-modal > div").show();

	if(event.target.checked){
 		window.location = "{{url('admins/product/')}}/"+event.target.value+"/aktif";
	}else{
		window.location = "{{url('admins/product/')}}/"+event.target.value+"/nonaktif";
	}
}
</script>
@endsection