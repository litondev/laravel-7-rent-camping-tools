<div class="card shadow mb-4">
	<form
		action="{{url('admins/product')}}"
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
	    			placeholder="Nama" 
	    			name="name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Harga" 
	    			name="rent_price"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->rent_price ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control" 
	    			name="status"
	    			onchange="this.form.submit()">	    			
	    			<option value="">Pilih</option>
	    			<option value="aktif" {{$request->has('status') && $request->status == 'aktif' ? 'selected' : ''}}>Aktif</option>
	    			<option value="nonaktif" {{$request->has('status') && $request->status == 'nonaktif' ? 'selected' : ''}}>Nonaktif</option>	    				   
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select 
	    			name="status_rent"
	    			class="form-control"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="0" {{$request->has('status_rent') && $request->status_rent == '0' ? 'selected' : ''}}>Tidak Tersewa</option>
	    			<option value="1" {{$request->has('status_rent') && $request->status_rent == '1' ? 'selected' : ''}}>Tersewa</option>	
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select
	    			name="star"
	    			class="form-control"
	    			onchange="this.form.submit()">
	    				<option value="">Pilih</option>
	    				<option value="1" {{$request->has('star') && $request->star == '1' ? 'selected' : ''}}>Bintang 1</option>
		    			<option value="2" {{$request->has('star') && $request->star == '2' ? 'selected' : ''}}>Bintang 2</option>
		    			<option value="3" {{$request->has('star') && $request->star == '3' ? 'selected' : ''}}>Bintang 3</option>
		    			<option value="4" {{$request->has('star') && $request->star == '4' ? 'selected' : ''}}>Bintang 4</option>
		    			<option value="5" {{$request->has('star') && $request->star == '5' ? 'selected' : ''}}>Bintang 5</option>
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
	    			href="{{url('admins/product')}}">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>