<body>
  <h3>Seluruh Member Histogram</h3>
  <?php
  require("user.php");
    @session_start();
    $id = $_SESSION['username'];
      $user = new user();
      $user->display_member();
   ?>
</body>
