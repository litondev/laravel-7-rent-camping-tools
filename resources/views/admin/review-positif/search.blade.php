<div class="card shadow mb-4">
	<form
		action="{{url('admins/review/positif')}}"
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
	    			placeholder="Nama Product" 
	    			name="product_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->product_name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Nama User" 
	    			name="first_name"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->first_name ?? ''}}">
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text" 
	    			class="form-control" 
	    			placeholder="Komentar" 
	    			name="komentar"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->komentar ?? ''}}">
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
	    			href="{{url('admins/review/positif')}}">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>