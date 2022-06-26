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

  <title>Pembelian</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
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
              <li class="breadcrumb-item"><a href="pembelian.php">Pembelian</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pembelian Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pembelian</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $pembelian_id = "";
                $tanggal_pembelian = "";
                $vendor_id = "";
                $termin_pembelian = "";
                $down_payment_pembelian = "";
                $pajak_pembelian = "";
                $terms_conditions_id = "";
                $status_pembelian = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    /*
                    //have terms_conditions
                    $sql = "SELECT pembelian.id as 'id_pembelian', pembelian.tanggal as 'tanggal_pembelian', vendor.id as 'vendor_id', pembelian.termin as 'termin_pembelian', pembelian.down_payment as 'down_payment_pembelian', pembelian.pajak as 'pajak_pembelian', terms_conditions.id as 'terms_conditions_id', pembelian.lokasi_id as 'lokasi_id', pembelian.status AS 'status_pembelian' FROM pembelian LEFT JOIN vendor ON pembelian.vendor_id = vendor.id LEFT JOIN terms_conditions ON pembelian.terms_conditions_id = terms_conditions.id WHERE pembelian.id = '$id'";
                    //end of have terms_conditions
                    */
                    $sql = "SELECT pembelian.id as 'id_pembelian', pembelian.tanggal as 'tanggal_pembelian', vendor.id as 'vendor_id', pembelian.termin as 'termin_pembelian', pembelian.down_payment as 'down_payment_pembelian', pembelian.pajak as 'pajak_pembelian', pembelian.lokasi_id as 'lokasi_id', pembelian.status AS 'status_pembelian' FROM pembelian LEFT JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.id = '$id'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    echo $conn->error;
                    $id_pembelian = $row['id_pembelian'];
                    $tanggal_pembelian = $row['tanggal_pembelian'];
                    $vendor_id = $row['vendor_id'];
                    $termin_pembelian = $row['termin_pembelian'];
                    $down_payment_pembelian = $row['down_payment_pembelian'];
                    $pajak_pembelian = $row['pajak_pembelian'];

                    //$terms_conditions_id = $row['terms_conditions_id'];

                    $lokasi_id = $row['lokasi_id'];
                    $status_pembelian = $row['status_pembelian'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    /*
                    //have terms_conditions
                    $sql = "SELECT pembelian.id as 'id_pembelian', pembelian.tanggal as 'tanggal_pembelian', vendor.id as 'vendor_id', pembelian.termin as 'termin_pembelian', pembelian.down_payment as 'down_payment_pembelian', pembelian.pajak as 'pajak_pembelian', terms_conditions.id as 'terms_conditions_id', pembelian.lokasi_id as 'lokasi_id', pembelian.status AS 'status_pembelian' FROM pembelian LEFT JOIN vendor ON pembelian.vendor_id = vendor.id LEFT JOIN terms_conditions ON pembelian.terms_conditions_id = terms_conditions.id WHERE pembelian.id = '$id'";
                    //end of have terms_conditions
                    */
                    $sql = "SELECT pembelian.id as 'id_pembelian', pembelian.tanggal as 'tanggal_pembelian', vendor.id as 'vendor_id', pembelian.termin as 'termin_pembelian', pembelian.down_payment as 'down_payment_pembelian', pembelian.pajak as 'pajak_pembelian', pembelian.lokasi_id as 'lokasi_id', pembelian.status AS 'status_pembelian' FROM pembelian LEFT JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.id = '$id'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    echo $conn->error;
                    $id_pembelian = $row['id_pembelian'];
                    $tanggal_pembelian = $row['tanggal_pembelian'];
                    $vendor_id = $row['vendor_id'];
                    $termin_pembelian = $row['termin_pembelian'];
                    $down_payment_pembelian = $row['down_payment_pembelian'];
                    $pajak_pembelian = $row['pajak_pembelian'];

                    //$terms_conditions_id = $row['terms_conditions_id'];

                    $lokasi_id = $row['lokasi_id'];
                    $status_pembelian = $row['status_pembelian'];
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

              <form method="POST" action="pembelian_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_pembelian; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo $tanggal_pembelian; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="vendor_id">Vendor</label>
                    <select id="vendor_id" name="vendor_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT nama as 'nama_vendor', id as 'id_vendor' FROM vendor";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_vendor = $row['nama_vendor'];
                          $id_vendor = $row['id_vendor'];
                          if($vendor_id == $id_vendor)
                          {
                            ?>
                            <option value="<?php echo $id_vendor; ?>" selected><?php echo $nama_vendor; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_vendor; ?>"><?php echo $nama_vendor; ?></option>
                            <?php
                          }
                        }
                      ?>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#vendor_id').select2({
                              placeholder: "Pilih Vendor"
                            });
                         });
                      </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="down_payment">Payment</label>
                    <select id="down_payment_choice" name="down_payment_choice" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" onchange="down_payment_change()">
                      <?php
                        if($down_payment_perform_invoice == "")
                        {
                          ?>
                            <option value="NULL" selected>Cash</option>
                            <option value="30">DP 30%</option>
                            <option value="50">DP 50%</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($down_payment_perform_invoice == "30")
                        {
                          ?>
                          <option value="NULL">Cash</option>
                          <option value="30" selected>DP 30%</option>
                          <option value="50">DP 50%</option>
                          <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($down_payment_perform_invoice == "50")
                        {
                          ?>
                          <option value="NULL">Cash</option>
                          <option value="30">DP 30%</option>
                          <option value="50" selected>DP 50%</option>
                          <option value="other">Lainnya</option>
                          <?php
                        }
                        else
                        {
                          ?>
                          <option value="NULL">Cash</option>
                          <option value="30">DP 30%</option>
                          <option value="50">DP 50%</option>
                          <option value="other" selected>Lainnya</option>
                          <?php
                        }
                      ?>
                    </select>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-user mt-2" id="down_payment" name="down_payment" value="<?php echo $down_payment_perform_invoice; ?>" min="0" <?php echo $readonly; ?> style="display: none;" placeholder="Cth: 70">
                    </div>
                </div>
                <div class="form-group">
                    <label for="termin_choice">Termin</label>
                    <select id="termin_choice" name="termin_choice" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>; display: none;" onchange="termin_choice_change()">
                      <?php
                        if($termin_perform_invoice == "14")
                        {
                          ?>
                            <option value="14" selected>14 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="40">40 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($termin_perform_invoice == "30")
                        {
                          ?>
                            <option value="14">14 Hari</option>
                            <option value="30" selected>30 Hari</option>
                            <option value="40">40 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($termin_perform_invoice == "30")
                        {
                          ?>
                            <option value="14">14 Hari</option>
                            <option value="30" selected>30 Hari</option>
                            <option value="40">40 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($termin_perform_invoice == "40")
                        {
                          ?>
                            <option value="14">14 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="40" selected>40 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else if($termin_perform_invoice == "45")
                        {
                          ?>
                            <option value="14">14 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="40">40 Hari</option>
                            <option value="45" selected>45 Hari</option>
                            <option value="other">Lainnya</option>
                          <?php
                        }
                        else
                        {
                          ?>
                            <option value="14">14 Hari</option>
                            <option value="30">30 Hari</option>
                            <option value="40">40 Hari</option>
                            <option value="45">45 Hari</option>
                            <option value="other" selected>Lainnya</option>
                          <?php
                        }
                      ?>
                    </select>
                    <input type="number" class="form-control form-control-user mt-2" id="termin" name="termin" value="<?php echo $termin_perform_invoice; ?>" min="1" <?php echo $readonly; ?> style="display: none;" placeholder="Cth: 60">
                </div>
                <div class="form-group">
                    <label for="pajak">Pajak</label>
                    <div class="input-group mb-3">
                      <input type="any" class="form-control form-control-user" id="pajak" name="pajak" value="<?php echo $pajak_pembelian; ?>" min="0" step="0.01" required <?php echo $readonly; ?>>
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lokasi_id">Lokasi Gudang</label>
                    <select id="lokasi_id" name="lokasi_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <option value="">Pilih salah satu</option>
                      <?php
                        $sql = "SELECT nama as 'nama_lokasi', id as 'id_lokasi' FROM lokasi";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_lokasi = $row['nama_lokasi'];
                          $id_lokasi = $row['id_lokasi'];
                          if($lokasi_id == $id_lokasi)
                          {
                            ?>
                            <option value="<?php echo $id_lokasi; ?>" selected><?php echo $nama_lokasi; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_lokasi; ?>"><?php echo $nama_lokasi; ?></option>
                            <?php
                          }
                        }
                      ?>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#lokasi_id').select2({
                              placeholder: "Pilih Lokasi"
                            });
                         });
                      </script>
                    </select>
                </div>
                <!--
                <div class="form-group">
                    <label for="terms_conditions_id">Terms and Conditions</label>
                    <select id="terms_conditions_id" name="terms_conditions_id" class="form-control" <?php //echo $readonly; ?> style="pointer-events: <?php //echo $pointer_events; ?>">
                      <option value="">Pilih salah satu</option>
                      <?php
                      /*
                        $sql = "SELECT nama as 'nama_terms_conditions', id as 'id_terms_conditions' FROM terms_conditions";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_terms_conditions = $row['nama_terms_conditions'];
                          $id_terms_conditions = $row['id_terms_conditions'];
                          if($terms_conditions_id == $id_terms_conditions)
                          {
                            ?>
                            <option value="<?php echo $id_terms_conditions; ?>" selected><?php echo $nama_terms_conditions; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_terms_conditions; ?>"><?php echo $nama_terms_conditions; ?></option>
                            <?php
                          }
                        }
                        */
                      ?>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                      <script type="text/javascript">
                      /*
                          $(document).ready(function(){
                            $('#terms_conditions_id').select2({
                              placeholder: "Pilih Terms Conditions"
                            });
                         });
                        */
                      </script>
                    </select>
                </div>
                -->
                <!--
                <div class="form-group">
                  <label for="gambar">Status</label>
                  <select id="status" name="status" class="form-control" required <?php // echo $readonly; ?> style="pointer-events: <?php // echo $pointer_events; ?>">
                    <?php
                    /*
                      if($status_pembelian == "aktif")
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="bayar">Bayar</option>
                          <option value="lunas">Lunas</option>
                        <?php
                      }
                      else if($status_pembelian == "bayar")
                      {
                        ?>
                          <option value="aktif">Aktif</option>
                          <option value="bayar" selected>Bayar</option>
                          <option value="lunas">Lunas</option>
                        <?php
                      }
                      else if($status_pembelian == "lunas")
                      {
                        ?>
                          <option value="aktif">Aktif</option>
                          <option value="bayar">Bayar</option>
                          <option value="lunas" selected>Lunas</option>
                        <?php
                      }
                      else
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="bayar">Bayar</option>
                          <option value="lunas">Lunas</option>
                        <?php
                      }
                    */
                    ?>
                  </select>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                  <script type="text/javascript">
                      $(document).ready(function(){
                        $('#status').select2({
                          placeholder: "Pilih Status"
                        });
                     });
                  </script>
                </div>
                -->
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

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(document).ready(function () {
    $("#tanggal").datepicker({ dateFormat: "yy-mm-dd" });
    down_payment_change();
  });

  var termin_choice;
  var down_payment_choice;
  function down_payment_change()
  {
    down_payment_choice = document.getElementById("down_payment_choice").value;
    if(down_payment_choice == "NULL")
    {
      down_payment_choice = "";
      document.getElementById("termin").value = "";
      document.getElementById("termin_choice").style.display = "none";
      document.getElementById("down_payment").style.display = "none";
      document.getElementById("termin").style.display = "none";
    }
    else if(down_payment_choice == "other")
    {
      down_payment_choice = "";
      document.getElementById("down_payment").value = down_payment_choice;
      document.getElementById("down_payment").style.display = "block";
      document.getElementById("termin_choice").style.display = "block";
      if(document.getElementById("termin_choice").value == "other")
      {
        document.getElementById("termin").style.display = "block";
      }
      else
      {
        document.getElementById("termin").style.display = "none";
      }
    }
    else
    {
      document.getElementById("down_payment").style.display = "none";
      document.getElementById("termin_choice").style.display = "block";
      document.getElementById("down_payment").value = down_payment_choice;
      if(document.getElementById("termin_choice").value == "other")
      {
        document.getElementById("termin").style.display = "block";
      }
      else
      {
        document.getElementById("termin").style.display = "none";
      }
    }
  }
  function termin_choice_change()
  {
    termin_choice = document.getElementById("termin_choice").value;
    if(termin_choice == "other")
    {
      termin_choice = "";
      document.getElementById("termin").value = termin_choice;
      document.getElementById("termin").style.display = "block";
    }
    else
    {
      document.getElementById("termin").style.display = "none";
      document.getElementById("termin").value = termin_choice;
    }
  }
  </script>
</body>

</html>
