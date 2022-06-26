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

  <title>Vendor Form</title>

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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="vendor.php">Vendor</a></li>
              <li class="breadcrumb-item active" aria-current="page">Vendor Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Vendor</h1>
          <form method="POST"action="vendor_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id_vendor = "";
              $nama_vendor = "";
              $phone_vendor = "";
              $email_vendor = "";
              $address_vendor = "";
              $readonly = "";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM vendor WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_vendor = $row['id'];
                  $nama_vendor = $row['nama'];
                  $phone_vendor = $row['no_telepon'];
                  $email_vendor = $row['email'];
                  $address_vendor = $row['alamat'];

                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM vendor WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_vendor = $row['id'];
                  $nama_vendor = $row['nama'];
                  $phone_vendor = $row['no_telepon'];
                  $email_vendor = $row['email'];
                  $address_vendor = $row['alamat'];
                  $readonly = "readonly";
                }
                else
                {
                  $btn = "Submit";
                  $btn_class_bootstrap = "btn-primary";
                }
              }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id_vendor; ?>">
  <div class="form-group">
  <div class="form row">
  <div class="form-group col-md-6">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" placeholder="Enter Vendor Name" <?php echo $readonly; ?> value="<?php echo $nama_vendor; ?>" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="phone" class="form-control" id = "phone" name="phone" placeholder="Enter Vendor Number" <?php echo $readonly; ?> value="<?php echo $phone_vendor; ?>" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Vendor Email" <?php echo $readonly; ?> value="<?php echo $email_vendor; ?>" >
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea type="address" class="form-control" id="alamat" name="alamat" placeholder="Enter Vendor Address" <?php echo $readonly; ?>><?php echo $address_vendor; ?></textarea>
  </div>
<div class="form-group">
  <input type="submit" value="<?php echo $btn; ?>" class="btn btn-user btn-block <?php echo $btn_class_bootstrap; ?>">
</div>
</div>

</div>
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
