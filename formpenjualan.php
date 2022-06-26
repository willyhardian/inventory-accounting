<?php include "security.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App - Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
          <h1 class="h3 mb-4 text-gray-800">Sales Quotation Form</h1>
          <form action="salesquotation.php">
  <div class="form-group col-md-6">
    <label for="customer">Pelanggan</label>
    <select id="pelanggan" class="form-control">
    <option disabled selected>-- Pilih Pelanggan --</option>
    <?php
        include "config.php";  // Using database connection file here
        $records = mysqli_query($db, "SELECT pelanggan From tblcity");  // Use select query here

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['customer_name'] ."'>" .$data['city_name'] ."</option>";  // displaying data in option menu
        }
    ?>
  </select>
</div>
  <div class="form row">
    <div class="form-group col-md-6">
    <label for="produk">Pilih Barang</label>
    <select id="produk" class="form-control">
    <option disabled selected>-- Pilih Produk --</option>
    <?php
        include "config.php";  // Using database connection file here
        $records = mysqli_query($db, "SELECT pelanggan From tblcity");  // Use select query here

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['customer_name'] ."'>" .$data['city_name'] ."</option>";  // displaying data in option menu
        }
    ?>
  </select>
</div>
  <div class="form-group col-md-2">
    <label for="qty">Quantity</label>
    <input type="qty" class="form-control" id="qty" placeholder="Quantity">
  </div>
  <div class="form-group col-md-2">
    <label for="diskon">Discount</label>
    <input type="diskon" class="form-control" id="diskon" placeholder="Discount">
  </div>
</div>

  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="pajak">
    <label class="form-check-label" for="pajak">Harga termasuk pajak?</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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

</body>

</html>
