<?php ob_start();?>
<div id="header">
    <div class="container repone__" id="rp__">
        <h1 id="logo"><a href="index.php" title="Cửa Hàng"></a></h1>
        <div id="search">
            <form method="post" action="?mod=search">
                <input type="text" autocomplete="off" name="kw" placeholder="Tìm Sản Phẩm..." class="keyword">
                <button type="submit" class="submit"></button>
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
@media all{
    #sign{
        display: inline-block;
    }
   
}
@media only screen and (min-width: 1400px) {
    #nav ul {
        margin-left: 25% !important;
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