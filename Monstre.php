<?php

class Monstre extends Base
{
    protected $niveau;
    protected $nbDeplacements;
    protected $position;
    protected $orientation;
    protected $state;

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
     * Position [Getter & Setter]
     */
    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

    /**
     * Orientation [Getter & Setter]
     */
    public function getOrientation() {
        return $this->orientation;
    }

    public function setOrientation($orientation) {
        $this->orientation = $orientation;
        return $this;
    }

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
     * nbDeplacements [Getter & Setter]
     */
    public function getNbDeplacements() {
        return $this->nbDeplacements;
    }

    public function setNbDeplacements($nbDeplacements) {
        $this->nbDeplacements = $nbDeplacements;
        return $this;
    }

    /**
     * Operations
     */
    public function checkOrientation() {
        if ($this->position >= $this->nbDeplacements) { // handle movement orientation
            $this->orientation = false;
        } else if ($this->position <= 0) {
            $this->orientation = true;
        }
    }

    public function moveMonster($map, $type) {
        if ($type == 'O') {
            $map->populateMap($this->x, ($this->y + 1), $this);
            $map->populateMap($this->x, $this->y, '.');
            $this->y += 1;
        } else if ($type == 'G') {
            $map->populateMap(($this->x + 1), $this->y, $this);
            $map->populateMap($this->x, $this->y, '.');
            $this->x += 1;
        }
        $this->position += 1;
    }

    public function moveMonsterReverse($map, $type) {
        if ($this->position <= 0) {
            return ;
        }
        if ($type == 'O') {
            $map->populateMap($this->x, ($this->y - 1), $this);
            $map->populateMap($this->x, $this->y, '.');
            $this->y -= 1;
        } else if ($type == 'G') {
            $map->populateMap(($this->x - 1), $this->y, $this);
            $map->populateMap($this->x, $this->y, '.');
            $this->x -= 1;
        }
        $this->position -= 1;
    }
}

?>