<?php
class Lesson{
    private $id;
    private $title;
    private $description;
    private $videoUrl;
    private $module;
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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of videoUrl
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * Set the value of videoUrl
     */
    public function setVideoUrl($videoUrl): self
    {
        $this->videoUrl = $videoUrl;

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
}
?>