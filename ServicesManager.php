<?php

require("./Services.php");

class ServicesManager {
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

public function AddServices(Services $services){
    $req = $this->db->prepare("INSERT INTO `garage-parot`.`services` (name, description) VALUE (:name, :description)");
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
    $req = $this->db->query("SELECT `id`,`name`,`description`FROM `garage-parot`.`services`"); 
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $service = new Services($data);
        $services[] = $service;
    }
    return $services;
}
public function deleteService(int $id){

    $req = $this->db->prepare("DELETE FROM `garage-parot`.`services` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);

    $req->execute();
}
}