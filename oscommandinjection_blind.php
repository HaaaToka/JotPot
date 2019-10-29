<?php
include_once "includer.php"; 

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = commandi_check_1($data);
            break;
        case "2" :                 
            $data = commandi_check_2($data);            
            break;
        default : 
            $data = no_check($data);            
            break;   
    }       
    return $data;
}


?>

<div class="container">
    <h1>OS Command Injection</h1>
    <!--<a href="#">okan <script>alert(1)</script> </a>-->

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p>

            <label for="target">Target ip to send ping:</label>
            <input type="text" id="target" name="target" value="www.google.com">
            <button type="submit" name="form" value="submit">SEND</button>

        </p>

    </form>
</div>

<?php

if(isset($_POST["target"])){
    $target = $_POST["target"];

    if($target=="")
        echo "<font color='red'>Enter a target...</font>";
    else{
        echo "&emsp;&emsp;&emsp;&emsp;&emsp;Would you like upgrade your status?";

        if(PHP_OS == "Windows" or PHP_OS == "WINNT" or PHP_OS == "WIN32")
            shell_exec("ping -n 1 ".checkInput($target));
        else
            shell_exec("ping -c 1 ".checkInput($target));
    }

}

?>


<!--

Level 0 : 192.168.56.1; sleep 5
Level 1: 192.168.56.1 | sleep 10
Level 2: 

-->