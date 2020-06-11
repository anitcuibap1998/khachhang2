<?php
  require('libs/db.php');
  session_start();
  error_reporting(E_ALL);
  if(!isset($_SESSION['username'])){
    echo '<script>
    alert("Bạn Phải Đăng Nhập Mới Nạp Được Tiền !!!");
    </script>';
    echo '<script>
                    window.location.href ="index.php";
                    </script>';
  }
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
  .wrapper__naptien{
    width:980px;
    margin:0 auto;
  }
  .heading{
    border-bottom:1px solid #ECEDEF;
    font-size:24px;
    padding-bottom:8px;
  }
  .heading span{
    cursor:pointer
  }
  .heading span:hover{
    color:#EB5757
  }
  .active2{
    color:#EB5757
  }
  .panel{
    margin-bottom:60px;
  }
  .panel__heading{
    padding:10px 15px;
    font-size:18px
  }
  .panel__body{
    display:flex;
    border-top:1px solid #ECEDEF;
    padding:40px 15px;
    justify-content: space-around;
    background-color: #2b2e37;
  }
  .left{
    width:40%;
    text-align:center
  }
  .left__text{
    color:red;
    font-size:18px;
    font-weight:bold
  }
  .wrapper__qrcode{
    margin:10px 0
  }
  .middle{
    width:30%;
    text-align:center;
    font-size:14px
  }
  .middle__text{
    border-bottom:1px solid #ECEDEF;
    padding-bottom:10px;
    margin-bottom:18px;
  }
  .middle__highlight{
    color:red
  }
  .right{
    width:30%;
    text-align:center
  }
  .form__group{
    margin:10px 0
  }
  .form__label{
    font-size:14px;
    color:#FFFFFF;
    display:block;
    padding-bottom:10px;
  }
  .form__input{
    padding:10px;
    width:80%;
    transition:all 0.2s;
    border:1px solid transparent
  }
  .form__input:focus{
    border-color: #66afe9;
    transform:translateY(-3px)
  }
  .form_submit{
    margin-top:25px
  }
  .btn{
    padding:10px 15px;
    border:none;
    outline:none;
    color:#FFF;
    cursor:pointer;
    transition:all 0.2s;
    border-radius:3px
  }
  .form .btn:hover{
      transform:translateY(-3px);
      background-color:#EB5757!important
  }
  .btn-danger{
      background-color: #D60808;
  }
  .wrapper_huongdanImg{
    width:250px;
    margin:0 auto;
  }
  .bank__heading{
    color:#fff;
    font-size:15px;
    font-weight:bold
  }
  .bank__info{
    font-size:14px;
  }
  .bank__active{
    color:red
  }
  .bank__owner{
    margin-top:15px
  }
  .bank__number{
    margin-top:15px
  }
  .bank__description{
    margin-top:15px
  }
  .bank{
    display:flex;
    margin-top:40px;
  }
  .bank:not(:last-child){
    margin-bottom:100px;
  }
  .bank__wrapperImg{
   width:150px;
   height:100px; 
   margin-right:20px;
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
        $name= $_SESSION["username"];
        $sqluser= "SELECT * From `user` Where username = '$name'";
        $result = mysqli_query($link,$sqluser);
        $r = mysqli_fetch_assoc($result);
      ?>
    </div>

    <div class="wrapper__naptien">
      <div class="heading">
        <span id="momo" onclick="an_nganhang();">VÍ MOMO</span> /
        <span id="nganhang" onclick="an_momo();">NGÂN HÀNG</span> 
      </div>
      <div class="panel" id="momo__">
        <div class="panel__heading">NẠP TIỀN QUA VÍ MOMO</div>
        <div class="panel__body">
          <div class="left">
            <h2 class="left__heading">QUÉT MÃ QR TRONG ỨNG DỤNG MOMO</h2>
            <div class="wrapper__qrcode">
              <img src="images/momo_qr.jpg" alt="qrcode" width="256px" height="256px">
            </div>
            <div class="left__text">
            Số tài khoản : 0353855803<br/>
            Người nhận: Nguyễn Mạnh Tài<br/>
            Tin nhắn: <?php 
              echo $r['email'];
            ?>
            </div>
          </div>
          <div class="middle">
            <p class="middle__text">Vui lòng <span class="middle__highlight">Nhập số tiền muốn chuyển</span> sau đó vào app Momo <span class="middle__highlight">quét mã QR bên cạnh </span>thực hiện chuyển khoản! Sau khi chuyển khoản <span class="middle__highlight">nhập mã giao dịch </span>và bấm kiểm tra ngay để Hệ thống tự kiểm tra và cộng tiền!</p>
            <form action="" class='form' method="POST">
              <div class="form__group">
                <label for="money" class="form__label">Nhập số tiền muốn chuyển :</label>
                <input type="number" min="1000" max="10000000" id="soluong" placeholder="0" class="form__input"  name="sotien" required>
              </div>
              <div class="form__group">
                <label for="ma" class="form__label">Mã giao dịch:</label>
                <input type="text" class="form__input" id="" name="ma" placeholder="Nhập mã giao dịch" required>
              </div>
              <div class="form_submit">
                <button type="submit" class="btn btn-danger" name="naptien"> KIỂM TRA NGAY</button>
              </div>
            </form>
          </div>
          <div class="right">
            <div class="wrapper_huongdanImg">
              <img src="images/huongdan1.png" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="panel" id="nganhang__">
        <div class="panel__heading">NẠP TIỀN QUA NGÂN HÀNG</div>
        <div class="panel__body">
          <div class="wrapper__bank">
          <div class="bank">
              <div class="bank__wrapperImg">
                <img src="images/Techcombank_logo.png" alt="Techcombank_logo">
              </div>
              <div class="bank__info">
                <div class="bank__heading">
                Techcombank
                </div>
                <div class="bank__owner">
                Chủ tài khoản: <span class="bank__active"> Nguyễn Mạnh Tài<span>
                </div>
                <div class="bank__number">
                Số tài khoản: <span class="bank__active">19033807769010</span>
                </div>
                <div class="bank__description">
                Nội dung chuyển khoản: <span class="bank__active"><?php echo $r['email'] ?></span>
                </div>
              </div>
            </div>
            <div class="bank">
              <div class="bank__wrapperImg">
                <img src="images/vietcombank-vector-logo.png" alt="vietcombank_vector_logo">
              </div>
              <div class="bank__info">
                <div class="bank__heading">
                Vietcombank
                </div>
                <div class="bank__owner">
                Chủ tài khoản: <span class="bank__active"> Nguyễn Mạnh Tài<span>
                </div>
                <div class="bank__number">
                Số tài khoản: <span class="bank__active">0621000450800</span>
                </div>
                <div class="bank__description">
                Nội dung chuyển khoản: <span class="bank__active"><?php echo $r['email'] ?></span>
                </div>
              </div>
            </div>
          </div>
            <br>
            <div class="wrapper__bank">
            <div class="bank">
              <div class="bank__wrapperImg">
                <img src="images/argi_bank.png" alt="argi_bank">
              </div>
              <div class="bank__info">
                <div class="bank__heading">
                Agribank Hàm Tân
                </div>
                <div class="bank__owner">
                Chủ tài khoản: <span class="bank__active"> Nguyễn Mạnh Tài<span>
                </div>
                <div class="bank__number">
                Số tài khoản: <span class="bank__active">4802205143812</span>
                </div>
                <div class="bank__description">
                Nội dung chuyển khoản: <span class="bank__active"><?php echo $r['email'] ?></span>
                </div>
              </div>
            </div>
            <div class="bank">
              <div class="bank__wrapperImg">
                <img src="images/mb_bank.png" alt="mb_bank">
              </div>
              <div class="bank__info">
                <div class="bank__heading">
                MB bank
                </div>
                <div class="bank__owner">
                Chủ tài khoản: <span class="bank__active"> Nguyễn Mạnh Tài<span>
                </div>
                <div class="bank__number">
                Số tài khoản: <span class="bank__active">7650123888898</span>
                </div>
                <div class="bank__description">
                Nội dung chuyển khoản: <span class="bank__active"><?php echo $r['email'] ?></span>
                </div>
              </div>
            </div>  
            </div>
            </div>
      </div>
    </div>
    <?php 
    if(isset($_POST["naptien"])){
      if($_POST['sotien']=="" || $_POST['ma']==""){
        echo '<script>
        alert("Không được bỏ trống");
        </script>';
      }else{
      // lay data user

        $name= $_SESSION["username"];
        $sqluser= "SELECT * From `user` Where username = '$name'";
        $result = mysqli_query($link,$sqluser);
        $r = mysqli_fetch_assoc($result);

        // echo $sqluser;
        // echo "<br>";
        

        $sotien= htmlspecialchars(isset($_POST["sotien"])?$_POST["sotien"]:"");
        $ma= htmlspecialchars(isset($_POST["ma"])?$_POST["ma"]:"");
        $id_user = $r["ID"];
        $username = $_SESSION["username"];
        $day = date('Y-m-d h:i:s');
        $sql = "INSERT INTO `list_nap`( `id_user`, `user_name`, `so_tien`, `code`, `ngay_nap`, `trang_thai`) VALUES ('$id_user','$username','$sotien','$ma','$day','0')";
        $result1 = mysqli_query($link,$sql);
        // echo $sql;
        // echo "<br>";
        // exit();
        // $data = mysqli_fetch_assoc($result1);
        if($result1){
            echo '<script>
                alert("bạn đã nạp thành công chờ admin xử lý!!!");
            </script>';
        }
        else{
            echo '<script>
                alert("Nạp Không Thành Công!!!");
            </script>';
        }
      }
    }
    ?>
    <script>
    let tab_momo = document.getElementById("momo");
    let tab_nganhang= document.getElementById("nganhang");
    let momo__ = document.getElementById("momo__");
    let nganhang__= document.getElementById("nganhang__");
    tab_momo.classList.add('active2')
    momo__.hidden = false;
    nganhang__.hidden = true;
    function an_nganhang(){
        momo__.hidden = false;
        nganhang__.hidden = true;
        tab_momo.classList.add('active2')
        tab_nganhang.classList.remove('active2')
     }
     function an_momo(){
        momo__.hidden = true;
        nganhang__.hidden = false;
        tab_nganhang.classList.add('active2')
        tab_momo.classList.remove('active2')
     }
    </script>
    <?php
      include("footer.php");
    ?>
  </div>
</html>
