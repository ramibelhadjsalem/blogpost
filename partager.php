<?php 
    session_start();
    require_once "includes/database.php";
    $user_id = $_SESSION["id"];  
    $pub_id = $_POST['postid'];
    $pub_description = $_POST['description'];
    $photoUrl = $_POST['photoUrl'];
    if(strlen($photoUrl)<1){
        $photoUrl ="";
    }
    if(strlen($pub_description)<1){
        $pub_description ="";
    }
    $msg ="";

    if(!$user_id || !$pub_id){
        $msg= "something goes wrong1" ;
    }else{
        
        $count=mysqli_query($link, "SELECT id FROM publication WHERE id_user=$user_id AND id=$pub_id");
        if(mysqli_num_rows($count) >0 ){
            $msg = "Ouwn Post";

        }else{
            $sql = "INSERT INTO publication ( photoUrl ,description , id_user,date) VALUES (?, ?, ? ,?)";
            $stmt = mysqli_prepare($link, $sql);
            $time=time();
            mysqli_stmt_bind_param($stmt, "ssss", $photoUrl,$pub_description,$user_id,$time);
            if(mysqli_stmt_execute($stmt))
            {
                $msg="partaged" ;
            }else{
                $msg="something goes wrong";
            }
        }
    }
    echo json_encode($msg);
exit;
 
?>