<?php

session_start();
include "connection.php";
include "functions.php";
include "base.html";
include "header.php";
include "config.php";
#include_once "includer.php";

$newconn = new ConnectDB($sn,$un,$pss,$db);


$message = "";

if(isset($_POST['form'])){
    $username = $_POST['username'];
    $password =  hash("sha1",$_POST['password'],false);

    $sql = "SELECT * FROM users WHERE name='$username'AND password='$password'";
    #$sql = "SELECT * FROM users WHERE name=:username AND password=:passwd";
    $stmt = $newconn->conn->prepare($sql);
    #$stmt->execute(array(':username'=>$username,':passwd'=>$password));
    
    if(!$stmt){
        die("Error: ". print_r($stm->errorInfo()));
    }
    else{
    $stmt->execute();

    if($stmt->rowCount()!=0){
        $row = $stmt->fetch();
        #echo print_r($row);

        if($row){
            #session_regenerate_id(true);
            $token = hash("sha1",generateRandomString(10),false);
            $_SESSION["login"] = $row['name'];
            $_SESSION["token"] = $token;
            $_SESSION["amount"] = 10000;
            setcookie("security_level", "0", time()+360000, "/", "", false, false);
            ?> <script>window.location="index.php"</script> <?php
        }
    }
    else{
        $message = "<font color=\"red\">Invalid credentials or user not activated!</font>";
    }
    }

}

?>

<div class="container">
    <h1>LOGIN</h1>

    <p>Enter your username and password:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="username">Username:</label><br />
        <input type="text" id="username" name="username"></p>

        <p><label for="password">P4SSw0rd:</label><br />
        <input type="password" id="password" name="password"></p>

        <button type="submit" name="form" value="submit">LogIn</button>  

    </form>

    <p><?php echo $message;?></p>

</div>


<?php 



$newconn->disconnectServer();
?>