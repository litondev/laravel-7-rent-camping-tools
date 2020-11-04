@if($invoice->status == "pending")
	<script>
	swal.fire({
		title : "Invoice dalam antrian",
		text : "Tolong tunggu 1x24 jam agar divalidasi admin",
		icon : "info"
	});
	</script>
@endif

@if($invoice->status == "prepare")
	<script>
	swal.fire({
		title : "Barang akan dipersiapkan",
		text : "Persiapan barang akan memakan waktu sekitar 1x24 jam",
		icon : "info"
	});
	</script>
@endif

@if($invoice->status == "withdrawing stuff")
	<script>
	swal.fire({
		title : "Barang telah siap",
		text : "Sekarang atau nanti anda dapat mengambil barang tersebut",
		icon : "success"
	});
	</script>
@endif

@if($invoice->status == "in rent")
	<script>
	swal.fire({
		title: "Review barang",
		text: "Sekarang anda dapat mereview barang",
		icon: "success"
	});
	</script>
@endif

@if($invoice->status == "backing stuff")
	<script>
	swal.fire({
		title : "Waktu pengembalian barang",
		text : "Pengembalian barang dapat dilakukan 1x24 jam setelah tgl sewa berakhir",	
		icon : "info"
	});
	</script>
@endif