<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];
  $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
  $query = mysqli_query($conn, $sql);

  $total_subtotal = 0;
  $total_diskon = 0;
  $total_pajak = 0;
  $total_pembelian = 0;


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

      <title>Laporan Pembelian</title>
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
        <h2 class="text-center">Laporan Pembelian</h2>
        <h4 class="text-center">
          <?php show_period($tanggal_awal, $tanggal_akhir) ?>
        </h4>
        <table class="table mx-auto">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>ID Transaksi</th>
              <th>Vendor</th>
              <th>Subtotal</th>
              <th>Diskon</th>
              <th>Pajak</th>
              <th>Total Pembelian</th>
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
                  if($row['pembelian_status_pembayaran_status'] == 'lunas')
                  {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          echo date("m/d/Y", strtotime($row['pembelian_status_pembayaran_tanggal']));
                        ?>
                      </td>
                      <td><?php echo "PB" . $row['id_pembelian']; ?></td>
                      <td><?php echo $row['vendor_nama']; ?></td>
                      <td>
                        <?php
                          $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                          $query_total_harga = mysqli_query($conn, $sql_total_harga);
                          $row_total_harga = mysqli_fetch_array($query_total_harga);
                          echo "Rp " . number_format($row_total_harga['total_harga'], 0, ",", ".");

                          $total_subtotal = $total_subtotal + $row_total_harga['total_harga'];
                        ?>
                      </td>

                      <?php
                        $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.diskon / 100) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        if($row_total_diskon['total_diskon'] > 0)
                        {
                          ?>

                            <td>
                              <?php
                                $sql_total_diskon = "SELECT SUM(produk.harga * pembelian_detail.qty * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                                $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                                $pajak_pembelian = $row['pajak_pembelian'];
                                $diskon_pembelian = $row_total_diskon['total_diskon'];
                                echo "Rp " . number_format(floatval($diskon_pembelian), 0, ",", ".");

                                $total_diskon = $total_diskon + floatval($diskon_pembelian);
                              ?>
                              <?php //echo $row['harga_beban']; ?>
                            </td>

                          <?php
                        }
                      ?>

                    <?php
                      if($row['pajak_pembelian'] > 0)
                      {
                        ?>
                          <td>
                            <?php
                              $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              $query_total_harga = mysqli_query($conn, $sql_total_harga);
                              $row_total_harga = mysqli_fetch_array($query_total_harga);
                              $pajak_pembelian = $row['pajak_pembelian'];
                              echo "Rp " . number_format($row_total_harga['total_harga'] * ($pajak_pembelian / 100), 0, ",", ".");

                              $total_pajak = $total_pajak + $row_total_harga['total_harga'] * ($pajak_pembelian / 100);
                            ?>
                          </td>
                        <?php
                      }
                    ?>
                        <td>
                          <?php
                            $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = $id_pembelian AND pembelian_status_pembayaran.status = 'lunas' AND pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                            $query_total_harga = mysqli_query($conn, $sql_total_harga);
                            $row_total_harga = mysqli_fetch_array($query_total_harga);
                            $pajak_pembelian = $row['pajak_pembelian'];
                            echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian, 0, ",", ".");

                            $total_pembelian = $total_pembelian + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) - $diskon_pembelian;
                          ?>
                        </td>
                      </tr>

                    <?php
                  }
                }
              }
              else
              {
                $pembelian_exist = 0;
              }
              /* end of pembelian section */



              if($pembelian_exist == 0)
              {
                echo "<td colspan='7' class='text-center'>Hasil tidak ada</td>";
              }
              else
              {
                ?>
                <tr>
                  <td colspan="3" align="right"><strong>Total</strong></td>
                  <td><strong><?php echo "Rp " . number_format($total_subtotal, 0, ",", "."); ?></strong></td>
                  <td><strong><?php echo "Rp " . number_format($total_diskon, 0, ",", "."); ?></strong></td>
                  <td><strong><?php echo "Rp " . number_format($total_pajak, 0, ",", "."); ?></strong></td>
                  <td><strong><?php echo "Rp " . number_format($total_pembelian, 0, ",", "."); ?></strong></td>
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

  $dompdf->stream("laporan_pembelian.pdf");

  ?>
