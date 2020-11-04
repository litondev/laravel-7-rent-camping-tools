@extends("layouts.user")

@section("page_title","Notifikasi")

@section("sc_header")
<style>
.notif-card:hover{
	box-shadow: 5px 5px 10px 0px rgb(127,127,127,0.2);
	border-radius: 20px;
}

.notif-card:nth-child(even){
	background: rgb(139,21,158,0.1);
	border-radius: 20px;
}
</style>
@endsection

@section("content")
@if(count($notif))
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center mb-4">
				<h4>Notifikasi</h4>
			</div>

			@foreach($notif as $item)
				<div class="col-12 cursor-pointer mt-3 mb-5 notif-card p-2">
					<div class="row p-3">
						<div class="col-md-2 col-lg-2 col-sm-12 text-center">
							<img src="{{asset('images/notif.png')}}" 														
								style="height:100px"/>
						</div>

						<div class="col-md-10 col-lg-10 col-sm-12 mt-2">
							<div class="row p-2">
								<div class="col-12">
									<div class="clearfix">
										<div class="float-left">
											<b class="badge badge-primary">
												{{$item->title}}
											</b>
										</div>
										<div class="float-right">
											<span class="badge badge-info">
												{{$item->get_human_created_at}}
											</span>
										</div>
									</div>
								</div>
							
								<div class="col-12 mt-2">
									<b>{{$item->sub_title}}</b>
								</div>

								<div class="col-12 mt-2">
									{{$item->description}}
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach		

			<div class="col-12 p-3">
				<nav class="float-right paginate-overflow">						
					{{$notif->links()}}					  
				</nav>					
			</div>
		</div>
	</div>
@else
	<div class="container">
		<div class="row p-5">
			<div class="col-12 text-center">
				<h4>Notifikasi</h4>
			</div>

			<div class="col-12 text-center">
				<img src="{{asset('images/not-found.png')}}" 
					width="40%"
					class="img-fluid">

				<br>

				<span class="ft-20">
					<b>Data Tidak Ditemukan</b>
				</span>

				<br>

				<span class="ft-13">
					Notifikasi Tidak Ditemukan
				</span>
			</div>
		</div>
	</div> 
@endif
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){}

function mobile_res(){}

function destop_res(){}
</script>
@endsection