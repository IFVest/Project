<?php

class StudyWeek{
    private $id;
    private $marker;

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

?>