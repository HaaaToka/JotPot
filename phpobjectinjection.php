<?php

#https://www.owasp.org/index.php/PHP_Object_Injection
#https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/Insecure%20Deserialization/PHP.md
#https://omercitak.com/php-object-injection/

include "includer.php";

#echo serialize(array("name","eticin"));

class aburcubur{

    public $name;
    function __construct(){
    }
    function __wakeup(){
        if(isset($this->name)){
            eval($this->name);
        }
    }
}

?>

<div class=container>

    <h1>PHP Object Injection</h1>
    <form method="GET">
        <label>AburCubur Name:</label>
        <input type="text" name="name" value='a:2:{i:0;s:4:"name";i:1;s:6:"eticin";}'><br>
        <button type="submit" name="form">SEND</button>
    </form>

<?php

if(isset($_GET['name'])){  
    $var1=unserialize($_GET['name']);

    if(is_array($var1))
        echo "<br>".$var1[0]." - ".$var1[1];
}



?>


</div>



<!--

a:2:{i:0;s:4:"name";i:1;s:25:"<script>alert(1)</script>";}

O:9:"aburcubur":1:{s:4:"name";s:17:"system('whoami');";}


Prevention:
Don't use unserialize function. You should use JSON(Java Script Object Notation) for keeping your data.

-->