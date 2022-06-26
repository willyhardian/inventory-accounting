<?php include "security.php"; ?>
<?php include "config.php";
  $perform_invoice_id = $_POST['perform_invoice_id'];
  $tanggal = $_POST['tanggal'];
  /*
  //Have status
  $status = $_POST['status'];
  //End of have status
  */
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    /*
    // Have status
    $stmt = $conn->prepare("UPDATE invoice SET tanggal = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssi", $tanggal, $status, $id);
    // End of have status
    */
    $stmt = $conn->prepare("UPDATE invoice SET tanggal = ? WHERE id = ?");
    $stmt->bind_param("si", $tanggal, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM invoice WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    /*
    // Have status
    $stmt = $conn->prepare("INSERT INTO invoice (tanggal, perform_invoice_id, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $tanggal, $perform_invoice_id, $status);
    // End of Have status
    */
    $stmt = $conn->prepare("INSERT INTO invoice (tanggal, perform_invoice_id) VALUES (?, ?)");
    $stmt->bind_param("si", $tanggal, $perform_invoice_id);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data pada invoice");
    </script>
    <?php
    if($action == 'add')
    {
      $last_id = mysqli_insert_id($conn);
      $stmt2 = $conn->prepare("INSERT INTO invoice_status_pembayaran (tanggal, status, invoice_id) VALUES (?, ?, ?)");
      $status_aktif = 'aktif';
      $stmt2->bind_param("ssi", $tanggal, $status_aktif, $last_id);
      if($stmt2->execute())
      {
      ?>
      <script>
        alert("Berhasil <?php echo $action_text; ?> data pada invoice status pembayaran");
        location.href = "invoice.php";
      </script>
      <?php
      }
      else
      {
        ?>
        <script>
          alert("Gagal <?php echo $action_text; ?> data pada invoice status pembayaran");
        </script>
        <?php
      }
      $stmt2->close();
    }
    ?>
    <script>
      location.href = "invoice.php";
    </script>
    <?php
  }
  else
  {
    echo $conn->error;
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "invoice.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
