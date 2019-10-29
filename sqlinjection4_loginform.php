<?php

include_once "includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            #$data = no_check($data);            
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
    <h1>SQL Injection (LoginForm)</h1>
    <p>Enter your hero  you feel close</p>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">

        <p>
            <label for="name">Hero:</label><br>
            <input tpye="text" id="name" name="name" size="30" autocomplete="off"/><br>    
        
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" size="30" autocomplete="off"/><br>

            <button type="submit" name="form" value="submit">Get Message</button><br>
        </p>

    </form>


<?php

if(isset($_POST['form'])){

    $sql = "SELECT * FROM heroes WHERE name='".checkInput($_POST["name"])."' AND password='".checkInput($_POST['password'])."'";
    echo $sql."<br>";
    $result = $newconn->conn->query($sql);

    if(!$result){ 
	    #echo "DATA YOK";
         die("Error: " . print_r($newconn->conn->errorInfo())); 
    }
    else{
        $row = $result->fetch();
        if($row["name"]){
            $message = "<p> *_* <b>".ucwords($row["name"])."</b> said that:".ucwords($row["message"])."</p>";
        }
        else{
            echo "INVALID QUERY";
            $message = "<font color=\"red\">Invalid credentials</font>";
        }
    }
    $newconn->disconnectServer();
    echo $message;
}

#echo "BITTI";
?>

</div>



<?php
/*

Level 0:



Level 1:


*/
?>