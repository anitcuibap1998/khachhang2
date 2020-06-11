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
    <script src="http://localhost/Khachhang_2/admin/ckeditor/ckeditor.js"></script>

</head>

<body>
    <div id="wrapper">
        <?php
            include("common.php");
            $sql = "SELECT * From slider_anh";
            $result_1 = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result_1)) {
                if($row['id']==1){
                    $anh1= $row['name'];}
                if($row['id']==2){
                    $anh2= $row['name'];}
            }
         

        if(isset($_POST['button_post'])){

        error_reporting(0);

        if(isset($_FILES['image_name'])){
            $errors= array();
            $file_name = $_FILES['image_name']['name'];
            $file_size = $_FILES['image_name']['size'];
            $file_tmp = $_FILES['image_name']['tmp_name'];
            $file_type = $_FILES['image_name']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image_name']['name'])));
             
           
             

            $expensions= array("jpeg","jpg","png");
             
            if(in_array($file_ext,$expensions)=== false){
               $errors[]="404";
            }
             
            if($file_size > 20971520 && $file_size1 > 20971520) {
               $errors[]='404';
            }
             
            if(empty($errors)==true) {
               move_uploaded_file($file_tmp,"images/".$file_name);
            //    echo "Success";
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
             
            if(in_array($file_ext1,$expensions)=== false){
               $errors1[]="404";
            }
             
            if($file_size > 20971520 && $file_size1 > 20971520) {
               $errors1[]='404';
            }
             
            if(empty($errors1)==true) {
               move_uploaded_file($file_tmp1,"images/".$file_name1);
            //    echo "Success";
            }else{
               print_r($errors1);
            } 
        }
        if($errors[0]=="404"){
            $file_name =$_POST['image'];
          
         }
         if($errors1[0]=="404"){
      
            $file_name1 = $_POST['image2'];
        }
            $sql1= "UPDATE slider_anh Set name = '$file_name' where id = 1";
            $sql2 = "UPDATE slider_anh Set name = '$file_name1' where id = 2";
            
            $kq1 = mysqli_query($link, $sql1);
            $kq2 = mysqli_query($link, $sql2);
            if($kq1 && $kq2){
                echo '<script>
                alert("Sửa Thành Công!!!");
                </script>';
            }
        
        }
        ?>
        <div class="container" style="width: 800px; margin-left:200px;">
            <h2>Thay Đổi Ảnh Slider</h2>

            <form method="post" id="form-insert-film" name="form-insert-film" class="form-horizontal" action="" role="form" enctype="multipart/form-data">
                    
                <div>
                        <label for="image" class="col-md-2">
                        Hình ảnh 1: 
                        </label>
                        <div class="col-md-9">
                            
                            <input type="file" name="image_name" id="image_name" onchange="alertName()"/>
                            <input style="color:#000" type="text" class="form-control" id="image_link" name="image" value="<?php echo $anh1 ?>">
                           
                            <p class="help-block">
                                Ví dụ: /images/anh_nay_ngoai_trang_chu.jpg
                            </p>
                            <script>
                                function alertName() {
                                    var name =  document.getElementById("image_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("image_link").value = result;
                                }
                            </script>
                        </div>
                    </div>
                    <div>
                        <label for="image" class="col-md-2">
                        Hình ảnh 2: 
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="image_name1" id="image_name1" onchange="alertName1()"/>
                            <input style="color:#000"  type="text" class="form-control" id="image_link1" name="image2" value="<?php echo $anh2 ?>">
                            <p class="help-block">
                                Ví dụ: /images/anh_san_pham.jpg
                            </p>
                            <script>
                                function alertName1() {
                                    var name =  document.getElementById("image_name1").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("image_link1").value =   result;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <!-- <input class="btn btn-primary" type="submit" value="Post"> -->
                            <button type="submit" class="btn btn-primary" id="button_post" name="button_post">Cập Nhật Ảnh Slider</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script>
    function edit(params) {
        var tr = params.parentElement.parentElement;
        var td0 = tr.cells.item(0).innerHTML;
        td0 = td0.replace(' ', ''); //id của user có space ???
        location.href = "editSanPham.php?id=" + td0;
    };

    function del(params) {
        if (confirm("Bạn có chắc muốn ẩn sản phẩm này?")) {
            var tr = params.parentElement.parentElement;
            var td0 = tr.cells.item(0).innerHTML;
            td0 = td0.replace(' ', ''); //id của user có space ???
            location.href = "anSanPham.php?id=" + td0;
        }
    };

    function hien__mota() {
        this.hidden = false;
    }
    </script>
</body>

</html>