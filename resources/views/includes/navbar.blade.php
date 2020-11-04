<!-- BANTALAN UNTUK FIXED TOP NAVBAR -->
<div style="height:70px"></div>

<!-- NAVBAR DEKSTOP -->
<nav class="navbar navbar-expand-lg bg-dark navbar-default fixed-top">
	<div class="container">
	  <span class="navbar-brand">
	  	<a href="{{url('/')}}">
	  		<img 
		  		src="{{asset('images/logo.png')}}" 
	  			height="45px"/>
	  	</a>

		<form
		  action="{{url('/product')}}"
    	  method="get">
			<input class="form-control input-camp-navbar-mobile"
				type="text" 
				name="search"						
				placeholder='&#128269; Search'
				onkeypress="event.key == 'enter' ? this.submit() : ''">
		</form>
	  </span>

 	  <button class="navbar-toggler text-white" 
	  	onclick="window.location='{{url('/navbar-mobile')}}'">	  
	  	<a class="pos-relative text-light" 
        	href="{{url('/cart')}}">
        	@if(Auth::user())
        		@if(intval(config('app.user_cart')))
        		<span class="point-red-mobile">
	        		<i class="fa fa-circle text-danger"></i>
        		</span>
        		@endif
        	@endif
        	<i class="fa fa-shopping-basket fa-1x"></i>	        
	    </a>
	  </button>

	  <button class="navbar-toggler text-white" 
	  	onclick="onOpenNavbarMobile('show')">	  	 
		<i class="fa fa-stream fa-1x"></i>
	  </button>

	  <div class="collapse navbar-collapse">
	    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
	      <li class="nav-item">
	        <form class="form-inline mt-1"
	        	action="{{url('/product')}}"
	        	method="get">
	      		<div class="input-group">
	        		<div class="input-group-prepend">
	          			<span class="input-group-text">
			          		<i class="fa fa-search"></i>
	          			</span>
	        		</div>
	        		<input class="form-control"
	        			type="text" 
	        			name="search"	        			
	        			placeholder="Search . . . "
	        			onkeypress="event.key == 'enter' ? this.submit() : ''">       
	      		</div>
	    	</form>
	      </li> 

 		  <li class="nav-item">
      		<a class="nav-link mt-1" 
      			href="{{url('/info')}}">	      			
      			Info
      		</a>
	      </li>

	      <li class="nav-item">
	        <a class="nav-link pos-relative" 
	        	href="{{url('/cart')}}">
	        	@if(Auth::user())
	        		@if(intval(config('app.user_cart')))
	        		<span class="point-red">
		        		<i class="fa fa-circle text-danger"></i>
	        		</span>
	        		@endif
	        	@endif
	        	<i class="fa fa-shopping-basket fa-2x"></i>	        
	        </a>
	      </li>      	    

	      @if(Auth::user())
	      <li class="nav-item">
	      		<a class="nav-link pos-relative" 
	      			href="{{url('/akun')}}">
	      			<i class="fa fa-user fa-2x"></i>
	      		</a>
	      </li>
	      @endif

	      @if(Auth::user())
	        <li class="nav-item">
	      		<a class="nav-link pos-relative" 
	      			href="{{url('/notif')}}">	        
	      			<i class="fa fa-bell fa-2x"></i>
	      		</a>
	      	</li>
	      @endif

	      @if(Auth::user())
	      <li class="nav-item">
	      	<a class="nav-link mt-1" 
	      		href="{{url('/logout')}}">
	      		Keluar
	      	</a>
	      </li>
	      @endif
	      
	      @if(!Auth::user())
	      <li class="nav-item">
	        <a class="nav-link mt-1" 
	        	href="{{url('/signup')}}">
	        	Daftar
	        </a>
	      </li>
	      @endif

	      @if(!Auth::user())
	      <li class="nav-item">
	        <a class="nav-link mt-1" 
	        	href="{{url('/signin')}}">
	        	Masuk
	       	</a>
	      </li>
	      @endif
	  		
	    </ul>
	  </div>
	</div>
</nav>
<!-- NAVBAR DEKSTOP -->


