<?php 
session_start();
require_once "includes/database.php";

$user_id = $_SESSION["id"]; 
$imgUrl=$_SESSION["imgUrl"]; 
$msg ="";
if(!$user_id || !$imgUrl){
    $msg= "something goes wrong1" ;
}else{
    if(mysqli_query($link, "UPDATE appuser SET coverphotoUrl=$newUrl WHERE Id=$user_id")) {
        $msg="added succesffuly" ;
    }else{
        $msg= "something goes wrong" ;
    }   
}

echo json_encode($msg);
exit;
 
?>