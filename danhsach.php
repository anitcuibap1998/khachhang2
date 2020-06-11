<?php
  require('libs/db.php');
  session_start();
  error_reporting(E_ALL);
  $mod='';
?>
<!DOCTYPE html>
<!-- saved from url=(0018)javascript:void(); -->
<html lang="vi" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
  <?php
    include_once("head.php");
  ?>
</head>
<style type="text/css" media="screen">
    .owl-theme .owl-controls .owl-page {
      display: inline-block;
    }
    .owl-theme .owl-controls .owl-page span {
      background: none repeat scroll 0 0 #869791;
      border-radius: 20px;
      display: block;
      height: 12px;
      margin: 5px 7px;
      opacity: 0.5;
      width: 12px;
    }
</style>
<style media="screen" type="text/css">
  .owl-theme .owl-controls .owl-page {
    display: inline-block;
  }
  .owl-theme .owl-controls .owl-page span {
    background: none repeat scroll 0 0 #869791;
    border-radius: 20px;
    display: block;
    height: 12px;
    margin: 5px 7px;
    opacity: 0.5;
    width: 12px;
  }

  .owl-theme .owl-controls .active span {
    background-color: white !important;
  }

  .owl-theme .owl-pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
</style>
<body>
  <div id="wrapper">
  <?php ob_start();?>
<div id="header">
    <div class="container">
        <h1 id="logo"><a href="index.php" title="Cửa Hàng"></a></h1>
        <div id="search">
            <form method="post" action="index.php?mod=search&loai=<?php echo isset($_GET['loai']) ? $_GET['loai']: "ITUNES" ;?>">
                <input type="text" autocomplete="off" name="kw" placeholder="Tìm Sản Phẩm..." class="keyword">
                <button type="submit" class="submit" name="update"></button>
            </form>
        </div>
        <div id="sign">
            <!-- Van modified ↓↓ -->
            <?php 
            // error_reporting(0);
            if(empty($_SESSION["username"])){?>
            <div class="login"><a rel="nofollow" id="log">Đăng nhập</a>
                <div class="login-form" id="login-form" style="display: none;">
                    <form method="post" action="">
                        <div>
                            <input type="text" placeholder="Tên đăng nhập" class="input username" name="username">
                        </div>
                        <div>
                            <input type="password" placeholder="Mật khẩu" class="input password" name="password">
                        </div>
                        <div>
                            <label class="remember">
                                <input type="checkbox" checked="checked" class="checkbox" name="remember"> Remember
                            </label>
                            <button type="submit" class="submit" name="btn_login">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="links"><a rel="nofollow" href="register.php">Đăng ký thành viên</a></div>

            <?php } 
            else {?>
            <!-- <div class="login"><a rel="nofollow" href="" name="log_out">Đăng xuất</a></div> -->
            <form method="post" action="">
                <button id="logout" name="log_out">Đăng xuất</button>
                <a rel="nofollow" href="info_account.php">Thay đổi thông tin</a>
        </div>
        <span type="text" style="margin-top:10px">
            </form>
            <?php }?>
            <style>
            #logout {
                background-position: 0 -41px;
                background-repeat: no-repeat;
                cursor: pointer;
                display: inline-block;
                font-weight: 700;
                height: 39px;
                line-height: 30px;
                text-align: center;
                width: 97px;
                /* background-image: url(../images/sprite.png?6); */
                background: black;
                color: #fff;
                margin-right: 10px;
            }

            #nav2 {
                background: #282828;
                margin-bottom: 0px;
            }
            </style>

    </div>
