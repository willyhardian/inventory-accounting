<?php include "security.php"; ?>
<?php include "config.php";
  if(isset($_GET['pembelian_id']))
  {
      $pembelian_id = $_GET['pembelian_id'];
  }
  else
  {
      $pembelian_id = 0;
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

  <title>Pembelian</title>

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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pembelian Terms Conditions of <?php echo $pembelian_id; ?></h1>
          </div>
          <a href="pembelian_terms_conditions.php" class="text-decoration-none text-secondary"><i class="fas fa-chevron-circle-left mb-3" style="font-size: 25px;"></i></a>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_pembelian_terms_conditions = "";
                $terms_conditions_id_pembelian_terms_conditions = "";
                $pembelian_id_pembelian_terms_conditions = "";
                $nama_terms_conditions = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT pembelian_terms_conditions.id AS 'id_pembelian_terms_conditions', pembelian_terms_conditions.terms_conditions_id AS 'terms_conditions_id_pembelian_terms_conditions', pembelian_terms_conditions.pembelian_id AS 'pembelian_id_pembelian_terms_conditions', terms_conditions.nama AS 'nama_terms_conditions' FROM pembelian_terms_conditions INNER JOIN terms_conditions ON pembelian_terms_conditions.terms_conditions_id = terms_conditions.id WHERE pembelian_terms_conditions.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_pembelian_terms_conditions = $row['id_pembelian_terms_conditions'];
                    $terms_conditions_id = $row['terms_conditions_id_pembelian_terms_conditions'];
                    $pembelian_id_pembelian_terms_conditions = $row['pembelian_id_pembelian_terms_conditions'];
                    $nama_terms_conditions = $row['nama_terms_conditions'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT pembelian_terms_conditions.id AS 'id_pembelian_terms_conditions', pembelian_terms_conditions.terms_conditions_id AS 'terms_conditions_id_pembelian_terms_conditions', pembelian_terms_conditions.pembelian_id AS 'pembelian_id_pembelian_terms_conditions', terms_conditions.nama AS 'nama_terms_conditions' FROM pembelian_terms_conditions INNER JOIN terms_conditions ON pembelian_terms_conditions.terms_conditions_id = terms_conditions.id WHERE pembelian_terms_conditions.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_pembelian_terms_conditions = $row['id_pembelian_terms_conditions'];
                    $terms_conditions_id = $row['terms_conditions_id_pembelian_terms_conditions'];
                    $pembelian_id_pembelian_terms_conditions = $row['pembelian_id_pembelian_terms_conditions'];
                    $nama_terms_conditions = $row['nama_terms_conditions'];
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

              <form method="POST" action="pembelian_terms_conditions_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="pembelian_id">ID Pembelian</label>
                    <input type="text" class="form-control form-control-user" id="pembelian_id" name="pembelian_id" value="<?php echo $pembelian_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="terms_conditions_id">Terms Conditions</label>
                    <select id="terms_conditions_id" name="terms_conditions_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT nama as 'nama_terms_conditions', id as 'id_terms_conditions' FROM terms_conditions";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_terms_conditions = $row['nama_terms_conditions'];
                          $id_terms_conditions = $row['id_terms_conditions'];
                          if($terms_conditions_id == $id_terms_conditions)
                          {
                            ?>
                            <option value="<?php echo $id_terms_conditions; ?>" selected><?php echo $id_terms_conditions; ?> - <?php echo $nama_terms_conditions; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_terms_conditions; ?>"><?php echo $id_terms_conditions; ?> - <?php echo $nama_terms_conditions; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                </div>
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
</body>

</html>
