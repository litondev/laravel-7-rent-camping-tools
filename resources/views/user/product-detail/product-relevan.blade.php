<div class="row pl-4 pr-4 pt-3 pb-3" 
 id="product-relevan">

@if(count($productRelevan))
<div class="col-12">
	<h6>Product Terkait</h6>
</div>
@endif

@foreach($productRelevan as $item)
<div class="mt-3 mb-3  list-product">          
  <div class="box-camp d-flex flex-column justify-content-between border-radius-20" 
    style="height:100%">      
    <div class="card-header no-border bg-none text-center pos-relative" 
      style="height:50%">      
        <img 
            src="{{asset('images/products/'.$item->get_images[0])}}"
            style="width:80%;height:auto;max-width:80%">
      
        @if(Auth::user())
        <div style="height:25px;width:25px;border-radius:50%;background:violet;position:absolute;bottom:20px;right:20px;padding-top:0px;" 
          class="box-camp cursor-pointer"
          onclick="this.disabled = true;window.location='{{url('action/add-cart/'.$item->id)}}'">
          <small>
            <i class="fa fa-shopping-basket" 
              style="color:white"></i>
          </small>
        </div>
        @else
          <div style="height:25px;width:25px;border-radius:50%;background:violet;position:absolute;bottom:20px;right:20px;padding-top:0px;" 
            class="box-campc cursor-pointer"
            onclick="window.location='{{url('/signin')}}'">
          <small>
            <i class="fa fa-shopping-basket" style="color:white"></i>
          </small>
        </div>
        @endif
    </div>

    <div class="row p-2">        
      <div class="col-md-6 col-sm-12 col-lg-6 p-3">
        <span class="ft-15">
          <a href="{{url('product/'.$item->id)}}">
            {{$item->name}}
          </a>
        </span>

        <br>

        <span class="ft-13 text-success">
          {{$item->get_rent_price}}
        </span>

        <br>

        @if($item->status_rent)
          <span class="ft-13 text-danger">
            Tersewa
          </span>
        @else
          <span class="ft-13 text-success">
            Tidak Tersewa
          </span>
        @endif
      </div>

      <div class="col-md-6 col-sm-12 col-lg-6 p-3">
        <small>
          <span id="make-star-product-{{$item->id}}"></span>
        </small>

        <script>
          makeStar('{{$item->star}}','make-star-product-{{$item->id}}')
        </script>
      </div>
    </div>  
  </div>
</div>  
@endforeach
