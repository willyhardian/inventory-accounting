<?php include "security.php"; ?>
<?php include "config.php";
  $invoice_id = $_POST['invoice_id'];
  $tanggal = $_POST['tanggal'];
  $status = $_POST['status'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE invoice_status_pembayaran SET tanggal = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssi", $tanggal, $status, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM invoice_status_pembayaran WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO invoice_status_pembayaran (tanggal, status, invoice_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $tanggal, $status, $invoice_id);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "invoice_status_pembayaran.php?invoice_id=" + <?php echo $invoice_id; ?>;
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "invoice_status_pembayaran.php?invoice_id=" + <?php echo $invoice_id; ?>;
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
