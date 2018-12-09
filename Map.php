<?php

class Map extends Coordonnees
{
    public function __construct($x, $y) {
        $this->setX($x);
        $this->setY($y);
    }

    private $map;

    /**
     * map [Getter & Setter]
     */
    public function getMap() {
        return $this->map;
    }
    
    public function setMap($map) {
        $this->map = $map;
        return $this;
    }

    /**
     * Object functions
     */
    public function generateMap() {
        for ($i = 0; $i < $this->y; $i++) {
            for ($j = 0; $j < $this->x; $j++) {
                $this->map[$i][$j] = '.';
            }
        }
    }

    function populateMap($x, $y, $arg) {
        $this->map[$y][$x] = $arg;
    }

    public function displayMap() {
        for ($i = 0; $i < $this->y; $i++) {
            for ($j = 0; $j < $this->x; $j++) {
                echo $this->map[$i][$j];
                echo "\t";
            }
            echo "\n";
        }
    }
}

?>