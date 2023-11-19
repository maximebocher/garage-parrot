<?php

//session_start();
class LoginManager {
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
        };
        
        
    }
    
    public function login($email , $password)
{
    
    $sql = "SELECT id, email, password, role FROM `garage-parot`.users WHERE email = :email "; 
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
    $req = $this->db->prepare("INSERT INTO `garage-parot`.`users` (name, forename, email, password, role) VALUE (:name, :forename, :email, :password, :role)");
    $req->bindValue(":name", $name, PDO::PARAM_STR);
    $req->bindValue(":forename", $forename, PDO::PARAM_STR);
    $req->bindValue(":email", $email, PDO::PARAM_STR);
    $req->bindValue(":password",password_hash($password, PASSWORD_BCRYPT));
    $req->bindValue(":role", $role, PDO::PARAM_STR);
    $req->execute();
}
}

