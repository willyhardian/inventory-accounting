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

  <title>Person Form</title>

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
              <li class="breadcrumb-item"><a href="customer.php">Customer</a></li>
              <li class="breadcrumb-item"><a href="person.php">Person</a></li>
              <li class="breadcrumb-item active" aria-current="page">Person Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Person</h1>
          <form method="POST"action="person_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id_pelanggan = "";
              $nama_pelanggan = "";
              $phone_pelanggan = "";
              $email_pelanggan = "";
              $readonly = "";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM pelanggan WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_pelanggan = $row['id'];
                  $nama_pelanggan = $row['nama'];
                  $phone_pelanggan = $row['phone'];
                  $email_pelanggan = $row['email'];
                  $jenis_kelamin_pelanggan = $row['jenis_kelamin'];
                  $organization_pelanggan = $row['pelanggan_info_id'];
                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM pelanggan WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_pelanggan = $row['id'];
                  $nama_pelanggan = $row['nama'];
                  $phone_pelanggan = $row['phone'];
                  $email_pelanggan = $row['email'];
                  $jenis_kelamin_pelanggan = $row['jenis_kelamin'];
                  $organization_pelanggan = $row['pelanggan_info_id'];
                  $readonly = "readonly";
                }
                else
                {
                  $btn = "Submit";
                  $btn_class_bootstrap = "btn-primary";
                }
              }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id_pelanggan; ?>">
  <div class="form-group">
  <div class="form row">
    <div class="form-group col-md-6">
    <img class="w-100"src="img/profile.png">
  </div>
  <div class="form-group col-md-6">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" placeholder="Enter Customer Name" <?php echo $readonly; ?> value="<?php echo $nama_pelanggan; ?>" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="phone" class="form-control" id = "phone" name="phone" placeholder="Enter Customer Number" <?php echo $readonly; ?> value="<?php echo $phone_pelanggan; ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Customer Email" <?php echo $readonly; ?> value="<?php echo $email_pelanggan; ?>" >
  </div>
  <div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required <?php echo $readonly; ?> >
      <?php
        if($jenis_kelamin_pelanggan == "perempuan")
        {
          ?>
            <option value="perempuan" selected>Perempuan</option>
            <option value="pria">Pria</option>
          <?php
        }
        else if($jenis_kelamin_pelanggan == "pria")
        {
          ?>
            <option value="perempuan">Perempuan</option>
            <option value="pria" selected>Pria</option>
          <?php
        }
        else
        {
          ?>
            <option value="perempuan" selected>Perempuan</option>
            <option value="pria">Pria</option>
          <?php
        }

      ?>
    </select>
  </div>
  <div class="form-group">
  <label for="organization">Organization</label>
  <select id="organization" name="organization" class="form-control" value="" <?php echo $readonly;?>>
          <option value="NULL">---Kalangan Sendiri---</option>

          <?php
            $sql = "SELECT nama_org as 'nama_org_pelanggan_info', id as 'id_pelanggan_info' FROM pelanggan_info";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query))
            {
              $nama_org_pelanggan_info = $row['nama_org_pelanggan_info'];
              $id_pelanggan_info = $row['id_pelanggan_info'];
              if($id_pelanggan_info == $organization_pelanggan)
              {
                ?>
                <option value="<?php echo $id_pelanggan_info; ?>" selected><?php echo $nama_org_pelanggan_info; ?></option>
                <?php
              }
              else
              {
                ?>
                <option value="<?php echo $id_pelanggan_info; ?>"><?php echo $nama_org_pelanggan_info; ?></option>
                <?php
              }
            }
          ?>
          <?php
        /*
        include 'config.php';
        $action = $_GET['action'];

        if($action == 'edit' AND $organization_pelanggan != null){
          $updatesql = "SELECT * FROM pelanggan_info WHERE id = $organization_pelanggan";
          $query = mysqli_query($conn, $updatesql);
          $row = mysqli_fetch_array($query);
          $selectpelanggan = $row['nama_org'];
          echo $selectpelanggan;

          $sql = "select * from pelanggan_info order by nama_org ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              echo '<option value="'.$rows['id'].'">'.$rows['nama_org'].'</option>';
            }
        }
        else if($action == 'delete' AND $organization_pelanggan != null){
          $updatesql = "SELECT * FROM pelanggan_info WHERE id = $organization_pelanggan";
          $query = mysqli_query($conn, $updatesql);
          $row = mysqli_fetch_array($query);
          $selectpelanggan = $row['nama_org'];
          echo $selectpelanggan;
        }
        else if($action == 'delete' AND $organization_pelanggan == null){
          echo "Tidak ada organization";

        }
        else if ($action == 'edit' AND $organization_pelanggan = null) {

          echo'<option hidden disabled selected value></option>';
          $sql = "select * from pelanggan_info order by nama_org ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              echo '<option value="'.$rows['id'].'">'.$rows['nama_org'].'</option>';
            }
        }

        else{
          echo'<option hidden disabled selected value></option>';
          $sql = "select * from pelanggan_info order by nama_org ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              echo '<option value="'.$rows['id'].'">'.$rows['nama_org'].'</option>';
            }
        }
        */
          ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
        </script>


        <script type="text/javascript">
            $(document).ready(function() {
        $('#organization').select2({
          placeholder: "Pilih organization"
        });
           });
          </script>

			</select>



<small>Jika Customer perwakilan dari perusahaan wajib di isi</small>
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
