<!DOCTYPE HTML>
<html>
	<head>
	 <!-- META CHARSET -->
	 <meta charset="UTF-8">

	 <!-- TITLE PAGE -->
	 <title>@yield('page_title') | {{config('app.site_name')}}</title>

	 <!-- META VIEW PORT -->
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">

	 <!-- META VIEW PORT -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- META DESCRIPTION -->
     <meta name="description" content="{{config('app.meta_description')}}}">

     <!-- LOGO -->
     <link rel="icon" href="{{asset('images/logo-header.png')}}" type="image/png">

     <!-- BOOTSTRAP CSS -->
	 <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/bootstrap.min.css')}}">

	 <!-- TOAST CSS -->
	 <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/toastr.min.css')}}">

	 <!-- OWL CAROUSEL CSS -->
     <link rel="stylesheet" href="{{asset('user/assets/css/owl/owl.carousel.min.css')}}">
     <link rel="stylesheet" href="{{asset('user/assets/css/owl/owl.theme.default.min.css')}}">

     <!-- DATERANGE PICKER CSS -->
     <link rel="stylesheet" href="{{asset('user/assets/css/daterangepicker.css')}}">

     <!-- SEMUA CSS BUATAN SENDIRI -->
     <link rel="stylesheet" href="{{asset('all.css')}}">

     <!-- SCRIPT JAVSCRIPT UNTUK MEMBUAT FONT BINTANG -->
	 <script>
		function makeStar(count,id){
			var html = "";

			if(parseInt(count) == 0){
				for(var i=0;i<5;i++){
					html += `<i class="fa fa-star text-camp"></i>`
				}
			}else{
				for(var i=0;i<parseInt(count);i++){
					html += `<i class="fa fa-star text-camp" style="color:yellow"></i>`
				}

				var remain = 5-parseInt(count);

				for(var i=0;i<parseInt(remain);i++){
					html += `<i class="fa fa-star text-camp"></i>`;
				}
			}

			document.getElementById(id).innerHTML = html;
		}
	 </script>

	 <!-- CSS STYLE UNTUK LOADING PAGE DAN LOADING MODAL -->
	 <style>
	 	 #loader-page{
	       position:fixed;
	       z-index:99999;
	       top:0;
	       left:0;
	       bottom:0;
	       right:0;
	       background: white;
	       transition: 1s 0.4s;
	     }

	     #loader-page-indikator{
	        top:20%;
	        left:50%;
	        position:absolute;
	     }   

	 	 #loading-modal{
	 	   display: none;
   		   position:fixed;
	       z-index:999990;
	       top:0;
	       left:0;
	       bottom:0;
	       right:0;
	       background: rgb(127,127,127,0.5);
	 	 }

	 	 #loading-modal > div{
	 	 	position: fixed;
	 	 	left:40%;
	 	 	top:30%;
	 	 	width:300px;	 	 	
	 	 	z-index: 999999 !important;  
	 	 }	

	     @media only screen and (max-width: 698px){
	     	#loader-page-indikator{
	     		left:40%;
	     	}

	     	#loading-modal > div{
	     		left:10%;	 	 
	     	}
	     }
	 </style> 

	 <!-- CSS STYLE UNTUK PARSLEY ERRORS -->
	 <style>
		 .parsley-errors-list{
			color:red;
			list-style:none;
			padding:8px;
			opacity: 0.8;
		 }
	 </style>

	 <!-- SCRIPT / STYLE YANG BISA DI MASUKAN KE HEADER TAG -->
	 @yield("sc_header")

	</head>
