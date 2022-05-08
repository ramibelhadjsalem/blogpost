<?php
    session_start();
    include_once "includes/database.php";
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $id = intval($_GET['id']);
    $sql = mysqli_query($link, "SELECT * FROM appuser WHERE id =$id");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $username=$row['username'];
        $photoprofile=$row['photoprofile'];
        if(strlen($photoprofile)<1){
            $photoprofile="./assets/avatar.png";
      
          }
    }else{
      header("location: chatbox.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="chatbox.css?<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <div class="wrapper2">
        <header>
            <a href="chatbox.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
            <img src="<?php echo $photoprofile ?>" alt="userphoto">
            <a href="profile.php?id=<?php echo $id ?>"><?php echo $username ?></a>
        </header>
        <div class="chat-box" id="list">
    </div>
        <div class="chatinput">
            <input type="text" name=""  placeholder="Type a message here..." id="messageinput">
            <button id="btn" >Send</button>
        </div>
    </div>
    <script>
     $(document).ready(function(){
        $( "#messageinput" ).on("change keyup paste",function() {
            console.log($("#messageinput").val())
            if($("#messageinput").val()==""){
                    $("#btn").css( "opacity",0.5)
                    $("#btn").css( "pointer-events","none")
            }else{
                $("#btn").css( "opacity",1)
                $("#btn").css( "pointer-events","all")
            }
        })
        $("#btn").on('click', function(){
                if( $("#messageinput").val()!=""){
                    $("#list").append(`<div class="chat incoming"><p>${ $("#messageinput").val()}</p></div>`)
                }
               
                $("#messageinput").val("");
                $("#btn").css( "opacity",0.5)
                // $("#list").scrollTop = $("#list").scrollHeight;
                var objDiv = document.getElementById("list");
                objDiv.scrollTop = objDiv.scrollHeight;
            })
      
     })
</script>



</body>

</html>