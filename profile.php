<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $currentuser=$_SESSION["id"];
    $currentusername=$_SESSION["username"] ;
    $currentuserphoto=$_SESSION["photoprofile"] ;
    require_once "includes/database.php";
    $id = intval($_GET['id']);
    $result= mysqli_query($link, "SELECT * FROM appuser WHERE id=$id ");
    // $row = mysql_fetch_row($userinfo);
    while($row = mysqli_fetch_assoc($result)) {
        if(strlen($row['photoprofile'])<1){
            $photoUrl='./assets/avatar.png';
        }
        else{
            $photoUrl=$row['photoprofile'];
        }
        $username=$row['username'] ;
        $firstname=$row['firstname'] ;
        $lastename=$row['lastename'] ;
        $number=$row['number'] ;
        $dob=$row['dob'] ;
        $coverphoto=$row['coverphotoUrl'] ;

      }
      $posts = mysqli_query($link, "SELECT * FROM publication INNER JOIN appuser WHERE publication.id_user = appuser.Id AND appuser.Id=$id order by date DESC");
      $photos=mysqli_query($link , "SELECT * FROM img WHERE id_user =$id");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="actions.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile.css?<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<nav class="navbar">
    

        <div class="logo">Blog Now</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="home.php">Home</a></li>
                <li class="services <?php if($currentuser==$id) echo 'active' ?>"><a href="http://localhost/server/project/profile.php?id=<?php echo $currentuser ?>">Profile</a></li>
                <li><a href="/">Notification</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/">Contact</a></li>
            </div>
        </ul>
        <div class="dropdown">
            <div class="user">
                <img src='<?php echo $currentuserphoto ?>' alt="avatar">
                <p><?php echo $currentusername?></p>
            </div>
           
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
                <a href="changePassword.php">change Password</a>
            </div>
        </div>
</nav>
<div class="container1 ">
       <div class="userinfo">
           <div class="photocoverture">
           <?php if($currentuser==$id) :?>
               <div class="addphotocover ">
                   <input class="d-none" type="file" name="photocoverture" id="sortpicture">
                   <label for="sortpicture"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                        </svg>
                    </label>
              
            </div>
            <?php endif ?>
          
               <img class="image2 <?php if(strlen($coverphoto)<1) echo 'd-none'?>" src="<?php echo $coverphoto ?>" alt="">
              
           </div>
           <div class="userdetail">
                <div class="photoprofile">
                    <?php if($currentuser==$id) :?>
                            <div class="addphotoprofile ">
                                <input class="d-none" type="file" name="photocoverture" id="sortpictureprofile">
                                <label for="sortpictureprofile"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                        </svg>
                                </label>
                            
                            </div>
                    <?php endif ?>
                    <img class="img3" src="<?php echo $photoUrl ?>" alt="">
                </div>
                
                <h3><?php echo $username?></h3>
           </div>
           
       </div>
