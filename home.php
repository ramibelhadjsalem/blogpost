<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    $id= $_SESSION["id"];
    $username=$_SESSION["username"];
    $photoProfile=$_SESSION["photoprofile"];
    if(strlen($photoProfile)<1){
        $photoProfile="./assets/avatar.png";
    }

    require_once "includes/database.php";
    $posts = mysqli_query($link, "SELECT * FROM publication INNER JOIN appuser WHERE publication.id_user = appuser.Id order by date DESC");

   
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        home
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="actions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
   
    
</head>
<body class="forms">

    <script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<nav class="navbar">

        <div class="logo">Blog Now</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="home.php">Home</a></li>
                <li class="services"><a href="http://localhost/server/project/profile.php?id=<?php echo $id ?>">Profile</a></li>
                <li><a href="/">Notification</a></li>
                <li><a href="/">About</a></li>
                <li><a href="chatbox.php">Contact</a></li>
            </div>
        </ul>
        <div class="dropdown">
            <div class="user">
                <img src="<?php echo $photoProfile ?>"alt="avatar">
                <p><?php echo $username ?></p>
            </div>
           
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
                <a href="changePassword.php">change Password</a>
            </div>
        </div>
    </nav>
    <div class="homebody">
        <div class="newpost">
            <form  method="POST" 
              action="uploadimg.php" 
              enctype="multipart/form-data">
            <div class="description">
                <img src="<?php echo $photoProfile ?>"alt="avatar">
                <input type="text" name='description' id="description"  placeholder="whats new <?php echo $username ?> !!">
            </div>
            <div class="photoinput">
                <label for="uploadf"><img src='./assets/galerielogo.webp'> Add Photo ??</label>
                <input type="file" 
                   name="uploadfile" 
                   id="uploadf"
                   value="" />
                <button class="sendlogo" type="submit" name="upload"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg></button>
               
                
            </div>
            </form>
        </div>
        <?php while ($row = mysqli_fetch_array($posts)) {?>
            <div class="newpost mt-5 ">
                <a class="userinfo m-2 text-decoration-none" href='/server/project/profile.php?id=<?php echo $row['Id']?>'>
                    <img class="rounded-circle" src=<?php if(strlen($row['photoprofile'])>1){
                        echo $row["photoprofile"];

                    }else{
                        echo "./assets/avatar.png";
                    } ?> alt="avatar">
                    <p class="ml-4 mt-2 "><?php echo $row['username'] ?></p>
                </a>
               
                <div class="postdescription px-4">
                    <p><?php echo $row['description'] ?></p>
                </div>
                <?php if(strlen($row['photoUrl'])>0) :?>
                
                    <div class="postphoto mb-0 w-100">
                        <img class="w-100" src="<?php echo $row['photoUrl'] ?>" alt="">
                    </div>
                <?php endif ?>
               
                <div class=' align-center text-center action'>
                    
                <div class="btns">     
                    <?php 
                        $results = mysqli_query($link, "SELECT * FROM likes WHERE id_user=".$id." AND id_pub=".$row['id']."");
                        $res=mysqli_num_rows(mysqli_query($link, "SELECT id_pub FROM likes WHERE id_pub=".$row['id'].""));
                        
                        if (mysqli_num_rows($results) >= 1 ): ?>
                            
                            <button 
                                class="unlike text-center"
                                data-id="<?php echo $row['id'] ?>"
                               
                                >       <?php echo $res ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                            </button>
                            <button
                                class="like  d-none text-center"
                                data-id="<?php echo $row['id'] ?>"
                                
                                >   
                                    <?php echo $res-1 ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                       <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                            </button>
                           
                            <?php else: ?>
                                <button
                                    class="like text-center"
                                    data-id="<?php echo $row['id'] ?>"
                                   
                                    >
                                        <?php echo $res ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                    </button>
                                <button 
                                    class="unlike d-none text-center"
                                    data-id="<?php echo $row['id'] ?>"
                                   
                                    >   
                                        <?php echo $res+1 ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                </button>
                                
                            <?php endif ?>

                        </div>
                        <div class="btns">
                            <button
                            data-id="<?php echo $row['id'] ?>"
                            class="commentaire"
                            >Commentaire</button>
                           
                        </div>
                        <div class="btns">
                            <button
                                class="partage"
                                data-id="<?php echo $row['id'] ?>"
                                data-photo="<?php echo $row['photoUrl'] ?>"
                                data-description="<?php echo $row['description'] ?>"
                                > Partager</button></div> 
                            </div>
                        <div  class="commentairepopup d-none">
                               
                                <div class="modalheader ">
                                    <button
                                        class="hidecomments cursor-pointer " 
                                        >Close
                                    </button>
                                </div>
                                <div class="commentbody mt-1">
                                    <?php
                                        $results = mysqli_query($link, "SELECT * FROM comment INNER JOIN appuser WHERE comment.actionnaire_id=appuser.id And comment.pub_id=".$row['id']."");  
                                        while ($res = mysqli_fetch_array($results)) {
                                        ?>
                                            <div class="comment">
                                            <img src="./assets/avatar.png" alt="">
                                                <p><?php echo $res['commentaire']?></p>
                                            </div> 
                                        <?php } ?>
                                </div>                               
                                <div class="formcomment">
                                   
                                        <input  id="commenttext" type="text" name="" id="" placeholder='Ecrire un commentaire'>
                                        <button 
                                            class='sendcomment'
                                            data-id="<?php echo $row['id'] ?>"
                                            class="text-center d-flex justify-content-center"
                                            
                                            >Commenter
                                        </button>
                                   
                               </div>

                            </div>       
                        
                </div>
               
       
                

               
                <?php } ?>
        
        </div>
    <script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
           
			var postid = $(this).data('id');
			
			    $post = $(this);
                $post.addClass('d-none');
				$post.siblings().removeClass('d-none');
			
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
            
			var postid = $(this).data('id');
		    $post = $(this);
            $post.addClass('d-none');
			$post.siblings().removeClass('d-none');

			
		});
		$('.partage').on('click', function(){
            
			var postid = $(this).data('id');
            var photoUrl = $(this).data('photo');
			var description = $(this).data('description');
          
            partagerpub(postid , photoUrl,description)

			
		});
		$('.commentaire').on('click', function(){

            var postid=$(this).data('id');
                $post = $(this);
                $post.attr("disabled", true);
                $post.parent().parent().parent().find('.commentairepopup').removeClass('d-none');
               
                
			
		});
        $('.hidecomments').on('click', function(){
            
			$post=$(this) ;
            $commentbtn=$post.parent().parent().parent().parent().find('.commentaire').attr("disabled", false);
            
            $post.parent().parent().parent().find('.commentairepopup').addClass('d-none');

			
		});
        $('.sendcomment').on('click', function(){
            
			var postid = $(this).data('id');
            $comment=$(this).siblings().val()
          
            $commentList=$(this).parent().parent().find('.commentbody')
           
            addComment(postid,$comment);
           
            $commentList.append(`<div class="comment"><img class="rounded-circle" src="assets/avatar.png"></img><p>${$comment}</p></div>`);
            $comment=$(this).siblings().val("")
          
          

			
		});
		
        
	});
</script>  
</body>

</html>
                    
