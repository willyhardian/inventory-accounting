<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal = $_POST['tanggal'];
  $pelanggan_id = $_POST['pelanggan_id'];
  $lokasi_id = $_POST['lokasi_id'];
  $pajak = $_POST['pajak'];
  /*
  //Temporary remove ongkir
  $ongkir = $_POST['ongkir'];
  */
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    /*
    // Have ongkir
    $stmt = $conn->prepare("UPDATE sales_quotation SET tanggal = ?, pelanggan_id = ?, pajak = ?, ongkir = ? WHERE id = ?");
    $stmt->bind_param("siiii", $tanggal, $pelanggan_id, $pajak, $ongkir, $id);
    // end of have ongkir
    */

    // Temporary remove ongkir
    $stmt = $conn->prepare("UPDATE sales_quotation SET tanggal = ?, pelanggan_id = ?, pajak = ?, lokasi_id = ? WHERE id = ?");
    $stmt->bind_param("siiii", $tanggal, $pelanggan_id, $pajak, $lokasi_id, $id);
    // End of temporary remove ongkir

  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM sales_quotation WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    // Have Ongkir
    /*
    $stmt = $conn->prepare("INSERT INTO sales_quotation (tanggal, pelanggan_id, pajak, ongkir) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $tanggal, $pelanggan_id, $pajak, $ongkir);
    */
    // End of have Ongkir

    // Temporary remove ongkir
    $stmt = $conn->prepare("INSERT INTO sales_quotation (tanggal, pelanggan_id, pajak, lokasi_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $tanggal, $pelanggan_id, $pajak, $lokasi_id);
    // End of temporary remove ongkir
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "sales_quotation.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "sales_quotation.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
