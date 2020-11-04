<div class="container-fluid">		
	<div class="row p-4" 
		id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-lg-4 col-sm-12">
					<div class="row text-center">
						<div class="col-12">
							Kontak Kami
							<br>
							{{config('app.footer_contact_us')}}
						</div>
					</div>
				</div>

				<div class="col-md-4 col-lg-4 col-sm-12">
					<div class="row text-center">
						<div class="col-12">
							Dengan campRental mempermudah cara berkemah anda.
						</div>

						<div class="col-12 mt-5">
							Siap selalu melayani anda
						</div>
					</div>
				</div>

				<div class="col-md-4 col-lg-4 col-sm-12">
					<div class="row text-center">
						<div class="col-12">
							<a 
							 href="{{url('/')}}">
								 <img 
									src="{{asset('images/logo.png')}}" 
									height="45px"/> 
							</a>
						</div>
						<div class="col-12">
							Hanya di kota {{config('app.city')}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row p-3" 
		id="copyright">
		<div class="col-12 text-center">
			Copyright@super
		</div>
	</div>
</div>

<!-- CSS FOOTER -->
<style>
	#footer{
		box-shadow: 10px 10px 20px 10px rgb(127,127,127,0.2);
		background:rgb(16,37,63);
		color:white;
		font-size: 15px;
	}

	#footer > div > div > div{
		padding: 20px;
	}

	#footer > div > div > div > div{
		padding-top:10px;
		border-radius: 10px;
		border-top:5px solid white;		
	}

	#copyright{
		font-size: 15px;
		color:white;
		background:rgb(30,28,17);
	}
</style>