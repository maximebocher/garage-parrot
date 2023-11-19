<?php

class Garage_status{

private $id;
private $name;
private $is_open;

public function __construct(array $data){
    $this->hydrate($data);
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
   * Get the value of is_open
   */ 
public function getIs_open()
{
    return $this->is_open;
}

/**
   * Set the value of is_open
   *
   * @return  self
   */ 
public function setIs_open($is_open)
{
    $this->is_open = $is_open;

    return $this;
}
}