<?php

class Aventurier extends Base
{
    public function __construct($nom, $x, $y, $orientation, $seqMouvements) {
        $this->setNom($nom);
        $this->setX($x);
        $this->setY($y);
        $this->setOrientation($orientation);
        $this->setSeqMouvements($seqMouvements);
        $this->setDisplay("A(".substr($this->getNom(), 0, 3).")");
        $this->setGenre('A');
        $this->setNiveau(1);
        $this->setState('L');
    }

    private $nom;
    private $orientation;
    private $seqMouvements;
    
    /**
     * Nom [Getter & Setter]
     */
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    /**
     * orientation [Getter & Setter]
     */
    public function getOrientation() {
        return $this->orientation;
    }
    
    public function setOrientation($orientation) {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * sequenceMouvements [Getter & Setter]
     */
    public function getSeqMouvements() {
        return $this->seqMouvements;
    }
    
    public function setSeqMouvements($seqMouvements) {
        $this->seqMouvements = $seqMouvements;
        return $this;
    }

    /**
     * Operations
     */
    public function move($map) {
        if ($this->state == 'D') {
            return ;
        }
        
        if (substr($this->seqMouvements, 0, 1) == 'D') {
            switch ($this->orientation) {
                case 'S':
                    $this->orientation = 'O';
                    break;
                case 'O':
                    $this->orientation = 'N';
                    break;
                case 'N':
                    $this->orientation = 'E';
                    break;
                case 'E':
                    $this->orientation = 'S';
                    break;
                default:
                    break;
            }
            $this->seqMouvements = substr($this->seqMouvements, 1);
        } else if (substr($this->seqMouvements, 0, 1) == 'G') {
            switch ($this->orientation) {
                case 'S':
                    $this->orientation = 'E';
                    break;
                case 'O':
                    $this->orientation = 'S';
                    break;
                case 'N':
                    $this->orientation = 'O';
                    break;
                case 'E':
                    $this->orientation = 'N';
                    break;
                default:
                    break;
            }
            $this->seqMouvements = substr($this->seqMouvements, 1);
        } else if (substr($this->seqMouvements, 0, 1) == 'A') {
            $this->handleMovement($map);
        }
    }

    public function moveForward($map) {
        $this->handleTreasure($map);

        if ($this->orientation == 'N') {
            $map->populateMap($this->x, ($this->y - 1), $this);
            $this->y -= 1;
        } else if ($this->orientation == 'E') {
            $map->populateMap(($this->x + 1), $this->y, $this);
            $this->x += 1;
        } else if ($this->orientation == 'S') {
            $map->populateMap($this->x, ($this->y + 1), $this);
            $this->y += 1;
        } else if ($this->orientation == 'O') {
            $map->populateMap(($this->x - 1), $this->y, $this);
            $this->x -= 1;
        }
        $this->seqMouvements = substr($this->seqMouvements, 1);
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

    public function handleMovement($map) {
        $currentMap = $map->getMap();
        $next = null;

        if ($this->orientation == 'N') {
            $next = $currentMap[($this->y - 1)][$this->x];
        } else if ($this->orientation == 'E') {
            $next = $currentMap[$this->y][($this->x + 1)];
        } else if ($this->orientation == 'S') {
            $next = $currentMap[($this->y + 1)][$this->x];
        } else if ($this->orientation == 'O') {
            $next = $currentMap[$this->y][($this->x - 1)];
        }

        if (gettype($next) == 'object') {
            if ($next->getGenre() == 'T') {
                $this->moveForward($map);
                $this->isOnTreasure = true;
                $this->treasure = $next;
                $this->niveau += 1;
            } else if ($next->getGenre() == 'M') {
                $this->fight($map, $next);
                if ($this->state == 'L') {
                    $this->moveForward($map);
                }
            }
        } else {
            if ($next == 'M') {
                $this->seqMouvements = substr($this->seqMouvements, 1);
                $this->move($map);
            } else {
                $this->moveForward($map);
            }
        }
    }

    public function fight($map, $next) {
        if ($this->niveau < $next->getNiveau()) {
            $this->state = 'D';
            $this->handleTreasure($map);
        } else {
            $next->setState('D');
            $this->niveau += 1;
        }
    }
}

?>