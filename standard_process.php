<?php include "security.php"; ?>
<?php include "config.php";
  $nama = $_POST['nama'];
  $jenis_id = $_POST['jenis_id'];
  $keterangan = $_POST['keterangan'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE standard SET nama = ?, jenis_id = ?, keterangan = ? WHERE id = ?");
    $stmt->bind_param("sisi", $nama, $jenis_id, $keterangan, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM standard WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO standard (nama, jenis_id, keterangan) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nama, $jenis_id, $keterangan); // s = String, i = integer
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "standard.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "standard.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
