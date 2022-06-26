<?php include "security.php"; ?>
<?php include "config.php";
  $kode_akun = $_POST['kode_akun'];
  $harga = $_POST['biaya'];
  $tanggal = $_POST['tanggal'];
  $keterangan = $_POST['keterangan'];
  $action = $_GET['action'];

  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE beban SET kode_akun_id = ?, harga = ?, tanggal = ?, keterangan = ? WHERE id = ?");
    $stmt->bind_param("iissi", $kode_akun, $harga, $tanggal, $keterangan, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM beban WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO beban (kode_akun_id, harga, tanggal, keterangan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $kode_akun, $harga, $tanggal, $keterangan);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $tanggal; ?>");
      location.href = "pengeluaran.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "pengeluaran.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
