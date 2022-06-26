<?php include "security.php"; include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- include sidebar section -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of include sidebar section -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- include topbar section -->
        <?php include_once('includes/topbar.php'); ?>
        <!-- End of include topbar section -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home</h1>
          </div>

          <h3>Persediaan Barang</h3>

          <!-- Content Row -->
          <div class="row">
            <?php
            if($_SESSION['role'] == 1 || $_SESSION['role'] == 5)
            {
            ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Produk</h4>
                    <ul class="list-group">
                      <a href="produk.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Inventory</h4>
                    <ul class="list-group">
                      <a href="inventory.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
            }
            ?>
          </div>


          <h3 class="mt-5">Penjualan</h3>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Sales Quotation</h4>
                    <ul class="list-group">
                      <a href="sales_quotation.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
              if($_SESSION['role'] == 1)
              {
            ?>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Perform Invoice</h4>
                    <ul class="list-group">
                      <a href="perform_invoice.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Invoice</h4>
                    <ul class="list-group">
                      <a href="invoice.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
            if($_SESSION['role'] == 5)
            {
            ?>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">DO Penjualan</h4>
                    <ul class="list-group">
                      <a href="delivery_order.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
             }
            ?>
          </div>

          <h3 class="mt-5">Pembelian</h3>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pembelian</h4>
                    <ul class="list-group">
                      <a href="pembelian.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
            if($_SESSION['role'] == 1)
            {
            ?>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Vendor</h4>
                    <ul class="list-group">
                      <a href="vendor.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
             }
            ?>
            <?php
            if($_SESSION['role'] == 5)
            {
            ?>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">DO Pembelian</h4>
                    <ul class="list-group">
                      <a href="delivery_order_pembelian.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <?php
             }
            ?>
          </div>

          <?php
            if($_SESSION['role'] == 1)
            {
          ?>
          <h3 class="mt-5">Laporan</h3>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Jurnal Umum</h4>
                    <ul class="list-group">
                      <a href="jurnal_umum_form.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Buku Besar</h4>
                    <ul class="list-group">
                      <a href="buku_besar_form.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Neraca Saldo</h4>
                    <ul class="list-group">
                      <a href="neraca_saldo_form.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Neraca Lajur</h4>
                    <ul class="list-group">
                      <a href="neraca_lajur_form.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Laporan Keuangan</h4>
                    <ul class="list-group">
                      <a href="laporan_keuangan_form.php" class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Lihat
                          <i class="fas fa-chevron-right text-"></i>
                        </li>
                      </a>
                    </ul>
                  </div>
                </div>
            </div>
          </div>
          <?php
          }
          ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white mt-5">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
