<?php

class Monstre extends Base
{
    protected $niveau;
    protected $nbDeplacements;

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
}

?>