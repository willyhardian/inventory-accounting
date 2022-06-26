<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];
  $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
  $query = mysqli_query($conn, $sql);

  $debet = array();
  $kredit = array();


  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();

  ?>
  <?php include "config.php";
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $pembelian_exist = 1;
    $invoice_exist = 1;
    /*
    $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    */

    function show_date($data)
    {
      echo date("d/m/Y", strtotime($data));
    }
    function show_period($data1, $data2)
    {
        echo date("d/m/Y", strtotime($data1)) . " - " . date("d/m/Y", strtotime($data2));
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

      <title>Jurnal Umum</title>
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
        <h2 class="text-center">Jurnal Umum</h2>
        <h4 class="text-center">
          <?php show_period($tanggal_awal, $tanggal_akhir) ?>
        </h4>
        <table class="table mx-auto">
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
                      <td style="white-space: nowrap;">
                        <?php
                          echo show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
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
                      <td style="white-space: nowrap;">
                        <?php
                          echo date("m/d/Y", strtotime($row['pembelian_status_pembayaran_tanggal']));
                        ?>
                      </td>
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
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['pembelian_status_pembayaran_tanggal']);
                            ?>
                          </td>
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
                            <td style="white-space: nowrap;">
                              <?php
                                show_date($row['pembelian_status_pembayaran_tanggal']);
                              ?>
                            </td>
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
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['pembelian_status_pembayaran_tanggal']);
                          ?>
                        </td>
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
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
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
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['pembelian_status_pembayaran_tanggal']);
                        ?>
                      </td>
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
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['invoice_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "INV" . $row['id_invoice']; ?></td>
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
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['invoice_status_pembayaran_tanggal']);
                        ?>
                      </td>
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
                          <td style="white-space: nowrap;">
                            <?php
                              show_date($row['invoice_status_pembayaran_tanggal']);
                            ?>
                          </td>
                          <td><?php echo "INV" . $row['id_invoice']; ?></td>
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
                            <td style="white-space: nowrap;">
                              <?php
                                show_date($row['invoice_status_pembayaran_tanggal']);
                              ?>
                            </td>
                            <td><?php echo "INV" . $row['id_invoice']; ?></td>
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
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>

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
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row['invoice_status_pembayaran_tanggal']);
                        ?>
                      </td>
                      <td><?php echo "INV" . $row['id_invoice']; ?></td>

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
                        <td style="white-space: nowrap;">
                          <?php
                            show_date($row['invoice_status_pembayaran_tanggal']);
                          ?>
                        </td>
                        <td><?php echo "INV" . $row['id_invoice']; ?></td>
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
    </body>
  </html>

  <?php

  
  $html = ob_get_clean();
  $dompdf = new Dompdf();

  $dompdf->loadHtml($html);

  $dompdf->render();

  $dompdf->stream("jurnal_umum.pdf");

  ?>
