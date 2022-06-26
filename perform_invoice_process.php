<?php include "security.php"; ?>
<?php include "config.php";
  $sales_quotation_id = $_POST['sales_quotation_id'];
  $tanggal = $_POST['tanggal'];
  if(isset($_POST['purchase_order_pelanggan_id']))
  {
      if($_POST['purchase_order_pelanggan_id'] == "NULL")
      {
        $purchase_order_pelanggan_id = NULL;
      }
      else
      {
        $purchase_order_pelanggan_id = $_POST['purchase_order_pelanggan_id']; // id yang diambil
      }
  }
  else
  {
      $purchase_order_pelanggan_id = NULL;
  }
  //$purchase_order_pelanggan_id = $_POST['purchase_order_pelanggan_id'];
  $termin = $_POST['termin'];
  $down_payment = $_POST['down_payment'];
  $action = $_GET['action'];
  echo $purchase_order_pelanggan_id;
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE perform_invoice SET tanggal = ?, purchase_order_pelanggan_id = ?, termin = ?, down_payment = ? WHERE id = ?");
    $stmt->bind_param("siiii", $tanggal, $purchase_order_pelanggan_id, $termin, $down_payment, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM perform_invoice WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO perform_invoice (tanggal, purchase_order_pelanggan_id, termin, down_payment, sales_quotation_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiii", $tanggal, $purchase_order_pelanggan_id, $termin, $down_payment, $sales_quotation_id);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "perform_invoice.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "perform_invoice.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
