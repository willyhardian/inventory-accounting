<?php session_start();
  if(!isset($_SESSION['username']))
  {
    ?>
      <script>
        alert("Anda perlu login terlebih dahulu");
        location.href = "index.php";
      </script>
    <?php
  }
?>
