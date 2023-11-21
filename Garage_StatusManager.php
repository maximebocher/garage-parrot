<?php

require_once("./Garage_Status.php");
require_once("./config.php");
class Garage_StatusManager {
    private $db;
    private $managerbdd;

    public function __construct() {
        $this->managerbdd = new BDDManager();
        $dbName = $this->managerbdd->getdbName();
        $port = $this->managerbdd->getPort();
        $username = $this->managerbdd->getUserName();
        $password = $this->managerbdd->getPassword();
        $url = $this->managerbdd->getUrl();
        try{
            $this->db = new PDO("mysql:$url;dbname=$dbName;port=$port", $username, $password);
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    public function getgarage_status(){
        $garage_status = [];
        $req = $this->db->query("SELECT * FROM `".$this->managerbdd->getdbName()."`. `garagestatus`;");
        $datas = $req->fetchAll();
        return ($datas[0]['is_open']);
    }
public function update( bool $is_open){
    $req = $this->db->prepare("UPDATE `".$this->managerbdd->getdbName()."`.`garagestatus` SET is_open = :is_open");
    echo !$is_open;
    $req->bindValue(":is_open", ! $is_open, PDO::PARAM_BOOL);
    $req->execute();
}
}





