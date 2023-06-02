<?php

class StudyWeek{
    private $id;
    private $marker;
    private $lessons;

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
     * Get the value of lessons
     */ 
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Set the value of lessons
     *
     * @return  self
     */ 
    public function setLessons($lessons)
    {
        $this->lessons = $lessons;

        return $this;
    }
}

?>