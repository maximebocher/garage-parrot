<?php

require_once("./Services.php");
require_once("./config.php");
class ServicesManager {
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

public function AddServices(Services $services){
    $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."`.`services` (name, description) VALUE (:name, :description)");
    $req->bindValue(":name", $services->getName(), PDO::PARAM_STR);
    $req->bindValue(":description", $services->getDescription(), PDO::PARAM_STR);
    if ($req->execute()) {
        echo "Service ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout du Service.";
    }
}
public function getAllServices(){
    $services = [];
    $req = $this->db->query("SELECT `id`,`name`,`description`FROM `".$this->managerbdd->getdbName()."`.`services`"); 
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $service = new Services($data);
        $services[] = $service;
    }
    return $services;
}
public function deleteService(int $id){

    $req = $this->db->prepare("DELETE FROM `".$this->managerbdd->getdbName()."`.`services` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);

    $req->execute();
}
}