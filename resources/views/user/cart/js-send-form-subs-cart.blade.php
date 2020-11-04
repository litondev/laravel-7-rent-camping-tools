<script>
function sendFormSubsCart(self){
	if(cart.length){
		swal.fire({
    		title: 'Apakah Anda Yakin?',
    		icon: 'warning',
    		confirmButtonColor: '#fe7c96',
    		showCancelButton: true,
    		confirmButtonText: 'Oke',
    		showLoaderOnConfirm: true,
    		cancelButtonText: 'Batal',      
  		})
  		.then(result => {
  			if(result.value){
  				var queryString = "?";
		
				for(var i=0;i<cart.length;i++){
					queryString += "id[]="+cart[i]+"&"
				}		

  	 			$("#loading-modal").show();
  	 			$("#loading-modal > div").show();

				window.location = '{{url("/action/subs-cart")}}'+queryString;
  			}
  		})		
	}
}
</script>