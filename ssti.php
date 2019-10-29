<?php
// <script>alert(1)</script>

include "includer.php";
include 'vendor/twig/twig/lib/Twig/Autoloader.php';

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = sqli_check_1($data);
            break;
        case "2" :                 
            $data = sqli_check_1($data);            
            break;
        default : 
            $data = no_check($data);            
            break;   
    }       
    return $data;
}


?>


<div class="container">

<?php 

if(!isset($_GET['name'])){ 
    
?>

    <h1>Server-Site Template Injection</h1>
    <p>Enter your name</p>
    
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
    
        <label>Name: </label>
        <input tpye="text" id="name" name="name"/><br> 

    </form>


<?php
}
else{
    $name = $_GET['name'];
$okan="alan";
    Twig_Autoloader::register();
    if($slc == '0'){
        try{
            $loader = new Twig_Loader_String();
            $twig = new Twig_Environment($loader);
            $result = $twig->render($name);
            echo $result;
        }
        catch(Exception $e){
            die ('ERROR: ' . $e->getMessage());
        }
    }
    else{
        $loader = new Twig_Loader_String();
        $twig = new Twig_Environment($loader);
        $result = $twig->render("{{name}}", [
            "name" => $name,
            ]);
        
        echo $result;
    }


}
?>


</div>

<?php
/*

https://www.blackhat.com/docs/us-15/materials/us-15-Kettle-Server-Side-Template-Injection-RCE-For-The-Modern-Web-App-wp.pdf
http://ha.cker.info/
https://portswigger.net/blog/server-side-template-injection

*/

?>