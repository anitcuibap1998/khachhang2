<?php
  require('libs/db.php');
  include_once("function_999888.php");
  session_start();
  error_reporting(E_ALL);
  $mod='';
  if(!$_SESSION["username"]){
      header("Location:index.php");
  }else{
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
        <?php
      include("header.php");
    ?>
        <div id="body-wrap" class="container">
            <?php
       include("sp-hot.php");
      ?><style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            input[type=password] {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            button[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button[type=submit]:hover {
                background-color: #45a049;
            }

            .doi_mat_khau {
                width: 100%;
                height: 55vh;
                text-align: center;
            }

            .container123123 {
                margin: 0 auto;
                width: 50%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }

            .container123123 form label {
                color: black;
            }
            </style>
            <?php 
        if(isset($_POST["update_pass"])){
            if(empty($_POST["password"]) || empty($_POST["password1"])){
                    echo " <script> alert('Không Được Để Trống'); </script>";
                   
            }
            else if ($_POST["password"] != $_POST["password1"]){
                echo " <script> alert('Mật Khẩu Không Trùng Nhau, Mời Nhập Lại'); </script>";
            }
            else{
                //update pass
                $username = $_SESSION["username"];
                $input_pass = xuly_input($_POST["password"]);
                $hash =  mahoaMD5($input_pass);
                $sql = "UPDATE `user` SET `password` = '$hash' where username = '$username'";
                $rerult = mysqli_query($link, $sql);
                if($rerult){
                    echo " <script> alert('Đổi Mật Khẩu Thành Công !!'); </script>";
                }else{
                    echo " <script> alert('Đổi Mật Khẩu Không Thành Công !!'); </script>";
                }
            }
        }
      ?>
            <div class="doi_mat_khau">
                <h3>Mật Khẩu Mới</h3>
                <div class="container123123">
                    <form name="form1"  method="POST" onsubmit="return matchpass()">
                        <label for="fname">Mật Khẩu Mới:</label>
                        <input type="password" id="password" name="password" placeholder="" required>
                        <label for="lname">Xác Nhận Mật Khẩu:</label>
                        <input type="password" id="password1" name="password1" placeholder="" required>
                        <button type="submit" value="xac_nhan" name="update_pass">Xác Nhận</button>
                    </form>
                </div>
            </div>
            <!-- sử dụng js để validate input -->
            <script>
            function validate_kitu() {
                let firstpassword = document.form1.password.value;
                let secondpassword = document.form1.password1.value;
                if(firstpassword.search("<")!= -1){
                    alert("Mật Khẩu không cho phép có kí tự đặc biệt");
                    return false;
                }
               else if(firstpassword.search(">") != -1){
                    alert("Mật Khẩu không cho phép có kí tự đặc biệt");
                    return false;
                }
                else if(firstpassword.search("=") != -1){
                    alert("Mật Khẩu không cho phép có kí tự đặc biệt");
                    return false;
                }
                else if(firstpassword.search("*") != -1){
                    alert("Mật Khẩu không cho phép có kí tự đặc biệt");
                    return false;
                }
                else return true;
            }
        
            function matchpass() {
                validate_kitu() 
                let firstpassword = document.form1.password.value;
                let secondpassword = document.form1.password1.value;
                if (firstpassword.length < 8 || firstpassword.length > 15) {
                    alert("Mật Khẩu Có ít Nhất 8 đến 15 ký tự (không cho phép có: <,>,?,#...)");
                    return false;
                }
                if (firstpassword == secondpassword) {
                    return true;
                } else {
                    alert("Mật Khẩu Phải Trùng Nhau !!!");
                    return false;
                }
            }
            </script>
            <?php
        // include("sidebar.php");
      ?>
        </div>
        <?php
      include("footer.php");
    ?>
    </div>

</html>
<?php } ?>