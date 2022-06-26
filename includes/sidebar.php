<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">Application</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
      <i class="fas fa-home"></i>
      <span>Home</span></a>
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
      <span>Penjualan</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <?php
        if($_SESSION['role'] == 1)
        {
        ?>
          <a class="collapse-item
          <?php
            $page_name = explode('/',$_SERVER['PHP_SELF']);
            if(end($page_name) == 'customer.php')
            {
              echo 'active';
            }
          ?>" href="customer.php">Customer</a>
        <?php
        }
        ?>
          <a class="collapse-item
          <?php
            $page_name = explode('/',$_SERVER['PHP_SELF']);
            if(end($page_name) == 'sales_quotation.php')
            {
              echo 'active';
            }
          ?>" href="sales_quotation.php">Sales Quotation</a>
        <?php
        if($_SESSION['role'] == 1)
        {
        ?>
          <a class="collapse-item
          <?php
            $page_name = explode('/',$_SERVER['PHP_SELF']);
            if(end($page_name) == 'perform_invoice.php')
            {
              echo 'active';
            }
          ?>" href="perform_invoice.php">Perform Invoice</a>
        <?php
        }
        ?>

          <a class="collapse-item
          <?php
            $page_name = explode('/',$_SERVER['PHP_SELF']);
            if(end($page_name) == 'invoice.php')
            {
              echo 'active';
            }
          ?>" href="invoice.php">Invoice</a>
        <?php
        if($_SESSION['role'] == 1)
        {
        ?>
          <a class="collapse-item
          <?php
            $page_name = explode('/',$_SERVER['PHP_SELF']);
            if(end($page_name) == 'purchase_order_pelanggan.php')
            {
              echo 'active';
            }
          ?>" href="purchase_order_pelanggan.php">PO Pelanggan</a>
        <?php
        }
        ?>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'delivery_order.php')
          {
            echo 'active';
          }
        ?>" href="delivery_order.php">DO Penjualan</a>
        <!--
        <a class="collapse-item
        <?php
          /*
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'others.php')
          {
            echo 'active';
          }
          */
        ?>" href="others.php">Lainnya</a>
        -->
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
          if(end($page_name) == 'vendor.php')
          {
            echo 'active';
          }
        ?>" href="vendor.php">Vendor</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'pembelian.php')
          {
            echo 'active';
          }
        ?>" href="pembelian.php">Pembelian</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'delivery_order_pembelian.php')
          {
            echo 'active';
          }
        ?>" href="delivery_order_pembelian.php">DO Pembelian</a>
      </div>
    </div>
  </li>

  <?php
    if($_SESSION['role'] == 1)
    {
  ?>
      <li class="nav-item">
        <a class="nav-link" href="kode_akun.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Kode Akun</span>
        </a>
      </li>
  <?php
    }
  ?>

  <?php
    if($_SESSION['role'] == 1)
    {
  ?>
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
          if(end($page_name) == 'jurnal_umum_form.php')
          {
            echo 'active';
          }
        ?>" href="jurnal_umum_form.php">Jurnal Umum</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'buku_besar_form.php')
          {
            echo 'active';
          }
        ?>" href="buku_besar_form.php">Buku Besar</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'neraca_saldo_form.php')
          {
            echo 'active';
          }
        ?>" href="neraca_saldo_form.php">Neraca Saldo</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'neraca_lajur_form.php')
          {
            echo 'active';
          }
        ?>" href="neraca_lajur_form.php">Neraca Lajur</a>
        <a class="collapse-item
        <?php
          $page_name = explode('/',$_SERVER['PHP_SELF']);
          if(end($page_name) == 'laporan_keuangan_form.php')
          {
            echo 'active';
          }
        ?>" href="laporan_keuangan_form.php">Laporan Keuangan</a>
      </div>
    </div>
  </li>
  <?php
    }
  ?>

  <?php
    if($_SESSION['role'] == 1)
    {
  ?>
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-user-friends"></i>
          <span>User</span>
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="profile_perusahaan.php">
          <i class="fas fa-building"></i>
          <span>Profil Perusahaan</span>
        </a>
      </li>
  <?php
    }
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
