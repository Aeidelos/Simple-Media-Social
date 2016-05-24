<?php
echo "<form class=\"\" action=\"komen.php\" method=\"post\">
  <input type=\"textfield\" name=\"komen\" value=\"\" class=\"status\" placeholder=\"Update Status\">
  <input type=\"submit\" name=\"submit\" value=\"Submit\">
</form>
";
  if(isset($_REQUEST['submit'])){
      @session_start();
      $user = $_SESSION['username'];
      $komen = $_REQUEST['komen'];
  }
 ?>
