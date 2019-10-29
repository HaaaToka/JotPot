<?php include_once "includer.php"; 

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = xss_check_4($data);
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
    <h1>XSS(Cross Site Script) - Reflected (POST)</h1>
    <!--<a href="#">okan <script>alert(1)</script> </a>-->

    <p>Enter your first and last name:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="firstname">First name:</label><br />
        <input type="text" id="firstname" name="firstname"></p>

        <p><label for="lastname">Last name:</label><br />
        <input type="text" id="lastname" name="lastname"></p>

        <button type="submit" name="form" value="submit">Go</button>  

    </form>

<?php

    if(isset($_POST["firstname"]) && isset($_POST["lastname"]))
    {   

        #echo print_r($_POST);

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];    

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




<!--

Level 0-1:
<script>alert(1)</script>

-->