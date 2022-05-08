<?php 
  session_start();
  include_once "../includes/database.php";
  if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
  $id=$_SESSION['id'];
  $searchTerm = $_POST['searchTerm'];
  $sql ="SELECT id, username ,photoprofile FROM appuser WHERE NOT id=$id AND username LIKE '%$searchTerm%' ";
  if(strlen($searchTerm)<1){
    $list = "something goes wrong" ;
  }
  else{
    $record=mysqli_query($link, $sql);
    $list = array();
    while($row=mysqli_fetch_array($record)){
            
        $list[] = $row;
    }
  }

  echo json_encode($list);
exit;
 
?>