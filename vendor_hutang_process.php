<?php include "security.php"; ?>
<?php include "config.php";


  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();

  ?>
  <?php include "config.php";
    $vendor_id = $_GET['id'];
    $total_harga = 0;
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

    function show_due_date($data1, $data2)
    {
      echo date("m/d/Y", strtotime($data1 . "+" . $data2 . " days"));
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

      <title>Vendor Hutang</title>
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
        <h2 class="text-center">Laporan Hutang</h2>
        <h4 class="text-center">
          <?php
            $sql = "SELECT * FROM vendor WHERE id = $vendor_id";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
            echo $row['nama'];
          ?>
        </h4>
        <table class="table mx-auto">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Jatuh Tempo</th>
              <th>ID Transaksi</th>
              <th>Nominal</th>
            </tr>
          </thead>
          <tbody>

            <?php
              /* pembelian section */
              $sql = "SELECT pembelian.id AS 'id_pembelian', pembelian.pajak AS 'pajak_pembelian', vendor.nama AS 'vendor_nama', pembelian.termin AS 'termin_pembelian' FROM pembelian INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.vendor_id = $vendor_id AND pembelian.termin > 0 ORDER BY pembelian.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);

              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_pembelian = $row['id_pembelian'];
                  $sql_check_pembelian_status_pembayaran = "SELECT pembelian_status_pembayaran.status AS 'status_pembelian_status_pembayaran', pembelian_status_pembayaran.tanggal AS 'tanggal_pembelian_status_pembayaran' FROM pembelian_status_pembayaran INNER JOIN pembelian ON pembelian_status_pembayaran.pembelian_id = pembelian.id WHERE pembelian_id = $id_pembelian ORDER BY pembelian_status_pembayaran.tanggal DESC LIMIT 1";
                  $query_check_pembelian_status_pembayaran = mysqli_query($conn, $sql_check_pembelian_status_pembayaran);
                  $row_check_pembelian_status_pembayaran = mysqli_fetch_array($query_check_pembelian_status_pembayaran);

                  if($row_check_pembelian_status_pembayaran['status_pembelian_status_pembayaran'] == 'bayar')
                  {

                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row_check_pembelian_status_pembayaran['tanggal_pembelian_status_pembayaran']);
                        ?>
                      </td>
                      <td>
                        <?php
                          show_due_date($row_check_pembelian_status_pembayaran['tanggal_pembelian_status_pembayaran'], $row['termin_pembelian']);
                        ?>
                      </td>
                      <td>
                        <?php echo "PB" . $row['id_pembelian']; ?>
                      </td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar'";

                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_pembelian = $row['pajak_pembelian'];

                        $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_pembelian = $row_total_diskon['total_diskon'];

                        $subtotal = ($row_total_harga['total_harga'] - floatval($diskon_pembelian)) + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100));
                        $subtotal_down_payment = (($row_total_harga['total_harga'] - floatval($diskon_pembelian)) + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100))) * ($row_total_harga['down_payment'] / 100);
                        echo "Rp " . number_format($subtotal - $subtotal_down_payment, 0, ",", ".");

                        $total_harga = $total_harga + ($subtotal - $subtotal_down_payment);
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                  else if($row_check_pembelian_status_pembayaran['status_pembelian_status_pembayaran'] == 'aktif')
                  {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row_check_pembelian_status_pembayaran['tanggal_pembelian_status_pembayaran']);
                        ?>
                      </td>
                      <td>
                        <?php
                          show_due_date($row_check_pembelian_status_pembayaran['tanggal_pembelian_status_pembayaran'], $row['termin_pembelian']);
                        ?>
                      </td>
                      <td>
                        <?php echo "PB" . $row['id_pembelian']; ?>
                      </td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(produk.harga * pembelian_detail.qty) AS 'total_harga', pembelian.down_payment AS 'down_payment' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'aktif'";

                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_pembelian = $row['pajak_pembelian'];

                        $sql_total_diskon = "SELECT SUM((produk.harga *  pembelian_detail.qty) * (pembelian_detail.diskon / 100)) AS 'total_diskon' FROM pembelian_detail INNER JOIN pembelian ON pembelian.id = pembelian_detail.pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id INNER JOIN pembelian_status_pembayaran ON pembelian.id = pembelian_status_pembayaran.pembelian_id WHERE pembelian_detail.pembelian_id = '$id_pembelian' AND pembelian_status_pembayaran.status = 'bayar'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_pembelian = $row_total_diskon['total_diskon'];

                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian)), 0, ",", ".");

                        $total_harga = $total_harga + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_pembelian / 100)) - floatval($diskon_pembelian));
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                  else
                  {
                    ?>
                    <?php
                  }
                }
                ?>
                  <tr>
                    <td colspan="3" align="right"><strong>Total</strong></td>
                    <td><strong><?php echo "Rp " . number_format($total_harga, 0, ",", "."); ?></strong></td>
                  </tr>
                <?php
              }
              else
              {
                echo "<tr><td colspan='4' class='text-center'>Hasil tidak ada</td></tr>";
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

  $dompdf->stream("vendor_hutang.pdf");

  ?>
