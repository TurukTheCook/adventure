<?php
spl_autoload_register(
    function ($class)
    {
        include $class . '.php';
    }
);

$x = 3;
$y = 4;

$map = new Map($x, $y);

$map->generateMap();
$map->populateMap(0, 0, "M");
$map->populateMap(0, 1, "M");
$map->populateMap(0, 2, "M");
$map->populateMap(1, 2, "M");
$map->displayMap();

?>