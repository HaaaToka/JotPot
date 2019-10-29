<?php

include "includer.php";
#echo print_r($_SESSION);

$message = "";
if(isset($_POST["form"])){
    #echo "POST :: ";
    if(isset($_SESSION["captcha"]) && ($_POST["captcha_user"] == $_SESSION["captcha"])){
        if($_POST["username"] == $loglogin && $_POST["password"] == $passpassword){
            $message = "<font color=\"green\">Successful login!</font>";
        }
        else{
            $message = "<font color=\"red\">Invalid credentials! Did you forgot your password?</font>";
        }
    }
    else{
        $message = "<font color=\"red\">Incorrect CAPTCHA!</font>";
    }
}
?>


<div class="container">    

    <h1>Broken Authentication Captcha Bypassing</h1>

    <p>Enter your credentials (jot/form)</p>

    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">

        <p>
            <label for="username">Username:</label><br>
            <input tpye="text" id="username" name="username" size="30" autocomplete="off"/><br>    
        
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" size="30" autocomplete="off"/><br>

            <p><iframe src="captcha_box.php" scrolling="no" frameborder="0" height="70" width="350"></iframe></p>

            <p><label for="captcha_user">Re-enter CAPTCHA:</label><br />
            <input type="text" id="captcha_user" name="captcha_user" value="" autocomplete="off" /></p>

            <button type="submit" name="form" value="submit">LogIn</button><br>
        </p>

    </form>

    <?php echo $message;?>

</div>
