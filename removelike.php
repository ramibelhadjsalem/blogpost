<?php 
session_start();
require_once "includes/database.php";

$user_id = $_SESSION["id"]; 
$pub_id = $_POST['postid'];
$msg ="";
if(!$user_id || !$pub_id){
    $msg= "something goes wrong" ;
}else{
    if(mysqli_query($link,"DELETE FROM likes WHERE id_pub=$pub_id AND id_user=$user_id")) {
        $msg="Unliked succesffuly" ;
    }else{
        $msg= "something goes wrong" ;
    }   
}

echo json_encode($msg);
exit;
 
?>