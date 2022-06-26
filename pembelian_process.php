<?php include "security.php"; ?>
<?php include "config.php";
  $tanggal = $_POST['tanggal'];
  $vendor_id = $_POST['vendor_id'];
  $down_payment = $_POST['down_payment'];
  $termin = $_POST['termin'];
  $pajak = $_POST['pajak'];
  $lokasi_id = $_POST['lokasi_id'];
  //$terms_conditions_id = $_POST['terms_conditions_id'];
  /*
  // Have status
  $status = $_POST['status'];
  // End of have status
  */
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    /*
    // Have status
    $stmt = $conn->prepare("UPDATE pembelian SET tanggal = ?, vendor_id = ?, termin = ?, down_payment = ?, pajak = ?, lokasi_id = ?, terms_conditions_id = ?, status = ? WHERE id = ?");
    $stmt->bind_param("siiiiisi", $tanggal, $vendor_id, $termin, $down_payment, $pajak, $lokasi_id, $status, $id);
    // End of Have status
    */
    $stmt = $conn->prepare("UPDATE pembelian SET tanggal = ?, vendor_id = ?, termin = ?, down_payment = ?, pajak = ?, lokasi_id = ?, terms_conditions_id = ? WHERE id = ?");
    $stmt->bind_param("siiiiii", $tanggal, $vendor_id, $termin, $down_payment, $pajak, $lokasi_id, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM pembelian WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    /*
    // Have status
    $stmt = $conn->prepare("INSERT INTO pembelian (tanggal, vendor_id, termin, down_payment, pajak, lokasi_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiiis", $tanggal, $vendor_id, $termin, $down_payment, $pajak, $lokasi_id, $status);
    // End of Have status
    */
    $stmt = $conn->prepare("INSERT INTO pembelian (tanggal, vendor_id, termin, down_payment, pajak, lokasi_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiii", $tanggal, $vendor_id, $termin, $down_payment, $pajak, $lokasi_id);

  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data pada pembelian");
    </script>
    <?php
    if($action == 'add')
    {
      $last_id = mysqli_insert_id($conn);
      $stmt2 = $conn->prepare("INSERT INTO pembelian_status_pembayaran (tanggal, status, pembelian_id) VALUES (?, ?, ?)");
      $status_aktif = 'aktif';
      $stmt2->bind_param("ssi", $tanggal, $status_aktif, $last_id);
      if($stmt2->execute())
      {
      ?>
      <script>
        alert("Berhasil <?php echo $action_text; ?> data pada pembelian status pembayaran");
        location.href = "pembelian.php";
      </script>
      <?php
      }
      else
      {
        ?>
        <script>
          alert("Gagal <?php echo $action_text; ?> data pada pembelian status pembayaran");
        </script>
        <?php
      }
      $stmt2->close();
    }
    ?>
    <script>
      location.href = "pembelian.php";
    </script>
    <?php
  }
  else
  {
    echo $conn->error;
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "pembelian.php";
    </script>
    <?php
  }
  ?>
  <script>
    location.href = "pembelian.php";
  </script>
  <?php
  $stmt->close();
  $conn->close();
?>
