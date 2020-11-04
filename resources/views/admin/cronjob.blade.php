@extends("layouts.admin")

@section("content")  
<div class="container-fluid">
  	<div class="row">
  		<div class="col-12">
  			<div class="card shadow mb-4">      					
		    	<div class="card-body">
		    		<h5>Penjelasaan</h5>
		    		<hr/>
		    		Cronjob di halaman ini tidak berfungsi sebagai pengaturan waktu otomatis / pengaturan cronjobnya melainkan hanya sebagai trigger manual,
		    		<br>
		    		Jadi mengeksekusi fungsi yang sama dengan cronjob secara manual.
		    	</div>
		    </div>
  		</div>

  		<div class="col-4">
  			<div class="card shadow mb-4">      					
		    	<div class="card-body text-center">
		    		<h5>Pengembalian Barang</h5>
		    		<hr/>
		    		<button class="btn btn-primary"
		    			onclick="window.location='{{url('admins/cronjob/action/backing-stuff')}}';this.disabled = true">
		    			Jalanakan
		    		</button>
		    		<hr>
		    		* Jika dijalankan akan mengubah status invoice menjadi pengembalian barang, tentu saja dengan kondisi tertentu
		    	</div>
		    </div>
  		</div>

  		<div class="col-4">
  			<div class="card shadow mb-4">      					
		    	<div class="card-body text-center">
		    		<h5>Kadaluarsa Invoice</h5>
		    		<hr/>
		    		<button class="btn btn-primary"
		    			onclick="window.location='{{url('admins/cronjob/action/expired-invoice')}}';this.disabled = true">
		    			Jalanakan
		    		</button>
		    		<hr>
		    		* Jika dijalankan akan mengubah status invoice menjadi kadaluarsa invoice, tentu saja dengan kondisi tertentu
		    	</div>
		    </div>
  		</div>

  		<div class="col-4">
  			<div class="card shadow mb-4">      					
		    	<div class="card-body text-center">
		    		<h5>Kadaluarsa Pembayaran</h5>
		    		<hr/>
		    		<button class="btn btn-primary"
		    			onclick="window.location='{{url('admins/cronjob/action/expired-payment')}}';this.disbaled = true">
		    			Jalanakan
		    		</button>
		    		<hr>
		    		* Jika dijalnakan akan mengubah status invoice menjadi kadaluarsa pembayaran, tentu saja dengan kondisi tertentu
		    	</div>
		    </div>
  		</div>
  	</div>
</div>
@endsection