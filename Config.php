<?php

class Config
{
    private $config;

    /**
     * config [Getter]
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Operations
     */
    public function readFile($file) {
        $mapFile = fopen($file, "r") or die("Unable to open map file");

        $i = 0;
        while(!feof($mapFile)) { // feof test end of file on the pointer
            $this->config[$i] = explode('-', str_replace(' ', '', fgets($mapFile))); // fgets read line on pointer then move pointer to next line
            $i++;
        }

        fclose($mapFile);
    }

}

?>