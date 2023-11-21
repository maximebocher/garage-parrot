<?php
class BDDManager {
    private $dbName = "garage-parot";
    private $port = 3306;
    private $username = "neva";
    private $password = "neva";
    private $url = "localhost";

    public function getdbName()
    {
        return $this->dbName;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

}
?>

