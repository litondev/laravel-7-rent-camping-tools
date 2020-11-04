<!DOCTYPE html>
<html lang="en">
<head>
  <!-- META CHARSET -->
  <meta charset="utf-8">

  <!-- TITLE PAGE -->
  <title>Admin | {{config('app.site_name')}}</title>

  <!-- META VIEW PORT -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- META VIEW PORT -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- LOGO -->
  <link rel="icon" href="{{asset('images/logo-header.png')}}" type="image/png">

  <!-- FONTAWESOME CSS -->
  <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- SBADMIN CSS -->
  <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- TOAST CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/toastr.min.css')}}">
    
  <!-- DATERANGE PICKER CSS -->
  <link rel="stylesheet" href="{{asset('user/assets/css/daterangepicker.css')}}">

  <!-- SWITCHER CSS -->
  <link rel="stylesheet" href="{{asset('user/assets/css/switchery.min.css')}}"> 
  
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
          left:45%;
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
          left:30%;
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

  <!-- SEMUA CSS BUATAN SENDIRI -->
  <style>
  .no-border{
    border:0px solid red !important;
  }
  </style>

  <!-- SCRIPT / STYLE YANG BISA DI MASUKAN KE HEADER TAG -->
  @yield("sc_header")
</head>

<body id="page-top">

  <!-- LOADING MODAL -->
  <div 
    id="loading-modal">
      <div class="modal no-border">
        <div class="modal-dialog no-border">
          <div class="modal-content no-border">        
            <div class="modal-body no-border pt-5 pb-5">
              <div class="text-center no-border">
                <i class="fa fa-spinner fa-spin fa-5x text-gray"></i> 
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
          <div class="text-center" style="margin:auto">
            <!-- 
              <i class="fa fa-spinner fa-spin fa-5x"></i> 
            -->

            <div id="svg-loading" 
              style="width:150px"></div> 
          </div>
          
          <div class="mt-2 text-center">
            <span style="font-size:20px;color:rgb(139,21,158,189)">
              Loading . . .
            </span>
          </div>         
        </div>
    </div>  
  <!-- LOADING PAGE -->


  <div id="wrapper">

    <!-- SIDEBAR -->
    @include("includes.sidebar-admin")

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">
        <!-- NAVBAR -->
        @include("includes.navbar-admin")

        <!-- CONTENT -->
        @yield("content")
      </div>

      <!-- FOOTER -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; My Website</span>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- BUTTON SCROLL TOP -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- JQUERY -->
  <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
  <!-- BOOTSTRAP -->
  <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- SBADMIN -->
  <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>
  <!-- EASING -->
  <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- JQUERY MASK -->
  <script src="{{asset('user/assets/js/jquery.mask.min.js')}}"></script>
  <!-- TOASTR -->
  <script src="{{asset('user/assets/js/toastr.min.js')}}"></script>
  <!-- SWEETALERT -->
  <script src="{{asset('user/assets/js/sweetalert2.js')}}"></script>
  <!-- MOMENT -->
  <script src="{{asset('user/assets/js/moment.js')}}"></script> 
  <!-- MOMENT WITH LOCALE -->
  <script src="{{asset('user/assets/js/moment-with-locales.js')}}"></script>
  <!-- PARSLEY -->
  <script src="{{asset('user/assets/js/parsley.min.js')}}"></script>
  <!-- PARSLEY I18N -->
  <script src="{{asset('user/assets/js/i18n/id.js')}}"></script>
  <!-- DATERANGE PICKER -->
  <script src="{{asset('user/assets/js/daterangepicker.js')}}"></script>
  <!-- SWITCHER -->
  <script src="{{asset('user/assets/js/switchery.min.js')}}"></script>
  <!-- VIVUS -->
  <script src="{{asset('user/assets/js/vivus.min.js')}}"></script>

  <!-- SCRIPT / STYLE YANG BISA DI MASUKAN KE BAWAH SETELAH SCRIPT DILOAD -->
  @yield("sc_footer")

  <!-- VIVUS ANIMATION -->
  <script>
      new Vivus('svg-loading', {
        file: "{{asset('images/svg-loading.svg')}}",
        type: 'oneByOne',
      });
  </script>

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

  <!-- SWITCHE SETUP -->
  <script>
      var elems = Array
        .prototype
        .slice
        .call(document.querySelectorAll('input[data-plugin=switchery]'));

      elems.forEach(function(html) {
         var switchery = new Switchery(html);
      });
  </script>
</body>
</html>