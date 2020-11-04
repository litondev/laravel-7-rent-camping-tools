@extends("layouts.user")

@section("page_title","Profil")

@section("sc_header")
<style>
.list-profil > .active{
	background: rgb(217,217,217,0.8);
}

.list-item-profil{
	cursor: pointer;
	margin-left: 10px;
	background: rgb(217,217,217,0.3);
	border:1px solid gray;
	color: black;
	padding-top:5px;
	padding-bottom: 5px;
	padding-left: 25px;
	padding-right: 25px;
	border-radius: 20px;	
	font-size: 12px;
}	

.list-item-profil:hover{
	background: rgb(217,217,217,0.8);
}

#profil-password{
	display: none;
	border-radius: 20px;
}

#profil-data{
	border-radius: 20px;
}
</style>
@endsection

@section("content")
<div class="container">
	<div class="row pl-3 pt-3 pb-3 pr-3">		
		<div class="col-12">
		  <div class="row pt-3 pb-3">
			<div class="list-profil d-flex flex-row overflow-a">
				<div class="list-item-profil active" 
					onclick="activeProfil('data')">
					<i class="fa fa-user"></i> Data Diri
				</div>
				<div class="list-item-profil" 
					onclick="activeProfil('password')">
					<i class="fa fa-key"></i> Password
				</div>				
			</div>
		  </div>
		</div>

		@include("user.profil.data")
	
		@include("user.profil.password")
	</div>
</div>
@endsection

@section("sc_footer")
<!-- RESPONSIVE -->
<script>
function phone_res(){}

function tablet_res(){}

function destop_res(){}
</script>

<!-- TAB -->
@if($tab)
<script>
	$(".list-item-profil").removeClass("active");
	$(".profil-detail").hide();
	$("#profil-{{$tab}}").show();
</script>
@endif

<script>
function activeProfil(id){
	$(".list-item-profil").removeClass("active");
	$(".profil-detail").hide();
	$("#profil-"+id).show();
}
</script>

<!-- FORM VALIDATION -->
<script>
$("#form-data-diri").parsley().on('form:validate',function(){
	if($("#form-data-diri").parsley().isValid()){
		$("#button-data-diri").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-data-diri").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

$("#form-password").parsley().on('form:validate',function(){
	if($("#form-password").parsley().isValid()){
		$("#button-password").html("<i class='fa fa-spinner fa-spin'></i>")
		$("#button-password").attr("disabled",true);
	}else{
		toastr.warning("Sepertinya ada data yang belum valid","");
	}
});
</script>
@endsection