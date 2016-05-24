<?php
if(isset($_REQUEST['submit'])){
  if($_REQUEST['mode']=='komen'){
    require_once("post.php");
    $post = new post();
    @session_start();
    $user = $_SESSION['username'];
    $komen = $_REQUEST['komen'];
    $postid = $_REQUEST['id'];
    $time = $_REQUEST['time'];
    $uploader = substr($postid,0,sizeof($postid)-11);
    $isi = "<a href=\"home.php?url=profil&id=$user\">$user</a> mengomentari
    <a href=\"home.php?url=status&postid=$postid&time=$time\">foto</a> anda";
    $post->insert_komen($postid,$user,$komen);
    $post->add_notif($uploader,$postid,$isi,$user);
  }else if($_REQUEST['mode']=='editpost'){
    require_once("post.php");
    $post = new post();
    @session_start();
    $user = $_SESSION['username'];
    $postid = $_REQUEST['postid'];
    $time = $_REQUEST['time'];
    $caption=$_REQUEST['caption'];
    $post->edit_post($postid,$time,$caption);
  }
  else if($_REQUEST['mode']=='editkomen'){
    require_once("post.php");
    $post = new post();
    $postid = $_REQUEST['postid'];
    $time = $_REQUEST['time'];
    $isi=$_REQUEST['isi'];
    $post->edit_komen($postid,$time,$isi);
  }
}

if($_REQUEST['mode']=='delete'){
      require("post.php");
      $post = new post();
      @session_start();
      $postid = $_REQUEST['postid'];
      $time = $_REQUEST['time'];
      $user = $_SESSION['username'];
      $post->remove_komen($postid,$time);
      $post->remove_notif($user,$time,$postid);
}

if($_REQUEST['mode']=='delpos'){
  require_once("post.php");
  $post = new post();
  @session_start();
  $user = $_SESSION['username'];
  $post->remove_post($_REQUEST['postid'],$_REQUEST['time']);
}

if($_REQUEST['mode']=='editposting'){
  $id_post = $_REQUEST['postid'];
  $time = $_REQUEST['time'];
  $isi = $_REQUEST['isi'];
  echo "<div class = \"ui segment\"><form class=\"\" action=\"home.php?url=komenter&mode=editpost&postid=$id_post&time=$time\" method=\"post\">
    <input type=\"textfield\" name=\"caption\" value=\"$isi\" class=\"status\" placeholder=\"\">
    <input type=\"submit\" name=\"submit\" value=\"Submit\">
  </form>
  </div>
  ";
  exit();
}

if($_REQUEST['mode']=='editkomentar'){
  $postid = $_REQUEST['postid'];
  $time = $_REQUEST['time'];
  $isi = $_REQUEST['isi'];
  echo "<div class = \"ui segment\"><form class=\"\" action=\"home.php?url=komenter&mode=editkomen&postid=$postid&time=$time\" method=\"post\">
    <input type=\"textfield\" name=\"isi\" value=\"$isi\" class=\"status\" placeholder=\"\"><br>
    <input type=\"submit\" name=\"submit\" value=\"Simpan\">
  </form>
  </div>
  ";
  exit();
}

    header("Location:home.php");
?>
