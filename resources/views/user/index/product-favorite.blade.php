<div class="col-md-6 col-lg-6 col-sm-12">
	<h6>Product Favorite Terbaru </h6> 

  <br>
  
	<div class="owl-carousel owl-theme" 
  id="product-favorite">
    @foreach($wishlist as $item)                        
    <div class="item cursor-pointer product-favorite-item"
      onclick="window.location='{{url('product/'.$item->product->id)}}'">	            	
    	<div class="product-favorite-inside-item" style="height:110px">
        <img style="height:60%;width:auto;min-width:60%;margin:auto"
          src="{{asset('images/products/'.$item->product->get_images
          [0])}}">

    		<span>{{$item->product->name}}</span> 

        <br><br>

        @if($item->product->status_rent)
          <span class="text-danger">Tersewa</span>             
        @else
          <span class="text-success">Belum Tersewa</span>             
        @endif
    	</div>
    </div>	                  
    @endforeach
	</div>
</div>