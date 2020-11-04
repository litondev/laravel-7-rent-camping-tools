@if($invoice->status != "pending")
<!-- <div class="col-12 bg-warning text-light p-4 border-radius-10 ft-15 box-camp mb-2">
	<button type="button" class="close text-dark" 
		onclick="this.parentNode.style = 'display:none'">
        <span aria-hidden="true">&times;</span>
    </button>

	<h6>Info</h6> 
	1.) Anda tidak dapat membatalkan pesanan setelah status pesanan anda sudah 
	<b>pengembalian barang,dalam penyewaan dan pengambilan barang</b>
</div> -->
@endif

@if($invoice->status == "pending")
	<!-- <div class="col-12 bg-info text-light p-4 border-radius-10 ft-15 box-camp">
		<button type="button" class="close text-dark" 
			onclick="this.parentNode.style = 'display:none'">
        	<span aria-hidden="true">&times;</span>
    	</button>	

		<h6>Info</h6> 
		1). Mohon tunggu sekitar 1x24 jam agar divalidasi oleh admin kami
	</div> -->
@endif

@if($invoice->status == "payment")
	@if($invoice->status_payment != "paid")
		<!-- <div class="col-12 bg-info text-light p-4 border-radius-10 ft-15 box-camp mb-3">
			<button type="button" class="close text-dark" 
				onclick="this.parentNode.style = 'display:none'">
        		<span aria-hidden="true">&times;</span>
    		</button>	

			<h6>Info</h6>
			1.) Anda sekarang dapat melakukan pembayaran dengan transfer ke No Rekening 
			<b>####-####-####</b> Atas Nama <b>####</b>
			<br>
			2.) Bayar sebelum waktu jatuh tempo
			<br>
		</div> -->
	@endif		
@endif

@if(
	$invoice->status == "payment" || 
	$invoice->status == "prepare" || 
	$invoice->status == "withdrawing stuff" || 
	$invoice->status == "backing stuff" || 
	$invoice->status == "in rent"
)
	<!-- <div class="col-12 bg-danger text-light p-4 border-radius-10 ft-15">
		<button type="button" class="close text-dark" 
			onclick="this.parentNode.style = 'display:none'">
        	<span aria-hidden="true">&times;</span>
    	</button>	

		<h6>Info</h6>
		1.) Setelah melakukan pembayaran, setelah itu penyewa membatalkan pesanan/sudah jatuh tempo maka uang tidak akan dikembalikan, terkecuali pihak kami yang melakukan pembatalan
	</div>	 -->
@endif