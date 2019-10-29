<?php

include "includer.php";

if(isset($_POST["form"])){
    $file_error = "";
    switch($_COOKIE['security_level']){
        case "0" : 
            move_uploaded_file($_FILES["file"]["tmp_name"], "media/img/" . $_FILES["file"]["name"]);
            break;
        
        case "1" :
            $file_error = file_upload_check_1($_FILES["file"]);
            if(!$file_error){
                move_uploaded_file($_FILES["file"]["tmp_name"], "media/img/" . $_FILES["file"]["name"]);
            }            
            break;
        
        case "2" :            
            $file_error = file_upload_check_2($_FILES["file"], array("jpg","png"));
            if(!$file_error){
                move_uploaded_file($_FILES["file"]["tmp_name"], "media/img/" . $_FILES["file"]["name"]);
            }            
            break;
        
        default : 
            move_uploaded_file($_FILES["file"]["tmp_name"],"media/img/" . $_FILES["file"]["name"]);
            break;   
    }    
} 


#
# HEYYYY LOOK and analyz the file name. that can cause xss.
# be careful on file size
#


?>

<div class="container" id="main">
    <h1>File Upload</h1>
    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST" enctype="multipart/form-data">
        <p><label for="file">Please upload an image:</label><br />
        <input type="file" name="file"></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="10">
        <input type="submit" name="form" value="Upload">
    </form>
    <br />
<?php
    if(isset($_POST["form"])){
        if(!$file_error){
            echo "The image has been uploaded <a href=\"media/img/" . $_FILES["file"]["name"] . "\" target=\"_blank\">here</a>.";
        }
        else{
            echo "<font color=\"red\">" . $file_error . "</font>";        
        }
    }
?>  