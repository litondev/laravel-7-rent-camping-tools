<div class="col-md-4 col-lg-4 col-sm-12">
	<div class="card shadow mb-4">      
	<div class="card-body">
			<h5>Statistik User</h5>
			<hr/>
			<div class="table-responsive mt-2">  						
			<table class="table table-borderless table-hover">
				<tr>
					<td><b>Jumlah</b></td>	        					
					<td>
						{{$data->user->total}}
					</td>
				</tr>	        				
				<tr>
					<td><b>Blokir</b></td>	        					
					<td>
						{{$data->user->blokir}}
					</td>
				</tr>	       
				<tr>
					<td><b>Aktif</b></td>
					<td>
						{{$data->user->aktif}}
					</td>
				</tr>
				<tr>
					<td><b>Baru</b></td>
					<td>
						{{$data->user->new}}
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="float-right">
							<a href="{{url('admins/user')}}">
								Lihat Semuanya
							</a>
						</div>
					</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>