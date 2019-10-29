<?php
include "includer.php";

$message="";
if(isset($_POST["form1"])){ 
    if($_POST["login"] == "hardwork" && $_POST["password"] == "in JotForm SeccopS"){
        $message = "<font color=\"green\">Successful login! You really are genius :)</font>";
    }
    else{
        $message = "<font color=\"red\">Invalid credentials!</font>";
    }
}
if(isset($_REQUEST["secret"]))   { 
    if($_REQUEST["secret"] == "talk is cheap show me the code"){      
        $message = "<font color=\"green\">Thug Life: Linus Torvalds</font>";   
    }
    else{
        $message = "<font color=\"red\">think more clever</font>";
    }
}

if($_COOKIE["security_level"]=="0"){
?>

<div class="container">

    <h1>Broken Authentication Insecure Login Forms</h1>

    <p>Enter your credentials.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Login:</label><font color="white">hardwork</font><br />
        <input type="text" id="login" name="login" size="30" /></p> 

        <p><label for="password">Password:</label><font color="white">in JotForm SeccopS</font><br />
        <input type="password" id="password" name="password" size="30" /></p>

        <button type="submit" name="form1" value="submit">Login</button>  

    </form>

    </br >    
    <?php echo $message;?>    
</div>
<?php
}
else{
#pangram
    echo '<script type="text/javascript">   
    
    function unlock_secret()
    {
        var jotform = "a quick brown fox jumps over the lazy dog"
        var p = jotform.charAt(38);
        var v = jotform.charAt(26);
        var h = jotform.charAt(40);
        var q = jotform.charAt(29);
        var n = jotform.charAt(3);
        var m = jotform.charAt(0);
        var x = jotform.charAt(9);
        var y = jotform.charAt(33);
        var i = jotform.charAt(6);
        var b = jotform.charAt(18);
        var o = jotform.charAt(5);
        var z = jotform.charAt(11);
        var s = jotform.charAt(14);
        var f = jotform.charAt(22);
        var w = jotform.charAt(35);
        var c = jotform.charAt(10);
        var j = jotform.charAt(8);
        var k = jotform.charAt(4);
        var l = jotform.charAt(36);
        var r = jotform.charAt(16);
        var a = jotform.charAt(20);
        var u = jotform.charAt(12);
        var t = jotform.charAt(2);
        var g = jotform.charAt(30);
        var e = jotform.charAt(25);
        var d = jotform.charAt(21);
        secret = (q + m + y + i +" "+ k + f + " " +o + g + v + m + d +" "+ f + g + c + z +" "+ a + v +" "+ q + g + v +" "+ o + c + p + v)
  
        if(document.forms[1].passphrase.value == secret){ 
            // Unlocked
            location.href="brokenauthentication_insecurelogin.php?secret=" + secret;
        }
        else{
            // Locked
            location.href="brokenauthentication_insecurelogin.php?secret=";      
        }
    
    }	
    </script>';
    


?>



<div class="container">    

    <h1>Broken Authentication Insecure Login Forms</h1>

    <p>Enter the correct passphrase to unlock the secret.</p>

    <form>   

        <p><label for="name">Name:</label><font color="white">linustorvadls</font><br />
        <input type="text" id="name" name="name" size="20" value="brucebanner" /></p> 

        <p><label for="passphrase">Passphrase:</label><br /> 
        <input type="password" id="passphrase" name="passphrase" size="20" /></p>

        <input type="button" name="form2" value="Unlock" onclick="unlock_secret()" /><br />

    </form>

    </br >    
    <?php echo $message;?>    
</div>

<?php
}

?>