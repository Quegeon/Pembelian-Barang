@if ( Auth::user()->level === 'admin' )
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/dashboard" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
          Menu Utama
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/petugas" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Petugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/customer" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Customer</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/supplier" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Supplier</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/barang" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaksi" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Transaksi</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Setting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/petugas/profile" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>

@elseif ( Auth::user()->level === 'petugas' )
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/dashboard/petugas" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
          Menu Utama
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/transaksi" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Transaksi</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Setting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/petugas/profile" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>

@elseif ( Auth::user()->level === 'supplier' )
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/dashboard/supplier" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
          Menu Utama
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/barang" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Data Barang</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Setting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/supplier/profile" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>

@elseif ( Auth::user()->level === 'customer' )
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/dashboard/customer" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
          Menu Utama
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/customer/index-buy" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Beli Barang</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Setting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/customer/profile" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
@endif