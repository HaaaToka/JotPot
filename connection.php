<?php

class ConnectDB{

    private $servername;
    private $username;
    private $password;
    private $dbname;

    public $conn;

    public function __construct($servername,$username,$password,$dbname){

        $this->setServerName($servername);
        $this->setUserName($username);
        $this->setPassword($password);
        $this->setDatabaseName($dbname);
        
        #echo "$this->servername,  $this->username,  $this->password,  $this->dbname <hr/>";

        $this->createConnection();

    }

    private function setServerName($sn){
        $this->servername=$sn;
    }
    private function setUserName($un){
        $this->username = $un;
    }
    private function setPassword($pw){
        $this->password = $pw;

    }
    private function setDatabaseName($dbn){
        $this->dbname = $dbn;
    }
    private function createConnection(){

        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /*  
            By using "prepare" and "execute" function of PDO we  can avoid sql injection 
            https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
            This link is amazing to understand prevent sql injection
        */
    }

    public function getCon(){
        return $this->conn;
    }


    public function disconnectServer(){
        $this->conn=null;
    }

}




?>

