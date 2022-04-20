<?php
	include ('includes/database.php');
    
							$email=$_POST['email'];
							$password=$_POST['password'];
                            if(isset($_POST['email'])){
                                $sql ="SELECT * FROM appuser WHERE username = '$email' and password='$password'";
                                $result=$conn->exec($sql);
                                echo $result;
                            };















                        //     if($email!='' & $password=''){

                        //         $sql ="SELECT * FROM appuser WHERE username = '$email' and password='$password'";
                        //         $result=$conn->exec($sql);
                                
                        //         if ($result == 0) 
                        //         {
                                    
                        //             echo "<script>alert('Please check your username and password!'); window.location='login.php'</script>";
                        //         } 
                        //         else 
						// 		{
                        //             // session_start();
                        //             // $_SESSION['id'] = $row['user_id'];
                        //             header("location:home.php");
						// 		}
                        //     }else{
                        //         echo "<script>alert('Please check your username and password!'); window.location='login.php'</script>";
                        //     }
										
						

                        // echo "jawek behy";
        // try{

        //     $sql ="SELECT * FROM user WHERE username = '$email' and password='$password'";
        //     $result=$conn->exec($sql);
        //     echo "result".$result;
        // }catch(err){
        //     echo "error ".err ; 
        // };
    
?>