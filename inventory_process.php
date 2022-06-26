<?php include "security.php"; ?>
<?php include "config.php";
  $produk_id = $_POST['produk_id'];
  $lokasi_id = $_POST['lokasi_id'];
  $qty = floor($_POST['qty']);
  $tanggal = $_POST['tanggal'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE inventory SET produk_id = ?, lokasi_id = ?, qty = ?, tanggal = ? WHERE id = ?");
    $stmt->bind_param("iiisi", $produk_id, $lokasi_id, $qty, $tanggal, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $sql = "SELECT id, produk_id, lokasi_id, qty FROM inventory WHERE produk_id = " . $produk_id . " AND lokasi_id = " . $lokasi_id;
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $num = mysqli_num_rows($query);
    if($num > 0)
    {
      $id = $row['id'];
      $qty_total = $row['qty'] + $qty;
      $stmt = $conn->prepare("UPDATE inventory SET qty = ? WHERE id = ?");
      $stmt->bind_param("ii", $qty_total, $id);
      $action_text = "edit Qty";
    }
    else
    {
      $stmt = $conn->prepare("INSERT INTO inventory (produk_id, lokasi_id, qty, tanggal) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiis", $produk_id, $lokasi_id, $qty, $tanggal);
    }
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "inventory.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "inventory.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
