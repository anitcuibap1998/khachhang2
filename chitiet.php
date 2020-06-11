<?php
    if (isset($_GET['id'])) $id = $_GET['id'];
   
    if(isset($_POST['addToCart'])){    
        $soluong = isset($_POST['soluong']) ?$_POST['soluong'] : 'Trống';
        $username = isset($_POST['username']) ?$_POST['username'] : 'Trống';
        $password = isset($_POST['password']) ?$_POST['password'] : 'Trống';
        $description = isset($_POST['description']) ?$_POST['description'] : 'Trống';
        $product = isset($_POST['product_name']) ? $_POST['product_name'] :'Trống';
        $image = isset($_POST['product_img']) ? $_POST['product_img'] : 'Trống';
        $gia = isset($_POST['price']) ? $_POST['price'] : 'Trống';
        $phantram = isset($_POST['phantram']) ? $_POST['phantram'] : 'Trống';
        // new 
        $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : 'Trống';
        $cachdangnhap = isset($_POST['cachdangnhap']) ? $_POST['cachdangnhap'] : 'Trống';
        $hdh = isset($_POST['hdh']) ? $_POST['hdh'] : 'Trống';
        $maychu = isset($_POST['maychu']) ? $_POST['maychu'] : 'Trống';
        $idDangNhap = isset($_POST['idDangNhap']) ? $_POST['idDangNhap'] : 'Trống';
        if(!isset($_SESSION['username'])){
            ?>
            <script>
                alert("Bạn Phải Đăng Nhập Mới Có Thể Thêm Sản Phẩm Vào Vỏ Hàng Được Ạ!!!")
            </script>
            <?php
        }
        else if(!isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] = array(
                'ten_product' => $product,
                'image_product' => $image,
                'soluong' => $soluong,
                'gia' => $gia,
                'username'=> $username,
                'password'=>$password,
                'description'=>$description,
                'phantram'=>$phantram,
                //new
                'idDangNhap'=>$idDangNhap,
                'sdt'=>$sdt,
                'cachdangnhap'=>$cachdangnhap,
                'hdh'=>$hdh,
                'maychu'=>$maychu,
            );
            ?>
            <script>
                alert("Thêm Vào Giỏ Hàng Thành Công!!!")
            </script>
            <?php
        }else{
            $_SESSION['cart'][$id]['soluong'] += $soluong;
            ?>
            <script>
                alert("Thêm Vào Giỏ Hàng Thành Công!!!")
            </script>
            <?php
        }
    }

  
  $sql = "select * from `san_pham` where `id` = '$id'";
  $query= mysqli_query($link, $sql);
  $r=mysqli_fetch_assoc($query);
  if($r>0){?>
<style>
.container_1 {
    width:100%
}
.wrapper{
    display:flex;
}
.content__left{
    /* width:40% */
}
.content__right{
    padding:10px 20px
}
.wrapper__img{
    width:500px;
    
}
.product__img{
    width:'100%';
    height:'100%';
    object-fit:cover
}
.product__discount{
    display:flex;
}
.form{

}
.form__group{
    display:flex;
}
form__group2{

}
.form__label{
    font-size:14px;
    color:#FFFFFF;
    display:block;
    width:100px;
    padding-top:10px
}
.form__label2{
    font-size:14px;
    color:#FFFFFF;
    display:block;
    padding-top:10px;
    margin-bottom:10px;
}
.form__text{
    font-size:14px;
    color:#FFFFFF;
}
.form__group__text{
    padding-left:10px;
    margin-top:10px;
}
.form__input{
    padding:8px;
    width:50%
}
.form__input2{
    padding:10px; 
    display:block;
    width:100%;
}
.form__input:focus,.form__input2:focus{
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6)
}


.form__group{
    padding:10px
}
.form__input::placeholder{
    color:#818792;
    font-size:11px;
}
form__input2::placholder{
    color:#818792;
    font-size:13px;
}
.form__textArea{
    padding:10px!important
}
.form_submit{
    margin-top:20px;
    display:flex;
    justify-content:flex-end
}
.btn{
    padding:10px 15px;
    border:none;
    outline:none;
    color:#FFF;
    cursor:pointer;
    transition:all 0.2s
}
.form .btn:hover{
    transform:translateY(-3px);
    background-color:#EB5757!important
}
.btn-danger{
    background-color: #D60808;
}
.block{display:block}
.product__heading{
    text-align:center;
    margin-top:18px
}
.product__heding__text{
    font-size:32px;
    color:#ECEDEF
}
.product__discount{
    background-color:#1cbfa4;
    padding:6px;
    margin-top:10px;
    cursor:pointer;
    transition:all 0.2s
}
.product__discount:hover{
    background-color:#30d5ba;
}
.product__discount p{
    margin: 0 auto;
    font-size:14px;
}
.product__info__list{
    text-align:left
}
.product__info__item{
    padding:10px 0;
    font-size:13px;
    list-style:none
}
.clear__detail{
    height: 20px;
    background: #181818;
}
.heading__describe{
    font-size:24px;
    font-weight:bold;
    color:#1cbfa4
}
.block__describe,.wrapper__video{
    padding-left:20px;
}
.trai_trai {
    width: 30% !important;
}
.phai_phai {
    width: 70% !important;
}
.form__select{
    width:100%;
    padding:8px;
}
</style>

