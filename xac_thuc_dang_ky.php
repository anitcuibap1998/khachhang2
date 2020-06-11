<?php
 session_start();

if(!isset($_GET['username_tam'])){
    echo '<script> window.location.href ="index.php" </script>'; 
}

if(isset($_POST['xacthuc'])){
    $username=$_GET['username_tam'];
    include_once("libs/db.php");
    $sql = "SELECT * FROM user WHERE username = '$username'";
                  
    $result = mysqli_query($link,$sql);
    $dbarray = mysqli_fetch_array($result); 
    if(!$result){
        echo '<script> window.location.href ="index.php" </script>'; 
    }


    $input = isset($_POST['codeActive'])? $_POST['codeActive'] : "";
    if($input==$dbarray['codeActive']){
       $_SESSION['username']= $_GET['username_tam'];

       $sql_update = "UPDATE user SET `active` = 1 where `username` = '$username'";
       $result_update = mysqli_query($link,$sql_update);

       if($dbarray['usertype'] == 99 &&  $result_update){
            echo '<script>
            window.location.href ="admin/index.php"
            </script>';
        }
        else if($dbarray['usertype'] == 20 &&  $result_update){
            echo '<script>
            window.location.href ="index.php"
            </script>';
                               
        }
    }else{
        
            echo '<script>
            alert("Không Đúng Mời Bạn Nhập Lại");
        </script>';

       
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