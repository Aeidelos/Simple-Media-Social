<?php
  if (isset($_POST['submit'])) {
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
      $passwordmd5 = md5($password);
      require_once("konfig.php");
      $arr = $conn->query("SELECT id_user,level from `data-user` where id_user='$username' and password ='$passwordmd5'");
      if (!$arr) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
      }
      $hasil = mysqli_fetch_array($arr,MYSQLI_ASSOC);
    if ($hasil['id_user']==$username && $username!='')
    {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['level'] = $hasil['level'];
      header("location:/Histogram/");
    }
    else
    {
    echo "Data tidak terdaftar";
    header("location:/Histogram/index.php?mode=salah");
    }

  }
 ?>
