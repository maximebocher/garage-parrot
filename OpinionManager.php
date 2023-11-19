<?php

require("./Opinion.php");

class OpinionManager {
    private $db;
    public function __construct() {
$dbName = "garage-parot";
$port = 3306;
$username = "neva";
$password = "neva";

try {
    $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $username, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
}


public function create (Opinion $opinion){
    $req = $this->db->prepare("INSERT INTO `garage-parot` . `opinions` (name, comment, rating) VALUES (:name, :comment, :rating)");
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
    $req = $this->db->query("SELECT * FROM `opinions`");
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $opinion = new Opinion($data);
        $opinions[] = $opinion;
    }
    return $opinions;
}
public function update(int $id, bool $approved){
    $req = $this->db->prepare("UPDATE opinions SET approved = :approved WHERE id = :id");

    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->bindValue(":approved", $approved, PDO::PARAM_BOOL);
    $req->execute();
}
public function getAllApproved(){
    $opinion = [];
    $req = $this->db->query("SELECT * FROM `opinions` WHERE approved = 1;");
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $opinion = new Opinion($data);
        $opinions[] = $opinion;
    }
    return $opinions;
}
}

