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

  <title>Sales Quotation Detail</title>

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
              <li class="breadcrumb-item active" aria-current="page">SQ Detail</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales Quotation Detail of SQ<?php echo $sales_quotation_id; ?></h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <?php
              if($_SESSION['role'] == 1)
              {
              ?>
              <a href="sales_quotation_detail_form.php?sales_quotation_id=<?php echo $sales_quotation_id; ?>&action=add" class="btn btn-info mb-3">ADD</a>
              <?php
              }
              ?>
              <br>
              <small>Aktif = Barang belum dikirim, Selesai = barang sudah dikirim</small>
              <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                  <a class="nav-link active" href="sales_quotation_detail.php?sales_quotation_id=<?php echo $sales_quotation_id; ?>">Sales Quotation Detail Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sales_quotation_detail_selesai.php?sales_quotation_id=<?php echo $sales_quotation_id; ?>">Sales Quotation Detail Selesai</a>
                </li>
              </ul>
              <table class="table table-striped table-bordered table-first-column-small" id="table-show">
                <thead>
                  <tr>
                    <td>No</td>
                    <td>ID SQ Detail</td>
                    <td>Nama Produk</td>
                    <td>Harga Jual</td>
                    <td>Qty</td>
                    <td>Diskon</td>
                    <td>Actions</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT sales_quotation_detail.id AS 'sales_quotation_detail_id', sales_quotation_detail.sales_quotation_id AS 'sales_quotation_detail_sales_quotation_id', sales_quotation_detail.produk_id AS 'sales_quotation_detail_produk_id', sales_quotation_detail.harga_jual AS 'sales_quotation_detail_harga_jual', sales_quotation_detail.qty AS 'sales_quotation_detail_qty', sales_quotation_detail.diskon AS 'sales_quotation_detail_diskon', produk.id AS 'produk_id', item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', produk.id, concat_ws(' ',item.nama, jenis.nama, standard.nama, tipe.nama, merek.nama, kategori.nama, warna.nama, concat('dia. ',produk.diameter), concat('@', produk.panjang, 'cm/', satuan.nama)) as produk_nama, produk.harga, jenis.nama AS jenis, warna.nama AS warna, kategori.nama AS kategori, produk.diameter, produk.panjang, merek.nama AS merek, satuan.nama AS satuan_nama, produk.gambar AS gambar FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN standard ON standard.jenis_id = jenis.id LEFT JOIN tipe ON standard.id = tipe.standard_id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN merek ON produk.merek_id = merek.id WHERE sales_quotation_detail.sales_quotation_id = '$sales_quotation_id' AND sales_quotation_detail.status = 'aktif'";


                  $result = mysqli_query($conn, $sql);
                  $no = 1;
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      $produk_nama = $row['produk_nama'];
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['sales_quotation_detail_id']; ?></td>
                        <td><?php echo $row['produk_id'] . "-" . $produk_nama; ?></td>
                        <td><?php echo "Rp " . number_format($row['sales_quotation_detail_harga_jual'], 0, ",", "."); ?></td>
                        <td><?php echo $row['sales_quotation_detail_qty']; ?></td>
                        <td><?php echo $row['sales_quotation_detail_diskon']; ?>%</td>
                        <td>
                          <a href="sales_quotation_detail_form.php?id=<?php echo $row['sales_quotation_detail_id']; ?>&sales_quotation_id=<?php echo $sales_quotation_id; ?>&action=edit" class="mr-3"><i class="fas fa-edit"></i></a>
                          <?php
                            if($_SESSION['role'] == 1)
                            {
                          ?>
                          <a href="sales_quotation_detail_form.php?id=<?php echo $row['sales_quotation_detail_id']; ?>&sales_quotation_id=<?php echo $sales_quotation_id; ?>&action=delete"><i class="fas fa-trash"></i></a>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                      <?php
                      $no++;
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
