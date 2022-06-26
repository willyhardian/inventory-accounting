<?php include "security.php"; ?>
<?php include "config.php";



  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();


  ?>
  <?php
    $sales_quotation_id = $_GET['id'];

    /*
    $tanggal_dibuat = $_GET['tanggal_dibuat'];
    $penerima = $_GET['penerima'];
    $penerima_hp = $_GET['penerima_hp'];
    $tujuan = $_GET['tujuan'];
    $disiapkan_oleh = $_GET['disiapkan_oleh'];
    $disetujui_oleh = $_GET['disetujui_oleh'];
    $dikirim_oleh = $_GET['dikirim_oleh'];
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

      <title>Sales Quotation</title>
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
        <h2 class="text-center">Delivery Order</h2>
        <?php
          $sql = "SELECT do.id AS 'do_id', do.tanggal AS 'do_tanggal', do.keterangan AS 'do_keterangan', do.tujuan AS 'do_tujuan', do.penerima AS 'do_penerima', do.penerima_hp AS 'do_penerima_hp', do.catatan AS 'do_catatan', pelanggan.nama AS 'pelanggan_nama', pelanggan.phone AS 'pelanggan_phone', pelanggan.jenis_kelamin AS 'pelanggan_jenis_kelamin', pelanggan_info.nama_org AS 'pelanggan_info_nama_org', pelanggan_info.alamat AS 'pelanggan_info_alamat', sales_quotation.id AS 'sales_quotation_id', perform_invoice.purchase_order_pelanggan_id AS 'perform_invoice_purchase_order_pelanggan_id', purchase_order_pelanggan.tanggal AS 'purchase_order_pelanggan_tanggal', do.disiapkan_oleh AS 'do_disiapkan_oleh', do.disetujui_oleh AS 'do_disetujui_oleh', do.dikirim_oleh AS 'do_dikirim_oleh' FROM invoice INNER JOIN perform_invoice ON invoice.perform_invoice_id = perform_invoice.id LEFT JOIN sales_quotation ON perform_invoice.sales_quotation_id = sales_quotation.id INNER JOIN pelanggan ON sales_quotation.pelanggan_id = pelanggan.id LEFT JOIN pelanggan_info ON pelanggan.pelanggan_info_id = pelanggan_info.id LEFT JOIN purchase_order_pelanggan ON perform_invoice.purchase_order_pelanggan_id = purchase_order_pelanggan.id INNER JOIN do ON invoice.id = do.invoice_id WHERE do.id = $sales_quotation_id";

          $query = mysqli_query($conn, $sql);
          $query = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($query);
          echo $conn->error;
          $do_id = $row['do_id'];
          $purchase_order_pelanggan_tanggal = $row['purchase_order_pelanggan_tanggal'];
          $purchase_order_pelanggan_tanggal = $row['purchase_order_pelanggan_tanggal'];
          $perform_invoice_purchase_order_pelanggan_id = $row['perform_invoice_purchase_order_pelanggan_id'];
          $do_tanggal = $row['do_tanggal'];
          $sales_quotation_id = $row['sales_quotation_id'];
          $keterangan = $row['do_keterangan'];
          $tujuan = $row['do_tujuan'];
          $penerima = $row['do_penerima'];
          $penerima_hp = $row['do_penerima_hp'];
          $catatan = $row['do_catatan'];
          $disiapkan_oleh = $row['do_disiapkan_oleh'];
          $disetujui_oleh = $row['do_disetujui_oleh'];
          $dikirim_oleh = $row['do_dikirim_oleh'];
        ?>
        <table class="table mx-auto">
          <thead>
            <tr>
              <td rowspan="5" style="border: 0px;">Kepada</td>
              <td rowspan="5" style="border: 0px;">
                <?php
                  echo $row['pelanggan_info_nama_org'] . "<br>" . $row['pelanggan_info_alamat'] . "<br>";
                  if($row['pelanggan_jenis_kelamin'] == 'laki-laki')
                  {
                    echo "Bapak " . $row['pelanggan_nama'];
                  }
                  else
                  {
                    echo "Ibu " . $row['pelanggan_nama'];
                  }
                ?>
              </td>
              <td style="border: 0px;">Nomor</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php echo "DO" . $do_id; ?></td>
            </tr>
            <tr>
              <td style="border: 0px;">Tanggal</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php show_date($do_tanggal) ?></tr>
            </tr>
            <tr>
              <td style="border: 0px;">No PO</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php echo "PO" . $perform_invoice_purchase_order_pelanggan_id; ?></td>
            </tr>
            <tr>
              <td style="border: 0px;">Tanggal PO</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php echo show_date($purchase_order_pelanggan_tanggal); ?></td>
            </tr>
            <tr>
              <td style="border: 0px;">ID SQ</td>
              <td style="border: 0px;" align="right">:</td>
              <td style="border: 0px;"><?php echo "SQ" . $sales_quotation_id; ?></td>
            </tr>
            <tr>
              <th>No</th>
              <th>Item Description</th>
              <th colspan="2">Qty</th>
              <th>Unit</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              $sql = "SELECT sales_quotation_detail.produk_id AS 'produk_id_sales_quotation_detail', sales_quotation.pajak AS 'sales_quotation_pajak', produk.harga AS 'produk_harga', sales_quotation_detail.diskon AS 'sales_quotation_detail_diskon', item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', warna.nama AS 'warna_nama', kategori.nama AS 'kategori_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', satuan.nama AS 'satuan_nama', merek.nama AS 'merek_nama', sales_quotation_detail.qty AS 'sales_quotation_detail_qty' FROM sales_quotation_detail INNER JOIN sales_quotation ON sales_quotation_detail.sales_quotation_id = sales_quotation.id INNER JOIN produk ON sales_quotation_detail.produk_id = produk.id LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN merek ON produk.merek_id = merek.id INNER JOIN perform_invoice ON sales_quotation.id = perform_invoice.sales_quotation_id INNER JOIN invoice ON perform_invoice.id = invoice.perform_invoice_id WHERE invoice.id = '$invoice_id'";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $no = $no + 1;
                  $sales_quotation_detail_qty = $row['sales_quotation_detail_qty'];
                  $produk_harga = $row['produk_harga'];
                  $sales_quotation_detail_diskon = $row['sales_quotation_detail_diskon'];
                  $sales_quotation_pajak = $row['sales_quotation_pajak'];
                  $total = 0;
                  ?>
                    <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td><?php echo $row['item_nama'] . ' ' . $row['jenis_nama'] . ' ' . $row['warna_nama'] . ' ' . $row['kategori_nama'] . ' ' . $row['merek_nama'] . ' dia. ' . $row['produk_diameter'] . '" @' . $row['produk_panjang'] . 'cm/' . $row['satuan_nama']; ?></td>
                        <td colspan="2" align="center"><?php echo $row['sales_quotation_detail_qty']; ?></td>
                        <td align="center"><?php echo $row['satuan_nama']; ?></td>
                    </tr>
                  <?php
                }
              }
              else
              {
                echo "<tr><td colspan='4'>Hasil tidak ada</td></tr>";
              }
            ?>
            <tr>
              <td colspan="2" style="border: 0px;"></td>
              <td style="border: 0px;">Keterangan</td>
              <td style="border: 0px;">:</td>
              <td style="border: 0px;"><?php echo ucfirst($keterangan); ?></td>
            </tr>
            <tr>
              <td colspan="2" style="border: 0px;"></td>
              <td style="border: 0px;">Tujuan</td>
              <td style="border: 0px;">:</td>
              <td style="border: 0px;"><?php echo $tujuan; ?></td>
            </tr>
            <tr>
              <td colspan="2" style="border: 0px;"></td>
              <td style="border: 0px;">Penerima</td>
              <td style="border: 0px;">:</td>
              <td style="border: 0px;"><?php echo $penerima . " (" . $penerima_hp . ")"; ?></td>
            </tr>
            <tr>
              <td colspan="2" style="border: 0px;"></td>
              <td style="border: 0px;">Catatan</td>
              <td style="border: 0px;">:</td>
              <td style="border: 0px;"><?php echo $catatan; ?></td>
            </tr>
          </tbody>
        </table>
        <div style="page-break-after: always"></div>
        <div class="container-900 mx-auto mt-5">
          <table id="ttd_delivery_order" border="1">
              <tr>
                  <td>Disiapkan Oleh</td>
                  <td>Disetujui Oleh</td>
                  <td>Dikirim Oleh</td>
                  <td>Diterima Oleh</td>
              </tr>
              <tr>
                  <td style="height: 100px"></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              <tr>
                  <td><?php echo $disiapkan_oleh; ?></td>
                  <td><?php echo $disetujui_oleh; ?></td>
                  <td><?php echo $dikirim_oleh; ?></td>
                  <td></td>
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

  $dompdf->stream("delivery_order.pdf");


  ?>
