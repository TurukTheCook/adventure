<?php

class Gobelin extends Monstre
{
    public function __construct($x, $y, $niveau, $nbDeplacements) {
        $this->setX($x);
        $this->setY($y);
        $this->setNiveau($niveau);
        if ($nbDeplacements) {
            $this->setNbDeplacements($nbDeplacements);
        } else {
            $this->setNbDeplacements(0);
        }
        $this->setDisplay('G');
    }
}

?>