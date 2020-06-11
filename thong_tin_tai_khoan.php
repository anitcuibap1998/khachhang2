<?php
  require('libs/db.php');
  session_start();
  error_reporting(E_ALL);
  $mod='';
?>
<!DOCTYPE html>
<!-- saved from url=(0018)javascript:void(); -->
<html lang="vi" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
  
  .left{
    background-color:#fff;
    width:100%;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
    margin-top:20px;
  }
  .right{
    background-color:#fff;
    width:100%;
    
  }
  .wrapper__container{
      padding:30px 40px;
      /* background-color:#f2f2f4 */
    background-color: rgb(43, 46, 55);

  }
  .heading{
    color: #1ebea4;
    font-weight: normal;
    font-size: 18px;
  }
  .account{
    box-shadow: 0 2px 0 #1bbfa4;
  }
</style>
<body>
  <div id="wrapper">
    <?php
      include("header.php");
    if(!isset($_SESSION['username'])){
      echo '<script>
      window.location.href ="index.php"
      </script>'; 
    } 
    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $sql = "SELECT * From `user` where `username` = '$username' ";
      $result = mysqli_query($link,$sql);
      $r = mysqli_fetch_assoc($result);
      $id_user = $r['ID'];
    ?>
    <div id="body-wrap" class="container">
    <div class="wrapper__container">
    <h1 class="heading">Account</h1>
    <div class="left">
        <table class="table table-striped table-borderless">
            <thead>
                <tr>
                <th class="account" >TÀI KHOẢN CỦA BẠN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row" >Tên đầy đủ</th>
                <td style="font-weight: 800;"><?php echo $r['fullname'] ?></td>
                </tr>
                <tr>
                <th scope="row">Số dư</th>
                <td style="font-weight: 800;"><?php echo number_format($r['so_du'], 0, '', ',');?> đ</td>
                </tr>
                <tr>
                <th scope="row">Cấp độ VIP</th>
                <td style="font-weight: 800;"><?php
               if( $r['cap_do_vip']==0){
                 echo "Thường";
               } 
               if( $r['cap_do_vip']==1){
                echo "Víp Bạc";
              } 
              if( $r['cap_do_vip']==2){
                echo "Vip Vàng";
              } 
                 ?>
                </td>
                </tr>
                <tr>
                <th scope="row">Số di động</th>
                <td style="font-weight: 800;">0<?php echo $r['phone'] ?></td>
                </tr>
                <tr>
                <th scope="row">Email</th>
                <td style="font-weight: 800;"><?php echo $r['email'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 class="heading">TỔNG QUAN</h1>
    <div class="right">
    <table class="table table-striped table-borderless">
            <thead>
                <tr>
                <th  class="account">THÔNG BÁO</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                $sql = "SELECT * FROM `thong_bao` WHERE id_user = $id_user ORDER by id DESC LIMIT 0,10";
                $result = mysqli_query($link,$sql);
                if($result){
                 
                while($row = mysqli_fetch_assoc($result)){
              ?>
                <tr>
                <th scope="row">Cập Nhật:</th>
                <td style="font-weight: 800;" >
                <?php echo $row['note']." --> Mã giao dịch:  ".$row["ma_nap_tien"]."  Số Tiền: ".$row['so_tien'] ; ?> 
                </td>
                </tr>
              <?php 
                }
              }

              ?>  
            </tbody>
        </table>
    </div>

    </div>
   
    </div>
    <?php
    }
      include("footer.php");
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
