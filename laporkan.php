<?php
require_once("post.php");
$postid = $_REQUEST['postid'];
$time = $_REQUEST['time'];
$post = new post();
$post->laporkan($postid,$time);
if(isset($_REQUEST['submit'])){
    @session_start();
    $user = $_SESSION['username'];
    $laporan = $_REQUEST['laporan'];
    $uploader = 'admin';
    $isi = "<a href=\"home.php?url=profil&id=$user\">$user</a> melaporkan
    <a href=\"home.php?url=status&postid=$postid&time=$time\">foto</a> dengan alasan $laporan";
    $post->add_notif($uploader,$postid,$isi,$user);
    header("Location:home.php");
}else if(isset($_REQUEST['peringatan'])){
    @session_start();
    $user = $_SESSION['username'];
    $uploader = $_REQUEST['user'];
    $isi = "<a href=\"home.php?url=profil&id=$user\">$user</a> menandai
    <a href=\"home.php?url=status&postid=$postid&time=$time\">foto</a> anda sebagai hal yang tidak pantas
    , Silahkan hapus atau anda akan diblokir, terima kasih";
    $post->add_notif($uploader,$postid,$isi,$user);
    header("Location:home.php");
}


 ?>