</div>
</div>
<script type="text/javascript">
var x = document.getElementById("login-form");
$('#log').on('click', function() {
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
});
</script>
<?php
    include_once("libs/db.php");
    include_once("function_999888.php");
    if(isset($_POST["btn_login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {?><script>
        alert("username và password bạn không được để trống!")
        </script>
        <?php
        }
        else{
                  $sql = "SELECT * FROM user WHERE username = '$username' and `active` = 1";
                  
            $result = mysqli_query($link,$sql);
            if(!$result || (mysqli_num_rows($result) < 1)){?>
            <script>
            alert("Pass Word hoặc mật khẩu không đúng hoặc bạn chưa active tài khoản bằng Gmail đã đăng ký!!!");
            </script>
            <?php
            }
            $dbarray = mysqli_fetch_array($result); 
            if((mahoaMD5($password))==($dbarray["password"])){
                
                
                //lưu vào tạm rồi chuyển qua xacthucmail.php
                $_SESSION['username_tam'] = $username;
                $_SESSION['password_tam'] = $password;
                $_SESSION['email_tam'] = $dbarray['email'];
                $_SESSION['usertype_tam'] = $dbarray['usertype'];
                $_SESSION['codeActive_tam']=bin2hex(random_bytes(10));
                $_SESSION['gioihan']=3;
                
                $email =  $_SESSION['email_tam'];

                ini_set( 'display_errors', 1 );
            
                error_reporting( E_ALL );
                
                $from = "meowstorevn@meowstorevn.com";
                
                $to = "$email";
                
                $subject = "Xác Thực Gmail Và Xác Thực Đăng Nhập Web meowstorevn.com";
                
                $message = "Mã Xác Thực Của Bạn Là: ". $_SESSION['codeActive_tam'];
                
                $headers = "From:" . $from;
                
                if(mail($to,$subject,$message, $headers)==true){
                ?>
                <script>
                alert('Xác Thực Email Của Bạn !!!');
                </script>
                <?php
                header('Location:xac_thuc_mail.php');
                }else{
                    ?>
                    <script>
                    alert('Lỗi Gửi Mail Từ Sever!!!');
                    </script>
                    <?php
                }
                // Chuyển qua trang xac thực mail.php
                // phân quyền
                // if($dbarray['usertype'] == 99){
                //     echo '<script>
                //     window.location.href ="admin/index.php"
                //     </script>';
                // }
                // else{
                //     echo '<script>
                //     window.location.href ="index.php"
                //     </script>';                   
                // }
            }
            else{?>
            <script>
            alert('Pass Word hoặc mật khẩu không đúng hoặc bạn chưa active tài khoản bằng Gmail đã đăng ký!!!');
            </script>
            <?php
            }
	    	}
    }
?>
<?php
        if(isset($_POST["log_out"])){
            ?>
<!-- <script>
            alert("ádfghjh");
            </script> -->
<?php
            unset($_SESSION['username']);
            session_unset();
            session_destroy();
            ?>
            <script>
                window.location.href = "index.php";
            </script>
            <?php
        }
    ?>
<!-- Van modified ↑↑ -->
<style>
.container_123,
.phai_phai {
    display: flex;
    justify-content: space-evenly;
}

.nap_tien {
    width: 48%;
}

.id_taikhoan {
    color: #ff8000;
    width: 15%;
}

.tai_khoan {
    width: 37%;
}

.phai_phai {
    width: 62%;
}

.trai_trai {
    width: 38%;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 180px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

dl, ol, ul{
    margin:0;
    padding:0;
}
.nav{
    position: fixed !important;
    top:30px;
}
@media all    {
  #sign {
    display: block !important
  }
  #logout {

            background-repeat: no-repeat;
            cursor: pointer;
            display: inline-block;


            text-align: center;

            /* background-image: url(../images/sprite.png?6); */
            background: #c1c1c1;
            color: Blue;
            margin-right: 10px
        }
}
@media all  and (max-width:1018px) {
  #header {
    background: #000 !important;
  }
}
@media all  and (min-width:1500px) {
  #nav ul {
    position: absolute !important;
    left: 26% ;
    margin-left: 0 !important;
  }
}
</style>
<?php if(isset($_SESSION["username"])){
    include_once("libs/db.php");
    $username = $_SESSION["username"];
    $sql="SELECT * From user where username = '$username'"; 
    $result = mysqli_query($link, $sql);
    if($result){
      $r= mysqli_fetch_assoc($result);
?>
<div id="nav2">
    <div class="container container_123" style="height:60px;">
        <div class="trai_trai"></div>
        <div class="phai_phai">
            <div class="nap_tien"><a href="naptien.php"><i class="fas fa-plus"></i> Nạp Tiền</a>&nbsp;&nbsp;&nbsp; <span
                    style="color:#d82943; ">Số dư: <?php echo number_format($r['so_du'], 0, '', ',');?> VND</span>
            </div>
            <div class="id_taikhoan">ID: <?php echo $r["ID"]+3300;?></div>
            <div class="tai_khoan dropdown">
                <span style="color:#5784c1;">Tài Khoản: <?php echo $r["fullname"]?></span>
                <div class="dropdown-content">
                    <p><a href="thong_tin_tai_khoan.php">Thông Tin Tài Khoản</a></p>
                    <p><a href="ql_mua.php">Quản Lí Giao Dịch Mua</a></p>
                    <p><a href="ql_nap.php">Quản Lí Giao Dịch Nạp</a></p>
                    <p><a href="doi_mat_khau.php">Đổi Mật Khẩu</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
         }
     } 
