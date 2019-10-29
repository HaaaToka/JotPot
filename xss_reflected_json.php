<?php include_once "includer.php"; 

function checkInput($data)
{
    switch($_COOKIE['security_level'])
    {
        case "0" :        
            $data = no_check($data);            
            break;
        case "1" :
            $data = xss_check_3($data);
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

?>

<div class="container">
    <h1>XSS(Cross Site Script) - Reflected (JSON)</h1>
    <!--<a href="#">okan <script>alert(1)</script> </a>-->

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="music">Search for a song:</label>
        <input type="text" id="music" name="music"></p>

        <button type="submit" name="form" value="submit">Search</button>  <br>
        
        <?php if(!isset($_POST["music"])) { echo "HINT: Ey bi si di i ef ci".
                                                "eyc ay cey key elo meno pi".
                                                "Q ar es ti yu vi".
                                                "dabulyu x vay zet qapıcı izzet";} ?>
    </form>
</div>

<?php

if(isset($_POST["music"])){   

    $songs = array("evde 5 arabada 15","topal","erik dali","cekirge","kapici izzet","dar geldi sana ankara");
    $song = checkInput($_POST["music"]);

    if(in_array(strtolower($song),$songs))
        $result = '{"songs":[{"response":"Yes! We have that song..."}]}';
    else
        $result = '{"songs":[{"response":"' . $song . '??? Sorry, we don&#039;t have that song :("}]}';


}
else{
   $result = '{"songss":"[{HINT: Ey bi si di i ef ci
    eyc ay cey key elo meno pi
    Q ar es ti yu vi
    dabulyu x vay zet qapıcı izzet }]"}'; 
}

?>

<div class ="container" id="result"></div>

    <script>

        var JSONResponseString = '<?php echo $result ?>';

        // var JSONResponse = eval ("(" + JSONResponseString + ")");
        var JSONResponse = JSON.parse(JSONResponseString);

        document.getElementById("result").innerHTML=JSONResponse.songs[0].response;

    </script>




<!--

Level 0:
"}]}'; alert(1);//
---
<svg onload=alert(0)>

&lt;a href=""&gt; asd &lt;/a&gt;

-->