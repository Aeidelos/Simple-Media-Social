<body>
  <?php
      require_once("post.php");
      @session_start();
      $user = $_SESSION['username'];
      $post = new post();
      $post->load_notif($user);
   ?>
</body>
