<?php include "security.php"; ?>
<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Organization | Form</title>

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
              <li class="breadcrumb-item"><a href="customer.php">Customer</a></li>
              <li class="breadcrumb-item"><a href="organization.php">Organization</a></li>
              <li class="breadcrumb-item active" aria-current="page">Organization Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Organization</h1>
          <form method="post" action="organization_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id_perusahaan = "";
              $nama_perusahaan = "";
              $phone_perusahaan = "";
              $email_perusahaan = "";
              $alamat_perusahaan = "";
              $npwp_perusahaan = "";
              $readonly = "";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM pelanggan_info WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_perusahaan = $row['id'];
                  $nama_perusahaan = $row['nama_org'];
                  $phone_perusahaan = $row['no_telepon'];
                  $email_perusahaan = $row['email'];
                  $alamat_perusahaan = $row['alamat'];
                  $npwp_perusahaan = $row['npwp'];
                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM pelanggan_info WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_perusahaan = $row['id'];
                  $nama_perusahaan = $row['nama_org'];
                  $phone_perusahaan = $row['no_telepon'];
                  $email_perusahaan = $row['email'];
                  $alamat_perusahaan = $row['alamat'];
                  $npwp_perusahaan = $row['npwp'];
                  $readonly = "readonly";
                }
                else
                {
                  $btn = "Submit";
                  $btn_class_bootstrap = "btn-primary";
                }
              }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id_perusahaan; ?>">
  <div class="form-group">

  <div class="form row ">
    <div class="form-group col-md-6">
      <img class="w-100" src="img/company.png">
    </div>
  <div class="form-group col-md-6">
    <div class="form-group">
      <label for="corpname">Name of Organization</label>
      <input type="text" class="form-control" name="name" placeholder="Enter organization name's" <?php echo $readonly; ?> value="<?php echo $nama_perusahaan; ?>" required>
    </div>
    <div class="form-group">
      <label for="corpemail">Email</label>
      <input type="text" class="form-control" name="email" placeholder="Enter Organization email" <?php echo $readonly; ?> value="<?php echo $email_perusahaan; ?>">
    </div>
  <div class="form-group">
    <label for="corpphone">Phone Number</label>
    <input type="text" class="form-control" name="phone" placeholder="Enter Organization phone number" <?php echo $readonly; ?> value="<?php echo $phone_perusahaan; ?>">
  </div>
  <div class="form-group">
    <label for="corpnpwp">NPWP</label>
    <input type="text" class="form-control" name="npwp" placeholder="Enter Organization NPWP" <?php echo $readonly; ?> value="<?php echo $npwp_perusahaan; ?>">
  </div>
  <div class="form-group">
    <label for="corpaddress">Address</label>
    <input type="text" class="form-control" name="address" rows="3" placeholder="Enter Organization Address" <?php echo $readonly; ?> value="<?php echo $alamat_perusahaan; ?>">
  </div>
  <div class="form-group">
    <input type="submit" value="<?php echo $btn; ?>" class="btn btn-user btn-block <?php echo $btn_class_bootstrap; ?>">
  </div>
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
            <span aria-hidden="true">??</span>
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
