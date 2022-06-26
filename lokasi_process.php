<?php include "security.php"; ?>
<?php include "config.php";
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $keterangan = $_POST['keterangan'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE lokasi SET nama = ?, alamat = ?, keterangan = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama, $alamat, $keterangan, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM lokasi WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO lokasi (nama, alamat, keterangan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $alamat, $keterangan); // s = String, i = integer
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "lokasi.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "lokasi.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
