<?php
include "includer.php";

print_r($_SESSION);

$_SESSION = array();
session_destroy();

print_r($_SESSION);

#foreach($_COOKIE as $key=>$value){
#    echo $key."--".$value."<br>";
#}

#header("Location: login.php")
?>
<script>window.location="login.php"</script>