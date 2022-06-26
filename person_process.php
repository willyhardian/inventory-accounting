<?php include "security.php"; ?>
<?php
include "config.php";

  $nama = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $action = $_GET['action'];
  if(isset($_POST['organization']))
  {
      if($_POST['organization'] == "NULL")
      {
        $organization = NULL;
      }
      else
      {
        $organization = $_POST['organization']; // id yang diambil
      }
  }
  else
  {
      $organization = NULL;
  }

  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE pelanggan SET nama = ?, phone = ?, email = ?, jenis_kelamin = ?, pelanggan_info_id = ? WHERE id = ?");
    $stmt->bind_param("ssssii", $nama, $phone, $email, $jenis_kelamin, $organization, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO pelanggan (nama, phone, email, jenis_kelamin, pelanggan_info_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nama, $phone, $email, $jenis_kelamin, $organization);
  }

if($stmt->execute())
  {
    echo $conn->error;
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "person.php";
    </script>
    <?php
  }
  else
  {
    echo $conn->error;
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "person.php";
    </script>
    <?php
  }
  $stmt->close();
$conn->close();
?>
