<?php include "security.php"; ?>
<?php include "config.php";
  $invoice_id = $_POST['invoice_id'];
  $tanggal = $_POST['tanggal_dibuat'];
  $penerima = $_POST['penerima'];
  $penerima_hp = $_POST['penerima_hp'];
  $tujuan = $_POST['tujuan'];
  $keterangan = $_POST['keterangan'];
  $catatan = $_POST['catatan'];
  $disiapkan_oleh = $_POST['disiapkan_oleh'];
  $disetujui_oleh = $_POST['disetujui_oleh'];
  $dikirim_oleh = $_POST['dikirim_oleh'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $id = explode("DO", $id);
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE do SET invoice_id = ?, tanggal = ?, penerima = ?, penerima_hp = ?, tujuan = ?, keterangan = ?, catatan = ?, disiapkan_oleh = ?, disetujui_oleh = ?, dikirim_oleh = ? WHERE id = ?");
    $stmt->bind_param("isssssssssi", $invoice_id, $tanggal, $penerima, $penerima_hp, $tujuan, $keterangan, $catatan, $disiapkan_oleh, $disetujui_oleh, $dikirim_oleh, $id[1]);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $id = explode("DO", $id);
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM do WHERE id = ?");
    $stmt->bind_param("i", $id[1]);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO do (invoice_id, tanggal, penerima, penerima_hp, tujuan, keterangan, catatan, disiapkan_oleh, disetujui_oleh, dikirim_oleh) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $invoice_id, $tanggal, $penerima, $penerima_hp, $tujuan, $keterangan, $catatan, $disiapkan_oleh, $disetujui_oleh, $dikirim_oleh);
  }

  if($stmt->execute())
  {
    echo $stmt->error;
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "delivery_order.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "delivery_order.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
