<?php 

include "includer.php"; 

function checkInput($data){
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = xss_check_1($data);
            break;
        case "2" :                 
            $data = xss_check_3($data);            
            break;
        default : 
            $data = no_check($data);            
            break;   
    }       
    return $data;
}

?>

<div class="container">
    <h1>HTML Injection - Reflected (GET)</h1>
    <!--<a href="#">okan <script>alert(1)</script> </a>-->

    <p>Enter your first and last name:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="GET">

        <p><label for="firstname">First name:</label><br />
        <input type="text" id="firstname" name="firstname"></p>

        <p><label for="lastname">Last name:</label><br />
        <input type="text" id="lastname" name="lastname"></p>

        <button type="submit" name="form" value="submit">Go</button>  

    </form>


<?php

    if(isset($_GET["firstname"]) && isset($_GET["lastname"]))
    {   

        $firstname = $_GET["firstname"];
        $lastname = $_GET["lastname"];    

        if($firstname == "" or $lastname == "")
        {

            echo "<font color=\"red\">Please enter both fields...</font>";       

        }

        else            
        { 
            echo "Welcome ".checkInput($firstname)." ".checkInput($lastname);   
        }

    }

?>


</div>
