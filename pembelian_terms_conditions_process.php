<?php include "security.php"; ?>
<?php include "config.php";
  $pembelian_id = $_POST['pembelian_id'];
  $terms_conditions_id = $_POST['terms_conditions_id'];
  $action = $_GET['action'];
  if($action == 'edit')
  {

    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE pembelian_terms_conditions SET terms_conditions_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $terms_conditions_id, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM pembelian_terms_conditions WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO pembelian_terms_conditions (pembelian_id, terms_conditions_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $pembelian_id, $terms_conditions_id);
  }

  if($stmt->execute())
  {
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "pembelian_terms_conditions.php?pembelian_id=" + <?php echo $pembelian_id; ?>;
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "pembelian_terms_conditions.php?pembelian_id=" + <?php echo $pembelian_id; ?>;
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
