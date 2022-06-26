<?php include "security.php"; ?>
<?php

  include "config.php";

  $nama = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $npwp = $_POST['npwp'];
  $action = $_GET['action'];

  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE pelanggan_info SET nama_org = ?, no_telepon = ?, email = ?, alamat = ?, npwp = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nama, $phone, $email, $address, $npwp, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM pelanggan_info WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO pelanggan_info (nama_org, no_telepon, email, alamat, npwp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $phone, $email, $address, $npwp);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "organization.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "organization.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
