<div class="pl-4 pr-4 pt-3 pb-3 product-detail-info" 
	id="product-detail-komentar">
	<div class="row box-camp p-2">
		<div class="col-12">
			<h6>Komentar</h6>	
		</div>	

		<div class="col-12 ft-14">	
			@forelse($productReview as $item)
			<div class="row mt-4 p-2">				
				<div class="col-12">
					<div class="clearfix">
						<div class="float-left">
							<span class="badge badge-primary">{{$item->user->first_name}}</span>
							<br>
							<span id="make-star-review-{{$item->id}}"></span>
							<script>
							  makeStar('{{$item->star}}','make-star-review-{{$item->id}}')
							</script>
							<br>
						</div>

						<div class="float-right">
							<span class="badge badge-info">{{$item->get_human_created_at}}</span>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2 pl-4 pt-2 pb-2 list-komentar">
					{{$item->komentar}}
				</div>

				@if($item->replay)
				<div class="col-11 mt-2 pl-4 pt-2 pb-2 offset-1 list-komentar">
					{{$item->replay}}
				</div>
				@endif
			</div>
			@empty
			<div class="text-center p-3">
				<img 
					src="{{asset('images/not-found.png')}}" 
					width="40%"
					class="img-fluid">
					<br>
				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>
					<br>
				<span class="ft-13">
					Komentar Tidak Ditemukan
				</span>
			</div>
			@endforelse			
		</div>

		@if($productReview->total() > 0)
		<div class="col-12 p-3">
			<nav class="float-right paginate-overflow">
			  {{$productReview->appends(['productDetail' => 'komentar'])->links()}}					  
			</nav>
		</div>
		@endif
	</div>	
</div>