<?php
$img = $_REQUEST['url-img'];
header('Content-Type: image/jpeg');
readfile($img);
?>
