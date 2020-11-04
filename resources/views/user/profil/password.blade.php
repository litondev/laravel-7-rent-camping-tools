<div class="col-12 mt-4 profil-detail box-camp" 
	id="profil-password">
	<div class="p-3">
		<h3>Password</h3>
	</div>

	<div class="mt-3 p-3">
		<form
			id="form-password"
			action="{{url('action/update-password')}}"
			method="post">

			@csrf

			<div class="form-group row">
				<div class="col-3 pt-3">
					Password Baru 
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
					name="password_baru"
					type="password" 
					data-parsley-minlength="8"
		 			data-parsley-required>
				</div>
			</div>


			<div class="form-group row">
				<div class="col-3 pt-3">
					Password Konfirmasi
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
					type="password"
					name="password"
					data-parsley-minlength="8"
		 			data-parsley-required>
				</div>
			</div>

			<div>
				<button class="btn btn-violet no-border box-button-camp text-light" 
					id="button-password">
					<i class="fab fa-telegram-plane"></i>
					Kirim
				</button>
			</div>					
		</form>
	</div>
</div>