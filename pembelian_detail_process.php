<?php include "security.php"; ?>
<?php include "config.php";
  $pembelian_id = $_POST['pembelian_id'];
  $produk_id = $_POST['produk_id'];
  $harga_beli = $_POST['harga_beli'];
  $qty = $_POST['qty'];
  $diskon = $_POST['diskon'];
  $status = $_POST['status'];
  if(isset($_POST['tanggal']))
  {
    $tanggal = $_POST['tanggal'];
  }
  else
  {
    $tanggal = date("Y-m-d");
  }
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE pembelian_detail SET pembelian_id = ?, produk_id = ?, harga_beli = ?, qty = ?, diskon = ?, status = ? WHERE id = ?");
    $stmt->bind_param("iiiiisi", $pembelian_id, $produk_id, $harga_beli, $qty, $diskon, $status, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $stmt = $conn->prepare("DELETE FROM pembelian_detail WHERE id = ?");
    $stmt->bind_param("i", $id);
  }
  else
  {
    $action_text = "menambahkan";
    $stmt = $conn->prepare("INSERT INTO pembelian_detail (pembelian_id, produk_id, harga_beli, qty, diskon, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiis", $pembelian_id, $produk_id, $harga_beli, $qty, $diskon, $status); // s = String, i = integer
  }

  if($stmt->execute())
  {
    if($status == "selesai")
    {
      $sql = "SELECT inventory.id AS 'inventory_id', inventory.qty AS 'inventory_qty', pembelian.lokasi_id AS 'pembelian_lokasi_id' FROM pembelian INNER JOIN pembelian_detail ON pembelian.id = pembelian_detail.pembelian_id INNER JOIn produk on pembelian_detail.produk_id = produk.id INNER JOIN inventory ON produk.id = inventory.produk_id WHERE pembelian.id = " . $pembelian_id;
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
      $stmt->bind_param("sii", $tanggal, $inventory_id, $qty);
      if($stmt->execute())
      {
        ?>
        <script>
          alert("Berhasil menambahkan Qty Produk");
        </script>
        <?php
      }
      //$sql = "SELECT pembelian.lokasi_id AS 'pembelian_lokasi_id', pembelian_detail.qty AS 'pembelian_detail_qty', produk.id AS 'produk.id' FROM pembelian_detail INNER JOIN pembelian ON pembelian_detail.pembelian_id = pembelian_id INNER JOIN produk ON pembelian_detail.produk_id = produk.id WHERE pembelian";
    }
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "pembelian_detail.php?pembelian_id=<?php echo $pembelian_id; ?>";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text; ?> data");
      location.href = "pembelian_detail.php?pembelian_id=<?php echo $pembelian_id; ?>";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
