<?php
session_start();
    if(isset($_SESSION['username'])){
      header("Location:home.php");
    }else{
      if(isset($_REQUEST['mode'])){
        if($_REQUEST['mode']=='salah')
        echo
        "<script type=\"text/javascript\">
        alert(\"Username/Password Salah\");
        </script>";
      }
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Histogram</title>
    <link rel="stylesheet" type="text/css" href="/Semantic/semantic.css">
    <script src="/Semantic/semantic.js"></script>
    <style media="screen">
      body{
        background-image: url("/Histogram/res/background-login.jpg");
        background-position: center;
      }
    </style>
  </head>
  <body>
    <div class="">
      <div class="ui two column middle aligned very relaxed stackable centered grid" style="weight:600px;height:600px;">
          <div class="five wide column">
          <form action="login.php" method="post">
            <div class="ui inverted form">
              <div class="field">
                <label>Username</label>
                <div class="ui left icon input">
                  <input placeholder="Your Username" type="text" name="username">
                  <i class="user icon"></i>
                </div>
              </div>
              <div class="field">
                <label>Password</label>
                <div class="ui left icon input">
                  <input placeholder="Your Password" type="password" name="password">
                  <i class="lock icon"></i>
                </div>
              </div>
              <button class="ui blue inverted button" type="submit" name="submit">Sign In</button>
            </form>
            </div>
          </div>
          <div class="ui inverted vertical divider">
            Or
          </div>
          <div class="center aligned five wide column">
            <div class="ui big green labeled icon button" onclick="location.href='/Histogram/register.php'">
              <i class="signup icon"></i>
              Sign Up
            </div>
          </div>
        </div>
    </div>

    </body>
</html>

<?php } ?>
