<?php

class Base
{
    protected $x;
    protected $y;
    protected $display;

    /**
     * display [Getter & Setter]
     */
    public function getDisplay() {
        return $this->display;
    }

    public function setDisplay($display) {
        $this->display = $display;
        return $this;
    }

    /**
     * x [Getter & Setter]
     */
    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
        return $this;
    }

    /**
     * y [Getter & Setter]
     */
    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
        return $this;
    }
}

?>