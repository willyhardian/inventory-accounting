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

  <title>User Form</title>

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
              <li class="breadcrumb-item"><a href="user.php">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">User</h1>
          <form method="POST"action="user_process.php?action=<?php echo $_GET['action']; ?>">
            <?php
              //include 'config.php';

              $btn = "";
              $btn_class_bootstrap = "";
              $id_user ="";
              $nama_user = "";
              $username_user = "";
              $password_user = "";
              $email_user = "";
              $role_user = "";
              $status_user = "";
              $readonly = "";
              if(isset($_GET['action']))
              {
                if($_GET['action'] == "edit")
                {
                  $btn = "Update";
                  $btn_class_bootstrap = "btn-warning";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM users WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_user = $row['id'];
                  $nama_user = $row['nama'];
                  $username_user = $row['username'];
                  $password_user = $row['password'];
                  $email_user = $row['email'];
                  $role_user = $row['role_id'];
                  $status_user = $row['status'];
                }
                else if($_GET['action'] == "delete")
                {
                  $btn = "Delete";
                  $btn_class_bootstrap = "btn-danger";
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM users WHERE id = $id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $id_user = $row['id'];
                  $nama_user = $row['nama'];
                  $username_user = $row['username'];
                  $password_user = $row['password'];
                  $email_user = $row['email'];
                  $role_user = $row['role_id'];
                  $status_user = $row['status'];
                  $readonly = "readonly";
                }
                else
                {
                  $btn = "Submit";
                  $btn_class_bootstrap = "btn-primary";
                }
              }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id_user; ?>">

  <div class="form row">
  <div class="form-group col-md-6">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" placeholder="Enter Name" <?php echo $readonly; ?> value="<?php echo $nama_user; ?>" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" <?php echo $readonly; ?> value="<?php echo $email_user; ?>" >
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="username" class="form-control" id = "username" name="username" placeholder="Enter Username" <?php echo $readonly; ?> value="<?php echo $username_user; ?>" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" <?php echo $readonly; ?> value="<?php echo $password_user; ?>" >
  </div>
  <div class="form-group">
  <label for="role">role</label>
  <select id="role" name="role" class="form-control" value="" <?php echo $readonly;?>>


				<option>
          <?php
        include 'config.php';
        $action = $_GET['action'];

        if($action == 'edit' AND $role_user != null){
          $updatesql = "SELECT * FROM role WHERE id = $role_user";
          $query = mysqli_query($conn, $updatesql);
          $row = mysqli_fetch_array($query);
          $selectuser = $row['id'];
          //echo $selectuser;

          $sql = "select * from role order by nama ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              $role_id_data = $rows['id'];
              if($selectuser == $role_id_data)
              {
                echo '<option value="'.$rows['id'].'" selected>'.$rows['nama'].'</option>';
              }
              else
              {
                echo '<option value="'.$rows['id'].'">'.$rows['nama'].'</option>';
              }
            }
        }
        else if($action == 'delete' AND $role_user != null){
          $updatesql = "SELECT * FROM role WHERE id = $role_user";
          $query = mysqli_query($conn, $updatesql);
          $row = mysqli_fetch_array($query);
          $selectuser = $row['nama'];
          echo $selectuser;
        }
        else if($action == 'delete' AND $role_user == null){
          echo "Tidak ada organization";

        }
        else if ($action == 'edit' AND $role_user = null) {

          echo'<option hidden disabled selected value></option>';
          $sql = "select * from role order by nama ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              echo '<option value="'.$rows['id'].'">'.$rows['nama'].'</option>';
            }
        }

        else{
          echo'<option hidden disabled selected value></option>';
          $sql = "select * from role order by nama ASC";
          $rs = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($rs))
            {
              echo '<option value="'.$rows['id'].'">'.$rows['nama'].'</option>';
            }
        }

          ?>
        </option>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
        </script>


        <script type="text/javascript">
            $(document).ready(function() {
        $('#role').select2({
          placeholder: "Pilih role"
        });
           });
          </script>

			</select>
      <!--
      //Temporary disable because we still have to set the authorization to each feature in the website
      <div class="form-group">
      <label for="status">Status</label>
        <select name="status" id="status" class="form-control" <?php //echo $readonly; ?> values="<?php //echo $status_user; ?>">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
      -->
</div>
<div class="form-group">
  <input type="submit" value="<?php echo $btn; ?>" class="btn btn-user btn-block <?php echo $btn_class_bootstrap; ?>">
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
