<?php
$time = $_REQUEST['time'];
$postid = $_REQUEST['postid'];
@session_start();
require_once("post.php");
$post = new post();
$user = $_SESSION['username'];
$post->load_status_id($user,$postid,$time);
 ?>
