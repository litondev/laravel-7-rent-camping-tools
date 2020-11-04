@extends("layouts.admin")

@section("content")  
  <div class="container-fluid">
  	<div class="row">
  		@include("admin.index.widget")

	    <!-- STATISTIK PENJUALAN -->
  		@include("admin.index.statistik-sale")

  		<!-- STATISTIK USER -->
  		@include("admin.index.statistik-user")

  		<!-- STATISTIK 5 INVOICE TERAKHIR -->
  		@include("admin.index.statistik-invoice")

  		<!-- STATISTIK 5 PEMBAYRAN MANUAL TERAKHIR -->
  		@include("admin.index.statistik-payment")
  	</div>
  </div>
@endsection    

@section("sc_footer")
<script src="{{asset('user/assets/js/canvasjs.min.js')}}"></script>

<script>
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",	
	data: [{        
		type: "column",  
		dataPoints: [      
			@for($i=0;$i<($request->has('gap') ? intval($request->gap) : 7);$i++)
				{
				 y: {{$data->total_value_sales[$i]}}, 
				 label: "{{$data->label_sales[$i]}} ({{$data->total_sales[$i]}})"
				},			
			@endfor
		]
	}]
});

chart.render();
</script>
@endsection