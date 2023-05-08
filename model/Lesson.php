<?php
class Lesson
{
    private $id;
    private $title;
    private $url;
    private $module;
    private $moduleName;
    private $studyWeek;

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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

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
     * Get the value of studyWeek
     */
    public function getStudyWeek()
    {
        return $this->studyWeek;
    }

    /**
     * Set the value of studyWeek
     */
    public function setStudyWeek($studyWeek): self
    {
        $this->studyWeek = $studyWeek;

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of moduleName
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set the value of moduleName
     */
    public function setModuleName($moduleName): self
    {
        $this->moduleName = $moduleName;

        return $this;
    }
}
?>