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

  <title>Rekening Form</title>

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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Rekening</h1>
          <form method="POST"action="rekening_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id = "";
              $nama_bank = "";
              $nama_rekening = "";
              $no_rekening = "";
              $kode_akun_id = "";
              $readonly = "";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM rekening WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id = $row['id'];
                  $nama_bank = $row['nama_bank'];
                  $nama_rekening = $row['nama_rekening'];
                  $no_rekening = $row['no_rekening'];
                  $kode_akun_id = $row['kode_akun_id'];
                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM rekening WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id = $row['id'];
                  $nama_bank = $row['nama_bank'];
                  $nama_rekening = $row['nama_rekening'];
                  $no_rekening = $row['no_rekening'];
                  $kode_akun_id = $row['kode_akun_id'];
                  $readonly = "readonly";
                }
                else
                {
                  $btn = "Submit";
                  $btn_class_bootstrap = "btn-primary";
                }
              }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
  <div class="form-group">
  <div class="form row">
    <div class="form-group col-md-6">
    <img class="w-100"src="img/bank.png">
  </div>
  <div class="form-group col-md-6">
    <div class="form-group">
      <label for="nama_bank">Nama Bank</label>
      <input type="nama_bank" class="form-control" id="nama_bank" name="nama_bank" placeholder="Masukan nama bank" <?php echo $readonly; ?> value="<?php echo $nama_bank; ?>" required>
    </div>
    <div class="form-group">
      <label for="nama_rekening">Nama Rekening</label>
      <input type="nama_rekening" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="Masukan nama rekening" <?php echo $readonly; ?> value="<?php echo $nama_rekening; ?>" required>
    </div>
    <div class="form-group">
      <label for="norek">No Rekening</label>
      <input type="norek" class="form-control" id = "norek" name="norek" placeholder="Masukan No Rekening" <?php echo $readonly; ?> value="<?php echo $no_rekening; ?>" required>
    </div>
    <div class="form-group">
        <label for="kode_akun_id">Akun</label>
        <select id="kode_akun_id" name="kode_akun_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
          <option>
            <?php
              $sql = "SELECT id as 'id_kode_akun', kode as 'kode_akun', nama as 'nama_kode_akun' FROM kode_akun";
              $query = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($query))
              {
                $id_kode_akun = $row['id_kode_akun'];
                $kode_akun = $row['kode_akun'];
                $nama_kode_akun = $row['nama_kode_akun'];

                if($kode_akun_id == $id_kode_akun)
                {
                  ?>
                  <option value="<?php echo $id_kode_akun; ?>" selected><?php echo $kode_akun . " - " . $nama_kode_akun; ?></option>
                  <?php
                }
                else
                {
                  ?>
                  <option value="<?php echo $id_kode_akun; ?>"><?php echo $kode_akun . " - " . $nama_kode_akun; ?></option>
                  <?php
                }
              }
            ?>
          </option>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
          <script type="text/javascript">
              $(document).ready(function(){
                $('#kode_akun_id').select2({
                  placeholder: "Pilih Akun"
                });
             });
          </script>
        </select>
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
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>



</body>

</html>
