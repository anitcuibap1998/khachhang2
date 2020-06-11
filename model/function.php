<?php
    function getAllTbale ($link,$nameTbl){
        $sql="SELECT * FROM `$nameTbl`";
        $result=mysqli_query($link,$sql);
        if($row=mysqli_fetch_assoc($result)>0){
            return $row;
        }else{
            return false;
        }
    }
?>