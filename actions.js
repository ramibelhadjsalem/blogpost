function addlike(postid){
    $.ajax({
        type: "POST",
        url: "addlike.php",
        data: {
            postid:postid
        },
        cache: false,
        success: function(data) {
            data =JSON.parse(data);
           if(data==="liked succesffuly"){
            toastr.success(data);
           }
           else{
            toastr.error(data);
           }
           return data
            
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });


}
function removelike(postid){
    $.ajax({
        type: "POST",
        url: "removelike.php",
        data: {
            
            postid:postid
        },
        cache: false,
        success: function(data) {
            data =JSON.parse(data);
            if(data=="Unliked succesffuly"){
                toastr.success(data);
            }
            else{
                toastr.error(data);
               }
            return data ; 
        
            
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
}
function partagerpub(postid ,photoUrl,description){
        
        if(!postid){
            toastr.error("somthing was wrong") ;
            return ;
        }
        if(!photoUrl || photoUrl.length === 0 ){
            photoUrl="";
        }
        if(!description || description.length === 0){
            description=null;
        }
        
       
        $.ajax({
            type: "POST",
            url: "partager.php",
            data: {
                
                postid:postid,
                photoUrl:photoUrl,
                description:description,
                
            },
            cache: false,
            success: function(data) {
                console.log(data)
                data =JSON.parse(data);
                if(data =="partaged"){
                    toastr.success(data);
                }
                else{
                    toastr.error(data);
                   }
                return data ; 
            
                
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });

}