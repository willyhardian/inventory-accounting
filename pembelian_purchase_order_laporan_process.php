<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_dibuat = $_POST['tanggal_dibuat'];
  $purchasing = $_POST['purchasing'];
  $disetujui_oleh = $_POST['disetujui_oleh'];
  $pembelian_id = $_POST['pembelian_id'];

  $debet = array();
  $kredit = array();


  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();


  ?>
  <?php
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

      <title>Purchase Order</title>
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
        <h2 class="text-center">Purchase Order</h2>
        <?php
          $sql = "SELECT vendor.nama AS 'vendor_nama', pembelian.termin AS 'termin_pembelian' FROM pembelian INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.id = $pembelian_id";
          $query = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($query);
        ?>
        <table class="table mx-auto">
          <thead>
            <tr>
              <td rowspan="3" style="border: 0px;">Kepada</td>
              <td rowspan="3" colspan="3" style="border: 0px;"><?php echo $row['vendor_nama']; ?></td>
              <td style="border: 0px;">Nomor</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php echo "PB" . $pembelian_id; ?></td>
            </tr>
            <tr>
              <td style="border: 0px;">Termin</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;">
                <?php
                  if($row['termin_pembelian'] == 0)
                  {
                    echo " -";
                  }
                  else
                  {
                    echo " " . $row['termin_pembelian'] . " hari";
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td style="border: 0px;">Tanggal</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php show_date($tanggal_dibuat) ?></tr>
            </tr>
            <tr>
              <th>No</th>
              <th>Item Description</th>
              <th>Qty</th>
              <th>Unit</th>
              <th>Unit Price</th>
              <th>Discount</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              $sql = "SELECT pembelian_detail.produk_id AS 'produk_id_pembelian_detail', pembelian.pajak AS 'pembelian_pajak', produk.harga AS 'produk_harga', pembelian_detail.diskon AS 'pembelian_detail_diskon', item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', standard.nama AS 'standard_nama', tipe.nama AS 'tipe_nama', warna.nama AS 'warna_nama', kategori.nama AS 'kategori_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', satuan.nama AS 'satuan_nama', merek.nama AS 'merek_nama', pembelian_detail.qty AS 'pembelian_detail_qty' FROM pembelian_detail INNER JOIN pembelian ON pembelian_detail.pembelian_id = pembelian.id INNER JOIN produk ON pembelian_detail.produk_id = produk.id LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN standard ON jenis.id = standard.jenis_id LEFT JOIN tipe ON standard.id = tipe.standard_id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN merek ON produk.merek_id = merek.id WHERE pembelian_detail.pembelian_id = '$pembelian_id'";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $no = $no + 1;
                  $pembelian_detail_qty = $row['pembelian_detail_qty'];
                  $produk_harga = $row['produk_harga'];
                  $pembelian_detail_diskon = $row['pembelian_detail_diskon'];
                  $pembelian_pajak = $row['pembelian_pajak'];
                  $total = 0;
                  $total_discount_purchase_order = 0;
                  ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['item_nama'] . ' ' . $row['jenis_nama'] . ' ' . $row['standard_nama'] . ' '. $row['tipe_nama'] . ' ' . $row['warna_nama'] . ' ' . $row['kategori_nama'] . ' ' . $row['merek_nama'] . 'dia. ' . $row['produk_diameter'] . '" @' . $row['produk_panjang'] . 'cm/' . $row['satuan_nama']; ?></td>
                        <td><?php echo $row['pembelian_detail_qty']; ?></td>
                        <td><?php $row['satuan_nama']; ?></td>
                        <td><?php echo "Rp " . number_format($row['produk_harga'], 0, ",", "."); ?></td>
                        <td><?php echo $row['pembelian_detail_diskon'] . "%"; ?></td>
                        <td><?php echo "Rp " . number_format(($produk_harga * $pembelian_detail_qty) - ($produk_harga * $pembelian_detail_qty * ($pembelian_detail_diskon / 100)), 0, ",", "."); ?></td>
                        <?php
                          $total_discount_purchase_order = $total_discount_purchase_order + ($produk_harga * $pembelian_detail_qty * ($pembelian_detail_diskon / 100));
                          $total = $total + ($produk_harga * $pembelian_detail_qty) - ($produk_harga * $pembelian_detail_qty * ($pembelian_detail_diskon / 100));
                        ?>
                    </tr>
                  <?php
                }
                ?>
                <tr>
                  <td colspan="6" align="right">Subtotal</td>
                  <td><?php echo "Rp " . number_format($total, 0, ",", "."); ?></td>
                </tr>
                <tr>
                  <td colspan="6" align="right">Discount</td>
                  <td><?php echo "Rp " . number_format($total_discount_purchase_order, 0, ",", "."); ?></td>
                </tr>
                <tr>
                  <td colspan="6" align="right">PPN <?php echo $pembelian_pajak . "%"; ?></td>
                  <td><?php echo "Rp " . number_format($total * (10 / 100), 0, ",", "."); ?></td>
                </tr>
                <tr>
                  <td colspan="6" align="right"><strong>Total</strong></td>
                  <td><strong><?php echo "Rp " . number_format($total + ($total * (10 / 100)), 0, ",", "."); ?></strong></td>
                </tr>
                <?php
              }
              else
              {
                echo "<tr><td colspan='4'>Hasil tidak ada</td></tr>";
              }
            ?>
          </tbody>
        </table>

        <div style="page-break-after: always"></div>

        <div class="container-900 mx-auto mt-5">
          <table id="ttd_pembelian_purchase_order">
              <tr>
                  <td>Purchasing</td>
                  <td>Disetujui Oleh</td>
              </tr>
              <tr>
                  <td style="height: 100px"></td>
                  <td></td>
              </tr>
              <tr>
                  <td><?php echo $purchasing; ?></td>
                  <td><?php echo $disetujui_oleh; ?></td>
              </tr>
          </table>
        </div>
    </body>
  </html>

  <?php


  $html = ob_get_clean();
  $dompdf = new Dompdf();

  $dompdf->loadHtml($html);

  $dompdf->render();

  $dompdf->stream("pembelian_po.pdf");


  ?>
