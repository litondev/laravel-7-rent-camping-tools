@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.manual-payment-validasi.search")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Validasi Manual Payment</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>User Nama</th>
	              <th>Invoice Id</th>
	              <th>Bukti</th>
	              <th>Status</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($manualPayment as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->user->first_name}}</td>
	          		<td>{{$item->invoice_id}}</td>
	          		<td>
	          			<a href="{{asset('images/proofs/'.$item->proof)}}" target="_blank">
	          				<img src="{{asset('images/proofs/'.$item->proof)}}" height="50px">	          	
	          			</a>
	          		</td>
	          		<td>
	          			@if($item->status == 'validasi')
							<span class="badge badge-primary">
								Validasi
							</span>
	          			@elseif($item->status == 'failed')
	          				<span class="badge badge-danger">
	          					Gagal
	          				</span>
	          			@elseif($item->status == 'success')
	          				<span class="badge badge-success">
	          					Berhasil
	          				</span>
	          			@endif	          		
	          		</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>
	          			<button class="btn btn-primary"
	          				onclick="window.location='{{url('admins/manual-payment/detail/'.$item->id)}}'">
	          				<i class="fa fa-info-circle"></i> Detail
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

	    	  		if($request->has('invoice_id') && !empty($request->invoice_id)){
	    	  		  $append['invoice_id'] = $request->invoice_id;
	    	  		}

	    	  		if($request->has('first_name') && !empty($request->first_name)){
	    	  		  $append["first_name"] = $request->first_name;
		    	  	}		    

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$manualPayment->appends($append)->links()}}					  
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