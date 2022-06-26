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

  <title>Pengeluaran Form</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

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
            <h1 class="h3 mb-0 text-gray-800">Pengeluaran Lainnya Form</h1>
          </div>
          <a href="pengeluaran.php" class="text-decoration-none text-secondary"><i class="fas fa-chevron-circle-left mb-3" style="font-size: 25px;"></i></a>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_beban = "";
                $kode_akun = "";
                $biaya = "";
                $keterangan = "";
                $readonly = "";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM beban WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_beban = $row['id'];
                    $kode_akun = $row['kode_akun_id'];
                    $biaya = $row['harga'];
                    $tanggal = $row['tanggal'];
                    $keterangan = $row['keterangan'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM beban WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_beban = $row['id'];
                    $kode = $row['kode_akun_id'];
                    $biaya = $row['harga'];
                    $tanggal = $row['tanggal'];
                    $keterangan = $row['keterangan'];
                    $readonly = "readonly";
                  }
                  else
                  {
                    $btn = "Submit";
                    $btn_class_bootstrap = "btn-primary";
                  }
                }
              ?>

              <form method="POST" action="pengeluaran_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_beban; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>"  <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="">Kode Akun</label>
                    <select class="form-control" id="kode_akun" name="kode_akun" value="<?php echo $kode_akun; ?>"  <?php echo $readonly ?> required>
                      <option>
                        <?php
                        include 'config.php';
                        $action = $_GET['action'];

                        if($action == 'edit'){
                          $updatesql = "SELECT * FROM kode_akun WHERE id = $kode_akun";
                          $query = mysqli_query($conn, $updatesql);
                          $row = mysqli_fetch_array($query);
                          $kode = $row['kode'];
                          $nama = $row['nama'];
                          echo "$kode - $nama";

                          $sql = "select * from kode_akun";
                          $rs = mysqli_query($conn,$sql);
                            while($rows = mysqli_fetch_assoc($rs))
                            {
                              echo '<option value="'.$rows['id'].'">'.$rows['kode'].'-'.$rows['nama'].'</option>';
                            }
                      } else if ($action == 'delete'){
                        $deletesql = "SELECT * FROM kode_akun WHERE id = $kode_akun";
                        $query = mysqli_query($conn, $deletesql);
                        $row = mysqli_fetch_array($query);
                        $kode = $row['kode'];
                        $nama = $row['nama'];
                        echo "$kode - $nama";
                      } else{
                        echo '<option selected disabled hidden></option>';
                        $sql = "select * from kode_akun";
                        $rs = mysqli_query($conn,$sql);
                        while($rows = mysqli_fetch_assoc($rs))
                        {
                          echo '<option value="'.$rows['id'].'">'.$rows['kode'].'-'.$rows['nama'].'</option>';
                        }
                      }
                        ?>
                      </option>

                    </select>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                    </script>


                    <script type="text/javascript">
                        $(document).ready(function() {
                    $('#kode_akun').select2({
                      placeholder: "Pilih Kode Akun"
                    });
                       });
                      </script>
                </div>

                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="text" class="form-control form-control-user" id="biaya" name="biaya" value="<?php echo $biaya; ?>" required <?php echo $readonly; ?> placeholder="Masukan Total Biaya">
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" rows="5" <?php echo $readonly; ?>><?php echo $keterangan; ?></textarea>
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
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
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
