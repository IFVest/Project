<?php
class CorrectByModule{
    private $id;
    private $totalQuestions;
    private $correctQuestions;
    private $isProblem;
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
     * Get the value of totalQuestions
     */
    public function getTotalQuestions()
    {
        return $this->totalQuestions;
    }

    /**
     * Set the value of totalQuestions
     */
    public function setTotalQuestions($totalQuestions): self
    {
        $this->totalQuestions = $totalQuestions;

        return $this;
    }

    /**
     * Get the value of correctQuestions
     */
    public function getCorrectQuestions()
    {
        return $this->correctQuestions;
    }

    /**
     * Set the value of correctQuestions
     */
    public function setCorrectQuestions($correctQuestions): self
    {
        $this->correctQuestions = $correctQuestions;

        return $this;
    }

    /**
     * Get the value of isProblem
     */
    public function getIsProblem()
    {
        return $this->isProblem;
    }

    /**
     * Set the value of isProblem
     */
    public function setIsProblem($isProblem): self
    {
        $this->isProblem = $isProblem;

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
?>