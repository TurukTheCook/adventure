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
        $this->state = "L";
        $this->display = 'O';
    }

    /**
     * Operations
     */
    public function move($map) {
        if ($this->nbDeplacements == 0 || $this->state == "D") { // handle if position if fixed or if dead
            return ;
        }
        
        $this->checkOrientation();
        
        if ($this->position < $this->nbDeplacements && $this->orientation) {
            $currentMap = $map->getMap();

            switch ($currentMap[($this->y + 1)][$this->x]) {
                case 'M':
                    $this->orientation = false;
                    $this->moveMonsterReverse($map, 'O');
                    break ;
                default:
                    $this->moveMonster($map, 'O');
                    break ;
            }
        } else if ($this->position > 0) {
            $this->moveMonsterReverse($map, 'O');
        }
    }
}

?>