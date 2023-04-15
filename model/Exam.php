<?php
class Exam{
    private $id;
    private $user;

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
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setUser($idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
?>