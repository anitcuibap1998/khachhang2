<?php
  require('libs/db.php');
  session_start();
  error_reporting(E_ALL);
  if(!isset($_SESSION['username'])){
    echo '<script>
                    window.location.href ="index.php"
                    </script>';
  }
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
  }
  .right{
    background-color:#fff;
    width:100%;
    
  }
  .wrapper__container{
    padding:30px 40px;
    background-color: rgb(43, 46, 55);
    min-height:400px;
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
    ?>
    <div id="body-wrap" class="container">
    <div class="wrapper__container">
    <h1 class="heading">LỊCH SỬ NẠP GAME</h1>
    
    <div class="left">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">STT</th>
            <th scope="col">User Name</th>
            <th scope="col">Ngày Mua</th>
            <th scope="col">Chi Tiết</th>
            <th scope="col">Tổng Tiền</th>
            <th scope="col">Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
           <?php 
           $name = $_SESSION['username'];
           $sql = "SELECT * FROM `list_giao_dich_mua` WHERE `username` =  '$name' ORDER BY id DESC LIMIT 0,60";
           $result = mysqli_query($link,$sql);
           if($result){
            while($row = mysqli_fetch_assoc($result)){
           ?>
        
            <tr>
            <th scope="row"><?php echo $row['id']?></th>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['ngay_mua']?></td>
            <td><div class="hien__mota" ><a style="text-decoration: none;" href="hienthi_mua.php?id=<?php echo $row["id"] ?>"  target="_blank">Chi Tiết</a></div></td>
            <td><?php echo $row['tong_tien']?></td>
            <td><?php  if($row["trang_thai"]==0){
                                            ?><p style="color:rebeccapurple;">Chờ Xử Lý</p><?php
                                        }
                                        if($row["trang_thai"]==1){
                                            ?><p style="color:red;">Hủy</p><?php
                                        }
                                        if($row["trang_thai"]==2){
                                            ?><p style="color: #12dd44;">Hoàn Thành</p><?php
                                        }?></td>
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
      include("footer.php");
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
