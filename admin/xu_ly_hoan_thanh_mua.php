<?php
    require('libs/db.php');

    if(isset($_GET["id"])){
        $napID = $_GET['id'];
    }
    // echo $filmID;
    // exit;
    $sql2=" SELECT * FROM `list_giao_dich_mua` WHERE id = $napID";

    $result = $link->query($sql2);
    $r = mysqli_fetch_assoc($result);
    // echo $r['id_user'];
    // exit();
    if ($result->num_rows <= 0) {
        ?>
        <script>
            alert("không tìm thấy giao dịch nạp game với id này");
            location.href = "quanLyNapTien.php";
            // alert("hshshsh");
        </script>
<?php
    }else{
     // cong tien cho user
    //  $tien_nap =  $r['so_tien'];
    //  $id_user = $r['id_user'];
    //     $sql_update="UPDATE `user` SET `so_du` = `so_du` + $tien_nap where id= $id_user ";
    //cap nhat trang thai nap tien
    $sql = "UPDATE `list_giao_dich_mua` SET `trang_thai`= 2 WHERE `id`= $napID ";

    if (mysqli_query($link, $sql)) {?>
        <script>
            alert("Xác nhận nạp game thành công");
            location.href = "ql_nap_game.php";
            // alert("hshshsh");
        </script>

    <?php        
    } else {
        echo "Lỗi xác nhận hoàn thành nạp: " ;
    }
}
    mysqli_close($link);
    
?>