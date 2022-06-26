<?php include "security.php"; ?>
<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Permintaan Pembelian</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/style-custom.css">

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
            <h1 class="h3 mb-0 text-gray-800">Permintaan Pembelian</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <a href="permintaan_pembelian_form.php?action=add" class="btn btn-info mb-3">ADD</a>
              <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                  <a class="nav-link active" href="permintaan_pembelian.php">Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="permintaan_pembelian_disetujui.php">Disetujui</a>
                </li>
              </ul>
              <table class="table table-striped table-bordered table-first-column-small" id="table-show">
                <thead>
                  <tr>
                    <td>ID</td>
                    <td>ID INV</td>
                    <td>Tanggal</td>
                    <td>ID Produk</td>
                    <td>Nama Produk</td>
                    <td>Qty</td>
                    <td>More</td>
                    <td>Actions</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT permintaan_pembelian.id AS 'permintaan_pembelian_id', permintaan_pembelian.invoice_id AS 'invoice_id', permintaan_pembelian.tanggal AS 'permintaan_pembelian_tanggal', permintaan_pembelian.produk_id AS 'permintaan_pembelian_produk_id', produk.nama AS 'produk_nama', permintaan_pembelian.qty AS 'permintaan_pembelian_qty' FROM permintaan_pembelian INNER JOIN produk ON permintaan_pembelian.produk_id = produk.id WHERE permintaan_pembelian.status = 'aktif'";
                  $result = mysqli_query($conn, $sql);
                  echo $conn->error;
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td><?php echo $row['permintaan_pembelian_id']; ?></td>
                        <td><?php echo $row['invoice_id']; ?></td>
                        <td><?php echo $row['permintaan_pembelian_tanggal']; ?></td>
                        <td><?php echo $row['permintaan_pembelian_produk_id']; ?></td>
                        <td><?php echo $row['produk_nama']; ?></td>
                        <td><?php echo $row['permintaan_pembelian_qty']; ?></td>
                        <td>
                          <a href="permintaan_pembelian_process.php?id=<?php echo $row['permintaan_pembelian_id']; ?>&action=disetujui" class="btn btn-outline-info btn-sm mr-2"><i class="fas fa-check-circle"></i></a>
                          <a href="#" class="btn btn-outline-info btn-sm">Beli</a>
                        <td>
                          <a href="permintaan_pembelian_laporan.php?id=<?php echo $row['permintaan_pembelian_id']; ?>" class="mr-3"><i class="fas fa-print"></i></a>
                          <a href="permintaan_pembelian_form.php?id=<?php echo $row['permintaan_pembelian_id']; ?>&action=edit" class="mr-3"><i class="fas fa-edit"></i></a>
                          <a href="permintaan_pembelian_form.php?id=<?php echo $row['permintaan_pembelian_id']; ?>&action=delete"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
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
          <a class="btn btn-primary" href="login.html">Logout</a>
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
    <!--   Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table-show').DataTable({
            responsive: true
        });
        $('[data-toggle="tooltip"]').tooltip();
    } );

    </script>

</body>

</html>
