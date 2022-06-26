<?php include "security.php"; ?>
<?php include "config.php";
  $pembelian_id = $_POST['pembelian_id'];
  $no_do_pembelian = $_POST['no_do_pembelian'];
  $tanggal = $_POST['tanggal'];
  $action = $_GET['action'];
  if($action == 'edit')
  {
    $id = $_POST['id'];
    $action_text = "mengedit";
    $stmt = $conn->prepare("UPDATE do_pembelian SET no_do_pembelian = ?, pembelian_id = ?, tanggal = ? WHERE id = ?");
    $stmt->bind_param("sisi", $no_do_pembelian, $pembelian_id, $tanggal, $id);
  }
  else if($action == "delete")
  {
    $id = $_POST['id'];
    $action_text = "menghapus";
    $sql = "SELECT gambar FROM do_pembelian WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if($num > 0)
    {
      $row = mysqli_fetch_array($query);
      $target_file = $row['gambar'];

      if (file_exists($target_file))
      {
        unlink($target_file);
        //echo "File Successfully Delete.";
      }
      else
      {
        //echo "File does not exists";
      }
    }
    $stmt = $conn->prepare("DELETE FROM do_pembelian WHERE id = ?");
    $stmt->bind_param("i", $id);

  }
  else
  {
    $action_text = "menambahkan";

    $target_dir = "uploads/do_pembelian/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $stmt = $conn->prepare("INSERT INTO do_pembelian (no_do_pembelian, pembelian_id, tanggal) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $no_do_pembelian, $pembelian_id, $tanggal);
  }

  if($stmt->execute())
  {
    if($action == "add")
    {
      if(basename($_FILES["gambar"]["name"]) != "")
      {
        $last_id = mysqli_insert_id($conn);
        $gambar_nama = $last_id . "." . $imageFileType;
        $target_file = $target_dir . $gambar_nama;

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["gambar"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["gambar"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        }
        else
        {
          if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file))
          {
            echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
            $stmt = $conn->prepare("UPDATE do_pembelian SET gambar = ? WHERE id = ?");
            $stmt->bind_param("si", $target_file, $last_id);
            $stmt->execute();
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      }
    }
    else if($action == "edit")
    {
      if(basename($_FILES["gambar"]["name"]) != "")
      {
        $target_dir = "uploads/do_pembelian/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"]))
        {
          $check = getimagesize($_FILES["gambar"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check file size
        if ($_FILES["gambar"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        }
        else
        {
          $sql = "SELECT gambar FROM do_pembelian WHERE id = '$id'";
          $query = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($query);
          echo $conn->error;
          if($num > 0)
          {
            $row = mysqli_fetch_array($query);
            if($row['gambar'] == NULL)
            {
              $target_file_exists = $target_dir . $id . "." . $imageFileType ;
            }
            else
            {
              $target_file_exists = $row['gambar'];
            }

            if (file_exists($target_file_exists))
            {
              unlink($target_file_exists);
            }
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file_exists))
            {
              echo "The file ". basename($_FILES["gambar"]["name"]). " has been uploaded.";
              $stmt = $conn->prepare("UPDATE do_pembelian SET gambar = ? WHERE id = ?");
              $stmt->bind_param("si", $target_file_exists, $id);
              $stmt->execute();
            }
            else
            {
              echo "Sorry, there was an error uploading your file.";
            }
          }
        }
        }
      }
    ?>
    <script>
      alert("Berhasil <?php echo $action_text; ?> data");
      location.href = "delivery_order_pembelian.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert("Gagal <?php echo $action_text . $conn->error; ?> data");
      location.href = "delivery_order_pembelian.php";
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
?>
