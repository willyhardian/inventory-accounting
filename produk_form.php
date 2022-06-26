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

  <title>Produk</title>

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
              <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
              <li class="breadcrumb-item active" aria-current="page">Produk Form</li>
            </ol>
          </nav>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-6">
              <?php
                $btn = "";
                $btn_class_bootstrap = "";
                $id_produk = "";
                $item_id_produk = "";
                $harga_produk = "";
                $jenis_id_produk = "";
                $warna_id_produk = "";
                $kategori_id_produk = "";
                $merek_id_produk = "";
                $diameter_produk = "";
                $satuan_diameter_produk = "";
                $panjang_produk = "";
                $satuan_panjang_produk = "";
                $minimum_order_produk = "";
                $satuan_id_produk = "";
                $status_produk = "";
                $readonly = "";
                $pointer_events = "auto";
                if(isset($_GET['action']))
                {
                  if($_GET['action'] == "edit")
                  {
                    $btn = "Update";
                    $btn_class_bootstrap = "btn-warning";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM produk WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_produk = $row['id'];
                    $item_id_produk = $row['item_id'];
                    $harga_produk = $row['harga'];
                    $jenis_id_produk = $row['jenis_id'];
                    $warna_id_produk = $row['warna_id'];
                    $kategori_id_produk = $row['kategori_id'];
                    $merek_id_produk = $row['merek_id'];
                    $diameter_produk = $row['diameter'];
                    $satuan_diameter_produk = $row['satuan_diameter'];
                    $panjang_produk = $row['panjang'];
                    $satuan_panjang_produk = $row['satuan_panjang'];
                    $minimum_order_produk = $row['minimum_order'];
                    $satuan_id_produk = $row['satuan_id'];
                    $status_produk = $row['status'];
                  }
                  else if($_GET['action'] == "delete")
                  {
                    $btn = "Delete";
                    $btn_class_bootstrap = "btn-danger";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM produk WHERE id = $id";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $id_produk = $row['id'];
                    $item_id_produk = $row['item_id'];
                    $harga_produk = $row['harga'];
                    $jenis_id_produk = $row['jenis_id'];
                    $warna_id_produk = $row['warna_id'];
                    $kategori_id_produk = $row['kategori_id'];
                    $merek_id_produk = $row['merek_id'];
                    $diameter_produk = $row['diameter'];
                    $satuan_diameter_produk = $row['satuan_diameter'];
                    $panjang_produk = $row['panjang'];
                    $satuan_panjang_produk = $row['satuan_panjang'];
                    $minimum_order_produk = $row['minimum_order'];
                    $satuan_id_produk = $row['satuan_id'];
                    $status_produk = $row['status'];
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

              <form method="POST" enctype="multipart/form-data" action="produk_process.php?action=<?php echo $_GET['action']; ?>">
                <!-- Hidden ID for Update -->
                <input type="hidden" name="id" id="id" value="<?php echo $id_produk; ?>">
                <!-- End of Hidden ID for Update -->

                <div class="form-group">
                    <label for="item_id">Item</label>
                    <select id="item_id" name="item_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT nama as 'nama_item', id as 'id_item' FROM item";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_item = $row['nama_item'];
                          $id_item = $row['id_item'];
                          if($item_id_produk == $id_item)
                          {
                            ?>
                            <option value="<?php echo $id_item; ?>" selected><?php echo $nama_item; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_item; ?>"><?php echo $nama_item; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                      </script>


                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#item_id').select2({
                        placeholder: "Pilih Nama Item"
                      });
                         });
                        </script>
                    </select>
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga_produk; ?>" <?php echo $readonly; ?>>
                  </div>
                </div>
                <div class="form-group">
                    <label for="jenis_id">Jenis-Standard-Tipe</label>
                    <select id="jenis_id" name="jenis_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT jenis.nama as 'nama_jenis', standard.nama AS 'standard_nama', tipe.nama AS 'tipe_nama', jenis.id as 'id_jenis' FROM jenis LEFT JOIN standard ON jenis.id = standard.jenis_id LEFT JOIN tipe ON standard.id = tipe.standard_id ORDER BY jenis.id";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_jenis = $row['nama_jenis'];
                          $standard_nama = $row['standard_nama'];
                          if($standard_nama == "")
                          {
                            $standard_nama = " ";
                          }
                          $tipe_nama = $row['tipe_nama'];
                          if($tipe_nama == "")
                          {
                            $tipe_nama = " ";
                          }
                          $id_jenis = $row['id_jenis'];
                          if($jenis_id_produk == $id_jenis)
                          {
                            ?>
                            <option value="<?php echo $id_jenis; ?>" selected><?php echo $id_jenis . "-" . $nama_jenis . "-" . $standard_nama . "-" . $tipe_nama; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_jenis; ?>"><?php echo $id_jenis . "-" . $nama_jenis . "-" . $standard_nama . "-" . $tipe_nama; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#jenis_id').select2({
                        placeholder: "Pilih Jenis-Standard-Tipe"
                      });
                         });
                        </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warna_id">Warna</label>
                    <select id="warna_id" name="warna_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php

                        $sql = "SELECT nama as 'nama_warna', id as 'id_warna' FROM warna";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_warna = $row['nama_warna'];
                          $id_warna = $row['id_warna'];
                          if($warna_id_produk == $id_warna)
                          {
                            ?>
                            <option value="<?php echo $id_warna; ?>" selected><?php echo $nama_warna; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_warna; ?>"><?php echo $nama_warna; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      </script>


                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#warna_id').select2({
                        placeholder: "Pilih Warna"
                      });
                         });
                        </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT nama as 'nama_kategori', id as 'id_kategori' FROM kategori";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_kategori = $row['nama_kategori'];
                          $id_kategori = $row['id_kategori'];
                          if($kategori_id_produk == $id_kategori)
                          {
                            ?>
                            <option value="<?php echo $id_kategori; ?>" selected><?php echo $nama_kategori; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_kategori; ?>"><?php echo $nama_kategori; ?></option>
                            <?php
                          }
                        }
                      ?>
                      </option>
                    </select>

                    </script>


                    <script type="text/javascript">
                        $(document).ready(function() {
                    $('#kategori_id').select2({
                      placeholder: "Pilih Kategori"
                    });
                       });
                      </script>
                </div>
                <div class="form-group">
                    <label for="merek_id">Merek</label>
                    <select id="merek_id" name="merek_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php

                        $sql = "SELECT nama as 'nama_merek', id as 'id_merek' FROM merek";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_merek = $row['nama_merek'];
                          $id_merek = $row['id_merek'];
                          if($merek_id_produk == $id_merek)
                          {
                            ?>
                            <option value="<?php echo $id_merek; ?>" selected><?php echo $nama_merek; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_merek; ?>"><?php echo $nama_merek; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      </script>


                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#merek_id').select2({
                        placeholder: "Pilih Merek"
                      });
                         });
                        </script>
                    </select>
                </div>

                <div class="form-group">
                    <label for="diameter">Diameter</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="diameter" name="diameter" step="0.01" value="<?php echo $diameter_produk; ?>" minlength="0" <?php echo $readonly; ?>>
                    </div>
                </div>

                <div class="form-group">
                    <label for="satuan_diameter">Satuan Diameter</label>
                    <input type="text" class="form-control" id="satuan_diameter" name="satuan_diameter" value="<?php echo $satuan_diameter_produk; ?>" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="panjang">Panjang</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="panjang" name="panjang" step="0.01" value="<?php echo $panjang_produk; ?>" minlength="0" <?php echo $readonly; ?>>                      
                    </div>
                </div>
                <div class="form-group">
                    <label for="satuan_diameter">Satuan Panjang</label>
                    <input type="text" class="form-control" id="satuan_panjang" name="satuan_panjang" value="<?php echo $satuan_panjang_produk; ?>" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="satuan_id">Satuan Berat</label>
                    <select id="satuan_id" name="satuan_id" class="form-control" <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>" required>
                      <option>
                      <?php
                        $sql = "SELECT nama as 'nama_satuan', id as 'id_satuan' FROM satuan";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($query))
                        {
                          $nama_satuan = $row['nama_satuan'];
                          $id_satuan = $row['id_satuan'];
                          if($satuan_id_produk == $id_satuan)
                          {
                            ?>
                            <option value="<?php echo $id_satuan; ?>" selected><?php echo $nama_satuan; ?></option>
                            <?php
                          }
                          else
                          {
                            ?>
                            <option value="<?php echo $id_satuan; ?>"><?php echo $nama_satuan; ?></option>
                            <?php
                          }
                        }
                      ?>
                    </option>
                      <script type="text/javascript">
                          $(document).ready(function() {
                      $('#satuan_id').select2({
                        placeholder: "Pilih Satuan"
                      });
                         });
                        </script>
                    </select>
                </div>
                <div class="form-group">
                    <label for="panjang">Minimum Order</label>
                    <input type="number" class="form-control" id="minimum_order" name="minimum_order" value="<?php echo $minimum_order_produk; ?>" minlength="0" required <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" <?php echo $readonly; ?>  style="pointer-events: <?php echo $pointer_events; ?>">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" class="form-control" required <?php echo $readonly; ?> style="pointer-events: <?php echo $pointer_events; ?>">
                    <?php
                      if($status_produk == "aktif")
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="arsip">Arsip</option>
                        <?php
                      }
                      else if($status_produk == "arsip")
                      {
                        ?>
                          <option value="aktif">Aktif</option>
                          <option value="arsip" selected>Arsip</option>
                        <?php
                      }
                      else
                      {
                        ?>
                          <option value="aktif" selected>Aktif</option>
                          <option value="arsip">Arsip</option>
                        <?php
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
