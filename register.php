<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
</head>

<script>
        function nextelem(){
            console.log("next working") ;
            document.getElementById("form").style.transform = "translateX("540px")"; 
            
        }
        // function  prevelem(){
        //     console.log("next working") ;
        //     document.getElementById("form").style.transform = "translateX(-540px)"; 
            
        // }
    </script>
<body class="forms">
    <form action="regsiterform.php"  method="POST" class="registerform" id="form">
        <div class="register-group">
            <h3 class='text-uppercase text-center'>Register</h3>
            <div class="form-group">
                <input class="input-filed" type="text" name="email" id="email" required  placeholder='email'>
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            
            <button onclick='nextelem()' >next</button>
            <button onclick='prevelem()' >prev</button>
        </div>
        <div class="register-group">
            <h3 class='text-uppercase text-center'>Register2</h3>
            <div class="form-group">
                <input class="input-filed" type="text" name="email" id="email" required  placeholder='email'>
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            <button onclick='next-elem()' >next2</button>
            <button onclick='prev-elem()' >prev2</button>
           
        </div>
        <div class="register-group">
            <h3 class='text-uppercase text-center'>Register3</h3>
            <div class="form-group">
                <input class="input-filed" type="text" name="email" id="email" required  placeholder='email'>
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            <div class="form-group">
                <input  class="input-filed" type="password" name="password" id="password" required placeholder="password">
            </div>
            <button onclick='next-elem()' >next3</button>
            <button onclick='prev-elem()' >prev3</button>
            
        </div>
      

    </form>
   
</body>
</html>