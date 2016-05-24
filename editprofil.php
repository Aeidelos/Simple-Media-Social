<body>
  <h3>Edit Profil Anda</h3>
  <div class="ui segment">
    <form class="ui form" action="fotoprofil.php" method="post" enctype="multipart/form-data">
      <p>Ubah Foto Profil<p>
      <input type="file" name="foto" id="foto">
      <?php
          require("user.php");
          @session_start();
          $user = new user();
          $hasil = $user->load_data($_REQUEST['id']);
          echo "
          <br>Nama  <input type=\"text\" name=\"nama\" value=\"$hasil[nama]\">
          Bio  <input type=\"text\" name=\"bio\" value=\"$hasil[bio]\">
          Email   <input type=\"email\" name=\"email\" value=\"$hasil[email]\">
          ";
       ?>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>

</body>
