<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

 

 
 //Establishes the connection
 /**
  * 
  */
 Class Config
 {

    $host = "pujiyulitomowebappserver.database.windows.net";
    $user = "apayah90";
    $pass = "terserah90!";
    $db = "pujiyulitomowebapp";
    

// Check connection
     public function openConnection() {

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    }

    public function close() {
     
    $this->link = null;

    }

}


?>
