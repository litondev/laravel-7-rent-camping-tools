<div class="card shadow mb-4">      	
<div class="card-body">	
	<h5>Detail Barang Orderan</h5>

	<hr/>

	<div class="table-responsive">
		<table class="table table-borderless table-hover">
			<tr>
				<td><b>Nama</b></td>
				<td><b>Gambar</b></td>
				<td><b>Harga</b></td>
			</tr>
			@foreach($invoice->order_items as $item)
			<tr>
				<td>
					<a href="{{url('admins/product/'.$item->product->id)}}"
						target="_blank">
						{{$item->product->name}}
					</a>
				</td>
				<td>
					<a href="{{asset('images/products/'.$item->product->get_images[0])}}" target="_blank">
						<img src="{{asset('images/products/'.$item->product->get_images[0])}}" width="100px">
					</a>
				</td>
				<td><b class='text-success'>{{$item->product->get_rent_price}}</b></td>									
			</tr>
			@endforeach
		</table>
	</div>						
</div>
</div>