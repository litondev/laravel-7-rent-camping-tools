@extends("layouts.user")

@section("page_title","Home")

@section("sc_header")
<style>
.product-favorite-item{
 height:262px;
 position:relative;
}

.product-favorite-inside-item{
 position:absolute;
 top:10%;
 left:20%;
 text-align: center;
}

.kategori-product:hover{
  box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
  border:3px solid rgb(127,127,127,0.2); 
  border-radius: 20px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row pb-5 pt-5">
    <!-- SLIDER HOME PAGE -->
		@include("user.index.slider")
    <!-- SLIDER HOME PAGE -->

    <!-- PRODUCT FAVORITE TERBARU -->
		@include("user.index.product-favorite")
    <!-- PRODUCT FAVORITE TERBARU -->
	</div>

  <!-- PRODUCT TERSEWA TERBANYAK -->
  @if(count($mostRent) != 0)
	 @include("user.index.product-most-rent")
  @endif
  <!-- PRODUCT TERSEWA TERBANYAK -->

  <!-- PRODUCT -->
	@include("user.index.product")
  <!-- PRODUCT -->

  <!-- KATEGORI -->
	@include("user.index.category")
  <!-- KATEGORI -->
</div>
@endsection	

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){
  $(".list-product,.kategori-product").removeClass("col-3").addClass("col-6");
}

function tablet_res(){
  $(".list-product,.kategori-product").removeClass("col-3").addClass("col-6");
}

function destop_res(){
  $(".list-product,.kategori-product").removeClass("col-6").addClass("col-3");
}
</script>

<!-- OWL CAROUSEL -->
<script>
$("document").ready(function(){    
  $('#slider-home-page').owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
  })

  $('#product-favorite').owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items: 2
        },
        1000: {
          items: 2
        }
      }
  })

  $("#product-most-rent").owlCarousel({
      margin: 10,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 3
        }
      }
  })
});
</script>
@endsection