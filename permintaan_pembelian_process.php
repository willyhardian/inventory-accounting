<?php include "security.php"; ?>
<?php include "config.php";
  $action = $_GET['action'];
  if($action == 'disetujui')
  {
    $id = $_GET['id'];
    $status = "disetujui";
    $action_text = "menyetujui";
    $stmt = $conn->prepare("UPDATE permintaan_pembelian SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
  }
  else
  {
    $invoice_id = $_POST['invoice_id'];
    $tanggal = $_POST['tanggal'];
    $produk_id = $_POST['produk_id'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $action = $_GET['action'];

    if($action == 'edit')
    {
      $id = $_POST['id'];
      $action_text = "mengedit";
      $stmt = $conn->prepare("UPDATE permintaan_pembelian SET invoice_id = ?, tanggal = ?, produk_id = ?, qty = ?, status = ? WHERE id = ?");
      $stmt->bind_param("isiisi", $invoice_id, $tanggal, $produk_id, $qty, $status, $id);
    }
    else if($action == "delete")
    {
      $id = $_POST['id'];
      $action_text = "menghapus";
      $stmt = $conn->prepare("DELETE FROM permintaan_pembelian WHERE id = ?");
      $stmt->bind_param("i", $id);
    }
    else
    {
      $action_text = "menambahkan";
      $stmt = $conn->prepare("INSERT INTO permintaan_pembelian (invoice_id, tanggal, produk_id, qty, status) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("isiis", $invoice_id, $tanggal, $produk_id, $qty, $status); // s = String, i = integer
    }
  }
  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "permintaan_pembelian.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "permintaan_pembelian.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
