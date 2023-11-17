<?php

class StudyPlan{
    private $id;
    private $marker;
    private $exam;
    private $suggestedModules;

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

    /**
     * Get the value of marker
     */
    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * Set the value of marker
     */
    public function setMarker($marker): self
    {
        $this->marker = $marker;

        return $this;
    }

    /**
     * Get the value of suggestedModules
     */
    public function getSuggestedModules()
    {
        return $this->suggestedModules;
    }

    /**
     * Set the value of suggestedModules
     */
    public function setSuggestedModules($suggestedModules): self
    {
        $this->suggestedModules = $suggestedModules;

        return $this;
    }
}