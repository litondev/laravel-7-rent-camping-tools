<div class="card shadow mb-4">
	<form
		action="{{url('admins/user-blokir')}}"
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
	    			placeholder="Nama Depan" 
	    			name="first_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->first_name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Nama Belakang" 
	    			name="last_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->last_name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Email" 
	    			name="email"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->email ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="No Telp" 
	    			name="phone"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->phone ?? ''}}">
	    	</div>
			
	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select class="form-control"
	    			name="gender"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			@if($request->has('gender'))
	    				@if($request->gender == 'male')
	    					<option value="male" selected>Laki-Laki</option>
	    					<option value="female">Perempuan</option>
	    				@elseif($request->gender == 'femal')
	    					<option value="male">Laki-Laki</option>
	    					<option value="female" selected>Perempuan</option>
	    				@else
	    					<option value="male">Laki-Laki</option>
	    					<option value="female">Perempuan</option>
	    				@endif
	    			@else
	    				<option value="male">Laki-Laki</option>
	    				<option value="female">Perempuan</option>
	    			@endif	   
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
	    		<select 
	    			class="form-control"
	    			name="per_page"
	    			onchange="this.form.submit()">
	    			<option value="10" {{ $request->has('per_page') && $request->per_page == '10' ? 'selected' : ''}}>10</option>
	    			<option value="20" {{ $request->has('per_page') && $request->per_page == '20' ? 'selected' : ''}}>20</option>
	    			<option value="30" {{ $request->has('per_page') && $request->per_page == '30' ? 'selected' : ''}}>30</option>
	    			<option value="40" {{ $request->has('per_page') && $request->per_page == '40' ? 'selected' : ''}}>40</option>
	    			<option value="50" {{ $request->has('per_page') && $request->per_page == '50' ? 'selected' : ''}}>50</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select 
	    			class="form-control"
	    			name="column"
	    			onchange="this.form.submit()">
	    			<option value="id" {{ $request->has('column') && $request->column == 'id' ? 'selected' : ''}}>Id</option>
	    			<option value="first_name" {{ $request->has('column') && $request->column == 'first_name' ? 'selected' : ''}}>Nama</option>
	    			<option value="last_name" {{ $request->has('column') && $request->column == 'laste_name' ? 'selected' : ''}}>Nama Belakang</option>	    		
	    		</select>
	    	</div>


 			<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<select 
	    			class="form-control"
	    			name="order_by"
	    			onchange="this.form.submit()">
	    			<option value="desc" {{ $request->has('order_by') && $request->order_by == 'desc' ? 'selected' : ''}}>Terbesar</option>	    		    		
	    			<option value="asc" {{ $request->has('order_by') && $request->order_by == 'asc' ? 'selected' : ''}}>Terkecil</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<a class="btn btn-info" 
	    			href="{{url('admins/user/blokir')}}">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>