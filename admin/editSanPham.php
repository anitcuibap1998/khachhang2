<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sửa Sản Phẩm</title>

	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="asset/css/local.css" />

	<script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
    <script src="/admin/ckeditor/ckeditor.js"></script>


	<style>
		img {
			filter: gray;
			/* IE6-9 */
			-webkit-filter: grayscale(1);
			/* Google Chrome, Safari 6+ & Opera 15+ */
			-webkit-box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			box-shadow: 0px 2px 6px 2px rgba(0, 0, 0, 0.75);
			margin-bottom: 20px;
		}

		img:hover {
			filter: none;
			/* IE6-9 */
			-webkit-filter: grayscale(0);
			/* Google Chrome, Safari 6+ & Opera 15+ */
		}

		div {
			padding-bottom: 30px;
		}
        .form-control{
            color: black;
        }
        .title{
            /* background-color: #2a9fd6; */
            padding: 10px 30px;
            border-radius: 10px;
            width: 500px;
            margin: auto;
        }
        
	</style>
</head>

<body>

	<?php
        require('libs/db.php');
        if(!isset($_GET["id"])){
            echo "Id sản phẩm không tồn tại!!! Mời thử lại!!!";
        }
        if(isset($_GET["id"])){
            $idSp= $_GET["id"];
        $sql = "SELECT * FROM san_pham where id = ".$_GET["id"];
        $result = mysqli_query($link, $sql);
        if($result){
            $r = mysqli_fetch_assoc($result);
    ?>
		<div id="wrapper">
            <?php
                include("common.php");
            ?>
            <div class="container" id="post_film" style="padding: 0 15%">
                <div class="row text-center" style="margin: 20px 0px;">
                    <h2 class="title">Sửa Sản Phẩm</h2>
                </div>
                <form method="post" id="form-insert-film" name="form-insert-film" class="form-horizontal" action="" role="form" enctype="multipart/form-data">
                    <!-- <div>
                        <label for="ID-film" class="col-md-2">
                            ID phim
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="ID-film" value="<?php echo "auto increase";?>">
                        </div>
                    </div> -->
                    <input type="hidden" name="id" value="<?php echo $r["id"]?>">
                    <div>
                        <label for="namesp" class="col-md-2">
                            Tên sản phẩm:
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namesp" name="namesp" value="<?php echo $r["name"]?>" required> 
                        </div>
                    </div>
                    <div>
                        <label for="post_content" class="col-md-2">
                        Mô tả sản phẩm: 
                        </label>
                        <div class="col-md-9" style="color: black">
                        <textarea name="post_content" id="post_content" rows="10" cols="150" required><?php echo $r["description"] ?></textarea>
                        </div>
                        <script>
                            // Thay thế <textarea id="post_content"> với CKEditor
                            CKEDITOR.replace( 'post_content' );// tham số là biến name của textarea
                        </script>
                    </div>
                    <div>
                        <label for="gia_goc" class="col-md-2">
                            Giá Góc:
                        </label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="gia_goc" name="gia_goc" value="<?php echo $r["tien_truoc_khi_giam_gia"] ?>" required>
                        </div>
                    </div>
                    <div>
                        <label for="gia_km" class="col-md-2">
                            Giá khuyến mãi:
                        </label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="gia_km" name="gia_km" value="<?php echo $r["tien_sau_khi_giam_gia"] ?>" required>
                        </div>
                    </div>
                    
                    <div>
                        <label for="phan_tram" class="col-md-2">
                            Phần trăm giảm giá:
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="phan_tram" name="phan_tram" value="<?php echo $r["phan_tram_giam_gia"] ?>" required >
                        </div>
                    </div>
                    <div>
                        <label for="image" class="col-md-2">
                        Hình ảnh trang chủ: 
                        </label>
                        <div class="col-md-9">
                            
                            <input type="file" name="image_name" id="image_name" onchange="alertName()"/>
                            <input type="text" class="form-control" id="image_link" name="image" value="<?php echo $r["image"] ?>" required>
                           
                            <p class="help-block">
                                Ví dụ: /images/anh_nay_ngoai_trang_chu.jpg
                            </p>
                            <script>
                                function alertName() {
                                    var name =  document.getElementById("image_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("image_link").value =  result;
                                }
                            </script>
                        </div>
                    </div>
                    <div>
                        <label for="image" class="col-md-2">
                        Hình ảnh sản phẩm: 
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="image_name1" id="image_name1" onchange="alertName1()"/>
                            <input type="text" class="form-control" id="image_link1" name="image2" value="<?php echo $r["image2"] ?>" required>
                            <p class="help-block">
                                Ví dụ: /images/anh_san_pham.jpg
                            </p>
                            <script>
                                function alertName1() {
                                    var name =  document.getElementById("image_name1").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("image_link1").value =  result;
                                }
                            </script>
                        </div>
                    </div>
                    <div>
                        <label for="phan_loai" class="col-md-2">
                            Phân Loại:
                        </label>
                        <div class="col-md-10">
                            <select id="category" style="color: black" name="phan_loai">
                                        <option value="Gói nạp Steam">
                                        Gói nạp Steam
                                        </option>
                                        <option value="PUPG">
                                        PUPG
                                        </option>
                                        <option value="ITUNES">
                                        ITUNES
                                        </option>
                                        <option value="GOOGLE PLAY">
                                        GOOGLE PLAY
                                        </option>
                                        <option value="EBAY">
                                        EBAY
                                        </option>
                                        <option value="AMAZON">
                                        AMAZON
                                        </option> 
                                        <option value="BATTLET.NET">
                                        BATTLET.NET
                                        </option> 
                                        <option value="PLAYSTATION">
                                        PLAYSTATION
                                        </option> 
                                        <option value="APEX LEGEND">
                                        APEX LEGEND
                                        </option> 
                                        <option value="STEAM CODE WALLET">
                                        STEAM CODE WALLET
                                        </option>
                                        </option> 
                                        <option value="Nạp Game Mobile">
                                        Nạp Game Mobile
                                        </option>
                                        </option> 
                                        <option value="Khác">
                                        Khác
                                        </option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="soluong" class="col-md-2">
                           Số Lượng Đã Bán:
                        </label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="soluong" name="soluong" value="<?php echo $r["so_luong_da_ban"] ;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <!-- <input class="btn btn-primary" type="submit" value="Post"> -->
                            <button type="submit" class="btn btn-primary" id="button_post" name="button_post">Sửa Sản Phẩm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
}
        }
?>
    <?php

    if(isset($_POST["button_post"])){
        $namesp = $_POST["namesp"];
        $mo_ta = $_POST["post_content"];
        $gia_goc = $_POST["gia_goc"];
        $gia_km = $_POST["gia_km"];
        $phan_tram = $_POST["phan_tram"];
        
        $phan_loai = $_POST["phan_loai"];
        $create_date= date("Y-m-d");
        $soluong=$_POST['soluong'];
        // print_r($image);
        // echo "<br>";
        // print_r( $image2);
        $file_name1 =$_POST['image'];
        $file_name = $_POST['image2'];
       
        error_reporting(0);

        if(isset($_FILES['image_name']) ){
            $errors= array();
            $file_name = $_FILES['image_name']['name'];
            $file_size = $_FILES['image_name']['size'];
            $file_tmp = $_FILES['image_name']['tmp_name'];
            $file_type = $_FILES['image_name']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image_name']['name'])));
             
          
             

            $expensions= array("jpeg","jpg","png");
             
            if(in_array($file_ext,$expensions)=== false ){
               $errors[]="404";
            }
             
            if($file_size > 9097152 && $file_size1 > 9097152) {
               $errors[]='404';
            }
            if(empty($errors)==true) {
               move_uploaded_file($file_tmp,"images/".$file_name);
               echo "Success";
            }else{
               print_r($errors);
            }
         }
         if(isset($_FILES['image_name1'])){
            $errors1= array();
             
            $file_name1 = $_FILES['image_name1']['name'];
            $file_size1 = $_FILES['image_name1']['size'];
            $file_tmp1 = $_FILES['image_name1']['tmp_name'];
            $file_type1 = $_FILES['image_name1']['type'];
            $file_ext1=strtolower(end(explode('.',$_FILES['image_name1']['name'])));
             

            $expensions= array("jpeg","jpg","png");
             
            if( in_array($file_ext1,$expensions)=== false){
               $errors1[]="404";
            }
             
            if($file_size > 9097152 && $file_size1 > 9097152) {
               $errors1[]='404';
            }
             
            if(empty($errors1)==true) {
               
               move_uploaded_file($file_tmp1,"images/".$file_name1);
               echo "Success";
            }else{
               print_r($errors1);
            }
         }
         if($errors[0]=="404"){
            $file_name1 =$_POST['image'];
          
         }
         if($errors1[0]=="404"){
      
            $file_name = $_POST['image2'];
        }
        //   echo $file_name;
        // echo "<br>";
        // echo $file_name1;
        // exit();
        //  if(!isset($_FILES['image_name'])){
        //     $file_name = $_POST['image'];
        //  }
        //  if(!isset($_FILES['image_name1'])){
        //         $file_name1 = $_POST['image2'];
        //  }
        $sql ="UPDATE `san_pham` SET `name`='$namesp',`tien_truoc_khi_giam_gia`='$gia_goc',`tien_sau_khi_giam_gia`='$gia_km',`phan_tram_giam_gia`=' $phan_tram',`image`='$file_name',`create_date`='$create_date',`description`='$mo_ta',`phan_loai`='$phan_loai',`image2`='$file_name1',`so_luong_da_ban`='$soluong' WHERE id = '$idSp'";
         $result = mysqli_query($link, $sql);
        // echo $sql;
        // exit();
        // var_dump($result);
        if($result){?>
            <script>
                alert("Sửa Sản Phẩm sucessfully!");
                window.location.href ="manageSanPham.php"
            </script>
        <?php
        } else { ?>
            <script>
                alert("Sửa Sản Phẩm fail!"); 
            </script>
        <?php }
    }
    ?>

</body>
</html>