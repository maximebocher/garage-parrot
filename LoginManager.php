<?php

require_once("./config.php");
//session_start();
class LoginManager {
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
    
    public function login($email , $password)
{
    
    $sql = "SELECT id, email, password, role FROM `".$this->managerbdd->getdbName()."`.users WHERE email = :email "; 
    $req = $this->db->prepare($sql);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    if ($req->execute()) {
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            // Si aucun utilisateur ne correspond au login entré, on affiche une erreur
            echo 'Identifiants invalides';
        } else {
            // On vérifie le hash du password
            if (password_verify($password, $user['password'])) {
                echo 'Bienvenue '.$user['username'];
                return $user;
            } else {
                echo 'Identifiants invalides';
            }
        }
    } else {
        echo 'Impossible de récupérer l\'utilisateur';
    }
}
public function createEmploye (string $name,string $forename,string $email,string $password,string $role){
    $req = $this->db->prepare("INSERT INTO `".$this->managerbdd->getdbName()."`.`users` (name, forename, email, password, role) VALUE (:name, :forename, :email, :password, :role)");
    $req->bindValue(":name", $name, PDO::PARAM_STR);
    $req->bindValue(":forename", $forename, PDO::PARAM_STR);
    $req->bindValue(":email", $email, PDO::PARAM_STR);
    $req->bindValue(":password",password_hash($password, PASSWORD_BCRYPT));
    $req->bindValue(":role", $role, PDO::PARAM_STR);
    $req->execute();
}
}

