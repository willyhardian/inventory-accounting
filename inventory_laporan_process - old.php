<?php include "security.php"; ?>
<?php include "config.php";

  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];

  /*
  header('Content-type: text/html; charset=UTF-8') ;
  require_once 'includes/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;
  ob_start();
  */

  ?>
  <?php


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

      <title>Laporan Stok</title>
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
        <h2 class="text-center">Laporan Stok</h2>
        <?php
          $sql = "SELECT vendor.nama AS 'vendor_nama', pembelian.termin AS 'termin_pembelian' FROM pembelian INNER JOIN vendor ON pembelian.vendor_id = vendor.id WHERE pembelian.id = $pembelian_id";
          $query = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($query);
        ?>
        <table class="table mx-auto">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Lokasi</th>
              <th>Stok Awal</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Stok Akhir</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              /*
              // old version
              $sql = "SELECT item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', warna.nama AS 'warna_nama', kategori.nama AS 'kategori_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', satuan.nama AS 'satuan_nama', merek.nama AS 'merek_nama', inventory.qty AS 'qty_berdiri',
               (SUM(inventory_riwayat.qty) + inventory.qty) AS 'qty', lokasi.nama AS 'lokasi_nama', inventory.id AS 'inventory_id' FROM produk LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN merek ON produk.merek_id = merek.id LEFT JOIN inventory ON produk.id = inventory.produk_id LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id LEFT JOIN lokasi ON inventory.lokasi_id = lokasi.id WHERE produk.status = 'aktif' AND inventory_riwayat.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY inventory.id HAVING inventory_riwayat.qty > 0";
               // End of old version
              */
               $sql = "SELECT item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', warna.nama AS 'warna_nama', kategori.nama AS 'kategori_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', satuan.nama AS 'satuan_nama', merek.nama AS 'merek_nama', inventory.qty AS 'qty_berdiri', (SUM(inventory_riwayat.qty) + inventory.qty) AS 'qty_total', lokasi.nama AS 'lokasi_nama', inventory.id AS 'inventory_id', inventory_riwayat.qty AS 'qty_riwayat' FROM produk LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN merek ON produk.merek_id = merek.id LEFT JOIN inventory ON produk.id = inventory.produk_id LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id LEFT JOIN lokasi ON inventory.lokasi_id = lokasi.id WHERE produk.status = 'aktif' AND inventory_riwayat.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY inventory.id HAVING qty_riwayat > 0;
               $sql = "SELECT inventory.id as 'inventory_id', (sum(inventory_riwayat.qty) + inventory.qty) AS 'qty_total' FROM inventory LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id WHERE inventory_riwayat.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY inventory_riwayat.inventory_id";
               //select inventory.id, (sum(inventory_riwayat.qty) + inventory.qty), inventory_riwayat.qty from inventory LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id WHERE inventory_riwayat.tanggal BETWEEN '2020-09-01' AND '2020-09-30' GROUP BY inventory_riwayat.inventory_id

               //select inventory.id, (sum(inventory_riwayat.qty) + inventory.qty) from inventory LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id group by inventory.id
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $no = $no + 1;
                  $inventory_id = $row['inventory_id'];

                  $sql_inventory = "SELECT inventory.tanggal AS 'inventory_tanggal' FROM inventory WHERE inventory.tanggal = '$inventory_id'";
                  $query_inventory = mysqli_query($con, $sql_inventory);

                  $pembelian_detail_qty = $row['pembelian_detail_qty'];
                  $produk_harga = $row['produk_harga'];
                  $pembelian_detail_diskon = $row['pembelian_detail_diskon'];
                  $pembelian_pajak = $row['pembelian_pajak'];
                  $total = 0;
                  ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['item_nama'] . ' ' . $row['jenis_nama'] . ' ' . $row['warna_nama'] . ' ' . $row['kategori_nama'] . ' ' . $row['merek_nama'] . 'dia. ' . $row['produk_diameter'] . '" @' . $row['produk_panjang'] . 'cm/' . $row['satuan_nama']; ?></td>
                        <td><?php echo $row['pembelian_detail_qty']; ?></td>
                        <td><?php $row['lokasi_nama']; ?></td>
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
                <?php
              }
              else
              {
                echo "<tr><td colspan='4'>Hasil tidak ada</td></tr>";
              }
            ?>
          </tbody>
        </table>
    </body>
  </html>

  <?php

  /*
  $html = ob_get_clean();
  $dompdf = new Dompdf();

  $dompdf->loadHtml($html);

  $dompdf->render();

  $dompdf->stream("pembelian_po.pdf");
  */

  ?>
