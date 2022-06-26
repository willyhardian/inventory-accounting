<?php include "security.php"; ?>
<?php
include "config.php";

  $nama = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $status = "";
  if(isset($_POST['status']))
  {
      $status = $_POST['status'];
  }
  else
  {
    $status = 'active';
  }
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE users SET nama = ?, username = ?, password = ?, email = ?, role_id = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssssisi", $nama, $username, $password, $email, $role, $status, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO users (nama, username, password, email, role_id, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $nama, $username, $password, $email, $role, $status);
  }

  if($stmt->execute())
  {
    echo $conn->error;
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "user.php";
    </script>
    <?php
  }
  else
  {
    echo $conn->error;
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "user.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
