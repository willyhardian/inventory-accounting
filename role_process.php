<?php include "security.php"; ?>
<?php include "config.php";
  $nama = ucwords(strtolower(trim($_POST['nama'])));
  $deskripsi = $_POST['deskripsi'];
  $status = $_POST['status'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE role SET nama = ?, deskripsi = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama, $deskripsi, $status, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM role WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO role (nama, deskripsi, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $deskripsi, $status); // s = String, i = integer
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "role.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "role.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