?>
<div id="nav">    
    <ul style="margin-left: 180px">
        <li class="home"><a href="index.php" title=""></a></li>
        <?php
      $sql = 'select * from `nav-menu`';
      $query = mysqli_query($link,$sql);
      while($r=mysqli_fetch_assoc($query)){
        if($r["id"]==1 || $r["id"]==2){
    ?>
        <li class="" title="<?php echo $r['name']; ?>"><a><?php echo $r['name']; ?></a>
            <ul class="sub-menu" style="width: 260px; display: none; margin-left: 0 !important;">
                <?php
            $handle = $r['handle'];
            $sql = 'select * from `'.$handle.'`';
            $query1 = mysqli_query($link,$sql);
            while($r1=mysqli_fetch_assoc($query1)){
          ?>
                
               <li class=""><a href="danhsach.php?loai=<?php echo $r1['name'] ?>"><?php echo $r1['name'] ?></a></li>
        
                <?php
          }
          ?>
            </ul>
        </li>
        <?php
      }
      else{
        if($r["id"]==3){
        ?>
        <li class="" title="<?php echo $r['name']; ?>"><a href="danhsach.php?loai=<?php echo $r['name'] ?>"><?php echo $r['name']; ?></a>
    </li>
        <?php
        }
        if($r["id"]==4){
            ?>
            <li class="" title="<?php echo $r['name']; ?>"><a href="huongdan.php"><?php echo $r['name']; ?></a>
        </li>
            <?php
            }
            if($r["id"]==5){
                ?>
                <li class="" title="<?php echo $r['name']; ?>"><a href="vip.php"><?php echo $r['name']; ?></a>
            </li>
                <?php
                }
      }
    }
    ?>
        <li class=""><a href="giohang.php" title="Giỏ hàng"><span style="color:red;margin-right: 3px;">
        <?php
        if(!isset($_SESSION['cart'])){
            echo 0;
        }else if(isset($_SESSION['cart'])){ 
        $count = count($_SESSION['cart']);
        echo count($_SESSION['cart'])>0 ? $count : 0 ;
        }else{
            echo 0;
        }
        ?>
        </span><i
                    class="fas fa-shopping-cart" style="color:yellowgreen"></i></a></li>
    </ul>
</div>
<?php ob_end_flush();?>
    <div id="body-wrap" class="container">
      <?php
        include("sp-hot.php");
      ?>
      <style>
    ul.list-film li {
      width: 12%;
    }
    #movie-update .types {
    float: left;
    margin-left: 0px; 
    overflow: hidden;
}
.blocktitle{
  width: 80%;
}
.tab{
  width: 100%;
}

.tab {
    width: 1001px !important;
}
ul.list-film li {
    width: 16% !important;
}
  </style>
