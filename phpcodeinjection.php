<?php include_once "includer.php"; 

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = xss_check_3($data);
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
    <h1>PHP Code Injection</h1>

    <p> What is there <a href="<?php echo($_SERVER["SCRIPT_NAME"]);?>?alien=areYouHuman"> ??? </a> </p>

    <?php
    
        if(isset($_REQUEST["alien"])){
            if($_COOKIE["security_level"]=="0"){
                ?>
                    <p> <b> <?php @eval ("echo ".$_REQUEST["alien"].";"); ?> </b> </p>
                <?php
            }else{
                ?>
                    <p> <b> <?php echo checkInput($_REQUEST["alien"]); ?> </b> </p>
                <?php
            }
        }
        

    ?>


</div>

