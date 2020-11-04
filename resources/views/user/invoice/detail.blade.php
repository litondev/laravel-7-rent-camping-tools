<div class="col-md-8 col-lg-8 col-sm-12 p-3 mb-4 box-camp border-radius-10">
	<div class="clearfix">
		<div class="float-left">
			<div>
				<b class="ft-12">Status Sekarang : </b>

				<ul class="list-group">
					<li class="list-group-item no-border">
						@if($invoice->status == "pending")
				 		<b class="badge badge-warning text-light">
				 			Pending
				 		</b>
				 		@elseif($invoice->status == "payment")
				 		<b class="badge badge-primary text-light">
				 			Pembayaran
				 		</b>
				 		@elseif($invoice->status == "prepare")
				 		<b class="badge badge-primary text-light">
				 			Persiapan
				 		</b>
				 		@elseif($invoice->status == "withdrawing stuff")
				 		<b class="badge badge-success text-light">
				 			Pengambilan Barang
				 		</b>
				 		@elseif($invoice->status == "in rent")
				 		<b class="badge badge-success text-light">
				 			Dalam Penyewaan
				 		</b>
				 		@elseif($invoice->status == "backing stuff")
				 		<b class="badge badge-success text-light">
				 			Pengembalian Barang
				 		</b>
				 		@endif
					</li>
				</ul>
			</div>		

			<div>
				<b class="ft-12">Tgl Sewa :</b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<b class="text-success ft-13">{{$invoice->start_rent}}</b>
					</li>
				</ul>												
			</div>

			<div>
				<b class="ft-12">Tgl Sewa Berakhir :</b>
				<ul class="list-group">
					<li class="list-group-item no-border">
						<b class="text-danger ft-13">{{$invoice->end_rent}}</b>
					</li>
				</ul>												
			</div>	

			<div>
				<b class="ft-12">Jaminan :</b>
				<ul class="list-group">
					<li class="list-group-item no-border ft-13">
						<b>{{$invoice->guaranteing}}</b>
					</li>
				</ul>
			</div>
		</div>

		<div class="float-right">					
			@if($invoice->status != "pending")
				<div>
					<b class="ft-12">Status Pembayaran :</b>
					<ul class="list-group">
						<li class="list-group-item no-border"> 
							@if($invoice->status_payment == "unpaid")
								<b class="badge badge-danger">Belum Bayar</b>
							@elseif($invoice->status_payment == "expired")
								<b class="badge badge-danger text-light">Kadaluarsa</b>
							@elseif($invoice->status_payment == "paid")
								<b class="badge badge-success text-light">Sudah Bayar</b>
							@endif
						</li>
					</ul>
				</div>			

				<div>
					<b class="ft-12">Expired Pembayaran Pada :</b>
					<ul class="list-group">
						<li class="list-group-item no-border"> 
							<b class="text-danger ft-13">
								Mohon Bayar Sebelum : {{$invoice->expired_payment}}
							</b>
						</li>
					</ul>
				</div>	
			@endif		
		</div>
	</div>

	<div class="mb-3">
		<b class="ft-12"> Product : </b>
		<table class="table table-hover mt-3">	
			@foreach($invoice->order_items as $item)
			<tr>
				<td width="120px">
					<img 
						src="{{asset('images/products/'.$item->product->get_images[0])}}" 
						class="img-fluid"/>
				</td>		
				<td>
					<div class="clearfix">
						<div class="float-left">
							<div class="d-flex flex-column">
								<span><a href="{{url('/product/'.$item->product->id)}}" class="text-dark">{{$item->product->name}}</a></span>
								<span class="text-success">						
									{{$item->product->get_rent_price}}							
								</span>
							</div>
						</div>					
						
						@if(
							$invoice->status == "in rent" ||
							$invoice->status == "backing stuff"
						)
						<div class="float-right">
							<span class="cursor-pointer"
								onclick="showFormReviewProduct('{{$item->id}}')">
								<i class="fa fa-comment"></i>
								Review
							</span>
						</div>
						@endif
					</div>

					<div class="mt-4 form-review-product"
						id="form-review-product-{{$item->id}}"
						style="display:none">

						<form
							id="form-review-{{$item->id}}"
							method="post"
							action="{{url('action/review-product')}}">

							@csrf

							<input type="hidden" 
								name="invoice_id" 
								value="{{$invoice->id}}">

							<input type="hidden" 
								name="product_id" 
								value="{{$item->product->id}}">

							<div class="form-group">								
								<select name="star" class="form-control">
									<option value="1">Bintang 1</option>
									<option value="2">Bintang 2</option>
									<option value="3">Bintang 3</option>
									<option value="4">Bintang 4</option>
									<option value="5">Bintang 5</option>
								</select>
							</div>

							<div class="form-group">
								<textarea class="form-control textarea-camp-violet" 
									name="komentar" 
									placeholder="Komentar"
									data-parsley-required></textarea>
							</div>

							<div class="form-group">
								<button class="btn btn-violet text-light no-border box-button-camp mb-2"
									id="button-submit-form-review-{{$item->id}}">
									<i class="fab fa-telegram-plane"></i> 
									Kirim
								</button>

								<button class="btn btn-violet text-light no-border box-button-camp mb-2"
									type="reset"
									onclick="hideFormReviewProduct()"
									id="button-cancel-form-review-{{$item->id}}">
									<i class="fa fa-times"></i>
									Batal
								</button>
							</div>
						</form>
					</div>
				</td>				
			</tr>
			@endforeach
			<tr>
				<td colspan="2" class="text-right no-border">
					Total Pembayaran  :
					<b class="text-success"> Rp {{number_format($invoice->total,"2")}} </b>
				</td>
			</tr>
		</table>
	</div>

</div>