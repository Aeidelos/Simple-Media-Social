<?php
    require("user.php");
    $id = $_REQUEST['id_user'];
    $user = new user();
    $user->delete_member($id);
    header("Location:home.php?url=member");
 ?>
