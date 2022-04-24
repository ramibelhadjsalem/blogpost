<?php
	include ('includes/database.php');
	
 
// Define variables and initialize with empty values
$email=$FirstName=$LastName=$number=$username = $password = $confirm_password =$DOB= "";
$email_err=$FirstName_err=$LastName_err=$number_err=$username_err = $password_err = $confirm_password_err = $DOB_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
		echo'done';
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM appuser WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_eamil);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
            
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["password2"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["password2"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	  // Validate FirstName
	  if(empty(trim($_POST["username"]))){
        $$username_err = "Please enter a usernmae.";     
    } elseif(strlen(trim($_POST["username"])) < 3){
        $$username_err = "username must have atleast 3 characters.";
    } else{
        $username = trim($_POST["username"]);
    }
	  if(empty(trim($_POST["FirstName"]))){
        $$FirstName_err = "Please enter a FirstName.";     
    } elseif(strlen(trim($_POST["FirstName"])) < 6){
        $$FirstName_err = "FirstName must have atleast 6 characters.";
    } else{
        $FirstName = trim($_POST["FirstName"]);
    }
    
	  // Validate LastName
	  if(empty(trim($_POST["LastName"]))){
        $LastName_err = "Please enter a LastName.";     
    } elseif(strlen(trim($_POST["LastName"])) < 6){
        $LastName_err = "LastName must have atleast 6 characters.";
    } else{
        $LastName = trim($_POST["LastName"]);
    }
    
	  // Validate number
	  if(empty(trim($_POST["number"]))){
        $number_err = "Please enter a number.";     
    } elseif(strlen(trim($_POST["number"])) < 6){
        $number_err = "number must have atleast 6 characters.";
    } else{
        $number = trim($_POST["number"]);
    }
	  // Validate dob
	  if(empty(trim($_POST["DOB"]))){
        $DOB_err = "Please enter a date of birth.";     
      }else{
        $DOB = trim($_POST["number"]);
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($username_err)&& empty($confirm_password_err)&& empty($number_err)&& empty($LastName_err)&& empty($FirstName_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO appuser (email, password , firstname , lastename ,number, dob,username) VALUES (?, ?, ? ,? , ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_email, $param_password,$param_FirstName,$param_lastName,$param_number,$param_number,$param_username);
            
            // Set parameters
            $param_email = $email;
            $param_password = $password;
            $param_number=$number;
            $param_FirstName=$FirstName;
            $param_lastName=$LastName;
            $param_DOB=$DOB;
            $param_username=$username;
            //  password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>


<body class="forms">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="registerform" id="form">
          <div class="register-group">
            <h3 class='text-uppercase text-center'>Register</h3>
                <div class="form-group">
                    <input 
                            class="input-filed form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" 
                            type="text" name="email" id="email" 
                            value ="<?php echo $email; ?>" 
                            placeholder='email'

                    >
                    <span class="invalid-feedback text-center"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" 
                        type="password" name="password" id="password"
                        value ="<?php echo $password; ?>" 
                        placeholder='password'
                    >
                    <span class="invalid-feedback text-center"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" 
                        type="password" name="password2" id="password2" 
                        placeholder='Confirm password'>
                       
                    
                    <span class="invalid-feedback text-center"><?php echo $confirm_password_err; ?></span>
                    
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        type="text" name="username" id="username"
                        value ="<?php echo $username; ?>"  
                        placeholder='userName'
                    >
                    <span class="invalid-feedback text-center"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($FirstName_err)) ? 'is-invalid' : ''; ?>"
                        type="text" name="FirstName" id="FirstName"
                        value ="<?php echo $FirstName; ?>"  
                        placeholder='FirstName'
                    >
                    <span class="invalid-feedback text-center"><?php echo $FirstName_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($LastName_err)) ? 'is-invalid' : ''; ?>" 
                        type="text" name="LastName" id="LastName"
                        value ="<?php echo $LastName; ?>" 
                        placeholder='LastName'
                    >
                    <span class="invalid-feedback text-center"><?php echo $LastName_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($number_err)) ? 'is-invalid' : ''; ?>" 
                        type='text' name="number" id="number"
                        value ="<?php echo $number; ?>" 
                        placeholder='Phone Number'
                    >
                    <span class="invalid-feedback text-center"><?php echo $number_err; ?></span>
                </div>
                <div class="form-group">
                    <input 
                        class="input-filed form-control <?php echo (!empty($DOB_err)) ? 'is-invalid' : ''; ?>" 
                        type='date' name="DOB" id="DOB"  
                        placeholder='Date Of birth'
                        
                        >
                        <span class="invalid-feedback text-center"><?php echo $DOB_err; ?></span>
                    </div>
                <div >
                     <input type="submit" class="register-btn text-center" value="register">
                </div>
               
          </div>
    </form>
    
</body>
</html>
