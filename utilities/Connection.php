<?php 
/**
 * @author Paul Madduma
 * 
 * Singleton class : Connection
 */

class Connection {
    private static $instance = null;
    private $host;
    private $name;
    private $user;
    private $password;
    private $pdo;
    private $db;
    private $charset;

    /**
     * connector method configuration of how database links to the web pages
     */
    public function connector(){
        $this->host = "localhost";
        $this->name = "bakery";
        $this->user = "root";
        $this->password="";
        $this->db = "bakery";
        $this->charset = "utf8mb4";
        
        try {
            $conn = "mysql:host=". $this->host .
                ";dbname=".$this->db.";charset=" . 
                $this->charset;        

            $pdata = new PDO($conn, $this->user, $this->password);
            $pdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdata;
        } catch (PDOEXception $error) {
            echo "Connection failed : {$error->getMessage()}";
        }

    }

}
