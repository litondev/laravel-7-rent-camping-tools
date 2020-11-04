<div class="row">
  <div class="col-12">
	  <h6>Product Tersewa Terbanyak </h6> 
    
    <br>

	  <div class="owl-carousel owl-theme mx-auto p-4" 
     id="product-most-rent">
      @foreach($mostRent as $item)                        
      <div class="item cursor-pointer" 
        onclick="window.location='{{url('product/'.$item->product->id)}}'">
          <div class="text-center">
            <img class="img-fluid"
              src="{{asset('images/products/'.$item->product->get_images[0])}}"               
              style="height:170px;width:185px;margin:auto">
          </div>

      	 <div class="text-center mt-2">
      	 	<b>{{$item->product->name}}</b>
      	 </div>
      </div>                   
      @endforeach
    </div>
  </div>
</div>