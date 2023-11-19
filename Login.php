
<?php
session_start();
require("./LoginManager.php");
if(isset($_POST["email"])) {
$manager = new LoginManager();
$email = $_POST['email']; // Adresse e-mail fournie dans le formulaire
$password = $_POST['password']; // Adresse e-mail fournie dans le formulaire
$data=$manager->login($email , $password);
if(is_array($data)){
    $login= new Login($data);
}else {
    echo "identifiant incorrect";
}
}
else {
    $_SESSION["user"]= null;
}
header("Location: ./index.php");

class Login {
    private $id;
    private $name;
    private $forename;
    private $email;
    private $password;
    private $role;
    


    public function __construct(array $data){
        $this->hydrate($data);
        $_SESSION["user"]= $data;
        
    }
    
    public function hydrate(array $data) {
        foreach ($data as $key => $value){
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }   
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of forename
     */ 
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Set the value of forname
     *
     * @return  self
     */ 
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
    }

?>