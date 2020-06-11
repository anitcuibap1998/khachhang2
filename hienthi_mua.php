<?php 
session_start();
if(!isset($_SESSION["username"])){
    header("Localtion:login.php");
}
else{
    include_once("libs/db.php");
    $id__ = $_GET["id"];
    $sql= "SELECT * FROM `chi_tiet_gd_mua` where `id_list_giao_dich_mua` = $id__";
    $result = mysqli_query($link, $sql);
    

?>
<!DOCTYPE html>
<html>

<head>
    <style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    </style>
</head>

<body>

    <table id="customers">
        <tr>
            <th>ID</th>
            <th>Mã Giao Dịch</th>
            <th>Tên Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Số Lượng</th>
            <th>Giá</th>
            <th>Tên Đăng Nhập Game</th>
            <th>Mật Khẩu</th>
            <th>Thông Tin Khác</th>
            <th>Phần Trăm Giảm Giá</th>
            <th>id Đăng Nhập</th>
            <th>Phone</th>
            <th>Cách Đăng Nhập</th>
            <th>Hệ Điều Hành</th>
            <th>Máy Chủ</th>
        </tr>
       <?php
       
 
       if($result){
   while( $r = mysqli_fetch_assoc($result)){
       ?>
        <tr>
            <td><?php echo $r['id'];?></td>
            <td><?php 
                echo $r['id_list_giao_dich_mua']; 
            ?></td>
            <td><?php echo $r['ten_product']; ?></td>
            <td><img src="/admin/images/<?php echo $r['image_product'] ;?>" alt="hình Sản Phẩm" width="150px" height="200px"></td>
            <td><?php echo $r['soluong'] ;?></td>
            <td><?php echo $r['gia'] ;?></td>
            <td><?php echo $r['username']; ?></td>.
            <td><?php echo $r['password']; ?></td>
            <td><?php echo $r['thong_tin_them']; ?></td>
            <td><?php echo $r['phan_tram_giam_gia']; ?></td>
            <td><?php echo $r['idDangNhap']; ?></td>
            <td><?php echo $r['sdt'] ;?></td>
            <td><?php echo $r['cachdangnhap']; ?></td>
            <td><?php echo $r['hdh']; ?></td>
            <td><?php echo $r['maychu']; ?></td>

        </tr>
        <?php
        } }?>
    </table>

</body>

</html>
    <?php } ?>