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

  <title>Delivery Order Penjualan Form</title>

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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="sales_quotation.php">SQ</a></li>
              <li class="breadcrumb-item"><a href="perform_invoice.php">PI</a></li>
              <li class="breadcrumb-item"><a href="invoice.php">INV</a></li>
              <li class="breadcrumb-item"><a href="delivery_order.php">DO</a></li>
              <li class="breadcrumb-item active" aria-current="page">DO Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Delivery Order Penjualan</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $invoice_id = $_GET['invoice_id'];

                $btn = "";
                $btn_class_bootstrap = "";
                $id_delivery_order = "";
                $tanggal = "";
                $penerima = "";
                $penerima_hp = "";
                $tujuan = "";
                $keterangan = "";
                $catatan = "";
                $disiapkan_oleh = "";
                $disetujui_oleh = "";
                $dikirim_oleh = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    /*$sql = "SELECT pelanggan.nama AS 'pelanggan_nama', pelanggan.phone AS 'pelanggan_phone', pelanggan_info.alamat AS 'pelanggan_info_alamat' FROM invoice INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id LEFT JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id WHERE invoice.id = $id";
                    */
                    $sql = "SELECT do.tanggal AS 'do_tanggal', do.penerima AS 'do_penerima', do.penerima_hp AS 'do_penerima_hp', do.tujuan AS 'do_tujuan', do.keterangan AS 'do_keterangan', do.catatan AS 'do_catatan', do.disiapkan_oleh AS 'do_disiapkan_oleh', do.disetujui_oleh AS 'do_disetujui_oleh', do.disiapkan_oleh AS 'do_disiapkan_oleh', do.dikirim_oleh AS 'do_dikirim_oleh', pelanggan.nama AS 'pelanggan_nama', pelanggan.phone AS 'pelanggan_phone', pelanggan_info.alamat AS 'pelanggan_info_alamat' FROM do INNER JOIN invoice ON do.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id LEFT JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id WHERE invoice.id = $invoice_id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    echo $conn->error;
                    $tanggal = $row['do_tanggal'];
                    $penerima = $row['do_penerima'];
                    $penerima_hp = $row['do_penerima_hp'];
                    $tujuan = $row['do_tujuan'];
                    $keterangan = $row['do_keterangan'];
                    $catatan = $row['do_catatan'];
                    $disiapkan_oleh = $row['do_disiapkan_oleh'];
                    $disetujui_oleh = $row['do_disetujui_oleh'];
                    $dikirim_oleh = $row['do_dikirim_oleh'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT do.tanggal AS 'do_tanggal', do.penerima AS 'do_penerima', do.penerima_hp AS 'do_penerima_hp', do.tujuan AS 'do_tujuan', do.keterangan AS 'do_keterangan', do.catatan AS 'do_catatan', do.disiapkan_oleh AS 'do_disiapkan_oleh', do.disetujui_oleh AS 'do_disetujui_oleh', do.disiapkan_oleh AS 'do_disiapkan_oleh', do.dikirim_oleh AS 'do_dikirim_oleh', pelanggan.nama AS 'pelanggan_nama', pelanggan.phone AS 'pelanggan_phone', pelanggan_info.alamat AS 'pelanggan_info_alamat' FROM do INNER JOIN invoice ON do.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id LEFT JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id WHERE invoice.id = $invoice_id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $tanggal = $row['do_tanggal'];
                    $penerima = $row['do_penerima'];
                    $penerima_hp = $row['do_penerima_hp'];
                    $tujuan = $row['do_tujuan'];
                    $keterangan = $row['do_keterangan'];
                    $catatan = $row['do_catatan'];
                    $disiapkan_oleh = $row['do_disiapkan_oleh'];
                    $disetujui_oleh = $row['do_disetujui_oleh'];
                    $dikirim_oleh = $row['do_dikirim_oleh'];
                    $readonly = "readonly";
                    $pointer_events = "none";
                  }
                  else
                  {
                    $btn = "Submit";
                    $btn_class_bootstrap = "btn-primary";
                  }
                }
              ?>

              <form method="POST" action="delivery_order_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="invoice_id">ID Invoice</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">INV</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="invoice_id" name="invoice_id" value="<?php echo $_GET['invoice_id']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_dibuat">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal_dibuat" name="tanggal_dibuat" value="<?php echo $tanggal; ?>" autocomplete="off" required <?php echo $readonly; ?>>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <?php
                        if($keterangan == "dikirim")
                        {
                          ?>
                            <option value="dikirim" selected>Dikirim</option>
                            <option value="diambil">Diambil</option>
                          <?php
                        }
                        else if($keterangan == "diambil")
                        {
                          ?>
                            <option value="dikirim">Dikirim</option>
                            <option value="diambil" selected>Diambil</option>
                          <?php
                        }
                        else
                        {
                          ?>
                            <option value="dikirim" selected>Dikirim</option>
                            <option value="diambil">Diambil</option>
                          <?php
                        }

                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="penerima">Nama Penerima</label>
                    <input type="text" class="form-control form-control-user" id="penerima" name="penerima" value="<?php echo $penerima; ?>" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="penerima_hp">No HP Penerima</label>
                    <input type="text" class="form-control form-control-user" id="penerima_hp" name="penerima_hp" value="<?php echo $penerima_hp; ?>" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                  <label for="tujuan">Tujuan</label>
                  <textarea class="form-control form-control-user" id="tujuan" name="tujuan" required <?php echo $readonly; ?>><?php echo $tujuan; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="catatan">Catatan</label>
                  <textarea class="form-control form-control-user" id="catatan" name="catatan" <?php echo $readonly; ?>><?php echo $catatan; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Disiapkan Oleh</label>
                    <input type="text" class="form-control form-control-user" id="disiapkan_oleh" name="disiapkan_oleh" value="<?php echo $disiapkan_oleh; ?>" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Disetujui Oleh</label>
                    <input type="text" class="form-control form-control-user" id="disetujui_oleh" name="disetujui_oleh" value="<?php echo $disetujui_oleh; ?>" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="disiapkan_oleh">Dikirim Oleh</label>
                    <input type="text" class="form-control form-control-user" id="dikirim_oleh" name="dikirim_oleh" value="<?php echo $dikirim_oleh; ?>" required <?php echo $readonly; ?>>
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
    $("#tanggal_dibuat").datepicker({ dateFormat: "yy-mm-dd" });
  });
  </script>

</body>

</html>
