<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" 
  id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" 
    href="{{url('admins')}}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">CampRent</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="{{url('admins')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" 
      href="#" 
      data-toggle="collapse" 
      data-target="#collapseInvoice" 
      aria-expanded="true" 
      aria-controls="collapseInvoice">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Invoice</span>
    </a>
    <div id="collapseInvoice" 
      class="collapse" 
      aria-labelledby="headingInvoice" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Invoice</h6>
          <a class="collapse-item" href="{{url('admins/invoice')}}">Kelola Invoice</a>
        <h6 class="collapse-header">Kelola Invoice Aktif</h6>
          <a class="collapse-item" href="{{url('admins/invoice/pending')}}">Pending</a>
          <a class="collapse-item" href="{{url('admins/invoice/payment')}}">Pembayaran</a>
          <a class="collapse-item" href="{{url('admins/invoice/prepare')}}">Persiapan</a>
          <a class="collapse-item" href="{{url('admins/invoice/withdrawing-stuff')}}">Pengambilan Barang</a>
          <a class="collapse-item" href="{{url('admins/invoice/in-rent')}}">Dalam Penyewaan</a>
          <a class="collapse-item" href="{{url('admins/invoice/backing-stuff')}}">Pengembalian Barang</a>
        <h6 class="collapse-header">Kelola Invoice Nonaktif</h6>
          <a class="collapse-item" href="{{url('admins/invoice/expired-payment')}}">Kadaluarsa Pembayaran</a>
          <a class="collapse-item" href="{{url('admins/invoice/expired-invoice')}}">Kadaluarsa Invoice</a>
          <a class="collapse-item" href="{{url('admins/invoice/rejected')}}">Ditolak</a>
          <a class="collapse-item" href="{{url('admins/invoice/canceled')}}">Batal</a>
          <a class="collapse-item" href="{{url('admins/invoice/completed')}}">Selesai</a>
      </div>
    </div>
  </li>

   <li class="nav-item">
    <a class="nav-link collapsed" 
      href="#" 
      data-toggle="collapse" 
      data-target="#collapseManualPayment" 
      aria-expanded="true" 
      aria-controls="collapseManualPayment">
      <i class="fas fa-fw fa-money-check"></i>
      <span>Pembayaran Manual</span>
    </a>
    <div id="collapseManualPayment" 
      class="collapse" 
      aria-labelledby="headingManualPayment" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Pembayaran</h6>
        <a class="collapse-item" href="{{url('admins/manual-payment')}}">Kelola Pembayaran</a>
        <a class="collapse-item" href="{{url('admins/manual-payment/validasi')}}">Validasi Pembayaran</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" 
      data-toggle="collapse" 
      data-target="#collapseUser" 
      aria-expanded="true" 
      aria-controls="collapseUser">
      <i class="fas fa-fw fa-user"></i>
      <span>User</span>
    </a>

    <div id="collapseUser" 
      class="collapse" 
      aria-labelledby="headingUser" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola User</h6>
        <a class="collapse-item" href="{{url('admins/user')}}">Kelola User</a>
        <a class="collapse-item" href="{{url('admins/user/blokir')}}">Kelola User Blokir</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" 
      href="#" 
      data-toggle="collapse" 
      data-target="#collapseProduct" 
      aria-expanded="true" 
      aria-controls="collapseProduct">
      <i class="fas fa-fw fa-list"></i>
      <span>Product</span>
    </a>
    <div id="collapseProduct" 
      class="collapse" 
      aria-labelledby="headingProduct" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Product</h6>
        <a class="collapse-item" href="{{url('admins/product')}}">Kelola Product</a>
        <a class="collapse-item" href="{{url('admins/product/nonaktif')}}">Kelola Product Nonaktif</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" 
      href="#" 
      data-toggle="collapse" 
      data-target="#collapseKomentar" 
      aria-expanded="true" 
      aria-controls="collapseKomentar">
      <i class="fas fa-fw fa-reply"></i>
      <span>Komentar</span>
    </a>
    <div id="collapseKomentar" 
      class="collapse" 
      aria-labelledby="headingKomentar" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Komentar</h6>
        <a class="collapse-item" href="{{url('admins/review')}}">Kelola Komentar</a>
        <a class="collapse-item" href="{{url('admins/review/negatif')}}">Kelola Komentar Negatif</a>        
        <a class="collapse-item" href="{{url('admins/review/positif')}}">Kelola Komentar Positif</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link 
      collapsed" 
      href="#" 
      data-toggle="collapse" 
      data-target="#collapseSetting" 
      aria-expanded="true" 
      aria-controls="collapseSetting">
      <i class="fas fa-fw fa-cog"></i>
      <span>Setting</span>
    </a>
    <div id="collapseSetting" 
      class="collapse" 
      aria-labelledby="headingSetting" 
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Setting</h6>
        <a class="collapse-item" href="{{url('admins/setting/website')}}">Setting Website</a>
        <a class="collapse-item" href="{{url('admins/setting/invoice')}}">Setting Invoice</a>        
        <a class="collapse-item" href="{{url('admins/setting/order')}}">Setting Order</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('admins/category')}}">
      <span>Kategori</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('admins/info')}}">
      <span>Info</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('admins/slider')}}">
      <span>Slider</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('admins/cronjob')}}">
      <span>Manual Cronjob</span>
    </a>
  </li>
  
  <div class="text-center d-none d-md-inline">  
    <button class="rounded-circle border-0" 
      id="sidebarToggle"
      onclick="cekSidebarAdminToggle()">
    </button>
  </div>
</ul>

<script>
if(localStorage){
  var sidebarAdminToggle = localStorage.getItem('sidebarAdminToggle');

  if(sidebarAdminToggle){
    if(sidebarAdminToggle == 'hide'){
      document.getElementById('accordionSidebar').classList.add('toggled');
    }  
  }

  function cekSidebarAdminToggle(){
    if(document.getElementById('accordionSidebar').classList.length == 5){
      localStorage.setItem('sidebarAdminToggle','hide');
    }else{
      localStorage.setItem('sidebarAdminToggle','show');
    }
  }
}
</script>