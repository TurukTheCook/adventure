<?php

class Monstre extends Base
{
    protected $nbDeplacements;
    protected $position;
    protected $orientation;

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

    public function moveForward($map, $type) {
        $this->handleTreasure($map);

        if ($type == 'O') {
            $map->populateMap($this->x, ($this->y + 1), $this);
            $this->y += 1;
        } else if ($type == 'G') {
            $map->populateMap(($this->x + 1), $this->y, $this);
            $this->x += 1;
        }

        $this->position += 1;
    }

    public function moveBackard($map, $type) {
        if ($this->position <= 0) {
            return ;
        }

        $this->handleTreasure($map);

        if ($type == 'O') {
            $map->populateMap($this->x, ($this->y - 1), $this);
            $this->y -= 1;
        } else if ($type == 'G') {
            $map->populateMap(($this->x - 1), $this->y, $this);
            $this->x -= 1;
        }

        $this->position -= 1;
    }

    public function handleTreasure($map) {
        if ($this->isOnTreasure) {
            $this->isOnTreasure = false;
            $map->populateMap($this->x, $this->y, $this->treasure);
            $this->treasure = null;
        } else {
            $map->populateMap($this->x, $this->y, '.');
        }
    }

    public function handleMovement($map, $type) {
        $currentMap = $map->getMap();
        $next = null;
        if ($this->orientation) {
            if ($type == 'O') {
                $next = $currentMap[($this->y + 1)][$this->x];
            } else if ($type == 'G') {
                $next = $currentMap[$this->y][($this->x + 1)];
            }

            if (gettype($next) == 'object') {
                if ($next->getGenre() == 'T') {
                    $this->moveForward($map, $type);
                    $this->isOnTreasure = true;
                    $this->treasure = $next;
                } else if ($next->getGenre() == 'A') {
                    $this->fight($map, $type, $next);
                    if ($this->state == 'L') {
                        $this->moveForward($map, $type);
                    }
                }
            } else {
                if ($next == 'M') {
                    $this->orientation = false;
                    $this->moveBackard($map, $type);
                } else {
                    $this->moveForward($map, $type);
                }
            }
        } else {
            if ($type == 'O') {
                $next = $currentMap[($this->y - 1)][$this->x];
            } else if ($type == 'G') {
                $next = $currentMap[$this->y][($this->x - 1)];
            }

            if (gettype($next) == 'object') {
                if ($next->getGenre() == 'T') {
                    $this->moveBackard($map, $type);
                    $this->isOnTreasure = true;
                    $this->treasure = $next;
                } else if ($next->getGenre() == 'A') {
                    $this->fight($map, $type, $next);
                    if ($this->state == 'L') {
                        $this->moveBackard($map, $type);
                    }
                }
            } else {
                $this->moveBackard($map, $type);
            }
        }
    }

    public function fight($map, $type, $next) {
        if ($this->niveau <= $next->getNiveau()) {
            $this->state = 'D';
            $this->handleTreasure($map);
            $next->setNiveau($next->getNiveau() + 1);
        } else {
            $next->setState('D');
        }
    }
}

?>