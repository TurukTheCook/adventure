<?php

class Base
{
    protected $x;
    protected $y;
    protected $display;
    protected $genre;
    protected $state;
    protected $niveau;
    protected $isOnTreasure;
    protected $treasure;

    /**
     * niveau [Getter & Setter]
     */
    public function getNiveau() {
        return $this->niveau;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
        return $this;
    }

    /**
     * IsOnTreasure [Getter & Setter]
     */
    public function getIsOnTreasure() {
        return $this->isOnTreasure;
    }

    public function setIsOnTreasure($isOnTreasure) {
        $this->isOnTreasure = $isOnTreasure;
        return $this;
    }

    /**
     * Treasure [Getter & Setter]
     */
    public function getTreasure() {
        return $this->treasure;
    }

    public function setTreasure($treasure) {
        $this->treasure = $treasure;
        return $this;
    }

    /**
     * State [Getter & Setter]
     */
    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Genre [Getter & Setter]
     */
    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
        return $this;
    }

    /**
     * display [Getter & Setter]
     */
    public function getDisplay() {
        return $this->display;
    }

    public function setDisplay($display) {
        $this->display = $display;
        return $this;
    }

    /**
     * x [Getter & Setter]
     */
    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
        return $this;
    }

    /**
     * y [Getter & Setter]
     */
    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
        return $this;
    }
}

?>