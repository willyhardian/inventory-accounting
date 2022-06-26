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

  <title>Pembelian Detail</title>

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
              <li class="breadcrumb-item"><a href="pembelian.php">Pembelian</a></li>
              <li class="breadcrumb-item"><a href="pembelian_detail.php?pembelian_id=<?php echo $pembelian_id; ?>">Pembelian Detail</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pembelian Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pembelian Detail</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_pembelian_detail = "";
                $produk_id = "";
                $harga_beli_pembelian_detail = "";
                $qty_pembelian_detail = "";
                $qty_pembelian_diskon = "";
                $status_pembelian_detail = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT pembelian_detail.id AS 'id_pembelian_detail', pembelian_detail.produk_id AS 'produk_id', pembelian_detail.harga_beli AS 'harga_beli_pembelian_detail', pembelian_detail.qty AS 'qty_pembelian_detail', pembelian_detail.diskon AS 'diskon_pembelian_detail', pembelian_detail.status AS 'status_pembelian_detail' FROM pembelian_detail INNER JOIN pembelian ON pembelian_detail.pembelian_id = pembelian.id INNER JOIN produk on pembelian_detail.produk_id = produk.id WHERE pembelian_detail.id = '$id'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_pembelian_detail = $row['id_pembelian_detail'];
                    $produk_id = $row['produk_id'];
                    $harga_beli_pembelian_detail = $row['harga_beli_pembelian_detail'];
                    $qty_pembelian_detail = $row['qty_pembelian_detail'];
                    $diskon_pembelian_detail = $row['diskon_pembelian_detail'];
                    $status_pembelian_detail = $row['status_pembelian_detail'];
                    if($_SESSION['role'] == 5)
                    {
                      $readonly = "readonly";
                    }
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT pembelian_detail.id AS 'id_pembelian_detail', pembelian_detail.produk_id AS 'produk_id', pembelian_detail.harga_beli AS 'harga_beli_pembelian_detail', pembelian_detail.qty AS 'qty_pembelian_detail', pembelian_detail.diskon AS 'diskon_pembelian_detail', pembelian_detail.status AS 'status_pembelian_detail' FROM pembelian_detail INNER JOIN pembelian ON pembelian_detail.pembelian_id = pembelian.id INNER JOIN produk on pembelian_detail.produk_id = produk.id WHERE pembelian_detail.id = '$id'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_pembelian_detail = $row['id_pembelian_detail'];
                    $produk_id = $row['produk_id'];
                    $harga_beli_pembelian_detail = $row['harga_beli_pembelian_detail'];
                    $qty_pembelian_detail = $row['qty_pembelian_detail'];
                    $diskon_pembelian_detail = $row['diskon_pembelian_detail'];
                    $status_pembelian_detail = $row['status_pembelian_detail'];
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_pembelian_detail = $row['id_pembelian_detail'];
                    $produk_id = $row['produk_id'];
                    $harga_beli_pembelian_detail = $row['harga_beli_pembelian_detail'];
                    $qty_pembelian_detail = $row['qty_pembelian_detail'];
                    $diskon_pembelian_detail = $row['diskon_pembelian_detail'];
                    $status_pembelian_detail = $row['status_pembelian_detail'];
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

              <form method="POST" action="pembelian_detail_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_pembelian_detail; ?>">
                <!-- End of Hidden ID for Update -->
                <div class="form-group">
                    <label for="pembelian_id">ID Pembelian</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">PB</span>
                      </div>
                      <input type="text" class="form-control form-control-user" id="pembelian_id" name="pembelian_id" value="<?php echo $pembelian_id; ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="produk_id">Produk</label>
                    <select id="produk_id" name="produk_id" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                      <?php
                        $sql = "SELECT produk.id as 'id_produk', item.nama AS 'item_nama', produk.harga AS 'harga_produk', jenis.nama AS 'jenis_nama', concat_ws(' ',item.nama, jenis.nama, merek.nama, standard.nama, kategori.nama, warna.nama, concat('dia. ',produk.diameter), concat('@', produk.panjang, 'cm/', satuan.nama)) as produk_nama, produk.harga, jenis.nama AS jenis, warna.nama AS warna, kategori.nama AS kategori, produk.diameter, produk.panjang, merek.nama AS merek, satuan.nama AS satuan_nama, produk.gambar AS gambar FROM produk LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN standard ON standard.jenis_id = jenis.id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN merek ON produk.merek_id = merek.id";
                        $query = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_array($query))
                        {
                          $id_produk = $row['id_produk'];
                          $item_nama = $row['item_nama'];
                          $harga_produk = $row['harga_produk'];
                          $jenis_nama = $row['jenis_nama'];
                          $produk_nama = $row['produk_nama'];
                          if($produk_id == $id_produk)
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>" selected><?php echo $produk_nama; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_produk; ?>"><?php echo $produk_nama; ?></option>
                            <?php
                          }
                        }
                      ?>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#produk_id').select2({
                              placeholder: "Pilih Produk"
                            });
                         });
                      </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="number" class="form-control form-control-user" id="harga_beli" name="harga_beli" value="<?php echo $harga_beli_pembelian_detail; ?>" min="0" <?php echo $readonly; ?> required>
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" class="form-control form-control-user" id="qty" name="qty" value="<?php echo $qty_pembelian_detail; ?>" min="0" <?php echo $readonly; ?> required>
                </div>
                <div class="form-group">
                    <label for="diskon">Diskon</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-user" id="diskon" name="diskon" value="<?php echo $diskon_pembelian_detail; ?>" min="0" <?php echo $readonly; ?>>
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <?php
                    if($status_pembelian_detail == "selesai")
                    {
                  ?>
                      <small class="form-text text-muted">Status Sales Quotation produk telah selesai</small>
                      <input type="hidden" name="status" value="">
                  <?php
                    }
                    else
                    {
                      ?>
                      <select id="status" name="status" class="form-control" onchange="status_change()" required
                        <?php
                          if($_SESSION['role'] != 5)
                          {
                            echo $readonly;
                          }
                        ?>
                        style="pointer-events: <?php echo $pointer_events; ?>">
                        <?php
                          if($status_pembelian_detail == "aktif")
                          {
                            ?>
                              <option value="aktif" selected>Aktif</option>
                              <option value="selesai">Selesai</option>
                            <?php
                          }
                          else if($status_pembelian_detail == "selesai")
                          {
                            ?>
                              <option value="aktif">Aktif</option>
                              <option value="selesai" selected>Selesai</option>
                            <?php
                          }
                          else
                          {
                            ?>
                              <option value="aktif" selected>Aktif</option>
                              <option value="selesai">Selesai</option>
                            <?php
                          }

                        ?>
                      </select>
                      <?php
                    }
                  ?>
                  <small class="form-text text-muted">Aktif = Barang belum diterima, Selesai = barang sudah diterima</small>
                </div>
                <div class="form-group" id="tanggal_box" style="display: none;">
                    <label for="nama">Tanggal</label>
                    <input type="text" class="form-control form-control-user" id="tanggal" name="tanggal" autocomplete="off" value=""
                    <?php
                      if($_SESSION['role'] != 5)
                      {
                        echo $readonly;
                      }
                    ?>>
                    <small>tahun-bulan-tanggal</small>
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
  });
  function status_change()
  {
    status_choice = document.getElementById("status").value;
    if(status_choice == "selesai")
    {
      document.getElementById("tanggal_box").style.display = "block";
    }
    else
    {
      document.getElementById("tanggal_box").style.display = "none";
    }
  }
  </script>

</body>

</html>
