<?php 
session_start();
if(!isset($_SESSION["username"])){
    header("Localtion:login.php");
}
else{
    include_once("libs/db.php");
    $id__ = $_GET["id"];
    $sql= "SELECT * FROM `san_pham` where id = $id__";
    $result = mysqli_query($link, $sql);
    if($result){
        $r = mysqli_fetch_assoc($result);?>
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        body {
            width: 100vh;
            margin: 0 auto;
        }

        .description {
            text-align: center;
            width: 800px;
            background-color: #c3c8c8;
            height: 100vh;
        }
    </style>
    <div class="description">
        <?php print_r($r["description"]); ?>
    </div>
</body>

</html>
        <?php 
       
    }
}
?>