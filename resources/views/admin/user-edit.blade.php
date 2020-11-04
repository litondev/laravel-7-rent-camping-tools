@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-8 col-lg-8 col-sm-12">
  			<div class="card shadow mb-4">      
	    		<div class="card-body">
	    			<h5>Edit User</h5>
	    			<hr/>
	    			<form 
	    				id="form-edit-user"
	    				method="post"
	    				action="{{url('admins/user/'.$user->id)}}">

	    				@csrf

	    				<input type="hidden" value="{{$user->id}}" name="id">

		 				<table class="table table-borderless table-hover">
		 					<tr>
		 						<td width="100px">Nama Depan</td>
		 						<td>
		 							<input type="text"
		 								class="form-control"
		 								name="first_name"
		 								placeholder="Nama Depan"
		 								data-parsley-required
		 								value="{{$user->first_name}}">
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Nama Belakang</td>
		 						<td>
		 							<input type="text"
		 								class="form-control"
		 								name="last_name"
		 								placeholder="Nama Belakang"
		 								data-parsley-required
		 								value="{{$user->last_name}}">
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Email</td>
		 						<td>
		 							<input type="text"
		 								class="form-control"
		 								name="email"
		 								placeholder="Email"
		 								data-parsley-required
		 								data-parsley-type="email"
		 								value="{{$user->email}}">
		 							<small>
		 								* Email tidak boleh sama
		 							</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Alamat</td>
		 						<td>
		 							<textarea
		 								class="form-control"
		 								name="address"
		 								placeholder="Alamat"
		 								data-parsley-required>{{$user->address}}</textarea>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>No Telp</td>
		 						<td>
		 							<input type="text"
		 								class="form-control"
		 								name="phone"
		 								placholder="No Telp"
		 								data-parsley-required
		 								value="{{$user->phone}}">

		 							<small>
		 								* No telp tidak boleh sama <br>
		 								* No telp harus berawal 08
		 							</small>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Role</td>
		 						<td>
		 							<select name="role"
		 								class="form-control">
		 								<option value="user" {{$user->role == 'user' ? 'selected' : ''}}>User</option>
		 								<option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
		 							</select>
		 						</td>
		 					</tr>
		 					<tr>
		 						<td>Password</td>
		 						<td>
		 							<input 
		 								class="form-control"
		 								type="password"
		 								name="password"
		 								data-parsley-minlength="8">
		 							<small>
		 								* Isi jika ingin mengubah password
		 							</small>	 								
		 						</td>
		 					</tr>
		 					<tr>
		 						<td colspan="2">
		 							<button class="btn btn-success"
		 								id="button-edit-user">
		 								<i class="fa fa-edit"></i> Edit
		 							</button>
		 						</td>
		 					</tr>
		 				</table>
	 				</form>
	    		</div>
	    	</div>
  		</div>

  		<div class="col-md-3 col-lg-4 col-sm-12">
  			<div class="card shadow mb-4">      
	    		<div class="card-body">
	    			<h5>Detail User</h5>

	    			<hr/>

			        <table class="table table-borderless table-hover">
			        	<tr>
			        		<td>Status</td>
			        		<td>
			        			@if($user->status == 'blokir')
									<b class="text-danger">Terblokir</b>
			        			@else
			        				<b class="text-success">Aktif</b>
			        			@endif
			        		</td>
			        	</tr>

			        	@if($user->status == 'blokir')
			        		<tr>
			        			<td>Dekripsi Blokir</td>
			        			<td>
			        				{{$user->description_blokir}}
			        			</td>
			        		</tr>
			        	@endif

			        	<tr>
			        		<td>Jenis Kelamin</td>
			        		<td>
			        			@if($user->gender == 'male')
			        				<b>Laki-Laki</b>
			        			@else
			        				<b>Perempuan</b>
			        			@endif
			        		</td>
			        	</tr>

			        	<tr>
			        		<td>Dibuat</td>
			        		<td><b>{{$user->get_human_created_at}}</b></td>
			        	</tr>

			        	<tr>
			        		<td>Role</td>
			        		<td><b>{{$user->role}}</b></td>
			        	</tr>	

			        	<tr>
			        		<td>Login Terakhir</td>
			        		<td>
			        			@if($user->last_login)
			        				<b>{{$user->last_login}}</b>
			        			@else
			        				<b>Belum Login</b>
			        			@endif
			        		</td>
			        	</tr>
	    			</table>
	    		</div>
	    	</div>
  		</div>
  	</div>
  </div>
@endsection

@section("sc_footer")
<script>
$("#form-edit-user").parsley().on('form:validate',function(){
	if($("#form-edit-user").parsley().isValid()){
		$("#button-edit-user").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-edit-user").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection