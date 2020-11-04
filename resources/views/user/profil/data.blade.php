<div class="col-12 mt-4 profil-detail box-camp" 
	id="profil-data">
	<div class="p-3">
		<h3>Data Diri</h3>
	</div>

	<div class="mt-3 p-3">
		<form
			id="form-data-diri"
			action="{{url('action/update-data')}}"
			method="post">
			
			@csrf

			<div class="form-group row">
				<div class="col-3 pt-3">
					Nama Depan
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
						value="{{Auth::user()->first_name}}"
						name="first_name"
						type="text"
						data-parsley-required>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					Nama Belakang
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
						value="{{Auth::user()->last_name}}"
						name="last_name"
						type="text"
						data-parsley-required>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					Email
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
						value="{{Auth::user()->email}}"
						name="email"
						type="text"
						data-parsley-type="email"
						data-parsley-required>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					No Telp
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
						value="{{Auth::user()->phone}}"
						name="phone"
						type="number"
						data-parsley-type="number"
						data-parsley-required>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					Alamat
				</div>
				<div class="col-9">
					<textarea class="form-control textarea-camp-violet" 
						name="address" 
						data-parsley-required>{{Auth::user()->address}}</textarea>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					Jenis Kelamin
				</div>
				<div class="col-9 pt-2">
					@if(Auth::user()->gender == "male")
						<b>Laki-Laki</b>
					@else
						<b>Perempuan</b>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<div class="col-3 pt-3">
					Password Konfirmasi
				</div>
				<div class="col-9">
					<input class="form-control input-camp-violet"
					name="password"
					type="password" 
					data-parsley-minlength="8"
		 			data-parsley-required>
				</div>
			</div>

			<div>
				<button class="btn btn-violet no-border box-button-camp text-light" 
					id="button-data-diri">
					<i class="fab fa-telegram-plane"></i>
					Kirim
				</button>
			</div>
		</form>
	</div>
</div>