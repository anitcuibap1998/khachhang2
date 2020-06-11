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
            <th>Id</th>
            <th>Id_list_giao_dich_mua</th>
            <th>ten_product</th>
            <th>image_product</th>
            <th>soluong</th>
            <th>gia</th>
            <th>username</th>
            <th>password</th>
            <th>thong_tin_them</th>
            <th>phan_tram_giam_gia</th>
            <th>idDangNhap</th>
            <th>sdt</th>
            <th>cachdangnhap</th>
            <th>hdh</th>
            <th>maychu</th>
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
            <td><?php echo $r['image_product'] ;?></td>
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