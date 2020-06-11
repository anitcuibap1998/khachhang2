<?php
    if(!isset($_SESSION))session_start();
?>

<?php
    include_once("libs/db.php");
    include_once("function_999888.php");
    if(isset($_POST["btn_login"])){
        $username = $_POST["Name"];
        $password = $_POST["Password"];
       
        
        //strip_tags dùng để Hàm strip_tags() sẽ loại bỏ các thẻ HTML và PHP ra khỏi chuỗi. Hàm sẽ trả về chuỗi đã loại bỏ hết các thẻ HTML và PHP

        //addslashes dung để 

        $username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
        $password = addslashes($password);
        
        //         echo"<pre>";
        //         print_r($username);
        //         print_r($password);
        // exit;
		if ($username == "" || $password =="") {?><script>
			alert("username và password bạn không được để trống!")
            </script>
            <?php
        }
        else{
			$sql = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($link,$sql);
            if(!$result || (mysqli_num_rows($result) < 1)){?>
                <script>
                    alert("Username không đúng");
                </script> 
            <?php
            }
            $dbarray = mysqli_fetch_array($result); 
            $pass=mahoaMD5($password);
            echo $sql;
            echo "<br>";
            echo $pass;
            echo "<br>";
            echo $dbarray["password"];
            echo "<br>";
            // echo $sql;
            // echo "<br>";
            // exit();
            if($pass==$dbarray["password"]){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                // phân quyền
                if($dbarray['usertype'] == 99){
                    header('Location:index.php');
                    $_SESSION["active"]=1;
                }
                else{
                    //member
                    header('Location:login.php');                    
                }
            }
            else{
                ?>
                <script>
                    alert('Password failure');
                   <?php  header('Location:login.php'); 
                   ?>
                </script>
                <?php
            }
		}
    }
    
?>