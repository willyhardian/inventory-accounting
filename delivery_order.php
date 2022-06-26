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

  <title>Delivery Order Penjualan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <title></title>
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
              <li class="breadcrumb-item active" aria-current="page">DO</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Delivery Order Penjualan</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-striped table-bordered table-first-column-small" id="table-show">
                <thead>
                  <tr>
                    <td>No</td>
                    <td>ID DO</td>
                    <td>ID INV</td>
                    <td>Tanggal</td>
                    <td>Nama Penerima</td>
                    <td>No Penerima</td>
                    <td>Tujuan</td>
                    <td>Keterangan</td>
                    <td>Catatan</td>
                    <td>Updated At</td>
                    <td>Created At</td>
                    <td>Disiapkan Oleh</td>
                    <td>Disetujui Oleh</td>
                    <td>Dikirim Oleh</td>
                    <td>Actions</td>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>ID DO</th>
                    <th>ID INV</th>
                    <th>Tanggal</th>
                    <th>Tujuan</th>
                    <th>Catatan</th>
                    <th>Updated At</th>
                    <th>Created At</th>
                    <th>Disiapkan Oleh</th>
                    <th>Disetujui Oleh</th>
                    <th>Dikirim Oleh</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
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

      $(document).ready(function ()
      {
        $('#table-show tfoot th').each( function () {
    var title = $(this).text();
    if (title != 'Actions' && title != 'No') {
  $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
}
} );

          var table = $('#table-show').DataTable({
              "scrollX": true,
              "processing": true,
              "serverSide": true,
              "ajax": "delivery_order_search.php",
              order: [[0, 'asc']],
              columnDefs: [{
                  orderable: false,
                  targets: -1,
                  render: function(data, type, row){
                    var btn = '<a href="delivery_order_detail.php?id='+row[1]+'" class="btn btn-outline-info btn-sm">Detail</a><a href="delivery_order_laporan_process.php?id='+row[1]+'&invoice_id='+row[0] + '" class="mr-3"><i class="fas fa-print"></i></a><a href="delivery_order_form.php?id='+row[1]+'&invoice_id='+row[0]+'&action=edit" class="mr-3"><i class="fas fa-edit"></i></a><a href="delivery_order_form.php?id='+row[1]+'&invoice_id='+row[0]+'&action=delete"><i class="fas fa-trash"></i></a>';
                    return btn;
                  }
               }]
          });

          table.on( 'order.dt search.dt', function () {
              table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();

          table.columns().every(function () {
              var table = this;
              $('input', this.footer()).on('keyup change', function () {
                  if (table.search() !== this.value) {
                       table.search(this.value).draw();
                  }
              });
          });
      });

  </script>
</body>

</html>
