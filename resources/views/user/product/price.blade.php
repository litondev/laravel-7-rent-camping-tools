<div class="mt-3">
	<form 
		action="{{url('/product')}}"
  		method="get">

  		@if($query_search)
  			<input type="hidden" 
  				name="search" 
  				value="{{$query_search}}">
  		@endif

  		@if($query_category)
  			<input type="hidden" 
  				name="category" 
  				value="{{$query_category}}">
	  	@endif

		<ul class="list-group mt-2">
			<li class="list-group-item no-border">					
	  			<input type="radio" 
	  			 name="price"
				 value="termahal"
				 onclick="this.form.submit()"> Paling Mahal
			</li>
			<li class="list-group-item no-border">
				<input type="radio" 
				 name="price"
				 value="termurah"
				 onclick="this.form.submit()"> Paling Murah
			</li>
		</ul>
	</form>
</div>