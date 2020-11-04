@extends("layouts.user")

@section("page_title","Keinginan")

@section("content")
<div class="container">
	<div class="row p-5">
		<div class="col-12 text-center mb-4">
			<h4>Keinginan</h4>
		</div>

		@forelse($wishlist as $item)
			<div class="mt-3 mb-3  list-product">          
		      <div class="box-camp d-flex flex-column justify-content-between border-radius-20" 
		        style="height:100%">      
		        <div class="card-header no-border bg-none text-center pos-relative" 
		          style="height:50%">      
		            <img 
		                src="{{asset('images/products/'.$item->product->get_images[0])}}"
		                style="width:80%;height:auto;max-width:80%">
		          
		            <div style="height:25px;width:25px;border-radius:50%;background:violet;position:absolute;bottom:20px;right:20px;padding-top:0px;" class="box-camp cursor-pointer"
		              onclick="this.disabled = true;window.location='{{url('action/add-cart/'.$item->product->id)}}'">
		              <small>
		                <i class="fa fa-shopping-basket" style="color:white"></i>
		              </small>
		            </div>	      
		           
	   				<div style="height:25px;width:25px;border-radius:50%;background:red;position:absolute;bottom:20px;left:20px;padding-top:0px;" 
	   					class="box-camp cursor-pointer"
		              	onclick="this.disabled = true;window.location='{{url('/action/sub-wishlist/'.$item->id)}}'">
		              <small>
		                <i class="fa fa-trash" style="color:white"></i>
		              </small>
		            </div>	  
		        </div>

		        <div class="row p-2">        
		          <div class="col-md-6 col-sm-12 col-lg-6 p-3">
		            <span class="ft-15">
		              <a href="{{url('product/'.$item->product->id)}}">
		                {{$item->product->name}}
		              </a>
		            </span>

		            <br>

		            <span class="ft-13 text-success">
		              {{$item->product->get_rent_price}}
		            </span>

		            <br>

		            @if($item->product->status_rent)
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
		              <span id="make-star-product-{{$item->product->id}}"></span>
		            </small>

		            <script>
		              makeStar('{{$item->product->star}}','make-star-product-{{$item->product->id}}')
		            </script>
		          </div>
		        </div>  
		      </div>
		    </div> 
		@empty
			<div class="col-12 text-center">
				<img class="img-fluid"
					src="{{asset('images/not-found.png')}}" 
					width="40%"/>
					<br>
				<span class="ft-20"><b>Data Tidak Ditemukan</b></span>
					<br>
				<span class="ft-13">Daftar Keinginan Tidak Ditemukan</span>
			</div> 
		@endforelse

		@if(count($wishlist) != 0)
			<div class="col-12 p-3">
				<nav class="float-right paginate-overflow">			
					{{$wishlist->links()}}					  
				</nav>					
			</div>
		@endif		
	</div>
</div>
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){
	$(".list-product").removeClass("col-4").addClass("col-6");
}

function tablet_res(){
	$(".list-product").removeClass("col-4").addClass("col-6");
}

function destop_res(){
	$(".list-product").removeClass("col-6").addClass("col-4");
}
</script>
@endsection