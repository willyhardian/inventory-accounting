<?php include "security.php"; ?>
<?php include "config.php";
  if(isset($_GET['sales_quotation_id']))
  {
      $sales_quotation_id = $_GET['sales_quotation_id'];
  }
  else
  {
      $sales_quotation_id = 0;
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

  <title>Perform Invoice</title>

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
              <li class="breadcrumb-item active" aria-current="page">PI</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Perform Invoice</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-striped table-bordered table-first-column-small w-100" id="table-show">
                <thead>
                  <tr>
                    <td>No</td>
                    <td>ID PI</td>
                    <td>ID SQ</td>
                    <td>Tanggal</td>
                    <td>No PO Pelanggan</td>
                    <td>Nama Pelanggan</td>
                    <td>Payment</td>
                    <td>Termin</td>
                    <td>Updated At</td>
                    <td>Created At</td>
                    <td>More</td>
                    <td>Actions</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT perform_invoice.id AS 'perform_invoice_id', sales_quotation.id AS 'sales_quotation_id', perform_invoice.tanggal AS 'perform_invoice_tanggal', purchase_order_pelanggan.no_po_pelanggan AS 'purchase_order_pelanggan_no_po_pelanggan',
                  perform_invoice.termin AS 'perform_invoice_termin', perform_invoice.down_payment AS 'perform_invoice_down_payment', perform_invoice.updated_at AS 'perform_invoice_updated_at', perform_invoice.created_at AS 'perform_invoice_created_at', pelanggan.nama AS 'pelanggan_nama', pelanggan_info.nama_org AS 'pelanggan_info_nama_org', pelanggan.pelanggan_info_id AS 'pelanggan_info_id_pelanggan' FROM perform_invoice INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN purchase_order_pelanggan ON perform_invoice.purchase_order_pelanggan_id = purchase_order_pelanggan.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id";
                  $result = mysqli_query($conn, $sql);
                  $no = 0;
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      $no += 1;
                      $pelanggan_info_id_pelanggan = $row['pelanggan_info_id_pelanggan'];
                      $pelanggan_info_nama_org = $row['pelanggan_info_nama_org'];
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo "PI" . $row['perform_invoice_id']; ?></td>
                        <td><?php echo "SQ" . $row['sales_quotation_id']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['perform_invoice_tanggal'])); ?></td>
                        <td>
                          <?php
                            if($row['purchase_order_pelanggan_no_po_pelanggan'] == "")
                            {
                              echo "-";
                            }
                            else
                            {
                              echo $row['purchase_order_pelanggan_no_po_pelanggan'];
                            }
                          ?>
                        </td>
                        <?php
                        if($pelanggan_info_id_pelanggan == "")
                        {
                          $pelanggan_info_nama_org_result = "";
                        }
                        else
                        {
                          $pelanggan_info_nama_org_result = " (" . $pelanggan_info_nama_org . ")";
                        }
                        ?>
                        <td><?php echo $row['pelanggan_nama'] . $pelanggan_info_nama_org_result; ?></td>
                        <td>
                          <?php
                            if($row['perform_invoice_down_payment'] == 0)
                            {
                                echo "Cash";
                            }
                            else
                            {
                              echo "DP " . $row['perform_invoice_down_payment'] . "%";
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if($row['perform_invoice_termin'] == 0)
                            {
                                echo "-";
                            }
                            else
                            {
                                echo $row['perform_invoice_termin'] . " Hari";
                            }

                          ?>
                        </td>
                        <td>
                          <?php
                            if($row['perform_invoice_updated_at'] == 0)
                            {
                              echo "-";
                            }
                            else
                            {
                              echo date("d/m/Y | h:i A", strtotime($row['perform_invoice_updated_at']));
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if($row['perform_invoice_created_at'] == 0)
                            {
                              echo "-";
                            }
                            else
                            {
                              echo date("d/m/Y | h:i A", strtotime($row['perform_invoice_created_at']));
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if($_SESSION['role'] == 1 || $_SESSION['role'] == 4 || $_SESSION['role'] == 2)
                            {
                              $perform_invoice_id = $row['perform_invoice_id'];
                              $sql2 = "SELECT invoice.id as 'invoice_id', perform_invoice.id as 'perform_invoice_id' from perform_invoice INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id WHERE invoice.perform_invoice_id = $perform_invoice_id";
                              $result2 = mysqli_query($conn, $sql2);
                              if (mysqli_num_rows($result2) < 1)
                              {
                                
                                ?>
                                  <a href="invoice_form.php?perform_invoice_id=<?php echo $row['perform_invoice_id']; ?>&action=add" class="btn btn-success btn-sm">INV</a>
                                <?php 
                              }
                              else
                              {
                                $row2 = mysqli_fetch_array($result2);
                                ?>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="INV <?php echo $row2['invoice_id']; ?>" disabled>INV</a>
                                <?php
                              }
                            }
                            else
                            {
                              echo "-";
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                          if($_SESSION['role'] == 1 || $_SESSION['role'] == 4 || $_SESSION['role'] == 2)
                          {
                          ?>
                            <!--<a href="perform_invoice_laporan.php?sales_quotation_id=<?php //echo $row['sales_quotation_id']; ?>" class="mr-3"><i class="fas fa-print"></i></a>-->
                            <a href="perform_invoice_form.php?sales_quotation_id=<?php echo $row['sales_quotation_id']; ?>&id=<?php echo $row['perform_invoice_id']; ?>&action=edit" class="mr-3"><i class="fas fa-edit"></i></a>
                            <a href="perform_invoice_form.php?sales_quotation_id=<?php echo $row['sales_quotation_id']; ?>&id=<?php echo $row['perform_invoice_id']; ?>&action=delete"><i class="fas fa-trash"></i></a>
                          <?php
                          }
                          else
                          {
                            echo "-";
                          }
                          ?>
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
