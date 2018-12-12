<?php

class Config
{
    private $config;
    private $entities;

    /**
     * config [Getter]
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * entities [Getter & setter]
     */
    public function getEntities() {
        return $this->entities;
    }

    public function setEntities($entities) {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Operations
     */
    public function readFile($file) {
        $mapFile = fopen($file, "r") or die("Unable to open map file\n");

        $i = 0;
        while(!feof($mapFile)) { // feof test end of file on the pointer
            $this->config[$i] = explode('-', trim(preg_replace('/\s+/', '', fgets($mapFile)))); // fgets read line on pointer then move pointer to next line
            $i++;
        }

        fclose($mapFile);
    }

}

?>