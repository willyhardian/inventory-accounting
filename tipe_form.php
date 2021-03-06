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

  <title>Tipe</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
              <li class="breadcrumb-item"><a href="lainnya.php">Lainnya</a></li>
              <li class="breadcrumb-item"><a href="tipe.php">Tipe</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tipe Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tipe</h1>
          </div>          
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_tipe = "";
                $nama_tipe = "";
                $keterangan_tipe = "";
                $nama_standard = "";
                $standard_id = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT tipe.id as 'id_tipe', tipe.nama as 'nama_tipe', tipe.keterangan as 'keterangan_tipe', tipe.standard_id as 'standard_id', standard.nama as 'nama_standard' FROM tipe INNER JOIN standard ON tipe.standard_id = standard.id WHERE tipe.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_tipe = $row['id_tipe'];
                    $nama_tipe = $row['nama_tipe'];
                    $keterangan_tipe = $row['keterangan_tipe'];
                    $nama_standard = $row['nama_standard'];
                    $standard_id = $row['standard_id'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT tipe.id as 'id_tipe', tipe.nama as 'nama_tipe', tipe.keterangan as 'keterangan_tipe', tipe.standard_id as 'standard_id', standard.nama as 'nama_standard' FROM tipe INNER JOIN standard ON tipe.standard_id = standard.id WHERE tipe.id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_tipe = $row['id_tipe'];
                    $nama_tipe = $row['nama_tipe'];
                    $keterangan_tipe = $row['keterangan_tipe'];
                    $nama_standard = $row['nama_standard'];
                    $standard_id = $row['standard_id'];
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

              <form method="POST" action="tipe_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_tipe; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Cth: AW" value="<?php echo $nama_tipe; ?>" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="standard_id">Standard</label>
                    <select id="standard_id" name="standard_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <option>
                      <?php
                        $sql = "SELECT nama as 'nama_standard', id as 'id_standard' FROM standard";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_standard = $row['nama_standard'];
                          $id_standard = $row['id_standard'];
                          if($standard_id == $id_standard)
                          {
                            ?>
                            <option value="<?php echo $id_standard; ?>" selected><?php echo $id_standard . " - " . $nama_standard; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_standard; ?>"><?php echo $id_standard . " - " . $nama_standard; ?></option>
                            <?php
                          }
                          /*
                          if($jenis_id == $row['jenis_id'])
                          {
                            #<option value="<?php echo $row['jenis_id']; " selected><?php echo $nama_jenis; </option>
                            */
                        }

                      ?>
                      </option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                      </script>


                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#standard_id').select2({
                        placeholder: "Pilih standard"
                      });
                         });
                        </script>
                    </select>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" name="keterangan" rows="5" placeholder="Cth: Pipa ini cocok digunakan untuk saluran air bersih karena menahan tekanan dari pompa air serta gravitasi karena ketinggian tandon air" <?php echo $readonly; ?>><?php echo $keterangan_tipe; ?></textarea>
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
  <!--<script src="vendor/jquery/jquery.min.js"></script> -->
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
