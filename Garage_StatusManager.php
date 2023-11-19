<?php

require("./Garage_Status.php");

class Garage_StatusManager {
    private $db;
    public function __construct() {
        $dbName = "garage-parot";
        $port = 3306;
        $username = "neva";
        $password = "neva";
        try{
            $this->db = new PDO("mysql:localhost;dbname=$dbName;port=$port", $username, $password);
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    public function getgarage_status(){
        $garage_status = [];
        $req = $this->db->query("SELECT * FROM `garage-parot`. `garagestatus`;");
        $datas = $req->fetchAll();
        return ($datas[0]['is_open']);
    }
public function update( bool $is_open){
    $req = $this->db->prepare("UPDATE `garage-parot`.`garagestatus` SET is_open = :is_open");
    echo !$is_open;
    $req->bindValue(":is_open", ! $is_open, PDO::PARAM_BOOL);
    $req->execute();
}
}





