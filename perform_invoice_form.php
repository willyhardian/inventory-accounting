<?php include "security.php"; ?>
<?php include "config.php";
  if(isset($_GET['sales_quotation_id']))
  {
      $sales_quotation_id = $_GET['sales_quotation_id'];
  }
  else
  {
      $sales_quotation_id = 0;
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

  <title>Perform Invoice</title>

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
              <li class="breadcrumb-item"><a href="sales_quotation.php">SQ</a></li>
              <li class="breadcrumb-item"><a href="perform_invoice.php">PI</a></li>
              <li class="breadcrumb-item active" aria-current="page">PI Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Perform Invoice</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_perform_invoice = "";
                $id_sales_quotation = "";
                $tanggal_perform_invoice = "";
                $purchase_order_pelanggan_id = "";
                $termin_perform_invoice= "";
                $down_payment_perform_invoice = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT perform_invoice.id AS 'id_perform_invoice', sales_quotation.id AS 'id_sales_quotation', perform_invoice.tanggal AS 'tanggal_perform_invoice', perform_invoice.purchase_order_pelanggan_id AS 'purchase_order_pelanggan_id_perform_invoice',
                    perform_invoice.termin AS 'termin_perform_invoice', perform_invoice.down_payment AS 'down_payment_perform_invoice',  perform_invoice.updated_at AS 'updated_at_perform_invoice', perform_invoice.created_at AS 'created_at_perform_invoice' FROM perform_invoice INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id WHERE perform_invoice.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_perform_invoice = $row['id_perform_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    $tanggal_perform_invoice = $row['tanggal_perform_invoice'];
                    $purchase_order_pelanggan_id = $row['purchase_order_pelanggan_id_perform_invoice'];
                    $termin_perform_invoice= $row['termin_perform_invoice'];
                    $down_payment_perform_invoice = $row['down_payment_perform_invoice'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT perform_invoice.id AS 'id_perform_invoice', sales_quotation.id AS 'id_sales_quotation', perform_invoice.tanggal AS 'tanggal_perform_invoice', perform_invoice.purchase_order_pelanggan_id AS 'purchase_order_pelanggan_id_perform_invoice',
                    perform_invoice.termin AS 'termin_perform_invoice', perform_invoice.down_payment AS 'down_payment_perform_invoice',  perform_invoice.updated_at AS 'updated_at_perform_invoice', perform_invoice.created_at AS 'created_at_perform_invoice' FROM perform_invoice INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id WHERE perform_invoice.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_perform_invoice = $row['id_perform_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    $tanggal_perform_invoice = $row['tanggal_perform_invoice'];
                    $purchase_order_pelanggan_id = $row['purchase_order_pelanggan_id_perform_invoice'];
                    $termin_perform_invoice= $row['termin_perform_invoice'];
                    $down_payment_perform_invoice = $row['down_payment_perform_invoice'];
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

              <form method="POST" action="perform_invoice_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="sales_quotation_id">ID Sales Quotation</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">SQ</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="sales_quotation_id" name="sales_quotation_id" value="<?php echo $sales_quotation_id; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" value="<?php echo $tanggal_perform_invoice; ?>" <?php echo $readonly; ?> required>
                    <small>tahun-bulan-tanggal</small>
                </div>
                <div class="form-group">
                    <label for="purchase_order_pelanggan_id">NO PO Pelanggan</label>
                    <select id="purchase_order_pelanggan_id" name="purchase_order_pelanggan_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <option value="NULL">---Tidak ada---</option>
                      <option>
                        <?php
                          $sql = "SELECT no_po_pelanggan as 'no_po_pelanggan', id as 'id_purchase_order_pelanggan' FROM purchase_order_pelanggan";
                          $query = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_array($query))
                          {
                            $no_po_pelanggan_purchase_order_pelanggan = $row['no_po_pelanggan'];
                            $id_purchase_order_pelanggan = $row['id_purchase_order_pelanggan'];
                            if($purchase_order_pelanggan_id == $id_purchase_order_pelanggan)
                            {
                              ?>
                              <option value="<?php echo $id_purchase_order_pelanggan; ?>" selected><?php echo $id_purchase_order_pelanggan . " - " . $no_po_pelanggan_purchase_order_pelanggan; ?></option>
                              <?php
                            }
                            else
                            {
                              ?>
                              <option value="<?php echo $id_purchase_order_pelanggan; ?>"><?php echo $id_purchase_order_pelanggan . " - " . $no_po_pelanggan_purchase_order_pelanggan; ?></option>
                              <?php
                            }
                          }
                        ?>
                      </option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#purchase_order_pelanggan_id').select2({
                              placeholder: "Pilih NO PO Pelanggan"
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
      document.getElementById("down_payment").value = "";
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
