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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
            <h1 class="h3 mb-0 text-gray-800">Permintaan Pembelian</h1>
          </div>
          <a href="permintaan_pembelian.php" class="text-decoration-none text-secondary"><i class="fas fa-chevron-circle-left mb-3" style="font-size: 25px;"></i></a>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_permintaan_pembelian = "";
                $id_invoice = "";
                $tanggal_permintaan_pembelian = "";
                $produk_id_permintaan_pembelian = "";
                $nama_produk = "";
                $qty_permintaan_pembelian = "";
                $status_permintaan_pembelian = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT permintaan_pembelian.id AS 'id_permintaan_pembelian', permintaan_pembelian.invoice_id AS 'invoice_id', permintaan_pembelian.tanggal AS 'tanggal_permintaan_pembelian', permintaan_pembelian.produk_id AS 'produk_id', produk.nama AS 'nama_produk', permintaan_pembelian.qty AS 'qty_permintaan_pembelian', permintaan_pembelian.status AS 'status_permintaan_pembelian' FROM permintaan_pembelian INNER JOIN produk ON permintaan_pembelian.produk_id = produk.id WHERE permintaan_pembelian.id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_permintaan_pembelian = $row['id_permintaan_pembelian'];
                    $invoice_id = $row['invoice_id'];
                    $tanggal_permintaan_pembelian = $row['tanggal_permintaan_pembelian'];
                    $produk_id = $row['produk_id'];
                    $nama_produk = $row['nama_produk'];
                    $qty_permintaan_pembelian = $row['qty_permintaan_pembelian'];
                    $status_permintaan_pembelian = $row['status_permintaan_pembelian'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT permintaan_pembelian.id AS 'id_permintaan_pembelian', permintaan_pembelian.invoice_id AS 'invoice_id', permintaan_pembelian.tanggal AS 'tanggal_permintaan_pembelian', permintaan_pembelian.produk_id AS 'produk_id', produk.nama AS 'nama_produk', permintaan_pembelian.qty AS 'qty_permintaan_pembelian', permintaan_pembelian.status AS 'status_permintaan_pembelian' FROM permintaan_pembelian INNER JOIN produk ON permintaan_pembelian.produk_id = produk.id WHERE permintaan_pembelian.id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_permintaan_pembelian = $row['id_permintaan_pembelian'];
                    $invoice_id = $row['invoice_id'];
                    $tanggal_permintaan_pembelian = $row['tanggal_permintaan_pembelian'];
                    $produk_id = $row['produk_id'];
                    $nama_produk = $row['nama_produk'];
                    $qty_permintaan_pembelian = $row['qty_permintaan_pembelian'];
                    $status_permintaan_pembelian = $row['status_permintaan_pembelian'];
                    $readonly = "readonly";
                    $pointer_events = "none";
                  }
                  else
                  {
                    $btn = "Submit";
                    $btn_class_bootstrap = "btn-primary";
                    #$sql = "SELECT standard.jenis_id as 'jenis_id', jenis.nama as 'nama_jenis' FROM standard LEFT JOIN jenis ON standard.jenis_id = jenis.id";
                  }
                }
              ?>

              <form method="POST" action="permintaan_pembelian_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_permintaan_pembelian; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="invoice_id">Invoice</label>
                    <select id="invoice_id" name="invoice_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT id as 'id_invoice' FROM invoice";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $id_invoice = $row['id_invoice'];
                          if($invoice_id == $id_invoice)
                          {
                            ?>
                            <option value="<?php echo $id_invoice; ?>" selected><?php echo $id_invoice; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_invoice; ?>"><?php echo $id_invoice; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" value="<?php echo $tanggal_permintaan_pembelian; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>

                <div class="form-group">
                    <label for="produk_id">Produk</label>
                    <select id="produk_id" name="produk_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT nama as 'nama_produk', id as 'id_produk' FROM produk WHERE status = 'aktif'";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_produk = $row['nama_produk'];
                          $id_produk = $row['id_produk'];
                          if($produk_id == $id_produk)
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>" selected><?php echo $id_produk; ?> - <?php echo $nama_produk; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>"><?php echo $id_produk; ?> - <?php echo $nama_produk; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-user" id="qty" name="qty" value="<?php echo $qty_permintaan_pembelian; ?>" min="0" <?php echo $readonly; ?>>
                    </div>
                </div>
                <div class="form-group">
                  <label for="gambar">Status</label>
                  <select id="status" name="status" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                    <?php
                      if($status_produk == "aktif")
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="disetujui">Disetujui</option>
                        <?php
                      }
                      else if($status_produk == "arsip")
                      {
                        ?>
                          <option value="aktif">Aktif</option>
                          <option value="disetujui" selected>Disetujui</option>
                        <?php
                      }
                      else
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="disetujui">Disetujui</option>
                        <?php
                      }

                    ?>
                  </select>
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
