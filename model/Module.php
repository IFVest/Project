<?php

class Module implements JsonSerializable{
    private $id;
    private $name;
    private $description;
    private $subject;
    private $lessons;
    private $questions;
    

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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of lessons
     */ 
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Set the value of lessons
     *
     * @return  self
     */  
    public function setLessons($lessons)
    {
        $this->lessons = $lessons;

        return $this;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'subject' => $this->subject
        ];
    }


    /**
     * Get the value of questions
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set the value of questions
     */
    public function setQuestions($questions): self
    {
        $this->questions = $questions;

        return $this;
    }
}

?>