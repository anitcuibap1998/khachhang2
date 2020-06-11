<?php
    require('libs/db.php');

    if(isset($_GET["id"])){
        $napID = $_GET['id'];
    }
    // echo $filmID;
    // exit;
    $sql2=" SELECT * FROM `list_nap` WHERE id = $napID";

    $result = $link->query($sql2);
    $r = mysqli_fetch_assoc($result);
    // echo $r['id_user'];
    // exit();
    if ($result->num_rows <= 0) {
        ?>
        <script>
            alert("không tìm thấy giao dịch nạp với id này");
            location.href = "quanLyNapTien.php";
            // alert("hshshsh");
        </script>
<?php
    }else{
     // tạo thông báo cho user
        $tien_nap =  $r['so_tien'];
        $id_user = $r['id_user'];
        $ma_giao_dich = $r['code'];
        $sql_update="INSERT INTO `thong_bao`( `id_user`, `note`, `ma_nap_tien`,`so_tien`) VALUES ('$id_user','Bị Hủy !!!Thông tin không chính xác hoặc không đúng!!!','$ma_giao_dich',' $tien_nap')";
        // echo $sql_update;
        // exit();
    //cap nhat trang thai nap tien
    $sql = "UPDATE `list_nap` SET `trang_thai`= 1 WHERE `id`= $napID ";

    if (mysqli_query($link, $sql)&&mysqli_query($link, $sql_update)) {?>
        <script>
            alert("hủy nạp tiền thành công");
            location.href = "quanLyNapTien.php";
            // alert("hshshsh");
        </script>

    <?php        
    } else {
        echo "Lỗi hủy hoàn thành nạp: " . mysqli_error($conn);
    }
}
    mysqli_close($link);
    
?>