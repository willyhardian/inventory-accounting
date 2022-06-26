<?php session_start();
  if(isset($_SESSION['username']))
  {
    unset($_SESSION['username']);
    ?>
    <script>
      location.href = "index.php";
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      location.href = "index.php";
    </script>
    <?php
  }

?>
