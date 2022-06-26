<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_dibuat = $_POST['tanggal_dibuat'];
  $penerima = $_POST['penerima'];
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

      <title>Laporan Penerimaan Barang</title>
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
        <h2 class="text-center">Laporan Penerimaan Barang</h2>
        <h4 class="text-center">
          <?php show_date($tanggal_dibuat) ?>
        </h4>
        <table class="table mx-auto">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Qty</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              $sql = "SELECT pembelian_detail.produk_id AS 'produk_id_pembelian_detail', item.nama AS 'item_nama', jenis.nama AS 'jenis_nama', warna.nama AS 'warna_nama', kategori.nama AS 'kategori_nama', produk.diameter AS 'produk_diameter', produk.panjang AS 'produk_panjang', satuan.nama AS 'satuan_nama', merek.nama AS 'merek_nama', pembelian_detail.qty AS 'pembelian_detail_qty' FROM pembelian_detail INNER JOIN produk ON pembelian_detail.produk_id = produk.id LEFT JOIN item ON produk.item_id = item.id LEFT JOIN jenis ON produk.jenis_id = jenis.id LEFT JOIN warna ON produk.warna_id = warna.id LEFT JOIN satuan ON produk.satuan_id = satuan.id LEFT JOIN kategori ON produk.kategori_id = kategori.id LEFT JOIN merek ON produk.merek_id = merek.id WHERE pembelian_detail.pembelian_id = '$pembelian_id' AND pembelian_detail.status = 'selesai'";
              $query = mysqli_query($conn, $sql);
              echo $conn->error;
              $num = mysqli_num_rows($query);
              if($num > 0)
              {
                while($row = mysqli_fetch_array($query))
                {
                  $no = $no + 1;
                  ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['produk_id_pembelian_detail']; ?></td>
                        <td><?php echo $row['item_nama'] . ' ' . $row['jenis_nama'] . ' ' . $row['warna_nama'] . ' ' . $row['kategori_nama'] . ' ' . $row['merek_nama'] . 'dia. ' . $row['produk_diameter'] . '" @' . $row['produk_panjang'] . 'cm/' . $row['satuan_nama']; ?></td>
                        <td><?php echo $row['pembelian_detail_qty']; ?></td>
                    </tr>
                  <?php
                }
              }
              else
              {
                echo "<tr><td colspan='4'>Hasil tidak ada</td></tr>";
              }
            ?>
          </tbody>
        </table>

        <div id="ttd_penerima">
          <div id="ttd_penerima_content" class="ml-auto">
            <p class="mb-10">Penerima</p>
            <p><?php echo $penerima; ?></p>
          </div>
        </div>
    </body>
  </html>

  <?php


  $html = ob_get_clean();
  $dompdf = new Dompdf();

  $dompdf->loadHtml($html);

  $dompdf->render();

  $dompdf->stream("laporan_penerimaan_barang.pdf");

  ?>
