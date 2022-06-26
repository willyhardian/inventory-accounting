<?php include "security.php"; ?>
<?php include "config.php";
  if(isset($_GET['perform_invoice_id']))
  {
      $perform_invoice_id = $_GET['perform_invoice_id'];
  }
  else
  {
      $perform_invoice_id = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Invoice</title>

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
              <li class="breadcrumb-item active" aria-current="page">INV Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Invoice</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_invoice = "";
                $id_perform_invoice = "";
                $id_sales_quotation = "";
                $tanggal_invoice = "";
                $purchase_order_pelanggan_id = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', invoice.tanggal AS 'tanggal_invoice', invoice.perform_invoice_id AS 'perform_invoice_id_invoice', invoice.status AS 'status_invoice' FROM invoice INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id WHERE invoice.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_invoice = $row['id_invoice'];
                    $perform_invoice_id_invoice = $row['perform_invoice_id_invoice'];
                    $tanggal_invoice = $row['tanggal_invoice'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', invoice.tanggal AS 'tanggal_invoice', invoice.perform_invoice_id AS 'perform_invoice_id_invoice', invoice.status AS 'status_invoice' FROM invoice INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id WHERE invoice.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_invoice = $row['id_invoice'];
                    $perform_invoice_id_invoice = $row['perform_invoice_id_invoice'];
                    $tanggal_invoice = $row['tanggal_invoice'];
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

              <form method="POST" action="invoice_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="sales_quotation_id">ID Perform Invoice</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">PI</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="perform_invoice_id" name="perform_invoice_id" value="<?php echo $perform_invoice_id; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $tanggal_invoice; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <!--
                // Invoice ON Going or Done

                <div class="form-group">
                  <label for="gambar">Status</label>
                  <select id="status" name="status" class="form-control" required <?php //echo $readonly; ?> style="pointer-events: <?php //echo $pointer_events; ?>">
                    <?php
                    /*
                      if($status_produk == "aktif")
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="lunas">Lunas</option>
                        <?php
                      }
                      else if($status_produk == "lunas")
                      {
                        ?>
                          <option value="aktif">Aktif</option>
                          <option value="lunas" selected>Lunas</option>
                        <?php
                      }
                      else
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="lunas">Lunas</option>
                        <?php
                      }
                      */
                    ?>
                  </select>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                  <script type="text/javascript">
                    /*
                      $(document).ready(function(){
                        $('#status').select2({
                          placeholder: "Pilih Status"
                        });
                     });
                    */
                  </script>
                </div>
                // End of Invoice ON Going or Done
                -->
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
    down_payment_change();
  });

  var termin_choice;
  var down_payment_choice;
  function down_payment_change()
  {
    down_payment_choice = document.getElementById("down_payment_choice").value;
    if(down_payment_choice == "NULL")
    {
      down_payment_choice = "";
      document.getElementById("termin").value = "";
      document.getElementById("termin_choice").style.display = "none";
      document.getElementById("down_payment").style.display = "none";
      document.getElementById("termin").style.display = "none";
    }
    else if(down_payment_choice == "other")
    {
      down_payment_choice = "";
      document.getElementById("down_payment").value = down_payment_choice;
      document.getElementById("down_payment").style.display = "block";
      document.getElementById("termin_choice").style.display = "block";
      if(document.getElementById("termin_choice").value == "other")
      {
        document.getElementById("termin").style.display = "block";
      }
      else
      {
        document.getElementById("termin").style.display = "none";
      }
    }
    else
    {
      document.getElementById("down_payment").style.display = "none";
      document.getElementById("termin_choice").style.display = "block";
      document.getElementById("down_payment").value = down_payment_choice;
      if(document.getElementById("termin_choice").value == "other")
      {
        document.getElementById("termin").style.display = "block";
      }
      else
      {
        document.getElementById("termin").style.display = "none";
      }
    }
  }
  function termin_choice_change()
  {
    termin_choice = document.getElementById("termin_choice").value;
    if(termin_choice == "other")
    {
      termin_choice = "";
      document.getElementById("termin").value = termin_choice;
      document.getElementById("termin").style.display = "block";
    }
    else
    {
      document.getElementById("termin").style.display = "none";
      document.getElementById("termin").value = termin_choice;
    }
  }
  </script>
</body>

</html>
