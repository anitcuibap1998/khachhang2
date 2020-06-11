<?php
  require('libs/db.php');
  $mod='';
?>
<head>
  <?php
    include_once("head.php");
  ?>
</head>
<style>
   .wrapper__container{
    padding:30px 15px;
    background-color: rgb(43, 46, 55);
    min-height:400px;
    color:#fff!important
  }
</style>
<body>
  <div id="wrapper">
    <?php
      include("header.php");
    ?>
    <div id="body-wrap" class="container" style="padding:0 0 10px 0">
      <div class="wrapper__container">
      </div>
    </div>
    <?php
      include("footer.php");
    ?>
  </div>
</html>
