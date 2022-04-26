<?php 
session_start();
require_once "../includes/database.php";

$user_id = $_SESSION["id"];  
$postid = $_POST['postid'];
$comment = $_POST['comment'];
$msg ="";
if(!$user_id || !$postid || strlen($comment)<1){
    $msg= "something goes wrong1" ;
}else{
    if(mysqli_query($link, "INSERT INTO comment (commentaire,actionnaire_id,pub_id) VALUES ('$comment',$user_id,$postid)")) {
        $msg="commented succesffuly" ;
    }else{
        $msg= "something goes wrong" ;
    }   
}

echo json_encode($msg);
exit;
 
?>