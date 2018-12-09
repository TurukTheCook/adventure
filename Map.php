<?php

class Map
{
    public function __construct($x, $y){
        $this->setX($x);
        $this->setY($y);
    }

    private $x;
    private $y;
    private $map;

    public function setX($x) {
        $this->x = $x;
        return $this;
    }

    public function getX() {
        return $this->x;
    }

    public function setY($y) {
        $this->y = $y;
        return $this;
    }

    public function getY() {
        return $this->y;
    }

    public function setMap($map) {
        $this->map = $map;
        return $this;
    }

    public function getMap() {
        return $this->map;
    }

    public function generateMap() {
        for ($i = 0; $i < $this->y; $i++)
        {
            for ($j = 0; $j < $this->x; $j++) {
                $this->map[$i][$j] = '.';
            }
        }
    }

    function populateMap($x, $y, $arg)
    {
        $this->map[$y][$x] = $arg;
    }

    public function displayMap() {
        for ($i = 0; $i < $this->y; $i++)
        {
            for ($j = 0; $j < $this->x; $j++)
            {
                echo $this->map[$i][$j];
                echo "\t";
            }
            echo "\n";
        }
    }
}

?>