<?php include "security.php"; ?>
<?php include "config.php";
  $delivery_order_id = $_POST['delivery_order_id'];
  $produk_id = $_POST['produk_id'];
  $qty = $_POST['qty'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE do_detail SET do_id = ?, produk_id = ?, qty = ? WHERE id = ?");
    $stmt->bind_param("iiii", $delivery_order_id, $produk_id, $qty, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM do_detail WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO do_detail (do_id, produk_id, qty) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $delivery_order_id, $produk_id, $qty); // s = String, i = integer
  }

  if($stmt->execute())
  {
    echo $conn->error;
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "delivery_order_detail.php?id=<?php echo "DO" . $delivery_order_id ?>";
    </script>
    <?php
  }
  else
  {
    echo $conn->error;
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "delivery_order_detail.php?id=<?php echo "DO" . $delivery_order_id ?>";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
