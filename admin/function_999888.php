<?php 
function xuly_input($input){
    $hander=htmlspecialchars (trim($input));
    $hander = strip_tags($hander);
    // echo $hander;
    // echo "<br>";
    $hander = addslashes($hander);
    // echo $hander;
    // exit();
    return $hander;
    }
function mahoaMD5($string){
    $hash =md5(md5($string."@@AA"));
    return $hash;
}    
?>