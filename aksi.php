<?php
    @session_start();
    $user = $_SESSION['username'];
    $poster = $_REQUEST['post'];
    if(isset($_REQUEST['do'])){
      require_once("post.php");
      $post = new post();
      if($_REQUEST['do']=='like'){
        $post->add_like($poster,$user);
      }else if($_REQUEST['do']=='unlike'){
        $post->remove_like($poster,$user);
      }else if($_REQUEST['do']=='delpost'){
        $post->delete_status($poster);
      }
    }
    header("Location:home.php");
 ?>
