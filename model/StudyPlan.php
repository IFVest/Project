<?php

class Module{
    private $id;
    private $user;
    private $exam;

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
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     */
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of exam
     */
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * Set the value of exam
     */
    public function setExam($exam): self
    {
        $this->exam = $exam;

        return $this;
    }
}