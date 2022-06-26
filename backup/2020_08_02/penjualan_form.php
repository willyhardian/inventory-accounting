<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App - Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
  #customer2{
    display: none;
}

#customer3{
    display: none;
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
          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Sales Quotation Form</h1>
            <div class="col-lg-12">
            <div class="card shadow mb-4">


              <div class="card-body">

                <!-- Circle Buttons (Default) -->
                <div class="card-body col text-center">
                  <form method="POST" action="penjualan_process.php?action=<?php echo $_GET['action']; ?>">
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
                          $id_pebelian = $row['id'];
                          $nama_penjualan = $row['nama'];
                          $phone_penjualan = $row['phone'];
                          $email_penjualan = $row['email'];
                          $organization_penjualan = $row['pelanggan_info_id'];
                        }
                        else if($_GET['action'] == "delete")
                        {
                          $btn = "Delete";
                          $btn_class_bootstrap = "btn-danger";
                          $id = $_GET['id'];
                          $sql = "SELECT * FROM pelanggan WHERE id = $id";
                          $query = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_array($query);
                          $id_penjualan = $row['id'];
                          $nama_penjualan = $row['nama'];
                          $phone_penjualan = $row['phone'];
                          $email_penjualan = $row['email'];
                          $organization_penjualan = $row['pelanggan_info_id'];
                          $readonly = "readonly";
                        }
                        else
                        {
                          $btn = "Submit";
                          $btn_class_bootstrap = "btn-primary";
                        }
                      }
                    ?>
                    <input type="hidden" name="id" id="id" value="<?php echo $id_penjualan; ?>">

                    <div class="row">

                    <div class="form-group col" style="padding-bottom: 10px;">
                      <label for="pilihcustomer">Pilih pelanggan</label>
                        <select id="customers" class="form-control" <?php echo $readonly; ?> >
                          <option selected disabled hidden>Choose here</option>
                          <option value="2">Person</option>
                          <option value="3">Organization</option>
                        </select>
                      </div>


                      <div class="form-group col">
                      <label for="termin">Termin</label>
                        <select id= "termin" name="termin" class="form-control" <?php echo $readonly; ?> value="<?php echo $termin_penjualan; ?>">
                          <option value="cash">Cash</option>
                          <option value="dptempo">Dp-Tempo</option>
                          <option value="dplunas">Dp-Lunas</option>
                          <option value="tempo">Tempo</option>
                        </select>
                      </div>


                      <div class="form-group col">
                      <label for="termcondition">Terms & Conditions</label>
                        <select id="myselection" name="tc[]" multiple="multiple" class="form-control" <?php echo $readonly; ?> value="<?php echo $tc_penjualan; ?>">
                          <option>
                            <?php
                            include 'config.php';


                            $sql = "select * from terms_conditions order by nama ASC";
                            $rs = mysqli_query($conn,$sql);
                            while($rows = mysqli_fetch_assoc($rs))
                            {
                              echo '<option value="'.$rows['id'].'">'.$rows['nama'].'</option>';
                            }
                            ?>
                          </option>

                        </select>
                      </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-3" >
                    <select id="customer2" name="person" class="form-control" <?php echo $readonly; ?> value="<?php echo $person_penjualan; ?>">
                      <option>
                    <?php
                    include 'config.php';

                    echo'<option selected disabled hidden>Pilih Person</option>';
                    $sql = "select * from pelanggan order by nama ASC";
                    $rs = mysqli_query($conn,$sql);
                    while($rows = mysqli_fetch_assoc($rs))
                    {
                      echo '<option value="'.$rows['id'].'">'.$rows['nama'].'</option>';
                    }
                    ?>
                  </option>
                    </select>
                  </div>


                    <div class="form-group col-3" style="margin-left: -260px; margin-top: 50px;">
                    <select id="customer3" name="organization" class="form-control" <?php echo $readonly; ?> value="<?php echo $organization_penjualan; ?>">
                    <option>
                      <?php
                      include 'config.php';

                      echo'<option selected disabled hidden> Pilih Organization </option>';
                      $sql = "select * from pelanggan_info order by nama_org ASC";
                      $rs = mysqli_query($conn,$sql);
                      while($rows = mysqli_fetch_assoc($rs))
                      {
                        echo '<option value="'.$rows['id'].'">'.$rows['nama_org'].'</option>';
                      }
                      ?>
                    </option>

                    </select>
                    <script   src="https://code.jquery.com/jquery-3.5.1.min.js"   integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="   crossorigin="anonymous"></script>
                    <script>

                    $("#customers").change(function(){
                      if($(this).val() == 2){
                        $("#customer2").show();
                      }else{
                        $("#customer2").hide();
                      }

                    });


                    $("#customers").change(function(){
                      if($(this).val() == 3){
                        $("#customer3").show();
                      }else{
                        $("#customer3").hide();
                      }

                    });
                    </script>
                  </div>


                  <div class="form-group col-4" style="margin-left: 85px;">
                    <label for="rekening"> Rekening </label>
                  <select id="rekening" name="rekening" class="form-control" <?php echo $readonly; ?> value="<?php echo $rekening_penjualan; ?>">
                  <option>
                    <?php
                    include 'config.php';

                    echo'<option selected disabled hidden> Pilih Rekening </option>';
                    $sql = "select * from rekening order by nama_rekening ASC";
                    $rs = mysqli_query($conn,$sql);
                    while($rows = mysqli_fetch_assoc($rs))
                    {
                      echo '<option value="'.$rows['id'].'">'.$rows['nama_rekening'].'</option>';
                    }
                    ?>
                  </option>

                  </select>

                </div>
                <div class="form-group col-4">
                <label for="status">Status</label>
                  <select id= "status" name="status" class="form-control" disabled <?php echo $readonly; ?> value="<?php echo $status_penjualan; ?>">
                    <option value="sq">Sales Quotation</option>
                    <option value="pi">Proforma Invoice</option>
                    <option value="inv">Invoice</option>
                  </select>
                </div>
              </div>
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
                </script>


                <script type="text/javascript">
                    $(document).ready(function() {
                $('#myselection').select2();
                   });
                  </script>

                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk</h6>

                  <div id="add_fields">

                    <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="produk" name="produk[]" value="<?php echo $produk_penjualan; ?>" placeholder="Produk" required <?php echo $readonly; ?>>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <input type="text" class="form-control" id="diskon" name="diskon[]" value="<?php echo $diskon_penjualan; ?>" placeholder="Diskon" required <?php echo $readonly; ?>>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <input type="text" class="form-control" id="qty" name="qty[]" value="<?php echo $qty_penjualan; ?>" placeholder="Quantity" required <?php echo $readonly; ?>>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">

                        <div class="input-group-btn">
                          <button class="btn btn-success btn-icon-split" type="button"  onclick="add_fields();">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>

                    </div>
                    <script>
                    var room = 1;
                    function add_fields() {

                        room++;
                        var objTo = document.getElementById('add_fields')
                        var divtest = document.createElement("div");
                      divtest.setAttribute("class", "form-group removeclass"+room);
                      var rdiv = 'removeclass'+room;
                        divtest.innerHTML = '<div class="row"><div class="col-sm-6 "><div class="form-group"> <input type="text" class="form-control" id="produk" name="Produk[]" value="" placeholder="Produk"></div></div><div class="col-sm-2 "><div class="form-group"> <input type="text" class="form-control" id="diskon" name="Diskon[]" value="" placeholder="Diskon"></div></div><div class="col-sm-2 "><div class="form-group"> <input type="text" class="form-control" id="qty" name="Quatitu[]" value="" placeholder="Quantity"></div></div><div class="col-sm-2 "><div class="form-group"><div class="input-group"> <div class="input-group-btn"> <button class="btn btn-danger btn-icon-split" type="button" onclick="remove_education_fields('+ room +');"> <span class="icon text-white-50"><i class="fas fa-minus"></i></span> </button></div></div></div></div><div class="clear"></div></div>';

                        objTo.appendChild(divtest)
                    }
                       function remove_education_fields(rid) {
                         $('.removeclass'+rid).remove();
                       }
                    </script>
                    </div>
                    <div class="form-group col-4" style="margin-left: 750px; padding-top:50px;">
                    <label for="hargaongkir">Harga Ongkir</label>
                      <input type="text" class="form-group" id="hargaongkir" name="hargaongkir" value="<?php echo $ongkir_pemeblian; ?>" placeholder="Masukan ongkir" <?php echo $readonly; ?>>
                    </div>
                    <div class="form-group col-4" style="margin-left: 800px;">
                    <label for="pajak">Pajak</label>
                      <input type="checkbox" class="form-group" id="pajak" name="pajak" value="<?php echo $pajak_penjualan; ?>" <?php echo $readonly; ?>>
                      <small>Jika harga termasuk pajak centang</small>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="<?php echo $btn; ?>" class="btn btn-user btn-block <?php echo $btn_class_bootstrap; ?>">
                    </div>

      </form>

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
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
