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

  <title>Delivery Order Form</title>

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
            <h1 class="h3 mb-0 text-gray-800">Delivery Order Form</h1>
          </div>
          <!--<a href="laporan_keuangan.php" class="text-decoration-none text-secondary"><i class="fas fa-chevron-circle-left mb-3" style="font-size: 25px;"></i></a>-->
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_jenis = "";
                $nama_jenis = "";
                $keterangan_jenis = "";
                $readonly = "";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM jenis WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_jenis = $row['id'];
                    $nama_jenis = $row['nama'];
                    $keterangan_jenis = $row['keterangan'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM jenis WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_jenis = $row['id'];
                    $nama_jenis = $row['nama'];
                    $keterangan_jenis = $row['keterangan'];
                    $readonly = "readonly";
                  }
                  else
                  {
                    $btn = "Submit";
                    $btn_class_bootstrap = "btn-primary";
                  }
                }

                $id = $_GET['invoice_id'];
                $sql = "SELECT pelanggan.nama AS 'pelanggan_nama', pelanggan.phone AS 'pelanggan_phone', pelanggan_info.alamat AS 'pelanggan_info_alamat' FROM invoice INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id LEFT JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id WHERE invoice.id = $id";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($query);
              ?>
              <form method="POST" action="pembelian_detail_selesai_laporan_process.php">
                <div class="form-group">
                    <label for="invoice_id">ID Invoice</label>
                    <input type="text" class="form-control form-control-user" id="invoice_id" name="invoice_id" value="<?php echo $_GET['invoice_id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal_dibuat">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal_dibuat" name="tanggal_dibuat" required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <select class="form-control form-control-user" id="keterangan" name="keterangan" required>
                      <option value="dikirim">Dikirim</option>
                      <option value="dikirim">Diambil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="penerima">Nama Penerima</label>
                    <input type="text" class="form-control form-control-user" id="penerima" name="penerima" value="<?php echo $row['pelanggan_nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="penerima_hp">No HP Penerima</label>
                    <input type="text" class="form-control form-control-user" id="penerima_hp" name="penerima_hp" value="<?php echo $row['pelanggan_phone']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="tujuan">Tujuan</label>
                  <textarea class="form-control form-control-user" id="tujuan" name="tujuan" required><?php echo $row['pelanggan_info_alamat']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Disiapkan Oleh</label>
                    <input type="text" class="form-control form-control-user" id="disiapkan_oleh" name="disiapkan_oleh" required>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Disetujui Oleh</label>
                    <input type="text" class="form-control form-control-user" id="disetujui_oleh" name="disetujui_oleh" required>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Dikirim Oleh</label>
                    <input type="text" class="form-control form-control-user" id="dikirim_oleh" name="dikirim_oleh" required>
                </div>
                <div class="form-group">
                  <input type="submit" value="Submit" class="btn btn-user btn-block btn-primary">
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
    $("#tanggal_dibuat").datepicker({ dateFormat: "yy-mm-dd" });
  });
  </script>
</body>

</html>
