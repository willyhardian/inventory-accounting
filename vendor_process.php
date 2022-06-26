<?php include "security.php"; ?>
<?php
include "config.php";

  $nama = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $action = $_GET['action'];

  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE vendor SET nama = ?, no_telepon = ?, email = ?, alamat = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama, $phone, $email, $alamat, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM vendor WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO vendor (nama, email, no_telepon, alamat) VALUES (?, ?, ?, ? )");
    $stmt->bind_param("ssss", $nama, $email, $phone, $alamat);
  }


  if($stmt->execute())
    {
      ?>
      <script>
        alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
        location.href = "vendor.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script>
        alert("Gagal <?php echo $action_text; ?> data");
        location.href = "vendor.php";
      </script>
      <?php
    }

  $stmt->close();
$conn->close();
?>
