<?php

class Opinion {
    private $id;
    private $name;
    private $comment;
    private $rating;
    private $approved;
    


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
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of approuved
     */ 
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set the value of approuved
     *
     * @return  self
     */ 
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }
}