<?php include "security.php"; ?>
<?php include "config.php";
  $nama = $_POST['nama'];
  $keterangan = $_POST['keterangan'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE merek SET nama = ?, keterangan = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $keterangan, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM merek WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO merek (nama, keterangan) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $keterangan); // s = String, i = integer
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "merek.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "merek.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
