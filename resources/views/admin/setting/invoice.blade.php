@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola setting invoice</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	      	<form 
	      		action="{{url('admins/setting/invoice')}}"
	      		method="post"
	      		id="form-setting-invoice">

	      		@csrf

		        <table class="table table-borderless table-hover">	         
		        	<thead>
		       	  		<tr>
			       	  		<th width="200px">Nama</th>
			       	  		<th>Nilai</th>
		       	  		</tr>
		       		</thead>
		       		<tbody>
		       			<tr>
		       				<td>Kadaluarsa invoice</td>
		       				<td>
		       					<input type="number" 
		       						name="expired_invoice"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.expired_invoice')}}"/>	       					
		       					<small>
		       						* Kadaluarasa invoice setelah dibuat sebelum pembayaran
		       						<br>
		       						* Berdasarkan hari
		       					</small>
		       				</td>
		       			</tr>

		       			<tr>
		       				<td>Jangka waktu pengembalian barang</td>
		       				<td>
		       					<input type="number" 
		       						name="time_backing_stuff"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.time_backing_stuff')}}"/>	       					
		       					<small>
		       						* Jangka waktu pengembalian barang setelah selesai rental 
		       						<br>
		       						* Berdasarkan hari
		       					</small>
		       				</td>
		       			</tr>

		       			<tr>
		       				<td colspan="2">
		       					<button class="btn btn-info"
		       						id="button-setting-invoice"><i class="fa fa-edit"></i> Edit</button>
		       				</td>
		       			</tr>
		       		</tbody>
		        </table>
	    	</form>
	      </div>
	    </div>
	</div>
  </div>
@endsection    

@section("sc_footer")
<script>
$("#form-setting-invoice").parsley().on('form:validate',function(){
	if($("#form-setting-invoice").parsley().isValid()){
		$("#button-setting-invoice").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-setting-invoice").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection