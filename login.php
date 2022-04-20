<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="forms">
    <div class="loginform" >
            <h3 class='text-uppercase text-center'> login</h3>
            <form action="loginForm.php" method="POST"  >
                <div class="form-group">
                    <input type="text" name="email" id="email" required  placeholder='email'>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" required placeholder="password">
                </div>
                <input type='submit' class="login-btn text-center">

            </form>
       
    </div>
</body>
</html>