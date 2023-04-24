<?php

class Material{
    private $id;
    private $path;
    private $lesson;

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
     * Get the value of path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     */
    public function setPath($path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of lesson
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set the value of lesson
     */
    public function setLesson($lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }
}