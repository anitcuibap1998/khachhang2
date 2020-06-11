<?php
 session_start();

if(!isset($_SESSION['username_tam'])){
    echo '<script> window.location.href ="index.php" </script>'; 
}
if(isset($_POST['xacthuc'])){
    $input = isset($_POST['codeActive'])? $_POST['codeActive'] : "";
    if($input==$_SESSION['codeActive_tam']){
       $_SESSION['username']= $_SESSION['username_tam'];
       unset($_SESSION['username_tam']);
       unset($_SESSION['password_tam']);
       unset($_SESSION['email_tam']);
       unset($_SESSION['usertype_tam']);
       unset($_SESSION['codeActive_tam']);
       if($dbarray['usertype'] == 99){
            echo '<script>
            window.location.href ="admin/index.php"
            </script>';
        }
        else{
            echo '<script>
            window.location.href ="index.php"
            </script>';
                               
        }
    }else{
        $_SESSION['gioihan']--;
        if($_SESSION['gioihan']==0){
            unset($_SESSION['gioihan']);
            echo '<script>
            alert("Phiên Đăng Nhập Bị Hủy Do Bạn Đã Nhập Sai Quá 3 Lần !!!");
            window.location.href ="index.php";
        </script>';
        }else{
            echo '<script>
            alert("Không Đúng Mời Bạn Nhập Lại");
        </script>';

        }
       
    }
}
   
?>
<style>
    * {
        margin: 0 auto;
        padding: 0 ;
    }
   .active_code{
       width: 100vw;
       height: 100vh;
       background-color: #aebcaf;
   }
</style>

<div  id="khoa_content" class="active_code" >
    <h2 style="width: 800px; padding-top: 250px;">Một Mã Xác Nhận Đã Được Gửi Đến Mail Của Bạn</h2>
   <form action="" method="post" style="width: 800px; padding-top: 20px;">
       <input type="text" name="codeActive" id="codeActive" style="padding: 10px;width: 600px;">
       <button type="submit" name="xacthuc" style="padding: 10px;" >Xác Thực</button>
   </form>
</div>

<?php 
?>