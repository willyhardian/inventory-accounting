<?php include "config.php";
  $termin = $_POST['termin'];
  $tc = $_POST['tc'];
  $customer = $_POST['person'];
  $rekening = $_POST['rekening'];
  $status = $_POST['status'];
  $produk = $_POST['produk'];
  $diskon = $_POST['diskon'];
  $qty = $_POST['qty'];
  $harga_ongkir = $_POST['harga_ongkir'];
  $pajak = $_POST['pajak'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE pejualan SET pelanggan_id = ?, harga_ongkir = ?, diskon = ?, pajak = ?, termin = ?, rekening_id = ?, terms_conditions_id = ? WHERE id = ?");
    $stmt->bind_param("iiiiiiii", $customer, $harga_ongkir, $diskon, $pajak, $termin, $rekening, $tc, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM penjualan WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO penjualan (pelanggan_id, harga_ongkir, diskon, pajak, termin, rekening_id, terms_conditions_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiii", $customer, $harga_ongkir, $diskon, $pajak, $termin, $rekening, $tc); // s = String, i = integer
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data <?php echo $nama; ?>");
      location.href = "penjualan.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "penjualan.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
