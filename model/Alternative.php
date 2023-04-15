<?php

class Module{
    private $id;
    private $text;
    private $isCorrect;
    private $question;

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
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     */
    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of isCorrect
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * Set the value of isCorrect
     */
    public function setIsCorrect($isCorrect): self
    {
        $this->isCorrect = $isCorrect;

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
}