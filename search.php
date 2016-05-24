<?php
if(isset($_REQUEST['submit'])){
  $id = $_REQUEST['search-id'];
  require("user.php");
  $user = new user();
  $user->cari_teman($id);
}

 ?>
