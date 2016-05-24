<?php
    class post{
        public function add($id,$caption,$eks){
          require("konfig.php");
          $arr = $conn->query("INSERT INTO `post` VALUES ('$id','$caption',now(),'$eks')");
          if (!$arr) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }
        public function load_status($userid){
          require("konfig.php");
          $id2 = $conn->query("SELECT id_user2 FROM friend WHERE id_user1='$userid'");
          $id_user2 = $id2->fetch_assoc();
          $id2 = $conn->query("SELECT count(id_user2) as jum FROM friend WHERE id_user1='$userid'");
          $id = $id_user2['id_user2'];
          $jum = $id2->fetch_assoc();
          if($jum['jum']==0){
              $id = $userid;
          }
          if($_SESSION['level']==1){
            $id="";
          }
          $post = $conn->query("SELECT * FROM post WHERE id_post like '$userid%'
            OR id_post like '$id%'
             order by time desc");
          if (!$post) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
          while($poster = $post->fetch_assoc()){
            echo "  <div style=\"align:center\" class=\"ui horizontal divider\">-</div>
              <div class=\"row\">
                ";
            $uploader = substr($poster['id_post'],0,sizeof($poster['id_post'])-11);
            $file = "upload/$poster[id_post].$poster[eks]";
            echo "<a href=\"home.php?url=status&postid=$poster[id_post]&time=$poster[time]\"><center><img style=\"width:250px;height:250px\" src=\"image/$poster[id_post].$poster[eks]\"></center></a><br>";
            echo "<a href=\"home.php?url=profil&id=$uploader\">$uploader</a>";
            echo "    $poster[caption]<br><br><br>";
            echo "<br>";
            //$this->add_komen($poster['id_post'],$poster['time']);
          //  echo $hkomen['jumlah']." Komentar";
            $like = $conn->query("SELECT COUNT(id_post) AS TOTAL FROM `like` WHERE id_post='$poster[id_post]'");
            $liked = $conn->query("SELECT COUNT(id_post) AS ME FROM `like` WHERE id_post='$poster[id_post]'
            AND id_user_like='$userid'");
            $jlike = mysqli_fetch_array($like,MYSQLI_ASSOC);
            $jlikem = mysqli_fetch_array($liked,MYSQLI_ASSOC);
            if($jlikem['ME']>0){
                //echo "Anda menyukai ini <a href=\"aksi.php?do=unlike&post=$poster[id_post]\">Unlike</a>";
                echo "<a href=\"aksi.php?do=unlike&post=$poster[id_post]\"><div class=\" mini ui labeled button\" tabindex=\"0\">
                <div class=\" mini ui red button\">
                <i class=\"heart icon\"></i> Unlike
                </div>
                <a class=\"ui basic red left pointing label\">$jlike[TOTAL]
                </a></a>";
            }else{
                echo "<a href=\"aksi.php?do=like&post=$poster[id_post]\"><div class=\"mini ui labeled button\" tabindex=\"0\">
                <div  class=\"mini ui green button\">
               <i  class=\"heart icon\"></i>
               Like
                </div>
                <a class=\"ui basic green left pointing label\">$jlike[TOTAL]
                </a></a>";
            }
            $komen = $conn->query("SELECT count(id_post) as jumlah FROM komen WHERE id_post='$poster[id_post]'");
            $hkomen = $komen->fetch_assoc();
            $jkomen = $hkomen['jumlah'];
            echo "<a href=\"home.php?url=status&postid=$poster[id_post]&time=$poster[time]\"><div class=\"ui mini labeled button\" tabindex=\"0\">
              <div class=\"ui mini basic blue button\">
                <i class=\"comment icon\"></i> Komentar
                  </div>
                    <a class=\"ui basic left pointing blue label\">
                      $jkomen
                        </a>
            </div></a>";
                echo "
                </div>";
                if($uploader==$_SESSION['username'] || $_SESSION['level']==1){
                  echo "<a href=\"komenter.php?mode=delpos&postid=$poster[id_post]&time=$poster[time]\">
                  <div class=\"ui mini labeled button\" tabindex=\"0\">
                    <div class=\"ui mini basic blue button\">
                      <i class=\"remove icon\"></i> Hapus Kiriman
                      </div>
                  </div>
                  </a>";
                }
                if($uploader!=$_SESSION['username'] && $_SESSION['level']!=1){
                  echo "<a href=\"home.php?url=laporkan&postid=$poster[id_post]&time=$poster[time]\">
                  <div class=\"ui mini labeled button\" tabindex=\"0\">
                    <div class=\"ui mini basic blue button\">
                      <i class=\"warning icon\"></i> Laporkan Kiriman
                      </div>
                  </div>
                  </a>";
                }
                if($uploader==$_SESSION['username'] ){
                  echo "<a href=\"home.php?url=komenter&mode=editposting&postid=$poster[id_post]&time=$poster[time]&isi=$poster[caption]\">
                  <div class=\"ui mini labeled button\" tabindex=\"0\">
                    <div class=\"ui mini basic blue button\">
                      <i class=\"edit icon\"></i> Sunting
                      </div>
                  </div>
                  </a>";
                }
          }
          echo "
          </div>
        </div>";
        }

        public function edit_post($postid,$time,$isibaru){
          require("konfig.php");
          $post = $conn->query("update `post` set caption='$isibaru' where id_post='$postid' and time='$time'");
          if (!$post) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function add_notif($user,$postid,$isi,$userk){
          if($user!=$userk){
            $id = $user.time();
            require("konfig.php");
            $post = $conn->query("INSERT INTO `NOTIFIKASI` VALUES('$id','$postid',now(),'$isi','$userk',0)");
            if (!$post) {
              printf("Error: %s\n", mysqli_error($conn));
              exit();
            }
          }
        }

        public function load_notif($userid){
          require("konfig.php");
          $user = $conn->query("SELECT * FROM `notifikasi` WHERE id_notifikasi like '$userid%' order by time desc");
          if (!$user) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
          while($hasil = $user->fetch_assoc()){
            $back = "inverted";
            if($hasil['status']!=0){
                $back = "";
            }
              echo "<div class=\"$back ui segment\">";
              echo "$hasil[isi]";
              echo "</div>";
              $conn->query("UPDATE `notifikasi` set status=1 where id_notifikasi='$hasil[id_notifikasi]'");
          }
        }

        public function hitung_notif($userid){
          require_once("konfig.php");
          $user = $conn->query("SELECT count(id_notifikasi) as total FROM `notifikasi` WHERE id_notifikasi like '$userid%' and status=0 order by time desc");
          $hasil = $user->fetch_assoc();
          return $hasil['total'];
        }

        public function remove_notif($user,$time,$postid){
          require("konfig.php");
          $user = $conn->query("DELETE FROM `notifikasi` WHERE id_user = '$user' and time='$time' and id_post='$postid'");
          if (!$user) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function load_status_id($userid,$postid,$time){
          require("konfig.php");
          $id ="";
          $post = $conn->query("SELECT * FROM post WHERE (id_post like '$userid%'
            OR id_post like '$id%') AND (id_post='$postid' AND time='$time')
             order by time desc");
          if (!$post) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
          while($poster = $post->fetch_assoc()){
            echo "  <div style=\"align:center\" class=\"ui horizontal divider\">-</div>
              <div class=\"row\">
                ";
            $uploader = substr($poster['id_post'],0,sizeof($poster['id_post'])-11);
            $file = "upload/$poster[id_post].$poster[eks]";
            echo "<center><img style=\"width:250px;height:250px\" src=\"image/$poster[id_post].$poster[eks]\"></center><br>";
            echo "<a href=\"home.php?url=profil&id=$uploader\">$uploader</a>";
            echo "    $poster[caption]<br><br><br>";
            echo "<br>";
            $komen = $conn->query("SELECT * FROM komen WHERE id_post='$poster[id_post]'");
            while($hasil = $komen->fetch_array(MYSQLI_ASSOC)){
              echo "<a href=\"home.php?url=profil&id=$hasil[id_user_komen]\">$hasil[id_user_komen]</a> -";
              echo "
                  $hasil[isi]
              ";
              if($hasil['id_user_komen']==$_SESSION['username'] || $_SESSION['level'] == 1){
                echo "<a href=\"komenter.php?mode=delete&postid=$hasil[id_post]&time=$hasil[time]\">hapus</a>";
              }
              if($hasil['id_user_komen']==$_SESSION['username'] ){
                echo "<a href=\"home.php?url=komenter&mode=editkomentar&isi=$hasil[isi]&postid=$hasil[id_post]&time=$hasil[time]\">edit</a>";
              }
              echo "<br>";
            }
            $like = $conn->query("SELECT COUNT(id_post) AS TOTAL FROM `like` WHERE id_post='$poster[id_post]'");
            $liked = $conn->query("SELECT COUNT(id_post) AS ME FROM `like` WHERE id_post='$poster[id_post]'
            AND id_user_like='$userid'");
            $jlike = mysqli_fetch_array($like,MYSQLI_ASSOC);
            $jlikem = mysqli_fetch_array($liked,MYSQLI_ASSOC);
            //echo"Jumlah Like = ".$jlike['TOTAL'];
            if($jlikem['ME']>0){
                //echo "Anda menyukai ini <a href=\"aksi.php?do=unlike&post=$poster[id_post]\">Unlike</a>";
                echo "<a href=\"aksi.php?do=unlike&post=$poster[id_post]\"><div class=\" mini ui labeled button\" tabindex=\"0\">
                <div class=\" mini ui red button\">
                <i class=\"heart icon\"></i> Unlike
                </div>
                <a class=\"ui basic red left pointing label\">$jlike[TOTAL]
                </a></a>";
            }else{
                echo "<a href=\"aksi.php?do=like&post=$poster[id_post]\"><div class=\"mini ui labeled button\" tabindex=\"0\">
                <div  class=\"mini ui green button\">
               <i  class=\"heart icon\"></i>
               Like
                </div>
                <a class=\"ui basic green left pointing label\">$jlike[TOTAL]
                </a></a>";
            }
            $komen = $conn->query("SELECT count(id_post) as jumlah FROM komen WHERE id_post='$poster[id_post]'");
            $hkomen = $komen->fetch_assoc();
            $jkomen = $hkomen['jumlah'];
            echo "<a href=\"home.php?url=status&postid=$poster[id_post]&time=$poster[time]\"><div class=\"ui mini labeled button\" tabindex=\"0\">
              <div class=\"ui mini basic blue button\">
                <i class=\"comment icon\"></i> Komentar
                  </div>
                    <a class=\"ui basic left pointing blue label\">
                      $jkomen
                        </a>
            </div></a>";
            if($uploader==$_SESSION['username'] || $_SESSION['level']==1){
              echo "<a href=\"komenter.php?mode=delpos&postid=$poster[id_post]&time=$poster[time]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"remove icon\"></i> Hapus Kiriman
                  </div>
              </div>
              </a>";
            }
            if($uploader!=$_SESSION['username'] && $_SESSION['level']!=1){
              echo "<a href=\"home.php?url=laporkan&postid=$poster[id_post]&time=$poster[time]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"flag icon\"></i> Laporan Kiriman
                  </div>
              </div>
              </a>";
            }
            if($_SESSION['level']==1){
              echo "<a href=\"home.php?url=laporkan&postid=$poster[id_post]&time=$poster[time]&peringatan=true&user=$uploader\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"warning icon\"></i> Peringatkan Kiriman
                  </div>
              </div>
              </a>";
            }
            if($uploader==$_SESSION['username']){
              echo "<a href=\"home.php?url=komenter&mode=editposting&postid=$poster[id_post]&time=$poster[time]&isi=$poster[caption]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"edit icon\"></i> Sunting
                  </div>
              </div>
              </a>";
            }
            echo "<br>";
            echo "
            </div>";
            $this->add_komen($poster['id_post'],$poster['time']);
          }
          echo "
        </div>";
        }


        public function load_foto_profil($userid,$lebar,$tinggi){
          require("konfig.php");
          require_once("user.php");
          $lebarpx = $lebar."px";
          $tinggipx = $tinggi."px";
          $profil = $userid."fotoprofil";
          $post = $conn->query("SELECT * from post Where id_post='$profil'  order by time desc");
          $poster = $post->fetch_assoc();
          $user = new user();
          $profil = $user->load_data($userid);
          echo "<img style=\"width:$lebarpx;height:$tinggipx;display:inline;\" src=\"image/$poster[id_post].$poster[eks]\">
          $profil[bio]
          <br>
          ";
        }

        public function load_foto_pp($userid,$lebar,$tinggi){
          require("konfig.php");
          require_once("user.php");
          $lebarpx = $lebar."px";
          $tinggipx = $tinggi."px";
          $profil = $userid."fotoprofil";
          $post = $conn->query("SELECT * from post Where id_post='$profil'  order by time desc");
          $poster = $post->fetch_assoc();
          $user = new user();
          $profil = $user->load_data($userid);
          echo "<img style=\"width:$lebarpx;height:$tinggipx;display:inline;\" src=\"image/$poster[id_post].$poster[eks]\">
          ";
        }
        public function load_own_status($userid){
          require("konfig.php");
          $post = $conn->query("SELECT * FROM post WHERE id_post like '$userid%' and id_post!='$userid'
             order by time desc");
          if (!$post) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
          while($poster = $post->fetch_assoc()){
            echo "  <div style=\"align:center\" class=\"ui horizontal divider\">-</div>
              <div class=\"row\">
                ";
            $file = "upload/$poster[id_post].$poster[eks]";
            echo "<center><img style=\"width:250px;height:250px\" src=\"image/$poster[id_post].$poster[eks]\"></center><br>";
            echo "<a href=\"home.php?url=profil&id=$userid\">$userid</a>";
            echo "    $poster[caption]<br><br><br>";
            echo "<br>";
            $like = $conn->query("SELECT COUNT(id_post) AS TOTAL FROM `like` WHERE id_post='$poster[id_post]'");
            $liked = $conn->query("SELECT COUNT(id_post) AS ME FROM `like` WHERE id_post='$poster[id_post]'
            AND id_user_like='$userid'");
            $jlike = mysqli_fetch_array($like,MYSQLI_ASSOC);
            $jlikem = mysqli_fetch_array($liked,MYSQLI_ASSOC);
            //echo"Jumlah Like = ".$jlike['TOTAL'];
            if($jlikem['ME']>0){
                //echo "Anda menyukai ini <a href=\"aksi.php?do=unlike&post=$poster[id_post]\">Unlike</a>";
                echo "<a href=\"aksi.php?do=unlike&post=$poster[id_post]\"><div class=\" mini ui labeled button\" tabindex=\"0\">
                <div class=\" mini ui red button\">
                <i class=\"heart icon\"></i> Unlike
                </div>
                <a class=\"ui basic red left pointing label\">$jlike[TOTAL]
                </a></a>";
            }else{
                echo "<a href=\"aksi.php?do=like&post=$poster[id_post]\"><div class=\"mini ui labeled button\" tabindex=\"0\">
                <div  class=\"mini ui green button\">
               <i  class=\"heart icon\"></i>
               Like
                </div>
                <a class=\"ui basic green left pointing label\">$jlike[TOTAL]
                </a></a>";
            }
            $komen = $conn->query("SELECT count(id_post) as jumlah FROM komen WHERE id_post='$poster[id_post]'");
            $hkomen = $komen->fetch_assoc();
            $jkomen = $hkomen['jumlah'];
            echo "<a href=\"home.php?url=status&postid=$poster[id_post]&time=$poster[time]\"><div class=\"ui mini labeled button\" tabindex=\"0\">
              <div class=\"ui mini basic blue button\">
                <i class=\"comment icon\"></i> Komentar
                  </div>
                    <a class=\"ui basic left pointing blue label\">
                      $jkomen
                        </a>
            </div></a>";
            if($userid==$_SESSION['username'] || $_SESSION['level']==1){
              echo "<a href=\"komenter.php?mode=delpos&postid=$poster[id_post]&time=$poster[time]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"remove icon\"></i> Hapus Kiriman
                  </div>
              </div>
              </a>";
            }
            if($userid!=$_SESSION['username'] && $_SESSION['level']!=1){
              echo "<a href=\"home.php?url=laporkan&postid=$poster[id_post]&time=$poster[time]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"warning icon\"></i> Laporan Kiriman
                  </div>
              </div>
              </a>";
            }
            if($userid==$_SESSION['username']){
              echo "<a href=\"home.php?url=komenter&mode=editposting&postid=$poster[id_post]&time=$poster[time]&isi=$poster[caption]\">
              <div class=\"ui mini labeled button\" tabindex=\"0\">
                <div class=\"ui mini basic blue button\">
                  <i class=\"edit icon\"></i> Sunting
                  </div>
              </div>
              </a>";
            }
              echo "<br>";
              echo "
              </div>";
            $this->add_komen($poster['id_post'],$poster['time']);
            $komen = $conn->query("SELECT * FROM komen WHERE id_post='$poster[id_post]'");
            while($hasil = $komen->fetch_array(MYSQLI_ASSOC)){
              echo "<a href=\"home.php?url=profil&id=$hasil[id_user_komen]\">$hasil[id_user_komen]</a> -";
              echo "
                  $hasil[isi]
              ";
              @session_start();
              if($hasil['id_user_komen']==$_SESSION['username'] || $_SESSION['level'] == 1){
                echo "<a href=\"komenter.php?mode=delete&postid=$hasil[id_post]&time=$hasil[time]\">hapus </a>";
              }
              if($hasil['id_user_komen']==$_SESSION['username'] ){
                echo "<a href=\"home.php?url=komenter&mode=editkomentar&isi=$hasil[isi]&postid=$hasil[id_post]&time=$hasil[time]\">edit</a>";
              }
              echo "<br>";
            }


          }
          echo "
        </div>";
        }


        public function delete_status($postid){
          require_once("konfig.php");
          $arr = $conn->query("DELETE FROM `post` WHERE id_post='$postid'");
          if (!$arr) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function add_like($post,$user){
          require_once("konfig.php");
          $conn->query("INSERT INTO `like`(`id_post`, `id_user_like`) VALUES ('$post','$user')");
        }

        public function remove_like($post,$user){
          require_once("konfig.php");
          $arr = $conn->query("DELETE FROM `like` WHERE id_post='$post' AND id_user_like='$user'");
          if (!$arr) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function remove_komen($post,$time){
          require_once("konfig.php");
          $arr = $conn->query("Delete from `komen` where id_post='$post' and time='$time'");
          if (!$arr) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function remove_post($post,$time){
          require_once("konfig.php");
          $status = $conn->query("SELECT * FROM `post` WHERE ID_POST='$post' and time='$time'");
          if (!$status) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
          $info = $status->fetch_assoc();
          $filename = "image/".$info['id_post'].".".$info['eks'];
          echo "$filename";
          if(!unlink($filename)){
            echo "Fail";
          }else{
            echo "sukses";
          }
          $arr = $conn->query("Delete from `post` where id_post='$post' and time='$time'");
          if (!$arr) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function insert_komen($idpost,$userid,$idstatus){
          require_once("konfig.php");
           $array = $conn->query("INSERT INTO `komen`(`id_post`, `id_user_komen`, `isi`)
          VALUES ('$idpost','$userid','$idstatus')");
          if (!$array) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
          }
        }

        public function add_komen($postid,$time){
          echo
          "<div><form style=\"padding:30px;\" class=\"ui form\" action=\"komenter.php?mode=komen&id=$postid&time=$time\" method=\"post\">
            <input type=\"text\" name=\"komen\" value=\"\" class=\"status\" placeholder=\"Komentar\">
              <button class=\"ui mini blue inverted button\" type=\"submit\" name=\"submit\">Komentar</button>
          </form></div>
          ";
        }

        public function laporkan($postid,$time){
          echo
          "<form class=\"ui form\" action=\"laporkan.php?postid=$postid&time=$time\" method=\"post\">
            <input type=\"text\" name=\"laporan\" value=\"\" class=\"status\" placeholder=\"Alasan Laporan\">
            <input type=\"submit\" name=\"submit\" value=\"Komentar\">
          </form>
          ";
        }

        public function edit_komen($postid,$time,$isi){
          require("konfig.php");
          $conn->query("Update `komen` set isi = '$isi' where id_post = '$postid' and time = '$time'");
        }

    }

 ?>
