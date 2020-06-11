<?php
    require('libs/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete user</title>

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
        ?>
        <div class="container">
            <div class="row" id="search-user">
                <form method="post">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <input class="form-control form-control-lg form-control-borderless" type="search"
                                placeholder="Search user" name="user">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary" type="submit" name="button_search"
                                style="padding: 8px">Search</button>
                                <button class="btn btn-lg btn-primary" type="button" name="btn_list"
                                style="padding: 8px"><a href="list_chua_active.php" style="color:#fff">List Chưa Active</a></button>
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
                    $sql = "SELECT COUNT(ID) as tong FROM `user`  where `active` = 1 ";
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
                                $name = isset($_POST["user"]) ? $_POST["user"] : '';
                                
                                $sql = "SELECT * FROM user WHERE `username` LIKE '%$name%' and `active` = 1"." order by id  DESC limit $vitri,30";
                                $result = mysqli_query($link, $sql);
                                if (mysqli_num_rows($result) > 0) { ?>
                                                <!-- output data of each row -->
                                                <table class="table" style="margin: 10px 0px">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">User name</th>
                                                        <th scope="col">Fullname</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Số Dư</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Ngày Sinh</th>
                                                        <th scope="col">Giới Tính</th>
                                                        <th scope="col">Active</th>
                                                        <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($row = mysqli_fetch_assoc($result)) {
                                        if ($row["usertype"] == 20){
                                        ?>
                                                        <tr>
                                                        <th> <?php echo $row["ID"] ?> </th>
                                                        <th> <?php echo $row["username"] ?> </th>
                                                        <th> <?php echo $row["fullname"] ?> </th>
                                                        <th> <?php echo $row["email"] ?> </th>
                                                        <th><?php echo $row["so_du"] ?></th>
                                                        <th ><?php echo $row["phone"] ?></th>
                                                        <th ><?php echo $row["birthday"] ?></th>
                                                        <th><?php echo $row["sex"] ?></th>
                                                        <th><?php echo $row["active"] ?></th>
                                                    
                                                            <td>
                                                                <button type="button" class="btn btn-info" name="edit"
                                                                    onclick="edit(this)">Nạp Tiền User</button>
                                                                <button type="button" class="btn btn-danger" name="delete"
                                                                    onclick="del(this)">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                        } 
                                    }
                                } else {
                                    echo "No user like ".$name;
                                }
                            }
                        if(isset($_POST["button_search"])){
                            $name = isset($_POST["user"]) ? $_POST["user"] : '';
                            
                            $sql_name = "SELECT * FROM user WHERE `username` LIKE '%$name%' and `active` = 1";
                            $sql_description = "SELECT * FROM user WHERE email LIKE '%{$name}%' and `active` = 1";
                            $sql = $sql_name. " UNION ". $sql_description ." order by id  DESC limit $vitri,30";
                            $result = mysqli_query($link, $sql);
                            if (mysqli_num_rows($result) > 0) { ?>
                            <!-- output data of each row -->
                            <table class="table" style="margin: 10px 0px">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User name</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số Dư</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Ngày Sinh</th>
                                        <th scope="col">Giới Tính</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)) {
                                    if ($row["usertype"] == 20){
                                    ?>
                                    <tr>
                                                        <th> <?php echo $row["ID"] ?> </th>
                                                        <th> <?php echo $row["username"] ?> </th>
                                                        <th> <?php echo $row["fullname"] ?> </th>
                                                        <th> <?php echo $row["email"] ?> </th>
                                                        <th><?php echo $row["so_du"] ?></th>
                                                        <th ><?php echo $row["phone"] ?></th>
                                                        <th ><?php echo $row["birthday"] ?></th>
                                                        <th><?php echo $row["sex"] ?></th>
                                                        <th><?php echo $row["active"] ?></th>
                                        <td>
                                            <button type="button" class="btn btn-info" name="edit"
                                                onclick="edit(this)">Nạp Tiền User</button>
                                            <button type="button" class="btn btn-danger" name="delete"
                                                onclick="del(this)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php 
                                    } 
                                }
                            } else {
                                echo "No user like ".$name;
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
                        <button type="submit" value=""><a href="manageUser.php?vitri=<?php echo $vitri ?>">trang <?php echo $i; ?></a></button>
                        <?php 
                         }
                        ?>
                    </div>
    </div>
    <script>
    function edit(params) {
        var tr = params.parentElement.parentElement;
        var td0 = tr.cells.item(0).innerHTML;
        td0 = td0.replace(' ', ''); //id của user có space ???
        location.href = "editUser.php?id=" + td0;
    };

    function del(params) {
        if (confirm("Bạn có chắc muốn xóa user này?")) {
            var tr = params.parentElement.parentElement;
            var td0 = tr.cells.item(0).innerHTML;
            td0 = td0.replace(' ', ''); //id của user có space ???
            location.href = "deleteUser.php?id=" + td0;
        }
    };
    </script>
</body>

</html>