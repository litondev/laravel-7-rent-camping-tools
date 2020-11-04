@foreach($cart as $item)
<div class="col-12 p-3 box-camp mt-4">					
	<div class="row p-2">				
		<div class="list-product-checkbox">
			<input 
				type="checkbox" 
				onclick="clickCheckout(event,'{{$item->id}}')"
				value="{{$item->id}}"
				class="list-cart-checkbox">
		</div>

		<div class="list-product-image">							
			<img 
				src="{{asset('images/products/'.$item->product->get_images[0])}}" 
				class="img-fluid">
		</div>

		<div class="col-md-8 col-lg-8 col-sm-12">
			<div class="ft-13 mt-2">
				<a href="{{url('product/'.$item->product->id)}}" class="text-dark">
					<b>{{$item->product->name}}</b>
				</a>
			</div>

			<div class="ft-12 mt-2">
				@if($item->product->status_rent)
					<span class="badge badge-danger">Tersewa</span>	
				@else
					<span class="badge badge-success">Belum Tersewa</span>	
				@endif
			</div>

			<div class="ft-13 mt-2">
				<b style="color:green">
					{{$item->product->get_rent_price}}
				</b>
			</div>
			<div class="mt-3">
				<button class="btn btn-danger mt-2" 
					onclick="deleteData('{{$item->id}}')">
					<i class="fa fa-trash"></i> Hapus
				</button>			
			</div>
		</div>
	</div>
</div>
@endforeach