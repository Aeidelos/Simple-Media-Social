<?php

    class user{
      public function load_data($username){
        require("konfig.php");
        $array = $conn->query("SELECT * FROM `data-user` where id_user='$username'");
        $row = $array->fetch_assoc();
       return $row;
      }

      public function update_data($username,$nama,$bio,$email){
        require("konfig.php");
        $conn->query("Update `data-user` set nama = '$nama', bio = '$bio', email='$email' where id_user='$username'");
      }

      public function display_member(){
        require("konfig.php");
        require_once("post.php");
        $post = new post();
        $user = $conn->query("SELECT * FROM `data-user`");
        if (!$user) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        while($hasil = $user->fetch_assoc()){
            echo "<div class=\"ui segment\">";
            $post->load_foto_pp($hasil['id_user'],20,20);
            echo "<a href=\"home.php?url=profil&id=$hasil[id_user]\">$hasil[id_user]</a> - ";
            echo "
                $hasil[nama]<a href=\"home.php?url=deleteuser&id_user=$hasil[id_user]\">Hapus</a><br>
            ";
            echo "</div>";
        }
      }

      public function delete_member($id){
        require("konfig.php");
        $conn->query("Delete from `data-user` where id_user='$id'");
        $conn->query("Delete from `friend` where id_user1='$id' or id_user2='$id'");
        $conn->query("Delete from  `komen` where id_user_komen='$id'");
        $conn->query("Delete from `like` where id_user_like='$id'");
        $conn->query("Delete from `notifikasi` where id_notifikasi like '$id%'");
        $conn->query("Delete from `post` where id_post like `$id%`");
      }

      public function display_teman($userid){
        require("konfig.php");
        require_once("post.php");
        $post = new post();
        $id2 = $conn->query("SELECT id_user2 FROM friend WHERE id_user1='$userid'");
        $id_user2 = $id2->fetch_assoc();
        $id = $id_user2['id_user2'];
        $user = $conn->query("SELECT * FROM `data-user` WHERE id_user = '$id'");
        if (!$user) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        while($hasil = $user->fetch_assoc()){
            echo "<div class=\"ui segment\">";
            $post->load_foto_pp($hasil['id_user'],20,20);
            echo "<a href=\"home.php?url=profil&id=$hasil[id_user]\">$hasil[id_user]</a> - ";
            echo "
                $hasil[nama]<br>
            ";
            echo "</div>";
        }
      }

      public function cari_teman($userid){
        require("konfig.php");
        require_once("post.php");
        $post = new post();
        $id = $userid;
        $user = $conn->query("SELECT * FROM `data-user` WHERE id_user = '$id' or id_user like '$id%'
        or id_user like '%$id' or id_user like '%$id%' or
        nama = '$id' or nama like '$id%'
        or nama like '%$id' or nama like '%$id%'");
        if (!$user) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        echo "
        <div class=\"ui segment\"><h3>Hasil Pencarian $id</h3></div>
        ";
        if($userid!=null || $userid!=""){
          while($hasil = $user->fetch_assoc()){
              echo "<div class=\"ui segment\">";
              $post->load_foto_pp($hasil['id_user'],20,20);
              echo "<a href=\"home.php?url=profil&id=$hasil[id_user]\">$hasil[id_user]</a> - ";
              echo "
                  $hasil[nama]<br>
              ";
              echo "</div>";
          }
        }else{
          echo "<div class=\"ui segment\">";
          echo "Silahkan Masukkan Nama/ID yang anda cari";
          echo "</div>";
        }
      }


      public function add_user($username,$nama,$biography,$password,$lahir,$email){
          require_once("konfig.php");
        $conn->query("INSERT INTO `data-user`
          (`id_user`, `nama`, `bio`, `foto`, `password`, `email`, `lahir`, `level`)
        VALUES ('$username','$nama','$biography','member','$password','$email',$lahir,2)");
      }

      public function tambah_teman($user1,$user2){
        require_once("konfig.php");
        $conn->query("INSERT INTO `friend` Values ('$user1','$user2')");
      }

      public function cek_relasi($state,$user1,$user2){
        require("konfig.php");
        $arr1 = $conn->query("SELECT COUNT(id_user1) AS val FROM `friend` WHERE id_user1='$user1' and id_user2='$user2'");
        $arr2 = $conn->query("SELECT COUNT(id_user1) AS val FROM `friend` WHERE id_user1='$user2' and id_user2='$user1'");
        if (!$arr1) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        $value1 = $arr1->fetch_assoc();
        $value2 = $arr2->fetch_assoc();
        if($user1!=$user2){
          if($value1['val']==0 & $value2['val']==0){
            echo "
              <a href=\"relator.php?mode=add&id1=$user1&id2=$user2\">
              <button class=\"ui blue button\">
                <i class=\"user icon\"></i>
                Tambah Teman
                </button></a>"
              ;
          }else if($value1['val']==1 && $value2['val']==0 ){
            echo "<button class=\"ui button\">
              <i class=\"user icon\"></i>
              Menunggu Konfirmasi
              </button>";
          }else if($value1['val']==0 && $value2['val']==1){
            echo "
              <a href=\"relator.php?mode=confirm&id1=$user1&id2=$user2\">
              <button class=\"ui green button\">
                <i class=\"user icon\"></i>
                Konfirmasi Permintaan
                </button></a>";
          }else{
            echo "<button class=\"ui blue button\">
              <i class=\"user icon\"></i>
              Berteman
              </button>";
             $state = "ok";
          }
          return $state;
        }
      }

    }

 ?>
