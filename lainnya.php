<?php include "security.php"; include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lainnya (Gudang)</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
  img.center {
  display: block;
  margin: 0 auto;
  width: 200px;
  height: 200px;
  text-align: center;
  padding-top: 5px;
}
  </style>
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
              <li class="breadcrumb-item active" aria-current="page">Lainnya</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Lainnya</h1>
          <div class="row">

            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Merek</h6>
                </div>
                <img class="center" src="img/brand.png">
                <div class="card-body">

                  <!-- Circle Buttons (Default) -->
                  <div class="card-body col text-center">
                    <div style="padding: 5px;">
                    <a href="merek_form.php?action=add" class="btn btn-success btn-icon-split" style="padding:">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Merek</span>
                    </a>
                  </div>
                    <div style="padding: 5px;">
                    <a href="merek.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Merek</span>
                    </a>
                  </div>
                    </div>

                </div>
              </div>

            </div>
            <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jenis</h6>
              </div>
              <img class="center" src="img/list.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                  <a href="jenis_form.php?action=add"  class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Jenis</span>
                  </a>
                </div>
                  <div style="padding: 5px;">
                  <a href="jenis.php" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">List Jenis</span>
                  </a>
                </div>
                  </div>

              </div>
            </div>

          </div>
          <div class="col-lg-4">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Standard</h6>
              </div>
              <img class="center" src="img/stars.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                  <a href="standard_form.php?action=add" class="btn btn-success btn-icon-split" style="padding:">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Standard</span>
                  </a>
                </div>
                  <div style="padding: 5px;">
                  <a href="standard.php" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">List Standard</span>
                  </a>
                </div>
                  </div>

              </div>
            </div>

          </div>

          <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tipe</h6>
              </div>
              <img class="center" src="img/list.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                    <a href="tipe_form.php?action=add"  class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Tipe</span>
                    </a>
                  </div>
                  <div style="padding: 5px;">
                    <a href="tipe.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Tipe</span>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Item</h6>
              </div>
              <img class="center" src="img/item.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                    <a href="item_form.php?action=add"  class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Item</span>
                    </a>
                  </div>
                  <div style="padding: 5px;">
                    <a href="item.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Item</span>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Warna</h6>
              </div>
              <img class="center" src="img/colors.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                    <a href="warna_form.php?action=add"  class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Warna</span>
                    </a>
                  </div>
                  <div style="padding: 5px;">
                    <a href="warna.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Warna</span>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Satuan</h6>
              </div>
              <img class="center" src="img/mass.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                    <a href="satuan_form.php?action=add"  class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Satuan</span>
                    </a>
                  </div>
                  <div style="padding: 5px;">
                    <a href="satuan.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Satuan</span>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
              </div>
              <img class="center" src="img/list.png">
              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <div style="padding: 5px;">
                    <a href="kategori_form.php?action=add"  class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Kategori</span>
                    </a>
                  </div>
                  <div style="padding: 5px;">
                    <a href="kategori.php" class="btn btn-info btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                      </span>
                      <span class="text">List Kategori</span>
                    </a>
                  </div>
                </div>

              </div>
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

</body>

</html>