<!-- NAVBAR MOBILE -->
<nav class="bg-dark fixed-bottom" 
	id="navbar-bottom-mobile"
	style="opacity:0.9">

	<div class="container">
		<div class="row p-2">
			<div class="col-4 text-center">
				<a href="{{url('/')}}">
					<div style="padding:10px;color:white">
						<i class="fa fa-home ft-20"></i>
					</div>
				</a>
			</div>

			<div class="col-4 text-center">
				<a href="{{url('/akun')}}">
					<div>
						<span style="border-radius:50%;color:white;border:1px solid white;padding-top:21px;padding-bottom:21px;padding-left:25px;padding-right:25px"
							class="bg-dark box-camp">
							<i class="fa fa-user ft-20"></i>
						</span>
					</div>
				</a>
			</div>

			<div class="col-4 text-center">
				<a href="{{url('/notif')}}">
					<div style="padding:10px;color:white">
						<i class="fa fa-bell ft-20"></i>
					</div>
				</a>
			</div>
		</div>	
	</div>
</nav>

<div class="container-fluid" 
	id="box-navbar-mobile">
	<div class="row">
		<div class="col-2 p-3 bg-dark">
			<i class="fa fa-times text-white fa-2x cursor-pointer" 
				onclick="onOpenNavbarMobile('hide')"></i>
		</div>
		<div class="col-10 pt-2 pb-2 bg-light navbar-mobile">
			<ul class="list-group p-2">
				<li class="list-group-item ft-15">
					<b>Navbar : </b>
				</li>

				<li class="list-group-item">
					<a href="{{url('/')}}">Home</a>
				</li>

				<li class="list-group-item">
					<a href="{{url('/info')}}">Info</a>
				</li>

				@if(!Auth::user())
				<li class="list-group-item">
					<a href="{{url('/signin')}}">Masuk</a>
				</li>
				@endif

				@if(!Auth::user())
				<li class="list-group-item">
					<a href="{{url('/signup')}}">Daftar</a>
				</li>
				@endif

				@if(Auth::user())
				<li class="list-group-item">
					<a href="{{url('/akun')}}">Akun</a>
				</li>
				@endif

				@if(Auth::user())
		        <li class="list-group-item">
		      		<a href="{{url('/notif')}}">Notif</a>
		      	</li>
			    @endif

				@if(Auth::user())
				<li class="list-group-item">
					<a href="{{url('/logout')}}">Keluar</a>
				</li>
				@endif
			</ul>	
		</div>
	</div>
</div>
<!-- NAVBAR MOBILE -->

<!-- SCRIPT NAVBAR -->

<!-- SCRIPT RESPONSIVE NAVBAR -->
<script>
function phone_res_navbar(){
  $(".navbar-brand > a").removeClass("d-block").addClass("d-none");
  $(".navbar-brand > form").removeClass("d-none").addClass("d-block");
  $("#navbar-bottom-mobile").show();
}

function tablet_res_navbar(){
  $(".navbar-brand > a").removeClass("d-block").addClass("d-none");
  $(".navbar-brand > form").removeClass("d-none").addClass("d-block");
  $("#navbar-bottom-mobile").show();
}

function destop_res_navbar(){
  $(".navbar-brand > a").removeClass("d-none").addClass("d-block");
  $(".navbar-brand > form").removeClass("d-block").addClass("d-none");
  $("#navbar-bottom-mobile").hide();
}
</script>

<script>
function onOpenNavbarMobile(way){
	if(way == 'show'){
		$("#box-navbar-mobile").show();
		$("body").css({"overflow" : "hidden"});		
	}else{
		$("#box-navbar-mobile").hide();
		$("body").css({"overflow" : "auto"});
	}
}
</script>

<!-- CSS NAVBAR -->
<style>
.navbar-default{
	color:white;
	font-size: 15px;
	box-shadow: 5px 5px 20px 0px rgb(127,127,127,0.2);
	border-bottom: 1px solid #dddddd;
}

.navbar-default >  div > a{
	color: white !important;
}

.navbar-default > div > div > ul > li {
	padding-right: 10px;
	padding-left: 10px;
}

.navbar-default > div > div > ul > li > a{
	color: white !important;
}

.point-red{
	position:absolute;
	top:-5px;
	right:0px;
}

.point-red-mobile{
	position:absolute;
	top:-3px;
	right:0px;
	font-size: 10px;
}

#box-navbar-mobile{
	z-index:1035;
	top:0px;
	bottom:0px;
	position:fixed;
	display:none;
	overflow: auto;
}

#box-navbar-mobile > div{
    height: 100%; 
}

.navbar-mobile{
	background:rgb(242,242,242);
}

.navbar-mobile > ul > li{
	background: none;
	border:0px;
	border-radius: 0px !important;
	border-bottom: 1px solid rgb(217,217,217);
}

.navbar-mobile > ul > li > a{
	color:rgb(127,127,127,0.5);
}
</style>