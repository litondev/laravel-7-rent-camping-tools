@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	<div class="card shadow mb-4">      
	    <div class="card-body">
	      <h5>Kelola setting order</h5> 

	      <hr/>

	      <div class="table-responsive mt-2">
	      	<form 
	      		action="{{url('admins/setting/order')}}"
	      		method="post"
	      		id="form-setting-order">

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
		       				<td>Max order product</td>
		       				<td>
		       					<input type="number" 
		       						name="max_order"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.max_order')}}"/>	       					
		       					<small>
		       						* Max order product
		       					</small>
		       				</td>
		       			</tr>
		       		

		       			<tr>
		       				<td>Max daftar keinginan product</td>
		       				<td>
		       					<input type="number" 
		       						name="max_wishlist"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.max_wishlist')}}"/>	       					
		       					<small>
		       						* Max daftar keinginan product
		       					</small>
		       				</td>
		       			</tr>


		       			<tr>
		       				<td>Max hari rental product</td>
		       				<td>
		       					<input type="number" 
		       						name="max_rent_product"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.max_rent_product')}}"/>	       					
		       					<small>
		       						* Max hari rental product
		       						<br>
		       						* berdasarkan hari
		       					</small>
		       				</td>
		       			</tr>
		       		
		       			<tr>
		       				<td>Min hari rental product</td>
		       				<td>
		       					<input type="number" 
		       						name="min_rent_product"
		       						class="form-control"
		       						data-parsley-required
		       						data-parsley-type="number"
		       						value="{{config('app.min_rent_product')}}"/>	       					
		       					<small>
		       						* Min hari rental product
		       						<br>
		       						* berdasarkan hari
		       					</small>
		       				</td>
		       			</tr>
		       		
		       			<tr>
		       				<td colspan="2">
		       					<button class="btn btn-info"
		       						id="button-setting-order"><i class="fa fa-edit"></i> Edit</button>
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
$("#form-setting-order").parsley().on('form:validate',function(){
	if($("#form-setting-order").parsley().isValid()){
		$("#button-setting-order").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-setting-order").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection