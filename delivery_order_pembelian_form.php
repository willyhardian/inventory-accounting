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

  <title>Delivery Order Pembelian Form</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- Custom styles for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once('includes/topbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="pembelian.php">Pembelian</a></li>
              <li class="breadcrumb-item"><a href="delivery_order_pembelian.php">DO Pembelian</a></li>
              <li class="breadcrumb-item active" aria-current="page">DO Pembelian Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Delivery Order Pembelian Form</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_no_do_pembelian = "";
                $no_do_pembelian = "";
                $pembelian_id = "";
                $vendor_nama = "";
                $tanggal_do_pembelian = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT do_pembelian.id as 'id', do_pembelian.no_do_pembelian AS 'no_do_pembelian', pembelian.id as 'pembelian_id', do_pembelian.tanggal as 'tanggal', vendor.nama AS 'vendor_nama' FROM do_pembelian INNER JOIN pembelian ON do_pembelian.pembelian_id = pembelian.id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE do_pembelian.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_no_do_pembelian = $row['id'];
                    $no_do_pembelian = $row['no_do_pembelian'];
                    $pembelian_id = $row['pembelian_id'];
                    $vendor_nama = $row['vendor_nama'];
                    $tanggal_do_pembelian = $row['tanggal'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT do_pembelian.id as 'id', do_pembelian.no_do_pembelian AS 'no_do_pembelian', pembelian.id as 'pembelian_id', do_pembelian.tanggal as 'tanggal', vendor.nama AS 'vendor_nama' FROM do_pembelian INNER JOIN pembelian ON do_pembelian.pembelian_id = pembelian.id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE do_pembelian.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_no_do_pembelian = $row['id'];
                    $no_do_pembelian = $row['no_do_pembelian'];
                    $pembelian_id = $row['pembelian_id'];
                    $vendor_nama = $row['vendor_nama'];
                    $tanggal_do_pembelian = $row['tanggal'];
                    $readonly = "readonly";
                    $pointer_events = "none";
                  }
                  else
                  {
                    if(isset($_GET['pembelian_id']))
                    {
                        $id = $_GET['pembelian_id'];
                        $sql = "SELECT pembelian.id as 'pembelian_id', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.id = $id";
                        $query = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($query);
                        echo $conn->error;
                        $pembelian_id = $row['pembelian_id'];
                        $vendor_nama = $row['vendor_nama'];
                    }
                    else
                    {
                      header("location: pembelian.php");
                    }
                    $btn = "Submit";
                    $btn_class_bootstrap = "btn-primary";
                  }
                }
              ?>

              <form method="POST" enctype="multipart/form-data" action="delivery_order_pembelian_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="pembelian_id">ID Pembelian</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">PB</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="pembelian_id" name="pembelian_id" value="<?php echo $pembelian_id; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vendor_nama">Nama Vendor</label>
                    <input type="text" class="form-control form-control-user" id="vendor_nama" value="<?php echo $vendor_nama; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_do_pembelian">No DO Pembelian</label>
                    <input type="text" class="form-control form-control-user" id="no_do_pembelian" name="no_do_pembelian" value="<?php echo $no_do_pembelian; ?>" <?php echo $readonly; ?> placeholder="Cth: TWS/014/PO/V/2020">
                </div>
                <div class="form-group">
                    <label for="nama">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $tanggal_do_pembelian; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" <?php echo $readonly; ?>  style="pointer-events: <?php echo $pointer_events; ?>">
                </div>
                <div class="form-group">
                  <input type="submit" value="<?php echo $btn; ?>" class="btn btn-user btn-block <?php echo $btn_class_bootstrap; ?>">
                </div>
              </form>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(document).ready(function () {
    $("#tanggal").datepicker({ dateFormat: "yy-mm-dd" });
  });
  </script>
</body>

</html>
