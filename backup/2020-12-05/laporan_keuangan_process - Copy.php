<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];
  $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
  $query = mysqli_query($conn, $sql);

  $debet = array();
  $kredit = array();
  $kode_akun_5101_debet = 0;
  $kode_akun_5101_kredit = 0;
  $keterangan_5101 = "";
  $kode_akun_5102_debet = 0;
  $kode_akun_5102_kredit = 0;
  $keterangan_5102 = "";
  $kode_akun_5104_debet = 0;
  $kode_akun_5104_kredit = 0;
  $keterangan_5104 = "";
  $kode_akun_1102_debet = 0;
  $kode_akun_1102_kredit = 0;
  $keterangan_1102 = "";
  $kode_akun_1111_debet = 0;
  $kode_akun_1111_kredit = 0;
  $keterangan_1111 = "";
  $kode_akun_2101_debet = 0;
  $kode_akun_2101_kredit = 0;
  $keterangan_2101 = "";
  $kode_akun_2104_debet = 0;
  $kode_akun_2104_kredit = 0;
  $keterangan_2104 = "";
  $kode_akun_2105_debet = 0;
  $kode_akun_2105_kredit = 0;
  $keterangan_2105 = "";
  $kode_akun_4101_debet = 0;
  $kode_akun_4101_kredit = 0;
  $keterangan_4101 = "";
  $kode_akun_4102_debet = 0;
  $kode_akun_4102_kredit = 0;
  $keterangan_4102 = "";
  $kode_akun_4104_debet = 0;
  $kode_akun_4104_kredit = 0;
  $keterangan_4104 = "";
  $debet_buku_besar = 0;
  $kredit_buku_besar = 0;
  $debet_labarugi = 0;
  $kredit_labarugi = 0;
  $debet_neraca = 0;
  $kredit_neraca = 0;

  $kode_akun_1102 = 0;
  $kode_akun_1111 = 0;
  $kode_akun_2101 = 0;
  $kode_akun_2104 = 0;
  $kode_akun_2105 = 0;
  $kode_akun_4101 = 0;
  $kode_akun_4102 = 0;
  $kode_akun_4104 = 0;
  $kode_akun_5101 = 0;
  $kode_akun_5102 = 0;
  $kode_akun_5104 = 0;

  $neraca_debet_total = 0;
  $neraca_kredit_total = 0;

  $kode_akun_4000 = 0;
  $kode_akun_5000 = 0;

  $kode_akun_1102_saldo_awal = 0; $kode_akun_1102_debet_saldo_awal = 0; $kode_akun_1102_kredit_saldo_awal = 0;

  $kode_akun_1111_saldo_awal = 0; $kode_akun_1111_debet_saldo_awal = 0; $kode_akun_1111_kredit_saldo_awal = 0;

  $kode_akun_2101_saldo_awal = 0; $kode_akun_2101_debet_saldo_awal = 0; $kode_akun_2101_kredit_saldo_awal = 0;

  $kode_akun_2104_saldo_awal = 0; $kode_akun_2104_debet_saldo_awal = 0; $kode_akun_2104_kredit_saldo_awal = 0;

  $kode_akun_2105_saldo_awal = 0; $kode_akun_2105_debet_saldo_awal = 0; $kode_akun_2105_kredit_saldo_awal = 0;

  $kode_akun_4101_saldo_awal = 0; $kode_akun_4101_debet_saldo_awal = 0; $kode_akun_4101_kredit_saldo_awal = 0;

  $kode_akun_4102_saldo_awal = 0; $kode_akun_4102_debet_saldo_awal = 0; $kode_akun_4102_kredit_saldo_awal = 0;

  $kode_akun_4104_saldo_awal = 0; $kode_akun_4104_debet_saldo_awal = 0; $kode_akun_4104_kredit_saldo_awal = 0;

  $kode_akun_5101_saldo_awal = 0; $kode_akun_5101_debet_saldo_awal = 0; $kode_akun_5101_kredit_saldo_awal = 0;

  $kode_akun_5102_saldo_awal = 0; $kode_akun_5102_debet_saldo_awal = 0; $kode_akun_5102_kredit_saldo_awal = 0;

  $kode_akun_5104_saldo_awal = 0; $kode_akun_5104_debet_saldo_awal = 0; $kode_akun_5104_kredit_saldo_awal = 0;

  /*
  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();
  */
  ?>
  <?php include "config.php";
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $pembelian_exist = 1;
    $invoice_exist = 1;
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_awal_create = date_create($tanggal_awal);
    date_sub($tanggal_awal_create,date_interval_create_from_date_string("1 days"));
    $tanggal_awal_create_date = date_format($tanggal_awal_create, "Y-m-d");
    /*
    $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    */

    function show_date($data)
    {
      echo date("m/d/Y", strtotime($data));
    }
    function show_period($data1, $data2)
    {
        echo date("m/d/Y", strtotime($data1)) . " - " . date("m/d/Y", strtotime($data2));
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

      <title>Laporan Keuangan</title>
      <link rel="stylesheet" href="css/laporan.css">
    <body>
        <div class="text-center">
          <?php
            $sql_profil_perusahaan = "SELECT * FROM profil_perusahaan";
            $query_profil_perusahaan = mysqli_query($conn, $sql_profil_perusahaan);
            $num_profil_perusahaan = mysqli_num_rows($query_profil_perusahaan);
            if($num_profil_perusahaan > 0)
            {
              $row_profil_perusahaan = mysqli_fetch_array($query_profil_perusahaan);
              ?>
              <img src="<?php echo $row_profil_perusahaan['logo']; ?>" alt="" width="100px" id="logo">
              <h1 id="title-report"><?php echo $row_profil_perusahaan['nama']; ?></h1>
              <p><?php echo $row_profil_perusahaan['alamat']; ?></p>
              <p>Phone : <?php echo $row_profil_perusahaan['no_telepon']; ?> ( Hunting )  Email : <?php echo $row_profil_perusahaan['email']; ?></p>
              <?php
            }
            else
            {
              ?>
              <img src="img/logo.png" alt="" width="100px" id="logo">
              <h1 id="title-report">PT Mitra Tiga Perkasa Indonesia</h1>
              <p>RUKO ALICANTE BLOCK C No. 1 Jl. Boulevard Andalucia Gading Serpong Kel. Medang Kab. Tangerang - Banten 15334</p>
              <p>Phone : +62 21 2222 5352 ( Hunting )  Email : mitratigaperkasa@gmail.com</p>
              <?php
            }

          ?>
        </div>

        <h2 class="text-center">Laporan Keuangan</h2>
        <h4 class="text-center">
          <?php show_period($tanggal_awal, $tanggal_akhir) ?>
        </h4>

        <table class="table mx-auto" style="display: none;"> <!-- Intentionally make this table disapper, so we can focus show ledger (buku besar) table -->
          <thead>
            <tr>
              <th rowspan="2">Tanggal</th>
              <th rowspan="2">ID Transaksi</th>
              <th rowspan="2">Kode Akun</th>
              <th rowspan="2">Nama Akun</th>
              <th rowspan="2">Keterangan</th>
              <th colspan="2">Saldo</th>
            </tr>
            <tr>
              <th>Debit</th>
              <th>Kredit</th>
            </tr>
          </thead>
          <tbody>

            <?php
              /* pembelian section */
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
              $query = mysqli_query($conn, $sql);
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  if($row['pembelian_status_pembayaran_status'] == 'bayar')
                  {

                    ?>
                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td>
                        <?php echo "5104"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                            	echo "Uang Muka Pembelian";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_pembelian = $row['pajak_pembelian'];

                        $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_pembelian = $row_total_diskon['total_diskon'];
                        array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        ?>
                      </td>
                      <td>-</td>
                    </tr>

                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td>
                        <?php echo "1102"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                            	echo "Bank BCA";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td></td>
                      <td>
                        -
                        <?php //echo $row['harga_beban']; ?>
                      </td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_pembelian = $row['pajak_pembelian'];

                        $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_pembelian = $row_total_diskon['total_diskon'];

                        array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                  else if($row['pembelian_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td>
                          <?php echo "5101"; ?>
                          <?php //echo $row['kode_akun_id_beban']; ?>
                        </td>
                        <td>
                          <?php
                              	echo "Pembelian";
                          ?>
                          <?php //echo $row['kode_akun_nama']; ?>
                        </td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            array_push($debet, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                          ?>
                        </td>
                        <td>-</td>
                      </tr>

                    <?php
                      if($row['pajak_pembelian'] > 0)
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                          <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                          <td>
                            <?php echo "2104"; ?>
                            <?php //echo $row['kode_akun_id_beban']; ?>
                          </td>
                          <td>
                            <?php
                                	echo "PPN Masukan";
                            ?>
                            <?php //echo $row['kode_akun_nama']; ?>
                          </td>
                          <td></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              array_push($debet, $row_total_harga['total_harga'] * ($pajak_pembelian / 100));
                              echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_pembelian / 100), 0, ",", ".");
                            ?>
                          </td>
                          <td>-</td>
                        </tr>
                        <?php
                      }
                    ?>

                      <?php
                        $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.diskon / 100) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        if($row_total_diskon['total_diskon'] > 0)
                        {
                          ?>
                          <tr>
                            <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                            <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                            <td>
                              <?php echo "5102"; ?>
                              <?php //echo $row['kode_akun_id_beban']; ?>
                            </td>
                            <td>
                              <?php
                                  	echo "Potongan Pembelian";
                              ?>
                              <?php //echo $row['kode_akun_nama']; ?>
                            </td>
                            <td></td>
                            <td>-</td>
                            <td>
                              <?php
                                $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                                $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                                $pajak_pembelian = $row['pajak_pembelian'];
                                $diskon_pembelian = $row_total_diskon['total_diskon'];
                                array_push($kredit, floatval($diskon_pembelian));
                                echo "Rp " . number_format(floatval($diskon_pembelian), 0, ",", ".");
                              ?>
                              <?php //echo $row['harga_beban']; ?>
                            </td>
                          </tr>
                          <?php
                        }
                      ?>

                      <tr>
                        <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td>
                          <?php echo "1102"; ?>
                          <?php //echo $row['kode_akun_id_beban']; ?>
                        </td>
                        <td>
                          <?php
                              	echo "Bank BCA";
                          ?>
                          <?php //echo $row['kode_akun_nama']; ?>
                        </td>
                        <td></td>
                        <td>
                          -
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_pembelian = $row['pajak_pembelian'];
                            array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian);
                            echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian, 0, ",", ".");

                          ?>
                        </td>
                      </tr>

                    <?php
                  }
                  else
                  {
                    $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td>
                        <?php echo "5101"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                              echo "Pembelian";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];
                          //floatval($diskon_pembelian);
                          array_push($debet, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                          echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                        ?>
                        <?php //echo $row['harga_beban']; ?>
                      </td>
                      <td>-</td>
                    </tr>


                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <?php
                        $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                        $query_check_dp = mysqli_query($conn, $sql_check_dp);
                        $row_check_dp = mysqli_fetch_array($query_check_dp);

                        ?>
                        <td>
                          <?php echo "2101"; ?>
                          <?php //echo $row['kode_akun_id_beban']; ?>
                        </td>
                        <td>
                          <?php
                              echo "Utang Usaha";
                          ?>
                          <?php //echo $row['kode_akun_nama']; ?>
                        </td>
                        <td></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_pembelian = $row['pajak_pembelian'];

                            $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_pembelian = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                            echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <?php


                        ?>
                      </tr>
                    <?php
                    }
                  }
                }
                ?>

                <?php
              }
              else
              {
                $pembelian_exist = 0;
              }
              /* end of pembelian section */

              /* invoice section */
              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'bayar')
                  {

                    ?>
                    <tr>
                      <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PJ" . $row['id_invoice']; ?></td>
                      <td>
                        <?php echo "1102"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                            	echo "Bank BCA";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td><?php echo $row['pelanggan_nama']; ?></td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        echo $conn->error;
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        echo $conn->error;
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                        array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        ?>
                      </td>
                      <td>-</td>
                    </tr>

                    <tr>
                      <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PJ" . $row['id_invoice']; ?></td>
                      <td>
                        <?php echo "4104"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                            	echo "Pendapatan Diterima Dimuka";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td></td>
                      <td>-</td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        echo $conn->error;
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                        array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        ?>
                      </td>
                    </tr>

                    <?php
                  }
                  else if($row['invoice_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                    <tr>
                      <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PB" . $row['id_invoice']; ?></td>
                      <td>
                        <?php echo "1102"; ?>
                        <?php //echo $row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                              echo "Bank BCA";
                        ?>
                        <?php //echo $row['kode_akun_nama']; ?>
                      </td>
                      <td><?php echo $row['pelanggan_nama']; ?></td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_sales_quotation = $row['pajak_sales_quotation'];
                          array_push($debet, ($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation)));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation)), 0, ",", ".");
                        ?>
                      </td>
                      <td>
                        -
                      </td>
                    </tr>

                    <?php
                      if($row['pajak_sales_quotation'] > 0)
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                          <td><?php echo "PJ" . $row['id_invoice']; ?></td>
                          <td>
                            <?php echo "2105"; ?>
                            <?php //echo $row['kode_akun_id_beban']; ?>
                          </td>
                          <td>
                            <?php
                                	echo "PPN Keluaran";
                            ?>
                            <?php //echo $row['kode_akun_nama']; ?>
                          </td>
                          <td></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              echo $conn->error;
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_sales_quotation = $row['pajak_sales_quotation'];
                              array_push($debet, $row_total_harga['total_harga'] * ($pajak_sales_quotation / 100));
                              echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100), 0, ",", ".");
                            ?>
                          </td>
                          <td>-</td>
                        </tr>
                        <?php
                      }
                    ?>

                      <?php
                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        echo $conn->error;
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        if($row_total_diskon['total_diskon'] > 0)
                        {
                          ?>
                          <tr>
                            <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                            <td><?php echo "PJ" . $row['id_invoice']; ?></td>
                            <td>
                              <?php echo "4102"; ?>
                              <?php //echo $row['kode_akun_id_beban']; ?>
                            </td>
                            <td>
                              <?php
                                  	echo "Potongan Penjualan";
                              ?>
                              <?php //echo $row['kode_akun_nama']; ?>
                            </td>
                            <td></td>
                            <td>
                              <?php
                                $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                                echo $conn->error;
                                $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                                $pajak_sales_quotation = $row['pajak_sales_quotation'];
                                $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                                array_push($debet, floatval($diskon_sales_quotation));
                                echo "Rp " . number_format(floatval($diskon_sales_quotation), 0, ",", ".");
                              ?>
                            </td>
                            <td>-</td>
                          </tr>
                          <?php
                        }
                      ?>
                      <?php
                      $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                      $query_check_dp = mysqli_query($conn, $sql_check_dp);
                      $row_check_dp = mysqli_fetch_array($query_check_dp);
                      if($row_check_dp['down_payment'] != 0)
                      {
                      ?>
                      <tr>
                        <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                        <td><?php echo "PJ" . $row['id_invoice']; ?></td>

                          <td>
                            <?php echo "1111"; ?>
                            <?php //echo $row['kode_akun_id_beban']; ?>
                          </td>
                          <td>
                            <?php
                                echo "Piutang Usaha";
                            ?>
                            <?php //echo $row['kode_akun_nama']; ?>
                          </td>
                          <td></td>
                          <td>-</td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_sales_quotation = $row['pajak_sales_quotation'];

                              $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                              $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                              $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                              array_push($kredit, $row_total_harga['total_harga']);
                              echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                            ?>
                            <?php //echo $row['harga_beban']; ?>
                          </td>
                      </tr>
                      <?php
                      }
                  }
                  else
                  {
                    $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                    <tr>
                      <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo "PJ" . $row['id_invoice']; ?></td>

                        <td>
                          <?php echo "1111"; ?>
                          <?php //echo $row['kode_akun_id_beban']; ?>
                        </td>
                        <td>
                          <?php
                              echo "Piutang Usaha";
                          ?>
                          <?php //echo $row['kode_akun_nama']; ?>
                        </td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($debet, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td><?php echo $row['invoice_status_pembayaran_tanggal']; ?></td>
                        <td><?php echo "PJ" . $row['id_invoice']; ?></td>
                        <td>
                          <?php echo "4101"; ?>
                          <?php //echo $row['kode_akun_id_beban']; ?>
                        </td>
                        <td>
                          <?php
                                echo "Penjualan";
                          ?>
                          <?php //echo $row['kode_akun_nama']; ?>
                        </td>
                        <td></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                      </tr>
                    <?php
                    }
                  }
                }
                ?>

                <?php
              }
              else
              {
                $invoice_exist = 0;

              }
              /* End of invoice section */

              if($pembelian_exist == 0 && $invoice_exist == 0)
              {
                echo "<td colspan='7' class='text-center'>Hasil tidak ada</td>";
              }
              else
              {
                ?>
                <tr>
                  <td colspan="5" align="right">Jumlah</td>
                  <td>
                    <?php
                      $sum = 0;
                      for($i = 0; $i < count($debet); $i++)
                      {
                        $sum = $sum + $debet[$i];
                      }
                      echo "Rp " . number_format($sum, 0, ",", ".");
                    ?>
                  </td>
                  <td>
                    <?php
                      $sum = 0;
                      for($i = 0; $i < count($kredit); $i++)
                      {
                        $sum = $sum + $kredit[$i];
                      }
                      echo "Rp " . number_format($sum, 0, ",", ".");
                    ?>
                  </td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>

        <!-- kode akun 1102 neraca saldo awal-->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 1102";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_1102_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_1102_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">Bank BCA</th>
                  <th colspan="5"></th>
                  <th align="right">1102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>

              <?php
                /* pembelian section */
                $profil_perusahaan_tanggal = $row_profil_perusahaan['tanggal'];
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";

                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'bayar')
                    {

                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          -
                        </td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];

                          array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_1102_kredit = $kode_akun_1102_kredit + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100);

                          $kode_akun_1102_kredit_saldo_awal += ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_1102_kredit - $kode_akun_1102_debet, 0, ",", "."); ?></td>
                    </tr>
                    <?php
                    }

                    else if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      $pajak_pembelian = $row['pajak_pembelian'];
                      $diskon_pembelian = $row_total_diskon['total_diskon'];
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          -
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_pembelian = $row['pajak_pembelian'];
                            array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian);
                            echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian, 0, ",", ".");
                            $kode_akun_1102_kredit = $kode_akun_1102_kredit + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian;

                            $kode_akun_1102_kredit_saldo_awal += ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian;
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp ". number_format($kode_akun_1102_kredit - $kode_akun_1102_debet, 0, ",", "."); ?></td>
                      </tr>
                      <?php
                    }
                  }
                }

              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'bayar')
                  {

                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['invoice_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "INV" . $row['id_invoice']; ?></td>
                      <td><?php echo $row['pelanggan_nama']; ?></td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        echo $conn->error;
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        echo $conn->error;
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                        array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        $kode_akun_1102_debet = $kode_akun_1102_debet + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100);

                        $kode_akun_1102_debet_saldo_awal += ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100);
                        ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                      <td>-</td>
                    </tr>
                    <?php
                  }

                  else if($row['invoice_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];
                            array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100))) - $diskon_sales_quotation);
                            echo "Rp " . number_format(($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation)), 0, ",", ".");
                            $kode_akun_1102_debet = $kode_akun_1102_debet + ($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation));

                            $kode_akun_1102_debet_saldo_awal += ($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation));
                          ?>
                        </td>
                        <td>
                          -
                        </td>
                        <td><?php echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>

                    <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
        <!-- End of kode akun 1102 neraca saldo awal Table -->

        <?php
          //$kode_akun_1102_saldo_awal = $kode_akun_1102_debet_saldo_awal - $kode_akun_1102_kredit_saldo_awal;
          //$kode_akun_1102_debet += $kode_akun_1102_saldo_awal
          $kode_akun_1102_debet += $kode_akun_1102_saldo_awal;
        ?>

        <!-- kode akun 1102 Table -->
        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">Bank BCA</th>
                  <th colspan="5"></th>
                  <th align="right">1102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_1102_debet, 0, ",", "."); ?>
                <td>-</td>
              </tr>
              <?php
                /* pembelian section */
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'bayar')
                    {

                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          -
                        </td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];

                          array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_1102_kredit = $kode_akun_1102_kredit + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td><?php echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                    </tr>
                    <?php
                    }

                    else if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      $pajak_pembelian = $row['pajak_pembelian'];
                      $diskon_pembelian = $row_total_diskon['total_diskon'];
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          -
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_pembelian = $row['pajak_pembelian'];
                            array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian);
                            echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian, 0, ",", ".");
                            $kode_akun_1102_kredit = $kode_akun_1102_kredit + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian;
                          ?>
                        </td>
                        <td><?php echo "Rp ". number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>
                      <?php
                    }
                  }
                }

              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'bayar')
                  {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['invoice_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "INV" . $row['id_invoice']; ?></td>
                      <td><?php echo $row['pelanggan_nama']; ?></td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        echo $conn->error;
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        echo $conn->error;
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                        array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                        $kode_akun_1102_debet = $kode_akun_1102_debet + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100);
                        ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                      <td>-</td>
                    </tr>
                    <?php
                  }

                  else if($row['invoice_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];
                            array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100))) - $diskon_sales_quotation);
                            echo "Rp " . number_format(($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation)), 0, ",", ".");
                            $kode_akun_1102_debet = $kode_akun_1102_debet + ($row_total_harga['total_harga'] - (($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) + $diskon_sales_quotation));
                          ?>
                        </td>
                        <td>
                          -
                        </td>
                        <td><?php echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>

                    <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
        <!-- End of kode akun 1102 Table -->

        <!-- kode akun 1111 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 1111";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_1111_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_1111_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">Piutang Usaha</th>
                  <th colspan="5"></th>
                  <th align="right">1111</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'lunas')
                    {
                      $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                      $query_check_dp = mysqli_query($conn, $sql_check_dp);
                      $row_check_dp = mysqli_fetch_array($query_check_dp);
                      if($row_check_dp['down_payment'] != 0)
                      {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                            $kode_akun_1111_kredit = $kode_akun_1111_kredit + $row_total_harga['total_harga'];
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_1111_kredit - $kode_akun_1111_debet, 0, ",", "."); ?></td>
                      </tr>
                      <?php
                      }
                    }
                    else if($row['invoice_status_pembayaran_status'] == 'aktif')
                    {
                      $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                      $query_check_dp = mysqli_query($conn, $sql_check_dp);
                      $row_check_dp = mysqli_fetch_array($query_check_dp);
                      if($row_check_dp['down_payment'] != 0)
                      {
                      ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['invoice_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "INV" . $row['id_invoice']; ?></td>

                          <td><?php echo $row['pelanggan_nama']; ?></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_sales_quotation = $row['pajak_sales_quotation'];

                              $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                              $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                              $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                              $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                              array_push($debet, $row_total_harga['total_harga']);
                              echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                              $kode_akun_1111_debet = $kode_akun_1111_debet + $row_total_harga['total_harga'];
                            ?>
                            <?php //echo $row['harga_beban']; ?>
                          </td>
                          <td>-</td>
                          <td><?php echo "Rp " . number_format($kode_akun_1111_debet - $kode_akun_1111_kredit, 0, ",", "."); ?></td>
                          <td>-</td>
                      <?php
                      }
                      ?>

                      <?php
                    }
                    ?>

                    <?php

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 1111 neraca saldo awal table -->

        <?php
          $kode_akun_1111_debet += $kode_akun_1111_saldo_awal;

        ?>

        <!-- kode akun 1111 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0">Piutang Usaha</th>
                  <th colspan="5"></th>
                  <th align="right">1111</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_1111_saldo_awal, 0, ",", "."); ?></td>
                <td>-</td>
              </tr>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'lunas')
                    {
                      $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                      $query_check_dp = mysqli_query($conn, $sql_check_dp);
                      $row_check_dp = mysqli_fetch_array($query_check_dp);
                      if($row_check_dp['down_payment'] != 0)
                      {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                            $kode_akun_1111_kredit = $kode_akun_1111_kredit + $row_total_harga['total_harga'];
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td><?php echo "Rp " . number_format($kode_akun_1111_debet - $kode_akun_1111_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>
                      <?php
                      }
                    }
                    else if($row['invoice_status_pembayaran_status'] == 'aktif')
                    {
                      $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                      $query_check_dp = mysqli_query($conn, $sql_check_dp);
                      $row_check_dp = mysqli_fetch_array($query_check_dp);
                      if($row_check_dp['down_payment'] != 0)
                      {
                      ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['invoice_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "INV" . $row['id_invoice']; ?></td>

                          <td><?php echo $row['pelanggan_nama']; ?></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_sales_quotation = $row['pajak_sales_quotation'];

                              $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                              $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                              $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                              array_push($debet, $row_total_harga['total_harga']);
                              echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                              $kode_akun_1111_debet = $kode_akun_1111_debet + $row_total_harga['total_harga'];
                            ?>
                            <?php //echo $row['harga_beban']; ?>
                          </td>
                          <td>-</td>
                          <td><?php echo "Rp " . number_format($kode_akun_1111_debet - $kode_akun_1111_kredit, 0, ",", "."); ?></td>
                          <td>-</td>
                      <?php
                      }
                      ?>

                      <?php
                    }
                    ?>

                    <?php

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 1111 table -->

        <!--<div class="page_break" style="page-break-before: always;"></div>-->

        <!-- kode akun 2101 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 2101";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_2101_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_2101_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">Utang Usaha</th>
                  <th colspan="5"></th>
                  <th align="right">2101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  if($row['pembelian_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    ?>

                    <?php
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                      <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>-</td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];

                          array_push($kredit, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                          echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                          $kode_akun_2101_kredit = $kode_akun_2101_kredit + $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian);
                        ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_2101_kredit - $kode_akun_2101_debet, 0, ",", "."); ?></td>
                      </tr>
                    <?php
                    }
                    ?>

                  <?php
                }
              }
            }
            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2101 neraca saldo awal table -->

        <?php
          $kode_akun_2101_kredit += $kode_akun_2101_saldo_awal;
        ?>

        <!-- kode akun 2101 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0">Utang Usaha</th>
                  <th colspan="5"></th>
                  <th align="right">2101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_1111_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  if($row['pembelian_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    ?>

                    <?php
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                      <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>-</td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];

                          array_push($kredit, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                          echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                          $kode_akun_2101_kredit = $kode_akun_2101_kredit + $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian);
                        ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_2101_kredit - $kode_akun_2101_debet, 0, ",", "."); ?></td>
                      </tr>
                    <?php
                    }
                    ?>

                  <?php
                }
              }
            }
            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2101 table -->

        <!-- kode akun 2104 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 2104";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_2104_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_2104_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">PPN Masukan</th>
                  <th colspan="5"></th>
                  <th align="right">2104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  if($row['pembelian_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                    <?php
                      if($row['pajak_pembelian'] > 0)
                      {
                        ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['pembelian_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                          <td><?php echo $row['vendor_nama']; ?></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              array_push($debet, $row_total_harga['total_harga'] * ($pajak_pembelian / 100));
                              echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_pembelian / 100), 0, ",", ".");
                              $kode_akun_2104_debet = $kode_akun_2104_debet +  $row_total_harga['total_harga'] * ($pajak_pembelian / 100);
                            ?>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td><?php echo "Rp " . number_format($kode_akun_2104_kredit - $kode_akun_2104_debet, 0, ",", "."); ?></td>
                        </tr>
                        <?php
                      }
                    ?>

                    <?php
                  }
                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2104 neraca saldo awal table -->

        <?php
          $kode_akun_2104_kredit += $kode_akun_2104_saldo_awal;
        ?>

        <!-- kode akun 2104 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0">PPN Masukan</th>
                  <th colspan="5"></th>
                  <th align="right">2104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_2104_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  if($row['pembelian_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                    <?php
                      if($row['pajak_pembelian'] > 0)
                      {
                        ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['pembelian_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                          <td><?php echo $row['vendor_nama']; ?></td>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              array_push($debet, $row_total_harga['total_harga'] * ($pajak_pembelian / 100));
                              echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_pembelian / 100), 0, ",", ".");
                              $kode_akun_2104_debet = $kode_akun_2104_debet +  $row_total_harga['total_harga'] * ($pajak_pembelian / 100);
                            ?>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td><?php echo "Rp " . number_format($kode_akun_2104_kredit - $kode_akun_2104_debet, 0, ",", "."); ?></td>
                        </tr>
                        <?php
                      }
                    ?>

                    <?php
                  }
                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2104 table -->

        <!-- kode akun 2105 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 2105";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_2105_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_2105_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">PPN Keluaran</th>
                  <th colspan="5"></th>
                  <th align="right">2105</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'lunas')
                  {
                    if($row['pajak_sales_quotation'] > 0)
                    {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            echo $conn->error;
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];
                            array_push($debet, $row_total_harga['total_harga'] * ($pajak_sales_quotation / 100));
                            echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100), 0, ",", ".");
                            $kode_akun_2105_debet = $kode_akun_2105_debet +  $row_total_harga['total_harga'] * ($pajak_sales_quotation / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_2105_kredit - $kode_akun_2105_debet, 0, ",", "."); ?></td>
                      </tr>
                      <?php
                    }
                  }
                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2105 neraca saldo awal table -->

        <?php
          $kode_akun_2105_kredit += $kode_akun_2105_saldo_awal;
        ?>

        <!-- kode akun 2105 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0">PPN Keluaran</th>
                  <th colspan="5"></th>
                  <th align="right">2105</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_2105_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'lunas')
                  {
                    if($row['pajak_sales_quotation'] > 0)
                    {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            echo $conn->error;
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];
                            array_push($debet, $row_total_harga['total_harga'] * ($pajak_sales_quotation / 100));
                            echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100), 0, ",", ".");
                            $kode_akun_2105_debet = $kode_akun_2105_debet +  $row_total_harga['total_harga'] * ($pajak_sales_quotation / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_2105_kredit - $kode_akun_2105_debet, 0, ",", "."); ?></td>
                      </tr>
                      <?php
                    }
                  }
                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 2105 table -->

        <!-- kode akun 4101 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 4101";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_4101_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_4101_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2"  style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0">Penjualan</th>
                  <th colspan="5"></th>
                  <th align="right">4101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");

                            $kode_akun_4101_kredit = $kode_akun_4101_kredit +  $row_total_harga['total_harga'];
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_4101_kredit - $kode_akun_4101_debet, 0, ",", "."); ?></td>
                      </tr>
                    <?php
                    }
                  }

                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 4101 neraca saldo awal table -->

        <?php
          $kode_akun_4101_kredit += $kode_akun_4101_saldo_awal;
        ?>

        <!-- kode akun 4101 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0">Penjualan</th>
                  <th colspan="5"></th>
                  <th align="right">4101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_4101_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
              $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_invoice = $row['id_invoice'];
                  $id_sales_quotation = $row['id_sales_quotation'];
                  if($row['invoice_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT perform_invoice.down_payment AS 'down_payment' FROM perform_invoice WHERE perform_invoice.sales_quotation_id = $id_sales_quotation";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_sales_quotation = $row['pajak_sales_quotation'];

                            $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                            $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                            $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                            array_push($kredit, $row_total_harga['total_harga']);
                            echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");

                            $kode_akun_4101_kredit = $kode_akun_4101_kredit +  $row_total_harga['total_harga'];
                          ?>
                          <?php //echo $row['harga_beban']; ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_4101_kredit - $kode_akun_4101_debet, 0, ",", "."); ?></td>
                      </tr>
                    <?php
                    }
                  }

                }
              }

            ?>
          </tbody>
        </table>
        <!-- end of kode akun 4101 table -->

        <!-- kode akun 4102 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 4102";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_4102_saldo_awal += $row['saldo'];

          }
          else
          {
            $kode_akun_4102_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2"  style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2">Potongan Penjualan</th>
                  <th colspan="4"></th>
                  <th align="right">4102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'lunas')
                    {
                        if($row['pajak_sales_quotation'] > 0)
                        {
                          $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          echo $conn->error;
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          if($row_total_diskon['total_diskon'] > 0)
                          {
                            ?>
                            <tr>
                              <td style="white-space: nowrap;">
                                <?php
                                  show_date($row['invoice_status_pembayaran_tanggal']);
                                ?>
                              </td>
                              <td><?php echo "INV" . $row['id_invoice']; ?></td>
                              <td><?php echo $row['pelanggan_nama']; ?></td>
                              <td>
                                <?php
                                  $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                  $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                                  $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                                  $pajak_sales_quotation = $row['pajak_sales_quotation'];
                                  $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                                  array_push($debet, floatval($diskon_sales_quotation));
                                  echo "Rp " . number_format(floatval($diskon_sales_quotation), 0, ",", ".");
                                  $kode_akun_4102_debet = $kode_akun_4102_debet +  $row_total_diskon['total_diskon'];
                                ?>
                              </td>
                              <td>-</td>
                              <td>-</td>
                              <td><?php echo "Rp " . number_format($kode_akun_4102_kredit - $kode_akun_4102_debet, 0, ",", "."); ?></td>
                            </tr>
                            <?php
                          }
                        ?>

                      <?php
                    }

                  }
                }
              }
            ?>
          </tbody>
        </table>
        <!-- end of kode akun 4102 neraca saldo awal table -->

        <?php
          $kode_akun_4102_kredit += $kode_akun_4102_saldo_awal;
        ?>

        <!-- kode akun 4102 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2">Potongan Penjualan</th>
                  <th colspan="4"></th>
                  <th align="right">4102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_4101_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'lunas')
                    {
                        if($row['pajak_sales_quotation'] > 0)
                        {
                          $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          echo $conn->error;
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          if($row_total_diskon['total_diskon'] > 0)
                          {
                            ?>
                            <tr>
                              <td style="white-space: nowrap;">
                                <?php
                                  show_date($row['invoice_status_pembayaran_tanggal']);
                                ?>
                              </td>
                              <td><?php echo "INV" . $row['id_invoice']; ?></td>
                              <td><?php echo $row['pelanggan_nama']; ?></td>
                              <td>
                                <?php
                                  $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = $id_sales_quotation AND invoice_status_pembayaran.status = 'lunas' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                  $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                                  echo $conn->error;
                                  $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                                  $pajak_sales_quotation = $row['pajak_sales_quotation'];
                                  $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                                  array_push($debet, floatval($diskon_sales_quotation));
                                  echo "Rp " . number_format(floatval($diskon_sales_quotation), 0, ",", ".");
                                  $kode_akun_4102_debet = $kode_akun_4102_debet +  $row_total_diskon['total_diskon'];
                                ?>
                              </td>
                              <td>-</td>
                              <td>-</td>
                              <td><?php echo "Rp " . number_format($kode_akun_4102_kredit - $kode_akun_4102_debet, 0, ",", "."); ?></td>
                            </tr>
                            <?php
                          }
                        ?>

                      <?php
                    }

                  }
                }
              }
            ?>
          </tbody>
        </table>
        <!-- end of kode akun 4102 table -->

        <!-- kode akun 4104 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 4104";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_4104_saldo_awal += $row['saldo'];
          }
          else
          {
            $kode_akun_4104_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2"  style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Pendapatan Diterima Dimuka</th>
                  <th colspan="4"></th>
                  <th align="right">4104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'bayar')
                    {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          echo $conn->error;
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_sales_quotation = $row['pajak_sales_quotation'];

                          $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                          array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_4104_kredit = $kode_akun_4104_kredit +  ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_4104_kredit - $kode_akun_4104_debet, 0, ",", "."); ?></td>
                      </tr>

                      <?php
                    }

                  }
                }
              ?>
          </tbody>
        </table>
        <!-- end of kode akun 4104 neraca saldo awal table -->

        <?php
          $kode_akun_4104_kredit += $kode_akun_4104_saldo_awal;
        ?>

        <!-- kode akun 4104 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Pendapatan Diterima Dimuka</th>
                  <th colspan="4"></th>
                  <th align="right">4104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_4104_saldo_awal, 0, ",", "."); ?></td>
              </tr>
              <?php
                $sql = "SELECT invoice.id AS 'id_invoice', sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', invoice_status_pembayaran.tanggal AS 'invoice_status_pembayaran_tanggal', invoice_status_pembayaran.status AS 'invoice_status_pembayaran_status', pelanggan.nama AS 'pelanggan_nama' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id WHERE invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY invoice_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_invoice = $row['id_invoice'];
                    $id_sales_quotation = $row['id_sales_quotation'];
                    if($row['invoice_status_pembayaran_status'] == 'bayar')
                    {
                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
                        <td><?php echo $row['pelanggan_nama']; ?></td>
                        <td>-</td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id LEFT JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN sales_quotation_detail ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          echo $conn->error;
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_sales_quotation = $row['pajak_sales_quotation'];

                          $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN perform_invoice ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN invoice ON invoice.perform_invoice_id = perform_invoice.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar' AND invoice_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                          array_push($kredit, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_4104_kredit = $kode_akun_4104_kredit +  ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_4104_kredit - $kode_akun_4104_debet, 0, ",", "."); ?></td>
                      </tr>

                      <?php
                    }

                  }
                }
              ?>
          </tbody>
        </table>
        <!-- end of kode akun 4104 table -->

        <!-- kode akun 5101 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 5101";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_5101_saldo_awal += $row['saldo'];
          }
          else
          {
            $kode_akun_5101_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      ?>
                        <tr>
                            <td style="white-space: nowrap;">
                              <?php
                                show_date($row['pembelian_status_pembayaran_tanggal']);
                              ?>
                            </td>
                            <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                            <td><?php echo $row['vendor_nama']; ?></td>
                            <td>
                              <?php
                                $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                                $query_total_harga = mysqli_query($conn, $sql_total_harga);
                                $row_total_harga = mysqli_fetch_array($query_total_harga);
                                array_push($debet, $row_total_harga['total_harga']);
                                echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                                $kode_akun_5101_debet = $kode_akun_5101_debet +  $row_total_harga['total_harga'];
                              ?>
                            </td>
                            <td>-</td>
                            <td><?php echo "Rp " . number_format($kode_akun_5101_debet - $kode_akun_5101_kredit, 0, ",", "."); ?></td>
                            <td>-</td>
                        </tr>

                    <?php
                  }
                  else if($row['pembelian_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];
                          //floatval($diskon_pembelian);
                          array_push($debet, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                          echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                          $kode_akun_5101_debet = $kode_akun_5101_debet +   $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian);
                        ?>
                        <?php //echo $row['harga_beban']; ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_5101_debet - $kode_akun_5101_kredit, 0, ",", "."); ?></td>
                      <td>-</td>
                    </tr>
                    <?php
                    }

                  }
                }
              }
              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5101 neraca saldo awal table -->

        <?php
          $kode_akun_5101_debet += $kode_akun_5101_saldo_awal;
        ?>

        <!-- kode akun 5101 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5101</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_5101_saldo_awal, 0, ",", "."); ?></td>
                <td>-</td>
              </tr>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                echo $conn->error;
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      ?>
                        <tr>
                            <td style="white-space: nowrap;">
                              <?php
                                show_date($row['pembelian_status_pembayaran_tanggal']);
                              ?>
                            </td>
                            <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                            <td><?php echo $row['vendor_nama']; ?></td>
                            <td>
                              <?php
                                $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                $query_total_harga = mysqli_query($conn, $sql_total_harga);
                                $row_total_harga = mysqli_fetch_array($query_total_harga);
                                array_push($debet, $row_total_harga['total_harga']);
                                echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");
                                $kode_akun_5101_debet = $kode_akun_5101_debet +  $row_total_harga['total_harga'];
                              ?>
                            </td>
                            <td>-</td>
                            <td><?php echo "Rp " . number_format($kode_akun_5101_debet - $kode_akun_5101_kredit, 0, ",", "."); ?></td>
                            <td>-</td>
                        </tr>

                    <?php
                  }
                  else if($row['pembelian_status_pembayaran_status'] == 'aktif')
                  {
                    $sql_check_dp = "SELECT pembelian.down_payment AS 'down_payment' FROM pembelian WHERE pembelian.id = $id_pembelian";
                    $query_check_dp = mysqli_query($conn, $sql_check_dp);
                    $row_check_dp = mysqli_fetch_array($query_check_dp);
                    if($row_check_dp['down_payment'] != 0)
                    {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];
                          //floatval($diskon_pembelian);
                          array_push($debet, $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                          echo "Rp " . number_format($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian), 0, ",", ".");
                          $kode_akun_5101_debet = $kode_akun_5101_debet +   $row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian);
                        ?>
                        <?php //echo $row['harga_beban']; ?>
                      </td>
                      <td>-</td>
                      <td><?php echo "Rp " . number_format($kode_akun_5101_debet - $kode_akun_5101_kredit, 0, ",", "."); ?></td>
                      <td>-</td>
                    </tr>
                    <?php
                    }

                  }
                }
              }
              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5101 table -->

        <!-- kode akun 5102 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 5102";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_5102_saldo_awal += $row['saldo'];
          }
          else
          {
            $kode_akun_5102_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Potongan Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.diskon / 100) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      if($row_total_diskon['total_diskon'] > 0)
                      {
                        ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['pembelian_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                          <td><?php echo $row['vendor_nama']; ?></td>
                          <td>-</td>
                          <td>
                            <?php
                              $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                              $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                              $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              $diskon_pembelian = $row_total_diskon['total_diskon'];
                              array_push($kredit, floatval($diskon_pembelian));
                              echo "Rp " . number_format(floatval($diskon_pembelian), 0, ",", ".");
                              $kode_akun_5102_kredit = $kode_akun_5102_kredit +   floatval($diskon_pembelian);
                            ?>
                            <?php //echo $row['harga_beban']; ?>
                          </td>
                          <td><?php echo "Rp " . number_format($kode_akun_5102_debet - $kode_akun_5102_kredit, 0, ",", "."); ?></td>
                          <td>-</td>
                        </tr>
                        <?php
                      }
                    }

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5102 neraca saldo awal table -->

        <?php
          $kode_akun_5102_debet += $kode_akun_5102_saldo_awal;
        ?>

        <!-- kode akun 5102 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Potongan Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5102</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_5102_saldo_awal, 0, ",", "."); ?></td>
                <td>-</td>
              </tr>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'lunas')
                    {
                      $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.diskon / 100) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                      $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                      $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                      if($row_total_diskon['total_diskon'] > 0)
                      {
                        ?>
                        <tr>
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['pembelian_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                          <td><?php echo $row['vendor_nama']; ?></td>
                          <td>-</td>
                          <td>
                            <?php
                              $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                              $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              $diskon_pembelian = $row_total_diskon['total_diskon'];
                              array_push($kredit, floatval($diskon_pembelian));
                              echo "Rp " . number_format(floatval($diskon_pembelian), 0, ",", ".");
                              $kode_akun_5102_kredit = $kode_akun_5102_kredit + floatval($diskon_pembelian);
                            ?>
                            <?php //echo $row['harga_beban']; ?>
                          </td>
                          <td><?php echo "Rp " . number_format($kode_akun_5102_debet - $kode_akun_5102_kredit, 0, ",", "."); ?></td>
                          <td>-</td>
                        </tr>
                        <?php
                      }
                    }

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5102 table -->

        <!-- kode akun 5104 neraca saldo awal table -->
        <?php
          $sql = "SELECT saldo FROM kode_akun WHERE kode = 5104";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          if($num > 0)
          {
              $row = mysqli_fetch_array($query);
              $kode_akun_5104_saldo_awal += $row['saldo'];
          }
          else
          {
            $kode_akun_5104_saldo_awal += 0;
          }
        ?>

        <table class="table mx-auto mb-2" style="display: none;">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Uang Muka Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'bayar')
                    {

                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$profil_perusahaan_tanggal' AND '$tanggal_awal_create_date'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];
                          array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_5104_debet= $kode_akun_5104_debet +   ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_5104_debet - $kode_akun_5104_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>
                      <?php
                    }

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5102 neraca saldo awal table -->

        <?php
          $kode_akun_5104_debet += $kode_akun_5104_saldo_awal;
        ?>

        <!-- kode akun 5104 table -->
        <table class="table mx-auto mb-2" style="display: none">
            <thead>
              <tr class="borderless">
                  <th border="0" colspan="2" align="left">Uang Muka Pembelian</th>
                  <th colspan="4"></th>
                  <th align="right">5104</th>
              </tr>
              <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">ID Transaksi</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
              </tr>
              <tr>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo show_date($tanggal_awal); ?></td>
                <td>-</td>
                <td>Saldo</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo "Rp " . number_format($kode_akun_5104_saldo_awal, 0, ",", "."); ?></td>
                <td>-</td>
              </tr>
              <?php
                $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status', vendor.nama AS 'vendor_nama' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY pembelian_status_pembayaran.tanggal";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if($num > 0)
                {
                  while($row = mysqli_fetch_array($query))
                  {
                    $id_pembelian = $row['id_pembelian'];
                    if($row['pembelian_status_pembayaran_status'] == 'bayar')
                    {

                      ?>
                      <tr>
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                        <td><?php echo $row['vendor_nama']; ?></td>
                        <td>
                          <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          $pajak_pembelian = $row['pajak_pembelian'];

                          $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                          $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                          $diskon_pembelian = $row_total_diskon['total_diskon'];
                          array_push($debet, ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100));
                          echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100), 0, ",", ".");
                          $kode_akun_5104_debet= $kode_akun_5104_debet +  ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)) * ($row_total_harga['down_payment'] / 100);
                          ?>
                        </td>
                        <td>-</td>
                        <td><?php echo "Rp " . number_format($kode_akun_5104_debet - $kode_akun_5104_kredit, 0, ",", "."); ?></td>
                        <td>-</td>
                      </tr>
                      <?php
                    }

                  }
                }

              ?>
          </tbody>
        </table>
        <!-- end of kode akun 5104 table -->

        <!-- neraca lajur -->
        <table class="table mx-auto" style="display: none;">
          <thead>
            <tr>
              <th rowspan="2">Kode Akun</th>
              <th rowspan="2">Nama Akun</th>
              <th colspan="2">Saldo</th>
              <th colspan="2">Laba/Rugi</th>
              <th colspan="2">Neraca</th>
            </tr>
            <tr>
              <th>Debit</th>
              <th>Kredit</th>
              <th>Debit</th>
              <th>Kredit</th>
              <th>Debit</th>
              <th>Kredit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1102</td>
              <td>Bank BCA</td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_1102_debet - $kode_akun_1102_kredit, 0, ",", ".");
                  $neraca_debet_total = $neraca_debet_total + ($kode_akun_1102_debet - $kode_akun_1102_kredit);
                ?>
              </td>
              <td></td>
              <td>-</td>
              <td>-</td>
              <td>
                <?php
                  $debet_neraca = $debet_neraca + ($kode_akun_1102_debet - $kode_akun_1102_kredit);
                  echo "Rp " . number_format(($kode_akun_1102_debet - $kode_akun_1102_kredit), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
            </tr>
            <tr>
              <td>1111</td>
              <td>Piutang Usaha</td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_1111_debet - $kode_akun_1111_kredit, 0, ",", ".");
                  $neraca_debet_total = $neraca_debet_total + ($kode_akun_1111_debet - $kode_akun_1111_kredit);
                ?>
              </td>
              <td></td>
              <td>-</td>
              <td>-</td>
              <td>
                <?php
                  $debet_neraca = $debet_neraca + ($kode_akun_1111_debet - $kode_akun_1111_kredit);
                  echo "Rp " . number_format($kode_akun_1111_debet - $kode_akun_1111_kredit, 0, ",", ".");
                ?>
              </td>
              <td>-</td>
            </tr>
            <tr>
              <td>2101</td>
              <td>Utang Usaha</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_2101_kredit - $kode_akun_2101_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_2101_kredit - $kode_akun_2101_debet);
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>
                <?php
                  $kredit_neraca = $kredit_neraca + ($kode_akun_2101_kredit - $kode_akun_2101_debet);
                  echo "Rp " . number_format(($kode_akun_2101_kredit - $kode_akun_2101_debet), 0, ",", ".");
                ?>
              </td>
            </tr>
            <tr>
              <td>2104</td>
              <td>PPN Masukan</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_2104_kredit - $kode_akun_2104_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_2104_kredit - $kode_akun_2104_debet);
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>
                <?php
                  $kredit_neraca = $kredit_neraca + ($kode_akun_2104_kredit - $kode_akun_2104_debet);
                  echo "Rp " . number_format(($kode_akun_2104_kredit - $kode_akun_2104_debet), 0, ",", ".");
                ?>
              </td>
            </tr>
            <tr>
              <td>2105</td>
              <td>PPN Keluaran</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_2105_kredit - $kode_akun_2105_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_2105_kredit - $kode_akun_2105_debet);
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>
                <?php
                  $kredit_neraca = $kredit_neraca + ($kode_akun_2105_kredit - $kode_akun_2105_debet);
                  echo "Rp " . number_format(($kode_akun_2105_kredit - $kode_akun_2105_debet), 0, ",", ".");
                ?>
              </td>
            </tr>
            <tr>
              <td>4101</td>
              <td>Penjualan</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_4101_kredit - $kode_akun_4101_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_4101_kredit - $kode_akun_4101_debet);
                ?>
              </td>
              <td>-</td>
              <td>
                <?php
                  $kredit_labarugi = $kredit_labarugi + ($kode_akun_4101_kredit - $kode_akun_4101_debet);
                  echo "Rp " . number_format(($kode_akun_4101_kredit - $kode_akun_4101_debet), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td>4102</td>
              <td>Potongan Penjualan</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_4102_kredit - $kode_akun_4102_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_4102_kredit - $kode_akun_4102_debet);
                ?>
              </td>
              <td>-</td>
              <td>
                <?php
                  $kredit_labarugi = $kredit_labarugi + ($kode_akun_4102_kredit - $kode_akun_4102_debet);
                  echo "Rp " . number_format(($kode_akun_4102_kredit - $kode_akun_4102_debet), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td>4104</td>
              <td>Pendapatan Diterima Dimuka</td>
              <td></td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_4104_kredit - $kode_akun_4104_debet, 0, ",", ".");
                  $neraca_kredit_total = $neraca_kredit_total + ($kode_akun_4104_kredit - $kode_akun_4104_debet);
                ?>
              </td>
              <td>-</td>
              <td>
                <?php
                  $kredit_labarugi = $kredit_labarugi + ($kode_akun_4104_kredit - $kode_akun_4104_debet);
                  echo "Rp " . number_format(($kode_akun_4104_kredit - $kode_akun_4104_debet), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td>5101</td>
              <td>Pembelian</td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_5101_debet - $kode_akun_5101_kredit, 0, ",", ".");
                  $neraca_debet_total = $neraca_debet_total + ($kode_akun_5101_debet - $kode_akun_5101_kredit);
                  ?>
              </td>
              <td></td>
              <td>
                <?php
                  $debet_labarugi = $debet_labarugi + ($kode_akun_5101_debet - $kode_akun_5101_kredit);
                  echo "Rp " . number_format(($kode_akun_5101_debet - $kode_akun_5101_kredit), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td>5102</td>
              <td>Potongan Pembelian</td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_5102_debet - $kode_akun_5102_kredit, 0, ",", ".");
                  $neraca_debet_total = $neraca_debet_total + ($kode_akun_5102_debet - $kode_akun_5102_kredit);
                  ?>
              </td>
              <td></td>
              <td>
                <?php
                  $debet_labarugi = $debet_labarugi + ($kode_akun_5102_debet - $kode_akun_5102_kredit);
                  echo "Rp " . number_format(($kode_akun_5102_debet - $kode_akun_5102_kredit), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td>5104</td>
              <td>Uang Muka Pembelian</td>
              <td>
                <?php
                  echo "Rp " . number_format($kode_akun_5104_debet - $kode_akun_5104_kredit, 0, ",", ".");
                  $neraca_debet_total = $neraca_debet_total + ($kode_akun_5104_debet - $kode_akun_5104_kredit);
                  ?>
              </td>
              <td></td>
              <td>
                <?php
                  $debet_labarugi = $debet_labarugi + ($kode_akun_5104_debet - $kode_akun_5104_kredit);
                  echo "Rp " . number_format(($kode_akun_5104_debet - $kode_akun_5104_kredit), 0, ",", ".");
                ?>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><strong><?php echo "Rp " . number_format($neraca_debet_total, 0, ",", "."); ?></strong></td>
                <td><strong><?php echo "Rp " . number_format($neraca_kredit_total, 0, ",", "."); ?></strong></td>
                <td>
                  <?php
                    if($debet_labarugi > 0)
                    {
                      echo "Rp " . number_format($debet_labarugi, 0, ",", ".");
                    }
                    else
                    {
                      echo "Rp 0" ;
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if($kredit_labarugi > 0)
                    {
                      echo "Rp " . number_format($kredit_labarugi, 0, ",", ".");
                    }
                    else
                    {
                      echo "Rp 0" ;
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if($debet_neraca > 0)
                    {
                      echo "Rp " . number_format($debet_neraca, 0, ",", ".");
                    }
                    else
                    {
                      echo "Rp 0" ;
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if($kredit_neraca > 0)
                    {
                      echo "Rp " . number_format($kredit_neraca, 0, ",", ".");
                    }
                    else
                    {
                      echo "Rp 0" ;
                    }
                  ?>
                </td>
            </tr>
            <tr>
              <td colspan="4" align="right">
                <?php
                if($debet_labarugi < $kredit_labarugi)
                {
                  echo "<strong>Laba</strong>";
                }
                else
                {
                  echo "<strong>Rugi</strong>";
                }
                ?>
              </td>

              <?php
                if($debet_labarugi > $kredit_labarugi)
                {
                  $hasil_labarugi = $debet_labarugi - $kredit_labarugi;
                  echo "<td></td>";
                  echo "<td>" . "Rp " . number_format($hasil_labarugi, 0, ",", ".") . "</td>";
                }
                else
                {
                  $hasil_labarugi = $kredit_labarugi - $debet_labarugi;
                  echo "<td>" . "Rp " . number_format($hasil_labarugi, 0, ",", ".") . "</td>";
                  echo "<td></td>";
                }
              ?>
              <?php
                if($debet_neraca > $kredit_neraca)
                {
                  $hasil_neraca = $debet_neraca - $kredit_neraca;
                  echo "<td></td>";
                  echo "<td>" . "Rp " . number_format($hasil_neraca, 0, ",", ".") . "</td>";
                }
                else
                {
                  $hasil_neraca = $kredit_neraca - $debet_neraca;
                  echo "<td>" . "Rp " . number_format($hasil_neraca, 0, ",", ".") . "</td>";
                  echo "<td></td>";
                }
              ?>
            </tr>
          </tbody>
        </table>

        <table class="table mx-auto">
          <tr>
              <td colspan="3"><strong>Pendapatan</strong></td>
          </tr>
          <tr>
            <td>4101</td>
            <td>Penjualan</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_4101_kredit - $kode_akun_4101_debet), 0, ",", ".");
                $kode_akun_4000 = $kode_akun_4000 + ($kode_akun_4101_kredit - $kode_akun_4101_debet);
              ?>
            </td>
          </tr>
          <tr>
            <td>4102</td>
            <td>Potongan Penjualan</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_4102_kredit - $kode_akun_4102_debet), 0, ",", ".");
                $kode_akun_4000 = $kode_akun_4000 + ($kode_akun_4102_kredit - $kode_akun_4102_debet);
              ?>
            </td>
          </tr>
          <tr>
            <td>4104</td>
            <td>Pendapatan Diterima Dimuka</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_4104_kredit - $kode_akun_4104_debet), 0, ",", ".");
                $kode_akun_4000 = $kode_akun_4000 + ($kode_akun_4104_kredit - $kode_akun_4104_debet);
              ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><strong>Total Pendapatan</strong></td>
            <td>
              <?php
                $hasil_pendapatan = $kode_akun_4000;
                echo "<strong>Rp " . number_format($kode_akun_4000, 0, ",", ".") . "</strong>";
              ?>
            </td>
          </tr>

          <tr>
            <td colspan="3"><strong>HPP</strong></td>
          </tr>
          <tr>
            <td>5101</td>
            <td>Pembelian</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_5101_debet - $kode_akun_5101_kredit), 0, ",", ".");
                $kode_akun_5000 = $kode_akun_5000 + ($kode_akun_5101_debet - $kode_akun_5101_kredit);
              ?>
            </td>
          </tr>
          <tr>
            <td>5102</td>
            <td>Potongan Pembelian</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_5102_debet - $kode_akun_5102_kredit), 0, ",", ".");
                $kode_akun_5000 = $kode_akun_5000 + ($kode_akun_5102_debet - $kode_akun_5102_kredit);
              ?>
            </td>
          </tr>
          <tr>
            <td>5104</td>
            <td>Uang Muka Pembelian</td>
            <td>
              <?php
                echo "Rp " . number_format(($kode_akun_5104_debet - $kode_akun_5104_kredit), 0, ",", ".");
                $kode_akun_5000 = $kode_akun_5000 + ($kode_akun_5104_debet - $kode_akun_5104_kredit);
              ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><strong>Total HPP</strong></td>
            <td>
              <?php
                $hasil_hpp = $kode_akun_5000;
                echo "<strong>Rp " . number_format($kode_akun_5000, 0, ",", ".") . "</strong>";
              ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <?php
              if($hasil_pendapatan > $hasil_hpp)
              {
                ?>
                <td><strong>Laba Kotor</strong></td>
                <td>
                  <?php echo "<strong>Rp " . number_format($hasil_pendapatan - $hasil_hpp, 0, ",", ".") . "</strong>"; ?>
                </td>
                <?php
              }
              else
              {
                ?>
                <td><strong>Rugi Kotor</strong></td>
                <td>
                  <?php echo "<strong>Rp " . number_format($hasil_hpp - $hasil_pendapatan, 0, ",", ".") . "</strong>"; ?>
                </td>
                <?php
              }
            ?>
          </tr>
        </table>
    </body>
  </html>

  <?php
  /*
  $html = ob_get_clean();
  $dompdf = new Dompdf();

  $dompdf->loadHtml($html);

  $dompdf->render();

  $dompdf->stream("laporan_keuangan.pdf");
  */
  ?>
