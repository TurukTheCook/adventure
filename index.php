<?php
spl_autoload_register(
    function ($class) {
        include $class.'.php';
    }
);

$map = new Map(3, 4);
$aventurier = new Aventurier("Turuk", 1, 3, "S", "ADAAA");
$tresor = new Tresor(2, 3, 1);
$gob = new Gobelin(0, 3, 1, 2);
$orc = new Orc(1, 0, 1, 1);

$map->generateMap();
$map->populateMap(0, 0, "M");
$map->populateMap(0, 1, "M");
$map->populateMap(0, 2, "M");
$map->populateMap(1, 2, "M");
$map->displayMap();

?>