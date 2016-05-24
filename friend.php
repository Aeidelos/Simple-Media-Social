<body>
  <h3>Seluruh Teman Anda</h3>
  <?php
  require("user.php");
    @session_start();
    $id = $_SESSION['username'];
      $user = new user();
      $user->display_teman($id);
   ?>
</body>
