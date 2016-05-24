    <div class="ui segment">
      <div class="row" style="height:150px">
        <form class="ui form" action="poster.php" method="post" enctype="multipart/form-data">
          <input type="textfield" name="caption" value="" class="status" placeholder="Update Status">
          <p>
            <br>
          </p>
            <input type="file" name="foto" id="foto">
            <button class="ui mini blue  button" type="submit" name="submit">Post</button>
        </form>
      </div>
      <?php
        if(isset($_REQUEST['mode'])){
          if($_REQUEST['mode']=='status'){
            echo
            "<script type=\"text/javascript\">
            alert(\"Berhasil Update Status\");
            </script>";
          }
        }
            @session_start();
            require_once("post.php");
            $post = new post();
            $user = $_SESSION['username'];
            $post->load_status($user);
       ?>
      <p></p>
    </div>
