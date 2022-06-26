<?php include "security.php"; ?>
<?php include "config.php";
  $sales_quotation_id = $_POST['sales_quotation_id'];
  $produk_id = $_POST['produk_id'];
  $harga_jual = $_POST['harga_jual'];
  $qty = $_POST['qty'];
  $diskon = $_POST['diskon'];
  $status = $_POST['status'];
  $action = $_GET['action'];
  if(isset($_POST['tanggal']))
  {
    $tanggal = $_POST['tanggal'];
  }
  else
  {
    $tanggal = date("Y-m-d");
  }
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE sales_quotation_detail SET produk_id = ?, harga_jual = ?, qty = ?, diskon = ?, status = ? WHERE id = ?");
    $stmt->bind_param("iiiisi", $produk_id, $harga_jual, $qty, $diskon, $status, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM sales_quotation_detail WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO sales_quotation_detail (sales_quotation_id, produk_id, harga_jual, qty, diskon, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiis", $sales_quotation_id, $produk_id, $harga_jual, $qty, $diskon, $status);
  }

  if($stmt->execute())
  {
    if($status == "selesai")
    {
      $sql = "SELECT inventory.id AS 'inventory_id', inventory.qty AS 'inventory_qty', sales_quotation.lokasi_id AS 'sales_quotation_lokasi_id' FROM sales_quotation INNER JOIN sales_quotation_detail ON sales_quotation.id = sales_quotation_detail.sales_quotation_id INNER JOIn produk on sales_quotation_detail.produk_id = produk.id INNER JOIN inventory ON produk.id = inventory.produk_id WHERE sales_quotation.id = " . $sales_quotation_id;
      $query = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($query);
      /*
      // Inventory Version
      $stmt = $conn->prepare("UPDATE inventory SET qty = ? WHERE produk_id = ? AND lokasi_id = ?");
      $qty_total = $row['inventory_qty'] + $qty;
      // End of  inventory version
      */

      //Inventory Riwayat Version
      $stmt = $conn->prepare("INSERT INTO inventory_riwayat (tanggal, inventory_id, qty) VALUES (?, ?, ?)");
      //End of Inventory Riwayat Version
      $inventory_id = $row['inventory_id'];
      $qty = $qty * -1;
      $stmt->bind_param("sii", $tanggal, $inventory_id, $qty);
      if($stmt->execute())
      {
        ?>
        <script>
          alert("Berhasil mengurangi Qty Produk");
        </script>
        <?php
      }
    }
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "sales_quotation_detail.php?sales_quotation_id=" + <?php echo $sales_quotation_id; ?>;
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "sales_quotation_detail.php?sales_quotation_id=" + <?php echo $sales_quotation_id; ?>;
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
