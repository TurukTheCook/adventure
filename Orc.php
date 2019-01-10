<?php

class Orc extends Monstre
{
    public function __construct($x, $y, $niveau, $nbDeplacements) {
        $this->x = $x;
        $this->y = $y;
        $this->niveau = $niveau;
        if ($nbDeplacements) {
            $this->nbDeplacements = $nbDeplacements;
        } else {
            $this->nbDeplacements = 0;
        }
        $this->position = 0;
        $this->orientation = true;
        $this->state = 'L';
        $this->display = 'O';
        $this->genre = 'M';
    }

    /**
     * Operations
     */
    public function move($map) {
        if ($this->nbDeplacements == 0 || $this->state == "D") { // handle if position if fixed or if dead
            return ;
        }
        
        $this->checkOrientation();
        
        $this->handleMovement($map, 'O');
    }
}

?>