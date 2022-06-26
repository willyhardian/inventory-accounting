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
              <li class="breadcrumb-item active" aria-current="page">Sales Quotation</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales Quotation</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <?php
                if($_SESSION['role'] == 1)
                {
              ?>
                <a href="sales_quotation_form.php?action=add" class="btn btn-info mb-3">ADD</a>
              <?php
                }
              ?>
              <table class="table table-striped table-bordered table-first-column-small" id="table-show">
                <thead>
                  <tr>
                    <td>No</td>
                    <td>ID</td>
                    <td>Tanggal</td>
                    <td>Nama Pelanggan</td>
                    <td>Pajak</td>
                    <td>Lokasi</td>
                    <!--<td>Ongkir</td>-->
                    <!--<td>Created By</td>-->
                    <td>Updated At</td>
                    <td>Created At</td>
                    <td>More</td>
                    <?php
                      if($_SESSION['role'] == 1)
                      {
                    ?>
                    <td>Actions</td>
                    <?php
                      }
                    ?>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT sales_quotation.id AS 'sales_quotation_id', sales_quotation.tanggal AS 'sales_quotation_tanggal', sales_quotation.pajak AS 'sales_quotation_pajak', sales_quotation.ongkir AS 'sales_quotation_ongkir', users.nama AS 'users_nama', sales_quotation.updated_at AS 'sales_quotation_updated_at', sales_quotation.created_at AS 'sales_quotation_created_at', pelanggan.nama AS 'pelanggan_nama', pelanggan.pelanggan_info_id AS 'pelanggan_info_id_pelanggan', pelanggan_info.nama_org AS 'pelanggan_info_nama_org', lokasi.nama AS 'lokasi_nama' FROM sales_quotation LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id LEFT JOIN users ON sales_quotation.user_id = users.id LEFT JOIN lokasi ON sales_quotation.lokasi_id = lokasi.id";

                  $result = mysqli_query($conn, $sql);
                  echo $conn->error;
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
                        <td><?php echo "SQ" . $row['sales_quotation_id']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['sales_quotation_tanggal'])); ?></td>
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
                        <td><?php echo $row['sales_quotation_pajak']; ?>%</td>
                        <td><?php echo $row['lokasi_nama']; ?></td>
                        <!--<td><?php //echo $row['sales_quotation_ongkir']; ?></td>-->
                        <!--<td><?php //echo $row['users_nama']; ?></td>-->
                        <td>
                          <?php
                            if($row['sales_quotation_updated_at'] == 0)
                            {
                              echo "-";
                            }
                            else
                            {
                              echo date("d/m/Y | h:i A", strtotime($row['sales_quotation_updated_at']));
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if($row['sales_quotation_created_at'] == 0)
                            {
                              echo "-";
                            }
                            else
                            {
                              echo date("d/m/Y | h:i A", strtotime($row['sales_quotation_created_at']));
                            }
                          ?>
                        </td>
                        <td>
                          <a href="sales_quotation_detail.php?sales_quotation_id=<?php echo $row['sales_quotation_id']; ?>" class="btn btn-outline-info btn-sm mr-2">Detail</a>
                          <!--<a href="sales_quotation_terms_conditions.php?sales_quotation_id=<?php //echo $row['sales_quotation_id']; ?>" class="btn btn-outline-info btn-sm">T&C</a>-->
                          <?php
                            if($_SESSION['role'] == 1)
                            {
                              $sales_quotation_id = $row['sales_quotation_id'];
                              $sql2 = "SELECT perform_invoice.id as 'perform_invoice_id', sales_quotation.id as 'sales_quotation_id' from sales_quotation INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id WHERE perform_invoice.sales_quotation_id = $sales_quotation_id";
                              $result2 = mysqli_query($conn, $sql2);
                              if (mysqli_num_rows($result2) < 1)
                              {
                                ?>
                                <a href="perform_invoice_form.php?sales_quotation_id=<?php echo $row['sales_quotation_id']; ?>&action=add" class="btn btn-success btn-sm">PI</a>
                                <?php
                              }
                              else
                              {
                                $row2 = mysqli_fetch_array($result2);
                                ?>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="PI <?php echo $row2['perform_invoice_id']; ?>" disabled>PI</a>
                                <?php
                              }
                            }
                          ?>
                        </td>
                        <?php
                          if($_SESSION['role'] == 1)
                          {
                        ?>
                        <td>
                          <!--<a href="sales_quotation_cetak.php?id=<?php //echo $row['sales_quotation_id']; ?>" class="mr-3"><i class="fas fa-print"></i></a>-->
                          <a href="sales_quotation_form.php?id=<?php echo $row['sales_quotation_id']; ?>&action=edit" class="mr-3"><i class="fas fa-edit"></i></a>
                          <a href="sales_quotation_form.php?id=<?php echo $row['sales_quotation_id']; ?>&action=delete"><i class="fas fa-trash"></i></a>
                        </td>
                        <?php
                          }
                        ?>
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
