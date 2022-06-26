<?php include "security.php"; ?>
<?php
include "config.php";

  $nama_bank = $_POST['nama_bank'];
  $nama_rekening = $_POST['nama_rekening'];
  $norek = $_POST['norek'];
  $kode_akun_id = $_POST['kode_akun_id'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE rekening SET nama_bank = ?, nama_rekening = ?, no_rekening = ?, kode_akun_id = ? WHERE id = ?");
    $stmt->bind_param("sssii", $nama_bank, $nama_rekening, $norek, $kode_akun_id, $id);
  }
  else if($action == 'delete')
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM rekening WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO rekening (nama_bank, nama_rekening, no_rekening, kode_akun_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama_bank, $nama_rekening, $norek, $kode_akun_id);
  }

if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "rekening.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text . $conn->error; ?> data");
      location.href = "rekening.php";
    </script>
    <?php
  }
  $stmt->close();
$conn->close();
?>
