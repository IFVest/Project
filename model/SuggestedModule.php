<?php

class SuggestedModule{
    private $id;
    private $marker;
    private $studyPlan;
    private $module;

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
     * Get the value of studyPlan
     */
    public function getStudyPlan()
    {
        return $this->studyPlan;
    }

    /**
     * Set the value of studyPlan
     */
    public function setStudyPlan($studyPlan): self
    {
        $this->studyPlan = $studyPlan;

        return $this;
    }

    /**
     * Get the value of module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the value of module
     */
    public function setModule($module): self
    {
        $this->module = $module;

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
}