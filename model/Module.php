<?php
class Module{
    private $id;
    private $name;
    private $description;
    private $subject;
    private $lessons;

    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
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
     */
    public function setName($name): self
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
     */
    public function setDescription($description): self
    {
        $this->description = $description;

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
     */
    public function setLessons($lessons): self
    {
        $this->lessons = $lessons;

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
     */
    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}