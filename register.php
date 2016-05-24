<?php
require_once "user.php";
    if(isset($_POST['submit'])){
      $username = $_REQUEST['username'];
      $nama = $_REQUEST['fname']." ".$_REQUEST['lname'];
      $password = $_REQUEST['password'];
      $email = $_REQUEST['email'];
      $birthday = $_REQUEST['day']."-".$_REQUEST['bulan']."-".$_REQUEST['tahun'];
      $biography = $_REQUEST['bio'];
      $user = new user();
      if($user->add_user($username,$nama,$biography,$password,$birthday,$email)){
              header("Location:/Histogram/welcome.php");
      }else{
        echo "gagal";
      }

    }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign Up for Histogram</title>
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
        <div class="ui container">

                  <div class="twelve wide column" style="padding:50px; margin-left:500px; margin-top:40px;">
                    <form class="ui inverted form" id="signup" action="register.php" method="post">
                      <div class="row">
                          <div class="field five wide column">
                            <label for="">Username</label>
                            <input type="text" name="username" placeholder="Username">
                          </div>
                      </div>
                      <div class="row">
                        <div class="two fields">
                          <div class="field six wide column">
                            <label for="">First Name</label>
                            <input type="text" name="fname" placeholder="Firstname">
                          </div>
                            <div class="field six wide column">
                                <label for="">Lastname</label>
                                <input type="text" name="lname" placeholder="Lastname">
                              </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="two fields">
                          <div class="field six wide column">
                            <label for="">Password</label>
                            <input type="password" name="password" placeholder="Password">
                          </div>
                            <div class="field six wide column">
                                <label for="">Confirm Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="field six wide column">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="E-mail">
                          </div>
                        </div>
                        <div class="row">
                          <label for="">Birthday</label>
                            <div class="three fields four wide column">
                              <div class="field">
                                <input type="text" name="day" placeholder="Days" maxlength="2">
                              </div>
                              <div class="field">
                                <select class="ui fluid search dropdown" name="bulan">
                                  <option value="">Month</option>
                                  <option value="1">January</option>
                                  <option value="2">February</option>
                                  <option value="3">March</option>
                                  <option value="4">April</option>
                                  <option value="5">May</option>
                                  <option value="6">June</option>
                                  <option value="7">July</option>
                                  <option value="8">August</option>
                                  <option value="9">September</option>
                                  <option value="10">October</option>
                                  <option value="11">November</option>
                                  <option value="12">December</option>
                                </select>
                              </div>
                              <div class="field">
                                <input name="tahun" maxlength="4" placeholder="Year" type="text">
                              </div>
                            </div>
                        </div>
                          <div class="row">
                            <label for="">Biography</label>
                              <div class="field six wide column">
                                <textarea rows="2" name="bio"></textarea>
                              </div>
                          </div>
                          <div class="row">
                            <label for="  "></label>
                            <button class="ui blue inverted button" type="submit" name="submit">Submit</button>
                          </div>
                      </div>
                    </form>
                    </div>
        </div>
  </body>
</html>
