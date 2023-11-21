<?php

require_once("./Opinion.php");
require_once("./config.php");

class OpinionManager {
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


public function create (Opinion $opinion){
    $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."` . `opinions` (name, comment, rating) VALUES (:name, :comment, :rating)");
    $req->bindValue(":name", $opinion->getName(), PDO::PARAM_STR);
    $req->bindValue(":comment", $opinion->getComment(), PDO::PARAM_STR);
    $req->bindValue(":rating", $opinion->getRating(), PDO::PARAM_INT);
    

if ($req->execute()) {
    echo "Témoignage ajouté avec succès, en attente d'approbation";
} else {
    echo "Erreur lors de l'ajout du témoignage.";
}

}
public function getAll(){
    $opinion = [];
    $req = $this->db->query("SELECT * FROM `".$this->managerbdd->getdbName()."`.`opinions`");
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $opinion = new Opinion($data);
        $opinions[] = $opinion;
    }
    return $opinions;
}
public function update(int $id, bool $approved){
    $req = $this->db->prepare("UPDATE `".$this->managerbdd->getdbName()."`.`opinions` SET approved = :approved WHERE id = :id");

    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->bindValue(":approved", $approved, PDO::PARAM_BOOL);
    $req->execute();
}
public function getAllApproved(){
    $opinion = [];
    $req = $this->db->query("SELECT * FROM `".$this->managerbdd->getdbName()."`.`opinions` WHERE approved = 1;");
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $opinion = new Opinion($data);
        $opinions[] = $opinion;
    }
    return $opinions;
}
}

