<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Histogram - Home</title>
    <link rel="stylesheet" type="text/css" href="/Semantic/semantic.css">
    <script src="/Semantic/semantic.js"></script>
    <style media="screen">
      .hbody{
          width: 80%;
          float: left;
          margin-left: 20%;
      }
      .hleft{
          width : 20%;
          float:left;
          position: fixed;
      }
      .status{
        width:90%; height:80px; margin-left:25px;
      }
      .status_other{
        width:100%;
        padding: 10px;
      }
    </style>
  </head>
  <body>
    <div class="">
    </div>
    <div class="hleft">
      <div class="ui inverted medium vertical floating menu" style="height:555px;margin-top:0px; margin-left-0px;">
    <a class="item" href="home.php?url=notifikasi">
      <div class="ui label"><?php
        require("post.php");
        session_start();
        $post = new post();
        $user = $_SESSION['username'];
        $total = $post->hitung_notif($user);
        echo "$total";
       ?></div>
      Notification
    </a>
    </div>
    </div>
      <div class="hbody">
        <div class="ui inverted pointing menu">
          <a onclick="location.href='home.php';" class=" item">
            Home
          </a>
          <a onclick="location.href='home.php?url=profil';"class="item">
            Profile
          </a>
          <?php
           @session_start();
           $user = $_SESSION['username'];
            if($user!='admin'){
              echo "<a href=\"home.php?url=friend\" class=\"item\">
                Friends
              </a>";
            }else{
              echo "<a href=\"home.php?url=friend\" class=\"item\">
                Friends
              </a>";
              echo "<a href=\"home.php?url=member\" class=\"item\">
                Member
              </a>";
            }
           ?>
          <div class="right menu">
            <div class="item">
              <div class="ui inverted transparent icon input">
                <form class="" action="home.php?url=search" method="post">
                  <input placeholder="Search..." type="text" name="search-id">
                  <input type="submit" name="submit" value="Cari">
                </form>
              </div>
            </div>
              <a class = "item" href="logout.php">
                Logout
              </a>
          </div>
        </div>
        <?php
          $default = "main";
          if(!isset($_REQUEST['url'])){
            $default ="main";
          }else{
            $default = $_REQUEST['url'];
          }
          include_once("$default.php")
         ?>
      </div>
  </body>
</html>
