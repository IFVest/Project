<?php
class UserAnswer{
    private $id;
    private $examModule;
    private $question;
    private $chosenAnswer;
    private $userRightAnswer;


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
     * Get the value of examModule
     */
    public function getExamModule()
    {
        return $this->examModule;
    }

    /**
     * Set the value of examModule
     */
    public function setExamModule($examModule): self
    {
        $this->examModule = $examModule;

        return $this;
    }

    /**
     * Get the value of question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of question
     */
    public function setQuestion($question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of chosenAnswer
     */
    public function getChosenAnswer()
    {
        return $this->chosenAnswer;
    }

    /**
     * Set the value of chosenAnswer
     */
    public function setChosenAnswer($chosenAnswer): self
    {
        $this->chosenAnswer = $chosenAnswer;

        return $this;
    }

    /**
     * Get the value of userRightAnswer
     */
    public function getUserRightAnswer()
    {
        return $this->userRightAnswer;
    }

    /**
     * Set the value of userRightAnswer
     */
    public function setUserRightAnswer($userRightAnswer): self
    {
        $this->userRightAnswer = $userRightAnswer;

        return $this;
    }
}
?>