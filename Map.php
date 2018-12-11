<?php

class Map extends Base
{
    public function __construct($x, $y) {
        $this->setX($x);
        $this->setY($y);
    }

    private $map;

    /**
     * map [Getter]
     */
    public function getMap() {
        return $this->map;
    }

    /**
     * Operations
     */
    public function generateEmptyMap() {
        for ($i = 0; $i < $this->y; $i++) {
            for ($j = 0; $j < $this->x; $j++) {
                $this->map[$i][$j] = '.';
            }
        }
    }

    public function populateMap($x, $y, $arg) {
        $this->map[$y][$x] = $arg;
    }

    public function displayMap() {
        for ($i = 0; $i < $this->y; $i++) {
            for ($j = 0; $j < $this->x; $j++) {
                if (gettype($this->map[$i][$j]) == 'object') {
                    echo $this->map[$i][$j]->getDisplay();
                } else {
                    echo $this->map[$i][$j];
                }
                echo "\t";
            }
            echo PHP_EOL; // php constant for correct end of line (\n)
        }
    }
}

?>