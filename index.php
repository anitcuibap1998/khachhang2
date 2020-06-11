<?php
  require('libs/db.php');
  session_start();
  error_reporting(E_ALL);
  $mod='';
?>
<!DOCTYPE html>
<!-- saved from url=(0018)javascript:void(); -->
<html lang="vi" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
  <?php
    include_once("head.php");
  ?>
</head>
<style type="text/css" media="screen">
    .owl-theme .owl-controls .owl-page {
      display: inline-block;
    }
    .owl-theme .owl-controls .owl-page span {
      background: none repeat scroll 0 0 #869791;
      border-radius: 20px;
      display: block;
      height: 12px;
      margin: 5px 7px;
      opacity: 0.5;
      width: 12px;
    }
</style>
<style media="screen" type="text/css">
  .owl-theme .owl-controls .owl-page {
    display: inline-block;
  }
  .owl-theme .owl-controls .owl-page span {
    background: none repeat scroll 0 0 #869791;
    border-radius: 20px;
    display: block;
    height: 12px;
    margin: 5px 7px;
    opacity: 0.5;
    width: 12px;
  }

  .owl-theme .owl-controls .active span {
    background-color: white !important;
  }

  .owl-theme .owl-pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
</style>
<body>
  <div id="wrapper">
    <?php
      include("header.php");
    ?>
    <div id="body-wrap" class="container">
      <?php
        include("sp-hot.php");
      ?>
      <?php
       if (isset($_GET['mod'])) {
        $mod=$_GET['mod'];
      }
      if($mod=='')$mod='home';
      $mod=str_replace('../','',$mod);
      if(is_file("{$mod}.php"))
        include("{$mod}.php");
      else
       echo "Không tìm thấy 404";
        // include("sidebar.php");
      ?>
    </div>
    <?php
      include("footer.php");
    ?>
  </div>
</html>
