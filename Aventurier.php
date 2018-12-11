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
}

?>