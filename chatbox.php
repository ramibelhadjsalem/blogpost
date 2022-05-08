<?php 
  session_start();
  include_once "includes/database.php";
  if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
  $currentusername=$_SESSION["username"] ;
  $currentuserphoto=$_SESSION["photoprofile"] ;
  if(strlen($currentuserphoto)<1){
      $currentuserphoto="./assets/avatar.png";

    }
?>
!
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
<body>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <div class="wrapper">
      <div class="userinfo">
        <div class="info">
                <img src="<?php echo $currentuserphoto ?>" alt="">
                <p><?php echo $currentusername ?> </p>
            </div>
          <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
        </a>
      </div>
      <div class="search">
          <input type="text" class="searchfield" placeholder='Select an user to start chat' >
          
            <button class="deletebtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
            
      </div>
      <div class="list">
       
      </div>
    
  </div>
<script>
    $(document).ready(function(){
            $(".deletebtn").on('click', function(){
                $(".searchfield").val("");
                $('.list').empty();
               
            })
            $(".connection").on('click', function(){
                window.location.replace('chatroom.php?id=7');
               
            })
            
            $( ".searchfield" ).on("change keyup paste",function() {
                $('.list').empty();
                if($(".searchfield").val()==""){
                    $(".deletebtn").css( "opacity",0.5)
                }else{
                    searchTerm=$(".searchfield").val();
                    $(".deletebtn").css( "opacity",1);
                    $.ajax({
                        type: "POST",
                        url: "phpactions/search.php",
                        data: {
                            
                            searchTerm:searchTerm
                            
                        },
                        cache: false,
                        success: function(data) {
                            data =JSON.parse(data);
                            currentuser=<?php echo $_SESSION['id'] ?> ;
                            data.map(x=>{
                                $(".list").append(`<a  href="chatroom.php?id=${x.id}&roomname=abcdefjk&curentuser=${currentuser}" class="connection">
                                        <img src=${x.photoprofile !=null ? x.photoprofile :"assets/avatar.png"}  alt="">
                                        <div class="user">
                                            <p>${x.username}</p>
                                            <p class="message">lastmessage</p>
                                        </div>
                                    </a>`)
                            })
                        
                            
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                }
                
               
            })
    })
</script>
</body>

</html>

