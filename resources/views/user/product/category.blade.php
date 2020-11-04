<div class="mt-3">
	<b>Kategori :</b>
	<ul class="list-group">
		@foreach($category as $item)
		<li class="list-group-item no-border">
			<a href="{{url('/product?category='.$item->name)}}">{{$item->name}}</a>
		</li>
		@endforeach
	</ul>
</div>