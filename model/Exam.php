<?php
class Exam{
    private $id;
    private $user;
    private $examModules;
    private $finished;

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     */
    public function setFinished($finished): void
    {
        $this->finished = $finished;
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
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of idUser
     */
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of examModules
     */
    public function getExamModules()
    {
        return $this->examModules;
    }

    /**
     * Set the value of examModules
     */
    public function setExamModules($examModules): self
    {
        $this->examModules = $examModules;

        return $this;
    }
}
?>