<div class="card shadow mb-4">
	<form
		action="{{url('admins/invoice')}}"
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
	    		<select class="form-control"
	    			name="status"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="pending" {{$request->has('status') && $request->status == 'pending' ? 'selected' : ''}}>Pending</option>
	    			<option value="payment" {{$request->has('status') && $request->status == 'payment' ? 'selected' : ''}}>Pembayaran</option>
	    			<option value="prepare" {{$request->has('status') && $request->status == 'prepare' ? 'selected' : ''}}>Persiapan</option>
	    			<option value="in rent" {{$request->has('status') && $request->status == 'in rent' ? 'selected' : ''}}>Dalam Penyewaan</option>
	    			<option value="completed" {{$request->has('status') && $request->status == 'completed' ? 'selected' : ''}}>Selesai</option>
	    			<option value="canceled" {{$request->has('status') && $request->status == 'canceled' ? 'selected' : ''}}>Batal</option>
	    			<option value="rejected" {{$request->has('status') && $request->status == 'rejected' ? 'selected' : ''}}>Ditolak</option>
	    			<option value="expired payment" {{$request->has('status') && $request->status == 'expired payment' ? 'selected' : ''}}>Kadaluarsa Pembayaran</option>
	    			<option value="expired invoice" {{$request->has('status') && $request->status == 'expired invoice' ? 'selected' : ''}}>Kadaluarsa Invoice</option>
	    			<option value="backing stuff" {{$request->has('status') && $request->status == 'backing stuff' ? 'selected' : ''}}>Pengembalian Barang</option>
	    			<option value="withdrawing stuff" {{$request->has('status') && $request->status == 'withdrawing stuff' ? 'selected' : ''}}>Pengambilan Barang</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">	
	    		<select class="form-control"    			
	    			name="status_payment"
	    			onchange="this.form.submit()">
	    			<option value="">Pilih</option>
	    			<option value="unpaid" {{$request->has('status_payment') && $request->status_payment == 'unpaid' ? 'selected' : ''}}>Belum Bayar</option>
	    			<option value="paid" {{$request->has('status_payment') && $request->status_payment == 'paid' ? 'selected' : ''}}>Sudah Bayar</option>
	    			<option value="expired" {{$request->has('status_payment') && $request->status_payment == 'expired' ? 'selected' : ''}}>Kadaluarsa</option>
	    		</select>
	    	</div>

	    	<div class="col-md-3 col-lg-3 col-sm-12 mt-2">
	    		<input type="text"
	    			class="form-control"
	    			placeholder="Total"
	    			name="total"
	    			onkeypress="event.key == 'enter' || event.key == 'Enter' ? this.form.submit() : ''"
	    			value="{{$request->total ?? ''}}">
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
	    			href="{{url('admins/invoice')}}">
	    			<i class="fa fa-redo"></i>
	    			Reset
	    		</a>
	    	</div>
	    </div>
	</form>
</div>