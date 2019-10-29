<?php

session_start();
#print_r($_SESSION);
if(!(isset($_SESSION['login']))){
    header("Location: login.php");
    exit;
}

include "base.html";
include "header.php";

include "functions.php";
include "connection.php";
include "config.php"


?>