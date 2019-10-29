<?php

include "includer.php";


$priceofChocalate=5;

?>

<div class="container">

    <h1> Insecure Direct Object Reference </h1><br>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

    <p> How many chocalate would you like to buy? 5 ₺ per chocalate </p>
    <p>Please enter amount of chocalate you want <input type="text" name="chocalate_quantity" value="1" size="2"> </p>


    <?php

if($_COOKIE["security_level"] != "1" and $_COOKIE["security_level"] != "2")
{

?>
        <input type="hidden" name="chocalate_price" value="<?php echo $priceofChocalate; ?>">

<?php

}

?>
        <button type="submit" name="action" value="order">Buy It</button>

    </form>

<br />

<?php

if(isset($_POST["chocalate_quantity"]))
{
    
    if($_COOKIE["security_level"] != "1" or $_COOKIE["security_level"] != "2")
    {

        if(isset($_POST["chocalate_price"]))
        {

            $priceofChocalate = $_POST["chocalate_price"];

        }
        
    }
    
    $chocalate_quantity = abs($_REQUEST["chocalate_quantity"]);
    $total_amount = $chocalate_quantity * $priceofChocalate;

    echo "<p>You ordered <b>" . $chocalate_quantity . "</b> packet of chocalates.</p>";
    echo "<p>Total amount charged from your account automatically: <b>" . $total_amount . " Turkish Lira(s)</b>.</p>";
    echo "<p>Thank you for your order!</p>";
    
    $_SESSION["amount"] = $_SESSION["amount"] - $total_amount;

}

#echo print_r($_SESSION);
echo "<p><b>You have ".$_SESSION["amount"]." Turkish Liras</b></p>"
?>

</div>