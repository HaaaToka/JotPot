<?php

include "includer.php";
$message="";
$newconn = new ConnectDB($sn,$un,$pss,$db);


if(isset($_REQUEST['action']) && isset($_REQUEST['password_new']) && isset($_REQUEST['password_conf'])){

    $password_new = $_REQUEST["password_new"];
    $password_conf = $_REQUEST["password_conf"];
    
    if($password_new == ""){
        $message = "<font color=\"red\">Please enter a new password...</font>";       
    }
    else{
        if($password_new != $password_conf){
            $message = "<font color=\"red\">The passwords don't match!</font>";
        }
        else{
            $login = $_SESSION['login'];
            $password_new = hash("sha1",$password_new,false);
            if($slc=="1" or $slc=="2"){
                if(isset($_REQUEST['password_curr'])){
                    $password_curr = $_REQUEST["password_curr"];
                    $password_curr = hash("sha1",$password_curr,false);
                    $sql = "SELECT password FROM users WHERE name='$login' AND password='$password_curr'";
                    $stmt = $newconn->conn->prepare($sql);
                    if(!$stmt){
                        die("Error:".$stmt->errorInfo());
                    }
                    else{
                        $stmt->execute();
                        if($stmt->rowCount()!=0){
                            $sql = "UPDATE users SET password='$password_new' WHERE name='$login'";
                            $stmt=$newconn->conn->prepare($sql);
                            if(!$stmt){
                                die("Error:".$stmt->errorInfo());
                            }
                            else{
                                $stmt->execute();
                                $message = "<font color='green'>The password has been changed!</font>";
                            }
                        }
                        else{
                            $message="<font color='red'>Wrong the current password!</font>";
                        }
                    }
                    
                }
                else{
                    $message="<font color='red'>Enter the current password!</font>";
                }
            }
            else{#$slc='0'
                $sql = "UPDATE users SET password='$password_new' WHERE name='$login'";
                $stmt=$newconn->conn->prepare($sql);
                if(!$stmt){
                    die("Error:".$stmt->errorInfo());
                }
                else{
                    $stmt->execute();
                    $message = "<font color='green'>The password has been changed!</font>";
                }
            }
        }
    }
}


$newconn->disconnectServer();
?>



<div class="container" id="main">
    
    <h1>CSRF (Cross Site Reference Forgery) - (Change Password)</h1>

    <p>Change your password.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="GET">   
<?php
        if($slc == "1" or $slc == "2"){
?>
        <p><label for="password_curr">Current password:</label><br />
        <input type="password" id="password_curr" name="password_curr"></p>
<?php        
        }
?>
        <p><label for="password_new">New password:</label><br />
        <input type="password" id="password_new" name="password_new"></p>

        <p><label for="password_conf">Re-type new password:</label><br />
        <input type="password" id="password_conf" name="password_conf"></p>  

        <button type="submit" name="action" value="change">Change</button>   

    </form>
    <br />
<?php    
    echo $message;
?>
    
</div>