<?php include "security.php"; ?>
<?php
include "config.php";

  $nama = $_POST['nama'];
  $kode_akun = $_POST['kode_akun'];
  $saldo = $_POST['saldo'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE kode_akun SET kode = ?, nama = ?, saldo = ? WHERE id = ?");
    $stmt->bind_param("isii", $kode_akun, $nama, $saldo, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM kode_akun WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO kode_akun (kode, nama, saldo) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $kode_akun, $nama, $saldo);
  }

if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> kode akun <?php echo $nama; ?>");
      location.href = "kode_akun.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> kode akun");
      location.href = "kode_akun.php";
    </script>
    <?php
  }
  $stmt->close();
$conn->close();
?>