<body>	
	<!-- LOADING MODAL -->
	<div 
		id="loading-modal">
	  	<div class="modal no-border">
	    	<div class="modal-dialog no-border">
		      <div class="modal-content no-border">        
		        <div class="modal-body no-border pt-5 pb-5">
		        	<div class="text-center no-border">
		        		<i class="fa fa-spinner fa-spin fa-5x"></i> 
		        	</div>		        		     
		        </div>      
		      </div>
	    	</div>
	  	</div>
	 </div>
  	<!-- LOADING MODAL -->

  	<!-- LOADING PAGE -->
    <div 
    	id="loader-page">                        
        <div 
        	id="loader-page-indikator">
        	<div class="text-center">
        		<i class="fa fa-spinner fa-spin fa-5x"></i> 
        	</div>

        	<!-- 
	        	<div class="mt-2 text-center">
	        		<span style="font-size:20px;color:rgb(139,21,158,189)">Loading</span>
	        	</div> 
        	-->
        </div>
    </div>	
    <!-- LOADING PAGE -->

    <!-- NAVBAR -->
    @include("includes.navbar")

    <!-- CONTENT -->
	@yield("content")

	<!-- FOOTER -->
	@include("includes.footer")

	<!-- JQUERY -->
	<script src="{{asset('user/assets/js/jquery.min.js')}}"></script>	
	<!-- POPPER -->
	<script src="{{asset('user/assets/js/popper.min.js')}}"></script>
	<!-- BOOTSTRAP -->
	<script src="{{asset('user/assets/js/bootstrap.min.js')}}"></script>
	<!-- TOASTR -->
	<script src="{{asset('user/assets/js/toastr.min.js')}}"></script>
	<!-- SWETALERT -->
	<script src="{{asset('user/assets/js/sweetalert2.js')}}"></script>
	<!-- MOMENT -->
	<script src="{{asset('user/assets/js/moment.js')}}"></script>	
	<!-- MOMENT LOCALE -->
	<script src="{{asset('user/assets/js/moment-with-locales.js')}}"></script>
	<!-- PARSLEY -->
	<script src="{{asset('user/assets/js/parsley.min.js')}}"></script>
	<!-- PARSLEY I18N -->
	<script src="{{asset('user/assets/js/i18n/id.js')}}"></script>
	<!-- FONTAWESOME -->
	<script src="{{asset('user/assets/js/fontawesome.min.js')}}"></script>
	<!-- OWL CAROUSEL -->
	<script src="{{asset('user/assets/js/owl.carousel.min.js')}}"></script>
	<!-- DATERANGE PICKER -->
	<script src="{{asset('user/assets/js/daterangepicker.js')}}"></script>
   
   	<!-- SCRIPT / STYLE YANG BISA DI MASUKAN KE BAWAH SETELAH SCRIPT DILOAD -->
	@yield("sc_footer")

	<!-- LOADING FADEOUT -->
    <script>
	    $("document").ready(function(){
	        $("#loader-page").fadeOut(2000);
	    });
	</script>

	<!-- MOMENT SET LOCALE -->
	<script>
		moment.locale('id');
	</script>

	<!-- JIKA ADA SESSION SUCCESS DARI SERVER -->
 	@if(Session::has("success")) 
        <script>
            toastr.success(
            	"{{Session::get('success')['text']}}",
            	"{{Session::get('success')['title']}}"
            );
        </script>
    @endif

    <!-- JIKA ADA SESSION ERROR DARI SERVER -->
    @if(Session::has("error"))
    	<script>
    	    toastr.error(
    	    	"{{Session::get('error')['text']}}",
    	    	"{{Session::get('error')['title']}}"
    	    );
    	</script>
    @endif         

	<script>    
    // function reponsive akan dipanggil setiap halaman diload atau diresize
    function responsive(){
    	var win = $(this);

		if (win.width() < 599) {   
			try{
		 		phone_res();
		 	}catch(e){

		 	}

	 		phone_res_navbar()	 		
		}else if(win.width() > 600 && win.width() < 968){
			try{
		 		tablet_res();
		 	}catch(e){

		 	}

	 		tablet_res_navbar();
		}else{	
			try{
				destop_res();	 	
			}catch(e){

			}

	 		destop_res_navbar()	 		
		}
    }

    // MEMANGIL FUNCTION RESPONSIVE KETIKA DILOAD
    $(window).on("load",function(){
    	responsive();
    });

    // MEMANGIL FUNCTION RESPONSIVE KETIKA RESIZE
    $(window).on('resize', function() {
		responsive();
	});
    </script>
</body>
</html>