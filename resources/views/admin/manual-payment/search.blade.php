<div class="card shadow mb-4">
	<form
		action="{{url('admins/manual-payment')}}"
		method="get">
    	<div class="card-body row">
	
    		<div class="col-12">
    			<h6>Search : </h6>
    		</div>	

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
		    	<input type="text" 
		    		class="form-control" 
		    		placeholder="Dari id" 
		    		name="form_id"
		    		onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
		    		value="{{$request->form_id ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Ke id" 
	    			name="to_id"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
		    		value="{{$request->to_id ?? ''}}">
	    	</div>

  			<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="User Nama" 
	    			name="first_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->first_name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Invoice Id" 
	    			name="invoice_id"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->invoice_id ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control"
	    			name="status"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="validasi" {{$request->has('status') && $request->status == 'validasi' ? 'selected' : ''}}>Validasi</option>
	    			<option value="success"  {{$request->has('status') && $request->status == 'success' ? 'selected' : ''}}>Berhasil</option>
	    			<option value="failed"  {{$request->has('status') && $request->status == 'failed' ? 'selected' : ''}}>Gagal</option>
	    		</select>
	    	</div>	    

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Search Tgl"
	    			name="search_created_at"
	    			id="search-created-at">
	    	</div>		    	

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<a class="btn btn-info" 
	    			href="{{url('admins/manual-payment')}}">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>