</div>
<div class="profilebody">
    <div class="container2">
        <div class="side-left">
        <?php if($currentuser==$id) :?>
            <div class="updateinfo mb-3">
                <h5 class="title text-center">Changer les information</h3>
                <div class="form-group ">
                    <input type="text" value='<?php echo $username ?>' id='Username' placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="text" value='<?php echo $firstname ?>' id='Firstname'  placeholder="Firstname">
                </div>
                <div class="form-group">
                    <input type="text" value='<?php echo $lastename ?>' id='Lastname'  placeholder="Lastname">
                </div>
                <div class="form-group">
                    <input type="text" value='<?php echo $number ?>' id='number'  placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <input type="date" value='<?php echo $dob ?>' id='dob'  placeholder="Date de naissance">
                </div>
                <div class="form-group">
                    <button class="updateinfos">Changer</button>
                </div>
            </div>
        <?php endif ?>
        <div class="photos mb-3">
            <h4 class="title">Photos</h4>
            <div class="photoconatiner">
                <?php while($res2 =mysqli_fetch_array($photos)) {?>
                    <div class="photo"><img src="<?php echo $res2['imgurl'] ?>" alt=""></div>
                <?php }?>
            </div>
        </div>
        </div>
        <div class="side-right">
            
            <div class="posts ">
            <?php while ($res1 = mysqli_fetch_array($posts)) {?>
            <div class="newpost mb-3 ">
                <div class="userinfo ">
                    <img class="rounded-circle m-2 ml-4" src='<?php echo $photoUrl ?>' alt="avatar">
                    <p class="ml-3 mt-2 "><?php echo $username ?></p>
                </div>
               
                <div class="postdescription px-4">
                    <p><?php echo $res1['description'] ?></p>
                </div>
                <?php if(strlen($res1['photoUrl'])>0) :?>
                
                    <div class="postphoto mb-0 w-100">
                        <img class="w-100" src="<?php echo $res1['photoUrl'] ?>" alt="">
                    </div>
                <?php endif ?>
               
                <div class=' align-center text-center action'>
                    
                <div class="btns">     
                    <?php 
                        $results = mysqli_query($link, "SELECT * FROM likes WHERE id_user=".$currentuser." AND id_pub=".$res1['id']."");
                        $res=mysqli_num_rows(mysqli_query($link, "SELECT id_pub FROM likes WHERE id_pub=".$res1['id'].""));
                        
                        if (mysqli_num_rows($results) >= 1 ): ?>
                            
                            <button 
                                class="unlike text-center"
                                data-id="<?php echo $res1['id'] ?>"
                                onclick="removelike(<?php echo $res1['id'] ?>)"
                                >       <?php echo $res ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                            </button>
                            <button
                                class="like  d-none text-center"
                                data-id="<?php echo $res1['id'] ?>"
                                onclick="addlike(<?php echo $res1['id'] ?>)"
                                >   
                                    <?php echo $res-1 ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                       <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                            </button>
                           
                            <?php else: ?>
                                <button
                                    class="like text-center"
                                    data-id="<?php echo $res1['id'] ?>"
                                    onclick="addlike(<?php echo $res1['id'] ?>)"
                                    >
                                        <?php echo $res ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                    </button>
                                <button 
                                    class="unlike d-none text-center"
                                    data-id="<?php echo $res1['id'] ?>"
                                    onclick="removelike(<?php echo $res1['id'] ?>)"
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
                            data-id="<?php echo $res1['id'] ?>"
                            class="commentaire"
                            >Commentaire</button>
                           
                        </div>
                        <div class="btns">
                            <button
                                class="partage"
                                data-id="<?php echo $res1['id'] ?>"
                                data-photo="<?php echo $res1['photoUrl'] ?>"
                                data-description="<?php echo $res1['description'] ?>"
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
                                        $results = mysqli_query($link, "SELECT * FROM comment INNER JOIN appuser WHERE comment.actionnaire_id=appuser.id And comment.pub_id=".$res1['id']."");  
                                        while ($res = mysqli_fetch_array($results)) {
                                        ?>
                                            <div class="comment">
                                                <?php if(strlen($res['photoprofile'])>1) :?>
                                                        <img  src=<?php echo $res['photoprofile'] ?> alt="">
                                                    
                                                <?php else: ?> 
                                                    <img  src="assets/avatar.png" alt="">
                                                <?php endif ?>
                                           
                                                <p><?php echo $res['commentaire']?></p>
                                            </div> 
                                        <?php } ?>
                                </div>                               
                                <div class="formcomment">
                                   
                                        <input  id="commenttext" type="text" name="" id="" placeholder='Ecrire un commentaire'>
                                        <button 
                                            class='sendcomment'
                                            data-id="<?php echo $res1['id'] ?>"
                                            data-userphoto="<?php echo $photoUrl ?>"
                                            class="text-center d-flex justify-content-center"
                                            
                                            >Commenter
                                        </button>
                                   
                               </div>

                            </div>       
                        
                </div>
               
       
                

               
                <?php } ?>
            </div>
        </div>
    </div>
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
			var userphoto = $(this).data('userphoto');
            $comment=$(this).siblings().val()
          
            $commentList=$(this).parent().parent().find('.commentbody')
           
            addComment(postid,$comment);
           
            $commentList.append(`<div class="comment"><img class="rounded-circle" src="${userphoto}"></img><p>${$comment}</p></div>`);
            $comment=$(this).siblings().val("")
          
          

			
		});
        $( "#sortpicture" ).change(function() {
            var input = $("#sortpicture").val();
            var file_data = $('#sortpicture').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            $.ajax({
                url: './phpactions/addphotocover.php', // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    //data =JSON.parse(data);
                    if(data = "added"){
                        toastr.success("Changed succesffuly");
                        $(".image2").attr("src",`./imgs/${input.split(/[\\/]/).pop()}`);

                    }
                    else{
                        toastr.error("Something went wrong")
                    }
                }
            });
        });
        $( "#sortpictureprofile" ).change(function() {
            var input = $("#sortpictureprofile").val();
            var file_data = $('#sortpictureprofile').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            $.ajax({
                url: './phpactions/addphotocover.php', // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    //data =JSON.parse(data);
                    if(data = "added"){
                        toastr.success("Changed succesffuly");
                        $(".img3").attr("src",`./imgs/${input.split(/[\\/]/).pop()}`);

                    }
                    else{
                        toastr.error("Something went wrong")
                    }
                }
            });
        });
		
        $('.updateinfos').on('click', function(){
            
			var usernameinput=document.getElementById('Username');
			var firstnameinput=document.getElementById('Firstname');
			var lastnameinput=document.getElementById('Lastname');
			var numberinput=document.getElementById('number');
			var dobinput=document.getElementById('dob');
            // console.log(usernameinput.empty)
            if(usernameinput.value==''){
                
                usernameinput.style.borderColor ='red'
                timer = setTimeout(function() {
                    // reset CSS
                    usernameinput.style.borderColor =''
                }, 5000); 
            }
            if(firstnameinput.value==''){
                firstnameinput.style.borderColor ='red'
                timer = setTimeout(function() {
                    // reset CSS
                    firstnameinput.style.borderColor =''
                }, 5000); 
            }
            if(lastnameinput.value==''){
                lastnameinput.style.borderColor ='red'
                timer = setTimeout(function() {
                    // reset CSS
                    lastnameinput.style.borderColor =''
                }, 5000); 
            }
            if(numberinput.value==''){
                numberinput.style.borderColor ='red'
                timer = setTimeout(function() {
                    // reset CSS
                    numberinput.style.borderColor =''
                }, 5000); 
            }
            if(dobinput.value==''){
                dobinput.style.borderColor ='red'
                timer = setTimeout(function() {
                  
                    dobinput.style.borderColor =''
                }, 5000); 
            }
             
			if(!usernameinput.value==''&&!firstnameinput.value==""&&!lastnameinput.value==""&&!numberinput.value==""&&!dobinput.value==""){
                updateinfo(usernameinput.value,firstnameinput.value,lastnameinput.value,numberinput.value,dobinput.value);
          
            }else{
                toastr.error("complete the fields")
            }
		});
	});
</script>
</body>
</html>