
<?php


if(isset($_POST["security_level"]))
    $slc = $_POST["security_level"];
else
    $slc = $_COOKIE["security_level"];


#if(isset($_POST["form_security_level"])){
if(isset($_POST["security_level"]))  {     
       $security_level_cookie = $_POST["security_level"];
       
       switch($security_level_cookie) {
           case "0" :
               $security_level_cookie = "0";
               break;
   
           case "1" :
               $security_level_cookie = "1";
               break;
   
           case "2" :
               $security_level_cookie = "2";
               break;
   
           default : 
               $security_level_cookie = "0";
               break;
       }
       #last two false for the secure and httponly flags
       setcookie("security_level", $security_level_cookie, time() + (86400 * 30), "/", "", false, false);   
}


?>


<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img width="125" height="50" src="media/img/logo.png"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="media/files/owaspTop10.pdf">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Vulnerabilities
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="list_injection.php" class="dropdown-item">Injection</a>
                    <a href="list_brokenauth.php" class="dropdown-item">Broken Authentication</a>
                    <a href="list_sensitivedataexposure.php" class="dropdown-item">Sensitive Data Exposure</a>
                    <a href="list_xxe.php" class="dropdown-item">XML External Entities(XXE)</a>
                    <a href="list_brokenaccesscontrol.php" class="dropdown-item">Broken Access Control</a>
                    <a href="list_misconfiguration.php" class="dropdown-item">Misconfiguration</a>
                    <a href="list_xss.php" class="dropdown-item">Cross-Site Scripting(XSS)</a>
                    <a href="list_insecuredeserialization.php" class="dropdown-item">Insecure Deserialization</a>
                    <a href="list_componenetswithknownvulnerabilities.php" class="dropdown-item">Componenets with Known Vulnerabilities</a>
                    <a href="list_insufficientloggingmonitoring.php" class="dropdown-item">Insufficient Logging & Monitoring</a>
                    <a href="list_csrf.php" class="dropdown-item">Cross Site Reference Forgery(CSRF)</a>
                    <a href="list_idor.php" class="dropdown-item">Insecure Direct Object Reference(IDOR)</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="info.php">Something else here</a>
                </div>
            </li>
            <li class="nav-item" >
<?php if(isset($_SESSION["login"])){ 
?>
        <div id="person">
            <font color="orange"> <label>Welcome : <?php echo $_SESSION["login"]?></label> </font> <br />
        </div>  
<?php } 
?>
            </li>
        </ul>

        <div id="security_level">
                <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

                <font color="green"> <label>Set your security level:</label> </font> <br />

                    <select name="security_level">

                        <option value="0">script kiddie</option>
                        <option value="1">hacker</option>
                        <option value="2">omniscient</option> 

                    </select>

                    <button type="submit" name="form_security_level" value="submit">Set</button><br>

                </form> 
        </div>
<label>&nbsp;&nbsp;&nbsp;</label>
        <div id="loginout">
        
<?php

            if(isset($_SESSION['login'])){
?>
            <input type="button" value="LOGOUT" onclick="window.location.href='logout.php'">
<?php
            }
            else{
?>
            <input type="button" value="LOGIN" onclick="window.location.href='login.php'">
<?php
            }
?>

        </div>

        <!--<form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
    </div>
</nav>



<?php



switch($slc)
{
    case "0" :
            echo '<div class="alert alert-warning" role="alert">Current security level <b>Script Kiddie</b></div>';
        break;

    case "1" :
            echo '<div class="alert alert-primary" role="alert"> Current security level <b>Hacker</b> <?php  ?> </div>';
        break;

    case "2" :
            echo '<div class="alert alert-danger" role="alert">Current security level <b>Omniscient</b></div>';
        break;
    default : 
            echo '<div class="alert alert-warning" role="alert">Current security level <b>Script Kiddie</b></div>';
        break;

}
               
 
 


?>