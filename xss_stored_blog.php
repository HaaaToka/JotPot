<?php

include "includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);


function checkInputsql($data){    
    return sqli_check_1($data);
}

function checkInputxss($data)
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

$message = "";


if(isset($_POST['entry_add'])){
    $entry = $_POST['entry'];
    $owner = $_SESSION['login'];
    if($entry!=""){

        $sql = "INSERT INTO blog (owner, date, entry) VALUES ('" . checkInputsql($owner) . "',now(),'" . checkInputsql($entry) . "')";
        $result = $newconn->conn->query($sql);
        if(!$result){
            die("Error: " . print_r($newconn->conn->errorInfo())."<br><br>");
        }
        $message = "<font color=\"green\">Your entry was added to our blog!</font>";
    }
    else
        $message =  "<font color=\"red\">Please enter some text...</font>";
}
else if(isset($_POST['entry_delete'])){
    $sql = "DELETE from blog WHERE owner = '" . checkInputsql($_SESSION["login"]) . "'";
    $result = $newconn->conn->query($sql);

    if(!$result){
        die("Error: " . print_r($newconn->conn->errorInfo())."<br><br>");
    }
    $message = "<font color=\"green\">All your entries were deleted!</font>";
}



?>

<div class="container">

    <h1>XSS(Cross Site Script) - Stored(Blog)</h1>

    <form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="POST">

        <table>
                <tr>
                    <td colspan="6">
                        <p><textarea name="entry" id="entry" cols="80" rows="3"></textarea></p>
                    </td>
                </tr>

                <tr>
                    <td width="79" align="left">
                        <button type="submit" name="blog" value="submit">Submit</button>
                    </td>
                    <td width="85" align="center">
                        <label for="entry_add">Add:</label>
                        <input type="checkbox" id="entry_add" name="entry_add" value="" checked="on">
                    </td>
                    <td width="100" align="center">
                        <label for="entry_all">Show all:</label>
                        <input type="checkbox" id="entry_all" name="entry_all" value="">
                    </td>
                    <td width="106" align="center">
                        <label for="entry_delete">Delete:</label>
                        <input type="checkbox" id="entry_delete" name="entry_delete" value="">
                    </td>
                    <td width="7"></td>
                    <!--<td align="left"><php echo $message;?></td>-->
                </tr>
        </table>

    </form><br>

    <table id="table_green">
    
        <tr height="30" bgcolor="green" align="center">
            <td width="20">#</td>
            <td width="100"><b>Owner</b></td>
            <td width="100"><b>Date</b></td>
            <td width="400"><b>Entry</b></td>
        </tr>
    
<?php

if(isset($_POST['entry_all']))
    $sql = "SELECT * from blog";
else
    $sql = "SELECT * from blog WHERE owner='".checkInputsql($_SESSION['login'])."'";

$result = $newconn->conn->query($sql);
if(!$result){
?>
    <tr height="50">
        <td colspan="4" width="665"><?php die("Error: " . print_r($newconn->conn->errorInfo()));?></td>
    </tr>  
<?php
}
if($result->rowCount() != 0){
    #echo "DATA GELIYOR";
    foreach( new RecursiveArrayIterator($result->fetchAll()) as $row){
?>

        <tr height="40">
            <td align="center"><?php echo $row['id']; ?></td>
            <td><?php echo $row['owner']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo checkInputxss($row['entry']); ?></td>
        </tr>

<?php
    }

}


?>

    </table>

</div>