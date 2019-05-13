<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

 

 
 //Establishes the connection
 /**
  * 
  */
 Class Config
 {

private $server = 'mysql:host=pujiyulitomowebappserver.database.windows.net;dbname=pujiyulitomowebapp';
private $user = 'apayah90@pujiyulitomowebappserver';
private $pass = 'terserah90!';
private $db_name = 'pujiyulitomowebapp';
private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
protected $link;
 

 
 //Establishes the connection

 //Establishes the connection
 
    

// Check connection
     public function openConnection() {
     try {
      $this->link = new PDO("sqlsrv:server = pujiyulitomowebappserver.database.windows.net; Database = pujiyulitomowebapp", "apayah90", "terserah90!");
      $link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
       return $this->link;
       echo "Berhasil terkoneksi ke database";
    } catch(Exception $e) {
        echo "Failed: " . $e->getMessage();
    }

    }

    public function close() {
     
    $this->link = null;

    }

}


?>
