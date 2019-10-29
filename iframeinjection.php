<?php
    include_once "includer.php";

    if( !isset($_GET["ParamUrl"]) || !isset($_GET["ParamHeight"]) || !isset($_GET["ParamWidth"]) ){
        #header("Location: iframeinjection.php?ParamUrl=todolist.txt&ParamWidth=250&ParamHeight=250");
        #exit;
        $protocol = "http://";
        $ip = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        $params = "?ParamUrl=todolist.txt&ParamWidth=250&ParamHeight=250";
        #echo $_SERVER['HTTP_HOST']."-".$_SERVER['REQUEST_URI'];
        $link = $protocol.$ip.$uri.$params;
        #echo $link;
        echo "<script>window.open('$link','_self')</script>";
    }

    function checkInput($data)
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

?>

<div class="container">
    <h1>iFrame Injection</h1>
    <?php 
        if($_COOKIE["security_level"]=="0"){ 
           ?>
                <iframe frameborder="0" src="<?php echo checkInput($_GET['ParamUrl'])?>" height="<?php echo checkInput($_GET['ParamHeight'])?>" width="<?php echo checkInput($_GET['ParamWidth'])?>"></iframe>
           <?php
        } 
        else{
            ?>
                <iframe frameborder="0" src="todolist.txt" height="<?php echo checkInput($_GET['ParamHeight'])?>" width="<?php echo checkInput($_GET['ParamWidth'])?>"></iframe>
            <?php
        }
    
    ?>


</div>


<!-- Level 0-1: http://localhost:8080/proje/iframeinjection.php?ParamUrl=index.php&ParamWidth=250&ParamHeight=250"></iframe><p>okan</p><iframe> -->