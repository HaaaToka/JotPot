<?php


/*
    
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE root [
<!ENTITY bWAPP SYSTEM "http://localhost:8080/JotPot/deneme.txt">
]>
<reset><login>&bWAPP;</login><secret>Adadfbbf</secret></reset>


<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE deneme [
<!ENTITY canyoupwnme SYSTEM "http://192.168.56.101/bbWAPP/bWAPP/robots.txt">
]>
<reset><login>&canyoupwnme;</login><secret>Adadfsaf</secret></reset>


*/


include "connection.php";
include "config.php";
error_reporting(~E_ALL);
ini_set(‘display_errors’, ‘Off’);
$newconn = new ConnectDB($sn,$un,$pss,$db);


libxml_disable_entity_loader(false);#allow external entities
$xm = file_get_contents('php://input'); #get posted xml
$dom = new DOMDocument(); #create xml class
$dom->loadXML($xm, LIBXML_NOENT | LIBXML_DTDLOAD); #load XML data into dom
$xml = simplexml_import_dom($dom); #parse into XML
$login = $xml->login; #load loged in user
$secret = $xml->secret; #load new secret

if($secret){
    $sql = "UPDATE users SET secret = '$secret' WHERE name = '$login'";
    $stmt = $newconn->conn->prepare($sql);
    if(!$stmt){
        die("Connect Error: " . $stmt->errorInfo());
    }
    $stmt->execute();
    $message = $login . "'s secret has been reset!";
}
else
    $message = "An error occured!";

echo "<pre>$login, $secret </pre>"; 


#$newconn->disconnectServer();

?>
