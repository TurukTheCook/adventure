<?php

class Orc extends Monstre
{
    public function __construct($x, $y, $niveau, $nbDeplacements) {
        $this->setX($x);
        $this->setY($y);
        $this->setNiveau($niveau);
        $this->setNbDeplacements($nbDeplacements);
        $this->setDisplay('O');
    }
}

?>