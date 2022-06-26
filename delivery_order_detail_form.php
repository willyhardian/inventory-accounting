<?php include "security.php"; ?>
<?php include "config.php"; ?>
<?php
  if(isset($_GET['delivery_order_id']))
  {
    $delivery_order_id = $_GET['delivery_order_id'];
  }
  else
  {
    $delivery_order_id = 0;
  }

  $sql_get_sq_id = "SELECT sales_quotation.id AS 'sales_quotation_id' FROM do
                    INNER JOIN invoice ON do.invoice_id = invoice.id
                    INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id
                    INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id
                    WHERE do.id = $delivery_order_id";
  $query_get_sq_id = mysqli_query($conn, $sql_get_sq_id);
  $row_get_sq_id = mysqli_fetch_array($query_get_sq_id);
  $sales_quotation_id = $row_get_sq_id['sales_quotation_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Delivery Order Penjualan Detail Form</title>

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
              <li class="breadcrumb-item"><a href="delivery_order.php">DO Penjualan</a></li>
              <li class="breadcrumb-item"><a href="delivery_order_detail.php?id=<?php echo "DO" . $delivery_order_id; ?>">DO Penjualan Detail</a></li>
              <li class="breadcrumb-item active" aria-current="page">DO Penjualan Detail Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Delivery Order Penjualan Detail</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $delivery_order_detail_produk_id = "";
                $delivery_order_detail_qty = "";
                $invoice_id = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT do_detail.produk_id AS 'delivery_order_detail_produk_id', do_detail.qty AS 'delivery_order_detail_qty', do_detail.invoice_id AS 'invoice_id' FROM do_detail INNER JOIN do ON do_detail.do_id = do.id INNER JOIN invoice ON do.invoice_id = invoice.id WHERE do_detail.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $delivery_order_detail_produk_id = $row['delivery_order_detail_produk_id'];
                    $delivery_order_detail_qty = $row['delivery_order_detail_qty'];
                    $invoice_id = $row['invoice_id'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT do_detail.produk_id AS 'delivery_order_detail_produk_id', do_detail.qty AS 'delivery_order_detail_qty', do_detail.invoice_id AS 'invoice_id' FROM do_detail INNER JOIN do ON do_detail.do_id = do.id INNER JOIN invoice ON do.invoice_id = invoice.id WHERE do_detail.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    echo $conn->error;
                    $delivery_order_detail_produk_id = $row['delivery_order_detail_produk_id'];
                    $delivery_order_detail_qty = $row['delivery_order_detail_qty'];
                    $invoice_id = $row['invoice_id'];
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

              <form method="POST" action="delivery_order_detail_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="delivery_order_id">ID DO</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">DO</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="delivery_order_id" name="delivery_order_id" value="<?php echo $delivery_order_id; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="produk_id">Produk</label>
                    <select id="produk_id" name="produk_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT
                          produk.id as 'id_produk',
                          concat_ws(' ',item.nama, jenis.nama, merek.nama, standard.nama, kategori.nama, warna.nama, concat('dia. ',produk.diameter), concat('@', produk.panjang, 'cm/', satuan.nama)) as produk_nama,
                          produk.harga AS 'produk_harga',
                          jenis.nama AS jenis,
                          warna.nama AS warna,
                          kategori.nama AS kategori,
                          produk.diameter,
                          produk.panjang,
                          merek.nama AS merek,
                          satuan.nama AS satuan_nama,
                          produk.gambar AS gambar
                        FROM produk
                        INNER JOIN sales_quotation_detail ON sales_quotation_detail.produk_id = produk.id
                        INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id
                        LEFT JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id 
                        LEFT JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id
                        LEFT JOIN item ON produk.item_id = item.id
                        LEFT JOIN jenis ON produk.jenis_id = jenis.id
                        LEFT JOIN standard ON standard.jenis_id = jenis.id
                        LEFT JOIN warna ON produk.warna_id = warna.id
                        LEFT JOIN kategori ON produk.kategori_id = kategori.id
                        LEFT JOIN satuan ON produk.satuan_id = satuan.id
                        LEFT JOIN merek ON produk.merek_id = merek.id
                        WHERE produk.status = 'aktif' AND sales_quotation.id = $sales_quotation_id";
                        $query = mysqli_query($conn, $sql);
                        ?>
                          <option value=""><?php echo $conn->error; ?></option>
                        <?php
                        while($row = mysqli_fetch_array($query))
                        {
                          $id_produk = $row['id_produk'];
                          $produk_nama = $row['produk_nama'];
                          $produk_harga = $row['produk_harga'];
                          if($delivery_order_detail_produk_id == $id_produk)
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>" selected><?php echo $produk_nama; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>"><?php echo $produk_nama; ?></option>
                            <?php
                          }
                        }
                      ?>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                      </script>


                      <script type="text/javascript">
                          $(document).ready(function() {
                            $('#produk_id').select2({
                              placeholder: "Pilih produk"
                            });
                          });
                      </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="delivery_order_qty">Qty</label>
                    <input type="text" class="form-control form-control-user" id="delivery_order_qty" name="qty" value="<?php echo $delivery_order_detail_qty; ?>" required <?php echo $readonly; ?>>
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
    $("#tanggal_dibuat").datepicker({ dateFormat: "yy-mm-dd" });
  });
  </script>

</body>

</html>