<div id="content" class="container_1">
  <style>
    #movie-update{
      width: 100vw;
    }
  </style>
  <div class="block"><h2><?php echo isset($_GET['loai']) ? $_GET['loai'] : "ITUNES" ; ?> </h2></div>
  <div class="block" id="movie-update">
    <div class="blockbody" id="list-movie-update">
      <div class="tab toan-bo ">
        <ul class="list-film">
          <?php
          include_once("libs/db.php");
          $loaisp=isset($_GET['loai']) ? $_GET['loai'] : "ITUNES" ;
          $tong_so_hang=24;
                    // $so_page=1;
                    $vitri=0;
                    if(isset($_GET['vitri'])){
                        $vitri=$_GET['vitri'];
                        
                    }
                    //lấy tổng số hàng của user SELECT COUNT(ID) FROM `user`
                    $sql = "SELECT COUNT(ID) as tong FROM `san_pham`  where `phan_loai` = '$loaisp' and `hidden_sp` = 0  ";
               
                    $result_tong = mysqli_query($link, $sql);
                    if($result_tong){
                        $row = mysqli_fetch_assoc($result_tong);
                        //tổng số hàng
                        $tong_so_hang= $row['tong'];
                        //tổng số trang bằng tồng só hàng chia 30 phần tử
                        $so_page=ceil($tong_so_hang/24);
                        //echo $so_page;
                        //exit();
                      }
                    //chia cho 24 mỗi page
                    // echo $tong_so_hang;
                    // echo "<br>";
                    // echo $so_page;
                    // exit();
                    $loai__sp = isset($_GET['loai']) ? $_GET['loai'] : "ITUNES" ;
            $sql1 = 'select * from `san_pham` where `phan_loai` ='. "'".$loai__sp."'" .' and  `hidden_sp` = 0 order by `name` DESC , `id` DESC  limit ' ."$vitri".',24';
            // echo $sql1;
            // exit();
            $query = mysqli_query($link, $sql1);
            while($r=mysqli_fetch_assoc($query)){
          ?>
            <li data-liked="852" data-views="49,875">
              <div class="inner"><a href="index.php?mod=chitiet&id=<?php echo $r['id'] ?>" title="<?php echo $r['name'] ?>"><img src="admin/images/<?php echo $r['image'] ?>" alt="Nhật Ký Trả Thù 2"></a>
                <div class="info">
                  <div class="name"><a href="index.php?mod=chitiet&id=<?php echo $r['id'] ?>" title="<?php echo $r['name'] ?>"><?php echo $r['name'] ?></a></div>
                  <div class="name2"><?php echo "<del>".$r['tien_truoc_khi_giam_gia']. "VND" ."</del>"."  ".$r['tien_sau_khi_giam_gia']. "VND"; ?></div>
                </div>
                <div class="status"><?php echo $r['phan_tram_giam_gia'] ?></div>
                <div class="day_limit"><?php echo $r['day_giam_gia'] ?></div>

              </div>
            </li>
          <?php
            }
          ?>
        </ul>
      </div>
      
    </div>
    <script type="text/javascript">
      $('a[data-name="toan-bo"]').click(function(){
        $('a[data-name="toan-bo"]').addClass('active');
        $('a[data-name="sp-le"]').removeClass('active');
        $('a[data-name="sp-bo"]').removeClass('active');
        $('div.toan-bo').removeClass('hide');
        $('div.sp-le').addClass('hide');
        $('div.sp-bo').addClass('hide');
        $('div.toan-bo > ul.list-film').addClass('tab', 'toan-bo');
        $('div.sp-le > ul.list-film').removeClass('tab','sp-le');
        $('div.sp-bo > ul.list-film').removeClass('tab','sp-bo');
      });
     
    </script>
  </div>
  <div id="phantrang" class="col-md-8">
                    <?php for ($i=0; $i < $so_page; $i++) { 
                    $vitri=$i*24;
                    ?>
                        <button style="border-radius: 14px; padding: 5px 15px 5px 15px; background-color: #f9f9f9; color:rgba(0, 0, 0, 0.2);font-weight: 900;" type="submit" value=""><a href="danhsach.php?vitri=<?php echo $vitri ?>&loai=<?php echo isset($_GET['loai']) ? $_GET['loai'] : "ITUNES" ?>"><?php echo $i; ?></a></button>
                   <?php 
                         }
                   ?>
    </div>
</div>

    </div>
    <?php
                    
      include("footer.php");
    ?>
  </div>
</html>

