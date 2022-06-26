<?php include "security.php"; ?>
<?php include "config.php";

  
  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();
  
  ?>
  <?php include "config.php";
    $pelanggan_id = $_GET['id'];
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

      <title>Pelanggan Piutang</title>
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
        <h2 class="text-center">Laporan Piutang</h2>
        <h4 class="text-center">
          <?php
            $sql = "SELECT pelanggan.nama AS 'pelanggan_nama', pelanggan.pelanggan_info_id AS 'pelanggan_info_id_pelanggan', pelanggan_info.nama_org AS 'pelanggan_info_nama_org' FROM pelanggan LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id WHERE pelanggan.id = $pelanggan_id";
            
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
            $pelanggan_info_id_pelanggan = $row['pelanggan_info_id_pelanggan'];
            $pelanggan_info_nama_org = $row['pelanggan_info_nama_org'];
            if($pelanggan_info_id_pelanggan == "")
            {
              $pelanggan_info_nama_org_result = "";
            }
            else
            {
              $pelanggan_info_nama_org_result = " (" . $pelanggan_info_nama_org . ")";
            }
            echo $row['pelanggan_nama'] . $pelanggan_info_nama_org_result;
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
              $sql = "SELECT sales_quotation.id AS 'id_sales_quotation', sales_quotation.pajak AS 'pajak_sales_quotation', pelanggan.nama AS 'pelanggan_nama', perform_invoice.termin AS 'termin_perform_invoice', invoice.id AS 'id_invoice' FROM sales_quotation INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id WHERE sales_quotation.pelanggan_id = $pelanggan_id AND perform_invoice.termin > 0 ORDER BY invoice.tanggal";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);

              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $id_sales_quotation = $row['id_sales_quotation'];
                  $id_invoice = $row['id_invoice'];
                  $sql_check_invoice_status_pembayaran = "SELECT invoice_status_pembayaran.status AS 'status_invoice_status_pembayaran', invoice_status_pembayaran.tanggal AS 'tanggal_invoice_status_pembayaran' FROM invoice_status_pembayaran INNER JOIN invoice ON invoice_status_pembayaran.invoice_id = invoice.id WHERE invoice.id = $id_invoice ORDER BY invoice_status_pembayaran.tanggal DESC LIMIT 1";
                  $query_check_invoice_status_pembayaran = mysqli_query($conn, $sql_check_invoice_status_pembayaran);
                  $row_check_invoice_status_pembayaran = mysqli_fetch_array($query_check_invoice_status_pembayaran);

                  if($row_check_invoice_status_pembayaran['status_invoice_status_pembayaran'] == 'bayar')
                  {

                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row_check_invoice_status_pembayaran['tanggal_invoice_status_pembayaran']);
                        ?>
                      </td>
                      <td>
                        <?php
                          show_due_date($row_check_invoice_status_pembayaran['tanggal_invoice_status_pembayaran'], $row['termin_perform_invoice']);
                        ?>
                      </td>
                      <td>
                        <?php echo "INV" . $row['id_invoice']; ?>
                      </td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM sales_quotation INNER JOIN sales_quotation_detail ON sales_quotation.id = sales_quotation_detail.sales_quotation_id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE invoice.id = '$id_invoice' AND invoice_status_pembayaran.status = 'bayar'";

                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation.id = sales_quotation_detail.sales_quotation_id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'bayar'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);                        
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];

                        $subtotal = ($row_total_harga['total_harga'] - floatval($diskon_sales_quotation)) + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100));
                        $subtotal_down_payment = (($row_total_harga['total_harga'] - floatval($diskon_sales_quotation)) + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100))) * ($row_total_harga['down_payment'] / 100);
                        echo "Rp " . number_format($subtotal - $subtotal_down_payment, 0, ",", ".");

                        $total_harga = $total_harga + ($subtotal - $subtotal_down_payment);
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                  else if($row_check_invoice_status_pembayaran['status_invoice_status_pembayaran'] == 'aktif')
                  {
                    ?>
                    <tr>
                      <td style="white-space: nowrap;">
                        <?php
                          show_date($row_check_invoice_status_pembayaran['tanggal_invoice_status_pembayaran']);
                        ?>
                      </td>
                      <td>
                        <?php
                          show_due_date($row_check_invoice_status_pembayaran['tanggal_invoice_status_pembayaran'], $row['termin_perform_invoice']);
                        ?>
                      </td>
                      <td>
                        <?php echo "INV" . $row['id_invoice']; ?>
                      </td>
                      <td>
                        <?php
                        $sql_total_harga = "SELECT SUM(sales_quotation_detail.harga_jual * sales_quotation_detail.qty) AS 'total_harga', perform_invoice.down_payment AS 'down_payment' FROM sales_quotation INNER JOIN sales_quotation_detail ON sales_quotation.id = sales_quotation_detail.sales_quotation_id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif'";

                        $query_total_harga = mysqli_query($conn, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_array($query_total_harga);
                        $pajak_sales_quotation = $row['pajak_sales_quotation'];

                        $sql_total_diskon = "SELECT SUM((sales_quotation_detail.harga_jual *  sales_quotation_detail.qty) * (sales_quotation_detail.diskon / 100)) AS 'total_diskon' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation.id = sales_quotation_detail.sales_quotation_id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id INNER JOIN invoice_status_pembayaran ON invoice.id = invoice_status_pembayaran.invoice_id WHERE sales_quotation_detail.sales_quotation_id = '$id_sales_quotation' AND invoice_status_pembayaran.status = 'aktif'";
                        $query_total_diskon = mysqli_query($conn, $sql_total_diskon);
                        $row_total_diskon = mysqli_fetch_array($query_total_diskon);
                        $diskon_sales_quotation = $row_total_diskon['total_diskon'];
                        
                        echo "Rp " . number_format(($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation)), 0, ",", ".");

                        $total_harga = $total_harga + ($row_total_harga['total_harga'] + ($row_total_harga['total_harga'] * ($pajak_sales_quotation / 100)) - floatval($diskon_sales_quotation));
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

  $dompdf->stream("pelanggan_piutang.pdf");
  
  ?>
