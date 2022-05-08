<?php 
session_start();
require_once "../includes/database.php";

$user_id = $_SESSION["id"];  
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$number = $_POST['number'];
$dob = $_POST['dob'];
$msg ="";
if(!$user_id || strlen($username)<1|| strlen($firstname)<1|| strlen($lastname)<1|| strlen($number)<1){
    $msg= "something goes wrong" ;
}else{
    $sql="UPDATE appuser SET username= ?,firstname= ?,lastename= ?,number= ?,dob= ? WHERE Id= ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss",$username,$firstname ,$lastname,$number,$dob,$user_id);
    if(mysqli_stmt_execute($stmt)){
        $msg='updated';
    }else{
        $msg= "something goes wrong" ;
    }
}

echo json_encode($msg);
exit;
 
?>