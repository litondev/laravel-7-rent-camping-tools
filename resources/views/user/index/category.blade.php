<div class="row p-2">
	<div class="col-12">
		<h6>Kategori Product </h6>
	</div>			

	@foreach($category as $item)
	<div class="mt-3 mb-3 pt-3 pb-3 kategori-product cursor-pointer text-dark"
		id="kategori-{{$item->id}}"
	    onclick="window.location='{{url('product?category='.$item->name)}}'">
    	<div class="text-center">
    		<img src="{{asset('images/categories/'.$item->image)}}" class="img-fluid">
    	</div>
		<div class="text-center">
			<b>{{$item->name}}</b>
		</div> 	
	</div>	
	@endforeach			
</div>