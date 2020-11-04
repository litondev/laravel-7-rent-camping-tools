<div class="col-md-6 col-lg-6 col-sm-12">
	<h6>Slider Home Page</h6> 
  
  <br>

	<div class="owl-carousel owl-theme" 
    id="slider-home-page">
    @foreach($slider as $item)
      <div class="item cursor-pointer" 
        onclick="window.open('{{$item->link}}')">
        <img 
          src="{{asset('images/sliders/'.$item->image)}}" 
          class="img-fluid">
      </div>	                       
    @endforeach
    </div>
</div>