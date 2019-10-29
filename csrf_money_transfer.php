<?php

include_once "includer.php";

if(isset($_GET["amount"])){
    if(($slc == "1" or $slc == "2")){
        if(isset($_GET["action"]) && isset($_GET["token"]) && isset($_SESSION["token"])){    
            if(($_GET["token"] == $_SESSION["token"]) && ($_GET["action"]) == "transfer"){
                $_SESSION["amount"] = $_SESSION["amount"] - $_GET["amount"];
            }
        }   
    }
    else{
        $_SESSION["amount"] = $_SESSION["amount"] - $_GET["amount"]; 
    }
}
// A random token is generated when the security level is HIGH
if($slc == "2"){
    $token = sha1(uniqid(mt_rand(0,100000)));
    $_SESSION["token"] = $token;
}

?>

<div class="container" id="main">
    
    <h1>CSRF (Cross Site Reference Forgery) - (Money Transfer)</h1>

    <p>Amount of your account: <b> <?php echo $_SESSION['amount'];?> $$ </b></p>
    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="GET">

        <p><label for="account">Account to transfer:</label><br />
        <input type="text" id="account" name="account" value="123-45678-90"></p>

        <p><label for="amount">Amount to transfer:</label><br />
        <input type="text" id="amount" name="amount" value="0"></p>

<?php
    if($slc == "1" or $slc == "2"){
?>
        <input type="hidden" id="token" name="token" value="<?php echo $_SESSION["token"]?>">
<?php        
    }
?>
        <button type="submit" name="action" value="transfer">Transfer</button>   
    </form>
</div>

