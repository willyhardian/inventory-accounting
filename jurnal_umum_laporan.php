<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir = $_POST['tanggal_akhir'];
  $sql = "SELECT beban.id AS 'id_beban', beban.kode_akun_id AS 'kode_akun_id_beban', kode_akun.nama AS 'kode_akun_nama', beban.nama AS 'nama_beban', beban.harga AS 'harga_beban', beban.tanggal AS 'tanggal_beban', beban.keterangan AS 'keterangan_beban' FROM beban INNER JOIN kode_akun ON beban.kode_akun_id = kode_akun.id WHERE beban.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
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
        <h1 id="title-report">PT Mitra Tiga Perkasa Indonesia</h1>
        <p>RUKO ALICANTE BLOCK C No. 1 Jl. Boulevard Andalucia Gading Serpong Kel. Medang Kab. Tangerang - Banten 15334</p>
        <p>Phone : +62 21 2222 5352 ( Hunting )  Email : mitratigaperkasa@gmail.com</p>
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
                    <td><?php echo $row['tanggal_beban']; ?></td>
                    <td><?php echo $row['id_beban']; ?></td>
                    <td><?php echo $row['kode_akun_id_beban']; ?></td>
                    <td><?php echo $row['kode_akun_nama']; ?></td>
                    <td><?php echo $row['keterangan_beban']; ?></td>
                    <td>-</td>
                    <td><?php echo $row['harga_beban']; ?></td>
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
