<?php
include "includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);

function checkInputsql($data)
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

$ip_address = $_SERVER["REMOTE_ADDR"];
$user_agent = $_SERVER["HTTP_USER_AGENT"];

$sql = "INSERT INTO visitors (date, user_agent, ip_address) VALUES (now(), '".checkInputsql($user_agent)."', '" . $ip_address . "')";
$result = $newconn->conn->query($sql);
if(!$result)
    die("Error".print_r($newconn->conn->errorInfo()));

#----------------------------------------#

$line = "'" . date("y/m/d G.i:s", time()) . "', '" . $ip_address . "', '" . checkInputxss($user_agent) . "'" . "\r\n";     

$fp = fopen("logs/visitors.txt", "a");
fputs($fp, $line, 200);
fclose($fp);

#----------------------------------------#

$sql = "SELECT * FROM visitors ORDER by id DESC LIMIT 5";
$result = $newconn->conn->query($sql);
if(!$result)
    die("Error".print_r($newconn->conn->errorInfo()));

?>


<div class="container"> 

    <h1>XSS(Cross Site Script) Stored User Agent </h1>
    <p>
        Your IP address and User-Agent string have been logged into the database! 
        <font size="2">(<a href="logs/visitors.txt" target="_blank">download</a> log file)</font>
    <br><br>
        An overview of our latest visitors:
    </p>

    <table id="table_green">
        <tr height="30" bgcolor="green" align="center">
            <td width="100"><b>Date</b></td>
            <td width="100"><b>IP Address</b></td>
            <td width="465"><b>User-Agent</b></td>
        </tr>

<?php

foreach( new RecursiveArrayIterator($result->fetchAll()) as $row){
    #echo print_r($row)."<br>";
?>
    <tr height="40">
    <td align="center"><?php echo $row["date"]; ?></td>
    <td align="center"><?php echo $row["ip_address"]; ?></td>
    <td><?php echo xss_check_3($row["user_agent"]); ?></td>
    </tr>
<?php
}

$newconn->disconnectServer();

?>

    </table>

</div>


<!--

Lovel 0 :
while sending post request change below area
User-Agent: dene','<a href="#">gooo</a>')#

Level 1 :

-->