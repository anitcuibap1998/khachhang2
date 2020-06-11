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
<div id="content" class="container_1">
  <style>
    #movie-update{
      width: 100vw;
    }
  </style>
  <div class="block" id="movie-update">
    <div class="blocktitle">
      
      <h3 class="title"><i class="fas fa-store" style="margin-right: 3px;color:#ff0000;"></i>Store Việt Nam</h3>
      <div class="types" data-target="#list-movie-update">
        <div class="type"><a data-name="toan-bo" class="btn active">Sản Phẩm Hot</a></div>
        <div class="type"><a data-name="sp-le" class="btn" href="javascript:void();" title="sp lẻ">Sản Phẩm Nổi Bật</a></div>
        <div class="type"><a data-name="sp-bo" class="btn" href="javascript:void();" title="sp bộ">Đang Giảm Giá</a></div>
        <div class="type"><a data-name="sp-bo1" class="btn" href="danhsach.php?loai=Gói%20nạp%20Steam" title="sp bộ">Gói Nạp Steam</a></div>
        <div class="type"><a data-name="sp-bo2" class="btn" href="danhsach.php?loai=Nạp%20Game%20Mobile" title="sp bộ">Gói Nạp Game</a></div>
      </div>
    </div>
    <div class="blockbody" id="list-movie-update">
      <div class="tab toan-bo ">
        <ul class="list-film">
          <?php
            $sql = 'select * from `san_pham` where `hidden_sp` = 0 order by  `name` DESC   limit 24';
            $query = mysqli_query($link, $sql);
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
      <div class="tab sp-le hide">
        <ul class="list-film tab sp-le">
          <?php
            $sql = 'select * from `san_pham` where `hidden_sp` = 0 order by `phan_tram_giam_gia` ASC ,  `name` DESC  limit 24';
            $query = mysqli_query($link, $sql);
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
      <div class="tab sp-bo hide">
        <ul class="list-film">
          <?php
            $sql = 'select * from `san_pham`  where `hidden_sp` = 0 order by `so_luong_da_ban` ASC , `name` DESC limit 24';
            $query = mysqli_query($link, $sql);
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
    <script type="text/javascript">
      $('a[data-name="toan-bo"]').click(function(){
        $('a[data-name="toan-bo"]').addClass('active');
        $('a[data-name="sp-le"]').removeClass('active');
        $('a[data-name="sp-bo"]').removeClass('active');
        $('div.toan-bo').removeClass('hide');
        $('div.sp-le').addClass('hide');
        $('div.sp-bo').addClass('hide');
        $('div.toan-bo > ul.list-film').addClass('tab', 'toan-bo');
        $('div.sp-le > ul.list-film').removeClass('tab','sp-le');
        $('div.sp-bo > ul.list-film').removeClass('tab','sp-bo');
      });
      $('a[data-name="sp-le"]').click(function(){
        $('a[data-name="sp-le"]').addClass('active');
        $('a[data-name="toan-bo"]').removeClass('active');
        $('a[data-name="sp-bo"]').removeClass('active');
        $('div.sp-le').removeClass('hide');
        $('div.toan-bo').addClass('hide');
        $('div.sp-bo').addClass('hide');
        $('div.sp-le > ul.list-film').addClass('tab', 'sp-le');
        $('div.toan-bo > ul.list-film').removeClass('tab','toan-bo');
        $('div.sp-bo > ul.list-film').removeClass('tab','sp-bo');
      });
      $('a[data-name="sp-bo"]').click(function(){
        $('a[data-name="sp-bo"]').addClass('active');
        $('a[data-name="sp-le"]').removeClass('active');
        $('a[data-name="toan-bo"]').removeClass('active');
        $('div.sp-bo').removeClass('hide');
        $('div.toan-bo').addClass('hide');
        $('div.sp-le').addClass('hide');
        $('div.sp-bo > ul.list-film').addClass('tab', 'sp-bo');
        $('div.toan-bo > ul.list-film').removeClass('tab','toan-bo');
        $('div.sp-le > ul.list-film').removeClass('tab','sp-le');
      });
    </script>
  </div>
</div>
