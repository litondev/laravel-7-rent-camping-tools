<!DOCTYPE HTML>
<html>
	<head>
		<style>
            body{
                background-color: #f8f8f8 !important;
                padding: 30px !important;
            }    

    		#box-email-camp{
                border:1px solid lightgray;
                border-radius: 10px;
               	margin: auto;
                padding:25px;
                width:600px;
                background: white;
            }
     
            .text-email-camp{
                font-size: 12px;
                font-family: open sans,tahoma,sans-serif;
                color: rgba(49,53,59,0.96);
            }

            .title-email-camp{
                font-family: open sans,tahoma,sans-serif;
                font-size: 1rem;
                color: rgba(49,53,59,0.96);
            }   

            .best-regards-email-camp{
                float:right;
                margin-top:20px;
            }

            .logo-email-camp{
                height:50px;
                margin-bottom:20px
            }

            .clearfix::after {
      			content: "";
    	  		clear: both;
      			display: table;
    		}
		</style>
	</head>
<body>
	<div style="height:80px"></div>

	<div id="box-email-camp">
		<img src="{{asset('images/logo.png')}}" class="logo-email-camp">

		{!! $content !!}

		<div class="clearfix">
			<div class="text-email-camp best-regards-email-camp">
				Sekian dan terima kasih
			</div>
		</div>
	</div>
</body>
</html>