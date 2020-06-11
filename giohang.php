<?php
  require('libs/db.php');
  if(!isset($_SESSION)) session_start();
  // else header("Location:index.php");
  error_reporting(E_ALL);
  $count = 0;
  $total = 0;
  $cart;
  if(isset($_SESSION['cart'])){
    $count = count($_SESSION['cart']);
    $cart = $_SESSION['cart'];
  }else{
    $_SESSION['cart'] = [];
  }
  if(isset($_SESSION['username'])){
    $name = $_SESSION['username'];
    $sql = "SELECT * FROM user where username = '$name'";
    $result = mysqli_query($link,$sql);
    $r = mysqli_fetch_assoc($result);
    $so_du = $r['so_du'];
    $id_user= $r['ID'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y-m-d h:i:s");
    // echo $date;
    // exit();
  }
  if(isset($_POST['save'])){
    $id = isset($_POST['id'])?$_POST['id']:null;
    $qty = isset($_POST['qty'])?$_POST['qty']:null;
    $_SESSION['cart'][$id]['soluong'] = $qty;
  }
  if(isset($_POST['delete'])){
    $id = isset($_POST['id'])?$_POST['id']:null;
    unset($_SESSION['cart'][$id]);
  }
  if(isset($_POST['addToCart'])){
    if(isset($_SESSION['tong'])){
      $tongCong = $_SESSION['tong'];
    }
    if( isset($_SESSION['cart']) && count($_SESSION['cart']) <= 0){
        echo '<script>
        alert("Bạn Hãy Chọn Ít Nhất 1 Sản Phẩm Thì Mới Thanh Toán Được Ạ!!!")
    </script>';
    }else if($tongCong>$so_du){
      echo '<script>
      alert("Bạn Không Có Đủ Tiền Hãy Nạp Thêm Để Thanh Toán Dịch Vụ Này!!!")
  </script>';
    }else{

      //tao ra 1 row ql giao dich mua ()
      $sql_add = "INSERT INTO `list_giao_dich_mua`(`id_user`, `username`, `ngay_mua`, `tong_tien`, `trang_thai`) VALUES ('$id_user','$name','$date','$tongCong','0')";
      $kq1 = mysqli_query($link,$sql_add);
      $last_id = mysqli_insert_id($link);
      // echo $last_id;
      // exit();
      //lưu từng chi tiết vào bảng chi tiết giao dịch mua 
      $array = $_SESSION['cart'];
      foreach($array as $i => $item) {
        $product=htmlspecialchars($item['ten_product']);
        $image= htmlspecialchars($item['image_product']);
        $soluong = htmlspecialchars($item['soluong']);
        $price =  htmlspecialchars($item['gia']);
        $username=htmlspecialchars($item['username']);
        $password=htmlspecialchars($item['password']);
        $description=htmlspecialchars($item['description']);
        $phantram=htmlspecialchars($item['phantram']);

        //new
        $idDangNhap = htmlspecialchars($item['idDangNhap']);
        $sdt = htmlspecialchars($item['sdt']);
        $cachdangnhap = htmlspecialchars($item['cachdangnhap']);
        $hdh = htmlspecialchars($item['hdh']);
        $maychu = htmlspecialchars($item['maychu']);
        $sql = "INSERT INTO `chi_tiet_gd_mua`( `id_list_giao_dich_mua`, `ten_product`, `image_product`, `soluong`, `gia`, `username`, `password`, `thong_tin_them`, `phan_tram_giam_gia`,`idDangNhap`,`sdt`,`cachdangnhap`,`hdh`,`maychu`)
         VALUES ('$last_id','$product','$image','$soluong','$price','$username','$password','$description','$phantram','$idDangNhap','$sdt','$cachdangnhap','$hdh','$maychu')";
        $truyvan = mysqli_query($link,$sql);
      }
      //Cập nhật trừ tiền tài khoản người dùng
      $sql_update_tien = "UPDATE user Set `so_du` = `so_du` - '$tongCong' where id = '$id_user' ";
      $truy_van_tru_tien = mysqli_query($link, $sql_update_tien);
      //thong bao thanh cong
      if($truy_van_tru_tien){
        // hủy sesion cart
        unset($_SESSION['cart']);
      }
      echo '<script>
      alert("Thanh Toán Giao Dịch Thành Công Chờ Admin Xử Lý!!!")
      </script>';
      
    }
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
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
    border-radius:2px;
  }
  .right{
    background-color:#fff;
    width:100%;
    
  }
  .wrapper__container{
    padding:30px 15px;
    background-color: rgb(43, 46, 55);
    min-height:400px;
    color:#fff!important
  }
  .heading{
    color: #1ebea4;
    font-weight: normal;
    font-size: 18px;
  }
  .account{
    box-shadow: 0 2px 0 #1bbfa4;
  }
  .left{
    background-color:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
  }
  .total{
      font-size:18px;
      color:red;
  }
  .wrapper__cart{
    margin-bottom:15px;
  }
  .cart{
    display:flex;
    border-top:1px solid #ECEDEF;
    justify-content:space-between;
    padding-top:25px;
    width:97%;
  }
  .wrapper__img{
    width:115px;
    height:115px;
  }
  .cart__img{
    width:100%;
    height:100%;
    object-fit:cover
  }
  .mahang,.price{
    color:#EB5757
  }
  .price{
    font-size:18px;
  }
  .discount{
    width:50px;
    height:20px;
    background-color:red;
    text-align:center;
    border-radius:3px;
  }
  .qty__wrapper{
    display:flex;
    justify-content:center;
  }
  .qty{
    width:40px;
  }
  .qty__input{
    width:100%;
    height:30px;
    border:none;
    outline:none;
    text-align:center;
  }
  .tru,.cong{
    width:30px;
    height:30px;
    background-color:#ECEDEF;
    text-align:center;
    padding-top:2px;
    font-size:14px;
    color:#000;
    cursor:pointer;
  }
  .tru{
    border-top-left-radius:3px;
    border-bottom-left-radius:3px;
  }
  .cong{
    border-top-right-radius:3px;
    border-bottom-right-radius:3px;
  }
  .heading__cart{
    color: rgb(131, 177, 81);
    font-weight:300;
  }
  .heading__item{
    color: rgb(146, 150, 159);
    font-weight:300;
  }
  .cart__container{
    display:flex;
  }
  .cart__right{
    width:28%;
    margin-top:10px;
  }
  .cart__left{
    width:72%;
  }
  .btn{
    padding:8px 18px;
    border:none;
    outline:none;
    color:#FFF;
    cursor:pointer;
    font-size:13px;
    transition:all 0.2s;
    border-radius:0;
  }
  .btn:hover{
      transform:translateY(-2px);
      background-color:#1cbfb8 !important
  }
  .btn-danger{
      background-color: #1cbfa4
  }
  .add_sp{
    font-size:14px;
    line-height:35px;
    color:#fff;
  }
  .add_sp:hover{
    color:#fff;
  }
  .operation{
    text-align:right;
    margin-right:40px;
  }
  .btn__save,.btn__delete{
    background-color:transparent;
    border:none;
    color:#fff;  
  }
  .btn__save{
    
    margin-right:15px;
    color:rgb(131, 177, 81);
  }
  .btn__delete{
  }
 
  #nav .sub-menu {
    left: 0;
  }
  a{
    list-style-type: none;
  }
    .phai_phai {
    line-height: 14px !important;
    width: 62%;
  }
