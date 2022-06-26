<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-fw fa-database"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Inventory Application</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
      <i class="fas fa-fw fa-chart-bar"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menus
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item
  <?php
    $page_name = explode('/',$_SERVER['PHP_SELF']);
    //Jika ada penambahan halaman, perlu menambahkan "or" nya
    if(end($page_name) == 'gudang.php' || end($page_name) == 'produk.php' || end($page_name) == 'inventory.php')
    {
      echo 'active';
    }
  ?>
  ">
    <a class="nav-link
    <?php
      $page_name = explode('/',$_SERVER['PHP_SELF']);
      //Jika ada penambahan halaman, perlu menambahkan "or" nya
      if(end($page_name) != 'gudang.php' || end($page_name) != 'produk.php' || end($page_name) != 'inventory.php')
      {
        echo 'collapsed';
      }
    ?>" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-fw fa-database"></i>
      <span>Persediaan Barang</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'produk.php')
          {
            echo 'active';
          }
        ?>" href="produk.php">Produk</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'inventory.php')
          {
            echo 'active';
          }
        ?>" href="inventory.php">Inventory</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'lokasi.php')
          {
            echo 'active';
          }
        ?>" href="lokasi.php">Lokasi Gudang</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'lainnya.php')
          {
            echo 'active';
          }
        ?>" href="lainnya.php">Lainnya</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-handshake"></i>
      <span>Perjualan</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'customer.php')
          {
            echo 'active';
          }
        ?>" href="customer.php">Customer</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'sales_quotation.php')
          {
            echo 'active';
          }
        ?>" href="sales_quotation.php">Sales Quotation</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'perform_invoice.php')
          {
            echo 'active';
          }
        ?>" href="perform_invoice.php">Perform Invoice</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'invoice.php')
          {
            echo 'active';
          }
        ?>" href="invoice.php">Invoice</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'penjualan.php')
          {
            echo 'active';
          }
        ?>" href="penjualan.php">Penjualan</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'purchase_order_pelanggan.php')
          {
            echo 'active';
          }
        ?>" href="purchase_order_pelanggan.php">PO Pelanggan</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'others.php')
          {
            echo 'active';
          }
        ?>" href="others.php">Lainnya</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Pembelian</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'vendors.php')
          {
            echo 'active';
          }
        ?>" href="vendors.php">Vendor</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'permintaan_pembelian.php')
          {
            echo 'active';
          }
        ?>" href="permintaan_pembelian.php">Permintaan Pembelian</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'pembelian.php')
          {
            echo 'active';
          }
        ?>" href="pembelian.php">Pembelian</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="true" aria-controls="collapseFifth">
      <i class="fas fa-fw fa-truck"></i>
      <span>Delivery Order</span>
    </a>
    <div id="collapseFifth" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="do.php">List Delivery Order</a>
        <a class="collapse-item" href="formdo.php">Form Deliery Order</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
      <i class="fas fa-fw fa-folder"></i>
      <span>Laporan</span>
    </a>
    <div id="collapseSix" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'expense.php')
          {
            echo 'active';
          }
        ?>" href="expense.php">Pengeluaran Lainnya</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'laporan_keuangan.php')
          {
            echo 'active';
          }
        ?>" href="laporan_keuangan.php">Laporan Keuangan</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
      <i class="fas fa-fw fa-user"></i>
      <span>Users</span>
    </a>
    <div id="collapseSeven" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'history.php')
          {
            echo 'active';
          }
        ?>" href="history.php">Log History</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'users.php')
          {
            echo 'active';
          }
        ?>" href="users.php">Users</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
