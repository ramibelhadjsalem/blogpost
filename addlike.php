<?php 
session_start();
require_once "includes/database.php";

$user_id = $_SESSION["id"];  
$pub_id = $_POST['postid'];
$msg ="";
if(!$user_id || !$pub_id){
    $msg= "something goes wrong1" ;
}else{
    if(mysqli_query($link, "INSERT INTO likes (id_user,id_pub) VALUES ($user_id, $pub_id)")) {
        $msg="liked succesffuly" ;
    }else{
        $msg= "something goes wrong" ;
    }   
}

echo json_encode($msg);
exit;
 
?>