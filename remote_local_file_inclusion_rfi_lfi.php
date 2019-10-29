<?php

#https://www.netsparker.com.tr/blog/web-guvenligi/lfi-rfi-guvenlik-zafiyetleri-baglaminda-php-stream-wrapperlari/


include "includer.php";


$hero = "";
if(isset($_GET["hero"])){
    switch($_COOKIE['security_level']){
        case "0" :
            $hero = $_GET["hero"];
            break;

        case "1" :
            $hero = $_GET["hero"] . ".php";
            break;

        case "2" :
            $available_heros = array("ironman.php", "captainamerica.php", "spiderman.php");
            $hero = $_GET["hero"] . ".php";
            // $hero = rlfi_check_1($hero);
            break;

        default :
            $hero = $_GET["hero"];         
            break;
    }
}

?>

<div class="container">

    <h1>Remote & Local File Inclusion (RFI/LFI)</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="GET">

        <p>
            Spoiler time
            <select name="hero">
<?php
                if($_COOKIE["security_level"] == "0"){
?>
                            <option value="ironman.php">Iron Man</option>
                            <option value="captainamerica.php">Captain America</option>
                            <option value="spiderman.php">Spiderman</option>

<?php
                }
                else{
?>
                            <option value="ironman">Iron Man</option>
                            <option value="captainamerica">Captain America</option>
                            <option value="spiderman">Spiderman</option>
<?php
                }
?>
                </select>
                <button type="submit" name="action" value="go">Nooooooo</button> 
        </p>
    </form>

<?php
    
if(isset($_GET["hero"])){
    #echo $hero."<br>";
    if($_COOKIE["security_level"] == "2"){
            if(in_array($hero, $available_heros)) include($hero);
    }
    else{
        include($hero);
    }
}

?>    

</div>


<!--

Level 0:
http://localhost:8080/JotPot/remote_local_file_inclusion_rfi_lfi.php?hero=<http://-website-xxx.php>&action=go

Level 1:
http://localhost:8080/JotPot/remote_local_file_inclusion_rfi_lfi.php?hero=<http://-website-xxx>&action=go

Level 2:


-->