<?php

require_once("./Car.php");
require_once("./config.php");

class CarManager {
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

    public function create (Car $car){
        $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."`.`car` (name, type, year, price, km, description) VALUE (:name, :type, :year, :price, :km, :description)");
        $req->bindValue(":name", $car->getName(), PDO::PARAM_STR);
        $req->bindValue(":type", $car->getType(), PDO::PARAM_STR);
        $req->bindValue(":year", $car->getYear(), PDO::PARAM_INT);
        $req->bindValue(":price", $car->getPrice(), PDO::PARAM_INT);
        $req->bindValue(":km", $car->getKm(), PDO::PARAM_INT);
        $req->bindvalue(":description", $car->getDescription(), PDO::PARAM_STR);
        
        if ($req->execute()) {
            echo "annonce ajouté avec succès";
            return $this->db->lastInsertId();
        } else {
            echo "Erreur lors de l'ajout de l'annonce";
        }
    }

    public function createPicture (string $image_path, int $carId){
        $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."`.`pictures`(car_Id, image_path) VALUE (:car_id, :image_path) ");
        $req->bindvalue("car_id", $carId, PDO::PARAM_INT);
        $req->bindvalue("image_path", $image_path, PDO::PARAM_STR);
        $req->execute();
    }

    public function get(int $id){
        $req = $this->db->prepare("SELECT * FROM `".$this->managerbdd->getdbName()."`.`car` WHERE id= :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $datas = $req->fetch();
        $car = new Car($datas);
        return $car;
    }

    public function getAll(){
        $cars = [];
        $req = $this->db->query("SELECT c.`id`, `name`, `type`, `year`,`price`, `km`, `image_path` AS `picture`  FROM `".$this->managerbdd->getdbName()."`.`car` c LEFT JOIN `".$this->managerbdd->getdbName()."`.`pictures` p ON c.id = p.car_id GROUP BY c.id ORDER BY name");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $car = new Car($data);
            $cars[] = $car;
        }
        return $cars;
    }

    public function getAllByString(string $input){
        $cars = [];
        $req = $this->db->query("SELECT * FROM `car` WHERE name LIKE : input ORDER BY name");
        $req->bindValue(":input", $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $car = new Car($data);
            $cars[] = $car;
        }
        return $cars;
    }
    

    public function getAllByType(string $input){
        $cars = [];
        $req = $this->db->query("SELECT * FROM `car` WHERE type LIKE :input ORDER BY name");
        $req->bindValue(":input", $input, PDO::PARAM_STR);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $car = new Car($data);
            $cars[] = $car;
        }
        return $cars;
    }

    public function update(Car $car){
        $req = $this->db->prepare("UPDATE `car` SET  name = :name, type = :type, year = :year, price = :price, km = :km, description = :description");

        $req->bindValue(":name", $car->getName(), PDO::PARAM_STR);
        $req->bindValue(":type", $car->getType(), PDO::PARAM_STR);
        $req->bindValue(":year", $car->getYear(), PDO::PARAM_INT);
        $req->bindValue(":price", $car->getPrice(), PDO::PARAM_STR);
        $req->bindValue(":km", $car->getKm(), PDO::PARAM_INT);
        $req->bindvalue(": description", $car->getDescription(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id){

        $req = $this->db->prepare("DELETE FROM `car` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);

        $req->execute();
    }

    public function getAllByPicture(int $id){
        $req = $this->db->query("SELECT * FROM `".$this->managerbdd->getdbName()."`.`pictures` WHERE car_id = ".$id.";");
    //$req->bindValue(":car_id", $id, PDO::PARAM_INT);
    $req->execute();
    $datas = $req->fetchAll();

        
        return $datas;
    }
    public function getAllfilter(INT $prixMinInput,INT $prixMaxInput,INT $kmMin,INT $kmMax,INT $yearMin,INT $yearMax){
        $cars = [];
        $sql = "SELECT c.`id`, `name`, `type`, `year`,`price`, `km`, `image_path` AS `picture`  FROM `".$this->managerbdd->getdbName()."`.`car` c LEFT JOIN `".$this->managerbdd->getdbName()."`.`pictures` p ON c.id = p.car_id WHERE 1=1";
        
        if ($prixMinInput > -1){
            $sql = $sql." AND price>=".$prixMinInput;
        }

        if ($prixMaxInput > -1){
            $sql = $sql." AND price<=".$prixMaxInput;
        }

        if ( $kmMin > -1){
            $sql = $sql." AND km>=". $kmMin;
        }

        if ($kmMax > -1){
            $sql = $sql." AND km<=".$kmMax;
        }
        
        if ( $yearMin > -1){
            $sql = $sql." AND year>=". $yearMin;
        }

        if ($yearMax > -1){
            $sql = $sql." AND year<=".$yearMax;
        }


        $sql = $sql." GROUP BY c.id ORDER BY name";
        $req = $this->db->query($sql);
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $car = new Car($data);
            $cars[] = $car;
        }

        return $cars;
    


   
    }
}