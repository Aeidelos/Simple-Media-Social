<?php
  $user1 = $_REQUEST['id1'];
  $user2 = $_REQUEST['id2'];
  require("user.php");
  $user = new user();
  $user->tambah_teman($user1,$user2);
  header("Location:home.php?url=profil&id=$user2");
 ?>
