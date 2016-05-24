<?php
  /** require('konfig.php');
  $user = $conn->query("SELECT * FROM `data-user`");
  while($hasil = $user->fetch_assoc()){
    $password = md5($hasil['password']);
    $userid = $hasil['id_user'];
    $arr =$conn->query("update `data-user` set password = '$password' where id_user='$userid'");
    if (!$arr) {
      printf("Error: %s\n", mysqli_error($conn));
      exit();
    }
  } **/

 ?>
