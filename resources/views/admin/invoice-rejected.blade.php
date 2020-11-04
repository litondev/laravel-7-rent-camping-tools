@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	@include("admin.invoice.search-rejected")

    <div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola Invoice Ditolak</h5> 
	      
	      <hr/>

	      <div class="table-responsive mt-2">
	        <table class="table table-borderless table-hover">
	          <thead>
	            <tr>
	              <th>Id</th>
	              <th>User Nama</th>
	              <th>Status</th>
	              <th>Status Pembayaran</th>
	              <th>Total</th>
	              <th>Dibuat</th>
	              <th>Diupdate</th>
	              <th>Opsi</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@forelse($invoice as $item)
	          	<tr>
	          		<td>{{$item->id}}</td>
	          		<td>{{$item->user->first_name}}</td>
	          		<td>
	          			@if($item->status == "pending")
				 		<b class="badge badge-warning text-light">
				 			Pending
				 		</b>
				 		@elseif($item->status == "payment")
				 		<b class="badge badge-primary text-light">
				 			Pembayaran
				 		</b>
				 		@elseif($item->status == "prepare")
				 		<b class="badge badge-primary text-light">
				 			Persiapan
				 		</b>
				 		@elseif($item->status == "withdrawing stuff")
				 		<b class="badge badge-success text-light">
				 			Pengambilan Barang
				 		</b>
				 		@elseif($item->status == "in rent")
				 		<b class="badge badge-success text-light">
				 			Dalam Penyewaan
				 		</b>
				 		@elseif($item->status == "backing stuff")
				 		<b class="badge badge-success text-light">
				 			Pengembalian Barang
				 		</b>
				 		@elseif($item->status == "completed")
				 		<b class="badge badge-success text-light">
				 			Selesai
				 		</b>
				 		@elseif($item->status == "rejected")
				 		<b class="badge badge-danger text-light">
				 			Ditolak
				 		</b>
				 		@elseif($item->status == 'canceled')
				 		<b class="badge badge-danger text-light">
				 			Dibatalkan
				 		</b>
				 		@elseif($item->status == 'expired payment')
				 		<b class="badge badge-danger text-light">
				 			Kadaluarsa Pembayaran
				 		</b>
				 		@elseif($item->status == 'expired invoice')
				 		<b class="badge badge-danger text-light">
				 			Kadaluarsa Invoice
				 		</b>
				 		@endif
	          		</td>
	          		<td>
	          			@if($item->status_payment == 'unpaid')
	          				<span class="badge badge-danger">
	          					Belum Dibayar
	          				</span>
	          			@elseif($item->status_payment == 'expired')
	          				<span class="badge badge-danger">
	          					Kadaluarsa Pembayaran
	          				</span>
	          			@else
	          				<span class="badge badge-success">
	          					Dibayar
	          				</span>
	          			@endif
	          		</td>
	          		<td>
	          			<b>Rp {{number_format($item->total,2)}}</b>
	          		</td>
	          		<td>{{$item->get_human_created_at}}</td>
	          		<td>{{$item->get_human_updated_at}}</td>
	          		<td>
	          			<button class="btn btn-primary"
	          				onclick="window.location='{{url('admins/invoice/detail/'.$item->id)}}'">
	          				<i class="fa fa-info-circle"></i>
	          				Detail
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

	    	  		if($request->has('first_name') && !empty($request->first_name)){
	    	  		  $append['first_name'] = $request->first_name;
	    	  		}
	    	  	
	    	  		if($request->has('status_payment') && !empty($request->status_payment)){
	    	  		   $append['status_payment'] = $request->status_payment;
	    	  		}

	    	  		if($request->has('total') && !empty($request->total)){
	    	  		   $append['total'] = $request->total;
	    	  		}

	    	  		if($request->has('search_created_at') && !empty($request->search_created_at)){
	    	  			$append['search_created_at'] = $request->search_created_at;
	    	  		}
	        	  	@endphp

					{{$invoice->appends($append)->links()}}					  
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