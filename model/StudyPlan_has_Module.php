<?php

class Module{
    private $studyPlan;
    private $module;

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
}