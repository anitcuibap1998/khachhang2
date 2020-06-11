<?php
    require('libs/db.php');

    if(isset($_GET["id"])){
        $spID = $_GET['id'];
    }
    // echo $filmID;
    // exit;
    $sql2=" SELECT * FROM `san_pham` WHERE id = $spID";

    $result = $link->query($sql2);

    if ($result->num_rows <= 0) {
        ?>
        <script>
            alert("id sản phẩm không tồn tại");
            location.href = "manageSanPhamAn.php";
            // alert("hshshsh");
        </script>
<?php
    }else{

    
    $sql = "UPDATE san_pham SET `hidden_sp`= 0 WHERE `id`= $spID ";

    if (mysqli_query($link, $sql)) {?>
        <script>
            alert("Hiện Sản Phẩm thành công");
            location.href = "manageSanPhamAn.php";
            // alert("hshshsh");
        </script>

    <?php        
    } else {
        echo "Lỗi Hiện sản phẩm: " . mysqli_error($conn);
    }
}
    mysqli_close($link);
    
?>