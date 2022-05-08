<?php
    session_start();
    require_once "../includes/database.php";

    $user_id = $_SESSION["id"];  
    $sql ="SELECT * FROM appuser";
    // $record=mysql_query($link,"SELECT * FROM appuser");
    $record=mysqli_query($link, "SELECT * FROM appuser");
        $list = array();
        while($row=mysqli_fetch_array($record)){
            
            $list[] = $row;
        }

        echo json_encode($list);
        exit;
         
        ?>