<?php session_start(); include "config.php";

  if((!isset($_POST['username'])) || (!isset($_POST['password'])))
  {
    ?>
    <script>
      alert("Gagal login");
      location.href = "index.php";
    </script>
    <?php
  }
  else
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $num = mysqli_num_rows($query);
    if($num > 0)
    {
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $row['role_id'];
      ?>
      <script>
        location.href = "dashboard.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script>
        alert("Gagal login");
        location.href = "index.php";
      </script>
      <?php
    }
  }
?>
