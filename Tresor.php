<?php

class Tresor extends Coordonnees
{
    public function __construct($x, $y, $nombre) {
        $this->setX($x);
        $this->setY($y);
        $this->setNombre($nombre);
    }

    private $nombre;

    /**
     * nombre [Getter & Setter]
     */
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
}

?>