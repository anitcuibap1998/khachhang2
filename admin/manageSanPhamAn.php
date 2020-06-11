<?php
    require('libs/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/local.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/delete.css" />
    <script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>   
    <script src="/admin/ckeditor/ckeditor.js"></script>

</head>
<body>
    <div id="wrapper">
        <?php
            include("common.php");
        ?>
       <div class="container">
           <?php  ?>
            <div class="row" id="search-user">
                <form method="post">
                    <div class="row">
                       <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Tìm Kiếm ..." name="qry" value=<?php $qry = isset($_POST["qry"]) ? $_POST["qry"] : ''; echo $qry;  ?>>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary" type="submit" name="button_search" style="padding: 8px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row" id="list-user">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <!-- get from database -->
                    <?php
                    $tong_so_hang=30;
                    $so_page=1;
                    $vitri=0;
                    if(isset($_GET['vitri'])){
                        $vitri=$_GET['vitri'];
                     
                    }
                    //lấy tổng số hàng của user SELECT COUNT(ID) FROM `user`
                    $sql = "SELECT COUNT(ID) as tong FROM `san_pham`  where `hidden_sp` = 1 ";
                    $result_tong = mysqli_query($link, $sql);
                    if($result_tong){
                        $row = mysqli_fetch_assoc($result_tong);
                        //tổng số hàng
                        $tong_so_hang= $row['tong'];
                        //tổng số trang bằng tồng só hàng chia 30 phần tử
                        $so_page=ceil($tong_so_hang/30);
                        //echo $so_page;
                        //exit();
                    
                    //chia cho 30 mỗi page
                     }
                        if(!isset($_POST["button_search"])){
                            $qry = isset($_POST["qry"]) ? $_POST["qry"] : '';
                            $sql_description = "SELECT * FROM san_pham where `hidden_sp` = 1 ";
                            $sql =$sql_description ."order by id  DESC limit $vitri,30";
                            $result = mysqli_query($link, $sql);
                            if (mysqli_num_rows($result) > 0) { ?>
                                <!-- output data of each row -->
                                <table class="table" style="margin: 10px 0px">
                                    <thead>
                                        <tr>
                                             <th scope="col">ID</th>
                                            <th scope="col">name</th>
                                            <th scope="col">Tiền Chưa KM</th>
                                            <th scope="col">Tiền KM</th>
                                            <th scope="col">%Giảm Giá</th>
                                            <th scope="col">Hình 1</th>
                                            <th scope="col">Số Ngày KM</th>
                                            <th scope="col">Ngày Tạo</th>
                                            <th scope="col">Mô Tả</th>
                                            <th scope="col">Phân Loại</th>
                                            <th scope="col">SL Đã Bán</th>
                                            <th scope="col">Hình Ảnh 2</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)) {  ?>
                                    <tr>
                                        <th> <?php echo $row["id"] ?> </th>
                                        <th> <?php echo $row["name"] ?> </th>
                                        <th> <?php echo $row["tien_truoc_khi_giam_gia"] ?> </th>
                                        <th> <?php echo $row["tien_sau_khi_giam_gia"] ?> </th>
                                        <th> <?php echo $row["phan_tram_giam_gia"] ?> </th>
                                        <th> <?php echo $row["image"] ?> </th>
                                        <th> <?php echo $row["day_giam_gia"] ?> </th>
                                        <th> <?php echo $row["create_date"] ?> </th>
                                        <th> 
                                            <div class="hien__mota" ><a href="hienthi.php?id=<?php echo $row["id"] ?>"  target="_blank">Nội Dung Bị Hiện</a></div>
                                           </th>
                                        <th> <?php echo $row["phan_loai"] ?> </th>
                                        <th> <?php echo $row["so_luong_da_ban"] ?> </th>
                                        <th> <?php echo $row["image2"] ?> </th>
                                        <td>
                                            <button type="button" class="btn btn-info" name="edit" onclick="edit(this)">Edit</button>
                                            <button type="button" class="btn btn-danger" name="delete" onclick="del(this)">Hiện Sản Phẩm</button>
                                        </td>
                                    </tr>
                                <?php 
                                }
                            } else {
                                echo "No sản phẩm like ".$qry;
                            }
                        }
                        if(isset($_POST["button_search"])){
                            $qry = isset($_POST["qry"]) ? $_POST["qry"] : '';
                            $sql_name = "SELECT * FROM san_pham WHERE name LIKE '%{$qry}%' and `hidden_sp` = 1";
                            $sql_description = "SELECT * FROM san_pham WHERE id LIKE '%{$qry}%' and `hidden_sp` = 1";
                            $sql = $sql_name. " UNION ". $sql_description ." order by id  DESC limit $vitri,30";
                            $result = mysqli_query($link, $sql);
                            if (mysqli_num_rows($result) > 0) { ?>
                                <!-- output data of each row -->
                                <table class="table" style="margin: 10px 0px">
                                    <thead>
                                        <tr>
                                        <th scope="col">ID</th>
                                            <th scope="col">name</th>
                                            <th scope="col">Tiền Chưa KM</th>
                                            <th scope="col">Tiền KM</th>
                                            <th scope="col">%Giảm Giá</th>
                                            <th scope="col">Hình 1</th>
                                            <th scope="col">Số Ngày KM</th>
                                            <th scope="col">Ngày Tạo</th>
                                            <th scope="col">Mô Tả</th>
                                            <th scope="col">Phân Loại</th>
                                            <th scope="col">SL Đã Bán</th>
                                            <th scope="col">Hình Ảnh 1</th>
                                            <th scope="col">Hình Ảnh 2</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)) {  ?>
                                    <tr>
                                    <th> <?php echo $row["id"] ?> </th>
                                        <th> <?php echo $row["name"] ?> </th>
                                        <th> <?php echo $row["tien_truoc_khi_giam_gia"] ?> </th>
                                        <th> <?php echo $row["tien_sau_khi_giam_gia"] ?> </th>
                                        <th> <?php echo $row["phan_tram_giam_gia"] ?> </th>
                                        <th> <?php echo $row["image"] ?> </th>
                                        <th> <?php echo $row["day_giam_gia"] ?> </th>
                                        <th> <?php echo $row["create_date"] ?> </th>
                                        <th> 
                                        <div class="hien__mota" ><a href="hienthi.php?id=<?php echo $row["id"] ?>" target="_blank" >Nội Dung Bị Hiện</a></div>
                                        </th>
                                        <th> <?php echo $row["phan_loai"] ?> </th>
                                        <th> <?php echo $row["so_luong_da_ban"] ?> </th>
                                        <th> <?php echo $row["image2"] ?> </th>
                                      
                                        <td>
                                            <button type="button" class="btn btn-info" name="edit" onclick="edit(this)">Edit</button>
                                            <button type="button" class="btn btn-danger" name="delete" onclick="del(this)">Hiện Sản Phẩm</button>
                                        </td>
                                    </tr>
                                <?php 
                                }
                            } else {
                                echo "No sản phẩm like ".$qry;
                            }
                        }
                            mysqli_close($link);
                    ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <div id="phantrang" class="col-md-8">
                    <?php for ($i=0; $i < $so_page; $i++) { 
                    $vitri=$i*30;
                    ?>
                        <button type="submit" value=""><a href="manageSanPhamAn.php?vitri=<?php echo $vitri ?>">trang <?php echo $i; ?></a></button>
                        <?php 
                         }
                        ?>
                    </div>
    </div>
    
    <script>
        function edit(params) {
                var tr = params.parentElement.parentElement;
                var td0= tr.cells.item(0).innerHTML;
                td0 = td0.replace(' ','' ); //id của user có space ???
                location.href= "editSanPham.php?id=" + td0;
        };
        function del(params) {
            if(confirm("Bạn có chắc muốn Hiện sản phẩm này?")){
                var tr = params.parentElement.parentElement;
                var td0= tr.cells.item(0).innerHTML;
                td0 = td0.replace(' ','' ); //id của user có space ???
                location.href= "hienSanPham.php?id=" + td0;
            }
        };
        function hien__mota(){
            this.hidden = false;
        }
    </script>
</body>
</html>
