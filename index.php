<?php
error_reporting(0);
spl_autoload_register(
    function ($class) {
        include $class.'.php';
    }
);
if (!$argv[1]) {
    echo "You must provide a map file.\n";
    die();
}

$config = new Config();
$config->readFile($argv[1]);
$params = $config->getConfig();

$map;

for ($i = 0; $i < count($params); $i++) {
    switch(substr($params[$i][0], 0, 1)) {
        case "C":
            $map = new Map(intval($params[$i][1]), intval($params[$i][2]));
            $map->generateEmptyMap();
            break;
        case "A":
            $aventurier = new Aventurier($params[$i][1], intval($params[$i][2]), intval($params[$i][3]), $params[$i][4], $params[$i][5]);
            $map->populateMap($aventurier->getX(), $aventurier->getY(), $aventurier);
            break;
        case "T":
            $tresor = new Tresor(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]));
            $map->populateMap($tresor->getX(), $tresor->getY(), $tresor);
            break;
        case "G":
            $gob = new Gobelin(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), intval($params[$i][4]));
            $map->populateMap($gob->getX(), $gob->getY(), $gob);
            break;
        case "O":
            $orc = new Orc(intval($params[$i][1]), intval($params[$i][2]), intval($params[$i][3]), intval($params[$i][4]));
            $map->populateMap($orc->getX(), $orc->getY(), $orc);
            break;
        case "M":
            $map->populateMap(intval($params[$i][1]), intval($params[$i][2]), "M");
            break;
        default:
            break;
    }
}

$map->displayMap();

?>