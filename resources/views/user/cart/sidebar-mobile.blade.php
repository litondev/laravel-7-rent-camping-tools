<div class="container-fluid" 
	id="box-checkout-mobile">
	<div class="row">
		<div class="col-2 p-3 bg-dark">
			<i class="fa fa-times text-white fa-2x cursor-pointer" 
				onclick="onOpenBoxCheckoutMobile('hide')"></i>
		</div>
		
		<div class="col-10 pt-2 pb-2 bg-light">
			<form 
				id="form-checkout-mobile"
				action="{{url('/checkout')}}"
				method="post">

				@csrf

				<div class="mt-1">
					<b>Product : </b>
					<ul class="list-group">
						@php
							$total = [];
						@endphp

						@foreach($cart as $item)						
							@php
								array_push($total,$item->product->rent_price);
							@endphp

							<li class="list-group-item no-border ft-13">
								{{$item->product->name}} : {{$item->product->get_rent_price}}
							</li>
						@endforeach
					</ul>
				</div>

				<div class="mt-3">
					<b>Total : </b>
					<ul class="list-group">
						<li class="list-group-item no-border">
							<span class="badge badge-success">
								Rp {{number_format(array_sum($total),"2")}}
							</span>
						</li>
					</ul>
				</div>

				<div class="mt-3">
					<b>Tgl Sewa - Tgl Sewa Berakhir: </b>
					<ul class="list-group">
						<li class="list-group-item no-border text-success">
							<b class="badge badge-success">*Min Sewa : {{config('app.min_rent_product')}} Hari</b>
						</li>
						<li class="list-group-item no-border text-danger">
							<b class="badge badge-danger">*Max Sewa : {{config('app.max_rent_product')}} Hari</b>
						</li>						
				
						<li class="list-group-item no-border text-danger ft-13">
							* Tgl sekarang akan ditambah dengan {{config('app.expired_invoice')}} hari sebagai waktu untuk pembayaran dan persiapan
						</li>

						<li class="list-group-item no-border">						
							<input type="text" 
								name="date_rent" 
								class="form-control input-camp" 
								id="date-mobile"
								data-parsley-required/>
						</li>					
					</ul>				
				</div>

				<div class="mt-3">
					<b>Jaminan : </b>
					<ul class="list-group">
						<li class="list-group-item no-border">
							<select class="form-control" name="guaranteing">
								<option value="ktp">Ktp</option>
								<option value="sim">Sim</option>
							</select>
						</li>
					</ul>
				</div>

				<div class="mt-3">
					<button class="btn btn-success btn-block" type="submit" id="button-checkout-mobile">Checkout</button>
				</div>

			</form>
		</div>
	</div>
</div>