<?php 
session_start();
// require_once "includes/database.php";

$user_id = $_SESSION["id"]; 
// $imgUrl=$_SESSION["imgUrl"]; 
$msg ="";

if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    if(move_uploaded_file($_FILES['file']['tmp_name'], '../imgs/' . $_FILES['file']['name'])){
        require_once "../includes/database.php";
        $name = basename($_FILES["file"]["name"]);
        $newUrl='./imgs/'.$name;
        $msg=$newUrl  ;
        $sql="UPDATE appuser SET coverphotoUrl= ? WHERE Id= ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss",$newUrl,$user_id);

        if(mysqli_stmt_execute($stmt)){
               $sql2="INSERT INTO img (id_user,imgurl) VALUES ( ? ,  ?)";
               $stmt2 = mysqli_prepare($link, $sql2);
               mysqli_stmt_bind_param($stmt2, "ss",$user_id,$newUrl);
               if(mysqli_stmt_execute($stmt2)){
                   $msg="added";
               }else{
                    $msg="Something went wrong." ;
               }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
       
    }else{
        $msg=' not moved';
    }
    
}


echo json_encode($msg);
exit;
 
?>