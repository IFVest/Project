<?php
class Exam{
    private $id;
    private $user;
    private $examModules;
    private $studyPlans;
    private $finished;
    private $totalQuestions;
    private $totalQuestionsCorrect;
    private $percentageCorrect;

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

    /**
     * Get the value of studyPlans
     */
    public function getStudyPlans()
    {
        return $this->studyPlans;
    }

    /**
     * Set the value of studyPlans
     */
    public function setStudyPlans($studyPlans): self
    {
        $this->studyPlans = $studyPlans;

        return $this;
    }

    /**
     * Get the value of finished
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set the value of finished
     */
    public function setFinished($finished): self
    {
        $this->finished = $finished;

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
     * Get the value of totalQuestionsCorrect
     */
    public function getTotalQuestionsCorrect()
    {
        return $this->totalQuestionsCorrect;
    }

    /**
     * Set the value of totalQuestionsCorrect
     */
    public function setTotalQuestionsCorrect($totalQuestionsCorrect): self
    {
        $this->totalQuestionsCorrect = $totalQuestionsCorrect;

        return $this;
    }

    /**
     * Get the value of percentageCorrect
     */
    public function getPercentageCorrect()
    {
        return $this->percentageCorrect;
    }

    /**
     * Set the value of percentageCorrect
     */
    public function setPercentageCorrect($percentageCorrect): self
    {
        $this->percentageCorrect = $percentageCorrect;

        return $this;
    }
}
