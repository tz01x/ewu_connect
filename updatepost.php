<?php 
require_once("helper.php");
session_start();
LoginCheck();
$post_id="";
$mypost_info=[];
if(isset($_GET['p'])){
 $post_id=$_GET['p'];   
}
$mypost_info=fetch_data("SELECT post.id as pid,post.title as post_title,text,link,post.user_id as post_uid,community_name,post.public as post_public, community.public as community_public from post join community on post.community_id=community.id where post.id=$post_id and post.user_id=".$_SESSION['uid']);
if(count($mypost_info)!=1){
    $get_host=getHost();
    echo "<h1>This is not you post</h1>
    <script>
        setInterval(() => {
            window.location.assign('$get_host');
        }, 1000);
    </script>
    ";
    return ;
}

?>



<?php 
// submit new post 
if (isset($_POST['submit'])) {
    $community_id=$_POST['community_id'];
    $title=$_POST['title'];
    $text=$_POST['text'];
    $link=$_POST['link'];
    // $pfiles=$_FILES['pfiles'];
    // print_r($pfiles);
   
    // $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uid=$_SESSION['uid'];

    $res=insert_data("update  post set title='$title',text='$text' link=$link where user_id=$uid and id=".$mypost_info[0]['pid']);

    if(!$res['status'] ){
        
        $url=getHost().'./updatepost.php/?p='.$mypost_info[0]['pid'];
        echo "<h1>Enter valid Information !</h1>
        <script>
            setInterval(() => {
                window.location.assign('$url');
            }, 1000);
        </script>
        ";
    }
    // if( count($pfiles['name'])!=0){
    //     $post_id=$res['id'];
       
    //     for($i=0;$i<count($pfiles['name']);$i++)
    //     {
    //         $target_file=$pfiles['tmp_name'][$i];
    //         $file_type = $pfiles['type'][$i];
    //         // echo $file_type;
    //         // Allow certain file formats
    //         if($file_type != "image/jpg" 
    //         && $file_type != "image/png" 
    //         && $file_type != "image/jpeg" 
    //         && $file_type != "image/gif" 
    //         && $file_type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" 
    //         && $file_type != "application/pdf") 
    //         {
    //             echo "<h1>Sorry, only DOX,PDF,JPG, JPEG, PNG & GIF files are allowed.</h1>";
    //             echo "<div><p>You are uploading <strong>$file_type </strong>file</p></div>";

    //         }
    //         else{
    //             $file_name=$pfiles['name'][$i];
    //             $file_url='./media/'.$file_name;
    //             move_uploaded_file($target_file,$file_url);
                
        
    //             $res=insert_data("INSERT into `file` (file_type,file_name,url,post_id) values('$file_type','$file_name','$file_url',$post_id)");
    //             if($res['status']){
                   
    //                 // file upload succesfully 
                 
    //                 //do someting 
    //             }
    //             else{
        
    //                 echo ' !opps someting gone wrong.';
    //                 break;
    //             }
    //         }
    //     }


    // }//end of file upload  

    
    
    redirect(getHost()."/profile.php");

}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Create Post</title>
  </head>
  <body>
    <?php require_once("./component/nav.php")?>

    <div class="container">
        <div class="display-6">
        Create post here
        </div>
        <div class="card">
        <div class="card-body">
        <form action="" method="post" class="needs-validation"  novalidate   enctype="multipart/form-data">
            <!-- select community -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="comm" class="form-label">Community </label>
                    <select class="form-select" id="comm" name="community_id" aria-label="Default select example" disabled >
                    
                    <?php 
                   
                        echo "<option selected value=''>".$mypost_info[0]['community_name']."</option>";
                       
                    ?>
                    </select>
                </div>
            </div>

            <!-- end select community -->
            <div class="mb-3">
            <label for="posttitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="posttitle" value="<?=$mypost_info[0]['post_title']?>" name="title"placeholder="" required>
            <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Text</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3"><?=$mypost_info[0]['text']?></textarea>
            <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <!-- <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Upload files</label>
            <input class="form-control" type="file" name="pfiles[]" id="formFileMultiple" multiple>
            </div> -->

            <div class="mb-3">
            <label for="link" class="form-label">URL</label>
            <input class="form-control" type="url" name="link" id="link" >
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>


        </div>
        </div>
    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>
