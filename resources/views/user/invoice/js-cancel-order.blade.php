<script>
function cancelOrder(id){
  swal.fire({
    title: 'Apakah Anda Yakin?',
    text: 'Membatalkan pesanan ini',
    icon: 'warning',
    confirmButtonColor: '#fe7c96',
    showCancelButton: true,
    confirmButtonText: 'Oke',
    showLoaderOnConfirm: true,
    cancelButtonText: 'Batal',      
  })
  .then(result => {
  	if(result.value){
  	 $("#loading-modal").show();
  	 $("#loading-modal > div").show();
  	 window.location = "{{url('action/cancel-order/')}}/"+id;
  	}
  })
}
</script>