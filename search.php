<?php
include_once("function_999888.php");
if(empty($_POST['kw']))  {
  echo "<script>
  alert('Không Được Để Trống Giá Trị Cần Tìm !!!');
  window.location='index.php';
  </script>";
 
}
if (isset($_POST['kw'])) {
    $kw_input = $_POST['kw'];
    $kw = xuly_input($kw_input);
    $sql = "select * from `san_pham` where `name` like '%$kw%' and `hidden_sp` = 0";
    if(isset($_GET['loai'])){
      $loai = $_GET['loai'];
      $sql = "select * from `san_pham` where `name` like '%$kw%' and `hidden_sp` = 0  and `phan_loai` = '$loai'";
    }
    // echo $sql;
    // exit();
    $query = mysqli_query($link, $sql);
    
    if($query){
      // $r=mysqli_fetch_assoc($query);

  
?>
<style>
    ul.list-film li {
      width: 12%;
    }
    #movie-update .types {
    float: left;
    margin-left: 0px; 
    overflow: hidden;
}
.blocktitle{
  width: 80%;
}
.tab{
  width: 100%;
}

.tab {
    width: 1001px !important;
}
ul.list-film li {
    width: 16% !important;
}
  </style>

  <style>
    #movie-update{
      width: 100vw;
    }
  </style>
<div id="content content_1">
  <div class="block" id="page-list">
    <div class="blocktitle breadcrumbs">
      <div class="item">
        <a href="?mod=home" title="Nạp Game Uy Tính Hàng Đầu Việt Nam!">
          <span>Sản Phẩm</span>
        </a>
      </div>
      <div class="item last-child">
        <span itemprop="title">Kết quả tìm kiếm cho: "<?php echo $kw; ?>"</span>
      </div>
    </div>
      <div class="blockbody" id="list-movie-update">
        <div class="tab toan-bo">
          <ul class="list-film tab toan-bo">
            <?php
              while($r=mysqli_fetch_assoc($query)){
            ?>
           <li data-liked="852" data-views="49,875">
              <div class="inner"><a href="?mod=chitiet&id=<?php echo $r['id'] ?>" title="<?php echo $r['name'] ?>"><img src="admin/images/<?php echo $r['image'] ?>" alt="Nhật Ký Trả Thù 2"></a>
                <div class="info">
                  <div class="name"><a href="?mod=chitiet&id=<?php echo $r['id'] ?>" title="<?php echo $r['name'] ?>"><?php echo $r['name'] ?></a></div>
                  <div class="name2"><?php echo "<del>".$r['tien_truoc_khi_giam_gia']. "VND" ."</del>"."  ".$r['tien_sau_khi_giam_gia']. "VND"; ?></div>
                </div>
                <div class="status"><?php echo $r['phan_tram_giam_gia'] ?></div>
                <div class="day_limit"><?php echo $r['day_giam_gia'] ?></div>
              </div>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
  </div>
</div>
 <?php 
    }else
    echo "Không tìm Thấy";
  }
 ?>