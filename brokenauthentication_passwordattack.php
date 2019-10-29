<?php

include "includer.php";

$message="";
if(isset($_POST["form"])){
    if($_POST["username"] == $loglogin and $_POST["password"]==$passpassword)
        $message = "<font color='gree'>Successful login!</font>";
    else
        $message="<font color='red'>Invalid credentails! Did you forgot your password?</font>";
}


?>


<div class="container">    

    <h1>Broken Authentication Password Attack</h1>

    <p>Enter your credentials (jot/form)</p>

    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">

        <p>
            <label for="username">Username:</label><br>
            <input tpye="text" id="username" name="username" size="30" autocomplete="off"/><br>    
        
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" size="30" autocomplete="off"/><br>

            <button type="submit" name="form" value="submit">LogIn</button><br>
        </p>

    </form>

    <?php echo $message;?>

</div>

