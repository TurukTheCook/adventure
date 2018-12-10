<?php
spl_autoload_register(
    function ($class) {
        include $class.'.php';
    }
);

//TODO: extract data from config file and handle logic for each type


$aventurier = new Aventurier("Turuk", 1, 3, "S", "ADAAA");
$tresor = new Tresor(2, 3, 1);
$gob = new Gobelin(0, 3, 1, 2);
$orc = new Orc(1, 0, 1, 1);

$config = new Config();
$config->readFile("map");
$params = $config->getConfig();

$map = null;

for ($i = 0; $i < $config; $i++) {
    switch ($config[$i][0]) {
        case 'C':
            $map = new Map($config[$i][1], $config[$i][2]);
            $map->generateEmptyMap();
            break;
        case 'M':
            $map->populateMap($config[$i][1], $config[$i][2], "M");
            break;
        case 'A':
            echo "i égal 2";
            break;
    }
}


$map->populateMap(0, 1, "M");
$map->populateMap(0, 2, "M");
$map->populateMap(1, 2, "M");
$map->displayMap();

?>