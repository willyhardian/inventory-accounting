<?php include "security.php"; ?>
<?php include "config.php";
  if(isset($_GET['invoice_id']))
  {
      $invoice_id = $_GET['invoice_id'];
  }
  else
  {
      $invoice_id = 0;
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

  <title>Invoice Status Pembayaran</title>

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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="sales_quotation.php">SQ</a></li>
              <li class="breadcrumb-item"><a href="perform_invoice.php">PI</a></li>
              <li class="breadcrumb-item"><a href="invoice.php">INV</a></li>
              <li class="breadcrumb-item active" aria-current="page">INV Status Bayar</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Invoice Status Pembayaran of INV<?php echo $invoice_id; ?></h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <a href="invoice_status_pembayaran_form.php?invoice_id=<?php echo $invoice_id; ?>&action=add" class="btn btn-info mb-3">ADD</a>
              <table class="table table-striped table-bordered table-first-column-small" id="table-show">
                <thead>
                  <tr>
                    <td>ID Status</td>
                    <td>Tanggal</td>
                    <td>Status</td>
                    <td>Pelanggan</td>
                    <td>Payment</td>
                    <td>Termin</td>
                    <td>Actions</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT invoice_status_pembayaran.id AS 'invoice_status_pembayaran_id', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', invoice_status_pembayaran.invoice_id AS 'invoice_status_pembayaran_invoice_id', pelanggan.nama AS 'pelanggan_nama', perform_invoice.down_payment AS 'down_payment_perform_invoice', perform_invoice.termin AS 'termin_perform_invoice' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.invoice_id = $invoice_id";
                  $result = mysqli_query($conn, $sql);
                  echo $conn->error;
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td><?php echo $row['invoice_status_pembayaran_id']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['invoice_status_pembayaran_tanggal'])); ?></td>
                        <td>
                          <?php
                            if($row['invoice_status_pembayaran_status'] == 'bayar')
                            {
                                echo "Bayar DP";
                            }
                            else
                            {
                              echo $row['invoice_status_pembayaran_status'];
                            }
                          ?>
                        </td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            if($row['down_payment_perform_invoice'] == 0)
                            {
                                echo "Cash";
                            }
                            else
                            {
                              echo "DP " . $row['down_payment_perform_invoice'] . "%";
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if($row['termin_perform_invoice'] == 0)
                            {
                                echo "-";
                            }
                            else
                            {
                                echo $row['termin_perform_invoice'] . " Hari";
                            }

                          ?>
                        </td>
                        <td>
                          <a href="invoice_status_pembayaran_form.php?id=<?php echo $row['invoice_status_pembayaran_id']; ?>&invoice_id=<?php echo $invoice_id; ?>&action=edit" class="mr-3"><i class="fas fa-edit"></i></a>
                          <a href="invoice_status_pembayaran_form.php?id=<?php echo $row['invoice_status_pembayaran_id']; ?>&invoice_id=<?php echo $invoice_id; ?>&action=delete"><i class="fas fa-trash"></i></a>
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
    } );

    </script>

</body>

</html>
