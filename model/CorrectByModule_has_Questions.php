<?php
class CorrectByModule_has_Questions{
    private $correctByModule;
    private $question;
    private $alternativeSelected;
    private $isTheExpectedAnswer;

    /**
     * Get the value of correctByModule
     */
    public function getCorrectByModule()
    {
        return $this->correctByModule;
    }

    /**
     * Set the value of correctByModule
     */
    public function setCorrectByModule($correctByModule): self
    {
        $this->correctByModule = $correctByModule;

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
     * Get the value of alternativeSelected
     */
    public function getAlternativeSelected()
    {
        return $this->alternativeSelected;
    }

    /**
     * Set the value of alternativeSelected
     */
    public function setAlternativeSelected($alternativeSelected): self
    {
        $this->alternativeSelected = $alternativeSelected;

        return $this;
    }

    /**
     * Get the value of isTheExpectedAnswer
     */
    public function getIsTheExpectedAnswer()
    {
        return $this->isTheExpectedAnswer;
    }

    /**
     * Set the value of isTheExpectedAnswer
     */
    public function setIsTheExpectedAnswer($isTheExpectedAnswer): self
    {
        $this->isTheExpectedAnswer = $isTheExpectedAnswer;

        return $this;
    }
}
?>