<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <button id="sidebarToggleTop" 
    class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" 
        href="#" 
        id="alertsDropdown" 
        role="button" 
        data-toggle="dropdown" 
        aria-haspopup="true" 
        aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
      </a>

      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Notification Admin
        </h6>

        @forelse(config('app.notif_admin') as $item)
        <a class="dropdown-item d-flex align-items-center" 
          href="#">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fa fa-bell text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">
              {{$item->get_human_created_at}}
            </div>
            <span class="font-weight-bold">
              {{ucfirst($item->content)}}
            </span>
          </div>
        </a>
        @empty
          <div class="text-gray-500 text-center mt-3 mb-3 p-3">
            <div class="mt-2">
              <i class="fa fa-bell fa-5x"></i>
            </div>
            <div class="mt-3">
              <h5>Notif Kosong</h5>
            </div>
          </div>
        @endforelse       

        @if(count(config('app.notif_admin')) > 0)
          <a class="dropdown-item text-center small text-gray-500" 
            href="{{url('admins/notif-admin')}}">
            Tampilkan Semua
          </a>
        @endif
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block">
    </div>

    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" 
        href="#" 
        id="userDropdown" 
        role="button" 
        data-toggle="dropdown" 
        aria-haspopup="true" 
        aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          {{Auth::user()->first_name}}
        </span>

        <i class="fa fa-user-circle"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" 
        aria-labelledby="userDropdown">
 
        <a class="dropdown-item" href="{{url('admins/log-admin')}}">
          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
          Log Admin
        </a>

        <a class="dropdown-item" href="{{url('/')}}">
          <i class="fas fa-reply fa-sm fa-fw mr-2 text-gray-400"></i>
          Kembali Ke User
        </a>

        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="{{url('logout')}}">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>