<div class="container_1">
    <div class="block" id="page-info">
        <div class="blocktitle breadcrumbs">
            <div class="item">
                <a href="?mod=home" title="Nạp Game Nhanh, Nạp Game Online chất lượng cao uy tín">
                    <span>Sản Phẩm</span>
                </a>
            </div>
            <div class="item last-child">
                <span itemprop="title"><?php echo $r['name'] ?></span>
            </div>
        </div>
       
        <div class="wrapper">
            <div class="content__left">
                <div class="wrapper__img">
                    <img src="admin/images/<?php echo $r['image'] ?>" alt="<?php echo $r['name'] ?>" class="product__img"/>
                </div>
                <div class="product__info">
                    <div class="product__heading">
                        <h2 class="product__heding__text"><?php echo $r['name'] ?></h2>
                        <div class="product__discount">
                            <p>ĐANG KHUYẾN MÃI</p>
                        </div>
                        <ul class="product__info__list">
                            <?php
                      // $nation_id = $r['nation_id'];
                      // $sql = "select * from `nation` where `id` = '$nation_id'";
                      // $query=mysqli_query($link,$sql);
                      // $r2=mysqli_fetch_assoc($query);
                    ?>
                            <li class="product__info__item">Số lượng đã bán: <span class="status1"><?php echo $r['so_luong_da_ban'] ?></span></li>
                            <li class="product__info__item" >Giá Gốc: <del><?php echo number_format($r['tien_truoc_khi_giam_gia'], 0, '', ','); ?> VND</del></li>
                            <li class="product__info__item">Giá Khuyến Mãi: <?php echo number_format($r['tien_sau_khi_giam_gia'], 0, '', ','); ?> VND</li>
                            <li class="product__info__item">Hình Thức: Nạp Chậm</li>
                        </ul>
                    </div>
                    <div class="product__text"></div>
                </div>
            </div>
           
            <div class="content__right">
                <form action="" method="POST" class="form">
                <input type="hidden" id="id" name="id" value="<?php echo $r['name'] ?>"/>
                <input type="hidden" id="product_name" name="product_name" value="<?php echo $r['name'] ?>"/>
                <input type="hidden" id="product_img" name="product_img" value="<?php echo $r['image2'] ?>"/>
                <input type="hidden" id="price" name="price" value="<?php echo $r['tien_sau_khi_giam_gia'] ?>"/>
                <input type="hidden" id="phantram" name="phantram" value="<?php echo $r['phan_tram_giam_gia'] ?>"/>
                
                <div class="form__group">
                    <label for="soluong" class="form__label">Số Lượng:</label>
                    <input type="number" min="1" max="10000" id="soluong" name="soluong" placeholder="0" class="form__input" style="width:60px" value="1" required>
                </div>
                <div class="form__group2">
                    <label for="sdt" class="form__label2"><span class="red">*</span> Vui lòng để lại số điện thoại</label>
                    <input type="number" class="form__input2" id="sdt" name="sdt" placeholder="Vui lòng để lại số điện thoại" required>
                </div>
                <?php if($r['phan_loai']=='Nạp Game Mobile'){ ?>
                <div class="form__group2">
                    <label for="cachdangnhap" class="form__label2"><span class="red">*</span> Vui lòng ghi cách đăng nhập</label>
                    <input type="text" class="form__input2" id="cachdangnhap" name="cachdangnhap" placeholder="Vui lòng ghi cách đăng nhập" required>
                </div>
               
                <div class="form__group2">
                <label for="hdh" class="form__label2"><span class="red">*</span> Vui lòng chọn hệ điều hành bạn đang sử dụng</label>
                <select name="hdh" id="hdh" class="form__select">
                    <option value="ios">IOS</option>
                    <option value="android">ANDROID</option>
                    <option value="windown">WINDOW</option>
                </select>
                </div>
                <?php } ?>
                <label class="form__label2"><span class="red">* </span>Nhập thông tin tài khoản game</label>
                <?php if($r['phan_loai']=='Nạp Game Mobile'){ ?>
                <div class="form__group">
                    <label for="maychu" class="form__label">Máy Chủ:</label>
                    <input type="text" class="form__input" id="maychu" name="maychu" placeholder="Máy chủ" required>
                </div>
                <div class="form__group">
                    <label for="username" class="form__label">Tên nhân vật:</label>
                    <input type="text" class="form__input" id="username" name="username" placeholder="Tên nhân vật" required>
                </div>
                <?php } ?>
                <div class="form__group">
                    <label for="idDangNhap" class="form__label">Id đăng nhập:</label>
                    <input type="text" class="form__input" id="idDangNhap" name="idDangNhap" placeholder="Id đăng nhập" required>
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">Mật Khẩu:</label>
                    <input type="text" class="form__input" id="" name="password" placeholder="password" required>
                </div>
                <div class="form__group__text">
                    <label for="description" class="form__text block">Thông Tin Cần Thiết Khác Để Đăng Nhập Vào Hoặc Ghi Chú</label>
                    <textarea class="form__textArea" name="description" placeholder=""
                    rows="4" cols="50"></textarea>
                </div>
                <div class="form_submit">
                    <button type="submit" class="btn btn-danger" name="addToCart" ><i class="fas fa-cart-plus icon__cart"></i> Thêm Vào Giỏ Hàng</button>
                </div>
                </form>
            </div>
           
        </div>
        <div class="detail container_1">
            <div class=" heading__describe">Mô tả sản phẩm:</div>
            <div class="block__describe">
                <h2 style="color:#fff"><?php echo " ".$r['name'] ?>:</h2><br>
                <h4><?php echo $r['description'] ?></h4>
            </div>
        </div>
        <div class="clear__detail">

        </div>
        <div class="detail container_1">
        <h2 class="heading__describe">Video hướng dẫn:</h2>
        <div class="wrapper__video">
            <iframe width="600" height="400" src="https://www.youtube.com/embed/2tJjplMngFE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        
        </div>
    </div>
</div>
<?php
  }else {
      echo "<h2>Không tìm thấy !!!</h2>";
  }
?>