@media only screen and (max-width: 1000px){
  #header .repone__{
        display: contents !important;
    }
}
</style>
<?php

  if(!isset($_SESSION['username'])){?>
    <!-- <style>
  ul{transform: translateX(-210px) !important }
  #nav .sub-menu {
    left: 208px!important;
} 
  </style>-->
  <?php 
}
  ?>
<body>
  <div id="wrapper">
    <?php
      include("header.php");
    ?>
    <div id="body-wrap" class="container" style="padding:0 0 10px 0">
    <div class="wrapper__container">
    
   
    <div class="cart__container">
      
      <div class="cart__left">
        <h2><span class="heading__cart">Cart</span> <span class="heading__item">
        <?php
        if(isset($_SESSION)){
        if(isset($_SESSION['cart'])){ 
          echo  count($_SESSION['cart'])." items";
        }
        }else{
          echo "0 item";
        }
        ?></span></h2>
        <?php 
        if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
         
            $array = $_SESSION['cart'];
            foreach($array as $i => $item) {
            
              $soluong =  $item['soluong'];
              $price =  $item['gia'];
        
              $total += $price * $soluong;
              
              ?> 
               <form action="" method="post">
              <div class="wrapper__cart">
                <div class="cart">
                  <div class="wrapper__img">
                    <img src="admin/images/<?php echo $item['image_product']?>" alt="" class="cart__img">
                  </div>
                  <div class="item__left">
                    <h6><?php echo $item['ten_product']?></h6>
                    <p class="mahang">Mã hàng: nạp game</p>
                  </div>
                  <div class="item__middle">
                    <div class="qty__wrapper">
                      <div class="qty"><input type="number" value="<?php echo $item['soluong']?>" class="qty__input" name="qty"></div>
                    </div>
                  </div>
                  <div class="item__right">
                    <div class="price"><?php echo number_format($item['gia'], 0, '', ','); ?>đ</div>
                    <div class="discount"><?php echo $item['phantram'];?></div>
                  </div>
              </div>
              <div class="operation">
                  <input type="hidden" value="<?php echo $i ?>" name="id">
                  <input type="submit" value="Save" name="save" class="btn__save">
                  <input type="submit" value="Delete" name="delete" class="btn__delete">
              </div>
            </div>
            </form>  
            <?php } 
            $_SESSION['tong']= $total;
         }else{ ?>
        <h5>Hiện tại không có sản phẩm nào được chọn mua!</h5>
          <?php } ?>
        
      </div>
      <div class="cart__right">
        <a href="" class="add_sp">Chọn thêm sản phẩm</a>
        <div class="left">
          <table class="table table-striped table-borderless">
              <thead>
                  <tr>
                  <th class="account" >Thông tin đơn hàng <br/><span>(<?php echo $count?> Sản phẩm)</span></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                  <th scope="row">Thành tiền:</th>
                  <td><?php echo number_format($total, 0, '', ','); ?>đ</td>
                  </tr>
                  <tr>
                  <th scope="row">Tổng cộng :</th>
                  <td class="total"><?php echo number_format($total, 0, '', ','); ?>đ</td>
                  </tr>
              </tbody>
          </table>
        </div>
        <div class="form_submit">
          <form action="" method="post">
          <button type="submit" class="btn btn-danger" name="addToCart" >Tiến Hành Thanh Toán</button>
          </form>
        </div>
      </div>
    </div>
    
    </div>
    </div>
    <?php
      include("footer.php");
    ?>
  </div>

</html>
