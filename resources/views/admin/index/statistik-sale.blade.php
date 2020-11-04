<div class="col-md-8 col-lg-8 col-sm-12">
<div class="card shadow mb-4">      
	<div class="card-body text-center">
			<h5>Statistik 7 Hari Penjualan Terakhir</h5>
			<div class="clearfix">
				<div class="float-right">
					Jangka : 
					<form
						action="{{url('admins')}}">
						<select
  						name="gap"
							onchange="this.form.submit()">
							<option value="7" {{$request->has('gap') && $request->gap == '7' ? 'selected' : ''}}>7 Hari</option>
							<option value="10" {{$request->has('gap') && $request->gap == '10' ? 'selected' : ''}}>10 Hari</option>
							<option value="30" {{$request->has('gap') && $request->gap == '30' ? 'selected' : ''}}>30 Hari</option>
							<option value="60" {{$request->has('gap') && $request->gap == '60' ? 'selected' : ''}}>60 Hari</option>
						</select>
					</form>
				</div>
			</div>
			<hr/>
			<div id="chartContainer" 
				style="height: 370px; max-width: 90%; margin: 0px auto;">
			</div>
		</div>
	</div>
</div>