 <?php
 include ('includes/database.php');
$uploads_dir = './uploads';
        session_start();
        
        // Check if the user is logged in, if not then redirect him to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login.php");
            exit;
        }

        $description=$_POST["description"] ;
        $param_id = $_SESSION["id"];
     
        $tmp_name = $_FILES["uploadfile"]["tmp_name"];
        // basename() peut empêcher les attaques de système de fichiers;
        // la validation/assainissement supplémentaire du nom de fichier peut être approprié
        $name = basename($_FILES["uploadfile"]["name"]);
        // move_uploaded_file($tmp_name, "$uploads_dir/$name");
     
        if(!strlen($description)<3 || !strlen($name)<1){
           
             if(!empty($_FILES["uploadfile"]["name"])){
                 $allowTypes = array('jpg','png','jpeg','gif','pdf');
                 $targetFilePath = $uploads_dir . $name;
                 $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                 if(in_array($fileType, $allowTypes)){
                     if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
                         $param_photourl="./uploads/".$name;
                     }else{
                         $param_photourl=null;
                     }
                    
                }
             }
             $sql = "INSERT INTO publication (photoUrl, description , id_user) VALUES (?, ?, ?)"; 
             $stmt = mysqli_prepare($link, $sql);
             mysqli_stmt_bind_param($stmt, "sss",$param_photourl,$description,$param_id);

             if(mysqli_stmt_execute($stmt)){
               
                header("location:home.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
            }
            mysqli_close($link);


?> 

