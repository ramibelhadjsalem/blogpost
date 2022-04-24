<?php
 
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data


require_once "../includes/database.php";
mysqli_query($link, "INSERT INTO likes (id_user,id_pub) VALUES (7, 6)");;



$data['name'] = $_POST['firstName'] . " " . $_POST['lastName'];
$data['email'] = $_POST['email'];

 
echo json_encode($data);
exit;
 
?>