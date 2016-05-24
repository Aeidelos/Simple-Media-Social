  <?php
  echo "<div class=\"ui segment\">";
  require_once("user.php");
  require_once("post.php");
  @session_start();
  if(!isset($_REQUEST['id'])){
    $user = $_SESSION['username'];
  }else {
    $user = $_REQUEST['id'];
  }
  $post = new post();
  $loader = new user();
  $profil = $loader->load_data($user);
  echo "<h3>$profil[nama]</h3>";
  $post->load_foto_profil($user,100,100);
  if($user==$_SESSION['username'] || $_SESSION['level']=='1'){
    echo "<a href=\"home.php?url=editprofil&id=$user\">
    <button class=\"ui blue button\">
      <i class=\"user icon\"></i>
      Edit Profil
      </button></a>";
  }
  $state = "";
  $state = $loader->cek_relasi($state,$_SESSION['username'],$user);
  echo "</div>";
  if($user == $_SESSION['username']){
    echo "<div class=\"ui segment\">
      <div class=\"row\" style=\"height:150px\">
        <form class=\"ui form\" action=\"poster.php\" method=\"post\" enctype=\"multipart/form-data\">
          <input type=\"textfield\" name=\"caption\" value=\"\" class=\"status\" placeholder=\"Update Status\">
          <p>
            <br>
          </p>
            <input type=\"file\" name=\"foto\" id=\"foto\">
            <button class=\"ui mini blue  button\" type=\"submit\" name=\"submit\">Post</button>
        </form>
      </div>";
  }
  echo "<div class=\"ui segment\">";
  if($state=='ok' || $user==$_SESSION['username'] || $_SESSION['level']==1){
      $post->load_own_status($user);
  }else{
    echo "Anda harus berteman untuk melihat posting lengkap dari $user";
  }
  echo "</div>";
  ?>
