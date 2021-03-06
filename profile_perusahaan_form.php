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

  <title>Profile Perusahaan Form</title>

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
              <li class="breadcrumb-item"><a href="profile_perusahaan.php">Profile Perusahaan</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile Perusahaan Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profile Perusahaan Form</h1>
          <form method="POST" enctype="multipart/form-data" action="profile_perusahaan_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id_profileperusahaan = "";
              $nama_profileperusahaan = "";
              $phone_profileperusahaan = "";
              $email_profileperusahaan = "";
              $alamat_profileperusahaan = "";
              $tanggal_profileperusahaan = "";
              $logo_profileperusahaan = "";
              $readonly = "";
              $pointer_events = "auto";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM profil_perusahaan WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_profileperusahaan = $row['id'];
                  $nama_profileperusahaan = $row['nama'];
                  $phone_profileperusahaan = $row['no_telepon'];
                  $email_profileperusahaan = $row['email'];
                  $tanggal_profileperusahaan = $row['tanggal'];
                  $alamat_profileperusahaan = $row['alamat'];


                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM profil_perusahaan WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_profileperusahaan = $row['id'];
                  $nama_profileperusahaan = $row['nama'];
                  $phone_profileperusahaan = $row['no_telepon'];
                  $email_profileperusahaan = $row['email'];
                  $tanggal_profileperusahaan = $row['tanggal'];
                  $alamat_profileperusahaan = $row['alamat'];
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
            <input type="hidden" name="id" id="id" value="<?php echo $id_profileperusahaan; ?>">
  <div class="form-group">

  <div class="form-group col-md-6">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" placeholder="Masukan Nama Perusahaan" <?php echo $readonly; ?> value="<?php echo $nama_profileperusahaan; ?>" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="phone" class="form-control" id = "phone" name="phone" placeholder="Masukan No Telepon" <?php echo $readonly; ?> value="<?php echo $phone_profileperusahaan; ?>" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" <?php echo $readonly; ?> value="<?php echo $email_profileperusahaan; ?>" >
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea type="Alamat" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="3" <?php echo $readonly; ?>><?php echo $alamat_profileperusahaan; ?></textarea>
  </div>
  <div class="form-group">
      <label for="nama">Tanggal <small>(Tanggal harus 01)</small></label>
      <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $tanggal_profileperusahaan; ?>" <?php echo $readonly; ?> required>
      <small>tahun-bulan-tanggal</small>
  </div>
  <div class="form-group">
      <label for="logo">Logo</label>
      <input type="file" class="form-control" id="logo" name="logo" <?php echo $readonly; ?>  style="pointer-events: <?php echo $pointer_events; ?>">
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(document).ready(function () {
    $("#tanggal").datepicker({ dateFormat: "yy-mm-dd" });
  });
  </script>
</body>

</html>
