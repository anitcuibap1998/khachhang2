<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Index</title>
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet">
<link href="css/owl.theme.default.min.css" type="text/css" rel="stylesheet">
<link href="css/style.min.css" type="text/css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
    integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/brands.min.css"
    integrity="sha256-wfbbsQFYKnizQi/WLPXS3wVDu0Dpi2yUQpZBDsb2H1s=" crossorigin="anonymous" /> 
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
<?php
    if (isset($_GET['mod'])) {
      $mod=$_GET['mod'];
    }
    if($mod==''){
      $mod='home';
    }
    elseif($mod=='list') {
      echo '<link href="css/style_listfilm.css" type="text/css" rel="stylesheet">';
    }
    elseif($mod=='detail'){
      echo '<link href="css/style-detail.css" type="text/css" rel="stylesheet">';
    }
    elseif ($mod=='watch'){
      echo '<link rel="stylesheet" type="text/css" media="screen" href="css/style_watch.css" />';
      echo '<script src="js/watch.js"></script>';
      echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">';
      echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
      echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>';
    }
  ?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/owl.carousel.js" type="text/javascript"></script>
<script src="js/jwplayer.js"></script>