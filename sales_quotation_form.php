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

  <title>Sales Quotation</title>

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
              <li class="breadcrumb-item"><a href="sales_quotation.php">Sales Quotation</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sales Quotation Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales Quotation</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_sales_quotation = "";
                $tanggal_sales_quotation = "";
                $pajak_sales_quotation = "";
                $ongkir_sales_quotation = "";
                $nama_pelanggan = "";
                $pelanggan_id = "";
                $lokasi_id = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT sales_quotation.id AS 'id_sales_quotation', sales_quotation.tanggal AS 'tanggal_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', sales_quotation.ongkir AS 'ongkir_sales_quotation', pelanggan.id AS 'pelanggan_id', pelanggan.nama AS 'nama_pelanggan', sales_quotation.lokasi_id AS 'lokasi_id' FROM sales_quotation INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE sales_quotation.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_sales_quotation = $row['id_sales_quotation'];
                    $tanggal_sales_quotation = $row['tanggal_sales_quotation'];
                    $pajak_sales_quotation = $row['pajak_sales_quotation'];
                    $ongkir_sales_quotation = $row['ongkir_sales_quotation'];
                    $nama_pelanggan = $row['nama_pelanggan'];
                    $pelanggan_id = $row['pelanggan_id'];
                    $lokasi_id = $row['lokasi_id'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT sales_quotation.id AS 'id_sales_quotation', sales_quotation.tanggal AS 'tanggal_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', sales_quotation.ongkir AS 'ongkir_sales_quotation', pelanggan.id AS 'pelanggan_id', pelanggan.nama AS 'nama_pelanggan', sales_quotation.lokasi_id AS 'lokasi_id' FROM sales_quotation INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE sales_quotation.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_sales_quotation = $row['id_sales_quotation'];
                    $tanggal_sales_quotation = $row['tanggal_sales_quotation'];
                    $pajak_sales_quotation = $row['pajak_sales_quotation'];
                    $ongkir_sales_quotation = $row['ongkir_sales_quotation'];
                    $nama_pelanggan = $row['nama_pelanggan'];
                    $pelanggan_id = $row['pelanggan_id'];
                    $lokasi_id = $row['lokasi_id'];
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

              <form method="POST" action="sales_quotation_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_sales_quotation; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="nama">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $tanggal_sales_quotation; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="pelanggan_id">Pelanggan</label>
                    <select id="pelanggan_id" name="pelanggan_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT pelanggan.nama as 'nama_pelanggan', pelanggan.id as 'id_pelanggan', pelanggan.pelanggan_info_id AS 'pelanggan_info_id_pelanggan', pelanggan_info.nama_org AS 'pelanggan_info_nama_org' FROM pelanggan LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_pelanggan = $row['nama_pelanggan'];
                          $id_pelanggan = $row['id_pelanggan'];
                          $pelanggan_info_id_pelanggan = $row['pelanggan_info_id_pelanggan'];
                          $pelanggan_info_nama_org = $row['pelanggan_info_nama_org'];
                          if($pelanggan_info_id_pelanggan == "")
                          {
                            $pelanggan_info_nama_org_result = "";
                          }
                          else
                          {
                            $pelanggan_info_nama_org_result = " (" . $pelanggan_info_nama_org . ")";
                          }
                          if($pelanggan_id == $id_pelanggan)
                          {
                            ?>
                            <option value="<?php echo $id_pelanggan; ?>" selected><?php echo $id_pelanggan . "-" . $nama_pelanggan . $pelanggan_info_nama_org_result; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_pelanggan; ?>"><?php echo $id_pelanggan . "-" . $nama_pelanggan .  $pelanggan_info_nama_org_result; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                      </script>

                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#pelanggan_id').select2({
                        placeholder: "Pilih Pelanggan"
                      });
                         });
                        </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pajak">Pajak</label>
                    <div class="input-group mb-3">
                      <input type="any" class="form-control form-control-user" id="pajak" name="pajak" value="<?php echo $pajak_sales_quotation; ?>" min="0" <?php echo $readonly; ?>>
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lokasi_id">Lokasi</label>
                    <select id="lokasi_id" name="lokasi_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT nama as 'nama_lokasi', id as 'id_lokasi' FROM lokasi";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_lokasi = $row['nama_lokasi'];
                          $id_lokasi = $row['id_lokasi'];
                          if($lokasi_id == $id_lokasi)
                          {
                            ?>
                            <option value="<?php echo $id_lokasi; ?>" selected><?php echo $id_lokasi; ?> - <?php echo $nama_lokasi; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_lokasi; ?>"><?php echo $id_lokasi; ?> - <?php echo $nama_lokasi; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                      </script>

                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#lokasi_id').select2({
                        placeholder: "Pilih Lokasi"
                      });
                         });
                        </script>
                    </select>
                </div>
                <!--<div class="form-group">
                    <label for="ongkir">Ongkir</label>
                    <input type="any" class="form-control form-control-user" id="ongkir" name="ongkir" value="<?php //echo $ongkir_sales_quotation; ?>" min="0" <?php //echo $readonly; ?>>
                </div>-->
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
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
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
