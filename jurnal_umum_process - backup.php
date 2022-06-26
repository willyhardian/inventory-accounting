<?php include "config.php";
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];
  $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
  $query = mysqli_query($conn, $sql);
  // Include autoloader
  header('Content-type: text/html; charset=UTF-8') ;//chrome
  require_once 'includes/dompdf/autoload.inc.php';

  // Reference the Dompdf namespace
  use Dompdf\Dompdf;
  ob_start();
  ?>
  <?php include "config.php";
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    /*
    $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    */
    $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian_status_pembayaran.tanggal AS 'pembelian_status_pembayaran_tanggal', pembelian.produk_id AS 'pembelian_produk_id', pembelian_status_pembayaran.status AS 'pembelian_status_pembayaran_status' FROM pembelian INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_status_pembayaran.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    $query = mysqli_query($conn, $sql);
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
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  ?>
                    <tr>
                      <td><?php echo $row['pembelian_status_pembayaran_tanggal']; ?></td>
                      <td><?php echo $row['id_pembelian']; ?></td>
                      <td>
                        <?php
                          if($row['pembelian_status_pembayaran_status'] == 'bayar')
                          {
                            echo "5104"
                          }
                          else if($row['pembelian_status_pembayaran_status'] == 'lunas')
                          {
                            echo "2101"
                          }
                          else
                          {
                            echo "5101"
                          }
                        ?>
                        <?php echo //$row['kode_akun_id_beban']; ?>
                      </td>
                      <td>
                        <?php
                          if($row['pembelian_status_pembayaran_status'] == 'aktif')
                          {
                            	echo "Pembelian AP";
                          }
                          else if($row['pembelian_status_pembayaran_status'] == 'aktif')
                          {
                            echo "UANG MUKA PEMBELIAN";
                          }
                          else
                          {
                            echo "Pembelian";
                          }
                        ?>
                        <?php echo //$row['kode_akun_nama']; ?>
                      </td>
                      <td><?php echo $row['pembelian_produk_id']; ?></td>
                      <td>
                        <?php echo //$row['harga_beban']; ?>
                      </td>
                      <td>-</td>
                    </tr>
                  <?php
                }

              }
              else
              {
                echo "<td colspan='7' class='text-center'>Hasil tidak ada</td>";
              }

            ?>

          </tbody>
        </table>
    </body>
  </html>

  <?php

  // Instantiate and use the dompdf class
  $html = ob_get_clean();
  $dompdf = new Dompdf();

  //$dompdf->load_html(ob_get_clean());

  // Load HTML content
  /*
  $html = file_get_contents("jurnal_umum_laporan.php?tanggal_awal=2020-08-01&tanggal_akhir=2020-09-01");


  */
  $dompdf->loadHtml($html);
  // (Optional) Setup the paper size and orientation
  //$dompdf->setPaper('A4', 'potrait');

  // Render the HTML as PDF
  $dompdf->render();


  // Output the generated PDF to Browser

  $dompdf->stream();
  ?>
