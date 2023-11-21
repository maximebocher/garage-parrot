<?php

require_once("./FormContact.php");
require_once("./config.php");

class FormContactManager {
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

public function create (Contact $contact){
    $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."`.`contact` (name, surname, email, phone, message, date_creation) VALUE (:name, :surname, :email, :phone, :message, :date_creation)");

    $req->bindValue(":name", $contact->getName(), PDO::PARAM_STR);
    $req->bindValue(":surname", $contact->getSurname(), PDO::PARAM_STR);
    $req->bindValue(":email", $contact->getEmail(), PDO::PARAM_STR);
    $req->bindValue(":phone", $contact->getPhone(), PDO::PARAM_STR);
    $req->bindValue(":message", $contact->getMessage(), PDO::PARAM_STR);
    $req->bindvalue(":date_creation", $contact->getDate_creation(), PDO::PARAM_INT);


    if ($req->execute()) {
        echo "demande de contact envoyé, vous serez recontacter dans les plus bref delais";
    } else {
        echo "Erreur lors de la demande de contact";
    }
    
}
public function getAll(){
    $contact = [];
    $req = $this->db->query("SELECT * FROM `".$this->managerbdd->getdbName()."` . `contact`");
    $datas = $req->fetchAll();
    foreach ($datas as $data) {
        $contact = new Contact($data);
        $contacts[] = $contact;
    }
    return $contacts;
}
}

